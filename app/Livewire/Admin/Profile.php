<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helpers\CMail;
use App\Models\UserSocialLink;
use Illuminate\Support\Carbon;
use Livewire\Attributes\On;  // ← manquant !


class Profile extends Component
{

    #[On('updateProfile')]
    public function refreshInfo(): void {}

    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab' => ['keep' => true]];

    public $current_password, $new_password, $new_password_confirmation;

    public $facebook_url, $instagram_url, $youtube_url, $linkedin_url, $twitter_url, $github_url;

    public $name, $email, $username, $bio;

    public function selecTab($tab)
    {
        $this->tab = $tab;
    }

    public function mount()
    {
        $this->tab = Request('tab') ? Request('tab') : $this->tabname;

        // charger le formulaire 
        $user = User::with('social_links')->findOrFail(auth()->id());
        $this->name     = $user->name;
        $this->email    = $user->email;
        $this->username = $user->username;
        $this->bio      = $user->bio;

        //Populate Social Links Form
        if (!is_null($user->social_links)) {
            $this->facebook_url = $user->social_links->facebook_url;
            $this->instagram_url = $user->social_links->instagram_url;
            $this->youtube_url = $user->social_links->youtube_url;
            $this->linkedin_url = $user->social_links->linkedin_url;
            $this->twitter_url = $user->social_links->twitter_url;
            $this->github_url = $user->social_links->github_url;
        }
    }

    public function updatePersonalDetails()
    {
        $user = User::findOrFail(auth()->id());

        $this->validate([
            'name'     => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
            'bio'      => 'required',
        ], [
            'name.required'     => 'Veuillez saisir votre nom et prénom',
            'username.required' => 'Veuillez saisir votre nom d\'utilisateur',
            'bio.required'      => 'Veuillez saisir votre bio',
        ]);

        $user->name     = $this->name;
        $user->username = $this->username;
        $user->bio      = $this->bio;
        $updated        = $user->save();

        if ($updated) {
            $this->dispatch('showToastr', [
                'type'    => 'success',
                'message' => '🎉 Mise à jour effectuée avec succès !',
            ]);

            // Dispatch vers TopUserInfo uniquement (même layout = même page)
            $this->dispatch('updateTopUserInfo')->to(TopUserInfo::class);
        } else {
            $this->dispatch('showToastr', [
                'type'    => 'error',
                'message' => '❌ Une erreur est survenue. Veuillez réessayer plus tard.',
            ]);
        }
    }

    public function updatePassword()
    {
        $user = User::findOrFail(auth()->id());

        //Validate form
        $this->validate([
            'current_password' => [
                'required',
                'min:5',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('Votre mot de passe actuel ne correspond pas à nos enregistrements.'));
                    }
                }
            ],
            'new_password' => 'required|min:5|confirmed'
        ]);

        //Update User password
        $updated = $user->update([
            'password' => Hash::make($this->new_password)
        ]);

        if ($updated) {
            //Send email notification to this user
            $data = array(
                'user' => $user,
                'new_password' => $this->new_password,
                'changed_at'   => Carbon::now('Africa/Kinshasa')->isoFormat('dddd D MMMM YYYY [à] HH:mm:ss'),
            );

            $mail_body = view('email-templates.password-changes-template', $data)->render();

            $mail_config = array(
                'recipient_address' => $user->email,
                'recipient_name' => $user->name,
                'subject' => 'Password Changed',
                'body' => $mail_body
            );

            CMail::send($mail_config);

            //Logout and Redirect User to login page
            auth()->logout();
            Session::flash('info', 'Votre mot de passe a été modifié avec succès. Veuillez vous connecter avec votre nouveau mot de passe.');
            $this->redirectRoute('admin.login');
        } else {
            $this->dispatch('showToastr', ['type' => 'error', 'message' => 'Quelque chose s\'est mal passé.']);
        }
    }

    public function updateSocialLinks()
    {

        $this->validate([
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'github_url' => 'nullable|url',
        ],[
          'facebook_url.url' => 'Le champ URL Facebook doit être une URL valide.'  
        ]);
        //Get User Details
        $user = User::findOrFail(auth()->id());

        $data = array(
            'facebook_url' => $this->facebook_url,
            'instagram_url' => $this->instagram_url,
            'youtube_url' => $this->youtube_url,
            'linkedin_url' => $this->linkedin_url,
            'twitter_url' => $this->twitter_url,
            'github_url' => $this->github_url,
        );

        if (!is_null($user->social_links)) {
            //Update records
            $query = $user->social_links()->update($data);
        } else {
            //Insert new data
            $data['user_id'] = $user->id;
            $query = UserSocialLink::insert($data);
        }

        if ($query) {
            $this->dispatch('showToastr', ['type' => 'success', 'message' => 'Your social links have been updated successfully.!']);
        } else {
            $this->dispatch('showToastr', ['type' => 'error', 'message' => 'Something went wrong.']);
        }
    }


    public function render()
    {
        return view('livewire.admin.profile', [
            'user' => User::findOrFail(auth()->id()),
        ]);
    }
}

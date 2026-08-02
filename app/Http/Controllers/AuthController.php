<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\UserStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Helpers\CMail;

class AuthController extends Controller
{
    public function loginForm(Request $request)
    {
        $data = [
            'pageTitle' => 'Admin | Connexion'
        ];
        return view('back.pages.Auth.login', $data);
    }

    public function forgotForm(Request $request)
    {
        $data = [
            'pageTitle' => 'Admin | Mot de Pass Oublié'
        ];
        return view('back.pages.Auth.forgot', $data);
    }

    public function loginHandler(Request $request)
    {

        $fieldType = filter_var($request->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if ($fieldType == 'email') {
            $request->validate([
                'login_id' => 'required|email|exists:users,email',
                'password' => 'required|min:5'
            ], [
                'login_id.required' => 'Saisissez votre adresse e-mail',
                'login_id.email' => 'Adresse e-mail invalide',
                'login_id.exists' => 'Aucun compte n\'a été trouvé pour cette adresse e-mail.'
            ]);
        } else {
            $request->validate([
                'login_id' => 'required|exists:users,username',
                'password' => 'required|min:5'
            ], [
                'login_id.required' => 'Saisissez votre adresse e-mail',
                'login_id.exists' => 'Aucun compte n\'a été trouvé pour cette adresse e-mail.',
                'password.required' => 'Saisissez votre Mot de passe'
            ]);
        }

        $creds = array(
            $fieldType => $request->login_id,
            'password' => $request->password,
        );
        if (Auth::attempt($creds)) {
            //Check if account is inactive mode
            if (auth()->user()->status == UserStatus::Inactive) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('admin.login')->with('fail', 'Votre compte est actuellement inactif. Veuillez contacter le support à l\'adresse (support@larablog.test) pour obtenir de l\'aide.');
            }
            //Check if account is in Pending mode
            if (auth()->user()->status == UserStatus::Pending) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect()->route('admin.login')->with('fail', 'Votre compte est en cours d\'approbation. Veuillez consulter votre messagerie pour obtenir des instructions supplémentaires ou contacter l\'assistance à l\'adresse support@larablog.test.');
            }

            //Redirect use to dashboard
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('admin.login')->withInput()->with('fail', 'Mot de passe Incorrect');
        }
    } //End Method

    public function sendPasswordResetLink(Request $request)
    {
        //Valider le formulaire 

        $request->validate([
            'email' => 'required|email|exists:users,email'
        ], [
            'email.required' => 'Ce Champs est Obligatoire !',
            'email.email' => 'Adresse e-mail invalide',
            'email.exists' => 'Nous ne trouvons aucun utilisateur associé à cette adresse e-mail.'
        ]);

        //Get User Details
        $user = User::where('email', $request->email)->first();

        //Generate Token
        $token = base64_encode(Str::random(64));

        //Check if there is an existing token 
        $oldToken = DB::table('password_reset_tokens')
            ->where('email', $user->email)
            ->first();

        if ($oldToken) {
            //Update existing token
            DB::table('password_reset_tokens')
                ->where('email', $user->email)
                ->update([
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
        } else {
            //Add new reset password token
            DB::table('password_reset_tokens')->insert([
                'email' => $user->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        //Create clickable action link
        $actionLink = route('admin.reset_password_form', ['token' => $token]);

        $data = array(
            'actionlink' => $actionLink,
            'user' => $user
        );

        $mail_body = view('email-templates.forgot-template', $data)->render();

        $mailConfig = array(
            'recipient_address' => $user->email,
            'recipient_name' => $user->name,
            'subject' => 'Reset Password',
            'body' => $mail_body
        );

        if (CMail::send($mailConfig)) {
            return redirect()->route('admin.forgot')->with('success', 'Nous vous avons envoyé par courriel le lien de réinitialisation de votre mot de passe.');
        } else {
            return redirect()->route('admin.forgot')->with('fail', 'Une erreur s\'est produite. Le lien de réinitialisation du mot de passe n\'a pas été envoyé. Veuillez réessayer plus tard.');
        }
    } //end function

     public function resetForm(Request $request, $token = null){
        
     //Check if this token is exists
        $isTokenExists = DB::table('password_reset_tokens')
                           ->where('token',$token)
                           ->first();

        if( !$isTokenExists ){
            return redirect()->route('admin.forgot')->with('fail','Jeton invalide. Veuillez demander un autre lien de réinitialisation du mot de passe.');
        }else{
            //Check if Token is not expired
            $diffMins = Carbon::createFromFormat('Y-m-d H:i:s',$isTokenExists->created_at)->diffInMinutes(Carbon::now());

            if( $diffMins > 15 ){
                //When token is older than 15 minutes
                return redirect()->route('admin.forgot')->with('fail','Le lien de réinitialisation du mot de passe sur lequel vous avez cliqué a expiré. Veuillez demander un nouveau lien.');
            }
            $data = [
                'pageTitle'=>'Reset Password',
                'token'=>$token
            ];

            return view('back.pages.auth.reset',$data);
        }

     }//End method

       public function resetPasswordHandler(Request $request){
        //Validate the form
        $request->validate([
            'new_password'=>'required|min:5|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation'=>'required'
        ]);

        $dbToken = DB::table('password_reset_tokens')
                     ->where('token',$request->token)
                     ->first();

        //Get User details
        $user = User::where('email',$dbToken->email)->first();

        //Update Password
        User::where('email',$user->email)->update([
            'password'=>Hash::make($request->new_password)
        ]);

        //Send notification email to this user email address that contains new password
        $data = array(
            'user'=>$user,
            'new_password'=>$request->new_password,
            'changed_at'   => Carbon::now('Africa/Kinshasa')->isoFormat('dddd D MMMM YYYY [à] HH:mm:ss'),
        );

        $mail_body = view('email-templates.password-changes-template',$data)->render();

        $mailConfig = array(
            'recipient_address'=>$user->email,
            'recipient_name'=>$user->name,
            'subject'=>'Password Changed',
            'body'=>$mail_body
        );

        if( CMail::send($mailConfig) ){
            //Delete token from DB
            DB::table('password_reset_tokens')->where([
                'email'=>$dbToken->email,
                'token'=>$dbToken->token
            ])->delete();

            return redirect()->route('admin.login')->with('success','Terminé ! Votre mot de passe a bien été modifié. Utilisez votre nouveau mot de passe pour vous connecter au système.');
        }else{
            return redirect()->route('admin.reset_password_form',['token'=>$dbToken->token])->with('fail','Une erreur s\'est produite. Veuillez réessayer plus tard.');
        }
    }
}

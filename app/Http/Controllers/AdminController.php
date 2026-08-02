<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use SawaStacks\Utils\Kropify;
use App\Models\User;
use App\Models\GeneralSetting;

class AdminController extends Controller
{
    public function adminDashboard(Request $request)
    {
        $data = [
            'pageTitle' => 'Dashbaord'
        ];
        return view('back.pages.dashboard', $data);
    } //end Method


    public function logoutHandler(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('success', 'Vous êtes Déconnecté !!!');
    } //end Method

    public function profileView(Request $request)
    {

        $data = [
            'pageTitle' => 'Admin | Profile'
        ];

        return view('back.pages.profile', $data);
    } //End method

    public function updateProfilePicture(Request $request)
    {
        // dd('ici tout va bien ');

      //recupération du client
      $user = User::findOrFail(auth()->id());
      //Définition du chemin 
      $path = 'images/users/';
       //recupération du fichier sur le requette 
      $file = $request->file('profilePictureFile');
       //recupération de l'attribu de l'image
      $old_picture = $user->getAttributes()['picture'];
       //Définition du nom du fichier 
      $filename = 'IMG_' . uniqid() . '.png';
      //Enregistrement du fichier dans le storage via kropify
      $upload = Kropify::getFile($file, $filename)->maxWoH(255)->save($path);

      if ($upload) {
         //Delete old profile picture if exists
         if ($old_picture != null && File::exists(public_path($path . $old_picture))) {
            File::delete(public_path($path . $old_picture));
         }
         // Update Profile picture in DB
         $user->update(['picture' => $filename]);

         return response()->json(['status' => 1, 'message' => 'Your profile picture has been updated successfully.']);
      } else {
         return response()->json(['status' => 0, 'message' => 'Something went wrong.']);
      }
        
    } //End Method

    public function generalSettings(Request $request){

    $data = [
        'pageTitle'=>'Paramètre'
    ];

    return view('back.pages.settings',$data);
    }

     public function updateLogo(Request $request)
   {
      $settings = GeneralSetting::take(1)->first();

      if (!is_null($settings)) {
         $path = 'images/site/';
         $old_logo = $settings->site_logo;
         $file = $request->file('site_logo');
         $filename = 'logo_' . uniqid() . '.png';

         if ($request->hasFile('site_logo')) {
            $upload = $file->move(public_path($path), $filename);

            if ($upload) {
               if ($old_logo != null && File::exists(public_path($path . $old_logo))) {
                  File::delete(public_path($path . $old_logo));
               }

               $settings->update(['site_logo' => $filename]);

               return response()->json(['status' => 1, 'image_path' => $path . $filename, 'message' => 'Site logo has been updated successfully.']);
            } else {
               return response()->json(['status' => 0, 'Something went wrong in uploading new logo.']);
            }
         }
      } else {
         return response()->json(['status' => 0, 'message' => 'Make sure you updated general settings form first.']);
      }
   } // End Method
   
    public function updateFavicon(Request $request)
   {
      $settings = GeneralSetting::take(1)->first();

      if (!is_null($settings)) {
         $path = 'images/site/';
         $old_favicon = $settings->site_favicon;
         $file = $request->file('site_favicon');
         $filename = 'favicon_' . uniqid() . '.png';

         if ($request->hasFile('site_favicon')) {
            $upload = $file->move(public_path($path), $filename);

            if ($upload) {
               if ($old_favicon != null && File::exists(public_path($path . $old_favicon))) {
                  File::delete(public_path($path . $old_favicon));
               }

               $settings->update(['site_favicon' => $filename]);
               return response()->json(['status' => 1, 'message' => 'Site favicon has been updated successfully.', 'image_path' => $path . $filename]);
            } else {
               return response()->json(['status' => 0, 'Something went wrong in uploading new favicon.']);
            }
         }
      } else {
         return response()->json(['status' => 0, 'message' => 'Make sure you updated general settings tab first.']);
      }
   } //End Method
}

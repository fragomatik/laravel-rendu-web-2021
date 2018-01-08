<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function profile() {
        $articles = Auth::user()->articles;
        return view('profile.profile', ['user' => Auth::user(), 'articles' => $articles]);
    }

    public function picture() {
        return view('profile.update-picture', ['user' => Auth::user()]);
    }

    public function update(Request $request) {
        if($request->hasFile('picture')) {

            //Je recupere le nom de l'image actuelle du user
            $currentPicture = Auth::user()->picture;

            //Verifie si l'image est différente de l'image par defaut
            if($currentPicture !== "picture-default.jpg") {
                //Si elle l'est je crée son chemin et je la supprime afin de la remplacer par une autre
                $file_path = public_path().'/uploads/profile_pictures/'.$currentPicture;
                unlink($file_path);
            }

            //On recupere le fichier
            $profilePicture = $request->file('picture');

            //On isole l'extension original du fichier
            $extension = Input::file('picture')->getClientOriginalExtension();

            //On prepare le futur nom du fichier en le sécurisant un minimum
            $filename = rand(1111111,9999999).'.'.$extension;

            //On resize l'image et la stock dans un dossier
            Image::make($profilePicture)->resize(300,300)->save(public_path('/uploads/profile_pictures/' . $filename));

            $user = Auth::user();
            $user->picture = $filename;
            $user->save();

        }

        return view('profile.update-picture', ['user'=>Auth::user()]);
    }
}

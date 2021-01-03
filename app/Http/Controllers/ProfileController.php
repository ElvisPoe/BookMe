<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller {

    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index() {

        // Show profile edit page - Different for venue
        if(auth()->user()->isVenue())
            return view('profile.venue.index');

        return view('profile.user.index');

    }

    public function show($id) {

        $user = User::find($id);

        // Well... Show the correct profile to the correct user

        // If he is not a venue
        if(!auth()->user()->isVenue()){

            // He is the owner
            if($user == auth()->user())
                return redirect(route('profile')); // return $this->index();

            // He is guest
            return view('profile.user.show', [
                'user' => $user
            ]);
        }


        // If he is a venue
        if(auth()->user()->isVenue()){

            // He is the owner
            if($user == auth()->user())
                return redirect(route('profile')); // return $this->index();

            // He is guest
            return view('profile.venue.show', [
                'user' => $user
            ]);
        }

        return back();
    }

    public function update(Request $request) {

        if($request->username != auth()->user()->name){
            $request->user()->update([
                'name' => $request->username,
            ]);
        }
        $request->user()->userData()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthdate' => $request->birthdate,
            'address' => $request->address,
            'profile_image' => $request->profile_image,
            'services' => json_encode(explode(", ", $request->services)),
            'staff' => json_encode(explode(", ", $request->staff)),
        ]);
        return back();
    }

}
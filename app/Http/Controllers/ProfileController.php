<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Image;
use Inertia\Inertia;


class ProfileController extends Controller {

    public function index(){}

    public function create(){}

    public function store(Request $request){

        //Known bug: You can't do file uploads on patch and put requests in Laravel/Vue projects.
        if(!empty($request->id)) return $this->update($request, $request->id);

    }

    public function show($id){}
    
    public function edit($id){

        $profile = Profile::find($id)->toStandardClass();

        return Inertia::render("Profile/Edit", ["profile" => $profile]);
    }

    public function update(Request $request, $id) {

        $file = $request->file('file');

        if(!empty($file)){

            $image = new Image();
            $image->path = $file->store('profile-images');
            $image->title = $file->getClientOriginalName();
            $image->size = $file->getSize();
            $image->type = $file->extension();
            $image->save();
        }

        $profile = Profile::find($request->id);
        $profile->phone = $request->phone;
        $profile->about_info = $request->about_info;
        $profile->user->email = $request->email;

        if(!empty($request->priority)) $profile->priority = $request->priority;
        
        if(empty($profile->profile_image_id) && !empty($image->id)){

            $profile->profile_image_id = $image->id;
        }

        $profile->update();

        return redirect(route("dashboard"));
    }

    public function destroy($id){}
}

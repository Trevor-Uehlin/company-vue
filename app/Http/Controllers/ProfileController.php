<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use App\Models\Profile;
use App\Models\Image;
use Inertia\Inertia;


class ProfileController extends Controller {

    private const IMAGE_PIVOT_TABLE = "image_profile";
    private const IMAGE_STORAGE_DIRECTORY = "profile-images";

    public function index(){}

    public function create(){}

    public function store(Request $request){

        //Known bug: You can't do file uploads on patch and put requests in Laravel/Vue profiles.
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
            $image->path = $file->store(self::IMAGE_STORAGE_DIRECTORY);
            $image->title = $file->getClientOriginalName();
            $image->size = $file->getSize();
            $image->type = $file->extension();
            $image->pivot_table = self::IMAGE_PIVOT_TABLE;

            $image->save();
        }

        $profile = Profile::find($request->id);
        $profile->phone = $request->phone;
        $profile->about_info = $request->about_info;
        $profile->user->email = $request->email;

        DB::table(self::IMAGE_PIVOT_TABLE)->insert([
            'image_id' => $image->id,
            'profile_id'  => $profile->id
        ]);
        

        if(!empty($request->priority)) $profile->priority = $request->priority;
        
        if(empty($profile->profile_image_id) && !empty($image->id)){

            $profile->profile_image_id = $image->id;
            $image->priority = 1;
        }

        $profile->update();

        return redirect(route("dashboard"));
    }

    public function destroy($id) {

        $profile = Profile::find($id);

        $images = $profile->images;

        foreach($images as $image){

            Storage::delete($image->path);
            DB::table(self::IMAGE_PIVOT_TABLE)->where('profile_id', $profile->id)->delete();
            $image->delete();
        }

        $profile->delete();

        return redirect(route("dashboard"));
    }


    public function showGallary() {

        $images = auth()->user()->profile->toStandardClass()->images;

        return Inertia::render("Profile/Gallary", ["images" => $images]);
    }

    public function setImage($id) {

        $profile = auth()->user()->profile;

        $profile->profile_image_id = $id;
        $profile->update();

        return redirect(URL::previous());
    }
}

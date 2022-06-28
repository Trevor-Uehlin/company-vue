<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Images;
use App\Models\User;

class Profile extends Model {

    use HasFactory;

    protected $fillable = [
        "priority",
        "phone",
        "about_info",
        "profile_image_id"
    ];


    // Using a pivot table to get all the images associated with the project. This Project belongs to many Images.
    public function images() {

        return $this->belongsToMany(Image::class);
    }

    public function user() {
        
        return $this->hasOne(User::class);
    }


    public function email() {

        return $this->user->email;
    }


    public function username() {

        return $this->user->name;
    }

    public function profileImage() {

        return Image::find($this->profile_image_id);
    }

    public function toStandardClass() {

        $profile = new \stdClass();

        $profile->id = $this->id;
        $profile->priority = $this->priority;
        $profile->created_at = $this->created_at->format("D, F, Y");
        $profile->phone = $this->phone;
        $profile->email = $this->email();
        $profile->username = $this->username();
        $profile->about_info = $this->about_info;
        $profile->profile_image = $this->profileImage();
        $profile->images = $this->images;

        return $profile;
    }
}

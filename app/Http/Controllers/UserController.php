<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;

class UserController extends Controller {

    public function index() {

        $users = User::get();

        $usersArray = [];

        foreach($users as $user){

            $usersArray[] = $user->toStandardClass();
        }

        return Inertia::render("User/Index",["users" => $usersArray]);
    }


    public function create() {
        
        return Inertia::render("User/Create");
    }


    public function store(Request $request) {

        $profile = Profile::create([]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'profile_id' => $profile->id,
            'password' => Hash::make(str_random(10)),
        ]);
        

        $user->sendNewAccountNotification();


        return redirect(route("users.index"));
    }

    public function show($id) {
        
        $user = User::findOrFail($id);

        return Inertia::render("User/Edit", ["user" => $user]);
    }

    public function edit($id) {}

    public function update(Request $request, $id) {

        $user = User::find($id);

        $params = $request->all();

        $user->name = $params["name"];
        $user->email = $params["email"];
        $user->role_id = $params["role_id"];

        $user->update();

        return redirect(route("users.index"));
    }


    public function destroy($id) {

        $user = User::findOrFail($id);
        $profile = Profile::findOrFail($user->profile_id);

        $profile->delete();
        $user->delete();

        return redirect(route("users.index"));
    }

    public function deleteAccount() {

        $user = auth()->user();
        $profile = $user->profile;
        $images = $profile->images;

        $profile->delete();
        $user->delete();

        return redirect("logout");
    }
}

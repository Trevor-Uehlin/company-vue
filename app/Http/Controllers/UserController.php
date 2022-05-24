<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Carbon\Carbon;
use App\Models\User;

class UserController extends Controller {

    public function index() {

        $users = User::get();

        $usersArray = [];

        foreach($users as $user){

            $usersArray[] = $user->toStandardClass();
        }

        $currentUser = Auth::user();

        return Inertia::render("User/Index",[
            "users" => $usersArray,
            "currentUser" => $currentUser
        ]);
    }


    public function create() {
        
        return Inertia::render("User/Create");
    }


    public function store(Request $request) {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
            'password' => Hash::make(str_random(10)),
        ]);
        

        $user->sendNewAccountNotification();


        return redirect(route("users.index"));
    }

    public function show($id) {
        
        $user = User::findOrFail($id)->toStandardClass();

        var_dump($user);exit;

        return view("user.edit", compact("user"));
    }

    public function edit($id) {}

    public function update(Request $request, $id) {

        $user = User::find($id);

        $params = $request->all();

        $user->name = $params["name"];
        $user->email = $params["email"];
        $user->role_id = $params["user_type"];

        if(!empty($params["password"])) $user->password = Hash::make($_POST["password"]);

        $user->update();

        return redirect(route("users.index"));
    }


    public function destroy($id) {

        $user = User::findOrFail($id);

        $user->delete();

        return redirect(route("users.index"));
    }
}

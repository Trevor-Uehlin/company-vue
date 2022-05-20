<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller {

    public function index() {

        $users = User::get();
        $currentUser = Auth::user();

        return view("user.index", compact("users", "currentUser"));
    }


    public function create() {
        
        return view("user.create");
    }


    public function store(Request $request) {

        $user = User::create([
            'name' => $_POST["name"],
            'email' => $_POST["email"],
            'role_id' => $_POST["user_type"],
            'password' => Hash::make($_POST["password"]),
        ]);
        

        $user->sendNewAccountNotification();


        return redirect(route("users.index"));
    }

    public function show($id) {
        
        $user = User::findOrFail($id);

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

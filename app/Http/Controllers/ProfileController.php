<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\Image;
use Inertia\Inertia;


class ProfileController extends Controller {

    public function index(){}

    public function create(){}

    public function store(Request $request){}

    public function show($id){}

    public function edit($id){

        $profile = Profile::find($id)->toStandardClass();

        //var_dump($profile);exit;

        return Inertia::render("Profile/Edit", ["profile" => $profile]);
    }

    public function update(Request $request, $id){}

    public function destroy($id){}
}

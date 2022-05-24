<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMe;
use Inertia\Inertia;

class EmailController extends Controller {

    public function index() {

        return Inertia::render("Contact/Create");
    }


    public function create() {}


    public function store(Request $request) {

        // Need some validation of the request.
        $result = Mail::to(env('APP_EMAIL_ADDRESS'))->send(new ContactMe($request));

        return Inertia::render("Contact/Success");
    }

    public function show($id) {}


    public function edit($id) {}


    public function update(Request $request, $id) {}


    public function destroy($id) {}
}

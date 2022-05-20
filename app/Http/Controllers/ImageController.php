<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageController extends Controller {

    public function index() {}


    public function create() {}


    public function store(Request $request) {}


    public function show($id) {}


    public function edit($id) {}


    public function update(Request $request, $id) {}


    public function destroy($id) {

        $image = Image::find($id);

        Storage::delete($image->path);
        DB::table('image_project')->where('image_id', $image->id)->delete();
        $image->delete();

        return redirect(route("projects"));
    }
}

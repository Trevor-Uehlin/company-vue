<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Project;
use App\Models\Image;
use App\Models\User;

class ProjectController extends Controller {

    public function __construct() {

        $this->middleware('admin')->except('index');
    }

    public function index() {

        $user = auth()->user();

        $user = empty($user) ? new User() : $user->toStandardClass();

        $projects = Project::orderBy("priority")->get();

        $pArray = [];

        foreach($projects as $p) {
            $pArray[] = $p->toStandardClass();
        }

        return Inertia::render("Projects/Index", [
            "projects" => $pArray,
            "user"     => $user 
        ]);
    }


    public function create() {

        return Inertia::render("Projects/Create");
    }


    public function store(Request $request) {

        //Known bug: You can't do file uploads on patch and put requests in Laravel/Vue projects.
        if(!empty($request->id)) return $this->update($request, $request->id);

        $project = new Project();
        $project->title = $request['title'];
        $project->organization = $request['organization'];
        $project->description = $request['description'];
        $project->url = $request['url'];
        $project->priority = $request['priority'];

        $file = $request->file('file');

        $image = new Image();
        $image->path = $file->store('project-images');
        $image->title = $file->getClientOriginalName();
        $image->size = $file->getSize();
        $image->type = $file->extension();

        $project->save();
        $image->save();

        DB::table('image_project')->insert([
            'image_id' => $image->id,
            'project_id'  => $project->id
        ]);

        return redirect(route('projects'));
    }


    public function show($id) {

        $project = Project::find($id)->toStandardClass();

        return Inertia::render("Projects/Edit", ["project" => $project]);
    }


    public function edit($id) {

        var_dump("edit");exit;
    }


    public function update(Request $request, $id) {

        $project = Project::find($id);
        $project->title = $request['title'];
        $project->organization = $request['organization'];
        $project->description = $request['description'];
        $project->url = $request['url'];
        $project->priority = $request['priority'];
        $project->update();

        $file = $request->file('file');

        if(!empty($file)) {

            $image = new Image();
            $image->path = $file->store('project-images');
            $image->title = $file->getClientOriginalName();
            $image->size = $file->getSize();
            $image->type = $file->extension();
    
    
            $image->save();
    
            DB::table('image_project')->insert([
                'image_id' => $image->id,
                'project_id'  => $project->id
            ]);
        }

        return redirect(route('projects'));
    }

    public function destroy($id) {

        $project = Project::find($id);

        $images = $project->images;

        foreach($images as $image){

            Storage::delete($image->path);
            DB::table('image_project')->where('project_id', $project->id)->delete();
            $image->delete();
        }

        $project->delete();

        return redirect(route("projects"));
    }
}

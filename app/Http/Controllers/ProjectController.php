<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Project;
use App\Models\Image;

class ProjectController extends Controller {

    public function __construct() {

        $this->middleware('admin')->except('index');
    }

    public function index() {

        $projects = Project::orderBy("priority")->get();

        return view('projects.index', compact("projects"));
    }


    public function create() {

        return view('projects.create');
    }


    public function store(Request $request) {

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

        $project = Project::find($id);

        return view('projects.edit', compact('project'));
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

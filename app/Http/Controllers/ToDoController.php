<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteToDoItem;
use Inertia\Inertia;

class ToDoController extends Controller {

    public function __construct() {

        $this->middleware('admin');
    }

    public function index() {

        $items = SiteToDoItem::orderBy('priority')->get();

        return Inertia::render('ToDo/Index', ['items' => $items]);
    }

    public function create() {

        return Inertia::render('ToDo/Create');
    }

    public function store(Request $request) {


        SiteToDoItem::create([
            'priority' => $request->priority,
            'description' => $request->description,
            'url' => $request->url
        ]);

        return redirect(route('toDo.index'));
    }

    public function show($id) {

        $item = SiteToDoItem::find($id);

        return Inertia::render('ToDo/Edit', ['item' => $item]);
    }

    public function edit($id) {

        var_dump("edit");exit;
    }

    public function update(Request $request, $id) {

        $task = SiteToDoItem::find($id);
        $task->priority = $request->priority;
        $task->description = $request->description;
        $task->url = $request->url;

        $task->update();

        return redirect(route('toDo.index'));
    }

    public function destroy($id) {

        $item = SiteToDoItem::find($id);

        $item->delete();

        return redirect(route('toDo.index'));
    }
}

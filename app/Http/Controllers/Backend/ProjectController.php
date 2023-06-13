<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('backend.project.index', compact('projects'));
    }

    public function create()
    {
        return view('backend.project.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                "image" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            ]);

            $project = new Project;
            if($request->hasFile("image")) {
                $path = storage_path("uploads/project/");
                if(!is_dir($path)) {
                    mkdir($path,755,true);
                }
                $logo = $request->file('image');
                $newName = "project_".date("YmdHis").".".$request->image->extension();
                $move = $logo->move($path, $newName);
                $project->image = $newName;
            }
            $project->save();

            return redirect()->route('admin.project.index')->with('success', 'Project has been successfuly created');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('backend.project.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        try {
            $request->validate([
                "image" => "image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            ]);
            if($request->hasFile("image")) {
                $path = storage_path("uploads/project/");
                if(!is_dir($path)) {
                    mkdir($path,755,true);
                }
                $logo = $request->file('image');
                $newName = "project_".date("YmdHis").".".$request->image->extension();
                $move = $logo->move($path, $newName);
                $project->image = $newName;
            }
            $project->update();

            return redirect()->route('admin.project.index')->with('success', 'Project has been successfuly updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return redirect()->route('admin.project.index')->with('success', 'Project has been successfuly deleted');
    }
}

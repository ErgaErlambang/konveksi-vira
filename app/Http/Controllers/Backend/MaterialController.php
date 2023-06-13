<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('backend.material.index', compact('materials'));
    }

    public function create()
    {
        return view('backend.material.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                "name" => "required",
                "type" => "required",
                "stock" => "required",
            ]);

            $material = new Material;
            $material->name = $request->name;
            $material->type = $request->type;
            $material->stock = $request->stock;
            $material->save();

            return redirect()->route('admin.material.index')->with('success', 'Material has been successfuly created');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $material = Material::findOrFail($id);
        return view('backend.material.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);
        try {
            $request->validate([
                "name" => "required",
                "type" => "required",
                "stock" => "required",
            ]);

            $material->name = $request->name;
            $material->type = $request->type;
            $material->stock = $request->stock;
            $material->update();

            return redirect()->route('admin.material.index')->with('success', 'Material has been successfuly updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return redirect()->route('admin.material.index')->with('success', 'Material has been successfuly deleted');
    }
}

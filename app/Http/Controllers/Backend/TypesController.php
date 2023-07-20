<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Types;

class TypesController extends Controller
{
    public function index()
    {
        $materials = Types::all();
        return view('backend.types.index', compact('materials'));
    }

    public function create()
    {
        return view('backend.types.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                "name" => "required",
                "usable" => "required"
            ]);

            $material = new Types;
            $material->name = $request->name;
            $material->usable = $request->usable;
            $material->save();

            return redirect()->route('admin.types.index')->with('success', 'Type has been successfuly created');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $material = Types::findOrFail($id);
        return view('backend.types.edit', compact('material'));
    }

    public function update(Request $request, $id)
    {
        $material = Types::findOrFail($id);
        try {
            $request->validate([
                "name" => "required",
                "usable" => "required"
            ]);

            $material->name = $request->name;
            $material->usable = $request->usable;
            $material->update();

            return redirect()->route('admin.types.index')->with('success', 'Type has been successfuly updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $material = Types::findOrFail($id);
        $material->delete();
        return redirect()->route('admin.types.index')->with('success', 'Type has been successfuly deleted');
    }
}

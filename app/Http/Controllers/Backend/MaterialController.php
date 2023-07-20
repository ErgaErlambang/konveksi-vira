<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Material;
use App\Models\Types;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::all();
        return view('backend.material.index', compact('materials'));
    }

    public function create()
    {
        $types = Types::all();
        return view('backend.material.create', compact('types'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                "name" => "required",
                "type" => "required",
                "stock" => "required",
                "price" => "required"
            ]);

            $material = new Material;
            $material->name = $request->name;
            $material->type_id = $request->type;
            $material->stock = $request->stock;
            $material->price = $request->price;
            $material->save();

            return redirect()->route('admin.material.index')->with('success', 'Material has been successfuly created');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $types = Types::all();
        $material = Material::findOrFail($id);
        return view('backend.material.edit', compact('material', 'types'));
    }

    public function update(Request $request, $id)
    {
        $material = Material::findOrFail($id);
        try {
            $request->validate([
                "name" => "required",
                "type" => "required",
                "stock" => "required",
                "price" => "required"
            ]);

            $material->name = $request->name;
            $material->type_id = $request->type;
            $material->stock = $request->stock;
            $material->price = $request->price;
            $material->update();

            return redirect()->route('admin.material.index')->with('success', 'Material has been successfuly updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        $material = Material::findOrFail($id);
        $material->delete();
        return redirect()->route('admin.material.index')->with('success', 'Material has been successfuly deleted');
    }

    public function get_material()
    {
        $materials = Material::all();
        return  response([
            "status" => true,
            "message" => "Material found",
            "data" => $materials
        ], 200);
    }

    public function getMaterialPrice(Request $request)
    {
        try {
            $type = Types::find($request->typeId);
            if(empty($type)) {
                throw new \Exception("Type not Found");
            }
            return response([
                "status" => true,
                "data" => $type
            ], 200);
        } catch (\Exception $e) {
            return response([
                "status" => false,
                "message" => $e->getMessage()
            ], 500);
        }


    }
}

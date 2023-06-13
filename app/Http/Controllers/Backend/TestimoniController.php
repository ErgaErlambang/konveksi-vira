<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::all();
        return view('backend.testimoni.index', compact('testimonis'));
    }

    public function create()
    {
        return view('backend.testimoni.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                "image" => "required|image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            ]);

            $testimoni = new Testimoni;
            if($request->hasFile("image")) {
                $path = storage_path("uploads/testi/");
                if(!is_dir($path)) {
                    mkdir($path,755,true);
                }
                $logo = $request->file('image');
                $newName = "testi_".date("YmdHis").".".$request->image->extension();
                $move = $logo->move($path, $newName);
                $testimoni->image = $newName;
            }
            $testimoni->save();

            return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni has been successfuly created');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function edit($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        return view('backend.testimoni.edit', compact('testimoni'));
    }

    public function update(Request $request, $id)
    {
        $testimoni = Testimoni::findOrFail($id);
        try {
            $request->validate([
                "image" => "image|mimes:jpg,png,jpeg,gif,svg|max:2048",
            ]);
            if($request->hasFile("image")) {
                $path = storage_path("uploads/testi/");
                if(!is_dir($path)) {
                    mkdir($path,755,true);
                }
                $logo = $request->file('image');
                $newName = "testi_".date("YmdHis").".".$request->image->extension();
                $move = $logo->move($path, $newName);
                $testimoni->image = $newName;
            }
            $testimoni->update();

            return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni has been successfuly updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function delete($id)
    {
        $testimoni = Testimoni::findOrFail($id);
        $testimoni->delete();
        return redirect()->route('admin.testimoni.index')->with('success', 'Testimoni has been successfuly deleted');
    }
}

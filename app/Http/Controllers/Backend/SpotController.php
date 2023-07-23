<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Centre_Point;
use App\Models\Spot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.Spot.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centerPoint = Centre_Point::get()->first();
        return view('backend.Spot.create', ['centerPoint' => $centerPoint]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'coordinate' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'file|image|mimes:png,jpg,jpeg'
        ]);

        $spot = new Spot;
        if ($request->hasFile('image')) {

            /**
             * Upload file to public folder
             */
            $file = $request->file('image');
            $uploadFile = $file->hashName();
            $file->move('upload/spots/', $uploadFile);
            $spot->image = $uploadFile;

            /**
             * Upload file image to storage
             */
            // $file = $request->file('image');
            // $file->storeAs('public/ImageSpots',$file->hashName());
            // $spot->image = $file->hashName();
        }

        $spot->name = $request->input('name');
        $spot->slug = Str::slug($request->name, '-');
        $spot->description = $request->input('description');
        $spot->coordinates = $request->input('coordinate');
        $spot->save();

        if ($spot) {
            return to_route('spot.index')->with('success', 'Data berhasil disimpan');
        } else {
            return to_route('spot.index')->with('error', 'Data gagal disimpan');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spot $spot)
    {
        $centerPoint = Centre_Point::get()->first();
        return view('backend.Spot.edit', [
            'centerPoint' => $centerPoint,
            'spot' => $spot
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spot $spot)
    {
        $this->validate($request, [
            'coordinate' => 'required',
            'name' => 'required',
            'description' => 'required',
            'image' => 'file|image|mimes:png,jpg,jpeg'
        ]);

        if ($request->hasFile('image')) {

            /**
             * Hapus file image pada folder public/upload/spots
             */
            if (File::exists('upload/spots/' . $spot->image)) {
                File::delete('upload/spots/' . $spot->image);
            }

            /**
             * Proses upload file image ke folder public/upload/spots
             */
            $file = $request->file('image');
            $uploadFile = $file->hashName();
            $file->move('upload/spots/', $uploadFile);
            $spot->image = $uploadFile;

            /**
             * Proses hapus & upload file image ke folder public/upload/spots
             */
            // Storage::disk('local')->delete('public/ImageSpots/' . ($spot->image));
            // $file = $request->file('image');
            // $file->storeAs('public/ImageSpots', $file->hashName());
            // $spot->image = $file->hashName();
        }

        $spot->name = $request->input('name');
        $spot->slug = Str::slug($request->name, '-');
        $spot->description = $request->input('description');
        $spot->coordinates = $request->input('coordinate');
        $spot->update();

        if ($spot) {
            return to_route('spot.index')->with('success', 'Data berhasil diupdate');
        } else {
            return to_route('spot.index')->with('error', 'Data gagal diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $spot = Spot::findOrFail($id);
        if (File::exists('upload/spots/' . $spot->image)) {
            File::delete('upload/spots/' . $spot->image);
        }

        //Storage::disk('local')->delete('public/ImageSpots/' . ($spot->image));
        $spot->delete();
        return redirect()->back();
    }
}

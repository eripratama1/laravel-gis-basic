<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Centre_Point;
use App\Models\Spot;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
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
        return view('backend.Spot.create',['centerPoint' => $centerPoint]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
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
            $file->move('upload/spots/',$uploadFile);
            $spot->image = $uploadFile;

            /**
             * Upload file image to storage
             */
            // $file = $request->file('image');
            // $file->storeAs('public/ImageSpots',$file->hashName());
            // $spot->image = $file->hashName();
        }

        $spot->name = $request->input('name');
        $spot->slug = Str::slug($request->name,'-');
        $spot->description = $request->input('description');
        $spot->coordinates = $request->input('coordinate');
        $spot->save();

        if ($spot) {
            return to_route('spot.index')->with('success','Data berhasil disimpan');
        } else {
            return to_route('spot.index')->with('error','Data gagal disimpan');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

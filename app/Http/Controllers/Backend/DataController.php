<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Centre_Point;
use App\Models\Spot;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function centrepoint()
    {
        $centrepoint = Centre_Point::latest()->get();
        return datatables()->of($centrepoint)
        ->addColumn('action','backend.CentrePoint.action')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }

    public function spot()
    {
        $spot = Spot::latest()->get();
        return datatables()->of($spot)
        ->addColumn('action','backend.Spot.action')
        ->addIndexColumn()
        ->rawColumns(['action'])
        ->toJson();
    }
}

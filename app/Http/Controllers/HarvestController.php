<?php

namespace App\Http\Controllers;

use App\Models\Harvest;
use Illuminate\Http\Request;

class HarvestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Harvest',
            
        ];
        return view('dashboard.harvest.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Harvest $harvest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Harvest $harvest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Harvest $harvest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Harvest $harvest)
    {
        //
    }
}

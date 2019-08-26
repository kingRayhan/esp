<?php

namespace App\Http\Controllers;

use App\Slip;
use Illuminate\Http\Request;
use App\Http\Resources\SlipResource;


class SlipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $slips =  SlipResource::collection(Slip::all());
        // return $slips;
        return view('slip.index');
    }
    public function reportApi()
    {
        $slips =  SlipResource::collection(Slip::latest()->get());
        return $slips;
        // return view('slip.index', compact('slips'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slip  $slip
     * @return \Illuminate\Http\Response
     */
    public function show(Slip $slip)
    {
        // return $slip->orders;
        return view('slip.slip', compact('slip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slip  $slip
     * @return \Illuminate\Http\Response
     */
    public function edit(Slip $slip)
    { }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slip  $slip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slip $slip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slip  $slip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slip $slip)
    {
        //
    }
}

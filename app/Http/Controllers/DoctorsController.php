<?php

namespace App\Http\Controllers;

use App\Doctor;
// use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use App\Http\Resources\CustomerResource;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('doctors.index');
    }

    public function indexApi()
    {
        return CustomerResource::collection(Doctor::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        Doctor::create([
            'name' => $request->name,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'note' => $request->note
        ]);
        return redirect()->route('doctors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        return view('doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        return view('doctors.edit', compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, Doctor $doctor)
    {
        Doctor::find($doctor->id)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
                'number' => $request->number,
                'address' => $request->address,
                'note' => $request->note
            ]);
        return redirect()->route('doctors.show', $doctor->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $customer)
    {
        //
    }


    function shoppinghistory(Doctor $doctor)
    {
        return view('doctors.shopping_history', compact('doctor'));
    }
}

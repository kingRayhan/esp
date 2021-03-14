<?php

namespace App\Http\Controllers;

use App\Http\Resources\SlipResource;
use App\Sell;
use App\Slip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class SlipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slips = Slip::with(['doctor']);
        $duplicateSlips = Slip::with(['doctor']);
        $slips->withCount(['orders as total_sales' => function ($q) {
            $q->select(DB::raw('SUM(sell_price)'));
        }]);
        $duplicateSlips->withCount(['orders as total_sales' => function ($q) {
            $q->select(DB::raw('SUM(sell_price)'));
        }]);
        $from = date(request()->query('from_date'));
        $to = date(request()->query('to_date'));
        if (request()->query('mode') == 'date') {
            $slips->whereBetween('bill_date', [$from, $to]);
            $duplicateSlips->whereBetween('bill_date', [$from, $to]);
        } elseif (request()->query('mode') == 'doctor') {
            $slips->whereHas('doctor', function ($q) {
                $q->where('id', request()->query('doctor'));
            });
            $duplicateSlips->whereHas('doctor', function ($q) {
                $q->where('id', request()->query('doctor'));
            });
        } elseif (request()->query('mode') == 'doctor_and_date') {
            $slips->whereBetween('bill_date', [$from, $to])->whereHas('doctor', function ($q) {
                $q->where('id', request()->query('doctor'));
            });
            $duplicateSlips->whereBetween('bill_date', [$from, $to])->whereHas('doctor', function ($q) {
                $q->where('id', request()->query('doctor'));
            });
        }
        $grandTotal = Sell::whereIn('slip_id', $duplicateSlips->select(['id'])->get()->pluck('id'))->sum('sell_price');
        $grandDiscounts = $slips->sum('discount');
        $grandNetBill = (int)$grandTotal - (int)$grandDiscounts;
        $finalslips = SlipResource::collection($slips->latest()->paginate());

        return view('slip.index', ['slips' => $finalslips, 'grandTotal' => (int)$grandTotal, 'grandDiscounts' => $grandDiscounts, 'grandNetBill' => $grandNetBill]);
    }

    public function reportApi()
    {
        $slips = SlipResource::collection(Slip::latest()->get());
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Slip $slip
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
     * @param \App\Slip $slip
     * @return \Illuminate\Http\Response
     */
    public function edit(Slip $slip)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Slip $slip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slip $slip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Slip $slip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slip $slip)
    {
        //
    }
}

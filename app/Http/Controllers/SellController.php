<?php

namespace App\Http\Controllers;

use App\Http\Resources\SellResource;
use App\Sell;
use App\Slip;
use Illuminate\Http\Request;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sells = Sell::with(['product', 'slip']);
        if (request()->query('mode') == 'date') {
            $from = date(request()->query('from_date'));
            $to = date(request()->query('to_date'));

            $sells = $sells->whereHas('slip', function ($q) use ($from, $to) {
                $q->whereBetween('bill_date', [$from, $to]);
            });
        } elseif (request()->query('mode') == 'test') {
            $sells = $sells->whereHas('product', function ($q) {
                $q->where('id', request()->query('test'));
            });
        } elseif (request()->query('mode') == 'test_and_date') {
            $from = date(request()->query('from_date'));
            $to = date(request()->query('to_date'));
            $sells = $sells->whereHas('slip', function ($q) use ($from, $to) {
                $q->whereBetween('bill_date', [$from, $to]);
            })->whereHas('product', function ($q) {
                $q->where('id', request()->query('test'));
            });;
        }
        $sum = $sells->sum('sell_price');
        $sells = SellResource::collection($sells->orderBy('id', 'desc')->paginate(15));

        return view('sells.index', ['sells' => $sells, 'total_sales' => $sum]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('sells.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Sell $sell
     * @return \Illuminate\Http\Response
     */
    public function show(Sell $sell)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Sell $sell
     * @return \Illuminate\Http\Response
     */
    public function edit(Sell $sell)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Sell $sell
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sell $sell)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Sell $sell
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sell $sell)
    {
        //
    }

    public function sellProduct(Request $request)
    {
        $slip = Slip::create([
            'customer_name' => $request->customer_name,
            'customer_age' => $request->customer_age,
            'customer_gender' => $request->customer_gender,
            'discount' => $request->discount,
            'paid' => $request->paid,
            'bill_date' => $request->bill_date,
            'doctor_id' => $request->doctor_id ? $request->doctor_id : null,
        ]);
        $products = json_decode($request->getContent(), true);
        foreach ($products['bags'] as $product) {
            Sell::create([
                'product_id' => $product['product_id'],
                'sell_price' => $product['price'],
                'slip_id' => $slip->id
            ]);
        }
        return $slip;
    }
}

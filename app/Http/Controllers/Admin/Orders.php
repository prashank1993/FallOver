<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Orders extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function influencerOrders(Request $request, $slug)
    {
        # code...
        $orderType = [
            'active'            => 'Active',
            'late'              => 'Late',
            'delivered'         => 'Delivered',
            'completed'         => 'Completed',
            'cancelled'         => 'Cancelled',
        ];
        $data['title'] = isset($slug) ? $orderType[$slug] : '';

        return view('admin.orders', $data);
    }

    public function brandOrders(Request $request, $slug)
    {
        # code...
        $orderType = [
            'active'            => 'Active',
            'late'              => 'Late',
            'delivered'         => 'Delivered',
            'completed'         => 'Completed',
            'cancelled'         => 'Cancelled',
        ];
        $data['title'] = isset($slug) ? $orderType[$slug] : '';

        return view('admin.orders', $data);
    }
}

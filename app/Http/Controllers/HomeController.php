<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expense;
use App\Models\Revenue;

class HomeController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list           = [];
        $today          = \Carbon\Carbon::today();
        $expense        = Expense::whereYear('date',$today)->whereMonth('date',$today)->sum('value');
        $revenue        = Revenue::whereYear('date',$today)->whereMonth('date',$today)->sum('value');
        $listRevenue    = Revenue::whereYear('date',$today)->orderBy('date')->get();
        $month          = (count($listRevenue) > 0) ? strval(date('m/Y',strtotime($listRevenue[0]['date']))) : 0;
        $list[$month]   = 0;
        
        foreach($listRevenue as $item)
        {            
            if(date('m/Y',strtotime($item->date)) != $month)
            {
                $month = strval(date('m/Y',strtotime($item->date)));
                $list[$month] = 0;
            }
            $list[$month] = $list[$month] + $item->value;   
        }
        dd($list); 

        return view('home')->with(['expense' => $expense,'revenue' => $revenue,'dateToday' => $today]);
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

    protected function Save(Request $request,$home = null)
    {
    
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
}

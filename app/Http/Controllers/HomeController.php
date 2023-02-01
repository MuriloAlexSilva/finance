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
        $list                               = [];
        $today                              = \Carbon\Carbon::today();
        $expense                            = Expense::whereYear('date',$today)->whereMonth('date',$today)->sum('value');
        $listExpense                        = Expense::whereYear('date',$today)->orderBy('date')->get();
        $revenue                            = Revenue::whereYear('date',$today)->whereMonth('date',$today)->sum('value');
        $listRevenue                        = Revenue::whereYear('date',$today)->orderBy('date')->get();
        $monthRevenue                       = (count($listRevenue) > 0) ? strval(date('m/Y',strtotime($listRevenue[0]['date']))) : 0;
        $monthExpense                       = (count($listExpense) > 0) ? strval(date('m/Y',strtotime($listExpense[0]['date']))) : 0;
        $list['Revenue'][$monthRevenue]     = 0;
        $list['Expense'][$monthExpense]     = 0;
        
        foreach($listRevenue as $item)
        {            
            if(date('m/Y',strtotime($item->date)) != $monthRevenue)
            {
                $monthRevenue = strval(date('m/Y',strtotime($item->date)));
                $list['Revenue'][$monthRevenue] = 0;
            }
            $list['Revenue'][$monthRevenue] = $list['Revenue'][$monthRevenue] + $item->value;   
        }
        foreach($listExpense as $item)
        {            
            if(date('m/Y',strtotime($item->date)) != $monthExpense)
            {
                $monthExpense = strval(date('m/Y',strtotime($item->date)));
                $list['Expense'][$monthExpense] = 0;
            }
            $list['Expense'][$monthExpense] = $list['Expense'][$monthExpense] + $item->value;   
        }

        // dd($list['Revenue']); 
        $revenueChart = json_encode($list['Revenue']);
        $expenseChart = json_encode($list['Expense']);

        return view('home')->with([ 'expense'   => $expense,
                                    'revenueChart'   => $revenueChart,
                                    'expenseChart'   => $expenseChart,
                                    'revenue'   => $revenue,
                                    'list'      => $list,
                                    'dateToday' => $today
                                  ]);
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

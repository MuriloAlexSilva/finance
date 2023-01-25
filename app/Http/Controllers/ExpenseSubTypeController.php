<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseSubTypeRequest;
use App\Models\ExpenseSubType;
use App\User;
use Illuminate\Http\Request;

use Auth;

class ExpenseSubTypeController extends BaseController
{
    protected $layoutName   = "expense_sub_type";
    protected $modelName    = "App\Models\ExpenseSubType";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenseSubTypeList = ExpenseSubType::orderBy('name')->paginate(10);

        // $ExpenseSubType->paginate(1)->withQueryString();

        return $this->RenderIndexPage(['expenseSubTypeList' => $expenseSubTypeList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     return $this->RenderEditPage();
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseSubTypeRequest $request)
    {
        // dd($request);
        return $this->commonStore($request);
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

    protected function edit($id)
    {
        try 
        {
            $item = ExpenseSubType::findOrFail($id);

            return $this->RenderEditPage(['item' => $item]);

        } catch (\Throwable $th) {
            return back()->withError("Não foi possível encontrar o registro");
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseSubTypeRequest $request, $id)
    {
        if($data = $request->validated())
            return $this->commonUpdate($request,$id);
    }

    //---------------------------------------------------------------------------------
    protected function Save(Request $request, $expenseSubType = null)
    {
        try 
        {
            $isStore = $expenseSubType == null;
            // dd($expenseSubType);

            if($isStore)
                $expenseSubType = new ExpenseSubType();

            $expenseSubType->name = $request["name"];
            $expenseSubType->created_by =  Auth::user()->id;
            // $expenseSubType->id_expense_sub_type =1 ;
            // dd($expenseSubType);
            $expenseSubType->save();
            // dd($expenseSubType);
            return back();
        } 
        catch (\Throwable $th) 
        {
            return back()->withError("Houve um erro ao salvar o registro");
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        try 
        {
            $expenseSubType = ExpenseSubType::findOrFail($id);
            $expenseSubType->deleted_by = 1;//Colocar o Auth::user() depois
            $expenseSubType->save();
            $expenseSubType->delete();

            return back();
        }
        catch (\Throwable $th) 
        {
            return back();
        }
    }
}

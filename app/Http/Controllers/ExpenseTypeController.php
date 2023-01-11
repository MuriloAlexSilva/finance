<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseTypeRequest;
use App\Models\ExpenseType;
use App\User;
use Illuminate\Http\Request;

class ExpenseTypeController extends BaseController
{
    protected $layoutName   = "expense_type";
    protected $modelName    = "App\Models\ExpenseType";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenseTypeList = ExpenseType::orderBy('name')->paginate(10);

        // $ExpenseType->paginate(1)->withQueryString();

        return $this->RenderIndexPage(['expenseTypeList' => $expenseTypeList]);
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
    public function store(ExpenseTypeRequest $request)
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
            $item = ExpenseType::findOrFail($id);

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
    public function update(ExpenseTypeRequest $request, $id)
    {
        if($data = $request->validated())
            return $this->commonUpdate($request,$id);
    }

    //---------------------------------------------------------------------------------
    protected function Save(Request $request, $expenseType = null)
    {
        try 
        {
            $isStore = $expenseType == null;

            if($isStore)
                $expenseType = new ExpenseType();

            $expenseType->name = $request["name"];
            $expenseType->created_by = 1;//COlocar o usuario logado
            $expenseType->save();
            // dd($expenseType);
                
            return back();
        } 
        catch (\Throwable $th) 
        {
            dd($th);
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
            $expenseType = ExpenseType::findOrFail($id);
            $expenseType->deleted_by = 1;//Colocar o Auth::user() depois
            $expenseType->save();
            $expenseType->delete();

            return back();
        }
        catch (\Throwable $th) 
        {
            return back();
        }
    }
}

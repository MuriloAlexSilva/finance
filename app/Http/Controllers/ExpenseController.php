<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExpenseRequest;
use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\ExpenseSubType;
use App\User;
use Illuminate\Http\Request;

class ExpenseController extends BaseController
{
    protected $layoutName   = "expense";
    protected $modelName    = "App\Models\Expense";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('ta aqui');
        $expenseList = Expense::orderBy('date','DESC')->paginate(10);

        // $Expense->paginate(1)->withQueryString();

        return $this->RenderIndexPage(['expenseList' => $expenseList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // dd('ta');
        $expenseTypeList    = ExpenseType::orderBy('name')->get();
        // dd($expenseTypeList);
        $expenseSubTypeList = ExpenseSubType::orderBy('name')->get();
        // dd($expenseTypeList);
        return $this->RenderEditPage([
                                        'expenseTypeList'       => $expenseTypeList,
                                        'expenseSubTypeList'    => $expenseSubTypeList
                                    ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
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
        // dd($id);   
        try 
        {
            $item               = Expense::findOrFail($id);
            // dd($item);
            $expenseTypeList    = ExpenseType::orderBy('name')->get();
            // dd($expenseTypeList);
            $expenseSubTypeList = ExpenseSubType::orderBy('name')->get();
            // dd($expenseTypeList);
            return $this->RenderEditPage([
                                            'item'                  => $item,
                                            'expenseTypeList'       => $expenseTypeList,
                                            'expenseSubTypeList'    => $expenseSubTypeList
                                        ]);

        } catch (\Throwable $th) {
            dd($th);
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
    public function update(ExpenseRequest $request, $id)
    {
        if($data = $request->validated())
            return $this->commonUpdate($request,$id);
    }

    //---------------------------------------------------------------------------------
    protected function Save(Request $request, $expense = null)
    {
        // dd('ta no save');
        // dd($request);
        try 
        {
            $isStore = $expense == null;

            if($isStore)
                $expense = new Expense();

            $expense->id_expense_type = $request['id_expense_type'];
            $expense->id_expense_sub_type = $request['id_expense_sub_type'];
            // $payment->value = str_replace(['.', ','], ['', '.'], $request["value"]); // Essa linha remove os '.' e substitui ',' por '.' deixando 999.999,99 foramtado como 999999.99
            $expense->value = $request['value'];
            $expense->date = $request['date'];//Validar a data
            $expense->description = $request['description'];
            $expense->created_by = 1;//COlocar o usuario logado
            // dd($expense);
            $expense->save();
            return redirect()->route('home'); // Quando vem do edit da erro na rota
        
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
            $expense = Expense::findOrFail($id);
            $expense->deleted_by = 1;//Colocar o Auth::user() depois
            $expense->save();
            $expense->delete();

            return back();
        }
        catch (\Throwable $th) 
        {
            return back();
        }
    }
}

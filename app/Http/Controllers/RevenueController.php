<?php

namespace App\Http\Controllers;

use App\Http\Requests\RevenueRequest;
use App\Models\Revenue;
use App\Models\RevenueType;
use App\Models\RevenueSubType;
use App\User;
use Illuminate\Http\Request;

class RevenueController extends BaseController
{
    protected $layoutName   = "revenue";
    protected $modelName    = "App\Models\Revenue";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('ta aqui');
        $revenueList = Revenue::orderBy('date','DESC')->paginate(10);

        // $revenue->paginate(1)->withQueryString();

        return $this->RenderIndexPage(['revenueList' => $revenueList]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // dd('ta');
        $revenueTypeList    = RevenueType::orderBy('name')->get();
        $revenueSubTypeList = RevenueSubType::orderBy('name')->get();
        // dd($revenueTypeList);
        // dd($revenueTypeList);
        return $this->RenderEditPage([
                                        'revenueTypeList'       => $revenueTypeList,
                                        'revenueSubTypeList'    => $revenueSubTypeList
                                    ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RevenueRequest $request)
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
            $item               = Revenue::findOrFail($id);
            // dd($item);
            $revenueTypeList    = revenueType::orderBy('name')->get();
            // dd($revenueTypeList);
            // dd($revenueTypeList);
            return $this->RenderEditPage([
                                            'item'                  => $item,
                                            'revenueTypeList'       => $revenueTypeList
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
    public function update(RevenueRequest $request, $id)
    {
        if($data = $request->validated())
            return $this->commonUpdate($request,$id);
    }

    //---------------------------------------------------------------------------------
    protected function Save(Request $request, $revenue = null)
    {
        // dd('ta no save');
        // dd($request);
        try 
        {
            $isStore = $revenue == null;

            if($isStore)
                $revenue = new Revenue();

            $revenue->id_revenue_type = $request['id_revenue_type'];
            $revenue->id_revenue_sub_type = $request['id_revenue_sub_type'];
            $revenue->date = $request['date'];//Validar a data
            // $payment->value = str_replace(['.', ','], ['', '.'], $request["value"]); // Essa linha remove os '.' e substitui ',' por '.' deixando 999.999,99 foramtado como 999999.99
            $revenue->value = $request['value'];
            $revenue->description = $request['description'];
            $revenue->created_by = 1;//COlocar o usuario logado
            $revenue->save();
            // dd($revenue);
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
            $revenue = Revenue::findOrFail($id);
            $revenue->deleted_by = 1;//Colocar o Auth::user() depois
            $revenue->save();
            $revenue->delete();

            return back();
        }
        catch (\Throwable $th) 
        {
            return back();
        }
    }
}

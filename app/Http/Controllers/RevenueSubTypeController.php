<?php

namespace App\Http\Controllers;

use App\Http\Requests\RevenueSubTypeRequest;
use App\Models\RevenueSubType;
use App\User;
use Illuminate\Http\Request;

class RevenueSubTypeController extends BaseController
{
    protected $layoutName   = "revenue_sub_type";
    protected $modelName    = "App\Models\RevenueSubType";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $revenueSubTypeList = RevenueSubType::orderBy('name')->paginate(10);

        // $revenueSubType->paginate(1)->withQueryString();

        return $this->RenderIndexPage(['revenueSubTypeList' => $revenueSubTypeList]);
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
    public function store(RevenueSubTypeRequest $request)
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
            $item = RevenueSubType::findOrFail($id);

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
    public function update(RevenueSubTypeRequest $request, $id)
    {
        if($data = $request->validated())
            return $this->commonUpdate($request,$id);
    }

    //---------------------------------------------------------------------------------
    protected function Save(Request $request, $revenueSubType = null)
    {
        try 
        {
            $isStore = $revenueSubType == null;

            if($isStore)
                $revenueSubType = new RevenueSubType();

            $revenueSubType->name = $request["name"];
            $revenueSubType->created_by = 1;//COlocar o usuario logado
            $revenueSubType->save();
                
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
            $revenueSubType = RevenueSubType::findOrFail($id);
            $revenueSubType->deleted_by = 1;//Colocar o Auth::user() depois
            $revenueSubType->save();
            $revenueSubType->delete();

            return back();
        }
        catch (\Throwable $th) 
        {
            return back();
        }
    }
}

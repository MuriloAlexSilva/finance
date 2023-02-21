<?php

namespace App\Http\Controllers;

use App\Http\Requests\RevenueTypeRequest;
use App\Models\RevenueType;
use Illuminate\Http\Request;

use Auth;

class RevenueTypeController extends BaseController
{
    protected $layoutName   = "revenue_type";
    protected $modelName    = "App\Models\RevenueType";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $revenueTypeList = RevenueType::orderBy('name')
                                      ->paginate(4);

        return $this->RenderIndexPage(['revenueTypeList' => $revenueTypeList]);
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
    public function store(RevenueTypeRequest $request)
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
            $item = RevenueType::findOrFail($id);

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
    public function update(RevenueTypeRequest $request, $id)
    {
        if($data = $request->validated())
            return $this->commonUpdate($request,$id);
    }

    //---------------------------------------------------------------------------------
    protected function Save(Request $request, $revenueType = null)
    {
        // dd($request);
        try 
        {
            $isStore = $revenueType == null;

            if($isStore)
                $revenueType = new RevenueType();

            $revenueType->name = $request["name"];
            $revenueType->created_by =  Auth::user()->id;
            $revenueType->save();
            // dd($revenueType);
                
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
            $revenueType = RevenueType::findOrFail($id);
            $revenueType->deleted_by = 1;//Colocar o Auth::user() depois
            $revenueType->save();
            $revenueType->delete();

            return back();
        }
        catch (\Throwable $th) 
        {
            return back();
        }
    }
}

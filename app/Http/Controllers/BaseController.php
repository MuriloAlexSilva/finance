<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;


abstract class BaseController extends Controller
{
    protected $layoutName   =   "";
    protected $modelName    =   "";

    //---------------------------------------------------
    abstract protected function Save(Request $request, $oldItem = null);//resolver a questão do save da home que não precisa ne
    //---------------------------------------------------
    public function commonStore(Request $request)
    {
        try 
        {
            return $this->Save($request);
        }
        catch (\Throwable $th) 
        {
            return back()->withError("Não foi possível salvar o registro");
        }
    }

    //---------------------------------------------------
    //---------------------------------------------------
    public function commonUpdate(Request $request, $id)
    {
        try 
        {
            $item = $this->modelName::findOrfail($id);
            return $this->Save($request,$item);
        }
        catch (\Throwable $th) 
        {
            return back()->withError("Não foi possível encontrar o registro");
        }
    }

    //---------------------------------------------------

    protected function GetLayoutIndexName()
    {
        return 'layouts.index.'. $this->layoutName;
    }

    //---------------------------------------------------

    protected function GetLayoutEditName()
    {
        return 'layouts.edit.'. $this->layoutName;
    }
    //---------------------------------------------------
    protected function RenderIndexPage($array = null)
    {
        return view($this->GetLayoutIndexName())->with($array);
    }
    //---------------------------------------------------

    protected function RenderEditPage($array = null)
    {
        return view($this->GetLayoutEditName())->with($array);
    }

    //---------------------------------------------------
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //---------------------------------------------------
    public function index()
    {
        return $this->RenderIndexPage();
    }

    public function create()
    {
        return $this->RenderEditPage();
    }
    //---------------------------------------------------

}

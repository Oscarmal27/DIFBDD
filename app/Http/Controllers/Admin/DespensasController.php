<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pantrie;
use File;
use Validator;

class DespensasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos=\DB::table('pantries')
            ->select('pantries.*')
            ->orderBy('id','DESC')
            ->get();
        return view('admin.despensas')
            ->with('despensas',$datos);
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
        $validator= Validator::make($request->all(),[
            'tipo'=>'required|max:2|integer',
            'contenido'=>'required|max:500|string',
            'img'=>'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
        if($validator->fails()){
            return back()
                ->withInput()
                ->with('errorInsert','Favor de llenar todos los campos')
                ->withErrors('Favor de llenar todos los campos');
        }else{
            $img = $request->file('img');
            $nombre = time().'.'.$img->getClientOriginalExtension();
            $destino = public_path('img/despensas');
            $request->img->move($destino, $nombre);
            $despensa = Pantrie::create([
                'tipoDes'=>$request->tipo,
                'contenido'=>$request->contenido,
                'img'=>$nombre,
            ]);
            $despensa->save();
            return back()->with('Listo','Se ha insertado correctamente');
        }
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
        $despensa=Pantrie::find($id);
        if(File::exists(public_path('img/despensas/'.$despensa->img) )){
            unlink(public_path('img/despensas/'.$despensa->img));
        }
        $despensa->delete();
        return back()->with('Listo','Se ha eliminado correctamente');
    }
}

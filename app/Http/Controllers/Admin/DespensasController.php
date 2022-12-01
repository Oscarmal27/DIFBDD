<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pantrie;
use File;
use Auth;
use Pdf;
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
        if(Auth::user()->level !="admin"){return redirect('/admin');}
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
            'tipoDes'=>'required|max:100|string',
            'contenido'=>'required|max:500|string',
            'img'=>'required|image|mimes:jpg,jpeg,png,gif,svg|max:10000',
        ]);
        if($validator->fails()){
            return back()
                ->withInput()
                ->with('errorInsert','Favor de llenar todos los campos')
                ->withErrors($validator);
        }else{
            $img = $request->file('img');
            $nombre = time().'.'.$img->getClientOriginalExtension();
            $destino = public_path('img/despensas');
            $request->img->move($destino, $nombre);
            $despensa = Pantrie::create([
                'tipoDes'=>$request->tipoDes,
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
    public function edit($Request, $request)
    {
        $validator= Validator::make($request->all(),[
            'tipoDes'=>'required|max:100|string',
            'contenido'=>'required|max:500|string',
        ]);
        if($validator->fails()){
            return back()
                ->withInput()
                ->with('errorEdit','Favor de llenar todos los campos')
                ->withErrors($validator);
        }else{
            $despensa=Pantrie::find($request->id);
            $despensa->tipoDes=$request->tipoDes;
            $despensa->contenido=$request->contenido;

            $validator2= Validator::make($request->all(),[
                'img'=>'required|image|mimes:jpg,jpeg,png,gif,svg|max:10000',
            ]);
            if(!$validator2->fails()){
                $img = $request->file('img');
                $nombre = time().'.'.$img->getClientOriginalExtension();
                $destino = public_path('img/despensas');
                $request->img->move($destino, $nombre);
                if(File::exists(public_path('img/despensas/'.$despensa->img) )){
                    unlink(public_path('img/despensas/'.$despensa->img));
                }
                $despensa->img=$nombre;
            }

            $despensa->save();
            return back()->with('Listo','Se ha actualizado correctamente');
            
        }
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
    public function generar(){
        $datos=\DB::table('pantries')
            ->select('pantries.*')
            ->orderBy('pantries.id', 'DESC')
            ->get();

        $fecha=date("Y-m-d");
        $todo=compact('datos','fecha');
        $pdf = Pdf::loadView('reportes.despensas', $todo);
        //return $pdf->download('reporte.pdf');
        return $pdf->stream('ReporteAlim_'.date('Y_m_d_h_m_s').'.pdf');
    }
}

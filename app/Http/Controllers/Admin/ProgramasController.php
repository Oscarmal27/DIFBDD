<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program;
use File;
use Auth;
use Pdf;
use Validator;

class ProgramasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        if(Auth::user()->level !="admin"){return redirect('/admin');}
        $datos=\DB::table('programs')
            ->select('programs.*','pantries.tipoDes as despensa','pantries.contenido')
            ->join('pantries','programs.idDes','=','pantries.id')
            ->orderBy('programs.nombre','ASC')
            ->get();


         $despensas=\DB::table('pantries')
            ->select('pantries.*')
            ->orderBy('id','DESC')
            ->get();

        return view('admin.programas')
            ->with('programas',$datos)
            ->with('despensas',$despensas);
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
            'nombre'=>'required|max:100|string',
            'idDes'=>'required|max:100|string',
            'img'=>'required|image|mimes:jpg,jfif,jpeg,png,gif,svg|max:10000',
        ]);
        if($validator->fails()){
            return back()
                ->withInput()
                ->with('errorInsert','Favor de llenar todos los campos')
                ->withErrors($validator);
        }else{
            $img = $request->file('img');
            $nombre = time().'.'.$img->getClientOriginalExtension();
            $destino = public_path('img/programas');
            $request->img->move($destino, $nombre);
            $programa = Program::create([
                'nombre'=>$request->nombre,
                'idDes'=>$request->idDes,
                'img'=>$nombre
            ]);
            $programa->save();
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
            'nombre'=>'required|max:100|string',
            'idDes'=>'required|max:100|string',
            'img'=>'required|image|mimes:jpg,jfif,jpeg,png,gif,svg|max:10000',
        ]);
        if($validator->fails()){
            return back()
                ->withInput()
                ->with('errorEdit','Favor de llenar todos los campos')
                ->withErrors($validator);
        }else{
            $programa=Program::find($request->id);
            $programa->nombre=$request->nombre;
            $programa->idDes=$request->idDes;

            $validator2= Validator::make($request->all(),[
                'img'=>'required|image|mimes:jpg,jfif,jpeg,png,gif,svg|max:10000',
            ]);
            if(!$validator2->fails()){
                $img = $request->file('img');
                $nombre = time().'.'.$img->getClientOriginalExtension();
                $destino = public_path('img/programas');
                $request->img->move($destino, $nombre);
                if(File::exists(public_path('img/programas/'.$programa->img) )){
                    unlink(public_path('img/programas/'.$programa->img));
                }
                $programa->img=$nombre;
            }

            $programa->save();
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
        $programa=Program::find($id);
        if(File::exists(public_path('img/programas/'.$programa->img) )){
            unlink(public_path('img/programas/'.$programa->img));
        }
        $programa->delete();
        return back()->with('Listo','Se ha eliminado correctamente');
    }
    public function generar(){
        $datos=\DB::table('programs')
            ->select('programs.*')
            ->orderBy('programs.id', 'DESC')
            ->get();

        $fecha=date("Y-m-d");
        $todo=compact('datos','fecha');
        $pdf = Pdf::loadView('reportes.programas', $todo);
        //return $pdf->download('reporte.pdf');
        return $pdf->stream('ReporteAlim_Programas_'.date('Y_m_d_h_m_s').'.pdf');
    }
}

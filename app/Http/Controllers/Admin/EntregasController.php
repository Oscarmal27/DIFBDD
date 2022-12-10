<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Deliverie;
use File;
use Auth;
use Pdf;
use Validator;

class EntregasController extends Controller
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
        $datos=\DB::table('deliveries')
            ->select('deliveries.*','beneficiaries.nombre as beneficiario')
            ->join('beneficiaries','deliveries.idBen','=','beneficiaries.id')
            ->orderBy('deliveries.id','DESC')
            ->get();

        $beneficiarios=\DB::table('beneficiaries')
            ->select('beneficiaries.*')
            ->orderBy('id','DESC')
            ->get();

        return view('admin.entregas')
            ->with('entregas',$datos)
            ->with('beneficiarios',$beneficiarios);
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
            'idBen'=>'required|max:100|string',
            'cantidad'=>'required|max:4|string',
            'cantAPagar'=>'required|max:6|string',
            'pago'=>'required|max:5|string',
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
            $destino = public_path('img/entregas');
            $request->img->move($destino, $nombre);
            $entrega = Deliverie::create([
                'idBen'=>$request->idBen,
                'cantidad'=>$request->cantidad,
                'cantAPagar'=>$request->cantAPagar,
                'pago'=>$request->pago,
                'img'=>$nombre,
            ]);
            $entrega->save();
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
            'idBen'=>'required|max:100|string',
            'cantidad'=>'required|max:4|string',
            'cantAPagar'=>'required|max:6|string',
            'pago'=>'required|max:5|string',
            'img'=>'required|image|mimes:jpg,jfif,jpeg,png,gif,svg|max:10000',
        ]);
        if($validator->fails()){
            return back()
                ->withInput()
                ->with('errorEdit','Favor de llenar todos los campos')
                ->withErrors($validator);
        }else{
            $entrega=Deliverie::find($request->id);
            $entrega->tipoDes=$request->idBen;
            $entrega->cantidad=$request->contenido;
            $entrega->cantAPagar=$request->cantAPagar;
            $entrega->pago=$request->pago;

            $validator2= Validator::make($request->all(),[
                'img'=>'required|image|mimes:jpg,jfif,jpeg,png,gif,svg|max:10000',
            ]);
            if(!$validator2->fails()){
                $img = $request->file('img');
                $nombre = time().'.'.$img->getClientOriginalExtension();
                $destino = public_path('img/entregas');
                $request->img->move($destino, $nombre);
                if(File::exists(public_path('img/entregas/'.$entrega->img) )){
                    unlink(public_path('img/entregas/'.$entrega->img));
                }
                $entrega->img=$nombre;  
            }

            $entrega->save();
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
        $entrega=Deliverie::find($id);
        if(File::exists(public_path('img/entregas/'.$entrega->img) )){
            unlink(public_path('img/entregas/'.$entrega->img));
        }
        $entrega->delete();
        return back()->with('Listo','Se ha eliminado correctamente');
    }
    public function generar(){
        $datos=\DB::table('deliveries')
            ->select('deliveries.*')
            ->orderBy('deliveries.id', 'DESC')
            ->get();

        $fecha=date("Y-m-d");
        $todo=compact('datos','fecha');
        $pdf = Pdf::loadView('reportes.entregas', $todo);
        //return $pdf->download('reporte.pdf');
        return $pdf->stream('ReporteAlim_Entregas_'.date('Y_m_d_h_m_s').'.pdf');
    }
}

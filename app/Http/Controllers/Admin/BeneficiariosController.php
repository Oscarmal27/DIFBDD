<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Beneficiarie;
use File;
use Auth;
use Pdf;
use Validator;

class BeneficiariosController extends Controller
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
        $datos=\DB::table('beneficiaries')
            ->select('beneficiaries.*','programs.nombre as programa','types.nombre as tipo')
            ->join('programs','beneficiaries.idProg','=','programs.id')
            ->join('types','beneficiaries.idTipo','=','types.id')
            ->orderBy('beneficiaries.nombre','ASC')
            ->get();

        $programas=\DB::table('programs')
            ->select('programs.*')
            ->orderBy('id','DESC')
            ->get();

        $tipos=\DB::table('types')
            ->select('types.*')
            ->orderBy('id','DESC')
            ->get();

        return view('admin.beneficiarios')
            ->with('beneficiarios',$datos)
            ->with('programas',$programas)
            ->with('tipos',$tipos);
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
            'nombre'=>'required|max:40|string',
            'apellidoP'=>'nullable|max:30|string',
            'apellidoM'=>'nullable|max:30|string',
            'img'=>'required|image|mimes:jpg,jfif,jpeg,png,gif,svg|max:10000',
            'curp'=>'nullable|max:19|string',
            'fechaNac'=>'nullable|date',
            'noTel'=>'nullable|max:10|string',
            'claveEsc'=>'nullable|max:20|string',
            'idProg'=>'required|max:100|string',
            'idTipo'=>'required|max:100|string',
            'fechaIngreso'=>'nullable|date',
            'enhina'=>'nullable|max:50|string',
            'enhinaDoc'=>'nullable|string|max:10',
            'actaDeNac'=>'nullable|string|max:10',
            'curpDoc'=>'nullable|string|max:10',
            'compDeDom'=>'nullable|string|max:10',
            'ine'=>'nullable|string|max:10',
            'cartaDeSeg'=>'nullable|string|max:10',
            'cartaVac'=>'nullable|string|max:10',
            'compDisc'=>'nullable|string|max:10',
            'credDisc'=>'nullable|string|max:10',
            'actaConst'=>'nullable|string|max:10',
            'cartaComp'=>'nullable|string|max:10',
            'comodato'=>'nullable|string|max:10',
            'supHig'=>'nullable|string|max:10',
            'supProtCiv'=>'nullable|string|max:10',            
        ]);
        if($validator->fails()){
            return back()
                ->withInput()
                ->with('errorInsert','Favor de llenar todos los campos')
                ->withErrors($validator);
        }else{
            $img = $request->file('img');
            $nombre = time().'.'.$img->getClientOriginalExtension();
            $destino = public_path('img/beneficiarios');
            $request->img->move($destino, $nombre);
            
            $beneficiarios = Beneficiarie::create([
                'nombre'=>$request->nombre,
                'apellidoP'=>$request->apellidoP,
                'apellidoM'=>$request->apellidoM,
                'img'=>$nombre,
                'curp'=>$request->curp,
                'fechaNac'=>$request->fechaNac,
                'noTel'=>$request->noTel,
                'claveEsc'=>$request->claveEsc,
                'idProg'=>$request->idProg,
                'idTipo'=>$request->idTipo,
                'fechaIngreso'=>$request->fechaIngreso,
                'enhina'=>$request->enhina,
                'enhinaDoc'=>$request->enhinaDoc,
                'actaDeNac'=>$request->actaDeNac,
                'curpDoc'=>$request->curpDoc,
                'compDeDom'=>$request->compDeDom,
                'ine'=>$request->ine,
                'cartaDeSeg'=>$request->cartaDeSeg,
                'cartaVac'=>$request->cartaVac,
                'compDisc'=>$request->compDisc,
                'credDisc'=>$request->credDisc,
                'actaConst'=>$request->actaConst,
                'cartaComp'=>$request->cartaComp,
                'comodato'=>$request->comodato,
                'supHig'=>$request->supHig,
                'supProtCiv'=>$request->supProtCiv,

            ]);
            $beneficiarios->save();
            return back()->with('Listo','Se ha agregado correctamente');
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
            'nombre'=>'nullable|max:40|string',
            'apellidoP'=>'nullable|max:30|string',
            'apellidoM'=>'nullable|max:30|string',
            'img'=>'required|image|mimes:jpg,jfif,jpeg,png,gif,svg|max:10000',
            'curp'=>'nullable|max:19|string',
            'fechaNac'=>'required|date',
            'noTel'=>'nullable|max:10|string',
            'claveEsc'=>'nullable|max:20|string',
            'idProg'=>'required|max:100|string',
            'idTipo'=>'required|max:100|string',
            'fechaIngreso'=>'nullable|date',
            'enhina'=>'nullable|max:50|string',
            'enhinaDoc'=>'nullable|string|max:10',
            'actaDeNac'=>'nullable|string|max:10',
            'curpDoc'=>'nullable|string|max:10',
            'compDeDom'=>'nullable|string|max:10',
            'ine'=>'nullable|string|max:10',
            'cartaDeSeg'=>'nullable|string|max:10',
            'cartaVac'=>'nullable|string|max:10',
            'compDisc'=>'nullable|string|max:10',
            'credDisc'=>'nullable|string|max:10',
            'actaConst'=>'nullable|string|max:10',
            'cartaComp'=>'nullable|string|max:10',
            'comodato'=>'nullable|string|max:10',
            'supHig'=>'nullable|string|max:10',
            'supProtCiv'=>'nullable|string|max:10', 


        ]);
        if($validator->fails()){
            return back()
                ->withInput()
                ->with('errorEdit','Favor de llenar todos los campos')
                ->withErrors($validator);
        }else{
            $beneficiarios=Beneficiarie::find($request->id);
            $beneficiarios->nombre=$request->nombre;
            $beneficiarios->apellidoP=$request->apellidoP;
            $beneficiarios->apellidoM=$request->apellidoM;
            $beneficiarios->curp=$request->curp;
            $beneficiarios->fechaNac=$request->fechaNac;
            $beneficiarios->noTel=$request->noTel;
            $beneficiarios->claveEsc=$request->claveEsc;
            $beneficiarios->idProg=$request->idProg;
            $beneficiarios->idTipo=$request->idTipo;
            $beneficiarios->fechaIngreso=$request->fechaIngreso;
            $beneficiarios->enhina=$request->enhina;
            $beneficiarios->enhinaDoc=$request->enhinaDoc;
            $beneficiarios->actaDeNac=$request->actaDeNac;
            $beneficiarios->curpDoc=$request->curpDoc;
            $beneficiarios->compDeDom=$request->compDeDom;
            $beneficiarios->ine=$request->ine;
            $beneficiarios->cartaDeSeg=$request->cartaDeSeg;
            $beneficiarios->cartaVac=$request->cartaVac;
            $beneficiarios->compDisc=$request->compDisc;
            $beneficiarios->credDisc=$request->credDisc;
            $beneficiarios->actaConst=$request->actaConst;
            $beneficiarios->cartaComp=$request->cartaComp;
            $beneficiarios->comodato=$request->comodato;
            $beneficiarios->supHig=$request->supHig;
            $beneficiarios->cupProtCiv=$request->cupProtCiv;


            $validator2= Validator::make($request->all(),[
                'img'=>'required|image|mimes:jpg,jfif,jpeg,png,gif,svg|max:10000',

            ]);
            if(!$validator2->fails()){
                $img = $request->file('img');
                $nombre = time().'.'.$img->getClientOriginalExtension();
                $destino = public_path('img/beneficiarios');
                $request->img->move($destino, $nombre);
                if(File::exists(public_path('img/beneficiarios/'.$beneficiarios->img) )){
                    unlink(public_path('img/beneficiarios/'.$beneficiarios->img));
                }
                $beneficiarios->img=$nombre;

            }

            $beneficiarios->save();
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
        $beneficiarios=Beneficiarie::find($id);
        if(File::exists(public_path('img/beneficiarios/'.$beneficiarios->img) )){
            unlink(public_path('img/beneficiarios/'.$beneficiarios->img));
        }
        $beneficiarios->delete();
        return back()->with('Listo','Se ha eliminado correctamente');
    }
    public function generar(){
        $datos=\DB::table('beneficiaries')
            ->select('beneficiaries.*')
            ->orderBy('beneficiaries.id', 'DESC')
            ->get();

        $fecha=date("Y-m-d");
        $todo=compact('datos','fecha');
        $pdf = Pdf::loadView('reportes.beneficiarios', $todo);
        //return $pdf->download('reporte.pdf');
        return $pdf->stream('ReporteAlim_Beneficiarios_'.date('Y_m_d_h_m_s').'.pdf');
    }
}

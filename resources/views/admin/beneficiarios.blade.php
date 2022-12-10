@extends('admin.layouts.main')

@section('contenido')  
<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Beneficiarios</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-add">
                  <i class="fa fa-plus"></i> Agregar Beneficiario</button> 
            <li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

<div class="content">
<div class="container-fluid">
  <div class="row">
  @if($message=Session::get('Listo'))
    <div class="alert alert-suiccess alert-dismissable fade show col-12" role="alert">
      <h5>Listo:</h5>
      <p>{{$message}}</p>
    </div>
  @endif
<div id="tableContainer" class="tableContainer">
  <table class="table" class="scrollTable">
    <thead>
      <tr>
        <th>Imagen</th>
        <th>Nombre(s)</th>
        <th>Apellido Paterno</th>
        <th>Apellido Materno</th>
        <th>Curp</th>
        <th>Fecha de Nacimiento</th>
        <th>Número Telefónico</th>
        <th>Clave Escolar</th>
        <th>Tipo de Despensa</th>
        <th>Programa</th>
        <th>Fecha de Ingreso</th>
        <th>ENHINA</th>
        <th>ENHINA (Img)</th>
        <th>Acta de Nacimiento (Img)</th>
        <th>Curp (Img)</th>
        <th>Comprobante de Domicilio (Img)</th>
        <th>Ine (Img)</th>
        <th>Carta de Seguimiento (Img)</th>
        <th>Cartilla de Vacunación (Img)</th>
        <th>Comprobante de Discapacidad (Img)</th>
        <th>Credencial de Discapacidad (Img)</th>
        <th>Acta Constitutiva (Img)</th>
        <th>Carta Compromiso (Img)</th>
        <th>Comodato (Img)</th>
        <th>Supervision de Higiene (Img)</th>
        <th>Supervision de Proteccion Civil (Img)</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($beneficiarios as $b)
        <tr>
          <td>
            <img src="{{ asset('img/beneficiarios/'.$b->img ) }}" alt="" width="100px" height="100px">
            {{ $b->img }}
          </td>
          <td>{{ $b->nombre }}</td>
          <td>{{ $b->apellidoP }}</td>
          <td>{{ $b->apellidoM }}</td>
          <td>{{ $b->curp }}</td>
          <td>{{ $b->fechaNac }}</td>
          <td>{{ $b->noTel }}</td>
          <td>{{ $b->claveEsc }}</td>
          <td>{{ $b->idProg }}</td>
          <td>{{ $b->idTipo }}</td>
          <td>{{ $b->fechaIngreso }}</td>
          <td>{{ $b->enhina }}</td>
          <td>{{ $b->enhinaDoc }}</td>
          <td>{{ $b->actaDeNac }}</td>
          <td>{{ $b->curpDoc }}</td>
          <td>{{ $b->compDeDom }}</td>
          <td>{{ $b->ine }}</td>
          <td>{{ $b->cartaDeSeg }}</td>
          <td>{{ $b->cartaVac }}</td>
          <td>{{ $b->compDisc }}</td>
          <td>{{ $b->credDisc }}</td>
          <td>{{ $b->actaConst }}</td>
          <td>{{ $b->cartaComp }}</td>
          <td>{{ $b->comodato }}</td>
          <td>{{ $b->supHig }}</td>
          <td>{{ $b->supProtCiv }}</td>
            <button class="btn b tn-primary btnEdit" data-id="{{ $b->id }}"
              data-nombre="{{ $b->nombre }}"
              data-apellidoP="{{ $b->apellidoP }}"
              data-apellidoM="{{ $b->apellidoM }}"
              data-curp="{{ $b->curp }}"
              data-fechaNac="{{ $b->fechaNac }}"
              data-noTel="{{ $b->noTel }}"
              data-claveEsc="{{ $b->claveEsc }}"
              data-idProg="{{ $b->idProg }}"
              data-idTipo="{{ $b->idTipo }}"
              data-fechaIngreso="{{ $b->fechaIngreso }}"
              data-enhina="{{ $b->enhina }}"
              data-enhinaDoc="{{ $b->enhinaDoc }}"
              data-actaDeNac="{{ $b->actaDeNac }}"
              data-curpDoc="{{ $b->curpDoc }}"
              data-compDeDom="{{ $b->compDeDom }}"
              data-ine="{{ $b->ine }}"
              data-cartaDeSeg="{{ $b->cartaDeSeg }}"
              data-cartaVac="{{ $b->cartaVac }}"
              data-compDisc="{{ $b->compDisc }}"
              data-credDisc="{{ $b->credDisc }}"
              data-actaConst="{{ $b->actaConst }}"
              data-cartaComp="{{ $b->cartaComp }}"
              data-comodato="{{ $b->comodato }}"
              data-supHig="{{ $b->supHig }}"
              data-supProtCiv="{{ $b->supProtCiv }}"
              data-toggle="modal" data-target="#modal-edit">
              <i class="fa fa-edit"></i>
            </button>
            <button class="btn b tn-danger btnEliminar" data-id="{{ $b->id }}"
              data-toggle="modal" data-target="#modal-delete">
              <i class="fa fa-trash"></i>
            </button>
            <form action="{{ url('/admin/beneficiarios', ['id'=>$b->id]) }}"
              method="POST" id="formEliminar_{{ $b->id }}">
            @csrf
            <input type="hidden" name="id" value="{{ $b->id }}">
            <input type="hidden" name="_method" value="delete">
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

  </div>
</div>
</div>

<!-- /modal EDITAR -->
<div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar Beneficiario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/admin/beneficiarios/edit" method="POST" enctype="multipart/form-data">
            @if($message=Session::get('errorInsert'))
                <div class="alert alert-danger alert-dismissable fade show col-12" role="alert">
                    <h5>Error:</h5>
                    <ul>
                        @foreach($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <div class="modal-body">
              <input type="hidden" name="idEdit" id="id">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control form-control-border" id="nombreEdit" name="nombre" value="{{ @old('nombre') }}">
                </div>
                <div class="form-group">
                  <label for="apellidoP">Apellido Paterno</label>
                  <input type="text" class="form-control form-control-border" id="apellidoPEdit" name="apellidoP" value="{{ @old('apellidoP') }}">
                </div>
                <div class="form-group">
                  <label for="apellidoM">Apellido Materno</label>
                  <input type="text" class="form-control form-control-border" id="apellidoMEdit" name="apellidoM" value="{{ @old('apellidoM') }}">
                </div>
                <div class="form-group">
                  <label for="img">Imagen</label>
                  <input type="file" class="form-control form-control-border" id="img" name="img" value="{{ @old('img') }}">
                </div> 
                <div class="form-group">
                      <label for="curp">Curp</label>
                      <input type="text" class="form-control form-control-border" id="curpEdit" name="curp" value="{{ @old('curp') }}">
                </div>
                <div class="form-group">
                      <label for="fechaNac">Fecha de Nacimiento</label>
                      <input type="date" class="form-control form-control-border" id="fechaNacEdit" name="fechaNac" value="{{ @old('fechaNac') }}">
                </div>
                <div class="form-group">
                      <label for="noTel">Número Telefónico</label>
                      <input type="text" class="form-control form-control-border" id="noTelEdit" name="noTel" value="{{ @old('noTel') }}">
                </div>
                <div class="form-group">
                      <label for="claveEsc">Clave Escolar</label>
                      <input type="text" class="form-control form-control-border" id="claveEscEdit" name="claveEsc" value="{{ @old('claveEsc') }}">
                </div>
                <div class="form-group">
                      <label for="idProg">Tipo de Despensa</label>
                      <select name="idProg" id="idProgEdit" class="form-control">
                          @foreach($programas as $p)
                            <option value="{{$p->id}}"> {{$p->nombre}} </option>
                          @endforeach
                      </select>
                </div>
                <div class="form-group">
                      <label for="idTipo">Programa</label>
                      <select name="idTipo" id="idTipoEdit" class="form-control">
                          @foreach($tipos as $t)
                            <option value="{{$t->id}}"> {{$t->nombre}} </option>
                          @endforeach
                      </select>
                </div>
                <div class="form-group">
                      <label for="fechaIngreso">Fecha de Ingreso</label>
                      <input type="date" class="form-control form-control-border" id="fechaIngresoEdit" name="fechaIngreso" value="{{ @old('fechaIngreso') }}">
                </div>
                <div class="form-group">
                      <label for="enhina">ENHINA</label>
                      <input type="text" class="form-control form-control-border" id="enhinaEdit" name="enhina" value="{{ @old('enhina') }}">
                </div>
                <div class="form-group">
                <label for="enhinaDoc">ENHINA (Img)</label>
                <select name="enhinaDoc" class="form-control form-control-border" id="enhinaDocEdit" value="{{ @old('enhinaDoc') }}">
                          <option value="Si">SI</option>
                          <option value="No">NO</option>
                          <option value="No APlica">NO Aplica</option>
                      </select>
                </div>
                <div class="form-group">
                  <label for="actaDeNac">Acta de Nacimiento (Img)</label>
                  <select name="actaDeNac" class="form-control form-control-border" id="actaDeNacEdit" value="{{ @old('actaDeNac') }}">
                    <option value="Si">SI</option>
                    <option value="No">NO</option>
                    <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="curpDoc">CURP (Img)</label>
                      <select name="curpDoc" class="form-control form-control-border" id="curpDocEdit" value="{{ @old('curpDoc') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="compDeDom">Comprobante de Domicilio (Img)</label>
                      <select name="compDeDom" class="form-control form-control-border" id="compDeDomEdit" value="{{ @old('compDeDom') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="ine">INE (Img)</label>
                      <select name="ine" class="form-control form-control-border" id="ineEdit" value="{{ @old('ine') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="cartaDeSeg">Carta de Seguimiento de nutrición (Img)</label>
                      <select name="cartaDeSeg" class="form-control form-control-border" id="cartaDeSegEdit" value="{{ @old('cartaDeSeg') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="cartaVac">Carta de Vacunación (Img)</label>
                      <select name="cartaVac" class="form-control form-control-border" id="cartaVacEdit" value="{{ @old('cartaVac') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="compDisc">Comprobante de Discapacidad (Img)</label>
                      <select name="compDisc" class="form-control form-control-border" id="compDiscEdit" value="{{ @old('compDisc') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="credDisc">Credencial de Discapacidad (Img)</label>
                      <select name="credDisc" class="form-control form-control-border" id="credDiscEdit" value="{{ @old('credDisc') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="actaConst">Acta Constitutiva (Img)</label>
                      <select name="actaConst" class="form-control form-control-border" id="actaConstEdit" value="{{ @old('actaConst') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="cartaComp">Carta Compromiso (Img)</label>
                      <select name="cartaComp" class="form-control form-control-border" id="cartaCompEdit" value="{{ @old('cartaComp') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="comodato">Comodato (Img)</label>
                      <select name="comodato" class="form-control form-control-border" id="comodatoEdit" value="{{ @old('comodato') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="supHig">Supervision de Higiene (Img)</label>
                      <select name="supHig" class="form-control form-control-border" id="supHigEdit" value="{{ @old('supHig') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="supProtCiv">Supervisión de Protección Civíl (Img)</label>
                      <select name="supProtCiv" class="form-control form-control-border" id="supProtCivEdit" value="{{ @old('supProtCiv') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<!-- /modal EDITAR END -->

<!-- /modal AGREGAR -->
  <div class="modal fade" id="modal-add">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Agregar Beneficiario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/admin/beneficiarios" method="POST" enctype="multipart/form-data">
            @if($message=Session::get('errorInsert'))
                <div class="alert alert-danger alert-dismissable fade show col-12" role="alert">
                    <h5>Error:</h5>
                    <ul>
                        @foreach($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @csrf
            <div class="modal-body">
                <div class="form-group">
                  <label for="nombre">Nombre</label>
                  <input type="text" class="form-control form-control-border" id="nombre" name="nombre" value="{{ @old('nombre') }}">
                </div>
                <div class="form-group">
                  <label for="apellidoP">Apellido Paterno</label>
                  <input type="text" class="form-control form-control-border" id="apellidoP" name="apellidoP" value="{{ @old('apellidoP') }}">
                </div>
                <div class="form-group">
                  <label for="apellidoM">Apellido Materno</label>
                  <input type="text" class="form-control form-control-border" id="apellidoM" name="apellidoM" value="{{ @old('apellidoM') }}">
                </div>
                <div class="form-group">
                  <label for="img">Imagen</label>
                  <input type="file" class="form-control form-control-border" id="img" name="img" value="{{ @old('img') }}">
                </div> 
                <div class="form-group">
                      <label for="curp">Curp</label>
                      <input type="text" class="form-control form-control-border" id="curp" name="curp" value="{{ @old('curp') }}">
                </div>
                <div class="form-group">
                      <label for="fechaNac">Fecha de Nacimiento</label>
                      <input type="date" class="form-control form-control-border" id="fechaNac" name="fechaNac" value="{{ @old('fechaNac') }}">
                </div>
                <div class="form-group">
                      <label for="noTel">Número Telefónico</label>
                      <input type="text" class="form-control form-control-border" id="noTel" name="noTel" value="{{ @old('noTel') }}">
                </div>
                <div class="form-group">
                      <label for="claveEsc">Clave Escolar</label>
                      <input type="text" class="form-control form-control-border" id="claveEsc" name="claveEsc" value="{{ @old('claveEsc') }}">
                </div>
                <div class="form-group">
                      <label for="idProg">Tipo de Despensa</label>
                      <select name="idProg" id="idProg" class="form-control">
                          @foreach($programas as $p)
                            <option value="{{$p->id}}"> {{$p->nombre}} </option>
                          @endforeach
                      </select>
                </div>
                <div class="form-group">
                    <label for="idTipo">Programa</label>
                      <select name="idTipo" id="idTipo" class="form-control">
                          @foreach($tipos as $t)
                            <option value="{{$t->id}}"> {{$t->nombre}} </option>
                          @endforeach
                      </select>
                </div>
                <div class="form-group">
                      <label for="fechaIngreso">Fecha de Ingreso</label>
                      <input type="date" class="form-control form-control-border" id="fechaIngreso" name="fechaIngreso" value="{{ @old('fechaIngreso') }}">
                </div>
                <div class="form-group">
                      <label for="enhina">ENHINA</label>
                      <input type="text" class="form-control form-control-border" id="enhina" name="enhina" value="{{ @old('enhina') }}">
                </div>
                <div class="form-group">
                  <label for="enhinaDoc">ENHINA (Img)</label>
                  <select name="enhinaDoc" class="form-control form-control-border" id="enhinaDoc" value="{{ @old('enhinaDoc') }}">
                          <option value="Si">SI</option>
                          <option value="No">NO</option>
                          <option value="No APlica">NO Aplica</option>
                      </select>
                      <div class="form-group">
                  <label for="actaDeNac">Acta de Nacimiento (Img)</label>
                  <select name="actaDeNac" class="form-control form-control-border" id="actaDeNac" value="{{ @old('actaDeNac') }}">
                    <option value="Si">SI</option>
                    <option value="No">NO</option>
                    <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="curpDoc">CURP (Img)</label>
                      <select name="curpDoc" class="form-control form-control-border" id="curpDoc" value="{{ @old('curpDoc') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="compDeDom">Comprobante de Domicilio (Img)</label>
                      <select name="compDeDom" class="form-control form-control-border" id="compDeDom" value="{{ @old('compDeDom') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="ine">INE (Img)</label>
                      <select name="ine" class="form-control form-control-border" id="ine" value="{{ @old('ine') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="cartaDeSeg">Carta de Seguimiento de nutrición (Img)</label>
                      <select name="cartaDeSeg" class="form-control form-control-border" id="cartaDeSeg" value="{{ @old('cartaDeSeg') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="cartaVac">Carta de Vacunación (Img)</label>
                      <select name="cartaVac" class="form-control form-control-border" id="cartaVac" value="{{ @old('cartaVac') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="compDisc">Comprobante de Discapacidad (Img)</label>
                      <select name="compDisc" class="form-control form-control-border" id="compDisc" value="{{ @old('compDisc') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="credDisc">Credencial de Discapacidad (Img)</label>
                      <select name="credDisc" class="form-control form-control-border" id="credDisc" value="{{ @old('credDisc') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="actaConst">Acta Constitutiva (Img)</label>
                      <select name="actaConst" class="form-control form-control-border" id="actaConst" value="{{ @old('actaConst') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="cartaComp">Carta Compromiso (Img)</label>
                      <select name="cartaComp" class="form-control form-control-border" id="cartaComp" value="{{ @old('cartaComp') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="comodato">Comodato (Img)</label>
                      <select name="comodato" class="form-control form-control-border" id="comodato" value="{{ @old('comodato') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="supHig">Supervision de Higiene (Img)</label>
                      <select name="supHig" class="form-control form-control-border" id="supHig" value="{{ @old('supHig') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
                <div class="form-group">
                      <label for="supProtCiv">Supervisión de Protección Civíl (Img)</label>
                      <select name="supProtCiv" class="form-control form-control-border" id="supProtCiv" value="{{ @old('supProtCiv') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
                        <option value="No APlica">NO Aplica</option>
                  </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<!-- /modal AGREGAR END -->

<!-- /modal ELIMINAR -->
    <div class="modal fade" id="modal-delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Eliminar Beneficiario</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

            <div class="modal-body">
                <h2 class="h6">¿Desea Eliminar al Beneficiario?</h2>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-danger btnCloseEliminar">Eliminar</button>
            </div>

        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->



@endsection

@section('scripts')
<script>
  var idEliminar=-1;
    $(document).ready(function(){
      @if($message= Session::get('errorInsert'))
        $("modal-add").modal('show');
      @endif
      @if($message= Session::get('errorEdit'))
        $("modal-edit").modal('show');
      @endif

      $(".btnEliminar").click(function(){
        var id=$(this).data('id');
        idEliminar=id;
      });
      $(".btnEdit").click(function(){
        var id=$(this).data('id');
        var nombre=$(this).data('nombre');
        var apellidoP=$(this).data('apellidoP');
        var apellidoM=$(this).data('apellidoM');
        var curp=$(this).data('curp');
        var fechaNac=$(this).data('fechaNac');
        var noTel=$(this).data('noTel');
        var claveEsc=$(this).data('claveEsc');
        var idProg=$(this).data('idProg');
        var idTipo=$(this).data('idTipo');
        var fechaIngreso=$(this).data('fechaIngreso');
        var enhina=$(this).data('enhina');
        var enhinaDoc=$(this).data('enhinaDoc');
        var actaDeNac=$(this).data('actaDeNac');
        var curpDoc=$(this).data('curpDoc');
        var compDeDom=$(this).data('compDeDom');
        var ine=$(this).data('ine');
        var cartaDeSeg=$(this).data('cartaDeSeg');
        var cartaVac=$(this).data('cartaVac');
        var compDisc=$(this).data('compDisc');
        var credDisc=$(this).data('credDisc');
        var actaConst=$(this).data('actaConst');
        var cartaComp=$(this).data('cartaComp');
        var comodato=$(this).data('comodato');
        var supHig=$(this).data('supHig');
        var supProtCiv=$(this).data('supProtCiv');
        $("#idEdit").val(id);
        $("#nombreEdit").val(nombre);
        $("#apellidoPEdit").val(apellidoP);
        $("#apellidoMEdit").val(apellidoM);
        $("#curpEdit").val(curp);
        $("#fechaNacEdit").val(fechaNac);
        $("#noTelEdit").val(noTel);
        $("#claveEscEdit").val(claveEsc);
        $("#idProgEdit").val(idProg);
        $("#idTipoEdit").val(idTipo);
        $("#fechaIngresoEdit").val(fechaIngreso);
        $("#enhinaEdit").val(enhina);
        $("#enhinaDocEdit").val(enhinaDoc);
        $("#actaDeNacEdit").val(actaDeNac);
        $("#curpDocEdit").val(curpDoc);
        $("#compDeDomEdit").val(compDeDom);
        $("#ineEdit").val(ine);
        $("#cartaDeSegEdit").val(cartaDeSeg);
        $("#cartaVacEdit").val(cartaVac);
        $("#compDiscEdit").val(compDisc);
        $("#credDiscEdit").val(credDisc);
        $("#actaConstEdit").val(actaConst);
        $("#cartaCompEdit").val(cartaComp);
        $("#comodatoEdit").val(comodato);
        $("#supHigEdit").val(supHig);
        $("#supProtCivEdit").val(supProtCiv);
      });
      $(".btnCloseEliminar").click(function(){
        $("#formEliminar_"+idEliminar).submit();
      })
    });
</script>

@endsection
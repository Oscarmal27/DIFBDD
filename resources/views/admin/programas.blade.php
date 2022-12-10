@extends('admin.layouts.main')

@section('contenido')  
<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Programas</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a class="btn btn-outline-primary btn-sm" target="_blank">
                  <i class="fa fa-print"></i> Imprimir Datos</a> 
            <li>
            <li class="breadcrumb-item">
              <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-add">
                  <i class="fa fa-plus"></i> Agregar Programa</button> 
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

  <table class="table">
    <thead>
      <tr>
        <th>Nombre del Programa</th>
        <th>Despensa que se entrega</th>
        <th>Imagen</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($programas as $p)
        <tr>
          <td>{{ $p->nombre }}</td>
          <td>{{ $p->despensa }}</td>
          <td>
            <img src="{{ asset('img/programas/'.$p->img ) }}" alt="" width="100px" height="100px">
            {{ $p->img }}
          </td>
          <td>
            <button class="btn b tn-primary btnEdit" data-id="{{ $p->id }}"
              data-tipoDes="{{ $p->nombre }}"
              data-contenido="{{ $p->idDes }}"
              data-toggle="modal" data-target="#modal-edit">
              <i class="fa fa-edit"></i>
            </button>
            <button class="btn b tn-danger btnEliminar" data-id="{{ $p->id }}"
              data-toggle="modal" data-target="#modal-delete">
              <i class="fa fa-trash"></i>
            </button>
            <form action="{{ url('/admin/programas', ['id'=>$p->id]) }}"
              method="POST" id="formEliminar_{{ $p->id }}">
            @csrf
            <input type="hidden" name="id" value="{{ $p->id }}">
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

<!-- /modal EDITAR -->
<div class="modal fade" id="modal-edit">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Editar Programa</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/admin/programas/edit" method="POST" enctype="multipart/form-data">
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
                  <label for="nombre">Nombre del Programa</label>
                  <input type="text" class="form-control form-control-border" id="nombreEdit" name="nombre" value="{{ @old('nombre') }}">
                </div>
                <div class="form-group">
                  <label for="idDes">Nombre de la despensa</label>
                  <select name="idDes" id="idDesEdit" class="form-control">
                    @foreach($despensas as $d)
                      <option value="{{$d->id}}"> {{$d->tipoDes}} </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="img">Imagen</label>
                  <input type="file" class="form-control form-control-border" id="img" name="img" value="{{ @old('img') }}">
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
            <h4 class="modal-title">Agregar Programa</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/admin/programas" method="POST" enctype="multipart/form-data">
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
                  <label for="nombre">Nombre del Programa</label>
                  <input type="text" class="form-control form-control-border" id="nombre" name="nombre" value="{{ @old('nombre') }}">
                </div>
                <div class="form-group">
                  <label for="idDes">Despensa</label>
                  <select name="idDes" id="idDes" class="form-control">
                    @foreach($despensas as $d)
                      <option value="{{$d->id}}"> {{$d->tipoDes}} </option>
                    @endforeach
                  </select>
                   </div>
                <div class="form-group">
                  <label for="img">Imagen</label>
                  <input type="file" class="form-control form-control-border" id="img" name="img" value="{{ @old('img') }}">
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
            <h4 class="modal-title">Eliminar Programa</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

            <div class="modal-body">
                <h2 class="h6">¿Desea Eliminar el Programa?</h2>
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
        var idDes=$(this).data('idDes');
        $("#idEdit").val(id);
        $("#nombreEdit").val(nombre);
        $("#idDesEdit").val(idDes);
      });
      $(".btnCloseEliminar").click(function(){
        $("#formEliminar_"+idEliminar).submit();
      })
    });
</script>

@endsection
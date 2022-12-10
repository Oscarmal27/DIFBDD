@extends('admin.layouts.main')

@section('contenido')  
<!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Entregas</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a class="btn btn-outline-primary btn-sm" target="_blank">
                  <i class="fa fa-print"></i> Imprimir Datos</a> 
            <li>
            <li class="breadcrumb-item">
              <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#modal-add">
                  <i class="fa fa-plus"></i> Agregar Entrega</button> 
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
        <th>Nombre del Beneficiario</th>
        <th>Número de Despensas</th>
        <th>Cantidad a Pagar</th>
        <th>Pagado</th>
        <th>Imagen</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($entregas as $e)
        <tr>
          <td>{{ $e->idBen }}</td>
          <td>{{ $e->cantidad }}</td>
          <td>{{ $e->cantAPagar }}</td>
          <td>{{ $e->pago }}</td>
          <td>
            <img src="{{ asset('img/entregas/'.$e->img ) }}" alt="" width="100px" height="100px">
            {{ $e->img }}
          </td>
          <td>
            <button class="btn b tn-primary btnEdit" data-id="{{ $e->id }}"
              data-idBen="{{ $e->idBen }}"
              data-cantidad="{{ $e->cantidad }}"
              data-cantAPagar="{{ $e->cantAPagar }}"
              data-pago="{{ $e->pago }}"
              data-toggle="modal" data-target="#modal-edit">
              <i class="fa fa-edit"></i>
            </button>
            <button class="btn b tn-danger btnEliminar" data-id="{{ $e->id }}"
              data-toggle="modal" data-target="#modal-delete">
              <i class="fa fa-trash"></i>
            </button>
            <form action="{{ url('/admin/entregas', ['id'=>$e->id]) }}"
              method="POST" id="formEliminar_{{ $e->id }}">
            @csrf
            <input type="hidden" name="id" value="{{ $e->id }}">
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
            <h4 class="modal-title">Editar Entrega</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/admin/entregas/edit" method="POST" enctype="multipart/form-data">
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
                  <label for="idBen">Nombre del Beneficiario</label>
                  <select name="idBen" id="idBenEdit" class="form-control">
                    @foreach($beneficiarios as $b)
                      <option value="{{$b->id}}"> {{$b->nombre}} </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="cantidad">Número de Despensas</label>
                  <input type="text" class="form-control form-control-border" id="cantidadEdit" name="cantidad" value="{{ @old('cantidad') }}">
                </div>
                <div class="form-group">
                  <label for="cantAPagar">Cantidad a Pagar</label>
                  <input type="text" class="form-control form-control-border" id="cantAPagarEdit" name="cantAPagar" value="{{ @old('cantAPagar') }}">
                </div>
                <div class="form-group">
                  <label for="pago">Pagado</label>
                  <select name="pago" class="form-control form-control-border" id="pagoEdit" value="{{ @old('pago') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
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
            <h4 class="modal-title">Agregar Entrega</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="/admin/entregas" method="POST" enctype="multipart/form-data">
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
                  <label for="idBen">Nombre del Beneficiario</label>
                  <select name="idBen" id="idBen" class="form-control">
                    @foreach($beneficiarios as $b)
                      <option value="{{$b->id}}"> {{$b->nombre}} </option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="cantidad">Número de Despensas</label>
                  <input type="text" class="form-control form-control-border" id="cantidad" name="cantidad" value="{{ @old('cantidad') }}">
                </div>
                <div class="form-group">
                  <label for="cantAPagar">Cantidad a Pagar</label>
                  <input type="text" class="form-control form-control-border" id="cantAPagar" name="cantAPagar" value="{{ @old('cantAPagar') }}">
                </div>
                <div class="form-group">
                  <label for="pago">Pagado</label>
                  <select name="pago" class="form-control form-control-border" id="pago" value="{{ @old('pago') }}">
                        <option value="Si">SI</option>
                        <option value="No">NO</option>
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
            <h4 class="modal-title">Eliminar Entrega</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

            <div class="modal-body">
                <h2 class="h6">¿Desea Eliminar la Entrega?</h2>
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
        var idBen=$(this).data('idBen');
        var cantidad=$(this).data('cantidad');
        var cantAPagar=$(this).data('cantAPagar');
        var pago=$(this).data('pago');
        var contenido=$(this).data('contenido');
        $("#idEdit").val(id);
        $("#idBenEdit").val(idBen);
        $("#cantidadEdit").val(cantidad);
        $("#cantAPagarEdit").val(cantAPagar);
        $("#pagoEdit").val(pago);
      });
      $(".btnCloseEliminar").click(function(){
        $("#formEliminar_"+idEliminar).submit();
      })
    });
</script>

@endsection
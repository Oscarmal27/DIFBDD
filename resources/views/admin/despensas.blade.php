  @extends('admin.layouts.main')

  @section('contenido')  
  <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Despensas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target='#modal-add'>
                    <i class="fa fa-plus"></i> Agregar Despensa</button> 
              <li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->





    <div class="modal fade" id="modal-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Despensa</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/admin/despensas" method="POST" enctype="multipart/form-data">
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
                    <label for="tipo">Tipo</label>
                    <input type="integer" class="form-control form-control-border" id="tipo" min="1" name="tipo" value="{{ @old('tipo') }}">
                  </div>
                  <div class="form-group">
                    <label for="contenido">Contenido</label>
                    <input type="text" class="form-control form-control-border" id="contenido" name="contenido" value="{{ @old('contenido') }}">
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

@endsection

@section('scripts')
  <script> console.log('asasdasdssdadasdas'); </script>

@endsection
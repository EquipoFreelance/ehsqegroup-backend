@extends('dashboard.layouts.master')

@section('content')
  <div class="form_content_block">
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <br>
        <div class="x_panel">
          <div class="y_title">
            <h2><i class="fa fa-edit"></i> Ficha de Auxiliar</h2>
            <div class="clearfix"></div>
          </div>

          <div class="x_content">

            {!! Form::model($auxiliar, [ 'method' => 'PUT', 'route' => ['dashboard.auxiliar.update', $auxiliar->id], 'class' => 'form-horizontal form-label-left' ]) !!}

            @if(Session::has('message'))
              <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                <strong>¡Perfecto!</strong>{{ Session::get('message') }}
              </div>
            @endif

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="nombre">Nombre</label>
                  <input type="text" id="nombre" placeholder="Nombre" name="nombre"  class="form-control" value="{{ $auxiliar->persona->nombre }}">
                  @if ($errors->has('nombre'))
                    <label for="nombre" generated="true" class="error">{{ $errors->first('nombre') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="nom_corto">Apellido paterno</label>
                  <input type="text" id="ape_pat" placeholder="Apellido paterno" name="ape_pat"  class="form-control" value="{{ $auxiliar->persona->ape_pat }}">
                  @if ($errors->has('ape_pat'))
                    <label for="ape_pat" generated="true" class="error">{{ $errors->first('ape_pat') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="nom_corto">Apellido materno</label>
                  <input type="text" id="ape_mat" placeholder="Apellido materno" name="ape_mat"  class="form-control" value="{{ $auxiliar->persona->ape_mat }}">
                  @if ($errors->has('ape_mat'))
                    <label for="ape_mat" generated="true" class="error">{{ $errors->first('ape_mat') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="nom_corto">Fecha de nacimiento</label>
                  <input type="text" id="fe_nacimiento" placeholder="Fecha de nacimiento" name="fe_nacimiento"  class="form-control" value="{{ $auxiliar->persona->fe_nacimiento }}">
                  @if ($errors->has('direccion'))
                    <label for="fe_nacimiento" generated="true" class="error">{{ $errors->first('fe_nacimiento') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="cod_sexo">Género</label>
                  {{ Form::select('cod_sexo', array('1' => 'Masculino', '2' => 'Femenino'), $auxiliar->persona->cod_sexo, ['class' => 'form-control'] ) }}
                  @if ($errors->has('cod_sexo'))
                    <label for="cod_esp" generated="true" class="error">{{ $errors->first('cod_sexo') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="cod_doc_tip">Tipo de Documento</label>
                  {{ Form::select('cod_doc_tip', array('1' => 'DNI', '2' => 'Carnet de Extranjeria'), $auxiliar->persona->cod_doc_tip, ['class' => 'form-control'] ) }}
                  @if ($errors->has('cod_doc_tip'))
                    <label for="cod_doc_tip" generated="true" class="error">{{ $errors->first('cod_doc_tip') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="dni">DNI</label>
                  <input type="text" id="num_doc" placeholder="Número de documento" name="num_doc"  class="form-control" value="{{ $auxiliar->persona->num_doc }}">
                  @if ($errors->has('num_doc'))
                    <label for="num_doc" generated="true" class="error">{{ $errors->first('num_doc') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="nom_corto">Dirección</label>
                  <input type="text" id="direccion" placeholder="Dirección" name="direccion"  class="form-control" value="{{ $auxiliar->persona->direccion }}">
                  @if ($errors->has('direccion'))
                    <label for="direccion" generated="true" class="error">{{ $errors->first('direccion') }}</label>
                  @endif
                </div>
              </div>
            </div>

          <!--<div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="telefono">Teléfonos</label>
                  <input type="text" id="telefono" placeholder="Teléfonos" name="telefono"  class="form-control" value="">
                  @if ($errors->has('telefono'))
                    <label for="telefono" generated="true" class="error">{{ $errors->first('telefono') }}</label>
                  @endif
                </div>
              </div>
            </div>-->

            <!--<div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="correo">Correo electrónico</label>
                  <input type="text" id="correo" placeholder="Correo electrónico" name="correo"  class="form-control" value="">
                  @if ($errors->has('correo'))
                    <label for="correo" generated="true" class="error">{{ $errors->first('correo') }}</label>
                  @endif
                </div>
              </div>
            </div>-->

            <div class="form-group">
              <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                  <label for="activo">Estado</label>
                  {{ Form::select('activo', ['1' => 'Activo','0' => 'No Activo'], $auxiliar->activo, ['class' => 'form-control'] ) }}
                  @if ($errors->has('activo'))
                    <label for="activo" generated="true" class="error">{{ $errors->first('activo') }}</label>
                  @endif
                </div>
              </div>
            </div>

            <div class="ln_solid"></div>
            <div class="form-group btncontrol">
              <a href="{{ route('dashboard.auxiliar.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
              <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

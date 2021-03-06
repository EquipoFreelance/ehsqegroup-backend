@extends('dashboard.layouts.master')

@section('custom_css')

    <!-- CSS Plugin DatePicker Material -->
    <link href="{{ URL::asset('assets/js/datepicker_material/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

@stop

@section('content')
    <div class="form_content_block">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="x_panel">

                    <div class="y_title">
                        <h2><i class="fa fa-edit"></i>Editar</h2>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">

                        {!! Form::model($schedule, [ 'method' => 'PUT', 'route' => ['dashboard.academic_period.update', $schedule->id], 'class' => 'form-horizontal form-label-left' ]) !!}

                        @if(Session::has('message'))
                            <div class="alert alert-success alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                {{ Session::get('message') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="start_date">Fecha de Inicio</label>
                                    <input type="text" id="start_date" placeholder="Fecha de Inicio" name="start_date"  class="form-control" value="{{ $schedule->start_date }}">
                                    @if ($errors->has('start_date'))
                                        <label for="start_date" generated="true" class="error">{{ $errors->first('start_date') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="finish_date">Fecha de Finalización</label>
                                    <input type="text" id="finish_date" placeholder="Fecha de Finalización" name="finish_date"  class="form-control" value="{{ $schedule->finish_date }}">
                                    @if ($errors->has('finish_date'))
                                        <label for="finish_date" generated="true" class="error">{{ $errors->first('finish_date') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="observation">Observación</label>
                                    <textarea name="observation" id="observation" class="form-control">{{ $schedule->observation }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <label for="active">Estado</label>
                                    {{ Form::select('active', ['' => '-- Seleccione el estado --','1' => 'Activo','0' => 'No Activo'], $schedule->active, ['class' => 'form-control'] ) }}
                                    @if ($errors->has('active'))
                                        <label for="active" generated="true" class="error">{{ $errors->first('active') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="ln_solid"></div>

                        <div class="form-group btncontrol">
                            <a href="{{ route('dashboard.academic_period.index') }}" class="btn btn-5 btn-5a icon-return return"><span>Retornar</span></a>
                            <button type="submit" class="btn btn-5 btn-5a icon-save save"><span>Guardar</span></button>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
@stop

@section('custom_js')
    <script src="{{ URL::asset('assets/js/app-academic-period.js') }}"></script>
@stop

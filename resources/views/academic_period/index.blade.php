@extends('dashboard.layouts.master')

@section('content')
    <div class="">
        <div class="page-title">
            @if(Session::has('message'))
                <div class="alert alert-info">
                    {{ Session::get('message') }}
                </div>
            @endif
            <h1>Periodos académicos</h1>
            <p style="margin-top: 15px">Administrador Periodos académicos.</p>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <!-- INICIO TABLA FINAL -->
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">

                    <div class="x_title">
                        <a href="{{ route('dashboard.academic_period.create') }}" class="btn btn-5 btn-5a icon-add add"><span>Agregar</span></a>
                        <div class="clearfix"></div>
                    </div>

                    <div class="x_content">
                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fecha de inicio</th>
                                <th>Fecha de finalización</th>
                                <th>Observacion</th>
                                <th>Activo</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->id }}</td>
                                    <td>{{ $schedule->start_date }}</td>
                                    <td>{{ $schedule->finish_date }}</td>
                                     <td>{{ $schedule->observation }}</td>
                                    <td>
                                        <span class="label @if($schedule->active == '1') label-success @else label-danger @endif ">
                                            @if($schedule->active == '1') Activo @else No Activo @endif
                                        </span>
                                    </td>
                                    <td><a href="{{ route('dashboard.academic_period.edit', $schedule->id) }}" class="btn btn-5 btn-5a icon-edit edit"><span>Editar</span></a></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- FINAL TABLA FINAL -->
        </div>
    </div>
@stop

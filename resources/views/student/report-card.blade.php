@extends('dashboard.layouts.master')
@section('content')

  <!-- Custom Templates -->
  <script id="response-template" type="text/x-handlebars-template">

    <table class="tablex table-bordered" cellspacing="0" width="100%">
      <tr>
        <td rowspan="2" align="center" valign="middle" bgcolor="#f4f4f4">N°</td>
        <td rowspan="2" align="center" valign="middle" bgcolor="#f4f4f4">MODULOS</td>
        <td rowspan="2" align="center" valign="middle" bgcolor="#f4f4f4">EXAMEN</td>
        <td colspan="5" align="center" valign="middle" bgcolor="#f4f4f4">TALLERES</td>
        <td rowspan="2" align="center" valign="middle" bgcolor="#f4f4f4">PROM<br>
          TALLER
        </td>
        <td rowspan="2" align="center" valign="middle" bgcolor="#f4f4f4">PROM<br>
          MODULO
        </td>
      </tr>
      <tr>
          <td align="center" valign="middle" bgcolor="#f4f4f4">1</td>
          <td align="center" valign="middle" bgcolor="#f4f4f4">2</td>
          <td align="center" valign="middle" bgcolor="#f4f4f4">3</td>
          <td align="center" valign="middle" bgcolor="#f4f4f4">4</td>
          <td align="center" valign="middle" bgcolor="#f4f4f4">5</td>
      </tr>
    @{{#each data}}

      <tr>
        <td align="center">@{{ idx }}</td>
        <td align="left">@{{ module_name }}</td>
        <td align="center" valign="middle">@{{ exam }}</td>
        @{{#each workshops}}
          <td align="center" valign="middle" width="63" height="49">@{{ num_nota }}</td>
        @{{/each}}
        <td align="center" valign="middle"><strong>@{{ prom_taller }}</strong></td>
        <td align="center" valign="middle"><strong>@{{ prom_module }}</strong></td>
      </tr>

    @{{/each}}
    </table>
  </script>

  <div class="">

    <div class="page-title">
      @if(Session::has('message'))
          <div class="alert alert-info">
              {{ Session::get('message') }}
          </div>
      @endif
      <h1>Reporte de Notas por especialización </h1>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <!-- INICIO TABLA FINAL -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="y_title">
            <h2><i class="fa fa-edit"></i> Notas</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div id="headprint">
              <div class="form-group">
                <label for="especializacion_ca">Especialización</label>
                <select class="select2 form-control" id="especializacion_ca" name="especializacion_ca" data-placeholder="Seleccione la Especialización">
                  <option></option>
                </select>
                <input type="hidden" id="id_student" name="id_student" value="{{ Auth::user()->persona->persona_student->id }}" />
              </div>
            </div>
            <br>
            <div class="add_notes">

            </div>
            <br>

            <table class="tablex table-bordered add_notes_" cellspacing="0" width="100%"  style="display:none">
              <tbody><tr>
                <td align="left" valign="middle" bgcolor="#f4f4f4">PROMEDIO MODULO</td>
                <td align="center"><strong class="prom_module_final"></strong></td>
              </tr>
              <tr>
                <td align="left" valign="middle" bgcolor="#f4f4f4">NOTA PROYECTO</td>
                <td align="center"><strong class="prom_project"></strong></td>
              </tr>
              <tr>
                <td align="left" valign="middle" bgcolor="#f4f4f4">PROMEDIO DIPLOMA</td>
                <td align="center"><strong class="prom_sustent_project"></strong></td>
              </tr>
              </tbody>
            </table>

            <!--<table class="tablex table-bordered" cellspacing="0" width="100%">
              <tr>
                <td align="left" valign="middle"  bgcolor="#f4f4f4">PROMEDIO TOTAL</td>
                <td align="center"><strong>17</strong></td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#f4f4f4">PROMEDIO PROYECTO</td>
                <td align="center"><strong>17</strong></td>
              </tr>
              <tr>
                <td align="left" valign="middle"  bgcolor="#f4f4f4">PROMEDIO FINAL</td>
                <td align="center"><strong>9</strong></td>
              </tr>
            </table>-->
          </div>
        </div>
      </div>
      <!-- FINAL TABLA FINAL -->
    </div>
  </div>
@stop

@section('custom_js')
  <script src="{{ URL::asset('assets/js/app-report-card-students.js') }}"></script>
@stop

@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">OPERACIÓN DE MAQUINARIA PESADA
        </div>
        {!! Form::Open(['route'=>['alu.reportes.edit'], 'method' => 'GET'])!!}
        <div class="panel-body">
            {!! Form::hidden('id_matricula', $idmat, ['id'=>'id_matricula'] )!!}
            <label class="checkbox-inline">{!! Form::checkbox('CF', '1') !!}C.F.</label>
            <label class="checkbox-inline">{!! Form::checkbox('SCOOP', '2') !!}SCOOP</label>
            <label class="checkbox-inline">{!! Form::checkbox('EXCA', '3') !!}EXCA</label>
            <label class="checkbox-inline">{!! Form::checkbox('CGRU', '4') !!}C.GRU</label>
            <label class="checkbox-inline">{!! Form::checkbox('VVOL', '5') !!}V.VOL</label>
            <label class="checkbox-inline">{!! Form::checkbox('CMIN', '6') !!}C.MIN</label>
            <label class="checkbox-inline">{!! Form::checkbox('TORU', '7') !!}T.ORU</label>
            <label class="checkbox-inline">{!! Form::checkbox('TLLA', '8') !!}T.LLA</label>
            <label class="checkbox-inline">{!! Form::checkbox('RETRO', '9') !!}RETRO</label>
            <label class="checkbox-inline">{!! Form::checkbox('MONT', '10') !!}MONT</label>
            <label class="checkbox-inline">{!! Form::checkbox('MOTO', '11') !!}MOTO</label>
            <label class="checkbox-inline">{!! Form::checkbox('ROD', '12') !!}ROD</label>

          <div class="table-responsive">
            <div class="modal-footer">
              <input type="submit" value="Generar Reporte" class="btn btn-primary">
            </div>
          </div> 
          {!! Form::close() !!}       
        </div>
      </div>     
    </div>
  </div>
</div>

<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Seguridad
        </div>
        {!! Form::Open(['route'=>['alu.reportes.edit'], 'method'=> 'GET'])!!}
        <div class="panel-body">
          {!! Form::hidden('id_matricula', $idmat, ['id'=>'id_matricula'] )!!}
            <label class="checkbox-inline">{!! Form::checkbox('MODI', '15') !!}MOD I</label>
            <label class="checkbox-inline">{!! Form::checkbox('MODII', '16') !!}MOD II</label>
            <label class="checkbox-inline">{!! Form::checkbox('MODIII', '17') !!}MOD III</label>
            <label class="checkbox-inline">{!! Form::checkbox('MODIV', '18') !!}MOD IV</label>
            <label class="checkbox-inline">{!! Form::checkbox('MODV', '19') !!}MOD V</label>
            <label class="checkbox-inline">{!! Form::checkbox('MODVI', '20') !!}MOD VI</label>
            <label class="checkbox-inline">{!! Form::checkbox('MODVII', '21') !!}MOD VII</label>
          <div class="table-responsive">
            <div class="modal-footer">
              <input type="submit" value="Generar Reporte" class="btn btn-primary">
            </div>
          </div>
          {!! Form::close() !!}        
        </div>
      </div>     
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Mecanica Automotriz
        </div>
        <div class="panel-body">
          {!! Form::hidden('id_matricula', $idmat, ['id'=>'id_matricula'] )!!}
            <label class="checkbox-inline"><input type="checkbox" value="">Ciclo I</label>
            <label class="checkbox-inline"><input type="checkbox" value="">Ciclo II</label>
            <label class="checkbox-inline"><input type="checkbox" value="">Ciclo III</label>
            <label class="checkbox-inline"><input type="checkbox" value="">Ciclo IV</label>
            <label class="checkbox-inline"><input type="checkbox" value="">Ciclo V</label>
            <label class="checkbox-inline"><input type="checkbox" value="">Ciclo VI</label>
            <label class="checkbox-inline"><input type="checkbox" value="">Ciclo VII</label>
          <div class="table-responsive">
          </div>
          <div class="modal-footer">
              <input type="submit" value="Generar Reporte" class="btn btn-primary" data-toggle='modal' data-target="#Loading" >
          </div>        
        </div>
      </div>     
    </div>
  </div>
</div>
@endsection

@section('scripts')
@endsection
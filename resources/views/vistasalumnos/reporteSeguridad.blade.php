@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">SEGURIDAD MINERA E INDUSTRIAL
        </div>
        {!! Form::Open(['route'=>['alu.reportesSeguridad.show'], 'method' => 'GET'])!!}
        <div class="panel-body">
            {!! Form::hidden('id_matricula', $idmat, ['id'=>'id_matricula'] )!!}
<div class="panel-body">
    <div class="row">
        <div class="form-group">
            <div class="searchable-container">
                <div class="items col-xs-5 col-sm-5 col-md-3 col-lg-3">
                    <div class="info-block block-info clearfix">
                        <div class="square-box pull-left">
                            <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                        </div>
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    <input type="checkbox" name="MODI" autocomplete="off" value="15">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h6>MODULO I</h6>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="items col-xs-5 col-sm-5 col-md-3 col-lg-3">
                    <div class="info-block block-info clearfix">
                        <div class="square-box pull-left">
                            <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                        </div>
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    <input type="checkbox" name="MODII" autocomplete="off" value="16">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>MODULO II</h5>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="items col-xs-5 col-sm-5 col-md-3 col-lg-3">
                    <div class="info-block block-info clearfix">
                        <div class="square-box pull-left">
                            <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                        </div>
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    <input type="checkbox" name="MODIII" autocomplete="off" value="17">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>MODULO III</h5>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="items col-xs-5 col-sm-5 col-md-3 col-lg-3">
                    <div class="info-block block-info clearfix">
                        <div class="square-box pull-left">
                            <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                        </div>
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    <input type="checkbox" name="MODIV" autocomplete="off" value="18">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>MODULO IV</h5>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="items col-xs-5 col-sm-5 col-md-3 col-lg-3">
                    <div class="info-block block-info clearfix">
                        <div class="square-box pull-left">
                            <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                        </div>
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    <input type="checkbox" name="MODV" autocomplete="off" value="19">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>MODULO V</h5>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="items col-xs-5 col-sm-5 col-md-3 col-lg-3">
                    <div class="info-block block-info clearfix">
                        <div class="square-box pull-left">
                            <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                        </div>
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    <input type="checkbox" name="MODVI" autocomplete="off" value="20">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>MODULO VI</h5>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="items col-xs-5 col-sm-5 col-md-3 col-lg-3">
                    <div class="info-block block-info clearfix">
                        <div class="square-box pull-left">
                            <span class="glyphicon glyphicon-tags glyphicon-lg"></span>
                        </div>
                        <div data-toggle="buttons" class="btn-group bizmoduleselect">
                            <label class="btn btn-default">
                                <div class="bizcontent">
                                    <input type="checkbox" name="MODVII" autocomplete="off" value="21">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>MODULO VII</h5>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
          <div class="table-responsive">
            <div class="modal-footer">
              <input type="submit" value="Generar Reporte" class="btn btn-success">
            </div>
          </div> 
          {!! Form::close() !!}       
        </div>
      </div>     
    </div>
  </div>
</div>

@endsection

@section('scripts')
{!!Html::style('/css/styleCheckbox.css')!!}
{!! Html::script('/js/checkbox.js')!!}
@endsection
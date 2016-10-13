@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">OPERACIÓN DE MAQUINARIA PESADA
        </div>
        {!! Form::Open(['route'=>['alu.reportesOperacion.show'], 'method' => 'GET'])!!}
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
                                    <input type="checkbox" name="CF" autocomplete="off" value="1">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h6>CARGADOR FRONTAL</h6>
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
                                    <input type="checkbox" name="SCOOP" autocomplete="off" value="2">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>SCOOP</h5>
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
                                    <input type="checkbox" name="EXCA" autocomplete="off" value="3">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>EXCAVADORA</h5>
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
                                    <input type="checkbox" name="CGRU" autocomplete="off" value="4">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>CAMIÓN GRUA</h5>
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
                                    <input type="checkbox" name="VVOL" autocomplete="off" value="5">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>VOLQUETE VOLVO</h5>
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
                                    <input type="checkbox" name="CMIN" autocomplete="off" value="6">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>CAMIÓN MINERO</h5>
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
                                    <input type="checkbox" name="TORU" autocomplete="off" value="7">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>TRACTOR ORUGA</h5>
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
                                    <input type="checkbox" name="TLLA" autocomplete="off" value="8">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>TRACTOR LLANTAS</h5>
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
                                    <input type="checkbox" name="RETRO" autocomplete="off" value="9">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h6>RETRO EXCAVADORA</h6>
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
                                    <input type="checkbox" name="MONT" autocomplete="off" value="10">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>MONTA CARGA</h5>
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
                                    <input type="checkbox" name="MOTO" autocomplete="off" value="11">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>MOTONIVELADORA</h5>
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
                                    <input type="checkbox" name="ROD" autocomplete="off" value="12">
                                    <span class="glyphicon glyphicon-ok glyphicon-lg"></span>
                                    <h5>RODILLO</h5>
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
@extends('app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
			<div class="panel-heading"> Crear Semestre </div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover">
						<thead>
							<tr>
								<th>#</th>
								<th>carrera</th>
								<th>Ciclo</th>
							</tr>
						</thead>
						<tbody>
							@foreach($semestres as $semestre)
									<tr data-id="{{$semestre->id}}">
										<td>{{$semestre->id}}</td>
										<td>{{$semestre->carreras->nombre}}</td>
										<td>{{$semestre->ciclo}}</td>
										<td>
		                    				<a href="#" class="btn btn-success btn-xs"><span class="glyphicon glyphicon-eye-open"></span></a>
		                    				<a href="#" class="btn btn-danger btn-xs" ><span class="glyphicon glyphicon-remove"></span></a>
		                				</td>
									</tr>	
							@endforeach
						</tbody>
					</table>
					{!! $semestres->setPath('')->render() !!}
					<a href="#!" data-toggle='modal' class='btn btn-primary' data-target="#crearCiclo">Nuevo Registro</a>
				</div>
			</div>
		</div>
	</div>

</div>
@endsection
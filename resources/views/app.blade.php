<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<title>FLAVISUR</title>
	<link href="{{ url('img/flavisur.png') }}" type="image/x-icon" rel="shortcut icon" />
	<!--<link href="{{ asset('/css/app.css') }}" rel="stylesheet">-->
	<!--{!!Html::style('/css/app.css')!!}
	
	{!!Html::style('/css/datepicker.css')!!}-->
	
	{!!Html::style('/css/estilos.css')!!}
	{!!Html::style('/css/buttons.css')!!}	
	{!! Html::style('bower_components/bootstrap/dist/css/bootstrap.min.css')!!}
	{!! Html::style('bower_components/jquery-ui/themes/smoothness/jquery-ui.min.css')!!}
	{!! Html::style('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')!!}
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
</head >
<body class="fondo">
	<nav class="navbar navbar-inverse">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="">
					<img src="{{ url('img/logo.jpg') }}" height="30">
				</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					@if(Auth::guest())
					<li><a href="{{ url('/home') }}">Home</a></li>
					@else
						<li><a href="{{ url('/admin/usuarios') }}">Usuarios</a></li>
						<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Mantenimiento<span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
							  <li><a tabindex="-1" href="{{ url('/alu/alumnos')}}">Alumnos</a></li>
							  <li><a tabindex="-1" href="{{ url('/alu/notasAntiguas')}}">Registro De Notas Operación 1 año</a></li>
							  <li><a tabindex="-1" href="{{ url('/alu/notasAntiguasOP2')}}">Registro De Notas Operación 2 años</a></li>
							</ul>
						</li>
						<li class="dropdown"><a href="#" class = "dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Matriculas<span class="caret"></span></a>
							<ul  class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
								<li><a tabindex="-1" href="{{ url('/cetpromatricula/matriculacetpro')}}" >CETPRO</a></li>
								
								<li class="divider"></li>
								<!--<li><a tabindex="-1" href="{{ url('/institutomatricula/matricula')}}">INSTITUTO</a></li>-->
							</ul>
						</li>
						<li class="dropdown"><a href="#" class = "dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Registro de notas<span class="caret"></span></a>
							<ul  class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
								<li><a tabindex="-1" href="{{ url('/usuarios/calificacionescetpro')}}">CETPRO</a></li>
								<li class="divider"></li>
								<!--<li><a tabindex="-1" href="{{ url('/usuarios/calificaciones')}}" >INSTITUTO</a></li>-->
							</ul>
						</li>
						<li class="dropdown"><a href="#" class = "dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Plan de Estudios<span class="caret"></span></a>
							<ul  class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
								<li><a tabindex="-1" href="{{ url('/planestudio/carrera')}}">Carreras</a></li>
								<li><a tabindex="-1" href="{{ url('/planestudio/curso')}}">Cursos</a></li>
								<li><a tabindex="-1" href="{{ url('/planestudio/semestre')}}">Semestres</a></li>
							</ul>
						</li>
						<li class="dropdown"><a href="#" class = "dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Grupos<span class="caret"></span></a>
							<ul  class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
								<li><a tabindex="-1" href="{{ url('/generalgrupo/grupocetpro')}}">CETPRO</a></li>
								<li class="divider"></li>
								<!--<li><a tabindex="-1" href="{{ url('/generalgrupo/grupo')}}">INSTITUTO</a></li>-->
							</ul>
						</li>
						<!--<li class="dropdown"><a href="#" class = "dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reportes<span class="caret"></span></a>
							<ul  class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
								<li class="disabled" role="presentation"><a  tabindex="-1" href="#">CETPRO</a></li>
								<li ><a  tabindex="-1" href="{{ url('/reportes/alumnosCetpro')}}">Nominas</a></li>
								<li ><a  tabindex="-1" href="{{ url('/reportes/alumnosCetpro/create')}}">Notas</a></li>
								<li class="divider"></li>
								<li><a tabindex="-1" href="{{ url('/generalgrupo/grupo')}}">INSTITUTO</a></li>

							</ul>
						</li>
						<li class="dropdown"><a href="#" class = "dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Pagos<span class="caret"></span></a>
							<ul  class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
								<li class="disabled" role="presentation"><a  tabindex="-1" href="#">CETPRO</a></li>
								<li ><a  tabindex="-1" href="{{ url('/pagos/pensiones')}}">Registrar Pagos</a></li>
								<li class="divider"></li>
								<li><a tabindex="-1" href="{{ url('/generalgrupo/grupo')}}">INSTITUTO</a></li>

							</ul>
						</li>-->

					@endif
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/') }}">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
								<li><a href="{{ route('admin.usuariosAcciones.edit') }}">Cambiar Contraseña</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')
	<!-- Scripts -->
	{!!  Html::script('bower_components/jquery/dist/jquery.min.js') !!}
	{!!  Html::script('bower_components/jquery/dist/jquery.js') !!}
	{!!  Html::script('bower_components/moment/min/moment.min.js')!!}
	{!!  Html::script('bower_components/bootstrap/dist/js/bootstrap.min.js') !!}
	{!!  Html::script('bower_components/jquery-ui/jquery-ui.min.js')!!}
	{!!  Html::script('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') !!}

	@yield('scripts')

</body>
</html>

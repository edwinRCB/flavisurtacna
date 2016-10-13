<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>
		@section('titulo')
			SISTEMA FLAVISUR
		@show
	</title>
		@section('cabeera')
			<link rel="stylesheet" type="text/css" href="">
		@show
</head>
<body>
		@yield('content')
</body>
		<footer>
			@yield('footer','mi pie de pagina')
		</footer>
</html>
<html>
	<head>
		<title>FLAVISUR TACNA</title>
		
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

		<style>
			body {
				margin: 0;
				padding: 0;
				width: 100%;
				height: 100%;
				color: #B0BEC5;
				display: table;
				font-weight: 100;
				font-family: 'Lato';
				
			}
			.fondo{
				background: url('../img/354740-admin.jpg') center center no-repeat fixed;
				background-size: cover;

			}
			.container {
				text-align: center;
				display: table-cell;
				vertical-align: middle;
			}

			.content {
				text-align: center;
				display: inline-block;
			}

			.title {
				font-size: 96px;
				margin-bottom: 40px;
			}

			.quote {
				font-size: 24px;
			}

		</style>
		<link href="{{ url('img/flavisur.png') }}" type="image/x-icon" rel="shortcut icon" />
	</head>
	<body class="fondo"> </body>
		<div class="container">
  <div class="row">
    <div class="col-md-14 col-md-offset-0">
      <div class="panel panel-default">
       
        <div class="panel-body">
          <div class="alert alert-dismissible alert-success">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          </div>

      
        </div>
      </div>     
      <!--@include('vistasalumnos/crear')-->
    </div>
  </div>
</div>
			<a href="{{ url('/home')}}"><img src="{{ url('img/admin.gif') }}" height="150" align="top"></a>
	</body>
</html>

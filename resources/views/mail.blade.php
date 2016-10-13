@extends('layouts.principal')
@section('content')
	<!-- mail -->
	</div>
	<div class="mail">
		<!-- container -->
		<div class="container">
			<div class="map footer-middle wow bounceIn animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3794.4679094143257!2d-70.25583868546362!3d-18.00347588594128!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTjCsDAwJzEyLjUiUyA3MMKwMTUnMTMuMSJX!5e0!3m2!1ses!2spe!4v1448033234539" frameborder="0" style="border:0"></iframe>
			</div>
			<div class="mail-grids">
				<div class="col-md-6 mail-grid-left wow fadeInLeft animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<h3>CONTACTENOS</h3>
					<h5>Puedes contactarnos mediante la dirección, teléfonos <span>o puede mandarnos un mensaje. </span></h5>
					<h4>Dirección</h4>
					<p>CALLE PATRICIO MELENDEZ 1020.
						<span>Tacna</span>
						Tacna
					</p>
					<h4>Contacto</h4>
					<p>Telefono: 
						<span>Cel.: </span>
						<a>E-mail: flavisurtacna@gmail.com</a>
					</p>
				</div>
				<div class="col-md-6 contact-form wow fadeInRight animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					{!! Form::open(['route'=>'sendmail.store', 'method'=>'POST'])!!}
						<input type="text" placeholder="Nombres" required="" name="nombres">
						<input type="text" placeholder="Email" required="" name="email">
						<input type="text" placeholder="Asunto" required="" name="asunto">
						<textarea placeholder="Mensaje" required="" name="mensaje"></textarea>
						<input type="submit" value="SEND">
					{!! Form::close() !!}
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<!-- //container -->
	</div>
	<!-- //mail -->
@stop	
@extends('layouts.principal')
@section('content')
		<!-- //container DESDE AQUIIIIIIIIIIIIII -->
		
		<div class="container">
				<!--<!! Html::script('js/templatejs/responsiveslides.min.js')!!>-->
				<script src="js/templatejs/responsiveslides.min.js"></script>
					 <script>
						// You can also use "$(window).load(function() {"
						$(function () {
						  // Slideshow 4
						  $("#slider3").responsiveSlides({
							auto: true,
							pager: true,
							nav: false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });
					
						});
					  </script>
			<div  id="top" class="callbacks_container">
				<ul class="rslides" id="slider3">
					<li>
						<div class="banner-info">
								<h2>Operacion Maquinaria Pesada</h2>  
								<div class="line"> </div>
								<p>Carrera corta de 1 años de duracion</p>
						</div>
					</li>
					<li>
						<div class="banner-info">
								<h2>Make your <span> journey </span> truck in United Kingdom</h2>
								<div class="line"> </div>
								<p>Eget rhoncus nulla rutrum sit amet. Ut sodales erat tortor Aliquam sit amet lorem dui. Donec quis suscipit tortor vel pellentesque libero Nulla sagittis dolor id mi tincidunt varius</p>
						</div>
					</li>
					<li>
						<div class="banner-info">
								<h2>Provider <span> Volvo Trucks </span> truck in Ukraine</h2>
								<div class="line"> </div>
								<p>Eget rhoncus nulla rutrum sit amet. Ut sodales erat tortor Aliquam sit amet lorem dui. Donec quis suscipit tortor vel pellentesque libero Nulla sagittis dolor id mi tincidunt varius</p>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- //banner -->
	<!-- banner-bottom -->
	<div class="banner-bottom">
		<!-- container -->
		<div class="container">
			<div class="banner-bottom-grids">
				<div class="col-md-7 banner-bottom-grid-text">
					<div class="jumbotron banner-bottom-left wow fadeInLeft animated" data-wow-delay="0.5s" style="visibility: visible; -webkit-animation-delay: 0.5s;	">
					  <h3>FLAVISUR TACNA </h3>
						<h5>Cras porttitor imperdiet volutpat. Nulla malesuada lectus eros ut convallis felis <span>consectetur ut</span></h5>
						<p>Proin eget ipsum ultrices, aliquet velit eget, tempus tortor. Phasellus non velit sit amet diam faucibus molestie. Mauris sapien eros, mattis et elit non, tincidunt efficitur nisi augue dui iaculis nulla, a pretium nisl turpis vel augue auctor viverra aliquam .</p>
						<div class="see-button">
							<a class="btn btn-primary btn-lg see-button hvr-shutter-out-horizontal" href="about.html" role="button">See More</a>
						</div>
					</div>
				</div>
				<div class="col-md-5 banner-bottom-right wow fadeInRight animated" data-wow-delay="0.5s" style="visibility: visible; -webkit-animation-delay: 0.5s;">
					<img src="images/2.jpg" alt=""/>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		<!-- //container -->
	</div>
	<!-- //banner-bottom -->
	<!-- specialty -->
	<div class="specialty">
		<!-- container -->
		<div class="container">
			<div class="col-md-5 specialty-info wow fadeInLeft animated" data-wow-delay="0.5s" style="visibility: visible; -webkit-animation-delay: 0.5s;">
				<h3>Nuestras Carreras</h3>
				<h5>Cras porttitor imperdiet volutpat nulla malesuada lectus eros ut convallis felis consectetur ut </h5>
				<p>Integer vitae ligula sed lectus consectetur pellentesque blandit nec orci. Nulla ultricies nunc et lorem semper, quis accumsan dui aliquam aucibus sagittis placerat.
					<span>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi non nibh nec enim sollicitudin interdum.tristique senectus et netus et malesuada fames ac turpis egestas</span>
				</p>
				<div class="see-button">
					<a class="btn btn-primary btn-lg see-button hvr-shutter-out-horizontal specialty-button" href="services.html" role="button">See More</a>
				</div>
			</div>
			<div class="col-md-7 specialty-grids">
				<div class="specialty-grids-top">
					<div class="col-md-6 service-box wow fadeInRight animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
						<figure class="icon">
							<img src="images/1.png" alt="" />
						</figure>
						<h5>Proin eget ipsum ultrices</h5>
						<p>Sed ut perspiciis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
					</div>
					<div class="col-md-6 service-box wow fadeInLeft animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
						<figure class="icon">
							<img src="images/2.png" alt="" />
						</figure>
						<h5>Proin eget ipsum ultrices</h5>
						<p>Sed ut perspiciis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="specialty-grids-top">
					<div class="col-md-6 service-box wow fadeInRight animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
						<figure class="icon">
							<img src="images/3.png" alt="" />
						</figure>
						<h5>Proin eget ipsum ultrices</h5>
						<p>Sed ut perspiciis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
					</div>
					<div class="col-md-6 service-box wow fadeInLeft animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
						<figure class="icon">
							<img src="images/4.png" alt="" />
						</figure>
						<h5>Proin eget ipsum ultrices</h5>
						<p>Sed ut perspiciis iste natus error sit voluptatem accusantium doloremque laudantium.</p>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
			<div class="clearfix"> </div>
		</div>
		<!-- //container -->
	</div>
	<!-- //specialty -->
	<!-- testimonials -->
	<div class="testimonials">
		<div class="container">
			<div class="testimonial-nfo wow fadeInLeft animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
				<h3>Testimonials</h3>
				<h5>Cras porttitor imperdiet volutpat nulla malesuada lectus eros <span>ut convallis felis consectetur ut </span></h5>
			</div>
			<div class="testimonial-grids wow fadeInRight animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
				<div class="testimonial-grid">
					<p><span>"</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam fermentum iaculis diam quis sodales. Vestibulum eu dui tellus. In viverra porttitor auctor. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas<span> "</span></p>
				</div>
			</div>
		</div>
	</div>
	<!-- //testimonials -->
	<!-- news -->
	<div class="news">
		<div class="container">
			<div class="news-text">
				<h3>Novedades</h3>
				<h5>Cras porttitor imperdiet volutpat nulla malesuada lectus eros <span>ut convallis felis consectetur ut </span></h5>
			</div>
			<div class="news-grids">
				<div class="col-md-3 news-grid wow fadeInLeft animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<a href="single.html"><h4>Integer vitae ligula sed lectus</h4></a>
					<span>8.00 - 10.00 | JUN 09,2014</span>
					<img src="images/img1.jpg" alt="" />
					<div class="news-info">
						<p>Pellentesque ut urna eu mauris scele risque auctor volutpat et massa pers piciis iste natus scele risque auctor volutpat et massa.</p>
					</div>
				</div>
				<div class="col-md-3 news-grid wow fadeInLeft animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<a href="single.html"><h4>Integer vitae ligula sed lectus</h4></a>
					<span>10.00 - 12.00 | sep 24,2014</span>
					<img src="images/img2.jpg" alt="" />
					<div class="news-info">
						<p>Pellentesque ut urna eu mauris scele risque auctor volutpat et massa pers piciis iste natus scele risque auctor volutpat et massa.</p>
					</div>
				</div>
				<div class="col-md-3 news-grid wow fadeInRight animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<a href="single.html"><h4>Integer vitae ligula sed lectus</h4></a>
					<span>9.00 - 10.00 | FEB 15,2014</span>
					<img src="images/img3.jpg" alt="" />
					<div class="news-info">
						<p>Pellentesque ut urna eu mauris scele risque auctor volutpat et massa pers piciis iste natus scele risque auctor volutpat et massa.</p>
					</div>
				</div>
				<div class="col-md-3 news-grid wow fadeInRight animated" data-wow-delay="0.4s" style="visibility: visible; -webkit-animation-delay: 0.4s;">
					<a href="single.html"><h4>Integer vitae ligula sed lectus</h4></a>
					<span>11.00 - 10.00 | JUN 10,2014</span>
					<img src="images/img4.jpg" alt="" />
					<div class="news-info">
						<p>Pellentesque ut urna eu mauris scele risque auctor volutpat et massa pers piciis iste natus scele risque auctor volutpat et massa.</p>
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div>
	<!-- //news --HASTA AQUIIIIIIIIIIIIIIII>
	<!-- footer -->
@stop	
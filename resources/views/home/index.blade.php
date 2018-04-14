@extends('template.main')

@section('title')
Início
@stop

@section('content')
<section class="section-slide pb-5">
	<div class="owl-carousel">
		<div class="item">
			<img src="images/pictures/slide1.jpg" class="img-fluid" />
		</div>
	</div>
</section>
<section class="section-principal py-3">
	<div class="container">
		<div class="heading-title">
			<h2>Eventos <span>destaques</span></h2>
		</div>
		<div class="eventos-lista py-3">
			<div class="row">
				<div class="col-md-3 col-sm-3 col-12">
					<a href="#" class="evento-item scroll-effect" style="background-image: url(images/pictures/evento.jpg)">
						<div class="evento-data">10/02</div>
						<h1>Camarote Galo</h1>
					</a>
				</div>
				<div class="col-md-3 col-sm-3 col-12">
					<a href="#" class="evento-item scroll-effect" style="background-image: url(images/pictures/evento.jpg)">
						<div class="evento-data">10/02</div>
						<h1>Camarote Galo</h1>
					</a>
				</div>
				<div class="col-md-3 col-sm-3 col-12">
					<a href="#" class="evento-item scroll-effect" style="background-image: url(images/pictures/evento.jpg)">
						<div class="evento-data">10/02</div>
						<h1>Camarote Galo</h1>
					</a>
				</div>
				<div class="col-md-3 col-sm-3 col-12">
					<a href="#" class="evento-item scroll-effect" style="background-image: url(images/pictures/evento.jpg)">
						<div class="evento-data">10/02</div>
						<h1>Camarote Galo</h1>
					</a>
				</div>
				<div class="col-md-3 col-sm-3 col-12">
					<a href="#" class="evento-item scroll-effect" style="background-image: url(images/pictures/evento.jpg)">
						<div class="evento-data">10/02</div>
						<h1>Camarote Galo</h1>
					</a>
				</div>
				<div class="col-md-3 col-sm-3 col-12">
					<a href="#" class="evento-item scroll-effect" style="background-image: url(images/pictures/evento.jpg)">
						<div class="evento-data">10/02</div>
						<h1>Camarote Galo</h1>
					</a>
				</div>
				<div class="col-md-3 col-sm-3 col-12">
					<a href="#" class="evento-item scroll-effect" style="background-image: url(images/pictures/evento.jpg)">
						<div class="evento-data">10/02</div>
						<h1>Camarote Galo</h1>
					</a>
				</div>
				<div class="col-md-3 col-sm-3 col-12">
					<a href="#" class="evento-item scroll-effect" style="background-image: url(images/pictures/evento.jpg)">
						<div class="evento-data">10/02</div>
						<h1>Camarote Galo</h1>
					</a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section-newsletter" style="background-image: url('images/pictures/newsletter.jpg')">
	<div class="container">
		<form class="form-newsletter">
			<div class="row w-75 mx-auto">
				<div class="col-md-12 col-12 text-center">
					<h2 class="titulo">Newsletter</h2>
					<p class="text-white pb-2">Assine e fique por dentro do mundo da música!</p>
				</div>
				<div class="col-lg-10 col-md-9 col-12">
					<input type="email" name="email" class="form-control form-newsletter-input" />
				</div>
				<div class="col-lg-2 col-md-3 col-12">
					<button type="button" class="btn btn-success btn-rounded btn-assinar">Assinar</button>
				</div>
			</div>
		</form>
	</div>
</section>
<footer class="footer-principal">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-3 col-12">
				<h2>Formas de Pagamento</h2>
				<img src="images/pictures/formas-pagamento.png" class="img-fluid" style="" />
			</div>
			<div class="col-md-3 col-sm-3 col-12">
				<h2>Institucional</h2>
				<ul>
					<li><a href="#">Sobre nós</a></li>
					<li><a href="#">Central de Ajuda</a></li>
					<li><a href="#">Serviços</a></li>
					<li><a href="#">Entre em Contato</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-3 col-12">
				<h2>Políticas</h2>
				<ul>
					<li><a href="#">Políticas de Vendas</a></li>
					<li><a href="#">Políticas de Privacidade</a></li>
				</ul>
			</div>
			<div class="col-md-3 col-sm-3 col-12">
				<ul class="lista-horizontal mt-3">
					<li>
						<a href="#" class="rede-social-item"><i class="fa fa-facebook"></i></a>
					</li>
					<li>
						<a href="#" class="rede-social-item"><i class="fa fa-instagram"></i></a>
					</li>
					<li>
						<a href="tel:" class="rede-social-item"><i class="fa fa-phone"></i></a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</footer>
<footer class="footer-secundaria">
	<div class="container">
		© Desenvolvido por Agência Incrível
	</div>
</footer>
@stop
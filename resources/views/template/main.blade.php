<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>VIP Ingressos - @yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="stylesheet" href="css/app.css">
    <script src="js/app.js"></script>
    <script src="https://unpkg.com/scrollreveal/dist/scrollreveal.min.js"></script>
    {{-- <script src="js/owl.carousel.min.js"></script> --}}
	<script src="js/index.js"></script>
</head>

<body>
    <main>
        <section class="mobile-nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-12">
                        <a href="javascript:void(0);" class="toggle-menu mt-4"><i class="fa fa-times"></i></a>
                        <ul class="nav-personalizada mt-4">
                            <li>
                                <a href="#">Home</a>
                            </li>
                            <li>
                                <a href="#">Sobre a empresa</a>
                            </li>
                            <li>
                                <a href="#">Entre em contato</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <header class="header-mobile">
            <div class="container">
                <div class="row">
                    <div class="col-5 pl-0">
                        <a href="javascript:void(0);" class="toggle-menu scroll-effect"><i class="fa fa-bars"></i></a>
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#buscaModal" class="scroll-effect"><i class="fa fa-search"></i></a>
                    </div>
                    <div class="col-7 text-right">
                        <img src="http://vipingresso.com.br/img/logopequena.png" class="header-logo scroll-effect" alt="Loke Serv">
                    </div>
                </div>
            </div>
        </header>
        <header class="header-info">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <ul class="lista-horizontal">
                            <li><i class="fa fa-phone"></i> 0800 793 4044</li>
                            <li><a href="#" class="text-dark">Atendimento</a></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul class="lista-horizontal pull-right">
                            <li><a href="#" class="text-dark"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="text-dark"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="#" class="text-dark"><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
        <header class="header-principal">
            <div class="container">
                <div class="row scroll-effect">
                    <div class="col-3 col-md-3">
                        <img src="http://vipingresso.com.br/img/logopequena.png" class="img-fluid logo" />
                    </div>
                    <div class="col-6 col-md-6">
                        <form class="form-busca">
                            <input type="text" class="form-control form-input-busca" placeholder="Buscar eventos, shows, teatros ..." name="query" />
                            <button type="submit" class="form-btn-busca"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="col-3 col-md-3">
                        <ul class="itens-right">
                            <li>
                                <a href="#" class="btn btn-sm btn-rounded btn-primary mr-2 scroll-effect">Ajuda</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#entrarModal" class="btn btn-rounded btn-secondary scroll-effect">Entrar</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
    </main>
    
    <main role="main" id='main-container'>
        @yield('content')
    </main>

    <!-- Modal Entrar -->
    <div class="modal fade" id="entrarModal" tabindex="-1" role="dialog" aria-labelledby="entrarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="entrarModalLabel">Entrar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-login font-xs" id="form-login">
                        <div class="row">
                            <div class="col-12 text-center">
                                <a href="#" class="btn btn-primary btn-facebook text-uppercase w-100 my-2">Conectar com o Facebook <i class="fa fa-facebook"></i></a>
                                <p class="divider">ou</p>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="email" name="email" class="form-control" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Senha</label>
                                    <input type="password" name="senha" class="form-control" />
                                </div>
                            </div>
                            <div class="col-12">
                                <a href="#">Esqueci minha senha</a>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-success w-100 text-uppercase my-3 py-2">Entrar</button>
                                <div class="alert alert-danger alert-dismissible fade text-left" role="alert" id="loginErrorAlert">
                                    <strong>Seu usuário não foi encontrado</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <p class="divider mb-1">ou</p>
                                <a href="#" class="text-dark font-weight-b">Faça seu cadastro</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Busca -->
    <div class="modal fade modal-busca" id="buscaModal" tabindex="-1" role="dialog" aria-labelledby="buscaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-busca-modal font-xs">
                        <div class="row">
                            <div class="col-9">
                                <input type="text" name="query" placeholder="Buscar eventos, shows, teatros ..." class="form-control" />
                            </div>
                            <div class="col-3">
                                <button type="button" class="btn-submit-busca"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
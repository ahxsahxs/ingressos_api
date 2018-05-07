jQuery(function($){
    
    $('.carrinho-aberto').on('click', function () {
        ctrl.toggleCarrinho();
    });
    
    var ctrl = {
        toggleCarrinho: function () {
            $('main').toggleClass('carrinho-aberto');
        }
    }
    
    $('main.carrinho-aberto').on('click', function () {
        ctrl.toggleCarrinho();
    });
    
    $(document).on('scroll', function () {
        $('.header-info').toggleClass('d-none', $(document).scrollTop() >= 150);
    });
    
    $(".toggle-menu").click(function () {
        $('.mobile-nav').toggleClass('aberto');
    });
    
    window.sr = ScrollReveal();
    sr.reveal('.scroll-effect, .header, .box-servico, .box-icone', {duration: 1000});
    
    // $('.owl-carousel').owlCarousel({
    //     loop: true,
    //     items: 1,
    //     nav: false,
    // });

    $("#form-login").submit(function(evt) {
        evt.preventDefault();
        let email = $(this).find('input[name="email"]').val();
        let password = $(this).find('input[name="senha"]').val();

        let params = {
            email: email,
            password: password
        };

        $.post('api/auth/login', params, function(response) {
            console.log(response);
        });
    });
});
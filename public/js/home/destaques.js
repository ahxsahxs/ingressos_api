function templateDestaque(destaque) {
    return '<div class="col-md-3 col-sm-3 col-12">'+
                '<a href="#" class="evento-item scroll-effect" style="background-image: url('+destaque.img+')">'+
                    '<div class="evento-data">'+destaque.data+'</div>'+
                    '<h1>'+destaque.nome+'</h1>'+
                '</a>'+
            '</div>';
}

function loadDestaques() {
    let destaquesContainer = $('#lista-destaques');
    $.get('/api/evento/destaques/8')
        .done(response => {
            response.destaques.forEach(destaque => {
                destaquesContainer.append(templateDestaque(destaque));
            });
        });
}

$(function() {
    loadDestaques();
});
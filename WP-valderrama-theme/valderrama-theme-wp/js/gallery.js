
function reload(el, ob){
    var id = !ob ? el.attr("name") : "place";
    $('.carousel').carousel("pause").removeData();
    $('.carousel').carousel({interval:false});
    $("#"+id+" div").each(function(index, element) {
        var item = $(element).html();
        $('.carousel-inner').append(item);
    });

    $('.carousel-indicators li').removeClass('active');
    $('.carousel-indicators').append('<li data-target="#carousel" data-slide-to="1" class="active"></li>');
    $('.carousel').carousel(0);

    $carrusel = $('#carousel').data();
    $carrusel["bs.carousel"].interval = 100;
    $carrusel["bs.carousel"].pause = false;
    $carrusel["bs.carousel"].sliding = true;

    $('.carousel').carousel('next');
}

$(function(){
    $('#carousel').carousel({
        interval: 3000
    });
});

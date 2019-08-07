!function ($) {

  $(function(){
 

		/*$(".nav .bs-sidenav li").hover(
			function (){
				$(this).animate({ 'width': "300px", "height" : "300px"});
			},
			function (){
				$(this).animate({ 'width': "100px", "height" : "100px"});
			}
		);

		$(".navbar-nav li").hover(
			function (){
				$(this).addClass('hover');
			},
			function (){
				$(this).removeClass('hover');
			}
		);*/
		
		/*$("#toolnavbar li a").click(function (){
				$(this).addClass('glyphicon my');
		});*/
		
		
		
		
		
		
		
		
	/*
	 $('.navbar-nav li').hover(function (e) {
		var temp = $('.navbar-nav').children;
		for(var i=0;i<= temp.legth;i++){
			$('.navbar-nav').children[i].removeClass('active');
		}
		$(this).addClass('active');	 
    })*/
/*  var $window = $(window)
    var $body   = $(document.body)

    var navHeight = $('.navbar').outerHeight(true) + 10

    $body.scrollspy({
      target: '.bs-sidebar',
      offset: navHeight
    })

    $window.on('load', function () {
      $body.scrollspy('refresh')
    })
	
    $('.bs-docs-container [href=#]').click(function (e) {
      e.preventDefault()
    })

    // back to top
    setTimeout(function () {
      var $sideBar = $('.bs-sidebar')

      $sideBar.affix({
        offset: {
          top: function () {
            var offsetTop      = $sideBar.offset().top
            var sideBarMargin  = parseInt($sideBar.children(0).css('margin-top'), 10)
            var navOuterHeight = $('.bs-docs-nav').height()

            return (this.top = offsetTop - navOuterHeight - sideBarMargin)
          }
        , bottom: function () {
            return (this.bottom = $('.bs-footer').outerHeight(true))
          }
        }
      })
    }, 100)

    setTimeout(function () {
      $('.bs-top').affix()
    }, 100)
/*
    // tooltip demo
    $('.tooltip-demo').tooltip({
      selector: "[data-toggle=tooltip]",
      container: "body"
    })

    $('.tooltip-test').tooltip()
    $('.popover-test').popover()

    $('.bs-docs-navbar').tooltip({
      selector: "a[data-toggle=tooltip]",
      container: ".bs-docs-navbar .nav"
    })

    // popover demo
    $("[data-toggle=popover]")
      .popover()

    // button state demo
    $('#fat-btn')
      .click(function () {
        var btn = $(this)
        btn.button('loading')
        setTimeout(function () {
          btn.button('reset')
        }, 3000)
      })

    // carousel demo
    $('.bs-docs-carousel-example').carousel()*/
})

}(window.jQuery)

window.onload=function (){
    var settingsItemsMap = {
        zoom: 12,
        center: new google.maps.LatLng(40.768516981, -73.96927308),
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.LARGE
        },
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById('mapa'), settingsItemsMap );

    var myMarker = new google.maps.Marker({
        position: new google.maps.LatLng(40.768516981, -73.96927308),
        draggable: false
    });

    map.setCenter(myMarker.position);
    myMarker.setMap(map);
}
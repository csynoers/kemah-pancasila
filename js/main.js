$(document).ready(function(){
    var slider2 = $('#slider2');
    slider2.owlCarousel({

        animateOut: 'fadeOut',
        responsiveClass: true,
        nav: true,
        responsive: {
            760: {
                items: 3,
            },

            300: {
                items: 1,
            },
        }
    });


    $('[data-toggle="tooltip"]').tooltip();

});

//portfolio
    $(window).load(function(){
        $grid = $('.grid').isotope({
          // options
          itemSelector: '.grid-item',
          layoutMode: 'fitRows'
        });
        // filter items on button click
        $('#filter-kategori a').on( 'click', function() {
          var filterValue = $(this).attr('data-filter');
          $grid.isotope({ filter: filterValue });
        });
    });

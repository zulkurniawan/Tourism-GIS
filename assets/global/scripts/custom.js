$(document).ready(function() {

    // $('#modal-info-kontributor').on('shown.bs.modal', function() {
    //     $('[data-appear-animation]').appear();
    //     $(document.body).on('appear', '[data-appear-animation]', function(e, $affected) {
    //         var $el = $(this);

    //         var delay = ($el.data('animationDelay') ? $el.data('animationDelay') : 1);

    //         if (delay > 1) $el.css('animation-delay', delay + 'ms');

    //         $el.addClass('animated').addClass($el.data('appearAnimation'));
    //     });
    // });

    $('.show-kontributor').owlCarousel({
        loop: true,
        margin: 30,
        nav: true,
        responsive: {
            0: {
                nav: false,
                items: 1
            },
            640: {
                nav: false,
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });

    $('[data-appear-animation]').appear();
    $(document.body).on('appear', '[data-appear-animation]', function(e, $affected) {
        var $el = $(this);

        var delay = ($el.data('animationDelay') ? $el.data('animationDelay') : 1);

        if (delay > 1) $el.css('animation-delay', delay + 'ms');

        $el.addClass('animated').addClass($el.data('appearAnimation'));
    });



    // function testAnim(x) {
    //     $('.modal .modal-dialog').attr('class', 'modal-dialog  ' + x + '  animated');
    // };
    // $('#modal-info-kontributor').on('show.bs.modal', function(e) {
    //     var anim = $('#entrance').val();
    //     testAnim(anim);
    // })
    // $('#modal-info-kontributor').on('hide.bs.modal', function(e) {
    //     var anim = $('#exit').val();
    //     testAnim(anim);
    // })


    $('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
          var $this = $(this),
              label = $this.prev('label');

              if (e.type === 'keyup') {
                    if ($this.val() === '') {
                  label.removeClass('active highlight');
                } else {
                  label.addClass('active highlight');
                }
            } else if (e.type === 'blur') {
                if( $this.val() === '' ) {
                    label.removeClass('active highlight'); 
                    } else {
                    label.removeClass('highlight');   
                    }   
            } else if (e.type === 'focus') {
              
              if( $this.val() === '' ) {
                    label.removeClass('highlight'); 
                    } 
              else if( $this.val() !== '' ) {
                    label.addClass('highlight');
                    }
            }

        });

        $('.tab a').on('click', function (e) {
          
          e.preventDefault();
          
          $(this).parent().addClass('active');
          $(this).parent().siblings().removeClass('active');
          
          target = $(this).attr('href');

          $('.tab-content > div').not(target).hide();
          
          $(target).fadeIn(600);
          
        });


});

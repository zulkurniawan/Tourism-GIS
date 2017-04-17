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
});

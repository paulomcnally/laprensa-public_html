(function($) {
    $(function() {
        /*
        Carousel initialization
        */
        $('#sponsors .jcarousel')
            .jcarousel({
                wrap: 'circular'
            }).jcarouselAutoscroll({
                autostart: true
            });
        $('.imgnav .jcarousel')
            .jcarousel({
                wrap: 'circular',
                animation: 'slow'
            });
            $("#gallerynav li a").click(function(event) {
                  $(".photo .title").text($(this).attr('title'));
                  $(".photo img").attr('src',$(this).attr('href'));
                  return false;
                  }
            );

        /*
         Prev control initialization
         */
        $('.jcarousel-control-prev')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                // Options go here
                target: '-=1'
            });

        /*
         Next control initialization
         */
        $('.jcarousel-control-next')
            .on('jcarouselcontrol:active', function() {
                $(this).removeClass('inactive');
            })
            .on('jcarouselcontrol:inactive', function() {
                $(this).addClass('inactive');
            })
            .jcarouselControl({
                // Options go here
                target: '+=1'
            });

        /*
         Pagination initialization
         */
        $('.jcarousel-pagination')
            .on('jcarouselpagination:active', 'a', function() {
                $(this).addClass('active');
            })
            .on('jcarouselpagination:inactive', 'a', function() {
                $(this).removeClass('active');
            })
            .jcarouselPagination({
                // Options go here
            });
    });
})(jQuery);

( function( $ ) {
    /**
     * @param $scope The Widget wrapper element as a jQuery element
     * @param $ The jQuery alias
     */
    var WidgetCMSItemCarouselHandler = function( $scope, $ ) {
        var breakpoints = elementorFrontend.config.breakpoints;
        var carousel = $scope.find(".cms-slick-carousel");
        var data = carousel.data();
        if (!carousel.hasClass('indent-right')){
            if (typeof data != 'undefined'){
                var slickOptions = {
                    slidesToShow: data.slidestoshow,
                    slidesToScroll: data.slidestoscroll,
                    autoplay: true === data.autoplay,
                    autoplaySpeed: data.autoplayspeed,
                    infinite: false === data.infinite,
                    pauseOnHover: true === data.pauseonhover,
                    speed: data.speed,
                    arrows: true === data.arrows,
                    dots: true === data.dots,
                    rtl: 'rtl' === data.dir,
                    responsive: [{
                        breakpoint: breakpoints.lg,
                        settings: {
                            slidesToShow: data.slidestoshowtablet,
                            slidesToScroll: data.slidestoscrolltablet,
                        }
                    }, {
                        breakpoint: breakpoints.md,
                        settings: {
                            slidesToShow: data.slidestoshowmobile,
                            slidesToScroll: data.slidestoscrollmobile,
                        }
                    }]
                };
                carousel.slick(slickOptions);
            }
        }else{
            var indent_space = '130px';
            if (carousel.hasClass('large-space')){
                indent_space = '235px';
            }
            if (typeof data != 'undefined'){
                var slickOptions = {
                    slidesToShow: data.slidestoshow,
                    speed: data.speed,
                    arrows: true === data.arrows,
                    dots: true === data.dots,
                    centerMode: true,
                    centerPadding: indent_space,
                    responsive: [
                        {
                            breakpoint: 1205,
                            settings: {
                                centerMode: true,
                                centerPadding: '0',
                                slidesToShow: 1
                            }
                        },
                    ]
                };
                carousel.slick(slickOptions);
            }
        }
    };


    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/cms_testimonial_carousel.default', WidgetCMSItemCarouselHandler );
    } );
} )( jQuery );
(function($){

    $(document).ready(function(){

        function rd_navbar_init(){

            var rdNavbar = $(".rd-navbar");
            if (rdNavbar.length) {
              rdNavbar.RDNavbar({
                stickUpClone: (rdNavbar.attr("data-stick-up-clone")) ? rdNavbar.attr("data-stick-up-clone") === 'true' : false
                //stickUpClone: true
              });
              if (rdNavbar.attr("data-body-class")) {
                document.body.className += ' ' + rdNavbar.attr("data-body-class");
              }
            }

            var rdSearchToggle = $('.rd-navbar-search-toggle');
            if ( rdSearchToggle.length ) {

                rdSearchToggle.on('click', function () {
                    if( $(this).hasClass('active') )
                        document.getElementById('rd-navbar-search-form-input').focus();
                });
            }
        }
        rd_navbar_init();

        function sliderInit() {
            var $slider = $(".banner-slider");
            $slider.each(function () {
                var $sliderParent = $(this).parent();
                $(this).on("init", function (event, slick, currentSlide) {
                    var i = (currentSlide ? currentSlide : 0) + 1;
                    $sliderParent.find(".sliderCounterMain .slider-counter-number").html(i);
                    var slidename = $(".slick-active .banner-slider-title").attr("data-slide-name");
                    $(".slider-counter-text").html(slidename);
                });
                $(this).slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    dots: true,
                    fade: true,
                    autoplay: false,
                    autoplaySpeed: 2000,
                    infinite: true,
                    responsive: [
                        {
                            breakpoint: 767,
                            settings: {
                                adaptiveHeight: true,
                            },
                        },
                    ],
                });

                if ($(this).find(".slick-slide").length > 1) {
                    $(this).siblings(".sliderCounterMain").show();
                }
                $(this).on("afterChange", function (event, slick, currentSlide) {
                    var i = (currentSlide ? currentSlide : 0) + 1;
                    $sliderParent.find(".sliderCounterMain .slider-counter-number").html(i);
                    var slidename = $(".slick-active .banner-slider-title").attr("data-slide-name");
                    $(".slider-counter-text").html(slidename);
                });
            });
        }
        sliderInit();

        
    });
  
})(jQuery);

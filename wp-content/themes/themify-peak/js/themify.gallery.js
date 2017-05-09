/**
 * Creates the header fullwidth slider functionality
 */
;
(function ($) {

    function highlight(items) {
        items.addClass('current-slide');
    }
    function unhighlight() {
        $('#gallery-controller li').removeClass('current-slide');
    }
    function changeImage(items) {
        var bgImage = items.filter(':first').attr('data-bg');
        $.backstretch(bgImage);
        $('.backstretch').filter(function () {
            return $(this).parent('body').length > 0;
        }).slice(0, -2).remove();
    }

    $(window).load(function () {

        /////////////////////////////////////////////
        // Slider
        /////////////////////////////////////////////
        if ($('#gallery-controller').length > 0) {
            Themify.LoadAsync(themify_vars.url + '/js/backstretch.js', function () {
                Themify.LoadAsync(themify_vars.url + '/js/carousel.js', ThemifyGalleryInit, null, null, function () {
                    return ('undefined' !== typeof $.fn.carouFredSel);
                });
            }, null, null, function () {
                return ('undefined' !== typeof $.fn.backstretch);
            });

        }
        function ThemifyGalleryInit() {

            var itemIndex = ($('#gallery-controller li').length > 5) ? '0' : '1';
            $('#gallery-controller .slides').carouFredSel({
                responsive: true,
                circular: themifyScript.wrap,
                infinite: themifyScript.wrap,
                prev: {
                    button: '#gallery-controller .carousel-prev',
                    key: 'left',
                    onBefore: function (items) {
                        var newItems = items.items.visible;
                        unhighlight();
                        changeImage(newItems);
                    },
                    onAfter: function (items) {
                        var newItems = items.items.visible;
                        highlight(newItems.filter(':eq(0)'));
                    }
                },
                next: {
                    button: '#gallery-controller .carousel-next',
                    key: 'right',
                    onBefore: function (items) {
                        var newItems = items.items.visible;
                        unhighlight();
                        changeImage(newItems);
                    },
                    onAfter: function (items) {
                        var newItems = items.items.visible;
                        highlight(newItems.filter(':eq(' + itemIndex + ')'));
                    }
                },
                width: '100%',
                auto: {
                    play: themifyScript.play,
                    timeoutDuration: themifyScript.autoplay,
                    button: '#gallery-controller .carousel-playback'
                },
                swipe: true,
                scroll: {
                    items: 1,
                    duration: themifyScript.speed,
                    onBefore: function (items) {
                        var newItems = items.items.visible;
                        unhighlight();
                        changeImage(newItems);
                    },
                    onAfter: function (items) {
                        var newItems = items.items.visible;
                        highlight(newItems.filter(':eq(' + itemIndex + ')'));
                    }
                },
                items: {
                    visible: 5,
                    minimum: 1,
                    width: 20
                },
                onCreate: function () {
                    $('#gallery-controller').css({
                        'height': 'auto',
                        'visibility': 'visible'
                    });

                    $('#headerwrap.header-gallery').addClass('header-gallery-ready');

                    $('#gallery-controller .carousel-next, #gallery-controller .carousel-prev').wrap('<div class="carousel-arrow"/>');
                    $('#gallery-controller .caroufredsel_wrapper + .carousel-nav-wrap').remove();

                    $('#gallery-controller li:first').addClass('current-slide');

                    if ($('#gallery-controller li').length > 2) {
                        $('.carousel-playback').css('display', 'inline-block');
                    }

                    if (!themifyScript.play) {
                        $('.carousel-playback').hide();
                    }
                }
            }).find("li").click(function () {
                $('#gallery-controller li').removeClass('current-slide');
                $(this).addClass('current-slide');
                $('#gallery-controller li').trigger("slideTo", [
                    $(this),
                    0,
                    false,
                    {
                        items: 1,
                        duration: 300,
                        onBefore: function (items) {
                        },
                        onAfter: function (items) {
                        }
                    },
                    null,
                    'next']);


                // Set image and index using current data properties
                changeImage($(this));

            }
            ).css("cursor", "pointer");

            /////////////////////////////////////////////
            // Initialize fullscreen background
            /////////////////////////////////////////////

            var themifyImages = [];

            // Initialize images array with URLs
            $('#gallery-controller li').each(function () {
                themifyImages.push($(this).attr('data-bg'));
            });

            $(themifyImages).each(function () {
                $("<img/>").attr('src', this);
            });

            // Call backstretch for the first time
            $.backstretch(themifyImages[0], {
                fade: themifyScript.speed
            });

            // Header Background Color
            var $headerColor = $('#headerwrap[data-bgcolor]');
            if ($headerColor.length > 0) {
                var bgColor = $headerColor.data('bgcolor');
                if ($headerColor.hasClass('header-gallery')) {
                    $('.backstretch').css('background-color', '#' + bgColor);
                }
            }
        }
        // end if #gallery-controller
    });

    $(document).ready(function () {

        /////////////////////////////////////////////
        // Parse injected vars
        /////////////////////////////////////////////
        themifyScript.autoplay = parseInt(themifyScript.autoplay, 10);
        if (themifyScript.autoplay <= 10) {
            themifyScript.autoplay *= 1000;
        }
        themifyScript.speed = parseInt(themifyScript.speed, 10);
        themifyScript.play = themifyScript.play != 'no';
        themifyScript.wrap = themifyScript.wrap != 'no';

        ////////////////////////
        // Add wrap for styling
        ////////////////////////
        $('#gallery-controller img').each(function () {
            $(this).wrap('<span class="image-wrap" style="width: auto; height: auto;"/>');
            $(this).removeAttr('class');
        });

        /////////////////////////////////////////////
        // Pause carousel
        /////////////////////////////////////////////
        $('.carousel-playback').click(function () {
            $(this).toggleClass('paused');
        });

    });

}(jQuery));
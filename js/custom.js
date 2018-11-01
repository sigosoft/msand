$(document).ready(function ()
{
	//Fade in delay for the background overlay (control timing here)
	$("#bkgOverlay").delay(4800).fadeIn(400);
  //Fade in delay for the popup (control timing here)
	$("#delayedPopup").delay(5000).fadeIn(400);

	//Hide dialouge and background when the user clicks the close button
	$("#btnClose").click(function (e)
	{
		HideDialog();
		e.preventDefault();
	});
});
//Controls how the modal popup is closed with the close button
function HideDialog()
{
	$("#bkgOverlay").fadeOut(400);
	$("#delayedPopup").fadeOut(300);
}






(function ($) {

    // Ripple-effect animation
    $(".ripple-effect").click(function (e) {
        var rippler = $(this);

      	rippler.append("<span class='ink'></span>");

        var ink = rippler.find(".ink:last-child");
        // prevent quick double clicks
        ink.removeClass("animate");

        // set .ink diametr
        if (!ink.height() && !ink.width()) {
            var d = Math.max(rippler.outerWidth(), rippler.outerHeight());
            ink.css({
                height: d,
                width: d
            });
        }

        // get click coordinates
        var x = e.pageX - rippler.offset().left - ink.width() / 2;
        var y = e.pageY - rippler.offset().top - ink.height() / 2;

        // set .ink position and add class .animate
        ink.css({
            top: y + 'px',
            left: x + 'px'
        }).addClass("animate");

        // remove ink after 1second from parent container
        setTimeout(function(){
        	ink.remove();
        },1000)
    })



// Ripple-effect-All animation
   function fullRipper(color,time){
       setTimeout(function(){
            var rippler = $(".ripple-effect-All");
            if(rippler.find(".ink-All").length == 0){
                rippler.append("<span class='ink-All'></span>");


                var ink = rippler.find(".ink-All");
                // prevent quick double clicks
                //ink.removeClass("animate");

                // set .ink diametr
                if (!ink.height() && !ink.width()) {
                    var d = Math.max(rippler.outerWidth(), rippler.outerHeight());
                    ink.css({
                        height: d,
                        width: d
                    });
                }

                // get click coordinates
                var x =0;
                var y =rippler.offset().top - ink.height()/3.5;

                // set .ink position and add class .animate
                ink.css({
                    top: y + 'px',
                    left: x + 'px',
                    background:color
                }).addClass("animate");

                rippler.css('z-index',2);

                setTimeout(function(){
                    ink.css({
                        '-webkit-transform': 'scale(2.5)',
                        '-moz-transform': 'scale(2.5)',
                        '-ms-transform': 'scale(2.5)',
                        '-o-transform': 'scale(2.5)',
                        'transform': 'scale(2.5)'
                    })
                    rippler.css('z-index',0);
                },1500);
            }
       },time)

    }

    // Form control border-bottom line
    $('.blmd-line .form-control').bind('focus',function(){
        $(this).parent('.blmd-line').addClass('blmd-toggled').removeClass("hf");
    }).bind('blur',function(){
        var val=$(this).val();
        if(val){
            $(this).parent('.blmd-line').addClass("hf");
        }else{
            $(this).parent('.blmd-line').removeClass('blmd-toggled');
        }
    })

    // Change forms
    $(".blmd-switch-button").click(function(){
        var _this=$(this);
        if(_this.hasClass('active')){
            setTimeout(function(){
                _this.removeClass('active');
                $(".ripple-effect-All").find(".ink-All").remove();
                $(".ripple-effect-All").css('z-index',0);
            },1300);
            $(".ripple-effect-All").find(".ink-All").css({
                '-webkit-transform': 'scale(0)',
                '-moz-transform': 'scale(0)',
                '-ms-transform': 'scale(0)',
                '-o-transform': 'scale(0)',
                'transform': 'scale(0)',
                'transition':'all 1.5s'
            })
            $(".ripple-effect-All").css('z-index',2);
            $('#Register-form').addClass('form-hidden')
            .removeClass('animate');
            $('#login-form').removeClass('form-hidden');
        }else{
            fullRipper("#6b1b78",750);
            _this.addClass('active');
            setTimeout(function(){
                $('#Register-form').removeClass('form-hidden')
                .addClass('animate');
                $('#login-form').addClass('form-hidden');
            },2000)

        }
    })
})(jQuery);
$(window).load(function() {
    jQuery('#all').click();
    return false;
});

$(document).ready(function() {
    $('#header_wrapper').scrollToFixed();
    $('.res-nav_click').click(function() {
        $('.main-nav').slideToggle();
        return false

    });

    function resizeText() {
        var preferredWidth = 767;
        var displayWidth = window.innerWidth;
        var percentage = displayWidth / preferredWidth;
        var fontsizetitle = 25;
        var newFontSizeTitle = Math.floor(fontsizetitle * percentage);
        $(".divclass").css("font-size", newFontSizeTitle)
    }
    if ($('#main-nav ul li:first-child').hasClass('active')) {
        $('#main-nav').css('background', 'none');
    }
    $('#mainNav').onePageNav({
        currentClass: 'active',
        changeHash: false,
        scrollSpeed: 950,
        scrollThreshold: 0.2,
        filter: '',
        easing: 'swing',
        begin: function() {
        },
        end: function() {
            if (!$('#main-nav ul li:first-child').hasClass('active')) {
                $('.header').addClass('addBg');
            } else {
                $('.header').removeClass('addBg');
            }

        },
        scrollChange: function($currentListItem) {
            if (!$('#main-nav ul li:first-child').hasClass('active')) {
                $('.header').addClass('addBg');
            } else {
                $('.header').removeClass('addBg');
            }
        }
    });

    var container = $('#portfolio_wrapper');


    container.isotope({
        animationEngine: 'best-available',
        animationOptions: {
            duration: 200,
            queue: false
        },
        layoutMode: 'fitRows'
    });

    $('#filters a').click(function() {
        $('#filters a').removeClass('active');
        $(this).addClass('active');
        var selector = $(this).attr('data-filter');
        container.isotope({
            filter: selector
        });
        setProjects();
        return false;
    });

    function splitColumns() {
        var winWidth = $(window).width(),
            columnNumb = 1;


        if (winWidth > 1024) {
            columnNumb = 4;
        } else if (winWidth > 900) {
            columnNumb = 2;
        } else if (winWidth > 479) {
            columnNumb = 2;
        } else if (winWidth < 479) {
            columnNumb = 1;
        }

        return columnNumb;
    }

    function setColumns() {
        var winWidth = $(window).width(),
            columnNumb = splitColumns(),
            postWidth = Math.floor(winWidth / columnNumb);

        container.find('.portfolio-item').each(function() {
            $(this).css({
                width: postWidth + 'px'
            });
        });
    }

    function setProjects() {
        setColumns();
        container.isotope('reLayout');
    }

    container.imagesLoaded(function() {
        setColumns();
    });


    $(window).bind('resize', function() {
        setProjects();
    });

   $(".fancybox").fancybox();
});

wow = new WOW({
    animateClass: 'animated',
    offset: 100
});
wow.init();
document.getElementById('').onclick = function() {
    var section = document.createElement('section');
    section.className = 'wow fadeInDown';
    section.className = 'wow shake';
    section.className = 'wow zoomIn';
    section.className = 'wow lightSpeedIn';
    this.parentNode.insertBefore(section, this);
};

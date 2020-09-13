// jQuery(function() {
//     jQuery('.included').click(function() {
//         var index = $(this).parent().index(),
//             newTarget = jQuery('.dropdown-content').eq(index);
//         jQuery('.dropdown-content').not(newTarget).slideUp('fast')
//         newTarget.delay('fast').slideToggle('fast')
//         return false;
//     })
// });


// Can also be used with $(document).ready()7



$(document).ready(function() {
    $('.main-slider').flexslider({
        animation: "fade", // fade, slide, ...
        slideshowSpeed: 7000,
        animationSpeed: 1000,
        controlNav: false,
        initDelay: 0,
        directionNav: true,
        touch: true,
        autoplay: true

    });
})



$(document).ready(function() {
    $('.room_type_slider').flexslider({
        animation: "fade", // fade, slide, ...
        slideshowSpeed: 7000,
        animationSpeed: 1000,
        paginationSpeed : 400,
        controlNav: false,
        initDelay: 0,
        directionNav: false,
        touch: true,
        autoplay: true

    });
})

$(document).ready(function() {
    $('.service-slider').flexslider({
        animation: "slide", // fade, slide, ...
        slideshowSpeed: 7000,
        animationSpeed: 1000,
        controlNav: false,
        initDelay: 0,
        directionNav: true,
        touch: true,
        autoplay: true

    });
})

// Can also be used with $(document).ready()7
$(document).ready(function() {
    $('.testimonial-slider').flexslider({
        animation: "slide", // fade, slide, ...
        slideshowSpeed: 7000,
        animationSpeed: 1000,
        controlNav: false,
        initDelay: 0,
        directionNav: true,
        touch: true,
        autoplay: true

    });
})



var fs = $('.testi_slider'),
    dataItem = fs.data('item'),
    item = fs.find('.item');

// Wrap divs
for (var i = 0; i < item.length; i+=dataItem) {
  item.slice(i, i+dataItem).wrapAll('<div class="items"></div>');
}

// Initialize flexslider
$(window).ready(function() {
  fs.flexslider({
    selector: '.slides > .items',
    animation: "slide",
    animationLoop: false,
    directionNav: true,
    slideshow: false,
    smoothHeight: true,
    itemMargin: 0,
    minItems: 1,
    autoplay: true,
    touch: true,
    maxItems: 1
  });
});


// Can also be used with $(document).ready()7
$(document).ready(function() {
    $('.room-detail-slider').flexslider({
        animation: "slide", // fade, slide, ...
        slideshowSpeed: 6000,
        animationSpeed: 1000,
        controlNav: false,
        initDelay: 0,
        directionNav: true,
        touch: true,
        autoplay: true

    });
})



// Can also be used with $(document).ready()7
$(document).ready(function() {
    $('.room-listing-slider').flexslider({
        animation: "slide", // fade, slide, ...
        slideshowSpeed: 6000,
        animationSpeed: 1000,
        controlNav: false,
        initDelay: 0,
        directionNav: true,
        touch: true,
        autoplay: true

    });
})

// Can also be used with $(document).ready()7
$(document).ready(function() {
    $('.category-slider').flexslider({
        animation: "slide", // fade, slide, ...
        slideshowSpeed: 6000,
        animationSpeed: 1000,
        controlNav: false,
        initDelay: 0,
        directionNav: true,
        touch: true,
        autoplay: true

    });
})


// Can also be used with $(document).ready()7
$(document).ready(function() {
    $('.room-display-image-wrapper').flexslider({
        animation: "slide", // fade, slide, ...
        slideshowSpeed: 6000,
        animationSpeed: 1000,
        controlNav: false,
        initDelay: 0,
        directionNav: true,
        touch: true,
        autoplay: false,

    });
})




// Get the element with id="defaultOpen" and click on it
// document.getElementById("defaultOpen").click();





$(document).ready(function() {

    $(window).scroll(function() {
        if ($(this).scrollTop() > 80) {
            $('header').addClass("sticky");
        } else {
            $('header').removeClass("sticky");
        }
    });
});


$(document).ready(function() {

    $(window).scroll(function() {
        if ($(this).scrollTop() > 80) {
            $('.inner-page-form').addClass("sticky");
        } else {
            $('.inner-page-form').removeClass("sticky");
        }
    });
});



$(document).ready(function() {

    $(window).scroll(function() {
        width = $(window).width();
        if (width > 992) {
            if ($(this).scrollTop() > 590) {
                $('.room-booking-form-sec').addClass("fixed");
            } else {
                $('.room-booking-form-sec').removeClass("fixed");
            }
        }

    });
});

// $(window).on('load', function() {
//     width = $(window).width();
//     if (width < 992) {
//         $('.room-booking-form-sec').removeClass("fixed");
//     }

// });



$(function() { //run when the DOM is ready
    $(".top-menu-bar").click(function() { //use a class, since your ID gets mangled
        $(this).toggleClass("active"); //add the class to the clicked element
        $('.main-navigation').toggleClass("open");
    });
});




// ===== Scroll to Top ==== 
$(window).scroll(function() {
    if ($(this).scrollTop() >= 50) { // If page is scrolled more than 50px
        $('#return-to-top').fadeIn(200); // Fade in the arrow
    } else {
        $('#return-to-top').fadeOut(200); // Else fade out the arrow
    }
});
$('#return-to-top').click(function() { // When arrow is clicked
    $('body,html').animate({
        scrollTop: 0 // Scroll to top of body
    }, 1500);
});




wow = new WOW({
    boxClass: 'wow', // default
    animateClass: 'animated', // default
    offset: 0, // default
    mobile: true, // default
    live: true // default
})
wow.init();




$(document).ready(function() {
    $('.drop-menu').on('click', function() {
        $(this).find('div.sub-menu').slideToggle(500);
    })
})





$(function() { //run when the DOM is ready
    $(".trigger-button").click(function() { //use a class, since your ID gets mangled
        $(this).toggleClass("active"); //add the class to the clicked element
        $('.small-sticky-form-book-form ').toggleClass("open");
        if ($(this).hasClass('active')) {
            $('.small-form-trigger-button').html('Close');
        } else {
            $('.small-form-trigger-button').html('Book Now');

        }
    });
});



$('.moreless-button').click(function() {
    $(this).parent('div').children('ul.moretext').slideToggle();
    if ($(this).parent('div').hasClass('less-content')) {
        //   alert('hello');
        $(this).parent('div').removeClass('less-content');
        $(this).html('Show more <i class=" fa fa-angle-down"></i>');
    } else {
        //   alert('not found');
        $(this).parent('div').addClass('less-content');
        $(this).text("Show less").html('Show Less <i class=" fa fa-angle-up"></i>');

    }
    //   if($('.moretext').hasClass('less-content')){
    //       $('.moretext').addClass('less-content');
    //       $(this).text("Show less").html('Show Less <i class=" fa fa-angle-down"></i>');
    //   } else {
    //       $(this).html('Show more <i class=" fa fa-angle-down"></i>');
    //   }

});





$(document).on('click', '.main-navigation a[href^="#"]', function(event) {
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
});


$(document).ready(function() {
    $('.room-select').on('change', function(e) {
        e.preventDefault();
        console.log('hello');
    });
});


// animated select form //



$(document).ready(function() {
    $('.included').on('click', function() {
        $(this).parent().next('.dropdown-content').slideToggle(500);
        //$('.dropdown-content').slideToggle(500);
    })
});

$(document)


$(document).ready(function() {
    $('.add-room-btn').on('click', function() {
        $('.add-room-form').slideToggle(500);
        //$('.dropdown-content').slideToggle(500);
    })
});







$(document).ready(function() {
    $('.trigger').click(function() {
        $('.modal-wrapper').toggleClass('open');
        $('.page-wrapper').toggleClass('blur');
        return false;
    });
});



$(document).ready(function() {
    $("#options.dropdown").click(function() {
        $("ul.sub_menu").slideToggle(50);
    });
    $("#options.dropdown ul.sub_menu li").click(function() {
        $("div.title").text($(this).text());
    });
});

$(document).ready(function() {
    $("#options1.dropdown1").click(function() {
        $("ul.sub_menu1").slideToggle(50);
    });
    $("#options1.dropdown1 ul.sub_menu1 li").click(function() {
        $("div.title1").text($(this).text());
    });
});

$(document).ready(function() {
    $("#options2.dropdown5").click(function() {
        $("ul.sub_menu2").slideToggle(50);
    });
    $("#options2.dropdown5 ul.sub_menu2 li").click(function() {
        $("div.title2").text($(this).text());
    });
});




$('.filter-icon').on('click', function() {
    $(this).parent().next('.filter-container').slideToggle(50);
});











$(function() { //run when the DOM is ready
    $(".book-top-btn").click(function() { //use a class, since your ID gets mangled
        $('.room-booking-form-sec').removeClass("fixed");
        $(this).toggleClass("active"); //add the class to the clicked element
        $('.inner-page-form').toggleClass("open");
    });
});


$(document).ready(function() {
    $('.sub-category-btn').on('click', function() {
        id = $(this).data('id');
        console.log(id);

        $('#room' + id).slideToggle(500);
    })
});



$(".drop-menu").click(function(){
    $(".main-navigation").removeClass("open");
    $(".top-menu-bar").removeClass("active");
  });


  $(document).mouseup(function(e){
    var container = $(".drop-item,.filter-container");
    // If the target of the click isn't the container
    if(!container.is(e.target) && container.has(e.target).length === 0){
        container.hide();
    }
});



$(document).ready(function(){
    $(".room-btn").click(function() {
        $('html,body').animate({                                                          //  fine in moz, still quicker in chrome. 
            scrollTop: $("#form_section").offset().top},
            'slow');
    });
     }); 


     

     $(".new-room-btn").click(function(){
        $(".inner-page-form").toggleClass("open");
        $(".new-room-btn").removeClass("active");
      });










      
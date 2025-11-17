
$(document).ready(function(){
    var $niceSelect = $('.fsh-nice-select');
    
    // Nice Select 
    if ($niceSelect.length > 0){
        $($niceSelect).niceSelect();
    }

    
    // Accordion Sub Mobile Menu
    function accordion2() {
        var Accordion2 = function(el, multiple) {
            this.el = el || $(document); 
            this.multiple = multiple || false;
            var links = this.el.find('.mobile-dropitem-a-have-sub');
            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown);
        };
        Accordion2.prototype.dropdown = function(e) {
            var $el = e.data.el,
                $this = $(this), 
                $next = $this.next();
            $next.slideToggle(); 
            $this.parent().toggleClass('active-mobile-sub-submenu'); 
            if (!e.data.multiple) {
                $el.find('.mobile-subdrop-menu').not($next).slideUp().parent().removeClass('active-mobile-sub-submenu');
            }
        };
        $('.mobile-dropdown-menu').each(function() {
            new Accordion2($(this), false); 
        });
    }
    accordion2();
    // Accordion Sub Mobile Menu

    // Mega Dropdown
    function accordion3() {
        var Accordion3 = function(el, multiple) {
            this.el = el || $(document); 
            this.multiple = multiple || false;
            var links = this.el.find('.mega-nav-link-have-sub');
            links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown);
        };
        Accordion3.prototype.dropdown = function(e) {
            var $el = e.data.el,
                $this = $(this), 
                $next = $this.next();
            $next.slideToggle(); 
            $this.parent().toggleClass('active-mega-nav-sub'); 
            if (!e.data.multiple) {
                $el.find('.mega-nav-dropdown').not($next).slideUp().parent().removeClass('active-mega-nav-sub');
            }
        };
        $('.mega-nav').each(function() {
            new Accordion3($(this), false); 
        });
    }
    accordion3();
    // Mega Dropdown


    // Increment decrement 
    $(".quantity-btn").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find(".quantity-of-product").val();
        $button.blur();
        if ($button.hasClass("inc")) {
            var newVal = parseFloat(oldValue) + 1;
          } else {
         // Don't allow decrementing below zero
          if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
          } else {
            newVal = 0;
          }
        }
        $button.parent().find(".quantity-of-product").val(newVal);
    });

    // Increment decrement 
    $(".quantity-btn2").on("click", function() {
        var $button = $(this);
        var oldValue = $button.parent().find(".quantity-of-product2").val();
        $button.blur();
        if ($button.hasClass("incree")) {
            var newVal = parseFloat(oldValue) + 1;
          } else {
         // Don't allow decrementing below zero
          if (oldValue > 0) {
            var newVal = parseFloat(oldValue) - 1;
          } else {
            newVal = 0;
          }
        }
        $button.parent().find(".quantity-of-product2").val(newVal);
    });
    


    // Password Show Hide 
    $(".toggle-password").click(function() {
        $(this).toggleClass("lock unlock");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
    });


    // Image zoom plugin code
    if ($('.image-zoom-active').length > 0){
        let zoomImage = $(".image-zoom-active");
        zoomImage.each(function() {
            $(this).imageZoom({ zoom: 200 });
        });
    };



    if ($('.mixitup').length > 0) {
        var containerEl = document.querySelector('.mixitup'); 
        var mixer = mixitup(containerEl, {
            load: {
                filter: 'all'
            },
            animation: {
                effectsIn: 'fade translateY(-100%)',
                effects: 'fade translateZ(-100px)'
            }
        });
     };

    // Testimonial 
    if ($('.testimonial').length > 0) {
        var testimonial = new Swiper(".testimonial", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            speed: 1000,
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            breakpoints: {
                576: {
                  slidesPerView: 1,
                  spaceBetween: 30,
                },
                768: {
                  slidesPerView: 2,
                  centeredSlides: true,
                  spaceBetween: 20,
                },
                992: {
                  slidesPerView: 2.5,
                  centeredSlides: true,
                  spaceBetween: 20,
                },
                1200: {
                  slidesPerView: 3,
                  spaceBetween: 20,
                },
            },
        });
     };

    // Testimonial 
    if ($('.sponsor-slider').length > 0) {
        var testimonial = new Swiper(".sponsor-slider", {
            slidesPerView: 'auto',
            spaceBetween: 70,
            centeredSlides: true,
            loop: true,
            freeMode: true,
            speed: 5000,
            autoplay: {
                delay: 1,
                disableOnInteraction: false,
            },
        });
    };

    // Shopping Cart Slider 
    if ($('.shopping-cart-slider').length > 0) {
        (function(){
            const prevButton = document.querySelector('.cart-slider-prev-btn');
            const nextButton = document.querySelector('.cart-slider-next-btn');
            const shoppingcart = new Swiper('.shopping-cart-slider', {
              loop: true,
              slidesPerView: 1,
              spaceBetween: 20,
              autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                },
            });
            prevButton.addEventListener('click',()=>{
                shoppingcart.slidePrev();
            });
            nextButton.addEventListener('click',()=>{
                shoppingcart.slideNext();
            });
            const buttonIsEdge = ()=>{
              if( shoppingcart.isBeginning ){
                prevButton.classList.add('is-edge');
              }else{
                prevButton.classList.remove('is-edge');
              }
              if( shoppingcart.isEnd ){
                nextButton.classList.add('is-edge');
              }else{
                nextButton.classList.remove('is-edge');
              }
            }
            buttonIsEdge();
            shoppingcart.on('slideChange',()=>{
              buttonIsEdge();    
            });
        })();

    };

    // Product Slider 
    if ($('.products-slider').length > 0) {
        (function(){
            const prevButton = document.querySelector('.products-slider-prev-btn');
            const nextButton = document.querySelector('.products-slider-next-btn');
            const shoppingcart = new Swiper('.products-slider', {
              loop: true,
              slidesPerView: 1,
              spaceBetween: 20,
              autoplay: {
                delay: 5000,
                disableOnInteraction: false,
              },
              breakpoints: {
                576: {
                  slidesPerView: 2,
                },
                768: {
                  slidesPerView: 2,
                },
                992: {
                  slidesPerView: 3,
                },
                1200: {
                  slidesPerView: 4,
                },
              },
            });
            prevButton.addEventListener('click',()=>{
                shoppingcart.slidePrev();
            });
            nextButton.addEventListener('click',()=>{
                shoppingcart.slideNext();
            });
            const buttonIsEdge = ()=>{
              if( shoppingcart.isBeginning ){
                prevButton.classList.add('is-edge');
              }else{
                prevButton.classList.remove('is-edge');
              }
              if( shoppingcart.isEnd ){
                nextButton.classList.add('is-edge');
              }else{
                nextButton.classList.remove('is-edge');
              }
            }
            buttonIsEdge();
            shoppingcart.on('slideChange',()=>{
              buttonIsEdge();    
            });
        })();

    };


    // Video Magnific Popup
    if ($('.video-popup').length > 0){
        $('.video-popup').each(function() {
          new VenoBox({
              selector: '.video-popup',
          });
        });
    }
  
 

    // Jquery UI Slider Range
    $( function() {
        if ($('#slider-range').length > 0){
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: 500,
                values: [ 75, 300 ],
                slide: function( event, ui ) {
                  $( "#min-amount" ).val(ui.values[ 0 ]);
                  $( ".min-input-value" ).html(ui.values[ 0 ]);
                  $( "#max-amount" ).val(ui.values[ 1 ] );
                  $( ".max-input-value" ).html(ui.values[ 1 ] );
                }
            });
            $( "#min-amount" ).val($( "#slider-range" ).slider( "values", 0 ));
            $( ".min-input-value" ).html($( "#slider-range" ).slider( "values", 0 ));
            $( "#max-amount" ).val($( "#slider-range" ).slider( "values", 1 ) );
            $( ".max-input-value" ).html($( "#slider-range" ).slider( "values", 1 ) );
        }
    } );
    
    
    // Gift cart Show Hide - Your Cart
    $('.gift-cart-toggler').click(function(){
        $(this).toggleClass('added');
        $('.gift-cart-row').slideToggle();
    });


    // Progressbar jquery
    if ($(".animate-progress").length > 0){
        $(".animate-progress").each(function () {
            var datacount = $(this).attr("data-skill");
            $(this).rProgressbar({
                percentage: datacount,
                fillBackgroundColor: '#FACA21'
            });
         });
    }


    if ($('.fsh-magnific-popup').length > 0){
        $('.fsh-magnific-popup').each(function() {
          $(this).magnificPopup({
              delegate: 'a',
              type: 'image',
              closeBtnInside: false,
              gallery: {
                enabled:true
              },
              zoom: {
                enabled: true, 
                duration: 300, 
                easing: 'ease-in-out', 
              },
          });
        });
    }

    // Select 2 
    if ($('.fsh-select2').length > 0){
        $(".fsh-select2").select2({
            selectionCssClass: "fsh-select2-inner",
            dropdownCssClass: "fsh-select2-dropdown"
        });
    }



    // Flatpicker date time 
    if ($('.fsh-input-picker').length > 0){
        $(".fsh-input-picker").flatpickr({
            enableTime: true,
            dateFormat: "d M Y h:i K",
            onReady (_, __, fp) {
              fp.calendarContainer.classList.add("fsh-flat-picker");
            }
        });
    }
    // Flatpicker date 
    if ($('.fsh-date-picker').length > 0){
        $(".fsh-date-picker").flatpickr({
            onReady (_, __, fp) {
              fp.calendarContainer.classList.add("fsh-flat-picker");
            }
        });
    }
    // Flatpicker time 
    if ($('.fsh-time-picker').length > 0){
        $(".fsh-time-picker").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "h:i K",
            onReady (_, __, fp) {
              fp.calendarContainer.classList.add("fsh-flat-picker");
            }
        });
    }

    
    
    /* header sticky
    -------------------------------------------------------------------------*/
    var headerSticky = function () {
        let didScroll;
        let lastScrollTop = 0;
        let delta = 5;
        let navbarHeight = $(".logo-header").outerHeight();
        $(window).scroll(function (event) {
        didScroll = true;
        });
        
        setInterval(function () {
        if (didScroll) {
            let st = $(this).scrollTop();

            // Make scroll more than delta
            if (Math.abs(lastScrollTop - st) <= delta) return;
            // If scrolled down and past the navbar, add class .nav-up.
            if (st > lastScrollTop && st > navbarHeight) {
            // Scroll Down
            $(".logo-header").css("top",`-${navbarHeight}px`)
            } else {
            // Scroll Up
            if (st + $(window).height() < $(document).height()) {
                $(".logo-header").css("top","0px");
            }
            }
            lastScrollTop = st;
            didScroll = false;
        }
        }, 250);
    };

    /* header change background
    -------------------------------------------------------------------------*/
    var headerChangeBg = function () {
        $(window).on("scroll", function () {
        if ($(window).scrollTop() > 100) {
            $(".logo-header").addClass("header-bg");
        } else {
            $(".logo-header").removeClass("header-bg");
        }
        });
    }
    

    /* Go Top
    -------------------------------------------------------------------------------------*/
    var goTop = function () {
        if ($("div").hasClass("scroll-progress-wrap")) {
        var progressPath = document.querySelector(".scroll-progress-wrap path");
        var pathLength = progressPath.getTotalLength();
        progressPath.style.transition = progressPath.style.WebkitTransition =
            "none";
        progressPath.style.strokeDasharray = pathLength + " " + pathLength;
        progressPath.style.strokeDashoffset = pathLength;
        progressPath.getBoundingClientRect();
        progressPath.style.transition = progressPath.style.WebkitTransition =
            "stroke-dashoffset 10ms linear";
        var updateprogress = function () {
            var scroll = $(window).scrollTop();
            var height = $(document).height() - $(window).height();
            var progress = pathLength - (scroll * pathLength) / height;
            progressPath.style.strokeDashoffset = progress;
        };
        updateprogress();
        $(window).scroll(updateprogress);
        var offset = 200;
        var duration = 0;
        jQuery(window).on("scroll", function () {
            if (jQuery(this).scrollTop() > offset) {
            jQuery(".scroll-progress-wrap").addClass("active-scroll-progress");
            } else {
            jQuery(".scroll-progress-wrap").removeClass("active-scroll-progress");
            }
        });
        jQuery(".scroll-progress-wrap").on("click", function (event) {
            event.preventDefault();
            jQuery("html, body").animate({ scrollTop: 0 }, duration);
            return false;
        });
        }
    };


    // Dom Ready
    $(function () {
        headerSticky();
        headerChangeBg();
        goTop();
    });
    


});

const shippingCheckbox = document.getElementsByClassName('shipping-address-checkbox');
[...shippingCheckbox].forEach((checkbox) => {
    checkbox.addEventListener('change', (event) => {
        if (event.currentTarget.checked) {
            $(".shipping-address-wrap").slideDown();
        } else {
            $(".shipping-address-wrap").slideUp();
        }
    });
});

$('.radio-accordion-check-input').on('change', function () {
    if ($(this).is(':checked')) {
        // Remove 'active' class and hide all .radio-accordion-body elements
        $('.radio-accordion-btn').removeClass('active').next('.radio-accordion-body').slideUp();

        // Add 'active' class to the parent .radio-accordion-btn of the checked input
        const parentBtn = $(this).closest('.radio-accordion-btn');
        parentBtn.addClass('active').next('.radio-accordion-body').slideDown();
    }
});







// Country Select
function format(item, state) {
    if (!item.id) {
      return item.text;
    }
    var countryUrl = "https://hatscripts.github.io/circle-flags/flags/";
    var stateUrl = "https://oxguy3.github.io/flags/svg/us/";
    var url = state ? stateUrl : countryUrl;
    var img = $("<img>", {
      class: "img-flag",
      width: 26,
      src: url + item.element.value.toLowerCase() + ".svg"
    });
    var span = $("<span>", {
      text: " " + item.text
    });
    span.prepend(img);
    return span;
}
  
$(document).ready(function() {
    if ($('.countries-select').length > 0){
        $(".countries-select").select2({
            templateResult: function(item) {
              return format(item, false);
            },
            selectionCssClass: "fsh-select2-inner",
            dropdownCssClass: "fsh-select2-dropdown"
        });
    }
    if ($('.us-states').length > 0){
        $(".us-states").select2({
            templateResult: function(item) {
              return format(item, true);
            },
            selectionCssClass: "fsh-select2-inner",
            dropdownCssClass: "fsh-select2-dropdown"
          });
    }
});


 // Accordion Mobile Menu 
function accordion() {
    var Accordion = function(el, multiple) {
        this.el = el || {};
        this.multiple = multiple || false;
        var links = this.el.find('.mobile-menuitem-a-have-sub');
        links.on('click', {el: this.el, multiple: this.multiple}, this.dropdown)
    }
    Accordion.prototype.dropdown = function(e) {
        var $el = e.data.el,
            $this = $(this),
            $next = $this.next();
        $next.slideToggle();
        $this.parent().toggleClass('active-mobile-submenu');
        if (!e.data.multiple) {
            $el.find('.mobile-dropdown-menu').not($next).slideUp().parent().removeClass('active-mobile-submenu');
            $el.find('.mobile-dropdown-menu').not($next).slideUp();
        };
    }
    var accordion = new Accordion($('.mobile-menu-ul'), false);
}
accordion();
// Accordion Mobile Menu 


 /*==================================
* Countdown Timer 
==================================*/
document.addEventListener("DOMContentLoaded", () => {
    const offerTimers = document.querySelectorAll(".fsh-offer-timer");

    offerTimers.forEach((offerTimer) => {
        const offerDate = new Date(offerTimer.getAttribute("data-offer-date")).getTime();

        function updateCountdown() {
            const now = new Date().getTime();
            const timeLeft = offerDate - now;

            if (timeLeft > 0) {
                const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                offerTimer.innerHTML = `<ul>
                    <li>${days}<span>Days</span></li>
                    <li>${String(hours).padStart(2, '0')}<span>Hrs</span></li>
                    <li>${String(minutes).padStart(2, '0')}<span>Min</span></li>
                    <li>${String(seconds).padStart(2, '0')}<span>Sec</span></li>
                </ul>`;
            } else {
                offerTimer.innerHTML = "Offer Expired!";
                clearInterval(intervalId);
            }
        }

        const intervalId = setInterval(updateCountdown, 1000);
        updateCountdown();
    });
});



// Wow js Active 
new WOW({
    animateClass: 'animate__animated'
}).init();


// Bootstrap Tooltip active
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
// Bootstrap Toasts active
const toastTrigger = document.getElementById('liveToastBtn')
const toastLiveExample = document.getElementById('liveToast')

if (toastTrigger) {
  const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
  toastTrigger.addEventListener('click', () => {
    toastBootstrap.show()
  })
}



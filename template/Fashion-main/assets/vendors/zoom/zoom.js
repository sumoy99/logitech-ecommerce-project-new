

if ($(".thumbs-slider").length > 0) {
    var direction = $(".tf-product-media-thumbs").data("direction");
    var thumbs = new Swiper(".tf-product-media-thumbs", {
      spaceBetween: 12,
      slidesPerView: "auto",
      freeMode: true,
      direction: "vertical",
      watchSlidesProgress: true,
      observer: true,
      observeParents: true,
      breakpoints: {
        0: {
          direction: "horizontal",
          slidesPerView: "auto",
        //   centeredSlides: true,
        },
        1200: {
          direction: "vertical",
          direction: direction,
          slidesPerView: "auto",
        },
      },
    });
    var main = new Swiper(".tf-product-media-main", {
      spaceBetween: 0,
      observer: true,
      observeParents: true,
      effect: "fade",
      navigation: {
        nextEl: ".thumbs-next",
        prevEl: ".thumbs-prev",
      },
      thumbs: {
        swiper: thumbs,
      },
    });
}


(function ($) {
    "use strict";

    var section_zoom = function () {
        $(".tf-image-zoom").on("mouseover", function () {
            $(this).closest(".section-image-zoom").addClass("zoom-active");
        });
        $(".tf-image-zoom").on("mouseleave", function () {
            $(this).closest(".section-image-zoom").removeClass("zoom-active");
        });
    }

    var image_zoom = function () {
        var driftAll = document.querySelectorAll('.tf-image-zoom');
        var pane = document.querySelector('.tf-zoom-main');
        $(driftAll).each(function(i, el) {
            new Drift(
                el, {
                zoomFactor: 2,
                paneContainer: pane,
                inlinePane: false,
                handleTouch: false,
                hoverBoundingBox: true,
                containInline: true,
                }
            );
        });
    }



  // Dom Ready
  $(function () {
    section_zoom();
    image_zoom();
  });
})(jQuery);



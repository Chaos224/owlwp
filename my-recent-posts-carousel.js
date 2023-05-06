jQuery(document).ready(function($) {
  $(".owl-carousel").owlCarousel({
    items: 1,
    loop: true,
    margin: 10,
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayHoverPause: true,
    onInitialize: function() {
      var firstBg = $(".owl-carousel .item").eq(0).data("bg");
      $(".owl-carousel .owl-item.active .item").css("background-image", "url(" + firstBg + ")");
    },
    onTranslated: function() {
      var bg = $(".owl-carousel .owl-item.active .item").data("bg");
      $(".owl-carousel .owl-item.active .item").css("background-image", "url(" + bg + ")");
    }
  });
});
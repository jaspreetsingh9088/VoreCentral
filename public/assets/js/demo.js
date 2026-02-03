document.getElementById('store_content_type').addEventListener('change', function () {
  this.form.submit();
});
$(function() {
  // aos animation initialisation
  AOS.init({
    duration: 2000,
    once: true
  });

  // scroll header script here
  window.onscroll = function() {
    scrollHeader();
  };
  // Get the header
  var header = $(".navbar-bottom");
  var body = $("body");
  function scrollHeader() {
    // adding sticky class
    if(!$(header).hasClass("not-sticky")){
      if (window.pageYOffset > 130) {
        $(header).addClass("sticky");
      } else {
        // removing sticky class
        $(header).removeClass("sticky");
      }
    }
  }

  // navbar toggler script
  $(".navbar-toggler").on("click", function() {
    var target = $(this).data("target");
    $(target).toggleClass("show");
    $("body").toggleClass("layer-open");
    // $(header).toggleClass("sticky-not");
    $(target).find(".navbar-close").show();
  });
  $(".navbar-close").on("click", function() {
    $(this).parents(".collapse").toggleClass("show");
    $(this).hide();
    $("body").toggleClass("layer-open");
    // $(header).toggleClass("sticky-not");
    $(".dark-overlay").click(function() {
      $(".collapse").removeClass("show");
      $("body").removeClass("layer-open");
    });
  });

  // $(".navbar-bottom  .navbar-nav a").on("click", function() {
  //   $(".navbar-bottom  .navbar-nav")
  //     .find("li.active")
  //     .removeClass("active");
  //   $(this)
  //     .parent("li")
  //     .addClass("active");
  // });

  $("html").easeScroll({
    frameRate: 60,
    animationTime: 1000,
    stepSize: 40,
    pulseAlgorithm: 1,
    pulseScale: 8,
    pulseNormalize: 1,
    accelerationDelta: 100,
    accelerationMax: 1,
    keyboardSupport: true,
    arrowScroll: 50,
    touchpadSupport: true,
    fixedBackground: true
  });
});

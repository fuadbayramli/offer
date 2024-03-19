$(document).ready(function () {
  // height modal //
  function setHeiHeight() {
    let windHeight = $(window).height();
    if ($(window).width() >= '1100') {

      $('#modal-singUp .modal-dialog').css({
        height: windHeight - 200 + 'px'
      });
      $('#modal-login-yes .modal-dialog').css({
        height: windHeight - 600 + 'px'
      });
      $('#modal-singUp .group').css({
        height: windHeight - 420 + 'px'
      });
    }
  }
  
 // smsCode;
  $('.sms-num-field').on('keyup', function() {
    if ($(this).val()) {
        $(this).next().focus();
    }
});

  setHeiHeight();
  $(window).resize(setHeiHeight);
  // Sub-menu//

  $(".parent").click(function () {
    $(this).find(".sub-menu").slideToggle();
  });
  // click on button star //
  $(".buttons button").click(function () {
    $(this).toggleClass("active");
  });

  //questions//
  $(".question").click(function () {
    $(this).find("i").toggleClass("active");
    $(this).find(".answer").slideToggle();
  });

  $(".hamburger").click(function () {
    $("#mainMenu").slideToggle()
  })

  //share//
  shave('.card-text', 45);
  shave('.card-title', 50);


  
});



$('.al').click(function(){
    $('.alertt').addClass("show");
    $('.alertt').removeClass("hide");
    $('.alertt').addClass("showAlert");
    setTimeout(function(){
      $('.alertt').removeClass("show");
      $('.alertt').addClass("hide");
    },6000);
  });
  $('.close-btn').click(function(){
    $('.alertt').removeClass("show");
    $('.alertt').addClass("hide");
  });
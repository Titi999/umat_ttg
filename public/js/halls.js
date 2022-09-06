(function() {
  let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
sidebar.classList.toggle("active");
if(sidebar.classList.contains("active")){
  document.getElementById("overlay").style.marginLeft= "60px";
}else{
  document.getElementById("overlay").style.marginLeft= "240px";
    } 
  }
    var calculateHeight;
  
    calculateHeight = function() {
      var $content, contentHeight, finalHeight, windowHeight;
      $content = $('#overlay-content');
      contentHeight = parseInt($content.height()) + parseInt($content.css('margin-top')) + parseInt($content.css('margin-bottom'));
      windowHeight = $(window).height();
      finalHeight = windowHeight > contentHeight ? windowHeight : contentHeight;
      return finalHeight;
    };
  
    $(document).ready(function() {
      $(window).resize(function() {
        if ($(window).height() < 560 && $(window).width() > 600) {
          $('#overlay').addClass('short');
        } else {
          $('#overlay').removeClass('short');
        }
        return $('#overlay-background').height(calculateHeight());
      });
      $(window).trigger('resize');
      $('#popup-trigger').click(function() {
        return $('#overlay').addClass('open').find('.signup-form input:first').select();
      });
      return $('#overlay-background,#overlay-close').click(function() {
        return $('#overlay').removeClass('open');
      });
    });
  
  }).call(this);




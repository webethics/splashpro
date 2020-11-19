/* Dore Single Theme Initializer Script 

Table of Contents

01. Single Theme Initializer
*/

/* 01. Single Theme Initializer */

(function ($) {
  if ($().dropzone) {
    Dropzone.autoDiscover = false;
  }

  var direction = "ltr";
  var radius = "rounded";

  if (typeof Storage !== "undefined") {
    if (localStorage.getItem("dore-direction")) {
      direction = localStorage.getItem("dore-direction");
    } else {
      localStorage.setItem("dore-direction", direction);
    }
    if (localStorage.getItem("dore-radius")) {
      radius = localStorage.getItem("dore-radius");
    } else {
      localStorage.setItem("dore-radius", radius);
    }
  }

  $("body").addClass(direction);
  $("html").attr("dir", direction);
  $("body").addClass(radius);
  $("body").dore();
  
  
	// Add remove input fields dynamically //
    /*  $(".add-more").click(function(){
		  var _parent = $(this).parents(".form-row-parent").find(".after-add-more");
          var html = $(this).parents(".form-row-parent").find(".copy").html();
          $(_parent).after(html);
      }); 
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });  */
  
})(jQuery);

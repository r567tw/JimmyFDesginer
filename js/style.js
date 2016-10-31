$(function(){

    //用方法讓wordrpess 的圖片自適應
    $(".panel-default>img[class!='emoji']").removeClass();
    $(".panel-default>img").removeAttr("width");
    $(".panel-default>img").removeAttr("height");
    $("img[alt!='relationship']").addClass("img-responsive");
    $(".wp-caption").removeAttr("width");
    $(".wp-caption").removeAttr("style");


    $("#gotop").click(function(){
        	jQuery("html,body").animate({
            		scrollTop:0
        			},1000);
    				});
    		  $(window).scroll(function() {
        		if ( $(this).scrollTop() > 200){
            	$('#gotop').fadeIn("fast");
        	} else {
            	$('#gotop').stop().fadeOut("fast");
        	}
    });

    



});
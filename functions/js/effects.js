jQuery.noConflict();

jQuery(document).ready(

    function() {
        jQuery( ".select-menu" ).change(
            function() { 
                window.location = jQuery(this).find("option:selected").val();
            }
        );
    }
);


jQuery(document).ready(function(){
	// Cache the Window object
	$window = jQuery(window);
                
   jQuery('section[data-type="background"]').each(function(){
     var $bgobj = jQuery(this); // assigning the object
                    
      jQuery(window).scroll(function() {
                    
		// Scroll the background at var speed
		// the yPos is a negative value because we're scrolling it UP!								
		var yPos = -($window.scrollTop() / $bgobj.data('speed')); 
		
		// Put together our final background position
		var coords = '50% '+ yPos + 'px';

		// Move the background
		$bgobj.css({ backgroundPosition: coords });
		
}); // window scroll Ends

 });	

}); 

        
jQuery(document).ready(function() { jQuery("ul.last-new-shortcode li:nth-child(even)").addClass("second-style"); });

jQuery("iframe").each(function(){
      var ifr_source = jQuery(this).attr('src');
      var wmode = "wmode=transparent";
      if(ifr_source.indexOf('?') != -1) $(this).attr('src',ifr_source+'&'+wmode);
      else jQuery(this).attr('src',ifr_source+'?'+wmode);
});


jQuery(window).load(function() {    

        var theWindow        = jQuery(window),
            $bg              = jQuery("#background"),
            aspectRatio      = $bg.width() / $bg.height();

        function resizeBg() {

                if ( (theWindow.width() / theWindow.height()) < aspectRatio ) {
                    $bg
                        .removeClass()
                        .addClass('bgheight');
                } else {
                    $bg
                        .removeClass()
                        .addClass('bgwidth');
                }

        }

        theWindow.resize(function() {
                resizeBg();
        }).trigger("resize");

});
 
jQuery(document).ready(function() {
    
            jQuery('.portfolio_hover').fadeOut(); 
            
            jQuery('.bee-blog-full-image').children("a").hover(

                function() { jQuery(this).children('.portfolio_hover').fadeIn(); 
                    
                },
            
                function() { jQuery(this).children('.portfolio_hover').fadeOut(); 
                    
                }
            
            );
});

jQuery(document).ready(function() {
	jQuery('ul#filterm a').click(function() {
		jQuery(this).css('outline','none');
		jQuery('ul#filterm .current').removeClass('current');
		jQuery(this).parent().addClass('current');  
		
	});
});


jQuery(document).ready(function() {
    
            jQuery('.portfolio_hover').fadeOut(); 
            jQuery('ul#applications .sorting').children("a").hover(


                function() {  
                
                	jQuery(this).children('.portfolio_hover').fadeIn(); 
                },
            
                function() { jQuery(this).children('.portfolio_hover').fadeOut(); 
                    
                }
            
            );
});

 
jQuery(document).ready(function() {
 
    jQuery('.mt_portfolio_column, .slides li, .entry-page-image-cause').mouseenter(function(e) {
        jQuery(this).children('a').children('span').fadeIn(200);
    }).mouseleave(function(e) {
        jQuery(this).children('a').children('span').fadeOut(200);
        
    });
    
   
});




jQuery(document).ready(function() {
    
    jQuery(window).on("scroll", function() {
        var fromTop = jQuery(window).scrollTop();
        jQuery('body').toggleClass("mt-down", (fromTop > 200));
    });
});
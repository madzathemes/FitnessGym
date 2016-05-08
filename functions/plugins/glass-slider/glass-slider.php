<?php
/**
* @author Madars Bitenieks
* @copyright 2013
*/


function function_slider_glass(){

global $post;

$myposts = get_post_meta($post->ID, "mt_page_slider", true);

$myposts = get_post_meta($post->ID, "mt_page_slider", true);



$slider_height = "370";
$slider_lr_height = "259";
$slider_lr_width = "686";
$slider_lr_top = "55";



?>

<script type="text/javascript">

jQuery(document).ready(function() {
    
            jQuery('.glass-frame-hover-1, .glass-arrows').click(function() { 

                

                                        jQuery('.glass-slide-1, .glass-slide-3, .glass-slider, .glass-content-scroll').cycle('prev')

                        

                            ; return false; });

            

            jQuery('.glass-frame-hover-3, .glass-arrows-right').click(function() { 

                

                                        jQuery('.glass-slide-1, .glass-slide-3, .glass-slider, .glass-content-scroll').cycle('next')

                        

                            ; return false; });



});





jQuery(document).ready(function() {

            jQuery('.glass-frame-hover-1').hover(



                function() { jQuery('.glass-hover-1').fadeIn(); },

            

                function() { jQuery('.glass-hover-1').fadeOut(); }

            

            );

});



jQuery(document).ready(function() {

            jQuery('.glass-frame-hover-3').hover(



                function() { jQuery('.glass-hover-3').fadeIn(); },

            

                function() { jQuery('.glass-hover-3').fadeOut(); }

            

            );

});

      

jQuery(document).ready(function() {

        jQuery('.glass-content-scroll').cycle({

        		fx: 'scrollVert', 

                delay: 1, 

                startingSlide: 2,

                fastOnEvent: 1000,

                timeout: 3000,

                speed: 1500,

                pause: false,

                backwards:  false

        });

});

     

jQuery(document).ready(function() {

        jQuery('.glass-slide-1').cycle({

        		fx: 'scrollHorz', 

                delay: 1, 

                startingSlide: 1,

                fastOnEvent:   1000,

                timeout: 3000,

                speed: 1500,

                pause: false,

                backwards:  false

        });

});



jQuery(document).ready(function() {

        jQuery('.glass-slider').cycle({

        		fx: 'scrollHorz', 

                delay: 1, 

                startingSlide: 2,

                fastOnEvent: 1000,

                timeout: 3000,

                speed: 1500,

                pause: false,

                backwards:  false

        }); 

});

jQuery(document).ready(function() {

        jQuery('.glass-slide-3').cycle({

        		fx: 'scrollHorz',

                fxFn:  null, 

                delay: 1, 

                startingSlide: 3,

                fastOnEvent:   1000,

                timeout: 3000,

                speed: 1500,

                pause: false,

                backwards:  false

        });

        

});

</script>





<div class="glass-row glass-<?php echo get_post_meta($post->ID, "mt_page_slider_color", true); ?>" style="height:<?php echo $slider_height; ?>px;">

<?php 
	
$images = "";

foreach($myposts as $post){ 

	$images .= '<img src="'. aq_resize_url( $post['image'], '980', $slider_height , 'false', 'false') .'" alt="">';

}

?>
<!-- GENERAL SLIDER IMAGE -->

<div class="glass-general-frame" style="height:<?php echo $slider_height; ?>px;">

	<div class="glass-slider"  style="height:<?php echo $slider_height; ?>px;">
	        
	        <?php echo $images; ?>
	        
	</div>

    <div class="glass-hover-2" style="height:<?php echo $slider_height; ?>px;">
    	
    	
        <div class="glass-content-scroll" style="height:<?php echo $slider_height; ?>px;">
        
            <?php
		 
				foreach($myposts as $post){
				
					?> <div class="glass-title  glass-<?php echo $post["mt_page_slider_position"]; ?>" style="height:<?php echo $slider_height; ?>px;"> <?php
					
				 				
				 				
				 		?>
				 		<?php if($post["title"]!=""){ ?>
					 		<h1><span><?php echo $post["title"]; ?></span></h1>
					 		<div class="clear"></div>
					 		<?php if($post["description"]!=""){ ?><h4><span><?php echo $post["description"]; ?></span></h4><?php } ?>
					 		<div class="clear"></div>
					 		<?php if($post["url"]!=""){ ?><a href="<?php echo $post["url"]; ?>">
					 		<?php echo $post["button_name"]; ?></a><?php } ?>
				 		<?php } ?>
				 		
				 		
				 		<?php		
				 				
				 				
				 				
				 				
				 	echo '</div>';
				 	
				}
		
			?>
		
		</div>
		
    	<div class="glass-arrows-right fa fa-angle-right"></div>
    	<div class="glass-arrows fa fa-angle-left"></div>
    	<div class="glass-arrows-pause fa fa-pause"></div>
    	<div class="glass-arrows-play fa fa-play"></div>


	</div>

</div>







<!-- SMALL SLIDER IMAGES -->

<div class="glass-slider-frame" style="height:<?php echo $slider_lr_height; ?>px; margin-top:-<?php echo $slider_height; ?>px;">

    <div class="glass-slider-item" style=" margin-top:<?php echo $slider_lr_top; ?>px;">

    

        <!-- LEFT SLIDER IMAGES -->    

        <div class="glass-slider-frame-position-1">

            <div class="glass-slider-frame-in" style="height:<?php echo $slider_lr_height; ?>px;">

                <div class="glass-left-frame" style="height:<?php echo $slider_lr_height; ?>px; width:<?php echo $slider_lr_width; ?>px;">

                    <div class="glass-frame-hover-1">

                        <div class="glass-slide-1" style="height:<?php echo $slider_lr_height; ?>px; width:<?php echo $slider_lr_width; ?>px;">
	                        
	                        <?php echo $images; ?>
	                        
                        </div>

                        <div class="glass-hover-1">

                        </div>

                    </div>        

                </div>

            </div>

        </div><!-- END LEFT SLIDER IMAGES -->

        

        <!-- RIGHT SLIDER IMAGES -->                

        <div class="glass-slider-frame-position-3">

            <div class="glass-slider-frame-in">

                <div class="glass-right-frame"  style="height:<?php echo $slider_lr_height; ?>px; width:<?php echo $slider_lr_width; ?>px;">

                    <div class="glass-frame-hover-3">

                        <div class="glass-slide-3" style="height:<?php echo $slider_lr_height; ?>px; width:<?php echo $slider_lr_width; ?>px;">
	                        
	                        <?php echo $images; ?>
	                        
                        </div>

                        <div class="glass-hover-3">

                        </div>

                    </div>   

                </div>

            </div>

        </div><!-- END RIGHT SLIDER IMAGES -->

        <div class="clear"></div>

    </div>

</div><!-- END SMALL SLIDER IMAGES -->



</div>

<?php

wp_reset_query();

}

add_action('function_slider_glass', 'function_slider_glass');

?>
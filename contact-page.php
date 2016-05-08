 <?php

get_header(); 

?>

<div id="full-page">

<?php 

if(of_get_option('contact_content') == "contact_content_yes") {

	if ( have_posts() ) while ( have_posts() ) : the_post();
		
		 the_content( __( '<div class="reed_more">Reed More &raquo;</div><div></div>', 'madza_translate' ) ); 
		 
	 endwhile; wp_reset_query();
	 
	 ?><div class="contact-space-line"></div><?php

} ?>


<?php

if(of_get_option('contact_form_title') AND of_get_option('contact_form_description')) {

	?><div class="contact-page-info"><?php
	
		if(of_get_option('contact_form_title')) {
	    
	        echo "<h3>"; echo of_get_option("contact_form_title"); echo "</h3>";
	    
	    }
	    
	    if(of_get_option('contact_form_description')) {
	    
	        echo "<div>"; echo of_get_option("contact_form_description"); echo "</div>";
	    
	    } 
    
    ?></div><?php
}

if(of_get_option('contact_form') == "1" && of_get_option('contact_form_7') != "" )  {
	?><div class="contact-page-form"><?php

    $form7=of_get_option('contact_form_7');

	echo do_shortcode("$form7");
	?> </div> <?php
}

?>
<div class="clear"></div>
</div><!--END BLOG CONTENT -->

<?php get_footer(); ?>

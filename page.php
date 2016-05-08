<?php
/**
 * @author madars.bitenieks
 * @copyright 2013
 */

get_header(); 

global $post, $col_4, $col_8;

$mt_layout = get_post_meta($post->ID, "layout_positions", true);

$mt_float_layout = "";
$mt_float_sidebar = "";

if ($mt_layout == "left") {

	$mt_float_layout = "floatright";
	$mt_float_sidebar = "floatleft";
}

if(function_exists( 'tribe_is_event' ) ) {  
	if (tribe_is_event() && !tribe_is_day() && !is_single()) {  
		$mt_layout = "full"; 
	}
}
$more = 0;

$mt_content = get_post_meta($post->ID, "mt_content_on", true);

if ($mt_content == "" or $mt_content == "yes") { ?>
	
<div class="row">

	<div class="col-md-<?php if ($mt_layout != "full") { echo "8 "; echo $col_8;} else {  echo "12 "; } echo $mt_float_layout; ?> ">

		    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				
					<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				    
				    		<?php the_content( __( '<div class="reed_more">Reed More &raquo;</div><div></div>', 'madza_translate' ) ); ?>
						   
				           <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'madza_translate' ), 'after' => '</div>' ) ); ?>
							
				           <div class="clear"></div>
					
				    </div><!--END POST -->
			    
				    <?php # comments_template( '', true );  ?>
			    
			    <?php endwhile; wp_reset_query();  ?>
		
	</div>
	
	<?php if ($mt_layout != "full") { ?>
		
		<div class="col-md-4 <?php echo $mt_float_sidebar; echo $col_4; ?> "><?php get_sidebar(); ?></div>
	
	<?php } ?>
			
</div>

<?php } ?>

<?php get_footer(); ?>
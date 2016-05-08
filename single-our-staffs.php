<?php
/**
 * @author madars.bitenieks
 * @copyright 2013
 */

get_header(); 

global $post, $col_4, $col_8;

$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 999,999 ), false, '' );
$mt_portfolio_slider_height = get_post_meta($post->ID, "mt_portfolio_slider_height", true); 
$mt_fields = get_post_meta($post->ID,'mb_portfolio_fields', true);
$slides = get_post_meta($post->ID,'mb_portfolio_slider', true);
$mt_layout = get_post_meta($post->ID, "layout_positions", true);
$mt_doctor_image = get_post_meta($post->ID, "mt_doctor_image_size", true);

$mt_float_layout = "";
$mt_float_sidebar = "";
	
if ($mt_layout == "left") {

	$mt_float_layout = "floatright";
	$mt_float_sidebar = "floatleft";
}

$mt_image_width = "960";

if($mt_layout != "full" ) { $mt_image_width = "620"; }
if($mt_doctor_image == "small" ) { $mt_image_width = "300"; }


?>
<div class="row">

	<div class="col-md-<?php if ($mt_layout != "full") { echo "8 "; echo $col_8; } else {  echo "12 "; } echo $mt_float_layout; ?> ">
		
		<header class="mt_doctor_image_<?php echo $mt_doctor_image; ?>">
			<div class="entry-page-image">
			
				
							
						<?php  if(has_post_thumbnail()) { ?>
						
							<img src="<?php echo aq_resize_url( $src[0], $mt_image_width, $mt_portfolio_slider_height, 'false', 'true'); ?>" />
						
						<?php } ?>
							
						<?php if($comment=='Yes'){ comments_template( '', true );  }?>
				
				
				
			</div>
		</header>
		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="entry-content"><?php  the_content(); ?></div>
		<?php endwhile;  wp_reset_query(); ?>

	</div>
	
	<?php if ($mt_layout != "full") { ?>
		
		<div class="col-md-4 <?php echo $mt_float_sidebar; echo $col_4; ?> ">
			
			<?php get_sidebar(); ?>
		
		</div>
	
	<?php } ?>
			
</div>     
<?php get_footer(); ?>
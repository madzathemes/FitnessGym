<?php
/**
 * @author madars.bitenieks
 * @copyright 2014
 */

global $post;

$class = "";

get_header(); 

$class = ""; if(get_post_meta($post->ID, "mt_class", true)!="") { $class = get_post_meta($post->ID, "mt_class", true); } 
				 
?><section data-type="background"  data-speed="<?php if(get_post_meta($post->ID, "mt_paralex_speed", true)!="" and get_post_meta($post->ID, "mt_paralex_speed_on", true)!="no"){ echo get_post_meta($post->ID, "mt_paralex_speed", true); }?>" class="mt-boxed-version mt-style-<?php echo $post->ID; ?> <?php echo $class; ?>" ><div class="mt-section-bg mt-section-bg-<?php echo $post->ID; ?>"></div><div class="container"><div class="row"><div class="col-md-12"><?php the_content(); ?></div></div></div></section>

<?php get_footer(); ?>
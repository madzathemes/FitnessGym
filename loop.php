<?php
/**
 * @author madars.bitenieks
 * @copyright 2011
 */
?>

<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h1 class="entry-title"><?php _e( 'Not Found', "madza_translate" ); ?></h1>
		<div class="entry_content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.' , "madza_translate" ); ?></p>
			
		</div><!-- entry_content END -->
	</div><!-- posts END -->
<?php endif; ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?> 

<?php function_blog(); ?>

<?php endwhile; else: ?>

<p><?php _e( 'Sorry, no posts matched your criteria.', "madza_translate" );?></p>

<?php endif; ?>

<div class="clear"></div>

<div id="post-link-button"><?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { previous_posts_link('', 0); posts_nav_link(); } ?></div>

<?php wp_reset_query(); ?>
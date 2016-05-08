
<?php get_header(); 

global $col_4, $col_8;

?>

<div class="row">
	<div class="col-md-8 <?php echo $col_8; ?> floatleft">
	<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
	
					/* Include the post format-specific template for the content. If you want to
					 * this in a child theme then include a file called called content-___.php
					 * (where ___ is the post format) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
	
				endwhile;
	
				twentytwelve_content_nav( 'nav-below' );
				?>
	
	<div class="clear"></div>
	
	<div id="post-link-button"><?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } else { previous_posts_link('', 0); posts_nav_link(); } ?></div>
	
	
	<?php wp_reset_query(); ?>  
	</div>

	<div class="col-md-4 <?php echo $col_4; ?> floatright">
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>

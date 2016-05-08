<?php

get_header(); 

?>
<article id="post-0" class="post error404 no-results not-found">
	<header class="entry-header" style="text-align:center;">
		<h2 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'madza_translate' ); ?></h2>
	</header>

	<div class="entry-content" style="text-align:center!important; float:none!important;">
		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'madza_translate' ); ?></p>
		<?php get_search_form(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-0 -->

<div class="clear"></div>

<?php get_footer(); ?>
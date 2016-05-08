<?php
/*
Template Name: Portfolio
*/ 

global $more, $post, $col_4, $col_8; $more = 0;

$mt_layout = get_post_meta($post->ID, "layout_positions", true);
$categorys = get_post_meta($post->ID, "mt_portfolio_category", true);
$count = get_post_meta($post->ID, "mt_template_item_pp", true); 
$columns = get_post_meta($post->ID, "mt_template_columns", true);
$category = get_post_meta($post->ID, "mt_portfolio_category", true); 
$link = get_post_meta($post->ID, "mt_template_links", true);
$menu = get_post_meta($post->ID, "mt_template_menu", true);

$mt_float_layout = "";
$mt_float_sidebar = "";

if ($mt_layout == "left") {

	$mt_float_layout = "floatright";
	$mt_float_sidebar = "floatleft";
}

if ($mt_layout == "left") {

	$mt_float_layout = "floatright";
	$mt_float_sidebar = "floatleft";
}

?>

<?php get_header(); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
	<div class="row">	
			
		<div class="col-md-12">
	    
	    		<?php the_content( __( '<div class="reed_more">Reed More &raquo;</div><div></div>', 'madza_translate' ) ); ?>
			   
	           <?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'madza_translate' ), 'after' => '</div>' ) ); ?>
				
	           <div class="clear"></div>
		
	    </div><!--END POST -->
		    
	</div>
			    
<?php endwhile; wp_reset_query();  ?>

<div class="row">

	<div class="col-md-<?php if ($mt_layout != "full") { echo "8 "; echo $col_8; } else {  echo "12 "; } echo $mt_float_layout; ?> ">
	
		<?php if($categorys=="" and $menu=="sorting"){ ?>
			
			<?php $term_obj = get_terms('portfolio_cat'); ?>
			
			<ul id="filterm">
			
				<li class="current"><a href="#" data-filter="*" id="showall" class="selected close-subnav filter-item">All</a></li>
				
				<?php foreach ($term_obj as $term) { ?>
				
					<li><a href="#"  <?php if ($term->slug == 'photos') {?> class="show-subnav filter-item" <?php } else {?>class="close-subnav filter-item" <?php }?>id="<?php echo $term->slug; ?>" data-filter=".<?php echo $term->slug; ?>"><?php echo $term->name; ?></a></li>
				
				<?php } ?>
				
			</ul>
			
			<div class="clear"></div>
			
		<?php } ?>
	
	
     <div class="post-box2 row"> <?php
		    
		    		
		    		
		    		
		    		if( ! empty($category)) { 
		    			$loop = new WP_Query(array(
			        	'post_type'=> 'portfolio',
			        	'tax_query' => array( array( 'taxonomy' => 'portfolio_cat', 'field' => 'id', 'terms' => $category )),
			            'posts_per_page' => $count
			            )); 
			       } else {
			            $loop = new WP_Query(array(
			        	'post_type'=> 'portfolio',
			            'posts_per_page' => $count, 
			            'field' => 'slug',
			            'paged' => get_query_var( 'paged' )
			            ));
		            }
		            
		            
						$portfolio_layout_style = "default";
						
		            
                    $i = 0; 
	     			while ( $loop->have_posts() ) : $loop->the_post();
	                        global $post, $more;
	                        $more = 0;
	                        $term_obj =  wp_get_object_terms($post->ID, 'portfolio_cat');
	                        $portfolio_title = $post->post_title;
	                        $portfolio_taxonomy = get_the_term_list($post->ID, 'portfolio_cat', '', ' ', '' );
	                        $portfolio_taxonomy_format = preg_replace('/\<a(.*)\>(.*)\<\/a\>/iU', '<li>$2</li>', $portfolio_taxonomy);
	                        $terms_as_text = strip_tags( get_the_term_list( $post->ID, 'portfolio_cat', '', ' ', '' ) );
	                        $portfolio_title = $post->post_title;
	                        $get_text=get_post_meta($post->ID, "madza_portfolio_hover_text", true);
	                        $slides = get_post_meta($post->ID,'slides', true);
	                        $thumb = get_post_meta(get_the_ID(), 'tz_portfolio_thumb', TRUE); 
							$large_image_lightbox = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large');
							$lightbox = get_post_meta(get_the_ID(), 'tz_portfolio_lightbox', TRUE); 
							$portfolio_caption = get_the_excerpt();    
							$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 999, 999 ));							

						
							
							if($link=="permalink"){ ?>
								
									<?php if($columns=="4") { $columnidisotop = "4"; ?>
										<div class="port port-file-3 col-md-3 sorting <?php $post_cats = wp_get_post_terms( $post->ID,'portfolio_cat' ); foreach( $post_cats as $category ) { echo $category->slug.' ';} ?>" data-category="portfolio">
											<div class="mt_portfolio_column">
											    <a href="<?php the_permalink(); ?>">
											        <span class="dark-background-2"></span>
											        <?php 	$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 999,999 ), false, '' ); 
											        		echo aq_resize( $src[0], '360', '200', 'false', 'true'); ?>
											    </a>
											    <div class="mt_isotope_text">
											    	<a href="<?php the_permalink(); ?>"><h4 class="widget_h_2"><?php the_title(); ?></h4></a>
											    	<p><?php echo substr($portfolio_caption, 0, 50);?>...</p>  <?php echo "<a href='".get_permalink()."' class='more-link'><span>Read more</span></a>"; ?> 
											    	<div class="clear"></div>
											    </div>
											</div>
										</div> 
									<?php } else if($columns=="3") {  $columnidisotop = "3"; ?>
										<div class="port port-file-3 col-md-4 sorting <?php $post_cats = wp_get_post_terms( $post->ID,'portfolio_cat' ); foreach( $post_cats as $category ) { echo $category->slug.' ';} ?>" data-category="portfolio">
											<div class="mt_portfolio_column">
											    <a href="<?php the_permalink(); ?>">
											        <span class="dark-background-2"></span>
											        <?php 	$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 999,999 ), false, '' ); 
											        		echo aq_resize( $src[0], '480', '240', 'false', 'true'); ?>
											    </a>
											    <div class="mt_isotope_text">
											    	<a href="<?php the_permalink(); ?>"><h4 class="widget_h_2"><?php the_title(); ?></h4></a>
											    	 <?php echo substr($portfolio_caption, 0, 150);  echo "<a href='".get_permalink()."' class='more-link'><span>Read more</span></a>"; ?> 
											    	<div class="clear"></div>
											    </div>
											</div>
										</div> 	
									<?php } else if($columns=="2") {  $columnidisotop = "2"; ?>
										<div class="port port-file-3 col-md-6 sorting <?php $post_cats = wp_get_post_terms( $post->ID,'portfolio_cat' ); foreach( $post_cats as $category ) { echo $category->slug.' ';} ?>" data-category="portfolio">
											<div class="viewport2column">
											    <a href="<?php the_permalink(); ?>">
											        <span class="dark-background-2"></span>
											        <?php 
											        	$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 999,999 ), false, '' ); 
											        	echo aq_resize( $src[0], '700', '350', 'false', 'true'); ?>
											    </a>
											    <div class="mt_isotope_text">
											    	<a href="<?php the_permalink(); ?>"><h4 class="widget_h_2"><?php the_title(); ?></h4></a>
											    	<?php the_excerpt(); echo "<a href='".get_permalink()."' class='more-link'><span>Read more</span></a>"; ?> 
											    	<div class="clear"></div>
											    </div>
											</div>
										</div> 	
									<?php } else {  $columnidisotop = "1"; ?>
										<div class="port port-file-3 col-md-12 sorting <?php $post_cats = wp_get_post_terms( $post->ID,'portfolio_cat' ); foreach( $post_cats as $category ) { echo $category->slug.' ';} ?>" data-category="portfolio">
											<div class="viewport1column">
											    <a href="<?php the_permalink(); ?>">
											        <span class="dark-background-2"></span>
											        <?php 
											        	$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 999,999 ), false, '' ); 
											        	echo aq_resize( $src[0], '960', '350', 'false', 'true'); ?>
											    </a>
											    <div class="mt_isotope_text">
											    	<a href="<?php the_permalink(); ?>"><h4 class="widget_h_2"><?php the_title(); ?></h4></a>
											    	<?php the_excerpt(); echo "<a href='".get_permalink()."' class='more-link'><span>Read more</span></a>"; ?> 
											    	<div class="clear"></div>
											    </div>
											</div>
										</div> 	
									<?php } ?>	
				    			 
			    			<?php } else {?>
								
									<?php  if($columns=="4") { $columnidisotop = "4"; ?>
										<div class="port port-file-3 portfolio-portfolio_4_column sorting <?php $post_cats = wp_get_post_terms( $post->ID,'portfolio_cat' ); foreach( $post_cats as $category ) { echo $category->slug.' ';} ?>" data-category="portfolio">
											<div class="viewport4column">
											    <a data-rel="prettyPhoto[pp_gal]" href="<?php echo $large_image_lightbox[0]; ?>">
											        <span class="dark-background-2"></span>
											        <?php 
											        	$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 999,999 ), false, '' ); 
											        	echo aq_resize( $src[0], '360', '200', 'false', 'true'); ?>
											    </a>
											    <div class="mt_isotope_text">
											    	<div class="widget_span_h">
											    		<a data-rel="prettyPhoto[pp_gal]" href="<?php echo $large_image_lightbox[0]; ?>"><?php the_title(); ?></a>
											    	</div>
											    	<p><?php echo substr($portfolio_caption, 0, 150); ?>...</p>
											    </div>
											</div>
										</div> 
									<?php } else if($columns=="3") {  $columnidisotop = "3"; ?>
										<div class="port port-file-3 portfolio-portfolio_3_column sorting <?php $post_cats = wp_get_post_terms( $post->ID,'portfolio_cat' ); foreach( $post_cats as $category ) { echo $category->slug.' ';} ?>" data-category="portfolio">
											<div class="viewport3column">
											    <a data-rel="prettyPhoto[pp_gal]" href="<?php echo $large_image_lightbox[0]; ?>">
											        <span class="dark-background-2"></span>
											        <?php 
											        	$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 999,999 ), false, '' ); 
											        	echo aq_resize( $src[0], '480', '240', 'false', 'true'); ?>
											    </a>
											    <div class="mt_isotope_text">
											    	<div class="widget_span_h">
											    		<a data-rel="prettyPhoto[pp_gal]" href="<?php echo $large_image_lightbox[0]; ?>"><?php the_title(); ?></a>
											    	</div>
											    	<p><?php echo substr($portfolio_caption, 0, 200); ?>...</p>
											    </div>
											</div>
										</div> 	
									<?php } else if($columns=="2") {  $columnidisotop = "2"; ?>
										<div class="port port-file-3 portfolio-portfolio_2_column sorting <?php $post_cats = wp_get_post_terms( $post->ID,'portfolio_cat' ); foreach( $post_cats as $category ) { echo $category->slug.' ';} ?>" data-category="portfolio">
											<div class="viewport2column">
											    <a data-rel="prettyPhoto[pp_gal]" href="<?php echo $large_image_lightbox[0]; ?>">
											        <span class="dark-background-2"></span>
											        <?php 
											        	$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 999,999 ), false, '' ); 
											        	echo aq_resize( $src[0], '700', '350', 'false', 'true'); ?>
											    </a>
											    <div class="mt_isotope_text">
											    	<div class="widget_span">
											    		<a data-rel="prettyPhoto[pp_gal]" href="<?php echo $large_image_lightbox[0]; ?>"><?php the_title(); ?></a>
											    	</div>
											    	<p><?php echo substr($portfolio_caption, 0, 250); ?>...</p>
											    </div>
											</div>
										</div> 	
									<?php } else {  $columnidisotop = "1"; ?>
										<div class="port port-file-3 portfolio-portfolio_1_column sorting <?php $post_cats = wp_get_post_terms( $post->ID,'portfolio_cat' ); foreach( $post_cats as $category ) { echo $category->slug.' ';} ?>" data-category="portfolio">
											<div class="viewport1column">
											    <a data-rel="prettyPhoto[pp_gal]" href="<?php echo $large_image_lightbox[0]; ?>">
											        <span class="dark-background-2"></span>
											        <?php 
											        	$src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array( 999,999 ), false, '' ); 
											        	echo aq_resize( $src[0], '960', '350', 'false', 'true'); ?>
											    </a>
											    <div class="mt_isotope_text">
											    	<div class="widget_span">
											    		<a data-rel="prettyPhoto[pp_gal]" href="<?php echo $large_image_lightbox[0]; ?>"><?php the_title(); ?></a>
											    	</div>
											    	<p><?php echo substr($portfolio_caption, 0, 250); ?>...</p>
											    </div>
											</div>
										</div>
									 	
									<?php } ?>	
				    			 
			    			<?php } 
			    			
			    		  ?>
			    	 
	      <?php $i++;  endwhile; wp_reset_query(); ?>
	      
    </div>
    
<script>

  

jQuery(function(){
    var container = jQuery('.post-box2');

    container.isotope({
      itemSelector: '.port-file-3',
      isFitWidth: true
    });


	
		
 // filter items when filter link is clicked
		jQuery('#filterm a').click(function(){
			  var selector = jQuery(this).attr('data-filter');
			  container.isotope({ filter: selector });
			  return false;  
		});
  });
  
 
  
	
</script>
    <?php
    	global $post;

		    		if($menu=="pagination"){ ?>
					    <div class="clear"></div>
					    <div class="portfolio-pagenav">
					    	<?php if(function_exists('wp_pagenavi')) { 
					    				wp_pagenavi( array( 'query' => $loop ) );
					    		  } else { 
					    		  		previous_posts_link('', 0); posts_nav_link(); 
					    		  } wp_reset_query(); ?>
					    </div>
    <?php }  ?>
    
			
		</div>
	
	</div>
	
	<?php if ($mt_layout != "full") { ?>
		
		<div class="col-md-4 <?php echo $mt_float_sidebar; echo $col_4;?> "><?php get_sidebar(); ?></div>
	
	<?php } ?>
			
</div>

<?php get_footer(); ?>


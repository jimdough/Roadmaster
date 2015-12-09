<?php

/* 	Single Page to display Single Page or Post
	Copyright: 2014, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since NewsPress 1.0
*/


get_header(); ?>

<div id="content">

 		  <?php if ( have_posts() ): $duh= array(); while ( have_posts() ) : the_post(); $duh[] = $post->ID; newspress_setPostViews(get_the_ID());  
          	if ( of_get_option('adv09', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv09', '')); ?></div><?php endif; ?>
          	<p class="subtitle"><?php echo get_post_meta($post->ID, 'np_subtitle', 'true'); ?></p>
            <h1 class="page-title <?php if (get_post_meta( $post->ID, 'np_vih', true ) == 'on' ): echo 'vi-heading'; endif; ?>"><?php the_title(); ?></h1>
            <?php newspress_author_meta(); ?>
            <div class="content-ver-sep"> </div>
             
            <?php if ( of_get_option('adv10', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv10', '')); ?></div><?php endif; ?>
            <div class="entrytext"><?php if ( of_get_option('tspost', '0') != '1'): if ( get_post_meta( $post->ID, 'np_dsfisp', true ) != 'on' ): if (get_post_meta( $post->ID, 'np_fi100', true ) == 'on' ): the_post_thumbnail('single-page' , array('class' => 'fi-full-width')); else: the_post_thumbnail('single-page' , array('class' => 'attachment-single-page')); endif; endif; endif; ?>
       		<!--
            <a class="pageprint" href="#" onclick="window.print(); return false;" target="_blank" title="সংবাদটি প্রিন্ট করুন"></a>
            <style>.pageprint::before { content: '\f469'; font-size: 30px; color: #555555; float:right;}</style>
            -->
			<?php newspress_content(); ?>
            </div>
            <div class="clear"> </div>
            <?php newspress_post_meta(); ?><br />
            <?php  wp_link_pages( array( 'before' => '<div class="page-link"><span>' .  of_get_option('pagesn', 'Pages:') . '</span>', 'after' => '</div>' ) ); ?><br />
            <div class="floatleft"><b><?php previous_post_link('&laquo; %link ('. of_get_option('pe3', 'Previous News') . ')'); ?></b></div>
			<div class="floatright"><b><?php next_post_link('('. of_get_option('ne3', 'Next News') . ') %link &raquo;'); ?></b></div><br />
            <div class="clear"> </div>
            <?php if ( is_attachment() ): ?>
            <div class="floatleft"><?php previous_image_link( false, '&laquo; ' . of_get_option('pi3', 'Previous Image') ); ?></div>
			<div class="floatright"><?php next_image_link( false,  of_get_option('ni3', 'Next Image') . ' &raquo;' ); ?></div> 
			<?php  endif; endwhile; endif; ?><br />
          	            
          <!-- End the Loop. -->          
          <div class="clear"></div><br />
          <?php if ( of_get_option('adv11', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv11', '')); ?></div><?php endif; ?>

 <!-- Related News -->
 
<?php  if ( of_get_option('num-cat-related-news', '10') != '' ): 
$category = get_the_category(); 
$args = array(
	'cat'        	  => $category[0]->cat_ID,
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'post_type'       => 'post',
    'post_status'     => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page'  => of_get_option('num-cat-related-news', '10'),
	'suppress_filters' => true );
	
$my_query = new WP_Query($args); if (have_posts()) : $counter =0;  ?>
 <div class="fpage-catspecial">
 <h2 class="fcname"><?php echo of_get_option('related-news', 'Related News'); ?></h2>
 
 <?php while ( $my_query->have_posts()) :  $my_query->the_post(); if ( !empty($duh) && in_array($post->ID, $duh)) continue; $counter++; ?>
 <?php if ($counter == 1 || $counter == 2 ) : ?>
	<div class="special-cat-sub">
	<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_post_thumbnail('cat-page', array('class' => 	'fi-full-width-cat')); ?>
	<h3 class="fcpt"><?php the_title(); ?></h3>
	<?php if ( of_get_option('num-rnrm', '15') != '' ): $newspress_excerptlength= of_get_option('num-rnrm', '15'); else: $newspress_excerptlength= '15'; endif;  the_excerpt(); ?></a></div><?php else: ?>

	<h4 class="fcpt"><li><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li></h4></a>

 <?php endif; endwhile; wp_reset_postdata(); ?>
 </div> <!--end of fpage-catspecial-->
 <?php endif; endif; ?>
 
 
 <div class="content-ver-sep"> </div>
 <?php if (of_get_option ('cpost', '' ) != '1' ): if (comments_open( $post->ID ) == true ): comments_template('', true); endif; endif;?>

            
</div>			
<?php get_sidebar(); ?>
<?php get_footer(); ?>


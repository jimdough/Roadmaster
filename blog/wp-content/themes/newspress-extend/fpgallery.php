<?php

/* 	Front Page Gallery
	Copyright: 2014, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since NewsPress 1.0
*/

?>
<div class="content-ver-sep"> </div>
<div class="fccontainer">
<div class="fpgallery">

<?php
 $args = array(
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'post_status'     => 'publish',
	'ignore_sticky_posts'=> 1,
	'posts_per_page'  => -1,
	'suppress_filters' => true );
 
 $my_query = new WP_Query($args); $galpid = array(); $counterp = 0; ?>
 
<div class="fpgcontainert">
<h3 class="fpgal-title"><?php echo of_get_option('moregalleries', 'More Galleries'); ?></h3>
<?php   /* The loop */
    while ( $my_query->have_posts()) : $my_query->the_post(); if ( get_post_gallery() ) :  $galpid[] = $post->ID; if ( $counterp == 9 ) : break; else: $counterp++; ?>
	<a href="<?php the_permalink() ?>" target="_blank" ><?php the_title(); ?></a>
	<div class="content-ver-sep"> </div>
<?php endif; endif;  endwhile; wp_reset_postdata(); ?>
<a target="_blank" href="<?php echo of_get_option('allgalpl', '#'); ?>" class="read-more"><?php echo of_get_option('allgalleries', 'All Galleries'); ?></a>
</div>

<div class="fpgcontainer">
<?php if ( of_get_option('fpgalid', '') != '' ): $fpgalpid =  of_get_option('fpgalid', ''); else: $fpgalpid =  $galpid[0]; endif;
			
			$gallery = get_post_gallery(  $fpgalpid, false );  
			$gallery_image_ids = explode(",",$gallery['ids']);
			$counter = 0; ?>
            
            <h3 class="fpgal-title"><?php echo get_the_title($fpgalpid); ?></h3>
			<ul id="fpgal">
            <?php /* Loop through all the image and output them one by one */
			foreach( $gallery['src'] as $src ) { 
			$attachment_id =  $gallery_image_ids[$counter];
			$excerpt = get_post_field( 'post_excerpt', $attachment_id );
			
            $counter++;
			 ?>
			 
            <li><img src="<?php echo $src; ?>" class="fpgal-image" title="<?php echo $excerpt; ?>" /></li>
                
            <?php } ?>
			</ul>
            
    <script type="text/javascript">
	jQuery(document).ready(function($) {
  	jQuery('#fpgal').bxSlider({
  	minSlides: 1,
  	maxSlides: 1,
  	moveSlides: 1,
  	slideWidth: 620,
	mode: 'fade',
  	adaptiveHeight: true,
	captions: true,
  	auto: true,
  	controls: true,
	pager: false,
  	slideMargin: 0
	});
	});
	</script>      
</div> 
</div>

<div class="fpmost-read">

<h3 class="fpgal-title"><?php echo of_get_option('popularnews', 'Popular News'); ?></h3>
<?php 
	
	if ( of_get_option('popnsc', '1') == '2' ):
	$args = array(
    'orderby'         => 'comment_count post_date',
    'order'           => 'DESC',
    'post_status'     => 'publish',
	'ignore_sticky_posts'=> 1,
	'posts_per_page'  => of_get_option('num-post-pn', '20'),
	'suppress_filters' => true );
	else:
	$args = array(
    'meta_key'        => 'post_views_count',
	'orderby'         => 'meta_value_num', 
	'order'           => 'DESC',
	'post_status'     => 'publish',
	'ignore_sticky_posts'=> 1,
	'posts_per_page'  => of_get_option('num-post-pn', '20'),
	'suppress_filters' => true );	
	endif;

 $my_query = new WP_Query($args);
 if (have_posts()) : ?>
 <ul id="mostdiscussed">
 
 <?php while ( $my_query->have_posts()) :  $my_query->the_post(); ?>

 <li><a href="<?php the_permalink() ?>" target="_blank"><?php the_post_thumbnail('post-page', array('class' => 'mostdis')); ?><h3><?php the_title(); ?></h3></a></li>
 <div class="content-ver-sep"> </div>
 <?php endwhile; ?>

 </ul>
 
 <script type="text/javascript">
jQuery(document).ready(function(jQuery) {
  jQuery('#mostdiscussed').bxSlider({
  minSlides: 12,
  maxSlides: 16,
  slideWidth: 270,
  adaptiveHeight: true,
  auto: true,
  controls: false,
  mode: 'vertical',
  slideMargin: 15
});
});
</script>
 
 <?php endif; wp_reset_postdata(); ?>
</div>


<div class="fpec">
<h3 class="fpgal-title"><?php echo of_get_option('editorschoice', 'Editors Choice'); ?></h3>

<?php 
	$args = array(
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'meta_key'        =>'np_ec',
	'meta_value'      =>'on' ,
    'post_status'     => 'publish',
	'ignore_sticky_posts'=> 1,
	'posts_per_page'  => of_get_option('num-post-ec', '10'),
	'suppress_filters' => true );
 
 $my_query = new WP_Query($args);
 if (have_posts()) : ?>
 <ul id="editorschoice">
 
 <?php while ( $my_query->have_posts()) :  $my_query->the_post(); ?>

 <li><a href="<?php the_permalink() ?>" target="_blank"><?php the_post_thumbnail('post-page', array('class' => 'edchoice')); ?><h3><?php the_title(); ?></h3></a></li>

 <?php endwhile; ?>

 </ul>
 
 <script type="text/javascript">
jQuery(document).ready(function(jQuery) {
  jQuery('#editorschoice').bxSlider({
  minSlides: 1,
  maxSlides: 5,
  moveSlides: 2,
  slideWidth: 198,
  adaptiveHeight: true,
  auto: true,
  controls: false,
  slideMargin: 15
});
});
</script>
 
 <?php endif; wp_reset_postdata(); ?>
</div>
</div>

<div class="clear"></div><br />
 <?php if ( of_get_option('adv08', '') != '' ): ?><div class="advertisement"><?php echo of_get_option('adv08', ''); ?></div><?php endif; ?>
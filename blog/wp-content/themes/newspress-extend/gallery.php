<?php
/* 	Template Name: All Galleries
	General Page to display all Galleries
	Copyright: 2014, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since NewsPress 1.0
*/

 get_header(); ?>

	<div id="content" class="arc-content">
    <?php if ( of_get_option('adv17', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv17', '')); ?></div><br /><?php endif; ?>

<?php
	$args = array(
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'post_status'     => 'publish',
	'ignore_sticky_posts'=> 1,
	'posts_per_page'  => -1,
	'suppress_filters' => true );
	$my_query = new WP_Query($args); global $galpid; $galpid = array(); if ( $my_query->have_posts()) :
	while ( $my_query->have_posts()) : $my_query->the_post(); if ( get_post_gallery() ) : $galpid[] = $post->ID; endif; endwhile; endif; wp_reset_postdata(); 

global $more; $more = 0;
$args = array(
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'post_status'     => 'publish',
	'ignore_sticky_posts'=> 1,
	'post__in'        => $galpid,
	'posts_per_page'  => of_get_option('num-gal-items', '27'),
	'paged'           => ( get_query_var('paged') ? get_query_var('paged') : 1 ), 
	'suppress_filters' => true );
$wp_query = new WP_Query($args); if ( $wp_query->have_posts()) :  ?>
<h1 class="arc-post-title"><?php echo the_title(); ?></h1>
<div class="fccontainer">
<?php
	while ($wp_query->have_posts()) : $wp_query->the_post();  
    $gallery = get_post_gallery(  get_the_ID(), false ); $src = $gallery['src']; ?>
    
	<div class="fpage-catg">
    <a href="<?php the_permalink() ?>" target="_blank" >
    <img src="<?php echo $src['0']; ?>"  class="fi-full-width-cat" />
    <span><?php the_title(); ?></span>
    </a>
	</div>
 
 <?php endwhile;  newspress_page_nav(); ?>
 </div>
 <?php endif; wp_reset_postdata();?>

<?php if ( of_get_option('adv18', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv18', '')); ?></div><?php endif; ?>
</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
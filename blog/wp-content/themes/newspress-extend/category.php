<?php 
/* 	News Press's Category Page
	Copyright: 2014, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since NewsPress 1.0
*/

get_header(); ?>

<div id="content" class="arc-content">
<?php if ( of_get_option('adv12', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv12', '')); ?></div><br /><?php endif; ?>

<h1 class="arc-post-title" style="background:<?php echo of_get_option('cat-'. /* get_query_var('cat') */ get_cat_ID( single_cat_title("",false) ), '#777777'); ?>;"><?php single_cat_title(); ?></h1>
	<?php if(trim(category_description()) != "<br />" && trim(category_description()) != ''): ?>
		<div class="post-meta"><?php echo category_description(); ?></div><br />
    <?php endif; 

if ( of_get_option('num-heading-cat', '1') != '' ):
$catid = get_cat_ID( single_cat_title("",false) );
$args = array(
	'cat'        	  => $catid,
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'meta_key'        =>'np_ch',
    'meta_value'      =>'on' ,
    'post_type'       => 'post',
    'post_status'     => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page'  => of_get_option('num-heading-cat', '1'),
	'suppress_filters' => true );
 
 $my_query = new WP_Query($args); $duh= array();
 if (have_posts()) : while ( $my_query->have_posts()) :  $my_query->the_post(); $duh[] = $post->ID; ?>
 <div class="fpheading">
 <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
 <a href="<?php the_permalink(); ?>">
 <p class="subtitle"><?php echo get_post_meta($post->ID, 'np_subtitle', 'true');  ?><p>
 <h1 class="page-title  <?php if (get_post_meta( $post->ID, 'np_vih', true ) == 'on' ): echo 'vi-heading'; endif; ?> "><?php the_title();?></h1> 
 <div class="entrytext"><?php if (get_post_meta( $post->ID, 'np_fi100', true ) == 'on' ): the_post_thumbnail('single-page' , array('class' => 'fi-full-width')); else: the_post_thumbnail('single-page' , array('class' => 'attachment-single-page')); endif;  ?>
 <?php if ( of_get_option('num-rnrmcph', '100') != '' ): $newspress_excerptlength= of_get_option('num-rnrmcph', '100'); else: $newspress_excerptlength= '100'; endif; the_excerpt(); ?>
 </div></a></div></div>
 <?php if ( of_get_option('adv13', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv13', '')); ?></div><br /><?php endif; ?>
 <div class="content-ver-sep"> </div>
 <?php endwhile; wp_reset_postdata(); endif; endif; ?>


 <?php if (have_posts()) : ?>
 <div class="fsubhcontainer">
 <?php 	$counter =0; $counterc =0; while (have_posts()) : the_post(); if ( !empty($duh) && in_array($post->ID, $duh)) continue; $counter++; ?>
 <?php if ( $counterc == 2 ): echo '<div class="clear"></div>'; $counterc = 1;  else: $counterc++;  endif; ?>
 <div class="fsubheading" <?php if ($counter == 1 || $counter == 2 ) : echo 'style="border: none;"'; endif; ?>  >
 <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
 <a href="<?php the_permalink(); ?>">
 <p class="subtitle"><?php echo get_post_meta($post->ID, 'np_subtitle', 'true'); ?></p>
 <h2 class="post-title"><?php the_title();?></h2>
 <div class="entrytext"><?php the_post_thumbnail('post-page'); if ( of_get_option('num-rnrmcpsh', '30') != '' ): $newspress_excerptlength= of_get_option('num-rnrmcpsh', '30'); else: $newspress_excerptlength= '30'; endif; the_excerpt(); ?></div></a>
 <div class="clear"> </div>
 </div></div>
 
 <?php endwhile; newspress_page_nav(); ?>
 </div>
 <?php else: newspress_404();  endif; ?>
 
 <?php if ( of_get_option('adv14', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv14', '')); ?></div><?php endif; ?>
</div><!--close content -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

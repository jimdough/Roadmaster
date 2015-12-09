<?php 
/* 	News Press's Archive Page
	Copyright: 2014, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since NewsPress 1.0
*/

get_header(); ?>

<div id="content" class="arc-content">
<?php if ( of_get_option('adv15', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv15', '')); ?></div><br /><?php endif; ?>
	<?php if (have_posts()) : ?>
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
		<h1 class="arc-post-title" style="background:<?php echo of_get_option('cat-'. /* get_query_var('cat') */ get_cat_ID( single_cat_title("",false) ), '#777777'); ?>;"><?php single_cat_title(); ?></h1>
		<?php if(trim(category_description()) != "<br />" && trim(category_description()) != '') { ?>
		<div id="description"><?php echo category_description(); ?></div>
		<?php }?>
		<div class="clear">&nbsp;</div>
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
		<h1 class="arc-post-title"><?php single_tag_title(); ?></h1>
		<div class="clear">&nbsp;</div>
		<div class="tagcloud"><?php wp_tag_cloud(''); ?></div>
		<div class="clear">&nbsp;</div>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h1 class="arc-post-title"><?php echo get_the_date('l, F jS, Y'); ?></h1>
		<div class="clear">&nbsp;</div>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h1 class="arc-post-title"><?php echo get_the_date('F, Y'); ?></h1>
		<div class="clear">&nbsp;</div>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h1 class="arc-post-title"><?php echo get_the_date('Y'); ?></h1>
		<div class="clear">&nbsp;</div>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
		<h1 class="arc-post-title"><?php echo get_the_author(); ?></h1>
		<div class="clear">&nbsp;</div>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h1 class="arc-post-title"><?php echo of_get_option('arc-text' , 'Archives' ); ?> </h1>
 	 	<?php } ?>

		<?php while (have_posts()) : the_post(); ?>
		
			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
 			<p class="subtitle"><?php echo get_post_meta($post->ID, 'np_subtitle', 'true'); ?></p>
 			<h2 class="post-title <?php if (get_post_meta( $post->ID, 'np_vih', true ) == 'on' ): echo 'vi-heading'; endif; ?> "><a href="<?php the_permalink(); ?>"><?php the_title		();?></a></h2>
			<?php newspress_author_meta(); ?>
 			<div class="content-ver-sep"> </div>
 			<div class="entrytext"><?php the_post_thumbnail(); ?>
  			<?php if ( of_get_option('num-wrds', '90') != '' ): $newspress_excerptlength= of_get_option('num-wrds', '90'); else: $newspress_excerptlength= '90'; endif; newspress_content(); ?>
 			<div class="clear"> </div>
 			<?php newspress_post_meta(); ?>
 			</div></div><br />
 
 			<?php endwhile; newspress_page_nav(); ?>
            <?php if ( of_get_option('adv16', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv16', '')); ?></div><?php endif; ?>
 
 <?php else:  newspress_404();  endif; ?>

</div><!--close content id-->

<?php get_sidebar(); ?>

<?php get_footer(); ?>

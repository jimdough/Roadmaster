<?php
/**
 * Template Name: Full Width
 *
 * @package xinmag
 * @since xinmag 1.0
 */
get_header(); ?>
<div id="content" class="<?php echo xinwp_grid_full(); ?>" role="main">
<?php
	while ( have_posts() ) {
		the_post();
		get_template_part( 'content', 'page' );
		comments_template( '', true );
	}
?>
</div>
<?php get_footer(); ?>

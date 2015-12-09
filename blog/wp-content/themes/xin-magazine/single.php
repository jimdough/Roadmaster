<?php
/**
 * The Template for displaying all single posts.
 *
 * @package xinmag
 * @since xinmag 1.0
 */
global $xinmag_layout;
$xinmag_layout = get_post_meta( $post->ID, '_xinmag_layout', true);

get_header();
?>
	<div id="content" class="<?php echo $xinmag_layout ? xinwp_grid_full() : xinwp_content_class(); ?>" role="main">
<?php	while ( have_posts() ) {
			the_post();
			get_template_part( 'content', get_post_format() ); ?>

			<nav id="nav-single" class="clearfix">
				<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '<i class="icon-chevron-left"></i>', 'Previous post link', 'xinmag' ) . '</span> %title' ); ?></span>
				<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '<i class="icon-chevron-right"></i>', 'Next post link', 'xinmag' ) . '</span>' ); ?></span>
			</nav>
<?php		comments_template( '', true );
		} ?>
	</div>
<?php if ( empty( $xinmag_layout ) ) get_sidebar(); ?>
<?php get_footer(); ?>

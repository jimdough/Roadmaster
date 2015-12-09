<?php
/**
 * The default template for displaying content
 *
 * @package xinmag
 * @since xinmag 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	xinmag_display_post_thumbnail($post->ID); ?>
	<header class="entry-header">
<?php
	xinmag_meta_date( 1 );
	xinmag_post_title();
	xinmag_post_meta();
?>
	</header>
	<div class="entry-content clearfix">
<?php
//	print_r(get_post_format_meta());
		the_content( '<span class="more-link btn btn-small btn-info">' . __( 'read more', 'xinmag' ) . '</span>' );
		wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'xinmag' ) . '</span>', 'after' => '</div>' ) ); 
?>
	</div>
	<?php xinmag_single_post_link(); ?>	
	<footer class="entry-footer clearfix">
<?php	xinmag_post_tag();
		xinmag_author_info();
?>
	</footer>
</article>

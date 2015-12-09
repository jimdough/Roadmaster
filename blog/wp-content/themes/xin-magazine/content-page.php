<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package xinmag
 * @since xinmag 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	if ( '' != get_the_title()  ) { ?>
		<header class="entry-header clearfix">
			<h1 class="entry-title"><?php the_title(); ?></h1>		
		</header>
<?php
	} 
	?> 
	<div class="entry-content clearfix">
<?php	the_content();
		wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'xinmag' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div>
	<footer class="entry-meta clearfix">
<?php
		edit_post_link( '<i class="icon-pencil"></i> ' . __( '[Edit]', 'xinmag' ), '<span class="edit-link">', '</span>' );
?>				
	</footer>
</article>

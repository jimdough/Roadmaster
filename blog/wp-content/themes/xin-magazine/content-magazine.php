<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'xinmag' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header>
	<div class="entry-summary clearfix">
<?php
	if ( has_post_thumbnail() ) {
?>
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'xinmag' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail( 'xinmag-section', array( 'class' => 'img-magzine alignright', 'title' => get_the_title() ) ); ?></a>
    <?php
		if ( is_sticky() ) {
			echo '<div class="featured-container">';
			if ( has_action('xinmag_featured_logo') )
				do_action('xinmag_featured_logo');
			else
				echo '<p><i class="icon-star"></i></p>';
			echo '</div>';
		}
	}
	the_excerpt(); ?>
	</div>
<?php
	xinmag_single_post_link();
	xinmag_post_summary_meta( 1 );
?>
</article>

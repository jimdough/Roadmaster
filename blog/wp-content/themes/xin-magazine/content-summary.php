<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
	global $more; //WordPress global variable
	global $xinwp_thumbnail, $xinwp_display_excerpt, $xinwp_entry_meta;
	
	if ( ! isset( $xinwp_display_excerpt ) )
		$xinwp_display_excerpt = 1;
	if ( ! isset( $xinwp_thumbnail ) )
		$xinwp_thumbnail = 'thumbnail';
	if ( ! isset( $xinwp_entry_meta ) )
		$xinwp_entry_meta = 1;
	$displayed_thumnnail = 0;
	if ( has_post_thumbnail() && ( 'none' != $xinwp_thumbnail ) ) {
		$displayed_thumnnail = 1;
?>	
		<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'xinmag' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail( $xinwp_thumbnail, array( 'class' => 'post-thumbnail', 'title' => get_the_title() ) ); ?></a>
    <?php
		if ( is_sticky() ) {
			echo '<div class="featured-container">';
			if ( has_action('xinwp_featured_logo') )
				do_action('xinwp_featured_logo');
			else
				echo '<p><i class="icon-star"></i></p>';
			echo '</div>';
		}	
	}
	?>
	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'xinmag' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header>
	<div class="entry-summary clearfix">
<?php 	
		if ( 1 == $xinwp_display_excerpt ) {
			the_excerpt();
		}
		elseif ( 2 == $xinwp_display_excerpt ) {
			$more = 0;
			if ( $displayed_thumnnail )
				add_filter( 'the_content', 'xinwp_remove_images', 100 );
			the_content( '' );		
			if ( $displayed_thumnnail )
				remove_filter( 'the_content', 'xinwp_remove_images', 100 );
		}
?>
	</div>
<?php
	xinmag_single_post_link();
	xinmag_post_summary_meta();
?>
</article>

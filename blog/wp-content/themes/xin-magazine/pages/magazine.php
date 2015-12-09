<?php
/**
 * Template Name: Magazine Home
 *
 * @package xinmag
 * @since 1.0
 */
get_header();
?>
<div id="content" class="<?php echo xinwp_content_class() ?>" role="main">
<?php 
	global $xinmag_options, $xinmag_headlines;
	
	$post_pp = $xinmag_options[ 'fp_postnum' ]; // All Posts
//	if ( 1 == $xinmag_options['fp_option']  && 0 == $xinmag_options['fp_category'] )
//		$post_pp = 3;
	$featured_args = array(
						'post_type' => 'post',
						'post_status' => 'publish',
						'posts_per_page' => $post_pp,
						'ignore_sticky_posts' => 1,
						'no_found_rows' => 1
						);
	if ( $xinmag_options['fp_category'] > 0 && 1 == $xinmag_options['fp_option'] )
		$featured_args['category__in'] = $xinmag_options['fp_category'];
	elseif ( 2 == $xinmag_options['fp_option'] ) {
	   $featured_args['meta_query'] = array(
       			array(
           			'key' => '_xinmag_featured',
           			'value' => 1,
          			'compare' => 'IN' ) );
	}
	
	$xinmag_headlines = array();	
	$featured = new WP_Query( $featured_args );	
	$count = 0;
	if ( $featured->have_posts() ) {
		$thumbs = array();
		echo '<div class="row"><div id="headlines" class="large-12 columns"><div class="flexslider">';
		echo '<ul id="featured" class="slides">';
		while ( $featured->have_posts() ) {
			$featured->the_post();
			$xinmag_headlines[] =  $post->ID;
			$readmore = get_post_meta( $post->ID, '_xinmag_readmore', true );
			if ( empty( $readmore ) )
				$readmore = __( 'Learn More', 'xinmag' );
			$thumbs[] = array( 'title' => trim(strip_tags(get_the_title())) , 'permalink' => get_permalink() );
			$count += 1;		
			echo '<li>';
			if ( has_post_thumbnail() ) { // Featured
				$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				echo '<a href="' . get_permalink() . '">';
				the_post_thumbnail( 'large', array(  'title' => get_the_title() ) );
				echo '</a><div class="slider-caption">';
				the_excerpt();
				echo '</div>';
			} else { // No Featured Images
				echo '<div class="no-featured-image">';
				echo '<h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
				the_excerpt(''); 
				echo '<a class="btn btn-primary btn-large" href="' . get_permalink() . '">';
				echo $readmore . '</a>';
				echo '</div>';			
			}
			echo '</li>';
		}
		echo '</ul></div></div></div>';	
		echo '<input id="slider-animation" type="hidden" value="' . $xinmag_options['fp_effect'] . '">';
		if ( $count > 1 ) {
			echo '<div class="row"><div id="headlines-index" class="large-12 columns">';
			echo '<ul id="featured-list" class="small-block-grid-' .$count.'">';

			for ( $i = 1 ; $i <= $count; $i++ ) {
				echo '<li>';
				echo '<h2 class="thumb-title"><a href="' . esc_url( $thumbs[ $i - 1 ]['permalink'] );
				echo '">' . $thumbs[ $i - 1 ]['title'] .'</a></h2>';
				echo '</li>';
			}
			echo '</ul></div></div>';
		}
	} 

	wp_reset_postdata();
	$sections = array();
	parse_str( $xinmag_options['section_order'], $sections );
	$col = 0;
	$column = 3;
	foreach ( $sections['section'] as $section ) {
		if ( $column > 1 && $col == 0 )
			echo "\n" . '<div class="row">';
		echo "\n" .'<div id="section-' . $section . '" class="section-home large-4 columns">';
		$col = $col + 1;
		if ( $col == 3 )
			$col = 0;
		xinmag_section_display( $section );
		echo '</div>';				
		if ( $col == 0 )
			echo '</div><!-- row -->';	 //row
	}
	if ( $col > 0 )
		echo '</div><!-- row -->';
?>
</div><!-- content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>

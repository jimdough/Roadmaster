<?php
/**
 * Functions for displaying content
 *
 * @package xinmag
 * @since 1.0
 */
if ( ! function_exists( 'xinmag_top_menu' ) ):
function xinmag_top_menu() {
?>
<div id="topbar" class="contain-to-grid sticky-topbar">
<nav class="top-bar">
  <ul class="title-area">
	<li class="name">
<?php
	global $xinmag_options;

	if ( ! empty( $xinmag_options['brandurl'] ) )
		$url =  $xinmag_options['brandurl'];
	else
		$url = home_url( '/' );
	if ( ! empty( $xinmag_options['brandname'] ) ) {
		echo '<h3><a href="' . esc_url( $url ) . '">';
		echo esc_attr( $xinmag_options['brandname'] ) . '</a></h3>';
	} elseif ( ! empty( $xinmag_options['brandlogo'] ) ) {
		echo '<a href="' . esc_url( $url ) . '"><img src="';
		echo esc_url( $xinmag_options['brandlogo'] ) . '" alt="';
		echo get_bloginfo( 'name' ) . '"></a>';
	}
?>
	</li>
	<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
  </ul>
  <section class="top-bar-section">
<?php
	if ( 'right' == $xinmag_options['menupos'] )
		add_filter( 'wp_nav_menu_items', 'xinwp_add_search_box', 10, 2);
	wp_nav_menu(array(
		'container' => false,
		'container_class' => 'menu',
		'menu_class' => 'top-bar-menu ' . $xinmag_options['menupos'],
		'theme_location' => 'top-bar', // where it's located in the theme
		'fallback_cb' => 'xinwp_nav_fb', // fallback function (see below)
		'walker' => new xinwp_topbar_walker()
	));
	if ( 'right' == $xinmag_options['menupos'] )
		remove_filter('wp_nav_menu_items','xinwp_add_search_box', 10, 2);
	else {
?>
	<section class="top-bar-section">
		<ul class="right">
			<li class="has-form"><?php get_search_form(); ?></li>
		</ul>
	</section>
<?php	
	}
?>
  </section>
</nav></div>
<?php
}
endif;

if ( ! function_exists( 'xinmag_logo_image' ) ) :
function xinmag_logo_image( $header_image, $size = 'full' ) {
	$html = '';
//	$header_image = get_header_image();
	if ( ! empty( $header_image ) ) {
		if( function_exists( 'get_custom_header' ) ) {
			$header_width = get_custom_header() -> width;
			$header_height = get_custom_header() -> height;
		}
		else {
			$header_width = HEADER_IMAGE_WIDTH;
			$header_height = HEADER_IMAGE_HEIGHT;				
		}
		if ( 'full' != $size ) {
			$ratio = $size / $header_height;
			$header_height = (int) $header_height * $ratio;
			$header_width = (int) $header_width  * $ratio;				 
		}
		$html = '<img src="' . $header_image . '" width="';
		$html .= $header_width . '" height="' . $header_height;
		$html .= '" alt="' . get_bloginfo( 'name') . '" />';
	}	
	echo apply_filters( 'xinmag_logo_image', $html );
}
endif;

if  ( ! function_exists( 'xinmag_branding' ) ) :
function xinmag_branding() {
?>
<div id="branding" class="large-12 columns">
<?php
	xinwp_header_branding(); //Action Hooks
	get_sidebar( 'header' );
	$header_image = get_header_image();
	if ( ! empty( $header_image ) ) { ?>
		<div id="logo" class="left">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
		  	<?php xinmag_logo_image( $header_image ) ?>
		  </a>
		</div>
<?php
	} else { ?>
	<div class="site-title">
		<h3 id="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h3>
		<h3 id="site-description"><?php bloginfo( 'description' ); ?></h3>
	</div>
<?php } ?>
</div>
<?php
}
endif;

if ( ! function_exists( 'xinmag_post_title' ) ) :
// Display Post Title
function xinmag_post_title() {
	global $xinmag_layout;
	if ( ! is_single()  ) {
		printf('<h2 class="entry-title"><a href="%1$s" title="%2$s" rel="bookmark">%3$s</a></h2>',
			get_permalink(),
			sprintf( esc_attr__( 'Permalink to %s', 'xinmag' ), the_title_attribute( 'echo=0' ) ),
			get_the_title()	);
	}
	else {
		printf('<h1 class="entry-title">%1$s</h1>',
			get_the_title()	);		
	}
}
endif;

if ( ! function_exists( 'xinmag_section_header' ) ) :	
function xinmag_section_header() { ?>
	<div id="section" class="section-bar">
	<div class="row"><div class="large-12 columns">
<?php
	global $xinmag_options;
	$sections = array();
	parse_str( $xinmag_options['section_order'], $sections );
	$count = is_array( $sections['section'] ) ? count( $sections['section'] ) : 0;
	if ( $count > 0 ) {
		echo '<ul class="small-block-grid-' . $count . '">';
		foreach ( $sections['section'] as $section ) {
			printf( '<li><a href="%1$s" title="%2$s" class="%3$s">%2$s</a></li>',
						get_category_link( $section ) ,
						get_the_category_by_ID( $section ),
						'bgcolor_' . $section );			
		}
		echo '</ul>';
	}
?>
	</div></div></div>
<?php
}
endif;


if ( ! function_exists( 'xinmag_single_post_link' ) ) :
/* This function echo the link to single post view for the following:
- Aside Post
- Post without title
------------------------------------------------------------------------- */
function xinmag_single_post_link() {
	if ( ! is_single() ) {
		if ( has_post_format( 'aside' ) || has_post_format( 'quote' ) || '' == the_title_attribute( 'echo=0' ) ) { 
			printf ('<a class="single-post-link" href="%1$s" title="%1$s"><i class="icon-chevron-right"></i></a>',
				get_permalink(),
				get_the_title()	);
		} 
	}
}
endif;

if ( ! function_exists( 'xin_author_info' ) ) :
/************************************************
Display Author Info on single post view 
 and author has filled out their description
 and showauthor option checked 
************************************************/ 
function xinmag_author_info() {
	global $xinmag_options;
	if ( is_single() && get_the_author_meta( 'description' )  ) { ?>
	<div id="author-info">
		<div id="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'xinmag_author_bio_avatar_size', 64 ) ); ?>
		</div><!-- #author-avatar -->
		<div id="author-description">
			<h2><?php printf( __( 'About %s', 'xinmag' ), get_the_author() ); ?></h2>
			<p><?php the_author_meta( 'description' ); ?></p>
			<div id="author-link">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author"><?php printf( __( 'View all posts by %s <span class="meta-nav"></span>', 'xinmag' ), get_the_author() ); ?></a>
			</div>
		</div>
	</div>
<?php 
	}
}
endif;

if ( ! function_exists( 'xinmag_display_post_thumbnail' ) ) :
// Display Large Post Thumbnail on top of the post
function xinmag_display_post_thumbnail( $post_id ) {
	global $xinmag_layout;
	if ( has_post_thumbnail() ) {
		if ( ! is_single() ) {
			printf ('<a href="%1$s" title="%2$s">', 
				get_permalink(),
				get_the_title()	);	
			the_post_thumbnail( 'large', array( 'class'	=> 'img-polaroid featured-image', 'title' => get_the_title() ) );
			echo '</a>';
		}
		else {
			if ( 2 == $xinmag_layout )			
				the_post_thumbnail( 'full', array( 'class'	=> 'fullscreen-image' ) );	
			else
				the_post_thumbnail( 'large', array( 'class'	=> 'img-polaroid featured-image', 'title' => get_the_title() ) );	
		}
	}
}
endif;

if ( ! function_exists( 'xinmag_template_intro' ) ) :
function xinmag_template_intro() {
	global $post, $xinmag_options;
		
//	$pagetitle = get_post_meta( $post->ID, '_xinmag_title', true );
	$content = get_the_content();
	$content = apply_filters( 'the_content', $content );
	$content = str_replace( ']]>', ']]&gt;', $content );
	if ( ! empty($content)) {
?>
<article id="post-<?php the_ID(); ?>" class="template-intro clearfix <?php echo xinmag_grid_full(); ?>">
<?php
		echo '<div class="entry-content clearfix">';
		echo $content;
		echo '</div>';			
?>
</article>
<?php
	}
}
endif;

if ( ! function_exists( 'xinmag_section_title' ) ) :	
function xinmag_section_title() {
	global $xinmag_options;
	if ( ! have_posts() || is_home() || is_single() )
		return;
?>
	<div id="section-tile">
<?php
	if ( is_search() ) { ?>
		<h1 class="section-title"><?php printf( __( 'Search Results for: %s', 'xinmag' ), '<span>' . get_search_query() . '</span>' ); ?></h1>	
<?php
	} elseif ( is_author() ) {
			the_post(); ?>
			<h1 class="section-title"><?php printf( __( 'Author Archives: %s', 'xinmag' ), '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a>' ); ?></h1>
<?php		rewind_posts();		
		
	}
	elseif ( is_category() ) {
		global $cat; // WP global variable
		$color_class = "color_" . $cat . ' bdcolor_' . $cat;
		$category_description = category_description();
		echo '<h1 class="section-title ' . $color_class .  '">';
		if ( empty( $category_description ) )
			single_cat_title( '', true );
		else
			echo $category_description;	
		echo '</h1>';		
	}
	elseif ( is_tag() ) {
		$tag_description = tag_description();
		if ( empty( $tag_description ) ) { ?>					
			<h1 class="section-title"><?php printf( __( 'Tag Archives: %s', 'xinmag' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h1>
<?php
		} else
			echo '<h1 class="section-title">'. $tag_description .'</h1>';			
	}
	elseif ( is_archive() ) {
		echo '<h1 class="section-title">';
		if ( is_day() ) 
			printf( __( 'Daily Archives: %s', 'xinmag' ), '<span>' . get_the_date() . '</span>' );
		elseif ( is_month() )
			printf( __( 'Monthly Archives: %s', 'xinmag' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'xinmag' ) ) . '</span>' );
		elseif ( is_year() )
			printf( __( 'Yearly Archives: %s', 'xinmag' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'xinmag' ) ) . '</span>' );
		else
			the_title(); 
		echo '</h1>';	
	}
?>
	</div>
<?php
}
endif;

if ( ! function_exists( 'xinmag_section_display' ) ) :
function xinmag_section_display( $section ) {
	global $xinmag_options, $xinmag_headlines;

	$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => $xinmag_options['section_postnum'],
				'category__in' => $section,
				'post__not_in' => $xinmag_headlines,
				);	
	$section_posts = new WP_Query( $args );	
	$count = 0;
	if ( $section_posts->have_posts() ) {
		echo '<h3 class="section-title bdcolor_' . $section . '">';
		printf( '<a href="%1$s" title="%2$s" class="%3$s">%2$s</a>',
						get_category_link( $section ) ,
						get_the_category_by_ID( $section ),
						'color_' . $section );
		echo '</h3>';
		while ( $section_posts->have_posts() ) {
			$section_posts->the_post();
			echo '<div class="section-item">';

			if ( 0 == $count ) {
				if ( has_post_thumbnail() ) {
					echo '<a href="' . get_permalink() . '">';
					the_post_thumbnail( 'xinmag-section', array(  'class' => 'section-image' ,'title' => get_the_title() ) );
					echo '</a>';
				}
				echo '<h2 class="section-top"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
				echo '<div class="entry-summary clearfix">';
				the_excerpt();
				echo '</div>';
			}
			else
				echo '<h2 class="section-index"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';				
			$count++;
			echo '</div>';
		}
	}
	wp_reset_postdata();
}
endif;
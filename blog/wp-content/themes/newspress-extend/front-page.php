<?php
/*
	Template Name: Front Page
	NewsPress Theme's Front Page to Display the Home Page if Selected
	Copyright: 2014, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since NewsPress 1.0
*/
?>

<?php get_header(); ?>



	<?php 
	if ( of_get_option('breakingnews-source', '4') == '1' ) : if ( of_get_option('brnewspid', '') != '' ): $bnewsid =  of_get_option('brnewspid', ''); $bnewscontent = apply_filters('the_content', get_post_field(	'post_content', $bnewsid )); endif; endif;
	if ( of_get_option('breakingnews-source', '4') == '2' ) : if ( of_get_option('breaking-news', '') != '' ): $bnewscontent = of_get_option('breaking-news', ''); endif; endif;

	if ( $bnewscontent != '' || of_get_option('breakingnews-source', '4') == '3' ):  ?>
      
      <div class="clear"> </div>
      <div class="breakingnews">    
 	  <?php 
	  $bnews = explode("\n", $bnewscontent ); ?>
  	  <ul id="js-news" class="js-hidden">
 	<?php 
	if (of_get_option('breakingnews-source', '4') == '3' ):
	$args = array(
 	'orderby'         => 'post_date',
    'order'           => 'DESC',
    'meta_key'        =>'np_brkn',
	'meta_value'      =>'on' ,
    'post_status'     => 'publish',
	'ignore_sticky_posts'=> 1,
	'posts_per_page'  => of_get_option('num-bn', '10'),
	'suppress_filters' => true );
	$my_query = new WP_Query($args); 
 	if (have_posts()) : while ( $my_query->have_posts()) : $my_query->the_post(); ?>
	<li class="news-item"><a href="<?php echo the_permalink(); ?>" target="_blank"><?php echo the_title(); ?></a></li>';
	<?php endwhile; wp_reset_postdata(); endif;
	else:
	foreach ( $bnews as $bnewsn ) { echo '<li class="news-item">'.$bnewsn .'</li>'; } 
 	endif;
    ?>  
      
      </ul>
      </div>
      <script type="text/javascript"> 
	  jQuery(function () { 
    	jQuery('#js-news').ticker( {
        speed: 0.10,           
        debugMode: true,       
        controls: true,        
        titleText: '<?php echo of_get_option('brnewstext', 'Breaking News:'); ?>',   
        displayType: 'reveal', 
        direction: 'ltr',       
        pauseOnItems: 2000,    
        fadeInSpeed: 600,      
        fadeOutSpeed: 300      
		});
	  });	
	   </script>
    <div class="clear"> </div> 
	<?php endif; ?>
      



<div id="content" class="frnt-page">

<!-- Slide  -->

<?php if ( of_get_option('num-heading-slide', '5') != '') : 

 $args = array(
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'meta_key'        =>'np_fps',
	'meta_value'      =>'on' ,
    'post_status'     => 'publish',
	'ignore_sticky_posts'=> 1,
	'posts_per_page'  => of_get_option('num-heading-slide', '5'),
	'suppress_filters' => true );
 
 $my_query = new WP_Query($args);
 if (have_posts()) : if (of_get_option('50-slider', '0') == '1' ): $dat1 = '90'; $dat2 = '150'; $dat3 = '220'; $sliderdimention = '600,300'; else: $dat1 = '120'; $dat2 = '200'; $dat3 = '270'; $sliderdimention = '900,400';  endif;  ?>
 
 <!-- Start of Slide Container -->  
 <div id="slide-container"><div class="slider-wrapper"><div class="slider"><div class="fs_loader"></div>
 
 <?php  while ( $my_query->have_posts()) :  $my_query->the_post(); ?>
 
 
 <div class="slide" >
 <?php if ( has_post_thumbnail() ): $thumburl = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-page'); endif; ?>
 <img class="slide-full" src="<?php if (!empty($thumburl)): echo $thumburl['0']; endif; ?>" data-position="0,0" data-in="fade" data-step="0" data-out="fade"/>
 <div class="slide-des" data-position="<?php echo $dat2; ?>,20" data-in="right" data-step="1" data-out="right" ><?php $newspress_excerptlength='20'; the_excerpt(); ?></div>
 <a class="slide-title" href="<?php echo the_permalink(); ?>" data-position="<?php echo $dat1; ?>,20" data-in="left" data-step="1" data-out="left"><h2><?php echo the_title(); ?></h2></a> 
 <p data-position="<?php echo $dat3; ?>,20" data-in="bottom" data-step="2" data-out="bottom" ><a href="<?php echo the_permalink(); ?>" class="read-more cat-read-more"><?php echo of_get_option('readmore', 'Read More'); ?></a><span class="rarrow"> </span></p>
  
 </div>
 <?php endwhile; wp_reset_postdata(); ?>
 
 </div></div></div>  <!--  End of Slide Container --> 
 <?php if (of_get_option('50-slider', '0') == '1' ): ?><div id="right-sidebar" class="slider-sidebar"><?php dynamic_sidebar( 'sidebar-7' ); ?></div><?php endif; ?>
 
 <script type="text/javascript">
jQuery(window).load(function(){
	jQuery('.slider').fractionSlider({
		'fullWidth': 			true,
		'controls': 			<?php echo of_get_option('slide-nav', 'true'); ?>, 
		'pager': 				<?php echo of_get_option('slide-navdots', 'true'); ?>,
		'responsive': 			true,
		'dimensions': 			"<?php echo $sliderdimention; ?>",
	    'increase': 			false,
		'pauseOnHover': 		true,
		'autoChange' : 			<?php echo of_get_option('slide-autoplay', 'true'); ?>,
		'slideTransitionSpeed' : <?php echo of_get_option('slide-interval', '3500'); ?>,
		'speedIn' : 			<?php echo of_get_option('slide-inspeed', '1500'); ?>, 
		'speedOut' : 			<?php echo of_get_option('slide-outspeed', '1000'); ?>,
		'slideEndAnimation': 	true
	});

});
</script>
 
 <?php endif;  ?>
 
 <br /><div class="content-ver-sep"> </div>
 <?php if ( of_get_option('adv05', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv05', '')); ?></div><?php endif; ?>


<!-- Heading  -->

<?php endif; if ( of_get_option('num-heading', '1') != '' ): 

 $args = array(
    'numberposts'     => '',
    'offset'          => 0,
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'include'         => '',
    'exclude'         =>'',
    'meta_key'        =>'np_fph',
    'meta_value'      =>'1' ,
    'post_type'       => 'post',
    'post_mime_type'  =>'',
    'post_parent'     =>'' ,
    'post_status'     => 'publish',
	'ignore_sticky_posts' => 1,
	'posts_per_page'  => of_get_option('num-heading', '1'),
	'suppress_filters' => true );
 
 $my_query = new WP_Query($args); $duh = array();
 if (have_posts()) : while ( $my_query->have_posts()) :  $my_query->the_post(); $duh[] = $post->ID; ?>
 <div class="fpheading">
 <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
 <a href="<?php the_permalink(); ?>">
 <span class="subtitle"><?php echo get_post_meta($post->ID, 'np_subtitle', 'true'); ?></span>
 <h1 class="page-title  <?php if (get_post_meta( $post->ID, 'np_vih', true ) == 'on' ): echo 'vi-heading'; endif; ?> "><?php the_title();?></h1> 
 <div class="entrytext"><?php if (get_post_meta( $post->ID, 'np_fi100', true ) == 'on' ): the_post_thumbnail('single-page' , array('class' => 'fi-full-width')); else: the_post_thumbnail('single-page' , array('class' => 'attachment-single-page')); endif;  ?>
 <?php if ( of_get_option('num-rnrmfh', '100') != '' ): $newspress_excerptlength= of_get_option('num-rnrmfh', '100'); else: $newspress_excerptlength= '100'; endif; the_excerpt(); ?>
 </div></a></div></div>
 <div class="content-ver-sep"> </div>
 <?php endwhile; wp_reset_postdata(); endif; ?>

<?php endif; ?>

<!-- Sub Heading  -->
<?php
 $args = array(
    'orderby'         => 'post_date',
    'order'           => 'DESC',
    'meta_key'        =>'np_fph',
	'meta_value'      =>'2' ,
    'post_status'     => 'publish',
	'ignore_sticky_posts'=> 1,
	'posts_per_page'  => of_get_option('num-sub-heading', '6'),
	'suppress_filters' => true );
 
 $my_query = new WP_Query($args); $dus = array(); if (have_posts()) : echo '<div class="fsubhcontainer">'; $counter = 0; $counterc = 0; while ( $my_query->have_posts()) :  $my_query->the_post(); $dus[] = $post->ID; $counter++; if ( of_get_option('num-sub-heading', '6') != '' ): ?>
 <?php if ( of_get_option('adv06', '') != '' && $counter == 3 ): ?><div class="advertisement" style="margin: 10px auto; width: 94%;"><?php echo do_shortcode(of_get_option('adv06', '')); ?></div><?php endif; ?> <?php if ( $counterc == 2 ): echo '<div class="clear"></div>'; $counterc = 1;  else: $counterc++;  endif; ?>
 <div class="fsubheading" <?php if ($counter == 1 || $counter == 2 ) : echo 'style="border: none;"'; endif; ?>  >
 <div <?php post_class(); ?> id="post-<?php the_ID(); ?>"> 
 <a href="<?php the_permalink(); ?>">
 <p class="subtitle"><?php echo get_post_meta($post->ID, 'np_subtitle', 'true'); ?></p>
 <h2 class="post-title"><?php the_title();?></h2>
 <div class="entrytext"><?php the_post_thumbnail('post-page'); if ( of_get_option('num-rnrmsh', '30') != '' ): $newspress_excerptlength= of_get_option('num-rnrmsh', '30'); else: $newspress_excerptlength= '30'; endif; the_excerpt(); ?></div></a>
 <div class="clear"> </div>
 </div></div>
 <?php endif; endwhile; echo '</div>'; wp_reset_postdata(); endif;  ?>
 
 <div class="clear"></div>
 <?php if ( of_get_option('adv07', '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('adv07', '')); ?></div><?php endif; ?>

 <!-- Special Category -->
 
<?php 
$args = array(
	'type'                     => 'post',
	'child_of'                 => '',
	'parent'                   => '',
	'orderby'                  => 'slug',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'depth'					   => 1,
	'walker' 				   => 'object',
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false );


$cats = get_categories($args); 
foreach ($cats as $cat) :
if ($cat->category_parent == 0 &&  of_get_option('catsp-'. $cat->cat_ID, '0') == '1' ) {
echo '<div class="fpage-catspecial">'; 
$args = array(
'orderby'        => 'post_date',
'order'          => 'DESC', 
'cat' 			 => $cat->term_id
);

$my_query = new WP_Query($args); $duc = array(); 

	 if (have_posts()) : $counter = 0; $scatcount = of_get_option('num-catsp-news'. $cat->cat_ID, '7');
	 
	 echo '<a href="'.get_category_link($cat->cat_ID).'" target="_blank"><h2 class="fcname" style="background:'. of_get_option('cat-'. $cat->cat_ID, '#777777') .';">' . $cat->name . '</h2></a>';
	 
	 while ( $my_query->have_posts()) :  $my_query->the_post();   if ( !empty($duh) && in_array($post->ID, $duh)) continue; if ( !empty($dus) && in_array($post->ID, $dus)) continue; $duc[] = $post->ID; if ( $counter == $scatcount ) : break; else: $counter++; ?>	

<?php if ($counter == 1 || $counter == 2 ) : ?>
<div class="special-cat-sub">
<a href="<?php the_permalink() ?>" ><?php the_post_thumbnail('cat-page', array('class' => 'fi-full-width-cat')); ?>
<h3 class="fcpt"><?php the_title(); ?></h3>
<?php if ( of_get_option('num-rnrmsc', '15') != '' ): $newspress_excerptlength= of_get_option('num-rnrmsc', '15'); else: $newspress_excerptlength= '15'; endif; the_excerpt(); ?></a></div><?php else: ?>
<h4 class="fcpt"><li><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></li></h4></a>

<?php endif; ?> 
	<?php endif; endwhile; ?>
	<a class="read-more cat-read-more" href="<?php echo get_category_link($cat->cat_ID); ?>" target="_blank"><?php echo of_get_option('readall', 'Read All'); ?></a><span class="rarrow"> </span>
 	<?php else : 
		echo '<h2>No Posts for '.$cat->name.' Category</h2>';				
	 endif; wp_reset_postdata(); ?>
     
<div class="clear"></div>
<?php if ( of_get_option('num-cat-ad'.$cat->cat_ID, '') != '' ): ?><div class="advertisement"><?php echo do_shortcode(of_get_option('num-cat-ad'.$cat->cat_ID, '')); ?></div><?php endif; ?>
	
<?php 
echo '</div> <!--end of fpage-catspecial-->';
}
endforeach; wp_reset_postdata(); ?>
 
 
 
 
 </div>  <!-- End of Contents -->
 <?php get_sidebar('frontpage'); ?>
 <?php if (of_get_option('fpgallery', '1') == '1'): get_template_part( 'fpgallery' ); endif; ?>
 <div class="content-ver-sep"> </div><br />
 
 
 <!-- Categories -->
 
<?php 
$args = array(
	'type'                     => 'post',
	'child_of'                 => '',
	'parent'                   => '',
	'orderby'                  => 'slug',
	'order'                    => 'ASC',
	'hide_empty'               => 1,
	'hierarchical'             => 1,
	'depth'					   => 1,
	'walker' 				   => 'object',
	'exclude'                  => '',
	'include'                  => '',
	'number'                   => '',
	'taxonomy'                 => 'category',
	'pad_counts'               => false );

echo '<div class="fccontainer">';
$cats = get_categories($args);  $countercc = 0;
foreach ($cats as $cat) :
if ($cat->category_parent == 0 &&  of_get_option('cats-'. $cat->cat_ID, '1') == '1' &&  of_get_option('catsp-'. $cat->cat_ID, '0') != '1' ) {
	
// if ( of_get_option('responsive', '0') != '1' ) : if ( $countercc == 4 ): echo '<div class="clear"></div>'; $countercc = 1;  else: $countercc++;  endif; endif;
if ( $countercc == 4 ): echo '<div class="clear-cat"></div>'; $countercc = 1;  else: $countercc++;  endif; 

echo '<div class="fpage-cat" style="border-top: 1px solid '. of_get_option('cat-'. $cat->cat_ID, '#777777') .';">'; 

$args = array(
'post__not_in'   =>  $ducc,
'orderby'         => 'post_date',
'order'           => 'DESC', 
'cat' => $cat->term_id
);

$my_query = new WP_Query($args); $ducc = array();

	 if (have_posts()) : $counter = 0;  $catcount =  of_get_option('num-cat-news'. $cat->cat_ID, '5');
	 
	 echo '<a href="'.get_category_link($cat->cat_ID).'" target="_blank"><h2 class="fcname" style="background:'. of_get_option('cat-'. $cat->cat_ID, '#777777') .';">' . $cat->name . '</h2></a>';
	 
	 while ( $my_query->have_posts()) :  $my_query->the_post(); if ( !empty($duh) && in_array($post->ID, $duh)) continue; if ( !empty($dus) && in_array($post->ID, $dus)) continue; if ( !empty($duc) && in_array($post->ID, $duc)) continue; $ducc[] = $post->ID;  if ( $counter == $catcount ) : break; else:  $counter++;  ?>	
	
<?php if ($counter == 1 ) : ?>
<a href="<?php the_permalink() ?>" ><?php the_post_thumbnail('cat-page', array('class' => 'fi-full-width-cat')); ?>
<h3 class="fcpt"><?php the_title(); ?></h3>
<?php if ( of_get_option('num-rnrmfc', '15') != '' ): $newspress_excerptlength= of_get_option('num-rnrmfc', '15'); else: $newspress_excerptlength= '15'; endif; the_excerpt(); ?> </a> <?php else: ?>
<h4 class="fcpt"><li><a href="<?php the_permalink() ?>" ><?php the_title(); ?></a></li></h4></a>
<?php endif; ?>
	<?php endif; endwhile; ?>
	<a class="read-more cat-read-more" href="<?php echo get_category_link($cat->cat_ID); ?>" target="_blank"><?php echo of_get_option('readall', 'Read All'); ?></a><span class="rarrow"> </span>
 	<?php else : 
		echo '<h2>No Posts for '.$cat->name.' Category</h2>';				
	 endif; 
	 
	 wp_reset_postdata(); ?>
     <?php if ( of_get_option('num-cat-ad'.$cat->cat_ID, '') != '' ): ?><br /><br /><div class="advertisement"><?php echo do_shortcode(of_get_option('num-cat-ad'.$cat->cat_ID, '')); ?></div><?php endif; ?>
	
<?php 
echo '</div> <!--end of fpage-cat-->';
}
endforeach; wp_reset_postdata(); ?>
</div>

<?php if (of_get_option('fpgallery', '1') == '2'): get_template_part( 'fpgallery' ); endif; ?>

<div class="clear"></div>
<?php get_footer(); ?>


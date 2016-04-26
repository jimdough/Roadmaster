<?php 
/* The Template for displaying all single posts */

get_header(); 
global $wdwt_front,$post;

$news_magazine_meta = get_post_meta($post->ID,WDWT_META,TRUE); ?>
</header>
<div class="container">
	<?php  if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
		<aside id="sidebar1">
			<div class="sidebar-container">
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>	
				<div class="clear"></div>
			</div>
		</aside>
    <?php }?>
	<div id="content">
		<?php $wdwt_front->integration_top(); ?>
		<?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
			<div class="single-post">
				<h2 class="single-title page-header"><span><?php the_title(); ?></span></h2>
				<?php  $url = wp_get_attachment_url( get_post_thumbnail_id() );
				if ( has_post_thumbnail() && $url ) { ?>
					  <div class="post-thumbnail-div">
						  <img src="<?php echo  esc_url( $url ); ?>" style="max-width: 200px;" />
						  <div class="clear"></div>
					  </div> 
				<?php } ?>						
				<div class="entry">	
					<?php  the_content(); ?>
				</div>
				<?php if($wdwt_front->get_param('date_enable', $news_magazine_meta, false)){ ?>
				<div class="entry-meta">
					  <?php news_magazine_frontend_functions::posted_on_single(); ?>
				</div>
				<?php news_magazine_frontend_functions::entry_meta_cat(); }?>
				<?php $wdwt_front->integration_bottom(); 
				wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Page', "news-magazine" ) . '</span>', 'after' => '</div>', 'link_before' => '<span class="page-links-number">', 'link_after' => '</span>' ) ); 
				news_magazine_frontend_functions::post_nav(); ?>
				<div class="clear"></div>
				
				<?php $wdwt_front->bottom_advertisment();
				if(comments_open()){  ?>
					<div class="comments-template">
						<?php echo comments_template();	?>
						<div class="clear"></div>
					</div>
				<?php } ?>
		   </div>

	<?php endwhile; ?>

	<?php endif;   ?>
	</div>
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
		<aside id="sidebar2">
			<div class="sidebar-container">
			  <?php  dynamic_sidebar( 'sidebar-2' ); 	?>
			  <div class="clear"></div>
			</div>
		</aside>
    <?php } ?>
</div>
<?php get_footer(); ?>
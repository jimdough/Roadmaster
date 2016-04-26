<?php 
get_header();
global $wdwt_front; ?>
</header>
<div class="container">
   <?php if ( is_active_sidebar( 'sidebar-1' ) ) { ?>
        <aside id="sidebar1" >
            <div class="sidebar-container">			
				<?php  dynamic_sidebar( 'sidebar-1' ); 	?>
				<div class="clear"></div>
            </div>
        </aside>
	<?php }  ?>	
    <div id="content">
        <?php  if(have_posts()) : while(have_posts()) : the_post(); ?>
			  <div class="single-post">
				 <h2 class="page-header"><span><?php the_title(); ?></span></h2>
				 <div class="entry"><?php the_content(); ?></div>
			  </div>
			<?php endwhile; ?>
		   <div class="navigation">
				<?php posts_nav_link(); ?>
		   </div>
        <?php endif; ?>
		<div class="clear"></div>
		<?php $wdwt_front->bottom_advertisment();
		if(comments_open()){  ?>
				<div class="comments-template">
					<?php echo comments_template();	?>
				</div>
		
		<?php } ?>	
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
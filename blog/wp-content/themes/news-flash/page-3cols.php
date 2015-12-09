<?php
/*
Template Name: 3 Cols
*/
get_header();
?>

<div class="row">


    <div class="col-md-3">
        <div class="sidebar">
            <?php dynamic_sidebar('Page - Left Sidebar'); ?>
        </div>
    </div>


    <div class="col-md-6">
        <div id="single-post post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php

            while (have_posts()): the_post(); ?>

                <div <?php post_class('post'); ?>>
                    <div class="clear"></div>
                    <h1 class="entry-title"><?php the_title(); ?></h1>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                    <?php wp_link_pages(); ?>
                </div>
                <div class="mx_comments">
                    <?php comments_template(); ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>


    <div class="col-md-3">
        <div class="sidebar">
            <?php dynamic_sidebar('Page - Right Sidebar'); ?>
        </div>
    </div>

</div>




<?php get_footer(); ?>

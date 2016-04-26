<?php
if ('show' == get_option('kopa_theme_options_post_about_author', 'show')) { ?>

<div class="about-author clearfix">
    <h3><?php echo esc_html( 'About author', 'fastnews-light' ); ?></h3>

    <div class="about-author-detail clearfix">
        <a class="avatar-thumb" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta('ID'), 74 ); ?></a>
        <div class="author-content">
            <header>
                <a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>"><?php the_author_meta('display_name'); ?></a>
            </header>
            <p><?php the_author_meta( 'description' ); ?></p>
        </div><!--author-content-->
    </div>
</div><!--about-author-->

<?php
}
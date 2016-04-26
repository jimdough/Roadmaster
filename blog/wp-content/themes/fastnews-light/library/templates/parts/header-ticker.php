<?php
$kopa_theme_options_headline_title = get_theme_mod( 'headline-title', esc_attr__( 'Breaking News', 'fastnews-light' ) );
$kopa_theme_options_headline_category_id = get_theme_mod( 'headline-category', '' );
$kopa_theme_options_headline_posts_number = (int) get_theme_mod( 'headline-postnumber', '10' );

if ( $kopa_theme_options_headline_posts_number ) {
    $args = array(
        'category'       => $kopa_theme_options_headline_category_id,
        'posts_per_page' => $kopa_theme_options_headline_posts_number,
    );

    global $post;
    $ticker_posts = get_posts( $args );
    ?>

<span class="kp-headline-title"><?php echo esc_html($kopa_theme_options_headline_title); ?></span>
<div class="kp-headline clearfix">
    <dl class="ticker-1 clearfix">
        <?php foreach ( $ticker_posts as $post ) {
        setup_postdata( $post );
        ?>
        <dd><a href="<?php the_permalink(); ?>" title="<?php the_title();?>"><?php the_time( get_option( 'date_format' ) ); ?> - <?php the_title(); ?></a></dd>
        <?php } // end foreach
        wp_reset_postdata();
        ?>
    </dl>
</div>
<!--ticker-1-->

<?php }
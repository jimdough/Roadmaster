<?php 
$kopa_setting = fastnews_get_template_setting();
$sidebars = $kopa_setting['sidebars'];
?>

<?php get_header(); ?>

<div class="wrapper">
        
    <?php kopa_breadcrumb(); ?>
    
    <section class="error-404 clearfix">
        <div class="left-col">
            <p><?php echo esc_html( '404', 'fastnews-light' ); ?></p>
        </div><!--left-col-->
        <div class="right-col">
            <h1><?php echo esc_html( 'Page not found...', 'fastnews-light' ); ?></h1>
            <p><?php echo esc_html( "We're sorry, but we can't find the page you were looking for. It's probably some thing we've done wrong but now we know about it we'll try to fix it. In the meantime, try one of this options:", 'fastnews-light' ); ?></p>
            <ul class="arrow-list">
                <li><a href="javascript: history.go(-1);"><?php echo esc_html('Go back to previous page', 'fastnews-light'); ?></a></li>
                <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html( 'Go to homepage', 'fastnews-light' ); ?></a></li>
            </ul>
        </div><!--right-col-->
    </section><!--error-404-->

</div>
<!-- wrapper -->

<?php if (is_active_sidebar($sidebars['position_5']) || is_active_sidebar($sidebars['position_6']) || is_active_sidebar($sidebars['position_7']) || is_active_sidebar($sidebars['position_8']) || is_active_sidebar($sidebars['position_9'])) { ?>
    <div class="widget-area-5">
        <ul class="wrapper clearfix">
            <li class="widget-area-6">
                <?php if ( is_active_sidebar( $sidebars['position_5'] ) ) {
                    dynamic_sidebar( $sidebars['position_5'] );
                } ?>
            </li>
            <!-- widget-area-6 -->
            <li class="widget-area-7">
                <?php if ( is_active_sidebar( $sidebars['position_6'] ) ) {
                    dynamic_sidebar( $sidebars['position_6'] );
                } ?>
            </li>
            <!-- widget-area-7 -->
            <li class="widget-area-8">
                <?php if ( is_active_sidebar( $sidebars['position_7'] ) ) {
                    dynamic_sidebar( $sidebars['position_7'] );
                } ?>
            </li>
            <!-- widget-area-8 -->
            <li class="widget-area-9">
                <?php if ( is_active_sidebar( $sidebars['position_8'] ) ) {
                    dynamic_sidebar( $sidebars['position_8'] );
                } ?>
            </li>
            <!-- widget-area-9 -->
            <li class="widget-area-10">
                <?php if ( is_active_sidebar( $sidebars['position_9'] ) ) {
                    dynamic_sidebar( $sidebars['position_9'] );
                } ?>
            </li>
            <!-- widget-area-10 -->
        </ul>
        <!-- wrapper -->
    </div>
    <!-- widget-area-5 -->
<?php } // endif ?>

<?php if ( is_active_sidebar( $sidebars['position_10'] ) ) { ?>
    <div class="widget-area-11">
        <div class="wrapper">
            <?php dynamic_sidebar( $sidebars['position_10'] ); ?>
        </div>
        <!-- wrapper -->
    </div>
    <!-- widget-area-11 -->
<?php } // endif ?>

<?php get_footer(); ?>
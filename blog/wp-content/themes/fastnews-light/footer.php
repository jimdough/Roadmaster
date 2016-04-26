<?php
$kopa_setting = fastnews_get_template_setting();
$sidebars = $kopa_setting['sidebars'];
/* get options
 -------------------------*/

// footer logo
$kopa_footer_logo = get_theme_mod( 'footer_logo_url', '' );

// footer copyright
$kopa_theme_options_copyright = get_theme_mod( 'copyright', esc_attr__( 'Copyright &copy; 2013 . All Rights Reserved. Designed by kopatheme.com.', 'fastnews-light' ) );

/* END get options
 -------------------------*/

if ( ! empty($kopa_footer_logo)
        || has_nav_menu( 'footer-nav' )
        || is_active_sidebar( $sidebars['position_11'] )
        || is_active_sidebar( $sidebars['position_12'] )
        || is_active_sidebar( $sidebars['position_13'] )
        || is_active_sidebar( $sidebars['position_14'] )
        || is_active_sidebar( $sidebars['position_15'] )
    ) :
?>

<div id="bottom-sidebar">

    <div class="wrapper">
        <div class="t-bottom-sidebar clearfix">

            <?php if ( ! empty( $kopa_footer_logo ) ) { ?>
                <div class="footer-logo pull-left"><a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url( $kopa_footer_logo ); ?>" alt="<?php bloginfo('name'); ?>"></a></div>
            <?php } ?>

            <?php
            if ( has_nav_menu( 'footer-nav' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'footer-nav',
                    'container'      => '',
                    'menu_id'        => 'footer-menu',
                    'items_wrap'     => '<ul id="%1$s" class="clearfix">%3$s</ul>',
                    'depth'          => -1
                ) );
            }
            ?>
        </div>
        <!-- t-bottom-sidebar -->
        <?php if ( is_active_sidebar( $sidebars['position_11'] )
                    || is_active_sidebar( $sidebars['position_12'] )
                    || is_active_sidebar( $sidebars['position_13'] )
                    || is_active_sidebar( $sidebars['position_14'] )
                    || is_active_sidebar( $sidebars['position_15'] )
                ) : ?>

            <div class="b-bottom-sidebar clearfix">
                <div class="bottom-left-col">
                    <div class="row">
                        <?php if ( is_active_sidebar( $sidebars['position_11'] ) ) { ?>
                            <div class="col-md-3 col-sm-3 col-xs-6 widget-area-12">
                                <?php
                                dynamic_sidebar( $sidebars['position_11'] );
                                ?>
                            </div>
                            <!-- widget-area-12 -->
                        <?php } ?>
                        <?php if ( is_active_sidebar( $sidebars['position_12'] ) ) { ?>
                            <div class="col-md-3 col-sm-3 col-xs-6 widget-area-13">
                                <?php
                                dynamic_sidebar( $sidebars['position_12'] );
                                ?>
                            </div>
                            <!-- widget-area-6 -->
                        <?php } ?>
                        <?php if ( is_active_sidebar( $sidebars['position_13'] ) ) { ?>
                            <div class="col-md-3 col-sm-3 col-xs-6 widget-area-14">
                                <?php
                                dynamic_sidebar( $sidebars['position_13'] );
                                ?>
                            </div>
                            <!-- widget-area-7 -->
                        <?php } ?>
                        <?php if ( is_active_sidebar( $sidebars['position_14'] ) ) { ?>
                            <div class="col-md-3 col-sm-3 col-xs-6 widget-area-15">
                                <?php
                                dynamic_sidebar( $sidebars['position_14'] );
                                ?>
                            </div>
                            <!-- widget-area-8 -->
                        <?php } ?>
                    </div>
                    <!-- row -->
                </div>
                <!-- bottom-left-col -->
                <?php if ( is_active_sidebar( $sidebars['position_15'] ) ) { ?>
                    <div class="bottom-right-col widget-area-16">
                        <?php
                        dynamic_sidebar( $sidebars['position_15'] );
                        ?>
                    </div>
                <!-- bottom-right-col -->
                <?php } ?>
            </div>

        <?php endif; ?>
        <!-- b-bottom-sidebar -->
    </div>
    <!-- wrapper -->
</div>
<!-- bottom-sidebar -->

<?php endif; ?>

</div>
<!-- main-content -->
<?php if ( ! empty($kopa_theme_options_copyright) ) : ?>
    <footer id="kp-page-footer">
        <div class="wrapper text-center" id="copyright"><?php echo wp_kses_post($kopa_theme_options_copyright); ?></div>
    </footer>
    <!-- kp-page-footer -->
<?php endif; ?>

<?php wp_footer(); ?>
</body>

</html>
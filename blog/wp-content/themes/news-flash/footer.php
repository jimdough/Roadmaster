</div>
<footer id="footer">

    <div class="footer-copyright">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <p><?php echo esc_html(newsflash_get_theme_opts('footer_text','Copyright &copy; '. get_bloginfo('sitename'))); ?> / Theme by <a href='http://wpeden.com'>WP Eden</a> / Powered by <a href='http://wordpress.org'>WordPress</a></p>
                </div>
                <div class="col-md-6">
                    <nav id="footer-menu">
                        <?php


                        $args = array(
                            'theme_location' => 'footer',
                            'depth' => 0,
                            'container' => false,
                            'menu_class' => 'nav-links',
                            'fallback_cb' => false
                        );


                        wp_nav_menu($args);


                        ?>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</footer>

</div>



<?php wp_footer(); ?>

</body>
</html>

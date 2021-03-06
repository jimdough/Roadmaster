<?php
$kopa_setting = fastnews_get_template_setting();
$sidebars = $kopa_setting['sidebars'];
?>

<?php get_header(); ?>

<div class="wrapper">
    <div class="col-a widget-area-1">

        <?php get_template_part('library/templates/parts/loop-blog-1'); ?>

    </div>
    <!-- col-a -->

    <div class="col-b">
        <?php if (is_active_sidebar($sidebars['position_4'])) { ?>
        <div class="widget-area-4">
            <?php dynamic_sidebar($sidebars['position_4']); ?>
        </div>
        <!-- widget-area-4 -->
        <?php } ?>
        <?php if (is_active_sidebar($sidebars['position_3'])) { ?>
        <div class="widget-area-3">
            <?php
            dynamic_sidebar($sidebars['position_3']);
            ?>
        </div>
        <!-- widget-area-3 -->
        <?php } ?>
        <div class="clear"></div>
    </div>
    <!-- col-b -->
    <div class="clear"></div>
</div>
<!-- wrapper -->

<?php if (is_active_sidebar($sidebars['position_5']) || is_active_sidebar($sidebars['position_6']) || is_active_sidebar($sidebars['position_7']) || is_active_sidebar($sidebars['position_8']) || is_active_sidebar($sidebars['position_9'])) { ?>
<div class="widget-area-5">
    <ul class="wrapper clearfix">
        <?php if (is_active_sidebar($sidebars['position_5'])) { ?>
        <li class="widget-area-6">
            <?php
            dynamic_sidebar($sidebars['position_5']);
            ?>
        </li>
        <!-- widget-area-6 -->
        <?php } ?>
        <?php if (is_active_sidebar($sidebars['position_6'])) { ?>
        <li class="widget-area-7">
            <?php
            dynamic_sidebar($sidebars['position_6']);
            ?>
        </li>
        <!-- widget-area-7 -->
        <?php } ?>
        <?php if (is_active_sidebar($sidebars['position_7'])) { ?>
        <li class="widget-area-8">
            <?php
            dynamic_sidebar($sidebars['position_7']);
            ?>
        </li>
        <!-- widget-area-8 -->
        <?php } ?>
        <?php if (is_active_sidebar($sidebars['position_8'])) { ?>
        <li class="widget-area-9">
            <?php
            dynamic_sidebar($sidebars['position_8']);
            ?>
        </li>
        <!-- widget-area-9 -->
        <?php } ?>
        <?php if (is_active_sidebar($sidebars['position_9'])) { ?>
        <li class="widget-area-10">
            <?php
            dynamic_sidebar($sidebars['position_9']);
            ?>
        </li>
        <!-- widget-area-10 -->
        <?php } ?>
    </ul>
    <!-- wrapper -->
</div>
<!-- widget-area-5 -->
<?php } // endif  ?>

<?php if (is_active_sidebar($sidebars['position_10'])) { ?>
<div class="widget-area-11">
    <div class="wrapper">
        <?php dynamic_sidebar($sidebars['position_10']); ?>
    </div>
    <!-- wrapper -->
</div>
<!-- widget-area-11 -->
<?php } // endif   ?>

<?php get_footer(); ?>
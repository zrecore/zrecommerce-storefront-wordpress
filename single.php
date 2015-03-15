<?
/**
 * Single
 */
global $post;
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <?php get_header() ?>
    <body>

        <?php get_template_part('navigation') ?>

        <div class="main-container">

            <div class="body-container">
            
                <?php get_template_part('articlepost'); ?>
                
                <?php get_sidebar( 'frontpage' ); ?>

            </div>
        </div>

        <?php get_template_part('footer-navigation'); ?>
        <?php get_footer() ?>

    </body>
</html>
<!-- Single -->
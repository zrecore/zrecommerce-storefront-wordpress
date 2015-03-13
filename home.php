<?php 
 /**
  * Home
  */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <?php get_header() ?>
    <body>

        <?php get_template_part('navigation') ?>

        <div class="main-container">

            <?php get_template_part('hero-unit'); ?>
            
            <!-- Home -->
            <div class="body-container">
            
                <?php get_template_part('home-posts'); ?>
                
                <?php get_sidebar( 'frontpage' ); ?>

            </div>
        </div>

        <?php get_template_part('footer-navigation'); ?>
        <?php get_footer() ?>

    </body>
</html>
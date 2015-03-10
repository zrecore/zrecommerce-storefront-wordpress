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

            
            <div class="hero">
                <div class="hero-inner">
                    <a href="" class="hero-logo"><img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt="Logo Image"></a>
                    <div class="hero-copy">
                        <h1>Short description of Product</h1>
                        <p>A few reasons why this product is worth using, who it's for and why they need it.</p>    
                    </div>
                    <button>Learn More</button>
                </div>
            </div>

            <!-- Home -->
            <div class="body-container">
                
                <?php get_sidebar( 'frontpage' ); ?>
            </div>
        </div>

        <?php get_template_part('footer-navigation'); ?>
        <?php get_footer() ?>

    </body>
</html>
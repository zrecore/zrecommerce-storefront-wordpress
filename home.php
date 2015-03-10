<?php 
 /**
  * Home
  */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <?php get_header() ?>
    <body>

        <header class="navigation" role="banner">
          <div class="navigation-wrapper">
            <a href="javascript:void(0)" class="logo">
              <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt="Logo Image">
            </a>
            <a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">MENU</a>
            <nav role="navigation">
              <?php 
                $nav_args = array(
                    'theme_location' => 'navigation-menu',
                    'menu'          => 'Navigation Menu',
                    'container'     => '',
                    'items_wrap'    => '<ul id="js-centered-navigation-menu" class="centered-navigation-menu show">%3$s</ul>'
                );
                wp_nav_menu($nav_args) ?>
            </nav>
            <div class="navigation-tools">
              <div class="search-bar">
                <form role="search">
                  <input type="search" placeholder="Enter Search" />
                  <button type="submit">
                    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/search-icon.png" alt="Search Icon">
                  </button>
                </form>
              </div>
              <a href="javascript:void(0)" class="sign-up">Sign Up</a>
            </div>
          </div>
        </header>

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

        <footer class="footer" role="contentinfo">
          <div class="footer-logo">
            <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt="Logo image">
          </div>
          <div class="footer-links">
            <ul>
              <li><h3>Content</h3></li>
              <li><a href="javascript:void(0)">About</a></li>
              <li><a href="javascript:void(0)">Contact</a></li>
              <li><a href="javascript:void(0)">Products</a></li>
            </ul>
            <ul>
              <li><h3>Follow Us</h3></li>
              <li><a href="javascript:void(0)">Facebook</a></li>
              <li><a href="javascript:void(0)">Twitter</a></li>
              <li><a href="javascript:void(0)">YouTube</a></li>
            </ul>
            <ul>
              <li><h3>Legal</h3></li>
              <li><a href="javascript:void(0)">Terms and Conditions</a></li>
              <li><a href="javascript:void(0)">Privacy Policy</a></li>
            </ul>
          </div>

          <hr>

          <p>Disclaimer area lorem ipsum dolor sit amet, consectetur adipisicing elit. Rerum, nostrum repudiandae saepe.</p>
        </footer>
        <?php get_footer() ?>

    </body>
</html>
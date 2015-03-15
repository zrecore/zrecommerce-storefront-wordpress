<header class="navigation" role="banner">
  <div class="navigation-wrapper">
    <a href="/" class="logo">
      <img src="<?php echo get_template_directory_uri() . '/assets/icons/logo.png'; ?>" alt="Logo Image">
    </a>
    <a href="javascript:void(0)" class="navigation-menu-button" id="js-mobile-menu">MENU</a>
    <nav role="navigation">
      <?php 
        $nav_args = array(
            'theme_location' => 'navigation-menu',
            'container'     => '',
            'items_wrap'    => '<ul id="js-centered-navigation-menu" class="centered-navigation-menu show">%3$s</ul>'
        );
        wp_nav_menu($nav_args) ?>

    </nav>

    <div class="navigation-tools">
      <div class="search-bar">
        <form role="search" method="get" action="<?php echo home_url( '/' ); ?>">
          <input type="search" name="s" placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
          <button type="submit">
            <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/search-icon.png" alt="Search Icon">
          </button>
        </form>
      </div>
      <?php if( zrecommerce_enabled() ): ?>
      <?php get_template_part('navigation-cart'); ?>
      <?php endif; ?>
      
    </div>
  </div>
</header>
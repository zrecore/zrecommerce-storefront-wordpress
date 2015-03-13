<footer class="footer" role="contentinfo">
  <div class="footer-logo">
    <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/placeholder_logo_1.png" alt="Logo image">
  </div>
  <div class="footer-links">
    <ul>
    <li><h3>Content</h3></li>
    <?php 
        $nav_args = array(
            'theme_location' => 'content-navigation',
            'container'     => '',
            'items_wrap'    => '<li>%3$s</li>'
        );
        wp_nav_menu($nav_args) ?>
    </ul>
    <!-- <ul>
      <li><h3>Content</h3></li>
      <li><a href="javascript:void(0)">About</a></li>
      <li><a href="javascript:void(0)">Contact</a></li>
      <li><a href="javascript:void(0)">Products</a></li>
    </ul> -->
    <ul>
    <li><h3>Follow</h3></li>
    <?php 
        $nav_args = array(
            'theme_location' => 'social-navigation',
            'container'     => '',
            'items_wrap'    => '<li>%3$s</li>'
        );
        wp_nav_menu($nav_args) ?>
    </ul>
    <!-- <ul>
      <li><h3>Follow Us</h3></li>
      <li><a href="javascript:void(0)">Facebook</a></li>
      <li><a href="javascript:void(0)">Twitter</a></li>
      <li><a href="javascript:void(0)">YouTube</a></li>
    </ul> -->
    <ul>
    <li><h3>Legal</h3></li>
    <?php 
        $nav_args = array(
            'theme_location' => 'legal-navigation',
            'menu'          => 'Legal',
            'container'     => '',
            'items_wrap'    => '<li>%3$s</li>'
        );
        wp_nav_menu($nav_args) ?>
    </ul>
    <!-- <ul>
      <li><h3>Legal</h3></li>
      <li><a href="javascript:void(0)">Terms and Conditions</a></li>
      <li><a href="javascript:void(0)">Privacy Policy</a></li>
    </ul> -->
  </div>

  <hr>

  <p><?php get_sidebar('copyrights') ?></p>
</footer>
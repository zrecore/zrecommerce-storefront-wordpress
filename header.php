<?php

/**
 * Header include
 */
?>
<!-- HEAD BOD -->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php the_title() ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head() ?>
</head>
<!-- HEAD EOD -->
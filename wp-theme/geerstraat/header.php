<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header>
  <div class="wrap nav">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
      <span class="badge"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/logo.png'); ?>" alt="Buurtraad Geerstraat logo"></span>
      <span class="brand-txt"><b>Buurtraad Geerstraat</b><span class="sub">Vaassen</span></span>
    </a>

    <?php
    wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => 'nav',
        'container_class'=> 'links',
        'menu_class'     => '',
        'depth'          => 1,
        'fallback_cb'    => function () {
            echo '<nav class="links">';
            echo '<a href="' . esc_url(home_url('/')) . '">Home</a>';
            echo '<a href="' . esc_url(home_url('/over/')) . '">Over ons</a>';
            echo '<a href="' . esc_url(home_url('/fotos/')) . '">Foto\'s</a>';
            echo '<a href="' . esc_url(home_url('/#contact')) . '">Contact</a>';
            echo '</nav>';
        },
    ]);
    ?>

    <a class="cta" href="<?php echo esc_url(home_url('/#contact')); ?>">Doe mee</a>
    <button class="menu-btn" aria-label="Menu" onclick="toggleMenu(this)">&#9776; Menu</button>
  </div>
</header>

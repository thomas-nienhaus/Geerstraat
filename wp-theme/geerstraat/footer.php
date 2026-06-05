<footer>
  <div class="wrap foot">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
      <span class="badge"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/logo.png'); ?>" alt=""></span>
      <span class="brand-txt"><b>Buurtraad Geerstraat</b><span class="sub">Vaassen</span></span>
    </a>
    <div class="foot-links">
      <a class="site" href="<?php echo esc_url(home_url('/')); ?>">www.geerstraat.nl</a>
      <a href="<?php echo esc_url(home_url('/#jaarplanner')); ?>">Jaarplanner</a>
      <a href="<?php echo esc_url(home_url('/#clubs')); ?>">Clubs</a>
      <a href="<?php echo esc_url(home_url('/fotos/')); ?>">Foto's</a>
      <a href="<?php echo esc_url(home_url('/#contact')); ?>">Contact</a>
      <?php
      $privacy = get_privacy_policy_url();
      if ($privacy) {
          echo '<a href="' . esc_url($privacy) . '">Privacy verklaring</a>';
      } else {
          echo '<a href="#">Privacy verklaring</a>';
      }
      ?>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

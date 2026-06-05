<?php get_header(); ?>

<main>
  <div class="wrap">
    <div class="single-post">
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <a class="back-link" href="<?php echo esc_url(home_url('/#nieuws')); ?>">&#8592; Terug naar nieuws</a>

        <div class="datum"><?php echo esc_html(get_the_date('j F Y')); ?></div>
        <h1><?php the_title(); ?></h1>

        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail('large', ['class' => 'post-thumbnail']); ?>
        <?php endif; ?>

        <div class="entry-content">
          <?php the_content(); ?>
        </div>

      <?php endwhile; endif; ?>
    </div>
  </div>
</main>

<?php get_footer(); ?>

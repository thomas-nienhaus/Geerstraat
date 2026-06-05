<?php get_header(); ?>

<main>
  <section class="page-hero">
    <div class="wrap">
      <span class="eyebrow">Laatste nieuws</span>
      <h1>Berichten</h1>
      <p>Alle nieuws en mededelingen van Buurtraad Geerstraat.</p>
    </div>
  </section>

  <section class="block">
    <div class="wrap">
      <div class="nieuws-grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <a class="nieuws-kaart" href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('medium', ['style' => 'width:100%;border-radius:12px;object-fit:cover;max-height:180px;']); ?>
            <?php endif; ?>
            <div class="datum"><?php echo esc_html(get_the_date('j F Y')); ?></div>
            <h3><?php the_title(); ?></h3>
            <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22, '…')); ?></p>
          </a>
        <?php endwhile; else : ?>
          <p style="color:var(--ink-soft);font-style:italic;font-family:'Newsreader',serif;">Nog geen berichten geplaatst.</p>
        <?php endif; ?>
      </div>

      <div style="margin-top:40px">
        <?php the_posts_pagination(['mid_size' => 2]); ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>

<?php get_header(); ?>

<main>
  <section class="page-hero">
    <div class="wrap">
      <span class="eyebrow">Herinneringen</span>
      <h1>Foto's</h1>
      <p>Bekijk de foto-albums van onze activiteiten en evenementen.</p>
    </div>
  </section>

  <section class="block">
    <div class="wrap">
      <div class="album-grid">
        <?php
        $albums = new WP_Query([
            'post_type'      => 'fotoalbum',
            'posts_per_page' => -1,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);

        $foto_icoon = '<rect x="3" y="3" width="18" height="18" rx="3"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/>';
        $extern_icoon = '<path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/>';

        if ($albums->have_posts()) :
            while ($albums->have_posts()) : $albums->the_post();
                $url = function_exists('get_field') ? get_field('url') : get_post_meta(get_the_ID(), 'url', true);
        ?>
          <div class="album-kaart">
            <div class="album-icoon">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><?php echo $foto_icoon; ?></svg>
            </div>
            <h3><?php the_title(); ?></h3>
            <?php if ($url) : ?>
              <a class="album-link" href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener">
                Bekijk album
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><?php echo $extern_icoon; ?></svg>
              </a>
            <?php endif; ?>
          </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
        ?>
          <p class="album-leeg">Er zijn nog geen fotoalbums toegevoegd.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>

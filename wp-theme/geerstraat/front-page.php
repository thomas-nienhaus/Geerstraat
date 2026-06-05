<?php get_header(); ?>

<main id="top">

  <!-- HERO -->
  <section class="hero">
    <span class="blob b1"></span>
    <div class="wrap">
      <div class="hero-grid">
        <div class="hero-copy">
          <span class="eyebrow">Buurtvereniging &middot; Vaassen</span>
          <h1>Samen maken we de buurt <em>gezellig</em></h1>
          <p class="lead">Het hele jaar door activiteiten, clubs en feesten voor jong en oud in de Geerstraat.</p>
          <div class="actions">
            <a class="btn btn-primary" href="#jaarplanner">Bekijk de jaarplanner</a>
            <a class="btn btn-ghost" href="#clubs">Onze clubs &darr;</a>
          </div>
        </div>
        <div class="hero-art">
          <span class="blob b2"></span>
          <div class="logo-stage">
            <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/logo.png'); ?>" alt="Buurtraad Geerstraat">
          </div>
          <div class="pill-float pf1"><span class="dot" style="background:var(--leaf)"></span> 6 clubs per week</div>
          <div class="pill-float pf2"><span class="dot" style="background:var(--blush-deep)"></span> Zomerfeest 3 + 4 juli</div>
        </div>
      </div>
    </div>
  </section>

  <!-- NIEUWS -->
  <section class="block" id="nieuws">
    <div class="wrap">
      <div class="sec-head">
        <span class="eyebrow">Laatste nieuws</span>
        <h2>Berichten</h2>
        <p>Blijf op de hoogte van de activiteiten en nieuws uit de Geerstraat.</p>
      </div>
      <div class="nieuws-grid">
        <?php
        $nieuws = new WP_Query([
            'post_type'      => 'post',
            'posts_per_page' => 3,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ]);
        if ($nieuws->have_posts()) :
            while ($nieuws->have_posts()) : $nieuws->the_post();
        ?>
          <a class="nieuws-kaart" href="<?php the_permalink(); ?>">
            <?php if (has_post_thumbnail()) : ?>
              <?php the_post_thumbnail('medium', ['style' => 'width:100%;border-radius:12px;object-fit:cover;max-height:180px;']); ?>
            <?php endif; ?>
            <div class="datum"><?php echo esc_html(get_the_date('j F Y')); ?></div>
            <h3><?php the_title(); ?></h3>
            <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 22, '…')); ?></p>
          </a>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
        ?>
          <p style="color:var(--ink-soft);font-style:italic;font-family:'Newsreader',serif;">Nog geen berichten geplaatst.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- JAARPLANNER -->
  <section class="block" id="jaarplanner">
    <div class="wrap">
      <div class="sec-head">
        <span class="eyebrow">Het seizoen 2025 / 2026</span>
        <h2>Jaarplanner</h2>
        <p>Van pleinmarkt tot zomerfeest &mdash; dit staat er het komende jaar op de agenda in de Geerstraat.</p>
      </div>
      <div class="months">
        <?php
        $evenementen = new WP_Query([
            'post_type'      => 'evenement',
            'posts_per_page' => -1,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ]);

        // Groepeer per maand+jaar
        $maanden = [];
        if ($evenementen->have_posts()) :
            while ($evenementen->have_posts()) : $evenementen->the_post();
                $maand     = function_exists('get_field') ? get_field('maand')      : get_post_meta(get_the_ID(), 'maand', true);
                $jaar      = function_exists('get_field') ? get_field('jaar')       : get_post_meta(get_the_ID(), 'jaar', true);
                $datum     = function_exists('get_field') ? get_field('datum')      : get_post_meta(get_the_ID(), 'datum', true);
                $activiteit= function_exists('get_field') ? get_field('activiteit') : get_post_meta(get_the_ID(), 'activiteit', true);
                $kleur     = function_exists('get_field') ? get_field('kleur')      : get_post_meta(get_the_ID(), 'kleur', true);
                $note      = function_exists('get_field') ? get_field('note')       : get_post_meta(get_the_ID(), 'note', true);

                $sleutel = $maand . ' ' . $jaar;
                if (!isset($maanden[$sleutel])) {
                    $maanden[$sleutel] = [
                        'maand'      => $maand,
                        'jaar'       => $jaar,
                        'kleur'      => $kleur ?: 'sage',
                        'note'       => $note,
                        'evenementen'=> [],
                    ];
                }
                if ($activiteit) {
                    $maanden[$sleutel]['evenementen'][] = ['datum' => $datum, 'activiteit' => $activiteit];
                }
            endwhile;
            wp_reset_postdata();
        endif;

        if (empty($maanden)) :
        ?>
          <p style="color:var(--ink-soft);font-style:italic;">Nog geen evenementen ingepland.</p>
        <?php else : foreach ($maanden as $m) :
            $kleur = esc_attr($m['kleur']);
        ?>
          <div class="month s-<?php echo $kleur; ?>">
            <div class="mname"><?php echo esc_html($m['maand']); ?> <small><?php echo esc_html($m['jaar']); ?></small></div>
            <?php if (!empty($m['note'])) : ?>
              <p class="note-text"><?php echo esc_html($m['note']); ?></p>
            <?php else : foreach ($m['evenementen'] as $ev) : ?>
              <div class="ev">
                <span class="day"><?php echo esc_html($ev['datum']); ?></span>
                <span class="what"><?php echo esc_html($ev['activiteit']); ?></span>
              </div>
            <?php endforeach; endif; ?>
          </div>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </section>

  <!-- CLUBS -->
  <section class="block" id="clubs">
    <div class="wrap">
      <div class="sec-head">
        <span class="eyebrow">Elke week</span>
        <h2>Clubs weekplanner</h2>
        <p>Bewegen, ontmoeten en creatief bezig zijn. Iedereen uit de buurt is welkom om mee te doen.</p>
      </div>
      <div class="clubs-list">
        <?php
        $icons = [
            'ball'  => '<circle cx="12" cy="12" r="9"/><path d="M3 12c4-1 8-1 12 .5S21 15 21 15M7 4c1 4 1 8-1 13M16 4c-1 4-1 9 1 14"/>',
            'dumb'  => '<circle cx="6" cy="12" r="3"/><circle cx="18" cy="12" r="3"/><path d="M9 12h6"/>',
            'cup'   => '<path d="M5 8h11v6a4 4 0 0 1-4 4H9a4 4 0 0 1-4-4z"/><path d="M16 9h2.5a2.5 2.5 0 0 1 0 5H16"/><path d="M8 3v2M11 3v2"/>',
            'craft' => '<circle cx="7" cy="7" r="2.5"/><circle cx="7" cy="17" r="2.5"/><path d="M20 5 9 16M20 19 9 8"/>',
            'heart' => '<path d="M3 12h4l2-5 3 9 2.5-6 1.5 2H21"/>',
        ];

        $clubs_query = new WP_Query([
            'post_type'      => 'club',
            'posts_per_page' => -1,
            'orderby'        => 'meta_value_num',
            'meta_key'       => 'volgorde',
            'order'          => 'ASC',
        ]);

        if ($clubs_query->have_posts()) :
            while ($clubs_query->have_posts()) : $clubs_query->the_post();
                $dag         = function_exists('get_field') ? get_field('dag')          : get_post_meta(get_the_ID(), 'dag', true);
                $tijd        = function_exists('get_field') ? get_field('tijd')         : get_post_meta(get_the_ID(), 'tijd', true);
                $beschrijving= function_exists('get_field') ? get_field('beschrijving') : get_post_meta(get_the_ID(), 'beschrijving', true);
                $icon        = function_exists('get_field') ? get_field('icon')         : get_post_meta(get_the_ID(), 'icon', true);
                $svg_path    = $icons[$icon] ?? $icons['ball'];
        ?>
          <div class="club">
            <div class="when">
              <div class="day"><?php echo esc_html($dag); ?></div>
              <div class="time"><?php echo esc_html($tijd); ?></div>
            </div>
            <span class="ic">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <?php echo $svg_path; ?>
              </svg>
            </span>
            <div class="body">
              <h3><?php the_title(); ?></h3>
              <p><?php echo esc_html($beschrijving); ?></p>
            </div>
          </div>
        <?php
            endwhile;
            wp_reset_postdata();
        else :
            // Standaard clubs als er geen zijn aangemaakt in WordPress
            $standaard_clubs = [
                ['day' => 'Maandag',   'time' => '20:00 – 21:30u',                        'name' => 'Herentrimclub',   'desc' => 'Een combinatie van gymnastiekoefeningen en volleybal.',                               'ic' => 'ball'],
                ['day' => 'Dinsdag',   'time' => '09:30 – 10:30u / 19:30 – 20:30u',       'name' => 'Damestrimclub',   'desc' => 'Gymnastiekoefeningen met soms een parcours of volleybal.',                           'ic' => 'ball'],
                ['day' => 'Dinsdag',   'time' => '19:30 – 20:30u',                         'name' => 'Bootcamp',        'desc' => 'Werken aan de conditie met diverse attributen.',                                     'ic' => 'dumb'],
                ['day' => 'Woensdag',  'time' => 'vanaf 13:30u',                            'name' => 'Noaberclub',      'desc' => 'Elke laatste woensdag van de maand wisselende activiteiten voor alle 50\'ers.',      'ic' => 'cup'],
                ['day' => 'Woensdag',  'time' => '19:30 – 21:30u',                         'name' => 'Hobbyclub',       'desc' => 'De eerste woensdag van de maand voor iedereen die creatief bezig wil zijn.',         'ic' => 'craft'],
                ['day' => 'Woensdag',  'time' => '19:45 – 21:00u',                         'name' => 'Circuit Training','desc' => 'Diverse oefeningen voor het hele lichaam en de conditie.',                           'ic' => 'heart'],
            ];
            foreach ($standaard_clubs as $c) :
                $svg_path = $icons[$c['ic']] ?? $icons['ball'];
        ?>
          <div class="club">
            <div class="when">
              <div class="day"><?php echo esc_html($c['day']); ?></div>
              <div class="time"><?php echo esc_html($c['time']); ?></div>
            </div>
            <span class="ic">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                <?php echo $svg_path; ?>
              </svg>
            </span>
            <div class="body">
              <h3><?php echo esc_html($c['name']); ?></h3>
              <p><?php echo esc_html($c['desc']); ?></p>
            </div>
          </div>
        <?php endforeach; endif; ?>
      </div>
    </div>
  </section>

  <!-- CONTACT -->
  <section class="block" id="contact">
    <div class="wrap">
      <div class="contact-card">
        <div>
          <span class="eyebrow">Meedoen?</span>
          <h2>De eerste keer is gratis</h2>
          <p>Heb je vragen over onze clubs of wil je een keer meedoen? De eerste keer is dit gratis. Laat het ons weten!</p>
        </div>
        <div class="contact-box">
          <div class="label">Neem contact op met</div>
          <div class="name">Astrid Hendriks</div>
          <a class="mail" href="mailto:geerstraatvaassen@gmail.com">&#9993; geerstraatvaassen@gmail.com</a>
          <span class="free">De eerste keer meedoen is helemaal gratis.</span>
        </div>
      </div>
    </div>
  </section>

</main>

<?php get_footer(); ?>

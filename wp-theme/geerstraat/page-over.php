<?php get_header(); ?>

<main>
  <section class="page-hero">
    <div class="wrap">
      <span class="eyebrow">Wie zijn wij</span>
      <h1>Over de Buurtraad Geerstraat</h1>
      <p>De Buurtraad Geerstraat is de buurtvereniging van de Geerstraat in Vaassen. Al jaren organiseren we activiteiten, clubs en feesten voor alle bewoners.</p>
    </div>
  </section>

  <section class="block">
    <div class="wrap">

      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <div class="prose">
          <?php the_content(); ?>
        </div>
      <?php endwhile; endif; ?>

      <div class="prose" style="margin-top:40px">
        <h2>Bestuur</h2>
        <p>De buurtraad wordt gerund door een enthousiast team van vrijwilligers uit de buurt.</p>
      </div>

      <div class="bestuur-grid" style="margin-top:28px">
        <div class="bestuur-kaart">
          <div class="functie">Contactpersoon clubs</div>
          <div class="naam">Astrid Hendriks</div>
        </div>
      </div>

      <div class="prose" style="margin-top:40px">
        <h2>Meedoen of contact</h2>
        <p>Wil je meedoen aan een van onze clubs, heb je een idee voor een activiteit, of wil je je aanmelden als vrijwilliger? Neem dan contact op via <a href="mailto:geerstraatvaassen@gmail.com" style="color:var(--green);font-weight:600">geerstraatvaassen@gmail.com</a>.</p>
      </div>

    </div>
  </section>
</main>

<?php get_footer(); ?>

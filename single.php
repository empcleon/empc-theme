<?php
/** Single Post Template (single.php) */
get_header();
$special_posts = ['que-es-wordpress', 'webs-restaurantes-leon-booking', 'seo-local-leon', 'reservas-online-clinicas-leon', 'demo-reservas-restaurantes-leon', 'webs-para-imprentas-leon', 'wpo-wordpress-leon', 'web-restaurantes-leon', 'comercio-local-panaderia-leon'];
?>
<?php while (have_posts()): the_post();
    $post_slug = get_post_field('post_name', get_the_ID());
    $categories = get_the_category();
    $word_count = str_word_count(wp_strip_all_tags(get_the_content()));
    $reading_minutes = max(1, (int) ceil($word_count / 220));
?>
<main id="primary" class="blog-shell blog-article-shell site-main">
    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-article'); ?>>
        <header class="blog-article__hero">
            <div class="blog-container blog-article__hero-inner">
                <p class="blog-eyebrow"><?php echo esc_html($categories[0]->name ?? 'Notas de EMPC'); ?></p>
                <h1><?php the_title(); ?></h1>
                <div class="blog-article__meta">
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">Publicado el <?php echo esc_html(get_the_date()); ?></time>
                    <span aria-hidden="true">·</span><span><?php echo esc_html($reading_minutes); ?> min de lectura</span>
                </div>
                <?php if (has_post_thumbnail()): ?>
                    <figure class="blog-article__image"><?php the_post_thumbnail('large', ['loading' => 'eager']); ?></figure>
                <?php endif; ?>
            </div>
        </header>

        <div class="blog-container blog-article__layout">
            <aside class="blog-article__rail" aria-label="En este artículo">
                <span class="blog-eyebrow">Lectura práctica</span>
                <p>Ideas aplicables, contexto suficiente y límites explícitos.</p>
                <a href="<?php echo esc_url(home_url('/blog/')); ?>">← Volver al blog</a>
            </aside>
            <div class="blog-article__content">
                <?php if (in_array($post_slug, $special_posts, true)): ?>
                    <?php
                    $post_content = apply_filters('the_content', get_the_content());
                    if (in_array($post_slug, ['seo-local-leon', 'reservas-online-clinicas-leon', 'webs-para-imprentas-leon', 'wpo-wordpress-leon', 'web-restaurantes-leon', 'comercio-local-panaderia-leon'], true)) {
                        $post_content = preg_replace('#<h1\b[^>]*>.*?</h1>#is', '', $post_content, 1);
                    } else {
                        $post_content = preg_replace(['#<h1(\b[^>]*)>#i', '#</h1>#i'], ['<h2$1>', '</h2>'], $post_content);
                    }
                    echo $post_content;
                    if ($post_slug === 'wpo-wordpress-leon'): ?>
                        <section class="blog-inline-cta" aria-labelledby="wpo-contact-form-title">
                            <p class="blog-eyebrow">Presupuesto a medida</p><h2 id="wpo-contact-form-title">Cuéntame qué está frenando tu web</h2><p>La revisión define el alcance real antes de proponer cambios.</p><div id="island-contact-form" data-service="wpo"></div>
                        </section>
                    <?php elseif ($post_slug === 'seo-local-leon'): ?>
                        <section class="blog-inline-cta"><p>Recibirás una revisión inicial de tu ficha, tu web y las principales prioridades locales antes de decidir qué acciones tienen sentido.</p><a class="blog-button" href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=consultoria-wordpress')); ?>">Solicitar una valoración <span aria-hidden="true">↗</span></a></section>
                    <?php endif; ?>
                <?php else: ?>
                    <?php the_content(); ?>
                <?php endif; ?>

                <section class="blog-inline-cta" aria-labelledby="article-cta-title">
                    <p class="blog-eyebrow">Siguiente paso</p><h2 id="article-cta-title">¿Quieres aplicar esta idea a tu web?</h2><p>Cuéntame el contexto y revisamos un alcance razonable, sin añadir herramientas innecesarias.</p><a class="blog-button" href="<?php echo esc_url(home_url('/contacta-conmigo/')); ?>">Hablar del proyecto <span aria-hidden="true">↗</span></a>
                </section>
            </div>
        </div>
    </article>

    <?php if (get_previous_post() || get_next_post()): ?>
        <nav class="blog-container blog-post-nav" aria-label="Navegación entre artículos">
            <?php if (get_previous_post()): ?><div><span>Anterior</span><?php previous_post_link('%link', '%title'); ?></div><?php endif; ?>
            <?php if (get_next_post()): ?><div class="blog-post-nav__next"><span>Siguiente</span><?php next_post_link('%link', '%title'); ?></div><?php endif; ?>
        </nav>
    <?php endif; ?>
</main>
<?php endwhile; ?>
<?php get_footer(); ?>
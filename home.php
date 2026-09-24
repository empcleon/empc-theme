<?php
/**
 * Blog Feed Template (home.php)
 */
get_header();
$blog_description = 'Guías prácticas sobre WordPress, SEO local, rendimiento y herramientas web para negocios que quieren avanzar sin añadir complejidad.';
?>
<main id="primary" class="blog-shell site-main">
    <section class="blog-hero" aria-labelledby="blog-title">
        <div class="blog-container blog-hero__grid">
            <div>
                <p class="blog-eyebrow">Notas de EMPC · León</p>
                <h1 id="blog-title">Ideas para que tu web trabaje mejor.</h1>
                <p class="blog-lede"><?php echo esc_html($blog_description); ?></p>
            </div>
            <div class="blog-hero__aside" aria-label="Temas del blog">
                <span>WordPress</span><span>Comercio local</span><span>Rendimiento</span><span>Contenido útil</span>
            </div>
        </div>
    </section>

    <section class="blog-container blog-feed" aria-labelledby="blog-feed-title">
        <div class="blog-section-heading">
            <div><p class="blog-eyebrow">Archivo editorial</p><h2 id="blog-feed-title">Últimas publicaciones</h2></div>
            <p>Lecturas directas, con ejemplos y límites claros.</p>
        </div>
        <?php if (have_posts()): ?>
            <div class="blog-grid">
                <?php $post_index = 0; while (have_posts()): the_post(); $post_index++; ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card' . ($post_index === 1 ? ' blog-card--featured' : '')); ?>>
                        <a class="blog-card__media" href="<?php the_permalink(); ?>" aria-label="Leer <?php echo esc_attr(get_the_title()); ?>">
                            <?php if (has_post_thumbnail()): ?>
                                <?php the_post_thumbnail('medium_large', ['class' => 'blog-card__image', 'loading' => $post_index === 1 ? 'eager' : 'lazy']); ?>
                            <?php else: ?>
                                <span class="blog-card__placeholder" aria-hidden="true">EMPC / NOTAS</span>
                            <?php endif; ?>
                        </a>
                        <div class="blog-card__body">
                            <div class="blog-card__meta">
                                <?php $categories = get_the_category(); if (!empty($categories)): ?><span><?php echo esc_html($categories[0]->name); ?></span><?php endif; ?>
                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
                            </div>
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 30)); ?></p>
                            <a class="blog-card__link" href="<?php the_permalink(); ?>">Leer artículo <span aria-hidden="true">↗</span></a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            <nav class="blog-pagination" aria-label="Navegación de entradas">
                <?php the_posts_pagination(['mid_size' => 2, 'prev_text' => '← Anterior', 'next_text' => 'Siguiente →', 'screen_reader_text' => 'Navegación de entradas']); ?>
            </nav>
        <?php else: ?>
            <div class="blog-empty"><h3>Aún no hay artículos publicados</h3><p>Estamos preparando nuevas notas prácticas.</p></div>
        <?php endif; ?>
    </section>

    <section class="blog-cta blog-container" aria-labelledby="blog-cta-title">
        <div><p class="blog-eyebrow">¿Tienes una decisión pendiente?</p><h2 id="blog-cta-title">Podemos revisar el alcance de tu proyecto.</h2><p>Si necesitas ordenar una web, una tienda o un problema de rendimiento, cuéntame el contexto.</p></div>
        <a class="blog-button" href="<?php echo esc_url(home_url('/contacta-conmigo/')); ?>">Hablar del proyecto <span aria-hidden="true">↗</span></a>
    </section>
</main>
<?php get_footer(); ?>
<?php
/**
 * Blog Feed Template (home.php)
 */
get_header(); ?>

<div class="pt-32 pb-20 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto min-h-screen">

    <!-- Header del Blog -->
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-bold text-white mb-6">Blog & Recursos</h1>
        <p class="text-slate-300 text-lg max-w-2xl mx-auto">
            Guías sobre WordPress, SEO Local y automatización para negocios que quieren escalar sin complicaciones
            técnicas.
        </p>
    </div>

    <!-- Grid de Artículos -->
    <?php if (have_posts()): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while (have_posts()):
                the_post(); ?>

                <article id="post-<?php the_ID(); ?>"
                    class="bg-slate-800 rounded-2xl overflow-hidden border border-slate-700 hover:border-rose-500/50 transition-all hover:shadow-2xl hover:shadow-rose-900/10 group flex flex-col h-full">

                    <!-- Imagen Destacada -->
                    <a href="<?php the_permalink(); ?>" class="block h-48 overflow-hidden relative">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105']); ?>
                        <?php else: ?>
                            <div class="w-full h-full bg-slate-700 flex items-center justify-center text-slate-500">
                                <span class="text-sm">Sin imagen</span>
                            </div>
                        <?php endif; ?>

                        <!-- Categoría Badge -->
                        <div class="absolute top-4 left-4">
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)):
                                ?>
                                <span
                                    class="bg-slate-900/90 backdrop-blur text-white text-xs font-bold px-3 py-1 rounded-full border border-slate-600">
                                    <?php echo esc_html($categories[0]->name); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </a>

                    <!-- Contenido -->
                    <div class="p-6 flex flex-col flex-grow">
                        <!-- Fecha -->
                        <div class="text-slate-500 text-xs mb-3 flex items-center gap-2">
                            <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                            <?php echo get_the_date(); ?>
                        </div>

                        <h2 class="text-xl font-bold text-white mb-3 leading-tight group-hover:text-rose-400 transition-colors">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>

                        <div class="text-slate-400 text-sm mb-6 flex-grow line-clamp-3">
                            <?php the_excerpt(); ?>
                        </div>

                        <div class="mt-auto pt-4 border-t border-slate-700/50 flex justify-between items-center">
                            <a href="<?php the_permalink(); ?>"
                                class="text-white font-medium text-sm flex items-center gap-2 group/link">
                                Leer artículo
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                    class="transition-transform group-hover/link:translate-x-1">
                                    <path d="M5 12h14" />
                                    <path d="m12 5 7 7-7 7" />
                                </svg>
                            </a>
                            <span class="text-slate-600 text-xs">
                                5 min lectura
                            </span>
                        </div>
                    </div>
                </article>

            <?php endwhile; ?>
        </div>

        <!-- Paginación -->
        <div class="mt-16 text-center">
            <?php
            the_posts_pagination([
                'mid_size' => 2,
                'prev_text' => '← Anterior',
                'next_text' => 'Siguiente →',
                'screen_reader_text' => 'Navegación de entradas',
                'class' => ''
            ]);
            ?>
        </div>

    <?php else: ?>
        <div class="text-center py-20 bg-slate-800 rounded-2xl border border-dashed border-slate-700">
            <h3 class="text-xl font-bold text-white mb-2">No hay artículos todavía</h3>
            <p class="text-slate-400">Estamos preparando contenido de alto valor.</p>
        </div>
    <?php endif; ?>

</div>

<?php get_footer(); ?>
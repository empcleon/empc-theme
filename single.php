<?php
/**
 * Single Post Template (single.php)
 */
get_header(); ?>

<?php while (have_posts()):
    the_post(); ?>

    <article id="post-<?php the_ID(); ?>" class="min-h-screen">

        <!-- Hero del Post -->
        <header class="pt-32 pb-12 bg-gradient-to-b from-slate-900 via-slate-900 to-slate-950 relative overflow-hidden">
            <div class="absolute inset-0 bg-rose-500/5 blur-3xl rounded-full transform -translate-y-1/2"></div>

            <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <!-- Meta data -->
                <div class="flex items-center justify-center gap-4 mb-6 text-sm">
                    <span class="bg-rose-500/10 text-rose-400 border border-rose-500/20 px-3 py-1 rounded-full font-medium">
                        <?php echo get_the_category_list(', '); ?>
                    </span>
                    <span class="text-slate-500 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                            <line x1="16" x2="16" y1="2" y2="6" />
                            <line x1="8" x2="8" y1="2" y2="6" />
                            <line x1="3" x2="21" y1="10" y2="10" />
                        </svg>
                        <?php echo get_the_date(); ?>
                    </span>
                </div>

                <h1 class="text-3xl md:text-5xl font-extrabold text-white leading-tight mb-8">
                    <?php the_title(); ?>
                </h1>

                <?php if (has_post_thumbnail()): ?>
                    <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-slate-700/50 mt-8 aspect-video">
                        <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']); ?>
                    </div>
                <?php endif; ?>
            </div>
        </header>

        <!-- Contenido -->
        <div class="bg-slate-950 pb-20">
            <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

                <!-- WordPress Content Wrapper -->
                <!-- Usamos 'prose prose-invert' para estilizar el contenido automático de WP -->
                <div
                    class="prose prose-invert prose-lg max-w-none text-slate-300 prose-headings:text-white prose-a:text-rose-400 prose-a:no-underline hover:prose-a:underline prose-strong:text-white prose-code:text-rose-300 prose-pre:bg-slate-900 prose-pre:border prose-pre:border-slate-800">
                    <?php the_content(); ?>
                </div>

                <!-- Footer del Post -->
                <div class="mt-16 pt-8 border-t border-slate-800 flex justify-between items-center">
                    <div class="text-slate-500 text-sm">
                        Etiquetas:
                        <?php the_tags('', ', ', ''); ?>
                    </div>

                    <!-- Share (Simulado) -->
                    <div class="flex gap-2">
                        <button
                            class="text-slate-400 hover:text-white p-2 rounded-full hover:bg-slate-900 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                <polyline points="16 6 12 2 8 6" />
                                <line x1="12" x2="12" y1="2" y2="15" />
                            </svg>
                        </button>
                    </div>
                </div>

                <!-- Navegación entre posts -->
                <div class="grid grid-cols-2 gap-4 mt-8">
                    <div
                        class="bg-slate-900/50 p-4 rounded-xl border border-slate-800 hover:border-slate-700 transition-colors group">
                        <div class="text-xs text-slate-500 mb-1">Anterior</div>
                        <?php previous_post_link('%link', '<span class="text-white font-medium group-hover:text-rose-400 transition-colors">%title</span>'); ?>
                    </div>
                    <div
                        class="bg-slate-900/50 p-4 rounded-xl border border-slate-800 hover:border-slate-700 transition-colors text-right group">
                        <div class="text-xs text-slate-500 mb-1">Siguiente</div>
                        <?php next_post_link('%link', '<span class="text-white font-medium group-hover:text-rose-400 transition-colors">%title</span>'); ?>
                    </div>
                </div>

            </div>
        </div>

    </article>

<?php endwhile; ?>

<?php get_footer(); ?>
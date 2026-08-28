<?php
/**
 * Generic Page Template
 * HTML inicial para páginas comerciales y editoriales.
 */
get_header();
?>

<main id="primary" class="site-main bg-[#121826] text-slate-300">
    <?php while (have_posts()) : the_post(); ?>
        <?php $slug = get_post_field('post_name', get_the_ID()); ?>

        <article class="max-w-7xl mx-auto px-6 py-20">
            <?php if ($slug === 'presupuesto-web') : ?>
                <section class="grid lg:grid-cols-2 gap-12 items-start">
                    <div class="space-y-6">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#FF007A]/10 border border-[#FF007A]/20 text-[#FF007A]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#FF007A] animate-pulse"></span>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Territorio: León</span>
                        </div>
                        <h1 class="text-4xl md:text-5xl font-bold text-white"><?php the_title(); ?></h1>
                        <p class="text-xl text-slate-400 max-w-2xl">
                            Calcula el coste de tu proyecto con una estimación rápida y transparente.
                            Elige el tipo de web, añade extras y revisa un rango orientativo antes de hablar conmigo.
                        </p>
                        <ul class="space-y-3 text-slate-300">
                            <li>• Presupuesto orientativo con ajustes según alcance real</li>
                            <li>• Opciones para web básica, media o tienda online</li>
                            <li>• Extras de SEO, mantenimiento, diseño y React</li>
                        </ul>
                    </div>

                    <div class="lg:sticky lg:top-28">
                        <div id="island-pricing-calculator"></div>
                    </div>
                </section>

            <?php elseif ($slug === 'contacta-conmigo') : ?>
                <section class="space-y-10">
                    <div class="max-w-3xl space-y-6">
                        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E29595]/10 border border-[#E29595]/20 text-[#E29595]">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#E29595] animate-pulse"></span>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Contacto directo</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-bold text-white"><?php the_title(); ?></h2>
                    </div>

                    <div class="prose prose-invert prose-lg max-w-4xl text-slate-300">
                        <?php the_content(); ?>
                    </div>

                    <div class="pt-6">
                        <div id="island-contact-form"></div>
                    </div>
                </section>

            <?php elseif ($slug === 'mantenimiento-wordpress-leon' || $slug === 'alquiler-pagina-web-empresas-y-autonomos') : ?>
                <section class="prose prose-invert prose-lg max-w-4xl mx-auto text-slate-300">
                    <?php if ($slug === 'alquiler-pagina-web-empresas-y-autonomos') : ?>
                        <h1 class="text-4xl md:text-5xl font-bold text-white mb-8"><?php the_title(); ?></h1>
                    <?php endif; ?>
                    <?php the_content(); ?>
                </section>

            <?php else : ?>
                <section class="prose prose-invert prose-lg max-w-4xl mx-auto text-slate-300">
                    <?php the_content(); ?>
                </section>
            <?php endif; ?>
        </article>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>

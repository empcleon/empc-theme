<?php
/**
 * Template Name: Contact Page (Progressive HTML)
 * Description: Contact page with static HTML and React island form
 */

get_header();
?>

<main id="primary" class="site-main bg-[#121826] text-slate-300">
    <article class="max-w-7xl mx-auto px-6 py-20 lg:py-24">
        <div class="grid lg:grid-cols-[1.1fr_0.9fr] gap-12 items-start">
            <section class="space-y-8 max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E29595]/10 border border-[#E29595]/20 text-[#E29595] text-[10px] font-bold uppercase tracking-widest">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#E29595] animate-pulse"></span>
                    <span>Contacto directo</span>
                </div>

                <div class="space-y-4">
                    <h1 class="text-4xl md:text-6xl font-bold text-white leading-tight">Contacta conmigo</h1>
                    <p class="text-xl text-slate-400 leading-relaxed max-w-2xl">
                        Cuéntame qué necesitas y te responderé con los siguientes pasos para tu proyecto.
                    </p>
                </div>

                <div class="space-y-5 text-slate-300 leading-relaxed">
                    <p>
                        Puedes escribirme para consultas técnicas, peticiones de presupuesto o dudas sobre una web, una tienda online o el mantenimiento de tu sitio.
                    </p>
                    <p>
                        Cuanto más contexto compartas, mejor podré orientarte sobre alcance, prioridades y la forma más adecuada de enfocar el proyecto.
                    </p>
                    <ul class="space-y-3">
                        <li>• Consulta técnica sobre tu web o WordPress</li>
                        <li>• Petición de presupuesto para una web nueva o una mejora puntual</li>
                        <li>• Dudas sobre mantenimiento, SEO técnico o rendimiento</li>
                    </ul>
                </div>

                <div class="rounded-3xl border border-white/10 bg-[#1F2937]/50 p-6 space-y-4">
                    <h2 class="text-2xl font-bold text-white">Privacidad y uso responsable</h2>
                    <p class="text-slate-400 leading-relaxed">
                        Revisa antes de enviar la información la <a href="<?php echo esc_url(home_url('/politica-de-privacidad/')); ?>" class="text-[#E29595] hover:underline">política de privacidad</a>.
                        Solo uses el formulario para mensajes relacionados con tu proyecto.
                    </p>
                    <p class="text-sm text-slate-500">
                        Si compartes contexto suficiente, podré orientarte mejor sobre el alcance, las prioridades y el enfoque del proyecto.
                    </p>
                </div>
            </section>

            <section class="w-full">
                <div class="rounded-[2rem] border border-white/10 bg-[#1F2937]/50 p-6 md:p-8 shadow-2xl sticky lg:top-28">
                    <div class="space-y-4 mb-6">
                        <h2 class="text-2xl font-bold text-white">Escríbeme tu mensaje</h2>
                        <p class="text-slate-400 leading-relaxed">
                            Completa el formulario con los datos necesarios para entender tu consulta.
                        </p>
                        </div>

                        <div id="island-contact-form"></div>

                        <noscript>
                        <div class="mt-6 rounded-2xl border border-amber-400/20 bg-amber-400/10 p-4 text-amber-100 text-sm leading-relaxed">
                            Necesitas activar JavaScript para utilizar el formulario de contacto.
                        </div>
                        </noscript>
                </div>
            </section>
        </div>
    </article>
</main>

<?php get_footer(); ?>

<?php
/**
 * Front Page Template
 * Portada editorial SSR con islas React como mejora progresiva.
 */
get_header();

// Fuente única: data/commercial-pricing.json, leída mediante inc/commercial-pricing.php.
$empc_home_prices = [
    'landing'      => empc_commercial_price('design', 'landing'),
    'basic'        => empc_commercial_price('design', 'basic'),
    'professional' => empc_commercial_price('design', 'professional'),
    'woo_initial'  => empc_commercial_price('ecommerce', 'initial'),
    'woo_advanced' => empc_commercial_price('ecommerce', 'advanced'),
    'wpo'          => empc_commercial_price('wpo'),
    'maintenance'  => empc_commercial_price('maintenance', 'basic'),
    'consulting'   => empc_commercial_price('consulting'),
];
?>

<main id="primary" class="empc-home">
    <section id="home" class="empc-hero" aria-labelledby="empc-home-title">
        <div class="empc-shell empc-hero__grid">
            <div class="empc-hero__copy">
                <p class="empc-eyebrow empc-hero__eyebrow">
                    <span class="empc-eyebrow__signal" aria-hidden="true"></span>
                    Freelance WordPress en León · Servicio remoto en España
                </p>

                <h1 id="empc-home-title" class="empc-hero__title">
                    Diseño y desarrollo <span>WordPress en León</span>, con mantenimiento técnico para toda España
                </h1>

                <p class="empc-hero__statement">Sistemas web sólidos, mantenibles y preparados para evolucionar.</p>
                <p class="empc-hero__intro">
                    Desarrollo, optimizo y mantengo sitios WordPress con una base visible desde el primer HTML y React únicamente donde la interacción aporta valor real.
                </p>

                <div class="empc-actions">
                    <a class="empc-button empc-button--primary" href="<?php echo esc_url(home_url('/contacta-conmigo/')); ?>">
                        Cuéntame tu proyecto <span aria-hidden="true">↗</span>
                    </a>
                    <a class="empc-button empc-button--secondary" href="#servicios">
                        Explorar servicios <span aria-hidden="true">↓</span>
                    </a>
                </div>

                <dl class="empc-hero__facts">
                    <div><dt>Base</dt><dd>WordPress + PHP</dd></div>
                    <div><dt>Interacción</dt><dd>Islas React</dd></div>
                    <div><dt>Ámbito</dt><dd>León · España</dd></div>
                </dl>
            </div>

            <div class="empc-system">
                <div class="empc-system__backdrop" aria-hidden="true"></div>
                <div class="empc-system__panel">
                    <div class="empc-system__topline">
                        <span>EMPC / SISTEMA WEB</span>
                        <span class="empc-system__status"><i aria-hidden="true"></i> Base activa</span>
                    </div>

                    <div class="empc-system__core">
                        <div class="empc-system__node empc-system__node--primary">
                            <span class="empc-system__number">01</span>
                            <div><strong>HTML + PHP</strong><small>Contenido esencial visible</small></div>
                            <span class="empc-system__tag">SSR</span>
                        </div>
                        <div class="empc-system__connector" aria-hidden="true"><span></span></div>
                        <div class="empc-system__node">
                            <span class="empc-system__number">02</span>
                            <div><strong>WordPress</strong><small>Contenido, estructura y publicación</small></div>
                            <span class="empc-system__tag">CMS</span>
                        </div>
                        <div class="empc-system__connector" aria-hidden="true"><span></span></div>
                        <div class="empc-system__node">
                            <span class="empc-system__number">03</span>
                            <div><strong>React</strong><small>Calculadoras e interacción útil</small></div>
                            <span class="empc-system__tag">ISLAS</span>
                        </div>
                    </div>

                    <div class="empc-system__footer">
                        <span>Mejora progresiva</span>
                        <span>León <b aria-hidden="true">→</b> España</span>
                    </div>
                </div>
                <p class="empc-system__caption"><span>01</span> Ingeniería web con presencia editorial.</p>
            </div>
        </div>
    </section>

    <section id="tesis-empc" class="empc-section empc-thesis" aria-labelledby="empc-thesis-title">
        <div class="empc-shell empc-thesis__grid">
            <div data-empc-reveal>
                <p class="empc-kicker">01 / Tesis EMPC</p>
                <h2 id="empc-thesis-title" class="empc-heading">Lo esencial llega primero. La interacción se añade donde mejora la experiencia.</h2>
            </div>
            <div class="empc-thesis__body" data-empc-reveal>
                <p class="empc-lead">Una web no debería depender de JavaScript para explicar qué ofrece, pero puede utilizarlo para ofrecer herramientas mejores.</p>
                <p>WordPress mantiene el contenido y la estructura. PHP entrega una base comprensible desde el primer HTML. React se reserva para calcular, comparar y guiar decisiones sin sustituir la página.</p>
                <a class="empc-text-link" href="#metodo">Ver cómo trabajo <span aria-hidden="true">↓</span></a>
            </div>
        </div>

        <div class="empc-shell" data-empc-reveal>
            <ol class="empc-flow" aria-label="Arquitectura de entrega de EMPC">
                <li><span>01</span><strong>Contenido</strong><small>WordPress administra la información</small></li>
                <li><span>02</span><strong>Entrega</strong><small>PHP y SSR muestran lo esencial</small></li>
                <li><span>03</span><strong>Interacción</strong><small>React mejora las herramientas</small></li>
                <li><span>04</span><strong>Continuidad</strong><small>Mantenimiento y validación técnica</small></li>
            </ol>
        </div>
    </section>

    <section id="servicios" class="empc-section empc-services" aria-labelledby="empc-services-title">
        <div class="empc-shell">
            <header class="empc-section-head" data-empc-reveal>
                <div>
                    <p class="empc-kicker">02 / Soluciones</p>
                    <h2 id="empc-services-title" class="empc-heading">Servicios web con una función concreta.</h2>
                </div>
                <p>Diseño, comercio electrónico, mantenimiento y criterio técnico para construir o mejorar una presencia digital sin añadir complejidad innecesaria.</p>
            </header>

            <div class="empc-services__grid">
                <article class="empc-service empc-service--feature" data-empc-reveal>
                    <span class="empc-service__number">01</span>
                    <div class="empc-service__copy">
                        <p class="empc-service__label">Solución principal</p>
                        <h3>Diseño y desarrollo WordPress</h3>
                        <p>Páginas de servicio, webs corporativas y proyectos con una estructura clara, editable y preparada para mantenerse.</p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/diseno-web-leon/')); ?>" class="empc-service__link">
                        Ver diseño web <span aria-hidden="true">↗</span>
                    </a>
                </article>

                <article class="empc-service empc-service--commerce" data-empc-reveal>
                    <span class="empc-service__number">02</span>
                    <div class="empc-service__copy">
                        <p class="empc-service__label">Venta online</p>
                        <h3>Tiendas WooCommerce</h3>
                        <p>Catálogo, carrito y proceso de compra definidos según el alcance real del proyecto.</p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/tiendas-online-leon/')); ?>" class="empc-service__link">Ver tiendas online <span aria-hidden="true">↗</span></a>
                </article>

                <article class="empc-service empc-service--coral" data-empc-reveal>
                    <span class="empc-service__number">03</span>
                    <div class="empc-service__copy">
                        <p class="empc-service__label">Continuidad</p>
                        <h3>Mantenimiento WordPress</h3>
                        <p>Actualizaciones, copias y soporte técnico para webs que ya están publicadas.</p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/mantenimiento-wordpress-leon/')); ?>" class="empc-service__link">Ver mantenimiento <span aria-hidden="true">↗</span></a>
                </article>

                <article class="empc-service" data-empc-reveal>
                    <span class="empc-service__number">04</span>
                    <div class="empc-service__copy">
                        <p class="empc-service__label">Decisión técnica</p>
                        <h3>Consultoría WordPress</h3>
                        <p>Diagnóstico y orientación para ordenar decisiones antes de ejecutar cambios.</p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/consultor-wordpress/')); ?>" class="empc-service__link">Ver consultoría <span aria-hidden="true">↗</span></a>
                </article>

                <article class="empc-service" data-empc-reveal>
                    <span class="empc-service__number">05</span>
                    <div class="empc-service__copy">
                        <p class="empc-service__label">Rendimiento</p>
                        <h3>Optimización WPO</h3>
                        <p>Revisión de carga, recursos y configuración para definir mejoras con alcance concreto.</p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/optimizacion-de-velocidad-wordpress-freelance/')); ?>" class="empc-service__link">Ver optimización <span aria-hidden="true">↗</span></a>
                </article>

                <article class="empc-service empc-service--compact" data-empc-reveal>
                    <span class="empc-service__number">06</span>
                    <div class="empc-service__copy">
                        <p class="empc-service__label">Visibilidad local</p>
                        <h3>SEO local en León</h3>
                        <p>Revisión inicial de la web y de las prioridades locales antes de definir una intervención.</p>
                    </div>
                    <a href="<?php echo esc_url(home_url('/seo-local-leon/')); ?>" class="empc-service__link">Ver SEO local <span aria-hidden="true">↗</span></a>
                </article>
            </div>

            <div class="empc-section-action" data-empc-reveal>
                <p>¿Necesitas una web nueva o revisar la que ya tienes?</p>
                <a class="empc-button empc-button--primary" href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=diseno-web')); ?>">Solicitar una valoración <span aria-hidden="true">↗</span></a>
            </div>
        </div>
    </section>

    <section id="demos" class="empc-section empc-lab" aria-labelledby="empc-lab-title">
        <div class="empc-shell">
            <header class="empc-lab__intro" data-empc-reveal>
                <p class="empc-kicker">03 / Laboratorio</p>
                <h2 id="empc-lab-title" class="empc-heading">Herramientas para entender el alcance antes de solicitar un presupuesto.</h2>
                <p>La información principal está en HTML. Cuando JavaScript está disponible, las calculadoras permiten explorar opciones sin bloquear el contenido comercial.</p>
            </header>

            <div class="empc-lab__stack">
                <section class="empc-lab-card" aria-labelledby="budget-calculator-heading" data-empc-reveal>
                    <header class="empc-lab-card__head">
                        <div><p class="empc-kicker">LAB / 01</p><h3 id="budget-calculator-heading">Define un alcance inicial</h3></div>
                        <span>Configurador por pasos</span>
                    </header>
                    <p class="empc-lab-card__intro">Selecciona el tipo de proyecto y las funcionalidades que necesitas. La estimación sigue siendo orientativa hasta revisar el alcance.</p>
                    <div id="island-budget-calculator" class="empc-lab__island empc-lab__island--budget">
                        <div class="empc-fallback" data-empc-fallback="budget-calculator">
                            <div><p class="empc-fallback__label">Disponible sin JavaScript</p><h4>Referencias iniciales de proyecto</h4><p>La calculadora interactiva permite ajustar estas referencias cuando React carga.</p></div>
                            <ul>
                                <li><strong>Landing o web de una página</strong><span><?php echo esc_html(empc_price_label($empc_home_prices['landing'])); ?></span></li>
                                <li><strong>Web corporativa básica</strong><span><?php echo esc_html(empc_price_label($empc_home_prices['basic'])); ?></span></li>
                                <li><strong>Web corporativa profesional</strong><span><?php echo esc_html(empc_price_label($empc_home_prices['professional'])); ?></span></li>
                                <li><strong>Tienda WooCommerce inicial</strong><span><?php echo esc_html(empc_price_label($empc_home_prices['woo_initial'])); ?></span></li>
                                <li><strong>Tienda avanzada</strong><span><?php echo esc_html(empc_price_label($empc_home_prices['woo_advanced'])); ?></span></li>
                                <li><strong>Proyecto personalizado</strong><span>Presupuesto a medida</span></li>
                            </ul>
                            <p class="empc-note">Referencias orientativas. El presupuesto final depende del alcance acordado.</p>
                        </div>
                    </div>
                </section>

                <section class="empc-lab-card" aria-labelledby="pricing-calculator-heading" data-empc-reveal>
                    <header class="empc-lab-card__head">
                        <div><p class="empc-kicker">LAB / 02</p><h3 id="pricing-calculator-heading">Compara inversión y servicios recurrentes</h3></div>
                        <span>Calculadora en tiempo real</span>
                    </header>
                    <p class="empc-lab-card__intro">La inversión inicial y las cuotas mensuales se presentan por separado para no mezclar pagos de naturaleza distinta.</p>
                    <div id="island-pricing-calculator" class="empc-lab__island empc-lab__island--pricing">
                        <div class="empc-fallback" data-empc-fallback="pricing-calculator">
                            <div><p class="empc-fallback__label">Disponible sin JavaScript</p><h4>Servicios técnicos y recurrentes</h4><p>Estas referencias proceden de la matriz comercial vigente.</p></div>
                            <ul>
                                <li><strong>Auditoría y optimización WPO</strong><span><?php echo esc_html(empc_price_label($empc_home_prices['wpo'])); ?></span></li>
                                <li><strong>Mantenimiento WordPress</strong><span><?php echo esc_html(empc_price_label($empc_home_prices['maintenance'], 'desde', 'mes')); ?></span></li>
                                <li><strong>Consultoría WordPress</strong><span><?php echo esc_html(empc_price_label($empc_home_prices['consulting'], '', 'hora')); ?></span></li>
                            </ul>
                            <a class="empc-text-link" href="<?php echo esc_url(home_url('/contacta-conmigo/')); ?>">Solicitar una valoración <span aria-hidden="true">↗</span></a>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </section>

    <section id="metodo" class="empc-section empc-method" aria-labelledby="empc-method-title">
        <div class="empc-shell">
            <header class="empc-section-head" data-empc-reveal>
                <div><p class="empc-kicker">04 / Método</p><h2 id="empc-method-title" class="empc-heading">Decisiones visibles, cambios controlados.</h2></div>
                <p>El trabajo avanza por fases para separar el diagnóstico, la propuesta y la implementación.</p>
            </header>

            <ol class="empc-method__list">
                <li data-empc-reveal><span>01</span><div><h3>Auditoría</h3><p>Reviso el estado técnico, el contenido, las necesidades y las restricciones antes de intervenir.</p></div></li>
                <li data-empc-reveal><span>02</span><div><h3>Arquitectura</h3><p>Ordeno jerarquías, componentes, datos y rutas para que cada pieza tenga una función clara.</p></div></li>
                <li data-empc-reveal><span>03</span><div><h3>Implementación</h3><p>Aplico el alcance autorizado de forma controlada, reversible y sin mezclar tareas distintas.</p></div></li>
                <li data-empc-reveal><span>04</span><div><h3>Validación</h3><p>Compruebo funcionamiento, accesibilidad, rendimiento, SEO y posibles regresiones.</p></div></li>
            </ol>
        </div>
    </section>

    <section id="inversion" class="empc-section empc-investment" aria-labelledby="empc-investment-title">
        <div class="empc-shell">
            <header class="empc-section-head" data-empc-reveal>
                <div><p class="empc-kicker">05 / Inversión</p><h2 id="empc-investment-title" class="empc-heading">Referencias para orientar la primera decisión.</h2></div>
                <p>Son importes de partida confirmados. El presupuesto final depende del alcance acordado y no mezcla inversión inicial con servicios recurrentes.</p>
            </header>

            <div class="empc-investment__grid">
                <article class="empc-price-group empc-price-group--primary" data-empc-reveal>
                    <header><p class="empc-kicker">Proyecto inicial</p><h3>Diseño y desarrollo</h3></header>
                    <dl>
                        <div><dt>Landing o web de una página</dt><dd><?php echo esc_html(empc_price_label($empc_home_prices['landing'])); ?></dd></div>
                        <div><dt>Web corporativa básica</dt><dd><?php echo esc_html(empc_price_label($empc_home_prices['basic'])); ?></dd></div>
                        <div><dt>Web corporativa profesional</dt><dd><?php echo esc_html(empc_price_label($empc_home_prices['professional'])); ?></dd></div>
                        <div><dt>Tienda WooCommerce inicial</dt><dd><?php echo esc_html(empc_price_label($empc_home_prices['woo_initial'])); ?></dd></div>
                    </dl>
                    <a class="empc-text-link" href="<?php echo esc_url(home_url('/diseno-web-leon/')); ?>">Ver opciones de diseño web <span aria-hidden="true">↗</span></a>
                </article>

                <article class="empc-price-group" data-empc-reveal>
                    <header><p class="empc-kicker">Servicios técnicos</p><h3>Mejora y continuidad</h3></header>
                    <dl>
                        <div><dt>Auditoría y optimización WPO</dt><dd><?php echo esc_html(empc_price_label($empc_home_prices['wpo'])); ?></dd></div>
                        <div><dt>Mantenimiento WordPress</dt><dd><?php echo esc_html(empc_price_label($empc_home_prices['maintenance'], 'desde', 'mes')); ?></dd></div>
                    </dl>
                    <a class="empc-text-link" href="<?php echo esc_url(home_url('/mantenimiento-wordpress-leon/')); ?>">Ver mantenimiento WordPress <span aria-hidden="true">↗</span></a>
                </article>
            </div>

            <div class="empc-section-action" data-empc-reveal>
                <p>¿Necesitas concretar el alcance de un proyecto?</p>
                <a class="empc-button empc-button--primary" href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=diseno-web')); ?>">Pedir una valoración <span aria-hidden="true">↗</span></a>
            </div>
        </div>
    </section>

    <section id="sobre-emma" class="empc-section empc-about" aria-labelledby="empc-about-title">
        <div class="empc-shell empc-about__grid">
            <div data-empc-reveal>
                <p class="empc-kicker">06 / Sobre Emma</p>
                <p class="empc-about__display" aria-hidden="true">EMMA</p>
                <h2 id="empc-about-title" class="empc-heading">Trato directo y criterio técnico desde León.</h2>
            </div>
            <div class="empc-about__content" data-empc-reveal>
                <p class="empc-lead">Soy freelance WordPress en León y trabajo también de forma remota con proyectos de toda España.</p>
                <p>Combino desarrollo, mantenimiento y consultoría para convertir necesidades concretas en una estructura web comprensible. Primero reviso el punto de partida; después propongo un alcance y valido cada cambio.</p>
                <dl>
                    <div><dt>Relación</dt><dd>Trato directo</dd></div>
                    <div><dt>Base</dt><dd>WordPress mantenible</dd></div>
                    <div><dt>Interacción</dt><dd>React cuando aporta valor</dd></div>
                    <div><dt>Ámbito</dt><dd>León · Remoto en España</dd></div>
                </dl>
                <a class="empc-text-link" href="<?php echo esc_url(home_url('/contacta-conmigo/?tipo=consultoria-wordpress')); ?>">Consultar una decisión técnica <span aria-hidden="true">↗</span></a>
            </div>
        </div>
    </section>

    <section id="faq" class="empc-section empc-faq" aria-labelledby="empc-faq-title">
        <div class="empc-shell empc-faq__grid">
            <header data-empc-reveal>
                <p class="empc-kicker">07 / Preguntas frecuentes</p>
                <h2 id="empc-faq-title" class="empc-heading">Antes de empezar.</h2>
                <p>Información directa sobre alcance, tecnología y forma de trabajo.</p>
            </header>

            <div class="empc-faq__items" data-empc-reveal>
                <details><summary><span>01</span>¿Trabajas únicamente con empresas de León?</summary><div><p>No. EMPC tiene su base en León y presta servicio remoto a proyectos de toda España.</p></div></details>
                <details><summary><span>02</span>¿Qué tipo de proyectos WordPress realizas?</summary><div><p>Diseño y desarrollo web, WooCommerce, mantenimiento, consultoría y optimización técnica, siempre con un alcance definido.</p></div></details>
                <details><summary><span>03</span>¿Por qué combinar WordPress, PHP y React?</summary><div><p>WordPress facilita la gestión del contenido, PHP entrega lo esencial desde el servidor y React se utiliza para interacciones concretas como las calculadoras.</p></div></details>
                <details><summary><span>04</span>¿La portada funciona sin JavaScript?</summary><div><p>Sí. El contenido comercial, los servicios, los precios de referencia y las alternativas de contacto se entregan en HTML. JavaScript mejora las herramientas interactivas.</p></div></details>
                <details><summary><span>05</span>¿Los precios mostrados son presupuestos cerrados?</summary><div><p>No. Son referencias de inversión. El presupuesto final depende del alcance acordado para cada proyecto.</p></div></details>
                <details><summary><span>06</span>¿Puedes mantener u optimizar una web existente?</summary><div><p>Sí. El mantenimiento y la optimización parten de una revisión del estado actual para definir qué intervención tiene sentido.</p></div></details>
            </div>
        </div>
    </section>

    <section id="contacto" class="empc-section empc-contact" aria-labelledby="empc-contact-title">
        <div class="empc-shell">
            <div class="empc-contact__frame" data-empc-reveal>
                <div class="empc-contact__intro">
                    <p class="empc-kicker">08 / Siguiente paso</p>
                    <h2 id="empc-contact-title" class="empc-heading">Hablemos de la siguiente decisión técnica de tu web.</h2>
                    <p>Cuéntame qué necesitas construir, mantener u optimizar. Revisaremos el punto de partida antes de definir el alcance.</p>
                    <div class="empc-contact__meta"><span>León</span><span>Servicio remoto en España</span><span>Trato directo</span></div>
                </div>

                <div id="island-contact-form" class="empc-contact__island">
                    <div class="empc-fallback empc-fallback--contact" data-empc-fallback="contact-form">
                        <p class="empc-fallback__label">Contacto disponible sin JavaScript</p>
                        <h3>Cuéntame qué necesitas</h3>
                        <p>Puedes utilizar la página de contacto si el formulario interactivo no está disponible.</p>
                        <a class="empc-button empc-button--primary" href="<?php echo esc_url(home_url('/contacta-conmigo/')); ?>">Contactar con Emma <span aria-hidden="true">↗</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<script>
(function () {
    var root = document.querySelector('.empc-home');
    if (!root || !('IntersectionObserver' in window) || window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    var items = Array.prototype.slice.call(root.querySelectorAll('[data-empc-reveal]'));
    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.08 });

    root.classList.add('is-reveal-ready');
    items.forEach(function (item) { observer.observe(item); });
}());
</script>

<?php get_footer(); ?>

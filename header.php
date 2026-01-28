<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <!-- Preconnect para Google Fonts - Reduce latencia 780ms -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Crisp Chat - Lazy Load (no impacta LCP) -->
    <script type="text/javascript">
        // Configuración de Crisp (esto no pesa nada)
        window.$crisp = [];
        window.CRISP_WEBSITE_ID = "9f6b4900-955e-42d8-8aea-ed27760db271";

        // Función para cargar el chat solo tras interacción o 5 segundos
        function loadCrisp() {
            if (window.crispLoaded) return;
            window.crispLoaded = true;
            (function () {
                d = document;
                s = d.createElement("script");
                s.src = "https://client.crisp.chat/l.js";
                s.async = 1;
                d.getElementsByTagName("head")[0].appendChild(s);
            })();
        }

        // Disparadores de carga: scroll, movimiento de ratón o espera de 5s
        window.addEventListener('scroll', loadCrisp, { once: true });
        window.addEventListener('mousemove', loadCrisp, { once: true });
        window.addEventListener('touchstart', loadCrisp, { once: true });
        setTimeout(loadCrisp, 5000);
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-slate-deep text-slate-50 font-sans selection:bg-dusty-rose selection:text-slate-deep'); ?>>
    <?php wp_body_open(); ?>

    <!-- Navigation (Soberana V3) -->
    <nav id="main-nav"
        class="sticky top-0 z-50 w-full transition-all duration-300 backdrop-blur-xl border-b border-white/5 bg-[#121826]/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo optimizado WebP -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="<?php echo home_url(); ?>">
                        <picture>
                            <source
                                srcset="<?php echo get_template_directory_uri(); ?>/react-app/assets/logo-transparent.webp"
                                type="image/webp">
                            <img src="<?php echo get_template_directory_uri(); ?>/react-app/assets/logo-transparent.png"
                                alt="EMPC.es" class="h-10 w-auto hover:rotate-2 transition-transform duration-300"
                                width="305" height="84" fetchpriority="high">
                        </picture>
                    </a>
                </div>

                <!-- Desktop Menu (Soberana V3) -->
                <div class="hidden md:flex gap-8 text-[11px] font-bold uppercase tracking-[0.2em] items-center">
                    <?php
                    // Clases V3
                    $link_base = "hover:text-dusty-rose transition-colors";
                    $link_active = "text-dusty-rose border-b-2 border-dusty-rose pb-1";
                    ?>
                    
                    <a href="<?php echo home_url('/#metodo'); ?>" class="<?php echo $link_base; ?>">Ingeniería</a>

                    <!-- Servicios Dropdown (Simplificado para V3) -->
                    <div class="relative group">
                        <button class="<?php echo $link_base; ?> flex items-center gap-1 focus:outline-none">
                            Servicios
                        </button>
                        <div class="absolute left-1/2 -translate-x-1/2 top-full mt-4 w-56 bg-[#121826]/95 backdrop-blur-xl border border-white/10 rounded-xl p-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 shadow-2xl">
                            <a href="<?php echo home_url('/diseno-web-leon'); ?>" class="block px-4 py-3 hover:bg-white/5 rounded-lg text-slate-300 hover:text-dusty-rose text-[10px] tracking-widest uppercase mb-1">
                                Diseño Web
                            </a>
                            <a href="<?php echo home_url('/tiendas-online-leon'); ?>" class="block px-4 py-3 hover:bg-white/5 rounded-lg text-slate-300 hover:text-dusty-rose text-[10px] tracking-widest uppercase mb-1">
                                Tiendas Online
                            </a>
                            <a href="<?php echo home_url('/seo-local-leon'); ?>" class="block px-4 py-3 hover:bg-white/5 rounded-lg text-slate-300 hover:text-dusty-rose text-[10px] tracking-widest uppercase">
                                SEO Local
                            </a>
                        </div>
                    </div>

                    <a href="<?php echo home_url('/blog'); ?>" class="<?php echo $link_base; ?>">Blog</a>
                    <a href="<?php echo home_url('/#demos'); ?>" class="<?php echo $link_base; ?>">Demos</a>
                    
                    <a href="<?php echo home_url('/#contacto'); ?>"
                        class="px-6 py-2 border border-dusty-rose text-dusty-rose rounded-lg hover:bg-dusty-rose hover:text-[#121826] transition-all">
                        Consultoría
                    </a>
                </div>

                <!-- Mobile Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-white p-2 hover:text-dusty-rose transition-colors"
                        aria-label="Abrir menú de navegación">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-menu">
                            <line x1="4" x2="20" y1="12" y2="12" />
                            <line x1="4" x2="20" y1="6" y2="6" />
                            <line x1="4" x2="20" y1="18" y2="18" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div id="mobile-menu"
        class="fixed inset-0 z-40 bg-slate-900 pt-24 px-6 md:hidden hidden opacity-0 transition-opacity duration-300 overflow-y-auto">
        <div class="flex flex-col space-y-6 text-center pb-10">
            <a href="<?php echo home_url('/#metodo'); ?>"
                class="mobile-link text-2xl font-medium text-slate-200">Método</a>

            <!-- Mobile Services Section -->
            <div class="space-y-4 border-y border-slate-800 py-6">
                <span class="text-xs uppercase tracking-widest text-slate-500 font-bold">Servicios</span>
                <a href="<?php echo home_url('/diseno-web-leon'); ?>"
                    class="mobile-link block text-xl font-medium text-white">
                    Diseño Web
                </a>
                <a href="<?php echo home_url('/tiendas-online-leon'); ?>"
                    class="mobile-link block text-xl font-medium text-white">
                    Tiendas Online
                </a>
                <a href="<?php echo home_url('/seo-local-leon'); ?>"
                    class="mobile-link block text-xl font-medium text-white">
                    SEO Local
                </a>
            </div>

            <?php
            $mobile_blog_class = $is_blog
                ? "mobile-link text-2xl font-medium text-white"
                : "mobile-link text-2xl font-medium text-slate-200";
            ?>
            <a href="<?php echo home_url('/blog'); ?>" class="<?php echo $mobile_blog_class; ?>">Blog</a>
            <a href="<?php echo home_url('/#demos'); ?>"
                class="mobile-link text-2xl font-medium text-slate-200">Demos</a>
            <a href="<?php echo home_url('/#contacto'); ?>"
                class="bg-rose-600 py-4 rounded-xl font-bold text-white text-xl shadow-lg shadow-rose-900/50 block">Contactar
                Ahora</a>
        </div>
    </div>

    <script>
        // Simple Vanilla JS for Navbar Logic
        document.addEventListener('DOMContentLoaded', () => {
            const nav = document.getElementById('main-nav');
            const mobileBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileLinks = document.querySelectorAll('.mobile-link');
            let isMenuOpen = false;

            // Scroll Effect
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    nav.classList.add('bg-slate-900/95', 'backdrop-blur-md', 'shadow-lg', 'border-b', 'border-white/5');
                    nav.classList.remove('bg-transparent');
                } else {
                    nav.classList.remove('bg-slate-900/95', 'backdrop-blur-md', 'shadow-lg', 'border-b', 'border-white/5');
                    nav.classList.add('bg-transparent');
                }
            });

            // Mobile Menu Toggle
            mobileBtn.addEventListener('click', () => {
                isMenuOpen = !isMenuOpen;
                if (isMenuOpen) {
                    mobileMenu.classList.remove('hidden');
                    // Small delay to allow display:block to apply before opacity transition
                    setTimeout(() => mobileMenu.classList.remove('opacity-0'), 10);
                    document.body.style.overflow = 'hidden';
                } else {
                    mobileMenu.classList.add('opacity-0');
                    setTimeout(() => mobileMenu.classList.add('hidden'), 300);
                    document.body.style.overflow = '';
                }
            });

            // Close menu on link click
            mobileLinks.forEach(link => {
                link.addEventListener('click', () => {
                    isMenuOpen = false;
                    mobileMenu.classList.add('opacity-0');
                    setTimeout(() => mobileMenu.classList.add('hidden'), 300);
                    document.body.style.overflow = '';
                });
            });

            // ScrollSpy for Active State (Desktop)
            // Enhanced to wait for React Hydration/Rendering
            const initScrollSpy = () => {
                const desktopLinks = document.querySelectorAll('#main-nav .hidden.md\\:flex a[href*="#"]');
                const activeClasses = ['text-white', 'border-b-2', 'border-rose-500', 'pb-1'];
                const inactiveClasses = ['text-slate-300', 'hover:text-white', 'transition-colors'];

                const setActive = (link, active) => {
                    if (link.classList.contains('bg-white')) return; // Ignore CTA button
                    if (active) {
                        link.classList.remove(...inactiveClasses);
                        link.classList.add(...activeClasses);
                    } else {
                        link.classList.remove(...activeClasses);
                        link.classList.add(...inactiveClasses);
                    }
                };

                const observerCallback = (entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const id = '#' + entry.target.id;
                            desktopLinks.forEach(link => {
                                try {
                                    const linkHash = new URL(link.href).hash;
                                    if (linkHash === id) {
                                        setActive(link, true);
                                    } else {
                                        setActive(link, false);
                                    }
                                } catch (e) { }
                            });
                        }
                    });
                };

                const observerOptions = {
                    threshold: 0.3,
                    rootMargin: "-20% 0px -50% 0px"
                };

                const observer = new IntersectionObserver(observerCallback, observerOptions);
                let targetsFound = 0;

                desktopLinks.forEach(link => {
                    try {
                        const hash = new URL(link.href).hash;
                        if (hash) {
                            const target = document.querySelector(hash);
                            if (target) {
                                observer.observe(target);
                                targetsFound++;
                            }
                        }
                    } catch (e) { }
                });

                return targetsFound > 0;
            };

            // Attempt to init immediately
            if (!initScrollSpy()) {
                // If not found (React rendering), wait for changes in #root
                const rootNode = document.getElementById('root');
                if (rootNode) {
                    const mutationObserver = new MutationObserver((mutations, obs) => {
                        if (initScrollSpy()) {
                            // Once we find targets, we can stop observing DOM changes to save performance
                            // checking if ALL targets are found would be better, but 'some' is a start
                            // For now, we'll keep observing if content loads progressively, or disconnect if confident.
                            // Let's disconnect after a successful hit to avoid infinite loops if structure changes.
                            obs.disconnect();
                        }
                    });
                    mutationObserver.observe(rootNode, { childList: true, subtree: true });
                }
            }
        });
    </script>
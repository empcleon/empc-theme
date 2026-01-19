<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-slate-900 text-slate-50 font-sans selection:bg-rose-500 selection:text-white'); ?>>
    <?php wp_body_open(); ?>

    <!-- Navigation (Ported from React) -->
    <nav id="main-nav" class="fixed w-full z-50 transition-all duration-300 bg-transparent">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="<?php echo home_url(); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/react-app/assets/logo-transparent.png"
                            alt="EMPC Logo" class="h-12 w-auto">
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a href="<?php echo home_url('/#metodo'); ?>"
                        class="text-slate-300 hover:text-white transition-colors text-sm font-medium">Nuestro Método</a>
                    <a href="<?php echo home_url('/#servicios'); ?>"
                        class="text-slate-300 hover:text-white transition-colors text-sm font-medium">Servicios</a>
                    <a href="<?php echo home_url('/blog'); ?>"
                        class="text-white font-medium text-sm border-b-2 border-rose-500 pb-1">Blog</a>
                    <a href="<?php echo home_url('/#demos'); ?>"
                        class="text-slate-300 hover:text-white transition-colors text-sm font-medium">Demos</a>
                    <a href="<?php echo home_url('/#consultor-ia'); ?>"
                        class="text-slate-300 hover:text-white transition-colors text-sm font-medium flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        Consultor IA
                    </a>
                    <a href="<?php echo home_url('/#contacto'); ?>"
                        class="bg-white text-slate-900 px-5 py-2.5 rounded-full font-bold text-sm hover:bg-slate-200 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                        Contactar
                    </a>
                </div>

                <!-- Mobile Button -->
                <div class="md:hidden">
                    <button id="mobile-menu-btn" class="text-white p-2">
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
        class="fixed inset-0 z-40 bg-slate-900 pt-24 px-6 md:hidden hidden opacity-0 transition-opacity duration-300">
        <div class="flex flex-col space-y-8 text-center">
            <a href="<?php echo home_url('/#metodo'); ?>"
                class="mobile-link text-2xl font-medium text-slate-200">Método</a>
            <a href="<?php echo home_url('/#servicios'); ?>"
                class="mobile-link text-2xl font-medium text-slate-200">Servicios</a>
            <a href="<?php echo home_url('/blog'); ?>" class="mobile-link text-2xl font-medium text-white">Blog</a>
            <a href="<?php echo home_url('/#demos'); ?>"
                class="mobile-link text-2xl font-medium text-slate-200">Demos</a>
            <a href="<?php echo home_url('/#contacto'); ?>"
                class="bg-rose-600 py-4 rounded-xl font-bold text-white text-xl shadow-lg shadow-rose-900/50">Contactar
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
        });
    </script>
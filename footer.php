<!-- Footer (Ported from React) -->
<footer class="bg-slate-950 py-16 border-t border-slate-900 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            <!-- Col 1: Branding -->
            <div>
                <div class="flex items-center mb-6">
                    <img src="<?php echo get_template_directory_uri(); ?>/react-app/assets/logo-transparent.png"
                        alt="EMPC Logo" class="h-10 w-auto">
                </div>
                <p class="text-slate-500 text-sm leading-relaxed">
                    Desarrollo web artesanal desde León. <br>
                    Combinamos código robusto con diseño estratégico para ayudar al comercio local a escalar.
                </p>
            </div>

            <!-- Col 2: Services -->
            <div>
                <h4 class="text-white font-bold mb-4">Servicios</h4>
                <ul class="space-y-2 text-sm text-slate-500">
                    <li><a href="<?php echo home_url('/#servicios'); ?>"
                            class="hover:text-rose-400 transition-colors">Desarrollo React</a></li>
                    <li><a href="<?php echo home_url('/#servicios'); ?>"
                            class="hover:text-rose-400 transition-colors">WordPress Avanzado</a></li>
                    <li><a href="<?php echo home_url('/#servicios'); ?>"
                            class="hover:text-rose-400 transition-colors">Auditoría WPO</a></li>
                    <li><a href="<?php echo home_url('/#servicios'); ?>"
                            class="hover:text-rose-400 transition-colors">Mantenimiento Técnico</a></li>
                </ul>
            </div>

            <!-- Col 3: Contact -->
            <div>
                <h4 class="text-white font-bold mb-4">Contacto</h4>
                <div class="flex gap-4 mb-6">
                    <a href="https://github.com/empcleon" target="_blank"
                        class="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-slate-400 hover:text-white hover:bg-rose-600 transition-all">
                        <!-- Github Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-github">
                            <path
                                d="M15 22v-4a4.8 18 0 0 0-1-3.5c3 6 3 9 3 14 3 19.8 1.6 19.8 1.6-9-2.26-15.5 0-15.5 1 0-1.6 0-3.5 .4-5 .8-3.4 3-1.6 6-1.6 7-2.6 15.5 0 15.5 2 15.5 1 0 1.6 0 3.5-.4 5-.8 3.4 3 1.6 6 1.6 7 2.6V20a2 2 0 0 1-2 2h-18a2 2 0 0 1-2-2z" />
                        </svg>
                    </a>
                    <a href="#"
                        class="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 transition-all">
                        <!-- Linkedin Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-linkedin">
                            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                            <rect width="4" height="12" x="2" y="9" />
                            <circle cx="4" cy="4" r="2" />
                        </svg>
                    </a>
                    <a href="mailto:empcleon@gmail.com"
                        class="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-slate-400 hover:text-white hover:bg-emerald-600 transition-all">
                        <!-- Mail Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="lucide lucide-mail">
                            <rect width="20" height="16" x="2" y="4" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                    </a>
                </div>
                <p class="text-slate-600 text-xs">
                    León, España. <br>
                    Disponible para proyectos remotos.
                </p>
            </div>
        </div>

        <div class="pt-8 border-t border-slate-900 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="text-slate-600 text-xs">
                &copy; <?php echo date('Y'); ?> EMPC Desarrollo Web. Todos los derechos reservados.
            </div>
            <div class="flex gap-6 text-xs text-slate-600">
                <a href="#" class="hover:text-slate-400">Aviso Legal</a>
                <a href="#" class="hover:text-slate-400">Privacidad</a>
                <a href="#" class="hover:text-slate-400">Cookies</a>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
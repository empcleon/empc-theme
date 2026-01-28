<!-- Footer Pro Max (Soberana V3) -->
<footer class="bg-slate-deep border-t border-white/5 pt-20 pb-10 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8 mb-12">
            <div>
                <!-- Logo Typography -->
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-2xl font-heading font-bold text-white tracking-tighter">EMPC<span
                            class="text-dusty-rose">.es</span></span>
                </div>
                <p class="text-sm text-slate-400 max-w-xs">
                    Tu socio tecnológico para la era de la autoridad digital.
                    <br>
                    <a href="mailto:info@empc.es"
                        class="text-dusty-rose hover:underline decoration-dusty-rose/30">info@empc.es</a>
                </p>
            </div>

            <nav class="grid grid-cols-2 gap-x-12 gap-y-4 text-[10px] font-bold uppercase tracking-[0.2em] font-sans">
                <div>
                    <p class="text-white mb-4 opacity-50">Legal</p>
                    <a href="<?php echo home_url('/aviso-legal'); ?>"
                        class="block hover:text-dusty-rose transition-colors text-slate-500 mb-2">Aviso Legal</a>
                    <a href="<?php echo home_url('/politica-privacidad'); ?>"
                        class="block hover:text-dusty-rose transition-colors text-slate-500">Privacidad</a>
                </div>
            </nav>
        </div>

        <div
            class="border-t border-white/5 pt-8 flex flex-col md:flex-row justify-between items-center opacity-40 hover:opacity-100 transition-opacity duration-300">
            <p class="text-[10px] font-mono tracking-widest uppercase text-slate-500">© <?php echo date('Y'); ?> Vibe
                Coding Edition.</p>
            <div class="flex gap-6 mt-6 md:mt-0">
                <div class="flex items-center gap-2">
                    <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span class="text-[10px] font-mono text-slate-400">Local_Dev_Env</span>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>
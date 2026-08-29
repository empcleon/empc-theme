<?php
/**
 * Servicio de mantenimiento, reparación y presupuesto de equipos informáticos.
 */
get_header();
?>
<main id="primary" class="site-main bg-[#121826] text-slate-300">
    <article class="max-w-6xl mx-auto px-6 py-20">
        <section class="max-w-4xl space-y-6 mb-16">
            <p class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E29595]/10 border border-[#E29595]/20 text-[#E29595] text-xs font-bold uppercase tracking-widest">León y alrededores</p>
            <h1 class="text-4xl md:text-6xl font-bold text-white">Mantenimiento y reparación de ordenadores en León</h1>
            <p class="text-xl leading-relaxed text-slate-300">¿Tu ordenador va lento, falla o es demasiado antiguo? Cuéntame qué ocurre y te prepararé un presupuesto antes de empezar. No se realiza ningún trabajo sin que conozcas el alcance y el coste.</p>
            <p class="text-lg leading-relaxed text-slate-400">Trabajo con ordenadores y portátiles de particulares, autónomos y pequeños negocios. Si el equipo no merece la pena, también te lo diré con claridad para que no gastes dinero en una reparación poco razonable.</p>
        </section>

        <section class="grid md:grid-cols-3 gap-6 mb-16">
            <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-6"><h2 class="text-xl font-bold text-white mb-3">Presupuesto antes de actuar</h2><p>Recibo la información, valoro el trabajo posible y te envío el presupuesto. Tú decides si lo aceptas.</p></div>
            <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-6"><h2 class="text-xl font-bold text-white mb-3">Equipos antiguos</h2><p>Te explico si compensa reparar, actualizar o sustituir el equipo, sin prometer arreglos imposibles.</p></div>
            <div class="rounded-2xl border border-white/10 bg-white/[0.03] p-6"><h2 class="text-xl font-bold text-white mb-3">Condiciones claras</h2><p>No empiezo una reparación sin presupuesto aceptado y pago acordado previamente.</p></div>
        </section>

        <section class="prose prose-invert prose-lg max-w-4xl mb-16">
            <h2>¿Qué tipo de ayuda puedes solicitar?</h2>
            <ul>
                <li>Puesta a punto y mantenimiento de ordenadores o portátiles.</li>
                <li>Problemas de lentitud, errores, actualizaciones o configuración.</li>
                <li>Revisión de equipos antiguos para decidir si merece la pena invertir.</li>
                <li>Instalación o sustitución de componentes cuando sea viable.</li>
                <li>Orientación para cambiar de equipo cuando la reparación no compense.</li>
            </ul>
            <h2>Cómo funciona</h2>
            <ol>
                <li>Rellenas el formulario con los datos y síntomas del equipo.</li>
                <li>Te respondo con las preguntas o la información que falte.</li>
                <li>Recibes un presupuesto previo y las condiciones del trabajo.</li>
                <li>Solo después de aceptarlo y acordar el pago comienza el servicio.</li>
            </ol>
            <h2>Preguntas habituales</h2>
            <h3>¿Reparáis cualquier ordenador?</h3>
            <p>No. Primero valoramos si el trabajo es viable y si tiene sentido económico. En equipos muy antiguos, de gama baja o con daños en gráfica, placa base o pantalla, puede ser más sensato sustituirlos.</p>
            <h3>¿Tengo que pagar una revisión antes de saber el precio?</h3>
            <p>No ofrecemos diagnósticos gratuitos ni comenzamos trabajos sin presupuesto. Envíanos la información del equipo y del problema; con esos datos valoraremos si podemos preparar un presupuesto previo. Si hace falta revisar físicamente el equipo para poder presupuestar, te informaremos antes de realizar cualquier actuación.</p>
            <h3>¿Puedo llevar un equipo para que lo reparéis sin presupuesto?</h3>
            <p>No. El presupuesto se acepta antes de empezar y el pago se acuerda por adelantado. Así sabes qué trabajo se va a realizar y cuánto va a costar antes de comprometerte.</p>
            <h3>¿Vendéis ordenadores usados?</h3>
            <p>Podemos estudiar equipos usados o reacondicionados cuando sean adecuados para tus necesidades. No se trata de venderte el equipo más barato: primero hay que saber para qué lo necesitas, qué programas utilizas y qué limitaciones puedes aceptar.</p>
            <h2>Un servicio pensado para evitar gastos innecesarios</h2>
            <p>La mejor solución no siempre es reparar. A veces una puesta a punto alarga la vida del equipo; otras veces una ampliación de memoria o almacenamiento resuelve el problema. Pero cuando la avería afecta a un componente caro o el equipo ya no ofrece un rendimiento razonable, te lo explicaremos antes de que gastes dinero.</p>
            <p>El objetivo es que tomes una decisión informada: reparar, actualizar, sustituir o no hacer nada por el momento. Si necesitas ayuda para un ordenador de casa, un portátil de trabajo o varios equipos de un pequeño negocio, describe el caso en el formulario y te responderemos con el siguiente paso posible.</p>
        </section>

        <section id="solicitar-presupuesto" class="rounded-3xl border border-white/10 bg-black/20 p-6 md:p-10">
            <div class="max-w-3xl mb-8"><h2 class="text-3xl font-bold text-white">Solicita un presupuesto</h2><p class="mt-3 text-slate-400">Cuantos más datos aportes, mejor podré valorar el trabajo. El presupuesto se prepara antes de comenzar y no se inicia ninguna reparación sin tu aceptación.</p></div>
            <div id="island-equipment-quote-form"></div>
        </section>
    </article>
</main>
<?php get_footer(); ?>

import React from 'react';

const phases = [
    {
        title: "01. Auditoría de ADN Digital",
        desc: "No instalamos plantillas. Analizamos tu competencia en León, los Core Web Vitals de tu web actual y la intención de búsqueda real de tus clientes.",
        tech: "Lighthouse / Search Console / Screaming Frog"
    },
    {
        title: "02. El Desacoplamiento (Headless)",
        desc: "Separamos el cerebro (WordPress) de la piel (React). Esto elimina el 90% del código basura que ralentiza las webs tradicionales.",
        tech: "WP REST API / GraphQL / React"
    },
    {
        title: "03. Hidratación de Islas",
        desc: "Inyectamos interactividad solo donde hace falta. Calculadoras, sistemas de reserva o mapas cargan de forma independiente sin frenar el resto del sitio.",
        tech: "Antigravity Island Architecture"
    },
    {
        title: "04. Optimización de Capa Cero",
        desc: "Comprimimos imágenes a WebP, minificamos cada línea de CSS y configuramos el despliegue para que tu web cargue en menos de 1 segundo.",
        tech: "Tailwind JIT / Edge Caching / Brotli"
    }
];

const MethodPage = () => {
    return (
        <div className="bg-slate-900 text-white min-h-screen font-sans">
            {/* Hero Section */}
            <section className="pt-32 pb-20 px-6 border-b border-slate-800">
                <div className="max-w-4xl mx-auto">
                    <span className="text-blue-400 font-mono text-sm tracking-widest uppercase mb-4 block">Ingeniería, no solo diseño</span>
                    <h1 className="text-5xl md:text-7xl font-black mb-8 leading-tight">
                        Nuestro Método <span className="text-slate-500">Antigravity.</span>
                    </h1>
                    <p className="text-xl text-slate-400 leading-relaxed max-w-2xl">
                        Hemos redefinido el desarrollo web en León. Combinamos la gestión sencilla de WordPress con la velocidad extrema de React.
                    </p>
                </div>
            </section>

            {/* Timeline Phases */}
            <section className="py-24 px-6">
                <div className="max-w-4xl mx-auto space-y-24">
                    {phases.map((phase, index) => (
                        <div key={index} className="relative pl-8 md:pl-0 border-l-2 border-slate-800 md:border-none">
                            <div className="md:flex md:items-start md:gap-12">
                                <div className="hidden md:block text-slate-700 font-mono text-6xl font-bold opacity-50">
                                    {`0${index + 1}`}
                                </div>
                                <div className="space-y-4">
                                    <h3 className="text-2xl font-bold text-blue-400">{phase.title}</h3>
                                    <p className="text-lg text-slate-300 leading-relaxed italic">
                                        "{phase.desc}"
                                    </p>
                                    <div className="flex flex-wrap gap-2 pt-2">
                                        {phase.tech.split(' / ').map((t, i) => (
                                            <span key={i} className="bg-slate-800 text-slate-500 text-xs font-mono px-3 py-1 rounded-full border border-slate-700">
                                                {t}
                                            </span>
                                        ))}
                                    </div>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </section>

            {/* Tech Stack Visual */}
            <section className="py-20 bg-slate-800/50">
                <div className="max-w-4xl mx-auto px-6 text-center">
                    <h2 className="text-3xl font-bold mb-12">Nuestra Stack de Rendimiento</h2>
                    <div className="grid grid-cols-2 md:grid-cols-4 gap-8 opacity-60 grayscale hover:grayscale-0 transition duration-500">
                        <div className="p-4 bg-slate-900 rounded-2xl border border-slate-700">React</div>
                        <div className="p-4 bg-slate-900 rounded-2xl border border-slate-700">WordPress</div>
                        <div className="p-4 bg-slate-900 rounded-2xl border border-slate-700">Tailwind</div>
                        <div className="p-4 bg-slate-900 rounded-2xl border border-slate-700">Antigravity</div>
                    </div>
                </div>
            </section>

            {/* CTA Section */}
            <section className="py-20 px-6 border-t border-slate-800">
                <div className="max-w-4xl mx-auto text-center">
                    <h2 className="text-3xl font-bold mb-6">¿Preparado para la transformación?</h2>
                    <p className="text-slate-400 mb-8 max-w-2xl mx-auto">
                        Solicita una auditoría técnica gratuita y descubre el potencial real de tu proyecto digital en León.
                    </p>
                    <a
                        href="/contacto"
                        className="inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold px-8 py-4 rounded-lg transition duration-300"
                    >
                        Solicitar Auditoría Técnica
                    </a>
                </div>
            </section>
        </div>
    );
};

export default MethodPage;

import React from 'react';
import { Server, Database, Code, ArrowDown, Layers, Box } from 'lucide-react';

const ArchitectureDiagram: React.FC = () => {
  return (
    <div className="py-20 bg-slate-900 border-t border-slate-800">
      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 text-indigo-400 text-xs font-semibold uppercase mb-4">
            Estrategia de Implementación
          </div>
          <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
            Potencia React, <br/>
            <span className="text-slate-400">Hosting WordPress Estándar.</span>
          </h2>
          <p className="text-slate-400 max-w-2xl mx-auto">
            No necesitas servidores Node.js costosos. Nuestra arquitectura híbrida se integra en tu hosting actual (cPanel, SiteGround, etc.) manteniendo el SEO intacto.
          </p>
        </div>

        <div className="relative">
          {/* Connecting Line */}
          <div className="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-slate-700 to-transparent -translate-y-1/2 z-0" />

          <div className="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">
            
            {/* Step 1: Server */}
            <div className="bg-slate-800 p-8 rounded-2xl border border-slate-700 shadow-xl flex flex-col items-center text-center group hover:border-indigo-500/50 transition-colors">
              <div className="w-16 h-16 bg-slate-700 rounded-2xl flex items-center justify-center mb-6 relative">
                <Server className="w-8 h-8 text-blue-400" />
                <div className="absolute -bottom-2 -right-2 bg-blue-600 text-[10px] font-bold px-2 py-0.5 rounded text-white">PHP</div>
              </div>
              <h3 className="text-xl font-bold text-white mb-2">1. Hosting WordPress</h3>
              <p className="text-slate-400 text-sm">
                El servidor entrega el HTML base, maneja el SEO (Yoast) y la base de datos. Carga instantánea y barata.
              </p>
            </div>

            {/* Step 2: Integration */}
            <div className="bg-slate-800 p-8 rounded-2xl border border-slate-700 shadow-xl flex flex-col items-center text-center group hover:border-indigo-500/50 transition-colors">
              <div className="w-16 h-16 bg-slate-700 rounded-2xl flex items-center justify-center mb-6 relative">
                <Layers className="w-8 h-8 text-purple-400" />
                <div className="absolute -bottom-2 -right-2 bg-purple-600 text-[10px] font-bold px-2 py-0.5 rounded text-white">JSON</div>
              </div>
              <h3 className="text-xl font-bold text-white mb-2">2. El Puente (API REST)</h3>
              <p className="text-slate-400 text-sm">
                WordPress expone tus productos y posts vía API. React consume estos datos sin recargar la página.
              </p>
            </div>

            {/* Step 3: Client */}
            <div className="bg-slate-800 p-8 rounded-2xl border border-slate-700 shadow-xl flex flex-col items-center text-center group hover:border-indigo-500/50 transition-colors">
              <div className="w-16 h-16 bg-slate-700 rounded-2xl flex items-center justify-center mb-6 relative">
                <Box className="w-8 h-8 text-rose-400" />
                <div className="absolute -bottom-2 -right-2 bg-rose-500 text-[10px] font-bold px-2 py-0.5 rounded text-white">REACT</div>
              </div>
              <h3 className="text-xl font-bold text-white mb-2">3. Hidratación React</h3>
              <p className="text-slate-400 text-sm">
                Nuestros componentes (Reservas, Calculadoras) toman el control del navegador para una experiencia tipo App nativa.
              </p>
            </div>

          </div>
        </div>

        {/* Code Snippet Visual */}
        <div className="mt-16 bg-slate-950 rounded-xl overflow-hidden border border-slate-800 max-w-3xl mx-auto shadow-2xl">
          <div className="flex items-center gap-2 px-4 py-3 border-b border-slate-800 bg-slate-900/50">
            <div className="flex gap-1.5">
              <div className="w-3 h-3 rounded-full bg-red-500/20"></div>
              <div className="w-3 h-3 rounded-full bg-yellow-500/20"></div>
              <div className="w-3 h-3 rounded-full bg-green-500/20"></div>
            </div>
            <span className="text-xs text-slate-500 font-mono ml-2">page-template.php (WordPress Theme)</span>
          </div>
          <div className="p-6 font-mono text-xs md:text-sm overflow-x-auto">
            <div className="text-slate-500">{'<?php get_header(); ?>'}</div>
            <div className="mt-4">
              <span className="text-purple-400">&lt;div</span> <span className="text-blue-400">id</span>=<span className="text-green-400">"hero-react-app"</span>
              <span className="text-purple-400">&gt;</span>
            </div>
            <div className="pl-4 text-slate-600">
              {/* Fallback content for SEO */}
              {'<!-- Contenido estático para SEO si JS falla -->'} <br/>
              &lt;h1&gt;Desarrollo Web en León&lt;/h1&gt;
            </div>
            <div>
              <span className="text-purple-400">&lt;/div&gt;</span>
            </div>
            <div className="mt-4 text-slate-500">{'<?php get_footer(); ?>'}</div>
          </div>
        </div>

      </div>
    </div>
  );
};

export default ArchitectureDiagram;
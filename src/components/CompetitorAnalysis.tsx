import React from 'react';
import { Target, Shield, Zap, MapPin, XCircle, CheckCircle } from 'lucide-react';

const CompetitorAnalysis: React.FC = () => {
  return (
    <div className="py-20 bg-slate-800 border-t border-slate-700">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 text-cyan-400 text-xs font-semibold uppercase mb-4">
            Inteligencia de Mercado
          </div>
          <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
            Análisis de Competencia
          </h2>
          <p className="text-slate-400 max-w-2xl mx-auto">
            Hemos analizado a tus referentes (AgenciaSP, Villarin, ManitasWP...). Son excelentes en Mantenimiento y Formación, pero dejan libre el nicho de <strong>"Ingeniería Web a Medida"</strong>.
          </p>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
          {/* Chart / Quadrant Visualization */}
          <div className="bg-slate-900 p-8 rounded-3xl border border-slate-700 relative overflow-hidden">
            <h3 className="text-lg font-bold text-white mb-6 text-center">Posicionamiento Estratégico</h3>
            
            {/* Quadrant Graph */}
            <div className="relative aspect-square bg-slate-800/50 rounded-xl border border-slate-700 p-4">
              {/* Axes */}
              <div className="absolute top-0 bottom-0 left-1/2 w-px bg-slate-600/50"></div>
              <div className="absolute left-0 right-0 top-1/2 h-px bg-slate-600/50"></div>
              
              {/* Labels */}
              <div className="absolute top-2 left-1/2 -translate-x-1/2 text-[10px] text-slate-400 uppercase tracking-widest bg-slate-900 px-2">Alta Tecnología (React/App)</div>
              <div className="absolute bottom-2 left-1/2 -translate-x-1/2 text-[10px] text-slate-500 uppercase tracking-widest bg-slate-900 px-2">Web Estándar</div>
              <div className="absolute left-2 top-1/2 -translate-y-1/2 -rotate-90 text-[10px] text-slate-500 uppercase tracking-widest bg-slate-900 px-2">Remoto / Nacional</div>
              <div className="absolute right-2 top-1/2 -translate-y-1/2 rotate-90 text-[10px] text-slate-400 uppercase tracking-widest bg-slate-900 px-2">Local (León) / Cercano</div>

              {/* Competitors Dots */}
              <div className="absolute top-[70%] left-[30%] group">
                <div className="w-4 h-4 bg-slate-500 rounded-full border-2 border-slate-300"></div>
                <div className="absolute top-full left-1/2 -translate-x-1/2 mt-1 text-[10px] text-slate-400 whitespace-nowrap bg-slate-900 px-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">ManitasWP / AgenciaSP</div>
              </div>
              
              <div className="absolute top-[60%] left-[20%] group">
                <div className="w-4 h-4 bg-slate-500 rounded-full border-2 border-slate-300"></div>
                <div className="absolute top-full left-1/2 -translate-x-1/2 mt-1 text-[10px] text-slate-400 whitespace-nowrap bg-slate-900 px-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">Villarin / Borja</div>
              </div>

              {/* YOU */}
              <div className="absolute top-[15%] right-[15%] group animate-pulse">
                <div className="w-6 h-6 bg-rose-500 rounded-full border-4 border-rose-900 shadow-[0_0_20px_rgba(244,63,94,0.5)]"></div>
                <div className="absolute top-full left-1/2 -translate-x-1/2 mt-2 text-xs font-bold text-white whitespace-nowrap bg-rose-600 px-2 py-1 rounded shadow-lg">TÚ (EMPC)</div>
              </div>
            </div>
          </div>

          {/* Key Differentiators */}
          <div className="space-y-6">
             <div className="flex gap-4">
                <div className="flex-shrink-0 w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center border border-slate-700">
                  <Shield className="w-6 h-6 text-slate-400" />
                </div>
                <div>
                  <h4 className="text-lg font-bold text-white">Competencia: "Te mantengo la web"</h4>
                  <p className="text-slate-400 text-sm mt-1">
                    Se centran en actualizaciones, seguridad y soporte técnico básico. Es un servicio "commodity" (guerra de precios).
                  </p>
                </div>
             </div>

             <div className="flex gap-4">
                <div className="flex-shrink-0 w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center border border-slate-700">
                  <Zap className="w-6 h-6 text-rose-500" />
                </div>
                <div>
                  <h4 className="text-lg font-bold text-white">EMPC: "Te construyo herramientas"</h4>
                  <p className="text-slate-400 text-sm mt-1">
                    Tú ofreces desarrollo. Calculadoras de hipoteca para inmobiliarias, reservas visuales para peluquerías. <strong>Eso se vende más caro.</strong>
                  </p>
                </div>
             </div>

             <div className="flex gap-4">
                <div className="flex-shrink-0 w-12 h-12 rounded-xl bg-slate-800 flex items-center justify-center border border-slate-700">
                  <MapPin className="w-6 h-6 text-amber-500" />
                </div>
                <div>
                  <h4 className="text-lg font-bold text-white">Factor Local: León</h4>
                  <p className="text-slate-400 text-sm mt-1">
                    Tus competidores son entes digitales abstractos. Tú eres el ingeniero que puede ir a tomar un café a la Plaza Mayor con el cliente.
                  </p>
                </div>
             </div>
          </div>
        </div>

        {/* Feature Matrix */}
        <div className="bg-slate-900 rounded-2xl border border-slate-700 overflow-hidden">
          <div className="grid grid-cols-4 bg-slate-950 p-4 border-b border-slate-800 text-xs uppercase tracking-wider font-semibold text-slate-500">
            <div className="col-span-1">Servicio</div>
            <div className="col-span-1 text-center">Competencia</div>
            <div className="col-span-1 text-center text-white">EMPC (Tú)</div>
            <div className="col-span-1 text-center">Beneficio Cliente</div>
          </div>

          {[
            { name: "Tecnología", comp: "Plugins Estándar", you: "React a Medida", benefit: "Web más rápida y única" },
            { name: "Enfoque", comp: "Mantenimiento", you: "Conversión / Ventas", benefit: "Retorno de Inversión" },
            { name: "Complejidad", comp: "Webs Informativas", you: "Web Apps / Dashboards", benefit: "Automatización de procesos" },
            { name: "Contacto", comp: "Ticket / Email", you: "Directo / Presencial", benefit: "Confianza total" },
          ].map((row, idx) => (
             <div key={idx} className="grid grid-cols-4 p-4 border-b border-slate-800 last:border-0 hover:bg-slate-800/50 transition-colors">
               <div className="col-span-1 font-medium text-slate-300 flex items-center">{row.name}</div>
               <div className="col-span-1 flex items-center justify-center text-slate-500 gap-2">
                  <span className="text-sm">{row.comp}</span>
               </div>
               <div className="col-span-1 flex items-center justify-center text-rose-400 font-bold gap-2 bg-rose-500/5 rounded-lg border border-rose-500/20">
                  <CheckCircle className="w-4 h-4" />
                  <span className="text-sm">{row.you}</span>
               </div>
               <div className="col-span-1 text-center text-sm text-emerald-400 flex items-center justify-center">
                 {row.benefit}
               </div>
             </div>
          ))}
        </div>

      </div>
    </div>
  );
};

export default CompetitorAnalysis;
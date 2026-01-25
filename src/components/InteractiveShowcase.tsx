import React, { useState } from 'react';
import { Calculator, Calendar, Printer, RefreshCw } from 'lucide-react';

const InteractiveShowcase: React.FC = () => {
  const [activeTab, setActiveTab] = useState<'calculator' | 'booking'>('calculator');
  
  // Calculator Logic Demo
  const [items, setItems] = useState(50);
  const [urgency, setUrgency] = useState(1);
  const basePrice = 1.5;

  return (
    <section className="py-24 bg-slate-900 relative overflow-hidden">
      {/* Background decoration */}
      <div className="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-rose-500/5 to-transparent pointer-events-none" />

      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div className="flex flex-col md:flex-row md:items-center justify-between mb-16 gap-8">
          <div className="md:w-1/2">
            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-rose-500/10 text-rose-400 text-xs font-semibold tracking-wide uppercase mb-4">
              <span className="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></span>
              Diferenciación Técnica
            </div>
            <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
              No solo decimos que hacemos React. <br/>
              <span className="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-orange-400">
                Lo integramos en tu WordPress.
              </span>
            </h2>
            <p className="text-slate-300 text-lg leading-relaxed">
              El problema de muchas webs en León es que son estáticas. Nosotros inyectamos micro-aplicaciones React (calculadoras, reservadores, configuradores) dentro de tu WordPress para convertir visitantes en clientes.
            </p>
          </div>

          <div className="md:w-1/2 bg-slate-800 rounded-2xl p-1 border border-slate-700 shadow-2xl">
            {/* Mockup Browser Header */}
            <div className="flex items-center gap-2 px-4 py-3 border-b border-slate-700/50">
              <div className="flex gap-1.5">
                <div className="w-3 h-3 rounded-full bg-red-500/50"></div>
                <div className="w-3 h-3 rounded-full bg-yellow-500/50"></div>
                <div className="w-3 h-3 rounded-full bg-green-500/50"></div>
              </div>
              <div className="text-xs text-slate-500 font-mono ml-4">componente-react.tsx</div>
            </div>

            <div className="p-6">
              {/* Tab Switcher */}
              <div className="flex gap-4 mb-6 border-b border-slate-700">
                <button 
                  onClick={() => setActiveTab('calculator')}
                  className={`pb-2 text-sm font-medium transition-colors flex items-center gap-2 ${activeTab === 'calculator' ? 'text-rose-400 border-b-2 border-rose-400' : 'text-slate-500 hover:text-slate-300'}`}
                >
                  <Calculator className="w-4 h-4" /> Calc. Imprenta
                </button>
                <button 
                  onClick={() => setActiveTab('booking')}
                  className={`pb-2 text-sm font-medium transition-colors flex items-center gap-2 ${activeTab === 'booking' ? 'text-rose-400 border-b-2 border-rose-400' : 'text-slate-500 hover:text-slate-300'}`}
                >
                  <Calendar className="w-4 h-4" /> Reservas
                </button>
              </div>

              {/* Demo Content: Calculator */}
              {activeTab === 'calculator' && (
                <div className="space-y-6 animate-fadeIn">
                  <div className="space-y-2">
                    <label className="text-sm text-slate-300 flex justify-between">
                      <span>Cantidad de unidades</span>
                      <span className="font-mono text-rose-400">{items} uds.</span>
                    </label>
                    <input 
                      type="range" 
                      min="10" 
                      max="500" 
                      value={items} 
                      onChange={(e) => setItems(Number(e.target.value))}
                      className="w-full h-2 bg-slate-700 rounded-lg appearance-none cursor-pointer accent-rose-500"
                    />
                  </div>

                  <div className="space-y-2">
                    <label className="text-sm text-slate-300">Urgencia del pedido</label>
                    <div className="flex gap-2">
                      {[1, 1.2, 1.5].map((u, idx) => (
                        <button
                          key={u}
                          onClick={() => setUrgency(u)}
                          className={`flex-1 py-2 text-xs rounded-lg border transition-all ${urgency === u ? 'bg-rose-500/20 border-rose-500 text-white' : 'border-slate-600 text-slate-300 hover:border-slate-500'}`}
                        >
                          {idx === 0 ? 'Normal' : idx === 1 ? 'Rápido' : 'Urgente'}
                        </button>
                      ))}
                    </div>
                  </div>

                  <div className="bg-slate-900/50 p-4 rounded-xl flex items-center justify-between border border-slate-700">
                    <div className="flex items-center gap-3">
                      <Printer className="w-5 h-5 text-slate-300" />
                      <span className="text-sm text-slate-300">Presupuesto estimado</span>
                    </div>
                    <span className="text-2xl font-bold text-white">
                      {Math.round(items * basePrice * urgency)}€
                    </span>
                  </div>
                  <p className="text-xs text-slate-500 text-center">
                    *Este componente está hecho en React e insertado en tu web.
                  </p>
                </div>
              )}

              {/* Demo Content: Booking */}
              {activeTab === 'booking' && (
                <div className="flex flex-col items-center justify-center py-8 text-center animate-fadeIn">
                  <div className="w-12 h-12 rounded-full bg-slate-700 flex items-center justify-center mb-4">
                    <RefreshCw className="w-6 h-6 text-slate-300 animate-spin" />
                  </div>
                  <h4 className="text-white font-medium mb-2">Módulo de Reservas</h4>
                  <p className="text-sm text-slate-300 max-w-xs">
                    Imagina un calendario sincronizado en tiempo real, sin recargas de página. Ideal para clínicas, peluquerías o consultorías en León.
                  </p>
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default InteractiveShowcase;
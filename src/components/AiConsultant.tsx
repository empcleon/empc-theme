import React, { useState } from 'react';
import { consultBusinessStrategy } from '../services/gemini';
import { Bot, Sparkles, Loader2, Send } from 'lucide-react';

const AiConsultant: React.FC = () => {
  const [business, setBusiness] = useState('');
  const [loading, setLoading] = useState(false);
  const [result, setResult] = useState<{wordpressStrategy: string, reactFeature: string, localSeoTip: string} | null>(null);

  const handleConsult = async () => {
    if (!business.trim()) return;
    setLoading(true);
    setResult(null);
    try {
      const data = await consultBusinessStrategy(business, "Digitalizar negocio y aumentar ventas");
      setResult(data);
    } catch (e) {
      console.error(e);
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="bg-white text-slate-900 rounded-3xl overflow-hidden shadow-2xl flex flex-col md:flex-row h-auto min-h-[500px]">
      {/* Left: Input */}
      <div className="md:w-5/12 bg-slate-100 p-8 flex flex-col justify-center">
        <div className="mb-6">
          <div className="w-12 h-12 bg-rose-500 rounded-2xl flex items-center justify-center mb-4 shadow-lg shadow-rose-500/20">
            <Bot className="w-6 h-6 text-white" />
          </div>
          <h3 className="text-2xl font-bold text-slate-900 mb-2">Asistente Digital León</h3>
          <p className="text-slate-600">
            Dime qué tipo de negocio tienes y la IA generará una propuesta técnica preliminar de cómo combinamos WordPress y React para ti.
          </p>
        </div>

        <div className="space-y-4">
          <div>
            <label className="block text-xs font-semibold uppercase text-slate-500 mb-2">Tu tipo de negocio</label>
            <input
              type="text"
              value={business}
              onChange={(e) => setBusiness(e.target.value)}
              placeholder="Ej: Panadería artesana, Clínica dental..."
              className="w-full p-4 rounded-xl border-2 border-slate-200 focus:border-rose-500 focus:outline-none transition-colors bg-white font-medium"
              onKeyDown={(e) => e.key === 'Enter' && handleConsult()}
            />
          </div>
          <button
            onClick={handleConsult}
            disabled={loading || !business}
            className="w-full py-4 bg-rose-600 hover:bg-rose-700 disabled:opacity-50 disabled:cursor-not-allowed text-white rounded-xl font-bold flex items-center justify-center gap-2 transition-all shadow-lg shadow-rose-600/20"
          >
            {loading ? <Loader2 className="animate-spin w-5 h-5" /> : <Sparkles className="w-5 h-5" />}
            {loading ? 'Analizando...' : 'Generar Estrategia'}
          </button>
        </div>
      </div>

      {/* Right: Output */}
      <div className="md:w-7/12 p-8 md:p-12 bg-white relative">
        {!result && !loading && (
          <div className="h-full flex flex-col items-center justify-center text-center opacity-30">
            <Send className="w-16 h-16 mb-4 text-slate-400" />
            <p className="text-xl font-medium text-slate-400">Esperando tu consulta...</p>
          </div>
        )}

        {loading && (
          <div className="h-full flex flex-col items-center justify-center space-y-4">
            <div className="w-16 h-16 border-4 border-rose-100 border-t-rose-500 rounded-full animate-spin"></div>
            <p className="text-slate-500 animate-pulse">Consultando modelos de IA...</p>
          </div>
        )}

        {result && (
          <div className="space-y-8 animate-fadeIn">
            <div>
              <h4 className="text-xs font-bold text-rose-500 uppercase tracking-widest mb-2">Estrategia WordPress (Base)</h4>
              <p className="text-lg text-slate-700 font-medium leading-relaxed border-l-4 border-rose-200 pl-4">
                {result.wordpressStrategy}
              </p>
            </div>

            <div>
              <h4 className="text-xs font-bold text-indigo-500 uppercase tracking-widest mb-2">Módulo React (Diferenciación)</h4>
              <p className="text-lg text-slate-700 font-medium leading-relaxed border-l-4 border-indigo-200 pl-4">
                {result.reactFeature}
              </p>
            </div>

            <div className="bg-slate-50 p-6 rounded-xl border border-slate-100">
              <h4 className="text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Tip SEO Local (León)</h4>
              <p className="text-slate-600 italic">
                "{result.localSeoTip}"
              </p>
            </div>
            
            <div className="pt-6 border-t border-slate-100 flex justify-end">
               <button className="text-rose-600 font-bold hover:underline">Solicitar presupuesto de esto &rarr;</button>
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

export default AiConsultant;
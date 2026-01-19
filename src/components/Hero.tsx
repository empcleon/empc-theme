import React from 'react';
import { ArrowRight, Code2, MapPin } from 'lucide-react';

const Hero: React.FC = () => {
  return (
    <div className="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        
        {/* Badge */}
        <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-rose-500/30 bg-rose-500/10 text-rose-300 text-sm font-semibold mb-8 animate-fade-in-up">
          <MapPin className="w-3 h-3" />
          <span>Agencia de Desarrollo Local en León</span>
        </div>

        {/* Main Title */}
        <h1 className="text-5xl md:text-7xl font-bold tracking-tight mb-8 leading-tight text-white">
          Tu web necesita más que <br className="hidden md:block" />
          <span className="text-transparent bg-clip-text bg-gradient-to-r from-rose-400 via-orange-400 to-amber-400">
            un simple WordPress.
          </span>
        </h1>

        {/* Subtitle */}
        <p className="text-xl md:text-2xl text-slate-400 max-w-3xl mx-auto mb-10 font-light leading-relaxed">
          Creamos <strong>arquitecturas híbridas</strong>: la facilidad de gestión de WordPress combinada con la potencia de ventas de las aplicaciones <strong>React</strong>.
        </p>

        {/* CTAs */}
        <div className="flex flex-col sm:flex-row gap-4 justify-center items-center">
          <a href="#contacto" className="w-full sm:w-auto px-8 py-4 bg-white text-slate-900 rounded-full font-bold text-lg hover:bg-slate-100 transition-all flex items-center justify-center gap-2 group shadow-[0_0_20px_rgba(255,255,255,0.3)] hover:shadow-[0_0_30px_rgba(255,255,255,0.5)]">
            Solicitar Auditoría
            <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
          </a>
          <a href="#demos" className="w-full sm:w-auto px-8 py-4 bg-slate-800 text-white border border-slate-700 rounded-full font-bold text-lg hover:bg-slate-700 transition-all flex items-center gap-2">
            <Code2 className="w-5 h-5 text-slate-400" />
            Ver Demos Técnicas
          </a>
        </div>

        {/* Trust Indicators */}
        <div className="mt-12 flex items-center justify-center gap-8 text-slate-500 text-sm font-medium grayscale opacity-70">
          <span>React.js</span>
          <span>WordPress</span>
          <span>WooCommerce</span>
          <span>Vite</span>
          <span>Next.js</span>
        </div>
      </div>
      
      {/* Background Effects */}
      <div className="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] pointer-events-none"></div>
      <div className="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-rose-500/20 blur-[120px] rounded-full pointer-events-none"></div>
    </div>
  );
};

export default Hero;
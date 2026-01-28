import React from 'react';
import { Code2, Cpu, Shield, ArrowRight } from 'lucide-react';

const Services: React.FC = () => {


  return (
    <section className="py-24 bg-slate-900" id="servicios">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
            Servicios de Ingeniería Web
          </h2>
          <p className="text-slate-300 max-w-2xl mx-auto">
            No somos una agencia de marketing 360º. Somos desarrolladores especialistas en código.
            Hacemos que las cosas funcionen, rápido y bien.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-8">

          {/* Card 1: Desarrollo Híbrido (Grande) */}
          <div className="md:col-span-2 bg-[#1F2937]/30 border border-white/5 rounded-[3rem] p-12 hover:border-[#E29595]/40 transition-all relative overflow-hidden group">
            <div className="absolute top-0 right-0 p-10 opacity-5 group-hover:opacity-20 transition-opacity pointer-events-none">
              <Code2 size={150} className="text-[#E29595]" />
            </div>
            <h3 className="text-4xl font-serif text-white mb-6">Desarrollo Híbrido <br /><span className="text-[#E29595]">WP + React</span></h3>
            <p className="text-lg text-slate-400 max-w-md">Mantén el panel de WordPress que ya dominas, pero ofrece a tus clientes una experiencia de usuario ultra-rápida en React.</p>
          </div>

          {/* Card 2: Micro-Apps */}
          <div className="bg-[#E29595]/5 border border-[#E29595]/20 rounded-[3rem] p-10 flex flex-col justify-between hover:bg-[#E29595]/10 transition-all group">
            <Cpu className="text-[#E29595] mb-8" size={40} />
            <div>
              <h3 className="text-2xl font-serif text-white mb-4 italic">Micro-Apps a Medida</h3>
              <p className="text-sm text-slate-400 leading-relaxed italic">Calculadoras, configuradores y sistemas de cita previa desarrollados desde cero.</p>
            </div>
          </div>

          {/* Card 3: Auditoría WPO */}
          <div className="bg-[#1F2937]/30 border border-white/5 rounded-[3rem] p-10 flex items-center justify-between hover:border-[#E29595]/40 transition-all">
            <div>
              <h3 className="text-xl font-bold text-white mb-2">Auditoría WPO</h3>
              <p className="text-xs text-slate-500 uppercase tracking-widest">Optimización extrema</p>
            </div>
            <div className="w-16 h-16 rounded-full border-2 border-[#E29595] flex items-center justify-center text-[#E29595] font-black">99</div>
          </div>

          {/* Card 4: Seguridad */}
          <div className="bg-[#1F2937]/30 border border-white/5 rounded-[3rem] p-10 flex items-center justify-between hover:border-[#E29595]/40 transition-all">
            <Shield className="text-[#E29595]" size={32} />
            <div className="text-right">
              <h3 className="text-xl font-bold text-white mb-2">Seguridad Soberana</h3>
              <p className="text-xs text-slate-500 uppercase tracking-widest text-[#E29595]">Búnker activo</p>
            </div>
          </div>

          {/* Card 5: Link */}
          <div className="bg-[#1F2937]/30 border border-white/5 rounded-[3rem] p-10 flex items-center justify-between hover:border-[#E29595]/40 transition-all cursor-pointer group">
            <div className="p-4 bg-[#E29595]/10 rounded-2xl text-[#E29595] group-hover:scale-110 transition-transform">
              <ArrowRight />
            </div>
            <h3 className="text-xl font-serif italic text-white">Ver Laboratorio</h3>
          </div>

        </div>
      </div>
    </section>
  );
};

export default Services;
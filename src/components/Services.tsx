import React from 'react';
import { Rocket, MonitorSmartphone, Search, Database, Settings, ArrowRight } from 'lucide-react';

const Services: React.FC = () => {
  const services = [
    {
      icon: <MonitorSmartphone className="w-8 h-8 text-rose-400" />,
      title: "Desarrollo Híbrido",
      description: "Mantén tu panel de WordPress de siempre, pero con un frontend ultra-rápido en React. Tus clientes notarán la velocidad, tú no pierdes comodidad."
    },
    {
      icon: <Database className="w-8 h-8 text-orange-400" />,
      title: "Micro-Apps a Medida",
      description: "Calculadoras de presupuesto, configuradores de producto o sistemas de cita previa desarrollados a medida, sin plugins lentos."
    },
    {
      icon: <Search className="w-8 h-8 text-amber-400" />,
      title: "SEO Local León",
      description: "Optimizamos técnicamente tu web para que Google entienda que eres el mejor negocio de León. Estructura de datos y velocidad real."
    },
    {
      icon: <Rocket className="w-8 h-8 text-purple-400" />,
      title: "WPO (Optimización)",
      description: "Si tu web WordPress carga lenta, perdemos ventas. Auditamos y reescribimos código para pasar los Core Web Vitals de Google."
    }
  ];

  return (
    <section className="py-24 bg-slate-900" id="servicios">
      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="text-center mb-16">
          <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
            Servicios de Ingeniería Web
          </h2>
          <p className="text-slate-400 max-w-2xl mx-auto">
            No somos una agencia de marketing 360º. Somos desarrolladores especialistas en código. 
            Hacemos que las cosas funcionen, rápido y bien.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          {services.map((service, idx) => (
            <div key={idx} className="group p-8 rounded-2xl bg-slate-800 border border-slate-700 hover:border-rose-500/50 hover:bg-slate-800/80 transition-all duration-300 relative overflow-hidden">
              <div className="absolute top-0 right-0 p-4 opacity-0 group-hover:opacity-100 transition-opacity">
                <ArrowRight className="w-6 h-6 text-slate-500 -rotate-45" />
              </div>
              
              <div className="mb-6 p-4 bg-slate-900 rounded-xl inline-block border border-slate-800 shadow-lg group-hover:scale-110 transition-transform duration-300">
                {service.icon}
              </div>
              
              <h3 className="text-xl font-bold text-white mb-3 group-hover:text-rose-400 transition-colors">
                {service.title}
              </h3>
              <p className="text-slate-400 leading-relaxed">
                {service.description}
              </p>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
};

export default Services;
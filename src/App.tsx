import React, { useState, useEffect } from 'react';
import EmpcHeroProMax from './components/EmpcHeroProMax';
import Services from './components/Services';
import InteractiveShowcase from './components/InteractiveShowcase';
import ArchitectureDiagram from './components/ArchitectureDiagram';
import AiConsultant from './components/AiConsultant';
import ContactForm from './components/ContactForm';
import { Menu, X, Github, Linkedin, Mail } from 'lucide-react';
import logo from './assets/logo-transparent.png';

const App: React.FC = () => {
  const [scrolled, setScrolled] = useState(false);
  const [mobileMenuOpen, setMobileMenuOpen] = useState(false);

  useEffect(() => {
    const handleScroll = () => setScrolled(window.scrollY > 50);
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  }, []);

  return (
    <div className="min-h-screen bg-slate-deep text-slate-50 font-sans selection:bg-dusty-rose selection:text-slate-deep">

      {/* 1. Hero Section (Soberana V3) */}
      <EmpcHeroProMax />

      {/* 2. Architecture / Method Section */}
      <div id="metodo">
        <ArchitectureDiagram />
      </div>

      {/* 3. Services Section */}
      <Services />

      {/* 4. Interactive Demos */}
      <div id="demos">
        <InteractiveShowcase />
      </div>

      {/* 5. AI Lead Magnet */}
      <section id="consultor-ia" className="py-24 bg-slate-deep relative border-t border-white/5">
        <div className="absolute inset-0 bg-dusty-rose/5 pointer-events-none"></div>
        <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
          <div className="text-center mb-16">
            <h2 className="text-3xl md:text-5xl font-heading font-bold text-white mb-4">¿No sabes qué necesita tu negocio?</h2>
            <p className="text-slate-300 max-w-2xl mx-auto font-light">
              Usa nuestra IA entrenada para analizar tu sector en León y recibir una propuesta técnica gratuita al instante.
            </p>
          </div>
          <AiConsultant />
        </div>
      </section>

      {/* 6. Contact Section */}
      <section id="contacto" className="py-24 bg-slate-deep relative">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
          <div className="text-center mb-12">
            <h2 className="text-3xl md:text-5xl font-heading font-bold text-white mb-4">Hablemos de tu Proyecto</h2>
            <p className="text-slate-300 font-light">
              Cuéntanos qué necesitas y diseñaremos una arquitectura a medida.
            </p>
          </div>
          <ContactForm />
        </div>
      </section>
    </div>
  );
};

export default App;
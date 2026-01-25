import React, { useState, useEffect } from 'react';
import Hero from './components/Hero';
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
    <div className="min-h-screen bg-slate-900 text-slate-50 font-sans selection:bg-rose-500 selection:text-white">

      {/* 1. Hero Section */}
      <Hero />

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
      <section id="consultor-ia" className="py-24 bg-slate-900 relative border-t border-slate-800">
        <div className="absolute inset-0 bg-rose-500/5 pointer-events-none"></div>
        <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
          <div className="text-center mb-16">
            <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">¿No sabes qué necesita tu negocio?</h2>
            <p className="text-slate-300 max-w-2xl mx-auto">
              Usa nuestra IA entrenada para analizar tu sector en León y recibir una propuesta técnica gratuita al instante.
            </p>
          </div>
          <AiConsultant />
        </div>
      </section>

      {/* 6. Contact Section */}
      <section id="contacto" className="py-24 bg-slate-900 relative">
        <div className="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
          <div className="text-center mb-12">
            <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">Hablemos de tu Proyecto</h2>
            <p className="text-slate-300">
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
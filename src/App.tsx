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

      {/* Navigation */}
      <nav className={`fixed w-full z-50 transition-all duration-300 ${scrolled ? 'bg-slate-900/95 backdrop-blur-md shadow-lg border-b border-white/5' : 'bg-transparent'}`}>
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between h-20 items-center">
            {/* Logo */}
            {/* Logo */}
            <div className="flex-shrink-0 flex items-center">
              <img src={logo} alt="EMPC Logo" className="h-12 w-auto" />
            </div>

            {/* Desktop Menu */}
            <div className="hidden md:flex space-x-8 items-center">
              <a href="#metodo" className="text-slate-300 hover:text-white transition-colors text-sm font-medium">Nuestro Método</a>
              <a href="#servicios" className="text-slate-300 hover:text-white transition-colors text-sm font-medium">Servicios</a>
              <a href="#demos" className="text-slate-300 hover:text-white transition-colors text-sm font-medium">Demos</a>
              <a href="#consultor-ia" className="text-slate-300 hover:text-white transition-colors text-sm font-medium flex items-center gap-2">
                <span className="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                Consultor IA
              </a>
              <button className="bg-white text-slate-900 px-5 py-2.5 rounded-full font-bold text-sm hover:bg-slate-200 transition-colors shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                Contactar
              </button>
            </div>

            {/* Mobile Button */}
            <div className="md:hidden">
              <button onClick={() => setMobileMenuOpen(!mobileMenuOpen)} className="text-white p-2">
                {mobileMenuOpen ? <X /> : <Menu />}
              </button>
            </div>
          </div>
        </div>
      </nav>

      {/* Mobile Menu Overlay */}
      {mobileMenuOpen && (
        <div className="fixed inset-0 z-40 bg-slate-900 pt-24 px-6 md:hidden animate-fadeIn">
          <div className="flex flex-col space-y-8 text-center">
            <a href="#metodo" onClick={() => setMobileMenuOpen(false)} className="text-2xl font-medium text-slate-200">Método</a>
            <a href="#servicios" onClick={() => setMobileMenuOpen(false)} className="text-2xl font-medium text-slate-200">Servicios</a>
            <a href="#demos" onClick={() => setMobileMenuOpen(false)} className="text-2xl font-medium text-slate-200">Demos</a>
            <button className="bg-rose-600 py-4 rounded-xl font-bold text-white text-xl shadow-lg shadow-rose-900/50">Contactar Ahora</button>
          </div>
        </div>
      )}

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
            <p className="text-slate-400 max-w-2xl mx-auto">
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
            <p className="text-slate-400">
              Cuéntanos qué necesitas y diseñaremos una arquitectura a medida.
            </p>
          </div>
          <ContactForm />
        </div>
      </section>

      {/* Footer */}
      <footer className="bg-slate-950 py-16 border-t border-slate-900">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="grid grid-cols-1 md:grid-cols-3 gap-12 mb-12">
            <div>
              <div className="flex items-center mb-6">
                <img src={logo} alt="EMPC Logo" className="h-10 w-auto" />
              </div>
              <p className="text-slate-500 text-sm leading-relaxed">
                Desarrollo web artesanal desde León. <br />
                Combinamos código robusto con diseño estratégico para ayudar al comercio local a escalar.
              </p>
            </div>

            <div>
              <h4 className="text-white font-bold mb-4">Servicios</h4>
              <ul className="space-y-2 text-sm text-slate-500">
                <li><a href="#" className="hover:text-rose-400 transition-colors">Desarrollo React</a></li>
                <li><a href="#" className="hover:text-rose-400 transition-colors">WordPress Avanzado</a></li>
                <li><a href="#" className="hover:text-rose-400 transition-colors">Auditoría WPO</a></li>
                <li><a href="#" className="hover:text-rose-400 transition-colors">Mantenimiento Técnico</a></li>
              </ul>
            </div>

            <div>
              <h4 className="text-white font-bold mb-4">Contacto</h4>
              <div className="flex gap-4 mb-6">
                <a href="#" className="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-slate-400 hover:text-white hover:bg-rose-600 transition-all">
                  <Github className="w-5 h-5" />
                </a>
                <a href="#" className="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-slate-400 hover:text-white hover:bg-blue-600 transition-all">
                  <Linkedin className="w-5 h-5" />
                </a>
                <a href="#" className="w-10 h-10 bg-slate-900 rounded-full flex items-center justify-center text-slate-400 hover:text-white hover:bg-emerald-600 transition-all">
                  <Mail className="w-5 h-5" />
                </a>
              </div>
              <p className="text-slate-600 text-xs">
                León, España. <br />
                Disponible para proyectos remotos.
              </p>
            </div>
          </div>

          <div className="pt-8 border-t border-slate-900 flex flex-col md:flex-row justify-between items-center gap-4">
            <div className="text-slate-600 text-xs">
              © 2026 EMPC Desarrollo Web. Todos los derechos reservados.
            </div>
            <div className="flex gap-6 text-xs text-slate-600">
              <a href="#" className="hover:text-slate-400">Aviso Legal</a>
              <a href="#" className="hover:text-slate-400">Privacidad</a>
              <a href="#" className="hover:text-slate-400">Cookies</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  );
};

export default App;
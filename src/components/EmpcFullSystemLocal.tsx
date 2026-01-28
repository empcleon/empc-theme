import React from 'react';
import {
    Terminal,
    Code2,
    Cpu,
    ArrowUpRight,
    Database,
    Shield,
    Briefcase
} from 'lucide-react';

// === COMPONENTE DE NAVEGACIÓN ===
const NavBar = () => (
    <nav className="border-b border-white/5 px-8 py-6 flex justify-between items-center backdrop-blur-md sticky top-0 z-50 bg-[#121826]/90">
        <div className="flex items-center gap-3">
            <div className="w-8 h-8 bg-[#E29595] rounded-lg flex items-center justify-center text-[#121826]">
                <Terminal size={18} />
            </div>
            <span className="text-xl font-serif text-white tracking-tighter">EMPC<span className="text-[#E29595]">.es</span></span>
        </div>
        <div className="hidden md:flex gap-10 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-500">
            <a href="#home" className="text-white border-b border-[#E29595]">Inicio</a>
            <a href="#about" className="hover:text-[#E29595] transition-colors">La Arquitecta</a>
            <a href="#services" className="hover:text-[#E29595] transition-colors">Servicios Tech</a>
            <a href="#contact" className="hover:text-[#E29595] transition-colors">Contacto B2B</a>
        </div>
    </nav>
);

// === COMPONENTE HERO SECTION (HOME) ===
const HeroSection = () => (
    <header id="home" className="max-w-7xl mx-auto px-6 pt-24 pb-32 grid lg:grid-cols-2 gap-16 items-center">
        <div className="space-y-8 animate-fade-in-up">
            <div className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#E29595]/10 border border-[#E29595]/20 text-[#E29595]">
                <div className="w-1.5 h-1.5 rounded-full bg-[#E29595] animate-pulse"></div>
                <span className="text-[10px] font-bold uppercase tracking-widest">Ingeniería de Autoridad</span>
            </div>
            <h1 className="text-6xl md:text-8xl font-serif text-white leading-none">
                Tu Visión, <br />
                <span className="text-[#E29595] italic">Escalada</span>.
            </h1>
            <p className="text-xl text-slate-400 max-w-lg leading-relaxed font-light">
                Arquitectura de software y estrategia digital para negocios que no pueden permitirse deuda técnica. Vibe Coding aplicado al crecimiento B2B.
            </p>
            <div className="pt-4 flex gap-4">
                <button className="px-10 py-5 bg-[#E29595] text-[#121826] font-bold rounded-2xl hover:shadow-[0_0_30px_rgba(226,149,149,0.3)] hover:scale-105 transition-all duration-300 flex items-center gap-2">
                    Desplegar Proyecto <ArrowUpRight size={20} />
                </button>
            </div>
        </div>
        <div className="relative bg-[#1F2937]/50 border border-white/10 rounded-[2.5rem] p-8 backdrop-blur-2xl shadow-2xl h-[500px] flex items-center justify-center group hover:border-[#E29595]/30 transition-all duration-500">
            <div className="absolute inset-0 bg-gradient-to-tr from-[#E29595]/5 to-transparent rounded-[2.5rem] opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            <p className="text-slate-500 font-mono text-sm relative z-10">[Placeholder: Gráfico Interactivo de Stack Tecnológico Pro Max]</p>
        </div>
    </header>
);

// === COMPONENTE ABOUT SECTION (LA ARQUITECTA) ===
const AboutSection = () => (
    <section id="about" className="py-24 border-t border-white/5 relative overflow-hidden">
        <div className="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center relative z-10">
            <div className="aspect-[4/5] bg-[#1F2937]/50 rounded-[3rem] border border-white/10 overflow-hidden relative group">
                <div className="absolute inset-0 bg-[#E29595]/10 mix-blend-overlay opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                {/* Placeholder para tu foto profesional de 44cm de hombro */}
                <div className="w-full h-full bg-gradient-to-br from-[#121826] via-[#1F2937] to-[#E29595]/20 flex items-center justify-center">
                    <p className="text-slate-500 font-mono">[Placeholder: Foto Profesional CEO/CTO]</p>
                </div>
            </div>
            <div className="space-y-8">
                <h2 className="text-4xl font-serif text-white">Más que Código: <span className="text-[#E29595]">Estrategia</span></h2>
                <p className="text-slate-400 text-lg leading-relaxed">
                    Soy Emma, Arquitecta de Software y CEO. No vendo horas de programación, vendo **soluciones de negocio** basadas en tecnología robusta. Mi enfoque Vibe Coding combina la velocidad del prototipado con la solidez de la ingeniería empresarial.
                </p>
                <div className="grid grid-cols-2 gap-6">
                    <div className="p-6 bg-[#E29595]/10 border border-[#E29595]/20 rounded-3xl hover:bg-[#E29595]/20 transition-colors duration-300">
                        <Shield className="text-[#E29595] mb-4" size={24} />
                        <h3 className="text-white font-bold mb-2">CTO-as-a-Service</h3>
                        <p className="text-sm text-slate-400">Dirección técnica interina para scaling-ups.</p>
                    </div>
                    <div className="p-6 bg-[#1F2937]/50 border border-white/5 rounded-3xl hover:border-white/20 transition-colors duration-300">
                        <Cpu className="text-[#E29595] mb-4" size={24} />
                        <h3 className="text-white font-bold mb-2">Stack Moderno</h3>
                        <p className="text-sm text-slate-400">React, Node, Supabase, integrados en WordPress.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
);

// === COMPONENTE SERVICES SECTION (BENTO GRID) ===
const ServicesSection = () => (
    <section id="services" className="max-w-7xl mx-auto px-6 py-24 border-t border-white/5">
        <div className="mb-16">
            <h2 className="text-4xl font-serif text-white mb-4">Servicios de <span className="text-[#E29595]">Ingeniería</span></h2>
            <p className="max-w-2xl text-slate-400 italic">Arquitectura modular para el crecimiento digital.</p>
        </div>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
            {/* Servicio 1: Vibe Coding */}
            <div className="md:col-span-2 bg-[#1F2937]/30 border border-white/5 rounded-[2.5rem] p-10 hover:border-[#E29595]/30 transition-all duration-300 group relative overflow-hidden hover:shadow-2xl">
                <Code2 size={64} className="text-[#E29595]/20 absolute top-6 right-6 transition-transform duration-500 group-hover:scale-110 group-hover:rotate-12" />
                <div className="relative z-10">
                    <h3 className="text-3xl font-serif text-white mb-6">Desarrollo Full-Stack Vibe Coding</h3>
                    <p className="text-slate-400 max-w-md leading-relaxed">
                        Implementación de micro-aplicaciones en React que se integran nativamente en tu ecosistema de WordPress (Raiola). Velocidad de desarrollo y rendimiento de producción.
                    </p>
                </div>
            </div>

            {/* Servicio 2: Auditoría */}
            <div className="bg-[#E29595] rounded-[2.5rem] p-10 group cursor-pointer shadow-[0_20px_40px_-15px_rgba(226,149,149,0.3)] flex flex-col justify-between hover:scale-[1.02] transition-transform duration-300">
                <Database size={32} className="text-[#121826]" />
                <div>
                    <h3 className="text-2xl font-bold text-[#121826] leading-tight">Auditoría de Sistemas & WPO</h3>
                    <ArrowUpRight className="text-[#121826] mt-4 opacity-50 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" />
                </div>
            </div>

            {/* Servicio 3: Arquitectura de Datos */}
            <div className="bg-[#1F2937]/30 border border-white/5 rounded-[2.5rem] p-8 hover:border-[#E29595]/30 transition-all duration-300 group hover:bg-[#1F2937]/50">
                <Briefcase className="text-[#E29595] mb-6 opacity-50 group-hover:opacity-100 transition-opacity" size={32} />
                <h3 className="text-2xl font-serif text-white mb-4">Arquitectura de Datos & Backend</h3>
                <p className="text-sm text-slate-400 leading-relaxed">Diseño de bases de datos escalables (Supabase/PostgreSQL) para lógica de negocio compleja fuera de WordPress.</p>
            </div>
        </div>
    </section>
);

// === COMPONENTE FOOTER CORPORATIVO ===
const Footer = () => (
    <footer id="contact" className="py-20 px-6 border-t border-white/5 bg-[#121826]">
        <div className="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
            <div>
                <div className="flex items-center gap-3 mb-4">
                    <div className="w-8 h-8 bg-[#E29595] rounded-lg flex items-center justify-center text-[#121826]">
                        <Terminal size={18} />
                    </div>
                    <span className="text-xl font-serif text-white tracking-tighter">EMPC<span className="text-[#E29595]">.es</span></span>
                </div>
                <p className="text-sm text-slate-400 max-w-xs">Tu socio tecnológico para la era de la autoridad digital. <br /><a href="mailto:info@empc.es" className="text-[#E29595] hover:underline">info@empc.es</a></p>
            </div>

            <nav className="grid grid-cols-2 gap-x-12 gap-y-4 text-[10px] font-bold uppercase tracking-[0.2em]">
                <div>
                    <p className="text-white mb-4 opacity-50">Legal</p>
                    <a href="#" className="block hover:text-[#E29595] transition-colors text-slate-500 mb-2">Aviso Legal</a>
                    <a href="#" className="block hover:text-[#E29595] transition-colors text-slate-500">Privacidad</a>
                </div>
                <div>
                    <p className="text-white mb-4 opacity-50">Social</p>
                    <a href="#" className="block hover:text-[#E29595] transition-colors text-slate-500 mb-2">LinkedIn</a>
                    <a href="#" className="block hover:text-[#E29595] transition-colors text-slate-500">X (Twitter)</a>
                </div>
            </nav>
        </div>
        <div className="max-w-7xl mx-auto mt-12 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center opacity-40 hover:opacity-100 transition-opacity">
            <p className="text-[10px] font-mono tracking-widest uppercase">© 2026 EMPC.es // Ingeniería de Autoridad</p>
            <div className="flex gap-6 mt-6 md:mt-0">
                <div className="flex items-center gap-2">
                    <div className="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                    <span className="text-[10px] font-mono">Local_Dev_Env</span>
                </div>
            </div>
        </div>
    </footer>
);

// === LAYOUT PRINCIPAL (Este es el que renderizas en local) ===
const EmpcFullSystemLocal: React.FC = () => {
    return (
        <div className="bg-[#121826] text-slate-300 font-sans antialiased min-h-screen scroll-smooth selection:bg-[#E29595] selection:text-[#121826]">
            <NavBar />
            <HeroSection />
            <AboutSection />
            <ServicesSection />
            <Footer />
        </div>
    );
};

export default EmpcFullSystemLocal;

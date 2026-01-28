import React from 'react';
import { ArrowRight, ShieldCheck, Sparkles } from 'lucide-react';

const EmpcHeroProMax: React.FC = () => {
    return (
        <div className="relative min-h-[80vh] bg-[#121826] overflow-hidden font-sans selection:bg-[#E29595] selection:text-[#121826]">
            {/* Background Decor (Anti-generic Pattern) */}
            <div className="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                <div className="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-[#E29595] blur-[120px] rounded-full"></div>
                <div className="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] bg-[#FB7185] blur-[100px] rounded-full opacity-20"></div>
            </div>

            <div className="max-w-7xl mx-auto px-6 pt-32 pb-20 relative z-10">
                <div className="grid lg:grid-cols-2 gap-16 items-center">

                    {/* Lado A: Mensaje de Autoridad (Pilar 11) */}
                    <div className="space-y-8 animate-fade-in-up">
                        <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/5 border border-white/10 backdrop-blur-md">
                            <Sparkles size={16} className="text-[#E29595]" />
                            <span className="text-xs font-bold tracking-widest text-[#E29595] uppercase">Vibe Coding v9.0 Active</span>
                        </div>

                        <h1 className="text-6xl md:text-7xl font-serif text-white leading-[1.1]">
                            Tu visión es <span className="italic text-[#E29595]">imparable</span>. <br />
                            Tu código debe <span className="underline decoration-white/20 underline-offset-8">seguirte</span>.
                        </h1>

                        <p className="text-xl text-slate-400 max-w-lg leading-relaxed">
                            No construimos webs; creamos ecosistemas de alta conversión.
                            <strong> EMPC.es</strong> es la intersección entre el lujo visual y la ingeniería de élite.
                        </p>

                        <div className="flex flex-col sm:flex-row gap-4">
                            <button className="px-10 py-5 bg-[#E29595] text-[#121826] font-bold rounded-2xl hover:scale-105 transition-all shadow-[0_20px_40px_-10px_rgba(226,149,149,0.4)] flex items-center justify-center gap-2">
                                Iniciar Consultoría <ArrowRight size={20} />
                            </button>
                            <button className="px-10 py-5 bg-white/5 text-white font-bold rounded-2xl border border-white/10 hover:bg-white/10 transition-all flex items-center justify-center gap-2 backdrop-blur-xl">
                                Ver Laboratorio
                            </button>
                        </div>
                    </div>

                    {/* Lado B: El "Packaging" (Inspirado en la Terminal de Vera [00:06:41]) */}
                    <div className="relative group animate-fade-in-left">
                        <div className="absolute -inset-1 bg-gradient-to-r from-[#E29595] to-[#FB7185] rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>

                        <div className="relative bg-[#1F2937]/80 backdrop-blur-2xl border border-white/10 rounded-3xl p-8 shadow-2xl">
                            <div className="flex items-center gap-2 mb-6 border-b border-white/5 pb-4">
                                <div className="w-3 h-3 rounded-full bg-rose-500"></div>
                                <div className="w-3 h-3 rounded-full bg-amber-500"></div>
                                <div className="w-3 h-3 rounded-full bg-emerald-500"></div>
                                <span className="ml-4 text-[10px] font-mono text-slate-500 tracking-widest uppercase italic">empc_system_core_v9.sh</span>
                            </div>

                            <div className="space-y-4 font-mono text-sm">
                                <div className="flex gap-3">
                                    <span className="text-[#E29595] shrink-0">➜</span>
                                    <p className="text-slate-300">analizando_mercado <span className="text-slate-500">--nicho=gourmet --high_conversion</span></p>
                                </div>
                                <div className="flex gap-3">
                                    <span className="text-emerald-400 shrink-0">✔</span>
                                    <p className="text-emerald-400/80 italic">Optimización Rank Math &gt; 90 completada.</p>
                                </div>
                                <div className="flex gap-3">
                                    <span className="text-[#E29595] shrink-0">➜</span>
                                    <p className="text-slate-300">inyectando_soberana_v3_theme <span className="text-slate-500">--color=dusty_rose</span></p>
                                </div>
                                <div className="p-4 bg-black/40 rounded-xl border border-white/5 mt-4">
                                    <p className="text-[#E29595] font-bold mb-2">Resumen de Ejecución:</p>
                                    <p className="text-xs text-slate-500">Status: <span className="text-emerald-400">READY</span></p>
                                    <p className="text-xs text-slate-500">Performance: <span className="text-emerald-400">99/100</span></p>
                                    <p className="text-xs text-slate-500">Conversion_Goal: <span className="text-[#E29595]">MAXIMIZED</span></p>
                                </div>
                            </div>
                        </div>

                        {/* Floating Card (Social Proof/Trust) */}
                        <div className="absolute -bottom-6 -left-6 bg-white p-4 rounded-2xl shadow-2xl flex items-center gap-4 animate-bounce-slow">
                            <div className="p-3 bg-emerald-100 rounded-xl text-emerald-600">
                                <ShieldCheck size={24} />
                            </div>
                            <div>
                                <p className="text-[10px] text-slate-400 uppercase font-bold tracking-widest">Sello de Calidad</p>
                                <p className="text-sm font-bold text-[#121826]">Sin Bloatware Garantizado</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    );
};

export default EmpcHeroProMax;

import React, { useState } from 'react';
import { Calculator, Check, ArrowRight, Server, Search, PenTool, Calendar, ShoppingBag } from 'lucide-react';

const BudgetCalculator = () => {
    const [step, setStep] = useState(1);
    const [type, setType] = useState<'service' | 'ecommerce' | null>(null);
    const [features, setFeatures] = useState<string[]>([]);
    const [lead, setLead] = useState({ name: '', email: '' });
    const [status, setStatus] = useState<'idle' | 'submitting' | 'success' | 'error'>('idle');

    // Precios Base (Estimados León 2026)
    const BASE_PRICES = {
        service: 900, // Web Corporativa / Servicios
        ecommerce: 1800 // Tienda Online / Catálogo
    };

    const FEATURE_PRICES: Record<string, number> = {
        seo: 400, // SEO Local León
        writing: 300, // Redacción de contenidos
        booking: 600, // Sistema de reservas
        erp: 1200 // Integración ERP/CRM
    };

    const toggleFeature = (id: string) => {
        setFeatures(prev =>
            prev.includes(id) ? prev.filter(f => f !== id) : [...prev, id]
        );
    };

    const calculateTotal = () => {
        let min = 0;
        if (type) min += BASE_PRICES[type];
        features.forEach(f => min += FEATURE_PRICES[f] || 0);
        return { min, max: min * 1.3 }; // Rango estimado
    };

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setStatus('submitting');

        const folder = calculateTotal();
        const payload = {
            name: lead.name,
            email: lead.email,
            budget_data: {
                type: type === 'service' ? 'Web de Servicios' : 'Tienda Online',
                features: features,
                estimated_range: folder
            }
        };

        try {
            // @ts-ignore
            const apiUrl = window.empcData?.restUrl + 'empc/v1/budget';
            // @ts-ignore
            const nonce = window.empcData?.nonce;

            const res = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': nonce
                },
                body: JSON.stringify(payload)
            });

            if (res.ok) {
                setStatus('success');
            } else {
                setStatus('error');
            }
        } catch (err) {
            console.error(err);
            setStatus('error');
        }
    };

    const est = calculateTotal();

    if (status === 'success') {
        return (
            <div className="bg-emerald-900/50 p-8 rounded-xl border border-emerald-500/30 text-center animate-fade-in">
                <div className="w-16 h-16 bg-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <Check className="w-8 h-8 text-emerald-400" />
                </div>
                <h3 className="text-2xl font-bold text-white mb-2">¡Cálculo Enviado!</h3>
                <p className="text-emerald-200 mb-6">te hemos enviado el presupuesto detallado a <strong>{lead.email}</strong>.</p>
                <div className="text-white bg-slate-800 p-4 rounded-lg inline-block">
                    <span className="text-slate-400 text-sm block">Tu rango estimado</span>
                    <span className="text-3xl font-bold text-emerald-400">{est.min}€ - {est.max.toFixed(0)}€</span>
                </div>
            </div>
        );
    }

    return (
        <div className="bg-slate-900/80 backdrop-blur-md rounded-xl p-6 md:p-8 border border-slate-700 shadow-2xl relative overflow-hidden">
            {/* Progress Bar */}
            <div className="flex gap-2 mb-8">
                {[1, 2, 3].map(i => (
                    <div key={i} className={`h-1 flex-1 rounded-full transition-all ${step >= i ? 'bg-rose-500' : 'bg-slate-700'}`} />
                ))}
            </div>

            {/* Step 1: Tipo */}
            {step === 1 && (
                <div className="space-y-6 animate-fade-in">
                    <h3 className="text-xl font-bold text-white text-center">¿Qué necesitas crear?</h3>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <button
                            onClick={() => { setType('service'); setStep(2); }}
                            className="p-6 rounded-xl border border-slate-700 bg-slate-800/50 hover:border-rose-500 hover:bg-slate-800 transition-all text-left group"
                        >
                            <div className="bg-rose-500/10 w-12 h-12 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <PenTool className="text-rose-500" />
                            </div>
                            <h4 className="font-bold text-white mb-1">Web de Servicios</h4>
                            <p className="text-sm text-slate-400">Para clínicas, abogados, reformas... Muestra lo que haces.</p>
                        </button>

                        <button
                            onClick={() => { setType('ecommerce'); setStep(2); }}
                            className="p-6 rounded-xl border border-slate-700 bg-slate-800/50 hover:border-indigo-500 hover:bg-slate-800 transition-all text-left group"
                        >
                            <div className="bg-indigo-500/10 w-12 h-12 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <ShoppingBag className="text-indigo-500" />
                            </div>
                            <h4 className="font-bold text-white mb-1">Tienda / Catálogo</h4>
                            <p className="text-sm text-slate-400">Venta online o catálogo de productos B2B.</p>
                        </button>
                    </div>
                </div>
            )}

            {/* Step 2: Features */}
            {step === 2 && (
                <div className="space-y-6 animate-fade-in">
                    <h3 className="text-xl font-bold text-white text-center">¿Qué funcionalidades clave necesitas?</h3>
                    <div className="grid grid-cols-1 gap-3">
                        <label className={`flex items-center p-4 rounded-lg border cursor-pointer transition-all ${features.includes('seo') ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700 hover:bg-slate-800'}`}>
                            <input type="checkbox" className="hidden" checked={features.includes('seo')} onChange={() => toggleFeature('seo')} />
                            <div className="mr-3"><Search className="text-rose-400" /></div>
                            <div className="flex-1">
                                <span className="text-white font-medium block">SEO Local Pack</span>
                                <span className="text-xs text-slate-400">Posicionamiento en Google para tu ciudad.</span>
                            </div>
                            {features.includes('seo') && <Check className="text-rose-500" />}
                        </label>

                        <label className={`flex items-center p-4 rounded-lg border cursor-pointer transition-all ${features.includes('writing') ? 'border-orange-500 bg-orange-500/10' : 'border-slate-700 hover:bg-slate-800'}`}>
                            <input type="checkbox" className="hidden" checked={features.includes('writing')} onChange={() => toggleFeature('writing')} />
                            <div className="mr-3"><PenTool className="text-orange-400" /></div>
                            <div className="flex-1">
                                <span className="text-white font-medium block">Redacción Profesional</span>
                                <span className="text-xs text-slate-400">Textos persuasivos (Copywriting).</span>
                            </div>
                            {features.includes('writing') && <Check className="text-orange-500" />}
                        </label>

                        <label className={`flex items-center p-4 rounded-lg border cursor-pointer transition-all ${features.includes('booking') ? 'border-blue-500 bg-blue-500/10' : 'border-slate-700 hover:bg-slate-800'}`}>
                            <input type="checkbox" className="hidden" checked={features.includes('booking')} onChange={() => toggleFeature('booking')} />
                            <div className="mr-3"><Calendar className="text-blue-400" /></div>
                            <div className="flex-1">
                                <span className="text-white font-medium block">Reservas / Cita Previa</span>
                                <span className="text-xs text-slate-400">Calendario sincronizado y pagos.</span>
                            </div>
                            {features.includes('booking') && <Check className="text-blue-500" />}
                        </label>
                    </div>

                    <div className="flex justify-between pt-4">
                        <button onClick={() => setStep(1)} className="text-slate-400 hover:text-white transition-colors">Atrás</button>
                        <button
                            onClick={() => setStep(3)}
                            className="bg-white text-slate-900 px-6 py-2 rounded-lg font-bold hover:bg-slate-200 transition-colors"
                        >
                            Ver Resultado <ArrowRight className="inline w-4 h-4 ml-1" />
                        </button>
                    </div>
                </div>
            )}

            {/* Step 3: Resultado */}
            {step === 3 && (
                <div className="text-center animate-fade-in space-y-6">
                    <div>
                        <span className="text-slate-400 text-sm uppercase tracking-wider">Estimación preliminar</span>
                        <div className="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-orange-400 my-2">
                            {est.min}€ - {est.max.toFixed(0)}€
                        </div>
                        <p className="text-slate-400 text-sm max-w-xs mx-auto">
                            Incluye diseño, desarrollo y optimización. El precio final depende de los detalles.
                        </p>
                    </div>

                    <form onSubmit={handleSubmit} className="bg-slate-800/50 p-6 rounded-xl border border-slate-700 text-left">
                        <h4 className="text-white font-bold mb-4">¿Te cuadra? Recibe el desglose por email</h4>
                        <div className="space-y-4">
                            <div>
                                <label className="block text-xs font-medium text-slate-400 mb-1">Tu Nombre</label>
                                <input
                                    type="text"
                                    required
                                    className="w-full bg-slate-900 border border-slate-700 rounded-lg p-3 text-white focus:border-rose-500 focus:outline-none"
                                    placeholder="Ej: Ana García"
                                    value={lead.name}
                                    onChange={e => setLead({ ...lead, name: e.target.value })}
                                />
                            </div>
                            <div>
                                <label className="block text-xs font-medium text-slate-400 mb-1">Email Profesional</label>
                                <input
                                    type="email"
                                    required
                                    className="w-full bg-slate-900 border border-slate-700 rounded-lg p-3 text-white focus:border-rose-500 focus:outline-none"
                                    placeholder="ana@tuempresa.com"
                                    value={lead.email}
                                    onChange={e => setLead({ ...lead, email: e.target.value })}
                                />
                            </div>
                            <button
                                type="submit"
                                disabled={status === 'submitting'}
                                className="w-full bg-rose-600 hover:bg-rose-500 text-white font-bold py-3 rounded-lg transition-all disabled:opacity-50"
                            >
                                {status === 'submitting' ? 'Enviando...' : 'Enviar Presupuesto PDF'}
                            </button>
                        </div>
                    </form>
                    <button onClick={() => setStep(2)} className="text-slate-500 hover:text-white text-sm">Volver a editar</button>
                </div>
            )}
        </div>
    );
};

export default BudgetCalculator;

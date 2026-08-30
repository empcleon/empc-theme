import React, { useMemo, useState } from 'react';
import { ArrowRight, Calculator } from 'lucide-react';
import pricing from '../../data/commercial-pricing.json';

type Option = { id: string; label: string; description: string; price: number | null };

const options: Option[] = [
    { id: 'landing', label: 'Landing o web de una página', description: 'Una página comercial clara.', price: pricing.design.landing.price },
    { id: 'basic', label: 'Web corporativa básica', description: 'La estructura esencial para tu negocio.', price: pricing.design.basic.price },
    { id: 'professional', label: 'Web corporativa profesional', description: 'Más contenido y profundidad.', price: pricing.design.professional.price },
    { id: 'ecommerce', label: 'Tienda WooCommerce inicial', description: 'Catálogo, carrito y compra según alcance.', price: pricing.ecommerce.initial.price },
    { id: 'advanced-ecommerce', label: 'Tienda avanzada', description: 'Sincronizaciones o integraciones.', price: pricing.ecommerce.advanced.price },
    { id: 'custom', label: 'Otro proyecto o integración', description: 'Lo valoramos con la información disponible.', price: null }
];

const BudgetCalculator: React.FC = () => {
    const [selected, setSelected] = useState<Option | null>(null);
    const [extraPages, setExtraPages] = useState(0);
    const [step, setStep] = useState(1);
    const estimate = useMemo(() => {
        if (!selected || selected.price === null) return null;
        const base = selected.price + extraPages * pricing.design.additionalPage.price;
        const vat = Math.round(base * pricing.vatRate);
        return { base, vat, total: base + vat };
    }, [selected, extraPages]);

    return (
        <div className="bg-slate-900/80 backdrop-blur-md rounded-xl p-6 md:p-8 border border-slate-700 shadow-2xl">
            <div className="flex gap-2 mb-8">{[1, 2, 3].map(item => <div key={item} className={`h-1 flex-1 rounded-full ${step >= item ? 'bg-rose-500' : 'bg-slate-700'}`} />)}</div>
            {step === 1 && <div className="space-y-6"><h3 className="text-xl font-bold text-white text-center">¿Qué necesitas implementar?</h3><div className="grid grid-cols-1 md:grid-cols-2 gap-4">{options.map(item => <button key={item.id} type="button" onClick={() => { setSelected(item); setStep(2); }} className="p-5 rounded-xl border border-slate-700 bg-slate-800/50 hover:border-rose-500 transition-all text-left"><h4 className="font-bold text-white">{item.label}</h4><p className="text-sm text-slate-300 mt-1">{item.description}</p><div className="mt-3 text-sm font-bold text-rose-400">{item.price === null ? 'Presupuesto a medida' : `Desde ${item.price}€ + IVA`}</div></button>)}</div></div>}
            {step === 2 && <div className="space-y-6"><h3 className="text-xl font-bold text-white text-center">Ajusta el alcance inicial</h3><p className="text-slate-300">{selected?.label}. Página adicional: desde {pricing.design.additionalPage.price}€ + IVA.</p><div className="flex items-center gap-3"><button type="button" onClick={() => setExtraPages(Math.max(0, extraPages - 1))} className="w-10 h-10 border border-slate-700 rounded-lg text-white">−</button><span className="w-16 text-center text-white font-bold">{extraPages}</span><button type="button" onClick={() => setExtraPages(extraPages + 1)} className="w-10 h-10 border border-slate-700 rounded-lg text-white">+</button></div><div className="flex justify-between pt-4"><button type="button" onClick={() => setStep(1)} className="text-slate-300">Atrás</button><button type="button" onClick={() => setStep(3)} className="bg-white text-slate-900 px-6 py-2 rounded-lg font-bold flex items-center">Ver estimación <ArrowRight className="w-4 h-4 ml-1" /></button></div></div>}
            {step === 3 && <div className="text-center space-y-6"><Calculator className="mx-auto text-rose-400" /><h3 className="text-xl font-bold text-white">Estimación orientativa</h3>{estimate ? <><div className="space-y-2 text-slate-300"><p>Base estimada: <strong>{estimate.base}€</strong></p><p>IVA aplicable ({pricing.vatRate * 100}%): <strong>{estimate.vat}€</strong></p><p className="text-3xl font-black text-rose-400">Total estimado: {estimate.total}€</p></div><p className="text-slate-300 text-sm">Estimación orientativa. IVA calculado al 21 %. No constituye una oferta contractual.</p></> : <p className="text-slate-300">Este alcance requiere presupuesto a medida. No se muestra una cifra inventada.</p>}<button type="button" onClick={() => setStep(2)} className="text-slate-400 text-sm">Volver a editar</button></div>}
            <div className="mt-8 pt-5 border-t border-slate-700 text-center text-xs text-slate-400">Servicios mensuales, SEO local, WPO y extras con alcance específico: presupuesto a medida.</div>
        </div>
    );
};

export default BudgetCalculator;

import React, { useMemo, useState } from 'react';
import { Calculator, Clock, MapPin } from 'lucide-react';
import pricing from '../../data/commercial-pricing.json';

type ProjectKey = 'landing' | 'basic' | 'professional' | 'ecommerce' | 'custom';
type MaintenanceKey = 'none' | 'basic' | 'medium' | 'plus' | 'premium';

const projects: Array<{ key: ProjectKey; label: string; description: string; price: number | null }> = [
    { key: 'landing', label: 'Landing o web de una página', description: 'Una página clara para presentar tu negocio y facilitar el contacto.', price: pricing.design.landing.price },
    { key: 'basic', label: 'Web corporativa básica', description: 'Una web profesional con el alcance esencial para tu negocio.', price: pricing.design.basic.price },
    { key: 'professional', label: 'Web corporativa profesional', description: 'Más estructura y profundidad para empresas y autónomos.', price: pricing.design.professional.price },
    { key: 'ecommerce', label: 'Tienda WooCommerce inicial', description: 'Una base de comercio electrónico que se concreta según el proyecto.', price: pricing.ecommerce.initial.price },
    { key: 'custom', label: 'Proyecto personalizado', description: 'Integraciones, sincronizaciones o necesidades específicas.', price: null }
];

const maintenance = [
    { key: 'none' as MaintenanceKey, label: 'Sin mantenimiento mensual', price: null },
    { key: 'basic' as MaintenanceKey, label: pricing.maintenance.basic.label, price: pricing.maintenance.basic.price },
    { key: 'medium' as MaintenanceKey, label: pricing.maintenance.medium.label, price: pricing.maintenance.medium.price },
    { key: 'plus' as MaintenanceKey, label: pricing.maintenance.plus.label, price: pricing.maintenance.plus.price },
    { key: 'premium' as MaintenanceKey, label: pricing.maintenance.premium.label, price: pricing.maintenance.premium.price }
];

const PricingCalculator: React.FC = () => {
    const [project, setProject] = useState<ProjectKey>('landing');
    const [extraPages, setExtraPages] = useState(0);
    const [maintenancePlan, setMaintenancePlan] = useState<MaintenanceKey>('none');
    const [showResults, setShowResults] = useState(false);

    const selectedProject = projects.find(item => item.key === project) ?? projects[0];
    const selectedMaintenance = maintenance.find(item => item.key === maintenancePlan) ?? maintenance[0];
    const estimate = useMemo(() => {
        if (selectedProject.price === null) return null;
        const base = selectedProject.price + extraPages * pricing.design.additionalPage.price;
        const vat = Math.round(base * pricing.vatRate);
        return { base, vat, total: base + vat };
    }, [selectedProject.price, extraPages]);

    return (
        <div className="max-w-6xl mx-auto px-4 py-12">
            <div className="text-center mb-12">
                <h2 className="text-4xl md:text-5xl font-bold mb-4 text-white font-syne">Estimación orientativa</h2>
                <p className="text-xl text-slate-400 max-w-3xl mx-auto">Selecciona un alcance inicial y separa la inversión del proyecto de los servicios mensuales.</p>
                <div className="mt-6 inline-block p-4 bg-[#FF007A]/10 rounded-xl border border-[#FF007A]/20"><p className="text-[#FF007A]"><MapPin className="inline w-5 h-5 mr-2" /><strong>Territorio: León</strong> · El presupuesto final depende del alcance acordado.</p></div>
            </div>

            <div className="grid lg:grid-cols-3 gap-8">
                <div className="lg:col-span-2 card-soberana rounded-2xl p-8">
                    <h2 className="text-2xl font-bold mb-8 text-white font-syne">1. Inversión inicial</h2>
                    <div className="grid md:grid-cols-2 gap-4">
                        {projects.map(item => (
                            <button key={item.key} type="button" onClick={() => { setProject(item.key); setShowResults(false); }} className={`text-left p-5 rounded-xl border transition-all ${project === item.key ? 'border-[#FF007A] bg-[#FF007A]/10' : 'border-slate-800 bg-black/20 hover:border-[#FF007A]/50'}`}>
                                <h3 className="font-bold text-lg text-white">{item.label}</h3>
                                <p className="text-slate-400 text-sm mt-2">{item.description}</p>
                                <div className="mt-3 text-lg font-bold text-[#FF007A]">{item.price === null ? 'Presupuesto a medida' : `Desde ${item.price}€ + IVA`}</div>
                            </button>
                        ))}
                    </div>

                    <div className="mt-10 border-t border-slate-800 pt-8">
                        <h2 className="text-2xl font-bold mb-4 text-white font-syne">2. Páginas adicionales</h2>
                        <p className="text-slate-400 text-sm mb-4">Desde {pricing.design.additionalPage.price}€ + IVA por página, cuando el alcance se pueda definir de forma separada.</p>
                        <div className="flex items-center gap-3"><button type="button" aria-label="Quitar una página adicional" onClick={() => setExtraPages(Math.max(0, extraPages - 1))} className="w-10 h-10 bg-black border border-slate-700 rounded-lg text-white">−</button><span className="w-16 text-center text-white font-bold" aria-live="polite">{extraPages}</span><button type="button" aria-label="Añadir una página adicional" onClick={() => setExtraPages(extraPages + 1)} className="w-10 h-10 bg-black border border-slate-700 rounded-lg text-white">+</button></div>
                    </div>

                    <div className="mt-10 border-t border-slate-800 pt-8">
                        <h2 className="text-2xl font-bold mb-4 text-white font-syne">3. Servicio mensual opcional</h2>
                        <p id="maintenance-plan-help" className="text-slate-400 text-sm mb-4">No se suma a la inversión inicial. Se muestra aparte para evitar mezclar pagos únicos y cuotas.</p>
                        <label htmlFor="maintenance-plan" className="block text-sm font-semibold text-white mb-2">Plan de mantenimiento</label>
                        <select id="maintenance-plan" name="maintenancePlan" aria-describedby="maintenance-plan-help" value={maintenancePlan} onChange={event => setMaintenancePlan(event.target.value as MaintenanceKey)} className="w-full bg-black/30 border border-slate-700 rounded-xl p-3 text-white">
                            {maintenance.map(item => <option key={item.key} value={item.key}>{item.label}{item.price === null ? '' : ` · ${item.price}€/mes + IVA`}</option>)}
                        </select>
                    </div>

                    <button type="button" onClick={() => setShowResults(true)} className="w-full mt-10 bg-[#FF007A] text-black font-bold py-4 px-10 rounded-xl text-lg flex items-center justify-center gap-2"><Calculator className="w-5 h-5" />Calcular estimación</button>
                </div>

                <aside className="lg:col-span-1">
                    <div className="sticky top-8 card-soberana rounded-2xl p-6" aria-live="polite" aria-atomic="true">
                        <h2 className="text-2xl font-bold mb-6 text-white font-syne">Resultado</h2>
                        {!showResults ? <p className="text-slate-500">Configura el alcance y pulsa «Calcular estimación».</p> : estimate === null ? <div className="space-y-4"><p className="text-white font-bold">Proyecto personalizado</p><p className="text-slate-400">Necesita una valoración del alcance antes de poder estimarse.</p></div> : <div className="space-y-4"><div className="flex justify-between text-slate-300"><span>Base estimada</span><strong>{estimate.base}€</strong></div><div className="flex justify-between text-slate-300"><span>IVA aplicable ({pricing.vatRate * 100}%)</span><strong>{estimate.vat}€</strong></div><div className="border-t border-slate-700 pt-4 flex justify-between text-white text-xl font-bold"><span>Total estimado</span><strong className="text-[#FF007A]">{estimate.total}€</strong></div><p className="text-xs text-slate-400">Estimación orientativa. No constituye una oferta contractual.</p>{selectedMaintenance.price !== null && <div className="mt-5 p-4 bg-[#FF007A]/10 rounded-lg border border-[#FF007A]/30"><p className="text-white font-bold">Servicio mensual aparte</p><p className="text-2xl font-bold text-[#FF007A]">{selectedMaintenance.price}€/mes + IVA</p></div>}<div className="flex items-center gap-3 text-slate-400 text-sm"><Clock className="w-5 h-5" />El plazo se concreta con el alcance.</div></div>}
                    </div>
                </aside>
            </div>

            <div className="mt-12 bg-black/20 rounded-2xl p-8 border border-white/5"><div className="max-w-3xl mx-auto text-center"><p className="text-lg text-slate-400">Para SEO, WPO, integraciones React, diseño gráfico, reservas, automatizaciones, ERP/CRM, copywriting o sincronización de stock: <strong className="text-white">presupuesto a medida</strong>.</p></div></div>
        </div>
    );
};

export default PricingCalculator;

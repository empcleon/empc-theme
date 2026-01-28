import React, { useState, useEffect } from 'react';
import { Calculator, Check, Clock, Phone, MapPin } from 'lucide-react';

/**
 * Calculadora de Presupuestos específica para León
 * Basada en precios reales del mercado leonés 2026
 */

const PricingCalculator: React.FC = () => {
    // State
    const [projectType, setProjectType] = useState('web-basica');
    const [basePrice, setBasePrice] = useState(375);
    const [extraPages, setExtraPages] = useState(0);
    const [services, setServices] = useState({
        seo: false,
        mantenimiento: false,
        diseno: false,
        react: false
    });
    const [includeVat, setIncludeVat] = useState(true);
    const [showResults, setShowResults] = useState(false);

    // Service prices
    const servicePrices = {
        seo: 200,
        mantenimiento: 39,
        diseno: 200,
        react: 150
    };

    // Calculated values
    const [subtotal, setSubtotal] = useState(0);
    const [vat, setVat] = useState(0);
    const [total, setTotal] = useState(0);
    const [monthlyCost, setMonthlyCost] = useState(0);

    // Calculate budget whenever inputs change
    useEffect(() => {
        let calculatedSubtotal = basePrice + (extraPages * 15);
        let monthlyRecurring = 0;

        if (services.seo) calculatedSubtotal += servicePrices.seo;
        if (services.mantenimiento) {
            calculatedSubtotal += servicePrices.mantenimiento;
            monthlyRecurring = servicePrices.mantenimiento;
        }
        if (services.diseno) calculatedSubtotal += servicePrices.diseno;
        if (services.react) calculatedSubtotal += servicePrices.react;

        const calculatedVat = includeVat ? Math.round(calculatedSubtotal * 0.21) : 0;
        const calculatedTotal = calculatedSubtotal + calculatedVat;

        setSubtotal(calculatedSubtotal);
        setVat(calculatedVat);
        setTotal(calculatedTotal);
        setMonthlyCost(monthlyRecurring);
    }, [basePrice, extraPages, services, includeVat]);

    // Handlers
    const handleProjectChange = (type: string, price: number) => {
        setProjectType(type);
        setBasePrice(price);
    };

    const toggleService = (service: keyof typeof services) => {
        setServices(prev => ({ ...prev, [service]: !prev[service] }));
    };

    const getProjectName = () => {
        switch (projectType) {
            case 'web-basica': return 'Web Básica';
            case 'web-media': return 'Web Media';
            case 'tienda-online': return 'Tienda Online';
            case 'seo-mantenimiento': return 'SEO/Mantenimiento';
            default: return '';
        }
    };

    const getTimeline = () => {
        switch (projectType) {
            case 'web-basica': return '7-10 días laborables';
            case 'web-media': return '10-15 días laborables';
            case 'tienda-online': return '15-25 días laborables';
            default: return '5-7 días laborables';
        }
    };

    return (
        <div className="max-w-6xl mx-auto px-4 py-12">
            {/* Header */}
            <div className="text-center mb-16">
                <h1 className="text-4xl md:text-5xl font-bold mb-4 text-white font-syne">
                    Calculadora de Presupuesto
                </h1>
                <p className="text-xl text-slate-400 max-w-3xl mx-auto font-inter">
                    Calcula el coste de tu dominación digital. Precios transparentes 2026.
                </p>
                <div className="mt-6 inline-block p-4 bg-[#FF007A]/10 rounded-xl border border-[#FF007A]/20 backdrop-blur-sm">
                    <p className="text-[#FF007A]">
                        <MapPin className="inline w-5 h-5 mr-2" />
                        <strong>Territorio: León</strong> - Estrategias validadas para el mercado local.
                    </p>
                </div>
            </div>

            <div className="grid lg:grid-cols-3 gap-8">
                {/* Left: Calculator Form */}
                <div className="lg:col-span-2">
                    <div className="card-soberana rounded-2xl p-8 mb-8">
                        <h2 className="text-2xl font-bold mb-8 text-white font-syne">Configura tu arma digital</h2>

                        {/* Project Type */}
                        <div className="mb-10">
                            <h3 className="text-xl font-semibold mb-4 text-slate-700">1. Tipo de proyecto principal</h3>
                            <div className="grid md:grid-cols-2 gap-4">
                                {/* Web Básica */}
                                <button
                                    onClick={() => handleProjectChange('web-basica', 375)}
                                    className={`text-left p-6 rounded-xl border transition-all ${projectType === 'web-basica'
                                        ? 'border-[#FF007A] bg-[#FF007A]/10 shadow-[0_0_15px_rgba(255,0,122,0.3)]'
                                        : 'border-slate-800 bg-black/20 hover:border-[#FF007A]/50'
                                        }`}
                                >
                                    <div className="flex justify-between items-start mb-3">
                                        <div className="flex-1">
                                            <h4 className="font-bold text-lg text-white">Web Básica</h4>
                                            <p className="text-slate-400 text-sm mt-1">Hasta 4 páginas, WordPress estándar, responsive</p>
                                            <div className="mt-3">
                                                <span className="text-2xl font-bold text-[#FF007A]">375€</span>
                                                <span className="text-slate-500 text-sm ml-2">+ IVA</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="mt-4 pt-4 border-t border-slate-800">
                                        <p className="text-slate-400 text-sm flex items-start">
                                            <Check className="w-4 h-4 text-[#FF007A] mr-2 mt-0.5 flex-shrink-0" />
                                            Start small, think big.
                                        </p>
                                    </div>
                                </button>

                                {/* Web Media */}
                                <button
                                    onClick={() => handleProjectChange('web-media', 525)}
                                    className={`text-left p-6 rounded-xl border transition-all ${projectType === 'web-media'
                                        ? 'border-[#FF007A] bg-[#FF007A]/10 shadow-[0_0_15px_rgba(255,0,122,0.3)]'
                                        : 'border-slate-800 bg-black/20 hover:border-[#FF007A]/50'
                                        }`}
                                >
                                    <div className="flex justify-between items-start mb-3">
                                        <div className="flex-1">
                                            <h4 className="font-bold text-lg text-white">Web Media</h4>
                                            <p className="text-slate-400 text-sm mt-1">Hasta 9 páginas, blog o formulario custom</p>
                                            <div className="mt-3">
                                                <span className="text-2xl font-bold text-[#FF007A]">525€</span>
                                                <span className="text-slate-500 text-sm ml-2">+ IVA</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="mt-4 pt-4 border-t border-slate-800">
                                        <p className="text-slate-400 text-sm flex items-start">
                                            <Check className="w-4 h-4 text-[#FF007A] mr-2 mt-0.5 flex-shrink-0" />
                                            Para los que tienen algo que decir.
                                        </p>
                                    </div>
                                </button>

                                {/* Tienda Online */}
                                <button
                                    onClick={() => handleProjectChange('tienda-online', 1000)}
                                    className={`text-left p-6 rounded-xl border transition-all ${projectType === 'tienda-online'
                                        ? 'border-[#FF007A] bg-[#FF007A]/10 shadow-[0_0_15px_rgba(255,0,122,0.3)]'
                                        : 'border-slate-800 bg-black/20 hover:border-[#FF007A]/50'
                                        }`}
                                >
                                    <div className="flex justify-between items-start mb-3">
                                        <div className="flex-1">
                                            <h4 className="font-bold text-lg text-white">Tienda Online</h4>
                                            <p className="text-slate-400 text-sm mt-1">WooCommerce con pagos, stock y SEO básico</p>
                                            <div className="mt-3">
                                                <span className="text-2xl font-bold text-[#FF007A]">800-1200€</span>
                                                <span className="text-slate-500 text-sm ml-2">+ IVA</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="mt-4 pt-4 border-t border-slate-800">
                                        <p className="text-slate-400 text-sm flex items-start">
                                            <Check className="w-4 h-4 text-[#FF007A] mr-2 mt-0.5 flex-shrink-0" />
                                            Vende mientras duermes.
                                        </p>
                                    </div>
                                </button>

                                {/* SEO/Mantenimiento */}
                                <button
                                    onClick={() => handleProjectChange('seo-mantenimiento', 0)}
                                    className={`text-left p-6 rounded-xl border transition-all ${projectType === 'seo-mantenimiento'
                                        ? 'border-[#FF007A] bg-[#FF007A]/10 shadow-[0_0_15px_rgba(255,0,122,0.3)]'
                                        : 'border-slate-800 bg-black/20 hover:border-[#FF007A]/50'
                                        }`}
                                >
                                    <div className="flex justify-between items-start mb-3">
                                        <div className="flex-1">
                                            <h4 className="font-bold text-lg text-white">Solo SEO o Mantenimiento</h4>
                                            <p className="text-slate-400 text-sm mt-1">Servicios específicos sin desarrollo completo</p>
                                            <div className="mt-3">
                                                <span className="text-2xl font-bold text-[#FF007A]">Desde 39€</span>
                                                <span className="text-slate-500 text-sm ml-2">/mes + IVA</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="mt-4 pt-4 border-t border-slate-800">
                                        <p className="text-slate-400 text-sm flex items-start">
                                            <Check className="w-4 h-4 text-[#FF007A] mr-2 mt-0.5 flex-shrink-0" />
                                            Optimización continua.
                                        </p>
                                    </div>
                                </button>
                            </div>
                        </div>

                        {/* Additional Pages */}
                        <div className="mb-10">
                            <h3 className="text-xl font-semibold mb-4 text-white font-syne">2. Páginas adicionales</h3>
                            <div className="flex items-center justify-between p-5 bg-black/20 border border-slate-800 rounded-xl">
                                <div className="flex-1">
                                    <p className="text-white font-medium">Cada página extra (+15€)</p>
                                    <p className="text-sm text-slate-400">Páginas estándar como "Sobre Nosotros", "Servicios", "Contacto"</p>
                                </div>
                                <div className="flex items-center gap-2">
                                    <button
                                        onClick={() => setExtraPages(Math.max(0, extraPages - 1))}
                                        className="w-10 h-10 bg-black border border-slate-700 rounded-lg flex items-center justify-center font-bold text-white hover:border-[#FF007A] transition"
                                        aria-label="Disminuir número de páginas adicionales"
                                    >
                                        -
                                    </button>
                                    <div className="w-16 h-10 bg-black border border-slate-700 rounded-lg flex items-center justify-center font-bold text-white" role="status" aria-live="polite" aria-label={`${extraPages} páginas adicionales seleccionadas`}>
                                        {extraPages}
                                    </div>
                                    <button
                                        onClick={() => setExtraPages(extraPages + 1)}
                                        className="w-10 h-10 bg-black border border-slate-700 rounded-lg flex items-center justify-center font-bold text-white hover:border-[#FF007A] transition"
                                        aria-label="Aumentar número de páginas adicionales"
                                    >
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>

                        {/* Additional Services */}
                        <div className="mb-10">
                            <h3 className="text-xl font-semibold mb-4 text-white font-syne">3. Servicios adicionales</h3>
                            <div className="grid md:grid-cols-2 gap-4">
                                {/* SEO Local */}
                                <label
                                    className={`p-5 rounded-xl border cursor-pointer transition-all ${services.seo ? 'border-[#FF007A] bg-[#FF007A]/10' : 'border-slate-800 bg-black/20 hover:border-slate-600'
                                        }`}
                                >
                                    <input
                                        type="checkbox"
                                        checked={services.seo}
                                        onChange={() => toggleService('seo')}
                                        className="hidden"
                                        id="service-seo"
                                        aria-label="SEO Local León - Optimización para búsquedas locales, 200 euros"
                                    />
                                    <div className="flex items-center justify-between">
                                        <div className="flex items-center gap-3">
                                            <div className={`w-6 h-6 border rounded-md flex items-center justify-center flex-shrink-0 ${services.seo ? 'border-[#FF007A] bg-[#FF007A]' : 'border-slate-600'
                                                }`} aria-hidden="true">
                                                {services.seo && <Check className="w-4 h-4 text-black" />}
                                            </div>
                                            <div>
                                                <h4 className="font-bold text-white">SEO Local León</h4>
                                                <p className="text-slate-400 text-sm">Domina las búsquedas</p>
                                            </div>
                                        </div>
                                        <div className="text-right">
                                            <span className="font-bold text-[#FF007A]">200€</span>
                                        </div>
                                    </div>
                                </label>

                                {/* Mantenimiento */}
                                <label
                                    className={`p-5 rounded-xl border cursor-pointer transition-all ${services.mantenimiento ? 'border-[#FF007A] bg-[#FF007A]/10' : 'border-slate-800 bg-black/20 hover:border-slate-600'
                                        }`}
                                >
                                    <input
                                        type="checkbox"
                                        checked={services.mantenimiento}
                                        onChange={() => toggleService('mantenimiento')}
                                        className="hidden"
                                        id="service-mantenimiento"
                                        aria-label="Mantenimiento Web - Seguridad, backups y actualizaciones, 39 euros al mes"
                                    />
                                    <div className="flex items-center justify-between">
                                        <div className="flex items-center gap-3">
                                            <div className={`w-6 h-6 border rounded-md flex items-center justify-center flex-shrink-0 ${services.mantenimiento ? 'border-[#FF007A] bg-[#FF007A]' : 'border-slate-600'
                                                }`} aria-hidden="true">
                                                {services.mantenimiento && <Check className="w-4 h-4 text-black" />}
                                            </div>
                                            <div>
                                                <h4 className="font-bold text-white">Mantenimiento Web</h4>
                                                <p className="text-slate-400 text-sm">Duerme tranquilo</p>
                                            </div>
                                        </div>
                                        <div className="text-right">
                                            <span className="font-bold text-[#FF007A]">39€</span>
                                            <span className="text-slate-500 text-sm ml-1">/mes</span>
                                        </div>
                                    </div>
                                </label>

                                {/* Diseño Gráfico */}
                                <label
                                    className={`p-5 rounded-xl border cursor-pointer transition-all ${services.diseno ? 'border-[#FF007A] bg-[#FF007A]/10' : 'border-slate-800 bg-black/20 hover:border-slate-600'
                                        }`}
                                >
                                    <input
                                        type="checkbox"
                                        checked={services.diseno}
                                        onChange={() => toggleService('diseno')}
                                        className="hidden"
                                        id="service-diseno"
                                        aria-label="Diseño Gráfico - Logos, carteles y material promocional, 200 euros"
                                    />
                                    <div className="flex items-center justify-between">
                                        <div className="flex items-center gap-3">
                                            <div className={`w-6 h-6 border rounded-md flex items-center justify-center flex-shrink-0 ${services.diseno ? 'border-[#FF007A] bg-[#FF007A]' : 'border-slate-600'
                                                }`} aria-hidden="true">
                                                {services.diseno && <Check className="w-4 h-4 text-black" />}
                                            </div>
                                            <div>
                                                <h4 className="font-bold text-white">Diseño Gráfico</h4>
                                                <p className="text-slate-400 text-sm">Branding impecable</p>
                                            </div>
                                        </div>
                                        <div className="text-right">
                                            <span className="font-bold text-[#FF007A]">200€</span>
                                        </div>
                                    </div>
                                </label>

                                {/* React Islands */}
                                <label
                                    className={`p-5 rounded-xl border cursor-pointer transition-all ${services.react ? 'border-[#FF007A] bg-[#FF007A]/10' : 'border-slate-800 bg-black/20 hover:border-slate-600'
                                        }`}
                                >
                                    <input
                                        type="checkbox"
                                        checked={services.react}
                                        onChange={() => toggleService('react')}
                                        className="hidden"
                                        id="service-react"
                                        aria-label="Integración React - Componentes interactivos en WordPress, 150 euros"
                                    />
                                    <div className="flex items-center justify-between">
                                        <div className="flex items-center gap-3">
                                            <div className={`w-6 h-6 border rounded-md flex items-center justify-center flex-shrink-0 ${services.react ? 'border-[#FF007A] bg-[#FF007A]' : 'border-slate-600'
                                                }`} aria-hidden="true">
                                                {services.react && <Check className="w-4 h-4 text-black" />}
                                            </div>
                                            <div>
                                                <h4 className="font-bold text-white">Integración React</h4>
                                                <p className="text-slate-400 text-sm">Velocidad extrema</p>
                                            </div>
                                        </div>
                                        <div className="text-right">
                                            <span className="font-bold text-[#FF007A]">150€</span>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {/* VAT Toggle */}
                        <div className="mb-8">
                            <label className="flex items-center cursor-pointer">
                                <input
                                    type="checkbox"
                                    checked={includeVat}
                                    onChange={() => setIncludeVat(!includeVat)}
                                    className="w-5 h-5 text-[#FF007A] rounded bg-black border-slate-700"
                                    id="include-vat"
                                    aria-label="Incluir IVA del 21 por ciento en el presupuesto"
                                />
                                <div className="ml-3">
                                    <span className="text-white font-medium">Incluir IVA (21%)</span>
                                </div>
                            </label>
                        </div>

                        {/* Calculate Button */}
                        <button
                            onClick={() => setShowResults(true)}
                            className="w-full bg-[#FF007A] text-black font-bold py-4 px-10 rounded-xl text-lg hover:bg-[#FB7185] hover:shadow-[0_0_20px_rgba(255,0,122,0.6)] transition-all flex items-center justify-center gap-2 uppercase tracking-wide"
                        >
                            <Calculator className="w-5 h-5" />
                            Calcular Ahora
                        </button>
                    </div>


                </div>

                {/* Right: Results Sidebar */}
                <div className="lg:col-span-1">
                    <div className="sticky top-8 card-soberana rounded-2xl p-6">
                        <h2 className="text-2xl font-bold mb-6 text-white font-syne">Tu Inversión</h2>

                        {!showResults ? (
                            <div className="text-center py-12">
                                <div className="w-16 h-16 bg-white/5 rounded-full flex items-center justify-center mx-auto mb-4 border border-white/10">
                                    <Calculator className="w-8 h-8 text-slate-500" />
                                </div>
                                <h3 className="text-xl font-bold text-slate-400 mb-2 font-syne">Esperando datos...</h3>
                            </div>
                        ) : (
                            <div>
                                {/* Breakdown */}
                                <div className="mb-6">
                                    <h3 className="font-bold text-white mb-3 text-lg">Desglose</h3>
                                    <div className="space-y-3 mb-4">
                                        <div className="flex justify-between text-slate-400">
                                            <span>Proyecto base ({getProjectName()}):</span>
                                            <span className="font-medium text-white">{basePrice}€</span>
                                        </div>
                                        {extraPages > 0 && (
                                            <div className="flex justify-between text-slate-400">
                                                <span>Páginas extra ({extraPages}):</span>
                                                <span className="font-medium text-white">{extraPages * 15}€</span>
                                            </div>
                                        )}
                                        {services.seo && (
                                            <div className="flex justify-between text-slate-400">
                                                <span>SEO Local:</span>
                                                <span className="font-medium text-white">{servicePrices.seo}€</span>
                                            </div>
                                        )}
                                        {services.mantenimiento && (
                                            <div className="flex justify-between text-slate-400">
                                                <span>Mantenimiento:</span>
                                                <span className="font-medium text-white">{servicePrices.mantenimiento}€</span>
                                            </div>
                                        )}
                                        {services.diseno && (
                                            <div className="flex justify-between text-slate-400">
                                                <span>Diseño:</span>
                                                <span className="font-medium text-white">{servicePrices.diseno}€</span>
                                            </div>
                                        )}
                                        {services.react && (
                                            <div className="flex justify-between text-slate-400">
                                                <span>React:</span>
                                                <span className="font-medium text-white">{servicePrices.react}€</span>
                                            </div>
                                        )}
                                    </div>

                                    <div className="border-t border-slate-700 pt-3">
                                        <div className="flex justify-between text-slate-300">
                                            <span className="font-medium">Subtotal:</span>
                                            <span className="font-medium">{subtotal}€</span>
                                        </div>
                                        {includeVat && (
                                            <div className="flex justify-between text-slate-300 mt-2">
                                                <span>IVA (21%):</span>
                                                <span>{vat}€</span>
                                            </div>
                                        )}
                                        <div className="flex justify-between text-white text-xl font-bold mt-3 pt-3 border-t border-slate-700">
                                            <span>Total:</span>
                                            <span className="text-[#FF007A] glow-text">{total}€</span>
                                        </div>
                                    </div>
                                </div>

                                {/* Monthly Cost */}
                                {monthlyCost > 0 && (
                                    <div className="mb-6 p-4 bg-[#FF007A]/10 rounded-lg border border-[#FF007A]/30">
                                        <h4 className="font-bold text-white mb-1">Mantenimiento mensual:</h4>
                                        <p className="text-2xl font-bold text-[#FF007A]">{monthlyCost}€/mes</p>
                                    </div>
                                )}

                                {/* Timeline */}
                                <div className="mb-8">
                                    <h3 className="font-bold text-white mb-3">Plazo estimado</h3>
                                    <div className="flex items-center gap-4">
                                        <div className="bg-[#FF007A]/20 text-[#FF007A] p-3 rounded-lg">
                                            <Clock className="w-5 h-5" />
                                        </div>
                                        <div>
                                            <p className="font-medium text-white">{getTimeline()}</p>
                                            <p className="text-sm text-slate-400">Rapidez ejecutiva</p>
                                        </div>
                                    </div>
                                </div>

                                {/* CTA */}
                                <a
                                    href={`/contacto?presupuesto=${total}&tipo=${projectType}`}
                                    className="block text-center bg-[#FF007A] text-black font-bold py-4 px-6 rounded-xl hover:bg-[#FB7185] hover:shadow-[0_0_20px_rgba(255,0,122,0.6)] transition-all uppercase tracking-wide"
                                >
                                    Solicitar Auditoría
                                </a>
                            </div>
                        )}
                    </div>
                </div>
            </div>

            {/* Leon-specific CTA */}
            <div className="mt-12 bg-black/20 rounded-2xl p-8 border border-white/5 backdrop-blur-sm">
                <div className="max-w-3xl mx-auto text-center">
                    <h3 className="text-2xl font-bold text-white mb-4 font-syne">¿Eres autónomo en León?</h3>
                    <p className="text-lg text-slate-400 mb-6">
                        Este presupuesto es <strong>100% deducible</strong>. Incluimos alta en Google Maps para que domines tu barrio local.
                    </p>
                </div>
            </div>
        </div>
    );
};

export default PricingCalculator;

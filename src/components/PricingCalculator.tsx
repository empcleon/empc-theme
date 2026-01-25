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
                <h1 className="text-4xl md:text-5xl font-bold mb-4 bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Calculadora de Presupuesto Web
                </h1>
                <p className="text-xl text-slate-600 max-w-3xl mx-auto">
                    Calcula al instante el presupuesto para tu proyecto web en León. Precios reales del mercado 2026.
                </p>
                <div className="mt-6 inline-block p-4 bg-gradient-to-r from-blue-50 to-purple-50 rounded-xl border border-blue-200">
                    <p className="text-slate-700">
                        <MapPin className="inline w-5 h-5 text-purple-600 mr-2" />
                        <strong>Para tu bar en el Húmedo, esto sería ideal</strong> - diseños web que destacan en León
                    </p>
                </div>
            </div>

            <div className="grid lg:grid-cols-3 gap-8">
                {/* Left: Calculator Form */}
                <div className="lg:col-span-2">
                    <div className="bg-white rounded-2xl shadow-xl border border-slate-200 p-8">
                        <h2 className="text-2xl font-bold mb-8 text-slate-800">Configura tu proyecto</h2>

                        {/* Project Type */}
                        <div className="mb-10">
                            <h3 className="text-xl font-semibold mb-4 text-slate-700">1. Tipo de proyecto principal</h3>
                            <div className="grid md:grid-cols-2 gap-4">
                                {/* Web Básica */}
                                <button
                                    onClick={() => handleProjectChange('web-basica', 375)}
                                    className={`text-left p-6 rounded-xl border-2 transition-all ${projectType === 'web-basica'
                                        ? 'border-purple-500 bg-purple-50 ring-2 ring-purple-200'
                                        : 'border-slate-200 hover:border-purple-300'
                                        }`}
                                >
                                    <div className="flex justify-between items-start mb-3">
                                        <div className="flex-1">
                                            <h4 className="font-bold text-lg text-slate-800">Web Básica</h4>
                                            <p className="text-slate-600 text-sm mt-1">Hasta 4 páginas, WordPress estándar, responsive</p>
                                            <div className="mt-3">
                                                <span className="text-2xl font-bold text-blue-600">375€</span>
                                                <span className="text-slate-500 text-sm ml-2">+ IVA</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="mt-4 pt-4 border-t border-slate-100">
                                        <p className="text-slate-700 text-sm flex items-start">
                                            <Check className="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                                            Ideal para pymes que inician su presencia online
                                        </p>
                                    </div>
                                </button>

                                {/* Web Media */}
                                <button
                                    onClick={() => handleProjectChange('web-media', 525)}
                                    className={`text-left p-6 rounded-xl border-2 transition-all ${projectType === 'web-media'
                                        ? 'border-purple-500 bg-purple-50 ring-2 ring-purple-200'
                                        : 'border-slate-200 hover:border-purple-300'
                                        }`}
                                >
                                    <div className="flex justify-between items-start mb-3">
                                        <div className="flex-1">
                                            <h4 className="font-bold text-lg text-slate-800">Web Media</h4>
                                            <p className="text-slate-600 text-sm mt-1">Hasta 9 páginas, blog o formulario custom</p>
                                            <div className="mt-3">
                                                <span className="text-2xl font-bold text-blue-600">525€</span>
                                                <span className="text-slate-500 text-sm ml-2">+ IVA</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="mt-4 pt-4 border-t border-slate-100">
                                        <p className="text-slate-700 text-sm flex items-start">
                                            <Check className="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                                            Perfecto para negocios con más contenido
                                        </p>
                                    </div>
                                </button>

                                {/* Tienda Online */}
                                <button
                                    onClick={() => handleProjectChange('tienda-online', 1000)}
                                    className={`text-left p-6 rounded-xl border-2 transition-all ${projectType === 'tienda-online'
                                        ? 'border-purple-500 bg-purple-50 ring-2 ring-purple-200'
                                        : 'border-slate-200 hover:border-purple-300'
                                        }`}
                                >
                                    <div className="flex justify-between items-start mb-3">
                                        <div className="flex-1">
                                            <h4 className="font-bold text-lg text-slate-800">Tienda Online</h4>
                                            <p className="text-slate-600 text-sm mt-1">WooCommerce con pagos, stock y SEO básico</p>
                                            <div className="mt-3">
                                                <span className="text-2xl font-bold text-blue-600">800-1200€</span>
                                                <span className="text-slate-500 text-sm ml-2">+ IVA</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="mt-4 pt-4 border-t border-slate-100">
                                        <p className="text-slate-700 text-sm flex items-start">
                                            <Check className="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                                            Para vender online desde León a toda España
                                        </p>
                                    </div>
                                </button>

                                {/* SEO/Mantenimiento */}
                                <button
                                    onClick={() => handleProjectChange('seo-mantenimiento', 0)}
                                    className={`text-left p-6 rounded-xl border-2 transition-all ${projectType === 'seo-mantenimiento'
                                        ? 'border-purple-500 bg-purple-50 ring-2 ring-purple-200'
                                        : 'border-slate-200 hover:border-purple-300'
                                        }`}
                                >
                                    <div className="flex justify-between items-start mb-3">
                                        <div className="flex-1">
                                            <h4 className="font-bold text-lg text-slate-800">Solo SEO o Mantenimiento</h4>
                                            <p className="text-slate-600 text-sm mt-1">Servicios específicos sin desarrollo completo</p>
                                            <div className="mt-3">
                                                <span className="text-2xl font-bold text-blue-600">Desde 39€</span>
                                                <span className="text-slate-500 text-sm ml-2">/mes + IVA</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="mt-4 pt-4 border-t border-slate-100">
                                        <p className="text-slate-700 text-sm flex items-start">
                                            <Check className="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                                            Para mejorar o mantener un sitio existente
                                        </p>
                                    </div>
                                </button>
                            </div>
                        </div>

                        {/* Additional Pages */}
                        <div className="mb-10">
                            <h3 className="text-xl font-semibold mb-4 text-slate-700">2. Páginas adicionales</h3>
                            <div className="flex items-center justify-between p-5 bg-slate-50 rounded-xl">
                                <div className="flex-1">
                                    <p className="text-slate-700 font-medium">Cada página extra (+15€)</p>
                                    <p className="text-sm text-slate-500">Páginas estándar como "Sobre Nosotros", "Servicios", "Contacto"</p>
                                </div>
                                <div className="flex items-center gap-2">
                                    <button
                                        onClick={() => setExtraPages(Math.max(0, extraPages - 1))}
                                        className="w-10 h-10 bg-white border border-slate-300 rounded-lg flex items-center justify-center font-bold text-slate-700 hover:bg-slate-100 transition"
                                        aria-label="Disminuir número de páginas adicionales"
                                    >
                                        -
                                    </button>
                                    <div className="w-16 h-10 bg-white border border-slate-300 rounded-lg flex items-center justify-center font-bold text-slate-800" role="status" aria-live="polite" aria-label={`${extraPages} páginas adicionales seleccionadas`}>
                                        {extraPages}
                                    </div>
                                    <button
                                        onClick={() => setExtraPages(extraPages + 1)}
                                        className="w-10 h-10 bg-white border border-slate-300 rounded-lg flex items-center justify-center font-bold text-slate-700 hover:bg-slate-100 transition"
                                        aria-label="Aumentar número de páginas adicionales"
                                    >
                                        +
                                    </button>
                                </div>
                            </div>
                            <div className="mt-3 text-sm text-slate-600 bg-purple-50 p-3 rounded-lg border border-purple-100">
                                <strong className="text-purple-700">💡 Recomendación para León:</strong> Incluye página específica de tu zona (Barrio Húmedo, Centro Histórico) para conectar con clientes locales.
                            </div>
                        </div>

                        {/* Additional Services */}
                        <div className="mb-10">
                            <h3 className="text-xl font-semibold mb-4 text-slate-700">3. Servicios adicionales</h3>
                            <div className="grid md:grid-cols-2 gap-4">
                                {/* SEO Local */}
                                <label
                                    className={`p-5 rounded-xl border-2 cursor-pointer transition-all ${services.seo ? 'border-purple-400 bg-purple-50' : 'border-slate-200 hover:border-slate-300'
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
                                            <div className={`w-6 h-6 border-2 rounded-md flex items-center justify-center flex-shrink-0 ${services.seo ? 'border-purple-500 bg-purple-500' : 'border-slate-300'
                                                }`} aria-hidden="true">
                                                {services.seo && <Check className="w-4 h-4 text-white" />}
                                            </div>
                                            <div>
                                                <h4 className="font-bold text-slate-800">SEO Local León</h4>
                                                <p className="text-slate-300 text-sm">Optimización para búsquedas locales</p>
                                            </div>
                                        </div>
                                        <div className="text-right">
                                            <span className="font-bold text-blue-600">200€</span>
                                        </div>
                                    </div>
                                </label>

                                {/* Mantenimiento */}
                                <label
                                    className={`p-5 rounded-xl border-2 cursor-pointer transition-all ${services.mantenimiento ? 'border-purple-400 bg-purple-50' : 'border-slate-200 hover:border-slate-300'
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
                                            <div className={`w-6 h-6 border-2 rounded-md flex items-center justify-center flex-shrink-0 ${services.mantenimiento ? 'border-purple-500 bg-purple-500' : 'border-slate-300'
                                                }`} aria-hidden="true">
                                                {services.mantenimiento && <Check className="w-4 h-4 text-white" />}
                                            </div>
                                            <div>
                                                <h4 className="font-bold text-slate-800">Mantenimiento Web</h4>
                                                <p className="text-slate-300 text-sm">Seguridad, backups, actualizaciones</p>
                                            </div>
                                        </div>
                                        <div className="text-right">
                                            <span className="font-bold text-blue-600">39€</span>
                                            <span className="text-slate-500 text-sm ml-1">/mes</span>
                                        </div>
                                    </div>
                                </label>

                                {/* Diseño Gráfico */}
                                <label
                                    className={`p-5 rounded-xl border-2 cursor-pointer transition-all ${services.diseno ? 'border-purple-400 bg-purple-50' : 'border-slate-200 hover:border-slate-300'
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
                                            <div className={`w-6 h-6 border-2 rounded-md flex items-center justify-center flex-shrink-0 ${services.diseno ? 'border-purple-500 bg-purple-500' : 'border-slate-300'
                                                }`} aria-hidden="true">
                                                {services.diseno && <Check className="w-4 h-4 text-white" />}
                                            </div>
                                            <div>
                                                <h4 className="font-bold text-slate-800">Diseño Gráfico</h4>
                                                <p className="text-slate-300 text-sm">Logos, carteles, material promocional</p>
                                            </div>
                                        </div>
                                        <div className="text-right">
                                            <span className="font-bold text-blue-600">200€</span>
                                        </div>
                                    </div>
                                </label>

                                {/* React Islands */}
                                <label
                                    className={`p-5 rounded-xl border-2 cursor-pointer transition-all ${services.react ? 'border-purple-400 bg-purple-50' : 'border-slate-200 hover:border-slate-300'
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
                                            <div className={`w-6 h-6 border-2 rounded-md flex items-center justify-center flex-shrink-0 ${services.react ? 'border-purple-500 bg-purple-500' : 'border-slate-300'
                                                }`} aria-hidden="true">
                                                {services.react && <Check className="w-4 h-4 text-white" />}
                                            </div>
                                            <div>
                                                <h4 className="font-bold text-slate-800">Integración React</h4>
                                                <p className="text-slate-300 text-sm">Componentes interactivos en WordPress</p>
                                            </div>
                                        </div>
                                        <div className="text-right">
                                            <span className="font-bold text-blue-600">150€</span>
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
                                    className="w-5 h-5 text-purple-600 rounded"
                                    id="include-vat"
                                    aria-label="Incluir IVA del 21 por ciento en el presupuesto"
                                />
                                <div className="ml-3">
                                    <span className="text-slate-700 font-medium">Incluir IVA (21%) en el presupuesto</span>
                                    <p className="text-sm text-slate-500">Recomendado para pymes y autónomos</p>
                                </div>
                            </label>
                        </div>

                        {/* Calculate Button */}
                        <button
                            onClick={() => setShowResults(true)}
                            className="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold py-4 px-10 rounded-xl text-lg hover:shadow-lg hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2"
                        >
                            <Calculator className="w-5 h-5" />
                            Calcular Presupuesto
                        </button>
                    </div>

                    {/* Leon Info */}
                    <div className="mt-8 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-6 border border-blue-100">
                        <div className="flex flex-col md:flex-row gap-6">
                            <div className="flex-1">
                                <h3 className="text-xl font-bold mb-2 text-slate-800 flex items-center gap-2">
                                    <MapPin className="w-5 h-5 text-purple-600" />
                                    Especialistas web en León
                                </h3>
                                <p className="text-slate-700 mb-4">
                                    En empc.es diseñamos sitios web que conectan con el público leonés. Sabemos lo que funciona para negocios en el Barrio Húmedo, Centro Histórico y toda la provincia.
                                </p>
                                <div className="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    <div>
                                        <p className="font-semibold text-slate-800 text-sm">💰 Sin sorpresas</p>
                                        <p className="text-xs text-slate-600">Precios claros</p>
                                    </div>
                                    <div>
                                        <p className="font-semibold text-slate-800 text-sm">🚀 Rápidos</p>
                                        <p className="text-xs text-slate-600">Entregas 7-15 días</p>
                                    </div>
                                    <div>
                                        <p className="font-semibold text-slate-800 text-sm">🎧 Soporte local</p>
                                        <p className="text-xs text-slate-600">Asistencia en León</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Right: Results Sidebar */}
                <div className="lg:col-span-1">
                    <div className="sticky top-8 bg-white rounded-2xl shadow-xl border border-slate-200 p-6">
                        <h2 className="text-2xl font-bold mb-6 text-slate-800">Tu Presupuesto</h2>

                        {!showResults ? (
                            <div className="text-center py-12">
                                <div className="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <Calculator className="w-8 h-8 text-slate-300" />
                                </div>
                                <h3 className="text-xl font-bold text-slate-600 mb-2">Configura tu proyecto</h3>
                                <p className="text-slate-500">Selecciona las opciones y haz clic en "Calcular Presupuesto"</p>
                            </div>
                        ) : (
                            <div>
                                {/* Breakdown */}
                                <div className="mb-6">
                                    <h3 className="font-bold text-slate-700 mb-3 text-lg">Desglose del presupuesto</h3>
                                    <div className="space-y-3 mb-4">
                                        <div className="flex justify-between text-slate-600">
                                            <span>Proyecto base ({getProjectName()}):</span>
                                            <span className="font-medium">{basePrice}€</span>
                                        </div>
                                        {extraPages > 0 && (
                                            <div className="flex justify-between text-slate-600">
                                                <span>Páginas extra ({extraPages}):</span>
                                                <span className="font-medium">{extraPages * 15}€</span>
                                            </div>
                                        )}
                                        {services.seo && (
                                            <div className="flex justify-between text-slate-600">
                                                <span>SEO Local:</span>
                                                <span className="font-medium">{servicePrices.seo}€</span>
                                            </div>
                                        )}
                                        {services.mantenimiento && (
                                            <div className="flex justify-between text-slate-600">
                                                <span>Mantenimiento (primer mes):</span>
                                                <span className="font-medium">{servicePrices.mantenimiento}€</span>
                                            </div>
                                        )}
                                        {services.diseno && (
                                            <div className="flex justify-between text-slate-600">
                                                <span>Diseño gráfico:</span>
                                                <span className="font-medium">{servicePrices.diseno}€</span>
                                            </div>
                                        )}
                                        {services.react && (
                                            <div className="flex justify-between text-slate-600">
                                                <span>Integración React:</span>
                                                <span className="font-medium">{servicePrices.react}€</span>
                                            </div>
                                        )}
                                    </div>

                                    <div className="border-t border-slate-200 pt-3">
                                        <div className="flex justify-between text-slate-700">
                                            <span className="font-medium">Subtotal:</span>
                                            <span className="font-medium">{subtotal}€</span>
                                        </div>
                                        {includeVat && (
                                            <div className="flex justify-between text-slate-700 mt-2">
                                                <span>IVA (21%):</span>
                                                <span>{vat}€</span>
                                            </div>
                                        )}
                                        <div className="flex justify-between text-slate-800 text-xl font-bold mt-3 pt-3 border-t border-slate-200">
                                            <span>Total:</span>
                                            <span>{total}€</span>
                                        </div>
                                    </div>
                                </div>

                                {/* Monthly Cost */}
                                {monthlyCost > 0 && (
                                    <div className="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-100">
                                        <h4 className="font-bold text-slate-700 mb-1">Coste mensual de mantenimiento:</h4>
                                        <p className="text-2xl font-bold text-blue-600">{monthlyCost}€/mes</p>
                                        <p className="text-sm text-slate-600 mt-1">A partir del segundo mes</p>
                                    </div>
                                )}

                                {/* Timeline */}
                                <div className="mb-8">
                                    <h3 className="font-bold text-slate-700 mb-3">Plazo estimado</h3>
                                    <div className="flex items-center gap-4">
                                        <div className="bg-purple-100 text-purple-600 p-3 rounded-lg">
                                            <Clock className="w-5 h-5" />
                                        </div>
                                        <div>
                                            <p className="font-medium text-slate-800">{getTimeline()}</p>
                                            <p className="text-sm text-slate-600">Dependiendo de la complejidad</p>
                                        </div>
                                    </div>
                                </div>

                                {/* CTA */}
                                <a
                                    href={`/contacto?presupuesto=${total}&tipo=${projectType}`}
                                    className="block text-center bg-gradient-to-r from-blue-600 to-purple-600 text-white font-bold py-4 px-6 rounded-xl hover:shadow-lg hover:-translate-y-0.5 transition-all"
                                >
                                    🎁 Solicita tu auditoría gratis
                                </a>
                                <p className="text-slate-500 text-sm mt-3 text-center">
                                    Incluye análisis de competencia en León y recomendaciones personalizadas
                                </p>
                            </div>
                        )}
                    </div>
                </div>
            </div>

            {/* Leon-specific CTA */}
            <div className="mt-12 bg-gradient-to-r from-blue-50 to-purple-50 rounded-2xl p-8 border border-blue-100">
                <div className="max-w-3xl mx-auto text-center">
                    <h3 className="text-2xl font-bold text-slate-800 mb-4">¿Eres autónomo en León?</h3>
                    <p className="text-lg text-slate-700 mb-6">
                        Este presupuesto es <strong>100% deducible</strong>. Además, incluimos el alta en Google Maps gratis
                        para que te encuentren en el Barrio Húmedo desde el primer día.
                    </p>
                    < div className="flex flex-col sm:flex-row gap-4 justify-center">
                        <a
                            href="/contacto"
                            className="inline-flex items-center justify-center gap-2 bg-slate-800 text-white font-semibold py-3 px-6 rounded-lg hover:bg-slate-900 transition"
                        >
                            <Phone className="w-5 h-5" />
                            Consulta Personalizada
                        </a>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default PricingCalculator;

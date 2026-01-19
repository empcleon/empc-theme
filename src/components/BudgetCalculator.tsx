import React, { useState, useEffect } from 'react';
import { Calculator, Check, ArrowRight, Server, Search, PenTool, Calendar, ShoppingBag, Printer, Upload, Zap, MapPin, Utensils, Coffee, Store } from 'lucide-react';

// === Tipos & Configuración ===
interface CalculatorConfig {
    mode: string;
    types: ServiceType[];
    features: Feature[];
    basePrices: Record<string, number>;
}

interface ServiceType {
    id: 'service' | 'ecommerce' | 'printing_basic' | 'printing_pro' | 'restaurant_qr' | 'restaurant_full' | 'shop_catalog' | 'shop_full' | 'wpo_audit' | 'wpo_full';
    label: string;
    desc: string;
    icon: any;
    price: number;
}

interface Feature {
    id: string;
    label: string;
    desc: string;
    price: number;
    icon: any;
    highlight?: boolean; // Para destacar features específicas del nicho
}

const DEFAULT_CONFIG: CalculatorConfig = {
    mode: 'default',
    basePrices: {}, // Precios integrados en los tipos
    types: [
        { id: 'service', label: 'Web de Servicios', desc: 'Para clínicas, abogados, reformas...', icon: PenTool, price: 900 },
        { id: 'ecommerce', label: 'Tienda / Catálogo', desc: 'Venta online o catálogo B2B.', icon: ShoppingBag, price: 1800 }
    ],
    features: [
        { id: 'seo', label: 'SEO Local Pack', desc: 'Posicionamiento en Google (León).', price: 400, icon: Search },
        { id: 'writing', label: 'Redacción Profesional', desc: 'Textos persuasivos (Copywriting).', price: 300, icon: PenTool },
        { id: 'booking', label: 'Reservas / Cita Previa', desc: 'Calendario sincronizado.', price: 600, icon: Calendar }
    ]
};

// Configuraciones por Nicho
const MODE_CONFIGS: Record<string, Partial<CalculatorConfig>> = {
    'printing-niche': {
        types: [
            { id: 'printing_basic', label: 'Web Imprenta Básica', desc: 'Recepción de archivos y contacto.', icon: Printer, price: 1200 },
            { id: 'printing_pro', label: 'Imprenta Online Pro', desc: 'Calculadora de precios en tiempo real.', icon: ShoppingBag, price: 2500 }
        ],
        features: [
            { id: 'upload', label: 'Subida Archivos Pesados', desc: 'Integración nube para evitar correos.', price: 300, icon: Upload, highlight: true },
            { id: 'seo', label: 'SEO Local Imprentas', desc: 'Posicionamiento en León.', price: 400, icon: MapPin },
            { id: 'crm', label: 'Área Cliente / Estado', desc: 'Seguimiento de pedidos.', price: 800, icon: Server }
        ]
    },
    'restaurant-focus': {
        types: [
            { id: 'restaurant_qr', label: 'Carta Digital QR', desc: 'Menú interactivo y alérgenos.', icon: Utensils, price: 800 },
            { id: 'restaurant_full', label: 'Web Restaurante Pro', desc: 'Reservas y pedidos online.', icon: ShoppingBag, price: 2000 }
        ],
        features: [
            { id: 'booking', label: 'Motor de Reservas', desc: 'Sin comisiones por cubierto.', price: 500, icon: Calendar, highlight: true },
            { id: 'photo', label: 'Sesión Fotográfica', desc: 'Fotos profesionales de platos.', price: 300, icon: Upload },
            { id: 'seo', label: 'SEO Gastronómico', desc: 'Aparece en "Dónde comer León".', price: 450, icon: Search }
        ]
    },
    'local-shop-focus': {
        types: [
            { id: 'shop_catalog', label: 'Catálogo Click & Collect', desc: 'Reservar online, pagar en tienda.', icon: ShoppingBag, price: 1100 },
            { id: 'shop_full', label: 'E-commerce Completo', desc: 'Envíos a toda España + Pasarela.', icon: ShoppingBag, price: 2200 }
        ],
        features: [
            { id: 'whatsapp', label: 'Pedidos por WhatsApp', desc: 'Botón directo de pedido.', price: 150, icon: Check, highlight: true },
            { id: 'seo', label: 'SEO Comercio Local', desc: 'Ficha Google Maps optimizada.', price: 400, icon: MapPin },
            { id: 'loyalty', label: 'Fidelización', desc: 'Sistema de puntos básico.', price: 600, icon: Zap }
        ]
    },
    'performance-focus': {
        types: [
            { id: 'wpo_audit', label: 'Auditoría WPO Rápida', desc: 'Informe y arreglos básicos.', icon: Zap, price: 400 },
            { id: 'wpo_full', label: 'Optimización Completa', desc: 'Migración a React + Caché.', icon: Server, price: 1500 }
        ],
        features: [
            { id: 'hosting', label: 'Hosting NVMe León', desc: 'Migración a servidor rápido.', price: 200, icon: Server },
            { id: 'webp', label: 'Conversión WebP', desc: 'Optimización de imágenes.', price: 150, icon: Upload },
            { id: 'cdn', label: 'CDN Global', desc: 'Carga rápida desde cualquier lugar.', price: 300, icon: MapPin }
        ]
    },
    'local-seo-focus': { // Añadido para Post #2
        types: [
            { id: 'service', label: 'Web SEO Local', desc: 'Optimizada para Google Maps.', icon: MapPin, price: 1000 },
            { id: 'ecommerce', label: 'Tienda SEO', desc: 'E-commerce con estructura SEO.', icon: ShoppingBag, price: 1900 }
        ],
        features: [
            { id: 'seo', label: 'Pack SEO Mensual', desc: '3 primeros meses incluidos.', price: 900, icon: Search, highlight: true },
            { id: 'reviews', label: 'Gestión Reseñas', desc: 'Estrategia para ganar estrellas.', price: 200, icon: Check },
            { id: 'content', label: 'Blog Local', desc: '4 artículos sobre León.', price: 400, icon: PenTool }
        ]
    }
};


const BudgetCalculator = () => {
    // === Estados ===
    const [config, setConfig] = useState<CalculatorConfig>(DEFAULT_CONFIG);
    const [step, setStep] = useState(1);
    const [selectedType, setSelectedType] = useState<string | null>(null);
    const [selectedFeatures, setSelectedFeatures] = useState<string[]>([]);
    const [lead, setLead] = useState({ name: '', email: '' });
    const [status, setStatus] = useState<'idle' | 'submitting' | 'success' | 'error'>('idle');

    // === Inicialización (Bridge PHP -> React) ===
    useEffect(() => {
        // @ts-ignore
        const postConfig = window.empcData?.postConfig;

        if (postConfig && postConfig.island_data && postConfig.island_data.calculator_mode) {
            const mode = postConfig.island_data.calculator_mode;
            const modeConfig = MODE_CONFIGS[mode];

            if (modeConfig) {
                setConfig({
                    ...DEFAULT_CONFIG,
                    ...modeConfig,
                    mode: mode
                });
                console.log("BudgetCalculator: Mode switched to", mode);
            }
        }
    }, []);

    // === Lógica ===
    const toggleFeature = (id: string) => {
        setSelectedFeatures(prev =>
            prev.includes(id) ? prev.filter(f => f !== id) : [...prev, id]
        );
    };

    const calculateTotal = () => {
        let min = 0;

        // Precio Base del Tipo
        const typeObj = config.types.find(t => t.id === selectedType);
        if (typeObj) min += typeObj.price;

        // Precio Features
        selectedFeatures.forEach(fid => {
            const f = config.features.find(feat => feat.id === fid);
            if (f) min += f.price;
        });

        // Retornamos rango
        return { min, max: Math.round(min * 1.25 / 10) * 10 };
    };

    const est = calculateTotal();

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setStatus('submitting');
        const typeLabel = config.types.find(t => t.id === selectedType)?.label || selectedType;

        const payload = {
            name: lead.name,
            email: lead.email,
            budget_data: {
                type: typeLabel,
                features: selectedFeatures, // Enviamos IDs, el backend puede mapearlos si quiere textos
                estimated_range: est,
                mode: config.mode // Enviamos el modo para contexto
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

            if (res.ok) setStatus('success');
            else setStatus('error');
        } catch (err) {
            console.error(err);
            setStatus('error');
        }
    };

    // === Render ===
    if (status === 'success') {
        return (
            <div className="bg-emerald-900/50 p-8 rounded-xl border border-emerald-500/30 text-center animate-fade-in">
                <div className="w-16 h-16 bg-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <Check className="w-8 h-8 text-emerald-400" />
                </div>
                <h3 className="text-2xl font-bold text-white mb-2">¡Presupuesto Enviado!</h3>
                <p className="text-emerald-200 mb-6">Hemos enviado los detalles a <strong>{lead.email}</strong>.</p>
                <div className="text-white bg-slate-800 p-4 rounded-lg inline-block">
                    <span className="text-slate-400 text-sm block">Tu rango estimado</span>
                    <span className="text-3xl font-bold text-emerald-400">{est.min}€ - {est.max}€</span>
                </div>
            </div>
        );
    }

    return (
        <div className="bg-slate-900/80 backdrop-blur-md rounded-xl p-6 md:p-8 border border-slate-700 shadow-2xl relative overflow-hidden transition-all duration-500">
            {/* Header del Modo */}
            {config.mode !== 'default' && (
                <div className="absolute top-0 right-0 bg-rose-500 text-white text-xs font-bold px-3 py-1 rounded-bl-lg">
                    Modo: {config.mode.replace(/-/g, ' ').toUpperCase()}
                </div>
            )}

            {/* Progress Bar */}
            <div className="flex gap-2 mb-8 mt-2">
                {[1, 2, 3].map(i => (
                    <div key={i} className={`h-1 flex-1 rounded-full transition-all ${step >= i ? 'bg-rose-500' : 'bg-slate-700'}`} />
                ))}
            </div>

            {/* Step 1: Tipo de Proyecto */}
            {step === 1 && (
                <div className="space-y-6 animate-fade-in">
                    <h3 className="text-xl font-bold text-white text-center">¿Qué necesitas implementar?</h3>
                    <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {config.types.map(t => {
                            const Icon = t.icon;
                            return (
                                <button
                                    key={t.id}
                                    onClick={() => { setSelectedType(t.id); setStep(2); }}
                                    className="p-6 rounded-xl border border-slate-700 bg-slate-800/50 hover:border-rose-500 hover:bg-slate-800 transition-all text-left group"
                                >
                                    <div className="bg-rose-500/10 w-12 h-12 rounded-lg flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                        <Icon className="text-rose-500" />
                                    </div>
                                    <h4 className="font-bold text-white mb-1">{t.label}</h4>
                                    <p className="text-sm text-slate-400">{t.desc}</p>
                                    <div className="mt-3 text-xs font-bold text-rose-400">Desde {t.price}€</div>
                                </button>
                            );
                        })}
                    </div>
                </div>
            )}

            {/* Step 2: Extras / Features */}
            {step === 2 && (
                <div className="space-y-6 animate-fade-in">
                    <h3 className="text-xl font-bold text-white text-center">Funcionalidades Específicas</h3>
                    <div className="grid grid-cols-1 gap-3">
                        {config.features.map(f => {
                            const Icon = f.icon;
                            const isSelected = selectedFeatures.includes(f.id);
                            return (
                                <label key={f.id} className={`flex items-center p-4 rounded-lg border cursor-pointer transition-all ${isSelected ? 'border-rose-500 bg-rose-500/10' : 'border-slate-700 hover:bg-slate-800'}`}>
                                    <input type="checkbox" className="hidden" checked={isSelected} onChange={() => toggleFeature(f.id)} />
                                    <div className="mr-3"><Icon className={isSelected ? 'text-rose-400' : 'text-slate-500'} /></div>
                                    <div className="flex-1">
                                        <span className="text-white font-medium block">
                                            {f.label}
                                            {f.highlight && <span className="ml-2 text-[10px] bg-rose-600/20 text-rose-300 px-2 py-0.5 rounded-full">Recomendado</span>}
                                        </span>
                                        <span className="text-xs text-slate-400">{f.desc}</span>
                                    </div>
                                    <div className="text-sm font-bold text-slate-300 mr-2">+{f.price}€</div>
                                    {isSelected && <Check className="text-rose-500 w-5 h-5" />}
                                </label>
                            );
                        })}
                    </div>

                    <div className="flex justify-between pt-4">
                        <button onClick={() => setStep(1)} className="text-slate-400 hover:text-white transition-colors">Atrás</button>
                        <button
                            onClick={() => setStep(3)}
                            className="bg-white text-slate-900 px-6 py-2 rounded-lg font-bold hover:bg-slate-200 transition-colors flex items-center"
                        >
                            Ver Estimación <ArrowRight className="inline w-4 h-4 ml-1" />
                        </button>
                    </div>
                </div>
            )}

            {/* Step 3: Resultado y Captación */}
            {step === 3 && (
                <div className="text-center animate-fade-in space-y-6">
                    <div>
                        <span className="text-slate-400 text-sm uppercase tracking-wider">Inversión Estimada (León)</span>
                        <div className="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-rose-400 to-orange-400 my-2">
                            {est.min}€ - {est.max}€
                        </div>
                        <p className="text-slate-400 text-sm max-w-xs mx-auto">
                            IVA no incluido. Presupuesto válido por 15 días.
                        </p>
                    </div>

                    <form onSubmit={handleSubmit} className="bg-slate-800/50 p-6 rounded-xl border border-slate-700 text-left">
                        <h4 className="text-white font-bold mb-4">¿Quieres esta propuesta en PDF?</h4>
                        <div className="space-y-4">
                            <input
                                type="text"
                                required
                                className="w-full bg-slate-900 border border-slate-700 rounded-lg p-3 text-white focus:border-rose-500 focus:outline-none"
                                placeholder="Tu Nombre o Empresa"
                                value={lead.name}
                                onChange={e => setLead({ ...lead, name: e.target.value })}
                            />
                            <input
                                type="email"
                                required
                                className="w-full bg-slate-900 border border-slate-700 rounded-lg p-3 text-white focus:border-rose-500 focus:outline-none"
                                placeholder="Email Profesional"
                                value={lead.email}
                                onChange={e => setLead({ ...lead, email: e.target.value })}
                            />
                            <button
                                type="submit"
                                disabled={status === 'submitting'}
                                className="w-full bg-rose-600 hover:bg-rose-500 text-white font-bold py-3 rounded-lg transition-all disabled:opacity-50"
                            >
                                {status === 'submitting' ? 'Procesando...' : 'Recibir Propuesta Detallada'}
                            </button>
                        </div>
                    </form>
                    <button onClick={() => setStep(2)} className="text-slate-500 hover:text-white text-sm">Volver a editar configuración</button>
                </div>
            )}
        </div>
    );
};

export default BudgetCalculator;

import React, { useState } from 'react';
import {
    MapPin,
    Activity,
    Users,
    DollarSign,
    Info,
    AlertTriangle,
} from 'lucide-react';

type PositionKey = 'no_pack' | 'pack_3' | 'pack_2' | 'pack_1';

interface DefaultValues {
    monthlySearches: number;
    conversionRate: number; // 0–1
    avgTicket: number;
    currentPosition: PositionKey;
}

export interface LocalPackSimulatorProps {
    title: string;
    subtitle: string;
    description: string;
    defaultValues: DefaultValues;
    notes?: string[];
}

const CTR_BY_POSITION: Record<PositionKey, number> = {
    no_pack: 0.01, // 1% clics orgánicos marginales
    pack_3: 0.06,  // 6%
    pack_2: 0.10,  // 10%
    pack_1: 0.18,  // 18%
};

function formatCurrency(value: number): string {
    return new Intl.NumberFormat('es-ES', {
        style: 'currency',
        currency: 'EUR',
        maximumFractionDigits: 0,
    }).format(value);
}

export function LocalPackSimulator({
    title,
    subtitle,
    description,
    defaultValues,
    notes = [],
}: LocalPackSimulatorProps) {
    const [monthlySearches, setMonthlySearches] = useState<number>(
        defaultValues.monthlySearches,
    );
    const [conversionRate, setConversionRate] = useState<number>(
        defaultValues.conversionRate * 100, // en %
    );
    const [avgTicket, setAvgTicket] = useState<number>(defaultValues.avgTicket);
    const [currentPosition, setCurrentPosition] = useState<PositionKey>(
        defaultValues.currentPosition,
    );

    const currentCtr = CTR_BY_POSITION[currentPosition];
    const topCtr = CTR_BY_POSITION.pack_1;

    const currentClicks = monthlySearches * currentCtr;
    const topClicks = monthlySearches * topCtr;

    const currentLeads = currentClicks * (conversionRate / 100);
    const topLeads = topClicks * (conversionRate / 100);

    const currentRevenue = currentLeads * avgTicket;
    const topRevenue = topLeads * avgTicket;

    const extraLeads = Math.max(0, topLeads - currentLeads);
    const extraRevenue = Math.max(0, topRevenue - currentRevenue);

    return (
        <section id="simulador-local-pack" className="py-24 bg-slate-900">
            <div className="max-w-5xl mx-auto px-4 sm:px-6">
                {/* Header */}
                <div className="text-center mb-10">
                    <span className="inline-flex items-center gap-2 text-emerald-400 text-sm font-medium tracking-widest uppercase">
                        <MapPin className="w-4 h-4" />
                        Simulador SEO Local
                    </span>
                    <h2 className="text-3xl md:text-4xl font-bold text-white mt-3 mb-2">
                        {title}
                    </h2>
                    <p className="text-emerald-100 mb-4">{subtitle}</p>
                    <p
                        className="text-slate-300 max-w-2xl mx-auto text-sm md:text-base"
                        dangerouslySetInnerHTML={{ __html: description }}
                    />
                </div>

                {/* Card */}
                <div className="bg-slate-800 border border-slate-700 rounded-2xl p-6 md:p-8 shadow-xl">
                    <div className="grid md:grid-cols-[minmax(0,1.1fr)_minmax(0,1.1fr)] gap-8">
                        {/* Controles */}
                        <div>
                            <h3 className="text-white font-semibold mb-4 flex items-center gap-2">
                                <Activity className="w-5 h-5 text-emerald-400" />
                                Datos de tu mercado local
                            </h3>

                            {/* Búsquedas mensuales */}
                            <div className="mb-5">
                                <label className="block text-sm text-slate-300 mb-2">
                                    Búsquedas mensuales de tu servicio en tu zona
                                </label>
                                <input
                                    type="number"
                                    min={50}
                                    max={20000}
                                    value={monthlySearches}
                                    onChange={(e) =>
                                        setMonthlySearches(Number(e.target.value) || 0)
                                    }
                                    className="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
                                />
                                <p className="text-xs text-slate-500 mt-1">
                                    Puedes estimarlo con Google Keyword Planner o de forma
                                    aproximada.
                                </p>
                            </div>

                            {/* Conversión */}
                            <div className="mb-5">
                                <label className="block text-sm text-slate-300 mb-2">
                                    Porcentaje de visitas que acaban siendo clientes (%)
                                </label>
                                <input
                                    type="number"
                                    min={1}
                                    max={50}
                                    step={1}
                                    value={conversionRate}
                                    onChange={(e) =>
                                        setConversionRate(Number(e.target.value) || 0)
                                    }
                                    className="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
                                />
                                <p className="text-xs text-slate-500 mt-1">
                                    Muchos negocios locales convierten entre un 5% y un 20% de las
                                    visitas en clientes.
                                </p>
                            </div>

                            {/* Ticket medio */}
                            <div className="mb-5">
                                <label className="block text-sm text-slate-300 mb-2">
                                    Ticket medio por cliente (€)
                                </label>
                                <input
                                    type="number"
                                    min={10}
                                    max={2000}
                                    step={10}
                                    value={avgTicket}
                                    onChange={(e) => setAvgTicket(Number(e.target.value) || 0)}
                                    className="w-full bg-slate-900 border border-slate-700 rounded-xl px-3 py-2 text-white text-sm focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 outline-none"
                                />
                            </div>

                            {/* Posición actual */}
                            <div className="mb-2">
                                <label className="block text-sm text-slate-300 mb-2">
                                    Situación actual aproximada
                                </label>
                                <div className="grid grid-cols-2 gap-2 text-xs">
                                    <button
                                        type="button"
                                        onClick={() => setCurrentPosition('no_pack')}
                                        className={`px-3 py-2 rounded-xl border ${currentPosition === 'no_pack'
                                                ? 'border-emerald-500 bg-emerald-500/10 text-emerald-300'
                                                : 'border-slate-700 bg-slate-900 text-slate-300 hover:border-slate-600'
                                            }`}
                                    >
                                        No salgo en el bloque del mapa
                                    </button>
                                    <button
                                        type="button"
                                        onClick={() => setCurrentPosition('pack_3')}
                                        className={`px-3 py-2 rounded-xl border ${currentPosition === 'pack_3'
                                                ? 'border-emerald-500 bg-emerald-500/10 text-emerald-300'
                                                : 'border-slate-700 bg-slate-900 text-slate-300 hover:border-slate-600'
                                            }`}
                                    >
                                        Salgo, pero 2º-3º en el mapa
                                    </button>
                                    <button
                                        type="button"
                                        onClick={() => setCurrentPosition('pack_2')}
                                        className={`px-3 py-2 rounded-xl border ${currentPosition === 'pack_2'
                                                ? 'border-emerald-500 bg-emerald-500/10 text-emerald-300'
                                                : 'border-slate-700 bg-slate-900 text-slate-300 hover:border-slate-600'
                                            }`}
                                    >
                                        Muy visible en el bloque (2º)
                                    </button>
                                    <button
                                        type="button"
                                        onClick={() => setCurrentPosition('pack_1')}
                                        className={`px-3 py-2 rounded-xl border ${currentPosition === 'pack_1'
                                                ? 'border-emerald-500 bg-emerald-500/10 text-emerald-300'
                                                : 'border-slate-700 bg-slate-900 text-slate-300 hover:border-slate-600'
                                            }`}
                                    >
                                        Ya soy el #1 del mapa
                                    </button>
                                </div>
                            </div>
                            <p className="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                <Info className="w-3 h-3" />
                                Si no estás seguro, busca tu negocio en incógnito sin estar
                                logueado en Google.
                            </p>
                        </div>

                        {/* Resultados */}
                        <div>
                            <h3 className="text-white font-semibold mb-4 flex items-center gap-2">
                                <Users className="w-5 h-5 text-emerald-400" />
                                Resultados estimados
                            </h3>

                            <div className="grid gap-4 mb-4">
                                {/* Situación actual */}
                                <div className="bg-slate-900 rounded-xl p-4 border border-slate-700">
                                    <p className="text-xs uppercase tracking-wider text-slate-500 mb-2">
                                        Situación actual
                                    </p>
                                    <div className="flex items-center justify-between mb-3">
                                        <div>
                                            <p className="text-2xl font-bold text-white">
                                                {currentLeads.toFixed(1)}{' '}
                                                <span className="text-sm font-normal text-slate-400">
                                                    clientes/mes
                                                </span>
                                            </p>
                                            <p className="text-slate-400 text-sm">
                                                {formatCurrency(currentRevenue)} / mes
                                            </p>
                                        </div>
                                        <div className="flex items-center gap-2 text-xs text-slate-500">
                                            <Activity className="w-4 h-4" />
                                            CTR aprox. {(currentCtr * 100).toFixed(1)}%
                                        </div>
                                    </div>
                                </div>

                                {/* Posición #1 Local Pack */}
                                <div className="bg-emerald-500/10 rounded-xl p-4 border border-emerald-500/40">
                                    <p className="text-xs uppercase tracking-wider text-emerald-300 mb-2">
                                        Si fueras #1 en el Local Pack
                                    </p>
                                    <div className="flex items-center justify-between mb-3">
                                        <div>
                                            <p className="text-2xl font-bold text-emerald-300">
                                                {topLeads.toFixed(1)}{' '}
                                                <span className="text-sm font-normal text-emerald-100">
                                                    clientes/mes
                                                </span>
                                            </p>
                                            <p className="text-emerald-100 text-sm">
                                                {formatCurrency(topRevenue)} / mes
                                            </p>
                                        </div>
                                        <div className="flex items-center gap-2 text-xs text-emerald-200">
                                            <MapPin className="w-4 h-4" />
                                            CTR aprox. {(topCtr * 100).toFixed(1)}%
                                        </div>
                                    </div>
                                </div>

                                {/* Diferencia */}
                                <div className="bg-slate-900 rounded-xl p-4 border border-slate-700">
                                    <p className="text-xs uppercase tracking-wider text-slate-500 mb-2">
                                        Diferencia potencial
                                    </p>
                                    <div className="grid grid-cols-2 gap-4">
                                        <div className="flex items-center gap-2">
                                            <Users className="w-5 h-5 text-emerald-400" />
                                            <div>
                                                <p className="text-lg font-semibold text-white">
                                                    +{extraLeads.toFixed(1)}
                                                </p>
                                                <p className="text-xs text-slate-400">
                                                    clientes/mes
                                                </p>
                                            </div>
                                        </div>
                                        <div className="flex items-center gap-2">
                                            <DollarSign className="w-5 h-5 text-emerald-400" />
                                            <div>
                                                <p className="text-lg font-semibold text-white">
                                                    {formatCurrency(extraRevenue)}
                                                </p>
                                                <p className="text-xs text-slate-400">
                                                    ingreso extra / mes
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {notes.length > 0 && (
                                <div className="mt-4 bg-slate-900/70 rounded-xl p-4 border border-slate-700 flex gap-3">
                                    <AlertTriangle className="w-5 h-5 text-amber-400 flex-shrink-0 mt-0.5" />
                                    <div className="text-xs text-slate-400 space-y-1">
                                        {notes.map((note, index) => (
                                            <p key={index}>{note}</p>
                                        ))}
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>

                    {/* CTA interna */}
                    <div className="mt-8 text-center">
                        <p className="text-slate-300 text-sm mb-3">
                            Si quieres, puedo hacer estos cálculos con datos reales de tu
                            sector en León.
                        </p>
                        <a
                            href="#presupuesto"
                            className="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-emerald-950 px-6 py-3 rounded-xl text-sm font-semibold transition"
                        >
                            Analizar mi caso
                        </a>
                    </div>
                </div>
            </div>
        </section>
    );
}

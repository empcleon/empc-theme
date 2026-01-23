import React from 'react';

interface ProcessStep {
    number: string;
    title: string;
    duration: string;
    description: string;
    deliverables: string[];
}

export interface EcommerceProcessProps {
    badge: string;
    title: string;
    description: string;
    steps: ProcessStep[];
    theme?: 'emerald' | 'blue' | 'purple';
}

export function EcommerceProcess({
    badge,
    title,
    description,
    steps,
    theme = 'emerald'
}: EcommerceProcessProps) {
    const accentColor = theme;

    return (
        <section id="proceso" className="py-24 bg-slate-800">
            <div className="max-w-7xl mx-auto px-4 sm:px-6">
                {/* Header */}
                <div className="text-center mb-16">
                    <span className={`text-${accentColor}-400 font-medium tracking-widest uppercase text-sm`}>
                        {badge}
                    </span>
                    <h2 className="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">
                        {title}
                    </h2>
                    <p className="text-slate-300 max-w-2xl mx-auto text-lg">
                        {description}
                    </p>
                </div>

                {/* Timeline */}
                <div className="relative">
                    {/* Connector Line (Desktop) */}
                    <div className={`hidden lg:block absolute top-12 left-0 right-0 h-0.5 bg-gradient-to-r from-${accentColor}-500 via-teal-500 to-cyan-500 opacity-30`} />

                    <div className="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {steps.map((step, index) => (
                            <div key={index} className="relative">
                                {/* Step Number */}
                                <div className={`w-16 h-16 bg-gradient-to-br from-${accentColor}-500 to-teal-500 rounded-2xl flex items-center justify-center text-white font-bold text-xl mb-6 shadow-lg shadow-${accentColor}-500/20`}>
                                    {step.number}
                                </div>

                                {/* Content */}
                                <div className="bg-slate-900 border border-slate-700 rounded-xl p-6">
                                    <div className="flex items-center justify-between mb-3">
                                        <h3 className="text-lg font-bold text-white">{step.title}</h3>
                                        <span className={`text-${accentColor}-400 text-xs font-medium bg-${accentColor}-400/10 px-2 py-1 rounded`}>
                                            {step.duration}
                                        </span>
                                    </div>
                                    <p className="text-slate-300 text-sm mb-4">{step.description}</p>

                                    {/* Deliverables */}
                                    <div>
                                        <p className="text-xs uppercase tracking-wider text-slate-500 mb-2">
                                            Entregables:
                                        </p>
                                        <div className="flex flex-wrap gap-2">
                                            {step.deliverables.map((deliverable, dIndex) => (
                                                <span
                                                    key={dIndex}
                                                    className="text-xs bg-slate-800 text-slate-300 px-2 py-1 rounded"
                                                >
                                                    {deliverable}
                                                </span>
                                            ))}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>
            </div>
        </section>
    );
}

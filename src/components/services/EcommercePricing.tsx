import React from 'react';
import { Check, X, ArrowRight } from 'lucide-react';

interface Plan {
    name: string;
    price: string;
    currency: string;
    period?: string | null;
    description: string;
    productLimit: string;
    featured: boolean;
    badge?: string;
    features: string[];
    notIncluded: string[];
    idealFor: string;
    cta: { text: string; href: string };
}

export interface EcommercePricingProps {
    badge: string;
    title: string;
    description: string;
    plans: Plan[];
    note: string;
    theme?: 'emerald' | 'blue' | 'purple';
}

export function EcommercePricing({
    badge,
    title,
    description,
    plans,
    note,
    theme = 'emerald'
}: EcommercePricingProps) {
    const accentColor = theme;

    return (
        <section id="planes" className="py-24 bg-gradient-to-b from-slate-800 to-slate-900">
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

                {/* Plans Grid */}
                <div className="grid lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                    {plans.map((plan, index) => (
                        <div
                            key={index}
                            className={`relative bg-slate-900 rounded-2xl overflow-hidden border flex flex-col ${plan.featured
                                    ? `border-${accentColor}-500 ring-2 ring-${accentColor}-500/20`
                                    : 'border-slate-700'
                                }`}
                        >
                            {/* Featured Badge */}
                            {plan.featured && plan.badge && (
                                <div className={`bg-gradient-to-r from-${accentColor}-500 to-teal-500 text-white text-center py-2 text-sm font-bold`}>
                                    {plan.badge}
                                </div>
                            )}

                            <div className="p-8 flex-1 flex flex-col">
                                {/* Plan Header */}
                                <div className="mb-6">
                                    <h3 className="text-2xl font-bold text-white mb-1">{plan.name}</h3>
                                    <p className="text-slate-300 text-sm">{plan.description}</p>
                                </div>

                                {/* Price */}
                                <div className="mb-6 pb-6 border-b border-slate-700">
                                    <div className="flex items-baseline gap-1">
                                        <span className="text-4xl font-bold text-white">{plan.price}</span>
                                        {!plan.price.includes('Desde') && (
                                            <span className="text-slate-300">{plan.currency}</span>
                                        )}
                                    </div>
                                    <p className={`text-${accentColor}-400 text-sm mt-1`}>{plan.productLimit}</p>
                                </div>

                                {/* Features */}
                                <div className="flex-1">
                                    <p className="text-xs uppercase tracking-wider text-slate-500 mb-4">Incluye:</p>
                                    <ul className="space-y-3 mb-6">
                                        {plan.features.map((feature, fIndex) => (
                                            <li key={fIndex} className="flex items-start gap-3 text-sm">
                                                <Check className={`w-5 h-5 text-${accentColor}-400 flex-shrink-0 mt-0.5`} />
                                                <span className="text-slate-300">{feature}</span>
                                            </li>
                                        ))}
                                    </ul>

                                    {plan.notIncluded.length > 0 && (
                                        <>
                                            <p className="text-xs uppercase tracking-wider text-slate-500 mb-4">No incluye:</p>
                                            <ul className="space-y-2 mb-6">
                                                {plan.notIncluded.map((item, nIndex) => (
                                                    <li key={nIndex} className="flex items-start gap-3 text-sm">
                                                        <X className="w-5 h-5 text-slate-600 flex-shrink-0 mt-0.5" />
                                                        <span className="text-slate-500">{item}</span>
                                                    </li>
                                                ))}
                                            </ul>
                                        </>
                                    )}
                                </div>

                                {/* Ideal For */}
                                <div className="bg-slate-800 rounded-lg p-4 mb-6">
                                    <p className="text-xs uppercase tracking-wider text-slate-500 mb-1">Ideal para:</p>
                                    <p className="text-slate-300 text-sm">{plan.idealFor}</p>
                                </div>

                                {/* CTA */}
                                <a
                                    href={plan.cta.href}
                                    className={`block text-center py-4 rounded-xl font-semibold transition-all ${plan.featured
                                            ? `bg-gradient-to-r from-${accentColor}-500 to-teal-500 hover:from-${accentColor}-400 hover:to-teal-400 text-white shadow-lg shadow-${accentColor}-500/25`
                                            : 'bg-slate-800 hover:bg-slate-700 text-white border border-slate-600'
                                        }`}
                                >
                                    {plan.cta.text}
                                </a>
                            </div>
                        </div>
                    ))}
                </div>

                {/* Note */}
                <div className="text-center mt-10 space-y-2">
                    <p className="text-slate-500 text-sm">{note}</p>
                    <p className="text-slate-300">
                        ¿Proyecto especial?{' '}
                        <a href="#presupuesto" className={`text-${accentColor}-400 hover:underline`}>
                            Cuéntamelo
                        </a>
                    </p>
                </div>
            </div>
        </section>
    );
}

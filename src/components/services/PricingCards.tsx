import React from 'react';
import { Check } from 'lucide-react';

export interface PricingTier {
    title: string;
    price: string;
    description: string;
    features: string[];
    highlighted?: boolean;
    badge?: string;
    idealFor: string;
    ctaText: string;
    ctaHref: string;
}

export interface PricingCardsProps {
    title: string;
    subtitle: string;
    description?: string;
    tiers: PricingTier[];
    note?: string;
}

const PricingCards: React.FC<PricingCardsProps> = ({
    title,
    subtitle,
    description,
    tiers,
    note
}) => {
    return (
        <section className="py-24 bg-slate-800" id="servicios">
            <div className="max-w-7xl mx-auto px-4 sm:px-6">
                <div className="text-center mb-16">
                    <span className="text-blue-400 font-medium tracking-widest uppercase text-sm">{subtitle}</span>
                    <h2 className="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">
                        {title}
                    </h2>
                    {description && (
                        <p className="text-slate-400 max-w-2xl mx-auto text-lg">
                            {description}
                        </p>
                    )}
                </div>

                <div className="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                    {tiers.map((tier, index) => (
                        <div
                            key={index}
                            className={`relative bg-slate-900 rounded-2xl p-8 border ${tier.highlighted
                                    ? 'border-blue-500 scale-105 shadow-2xl shadow-blue-500/20'
                                    : 'border-slate-700'
                                } flex flex-col`}
                        >
                            {tier.badge && (
                                <div className="absolute -top-4 left-1/2 -translate-x-1/2 bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-bold">
                                    {tier.badge}
                                </div>
                            )}

                            <h3 className="text-xl font-bold text-white mb-2">{tier.title}</h3>
                            <p className="text-slate-400 text-sm mb-4">{tier.description}</p>

                            <div className="mb-6">
                                <span className="text-3xl font-bold text-white">{tier.price}</span>
                            </div>

                            <ul className="space-y-3 mb-8 flex-1">
                                {tier.features.map((feature, idx) => (
                                    <li key={idx} className="flex items-start gap-2 text-slate-300 text-sm">
                                        <Check className="w-5 h-5 text-green-400 flex-shrink-0 mt-0.5" />
                                        <span>{feature}</span>
                                    </li>
                                ))}
                            </ul>

                            <div className="bg-slate-800 rounded-lg p-3 mb-6">
                                <p className="text-xs text-slate-500 uppercase tracking-wider mb-1">Ideal para</p>
                                <p className="text-slate-300 text-sm">{tier.idealFor}</p>
                            </div>

                            <a
                                href={tier.ctaHref}
                                className={`block text-center py-3 rounded-xl font-semibold transition ${tier.highlighted
                                        ? 'bg-blue-600 hover:bg-blue-500 text-white shadow-lg'
                                        : 'bg-slate-800 hover:bg-slate-700 text-white border border-slate-600'
                                    }`}
                            >
                                {tier.ctaText}
                            </a>
                        </div>
                    ))}
                </div>

                {note && (
                    <p className="text-center text-slate-500 mt-8 text-sm">
                        {note}
                    </p>
                )}
            </div>
        </section>
    );
};

export default PricingCards;

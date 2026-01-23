import React from 'react';
import { Check, AlertTriangle, ArrowRight } from 'lucide-react';

interface Platform {
    name: string;
    logo: string;
    tagline: string;
    pros: string[];
    cons: string[];
    idealFor: string;
    logoBgColor?: string; // Optional custom background for logo if needed
}

export interface PlatformCardsProps {
    badge: string;
    title: string;
    description: string;
    items: Platform[];
    cta: { text: string; href: string };
    theme?: 'emerald' | 'blue' | 'purple';
}

export function PlatformCards({
    badge,
    title,
    description,
    items,
    cta,
    theme = 'emerald'
}: PlatformCardsProps) {
    const accentColor = theme;

    // Platform logo components
    const platformLogos: Record<string, React.ReactNode> = {
        woocommerce: (
            <div className="w-14 h-14 bg-purple-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">
                WC
            </div>
        ),
        shopify: (
            <div className="w-14 h-14 bg-green-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">
                S
            </div>
        ),
        prestashop: (
            <div className="w-14 h-14 bg-pink-600 rounded-xl flex items-center justify-center text-white font-bold text-xl">
                PS
            </div>
        )
    };

    return (
        <section className="py-24 bg-slate-900">
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

                {/* Platforms Grid */}
                <div className="grid md:grid-cols-3 gap-8">
                    {items.map((platform, index) => (
                        <div
                            key={index}
                            className={`bg-slate-800 border border-slate-700 rounded-2xl p-8 hover:border-${accentColor}-500/30 transition-all`}
                        >
                            {/* Logo & Name */}
                            <div className="flex items-center gap-4 mb-6 pb-6 border-b border-slate-700">
                                {platformLogos[platform.logo.toLowerCase()] || (
                                    <div className="w-14 h-14 bg-slate-700 rounded-xl flex items-center justify-center text-white font-bold text-xl">
                                        {platform.name[0]}
                                    </div>
                                )}
                                <div>
                                    <h3 className="text-xl font-bold text-white">{platform.name}</h3>
                                    <p className="text-slate-300 text-sm">{platform.tagline}</p>
                                </div>
                            </div>

                            {/* Pros */}
                            <div className="mb-6">
                                <p className={`text-xs uppercase tracking-wider text-${accentColor}-400 mb-3`}>
                                    ✓ Ventajas
                                </p>
                                <ul className="space-y-2">
                                    {platform.pros.map((pro, pIndex) => (
                                        <li key={pIndex} className="flex items-center gap-2 text-sm text-slate-300">
                                            <Check className={`w-4 h-4 text-${accentColor}-400`} />
                                            {pro}
                                        </li>
                                    ))}
                                </ul>
                            </div>

                            {/* Cons */}
                            <div className="mb-6">
                                <p className="text-xs uppercase tracking-wider text-amber-400 mb-3">
                                    ⚠ A tener en cuenta
                                </p>
                                <ul className="space-y-2">
                                    {platform.cons.map((con, cIndex) => (
                                        <li key={cIndex} className="flex items-center gap-2 text-sm text-slate-300">
                                            <AlertTriangle className="w-4 h-4 text-amber-400" />
                                            {con}
                                        </li>
                                    ))}
                                </ul>
                            </div>

                            {/* Ideal For */}
                            <div className="bg-slate-900 rounded-lg p-4">
                                <p className="text-xs uppercase tracking-wider text-slate-500 mb-1">
                                    Recomendado para:
                                </p>
                                <p className="text-slate-300 text-sm">{platform.idealFor}</p>
                            </div>
                        </div>
                    ))}
                </div>

                {/* CTA */}
                <div className="text-center mt-12">
                    <p className="text-slate-300 mb-4">¿No sabes cuál elegir?</p>
                    <a
                        href={cta.href}
                        className={`inline-flex items-center gap-2 text-${accentColor}-400 hover:text-${accentColor}-300 font-medium`}
                    >
                        {cta.text}
                        <ArrowRight className="w-4 h-4" />
                    </a>
                </div>
            </div>
        </section>
    );
}

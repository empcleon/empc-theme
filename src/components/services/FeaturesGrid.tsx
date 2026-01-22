import React from 'react';
import * as LucideIcons from 'lucide-react';

interface Feature {
    icon: string;
    title: string;
    description: string;
}

export interface FeaturesGridProps {
    badge: string;
    title: string;
    description: string;
    items: Feature[];
    columns?: 3 | 4;
    theme?: 'emerald' | 'blue' | 'purple';
}

export function FeaturesGrid({
    badge,
    title,
    description,
    items,
    columns = 4,
    theme = 'emerald'
}: FeaturesGridProps) {
    const accentColor = theme;
    const gridCols = columns === 3
        ? 'sm:grid-cols-2 lg:grid-cols-3'
        : 'sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4';

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
                    <p className="text-slate-400 max-w-2xl mx-auto text-lg">
                        {description}
                    </p>
                </div>

                {/* Grid */}
                <div className={`grid ${gridCols} gap-6`}>
                    {items.map((feature, index) => {
                        // Dynamic icon loading
                        const iconName = feature.icon
                            .split('-')
                            .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                            .join('') as keyof typeof LucideIcons;
                        const IconComponent = LucideIcons[iconName] || LucideIcons.Sparkles;

                        return (
                            <div
                                key={index}
                                className={`bg-slate-800/50 border border-slate-700 rounded-xl p-6 hover:border-${accentColor}-500/30 hover:bg-slate-800 transition-all group`}
                            >
                                <div className={`text-4xl mb-4 group-hover:scale-110 transition-transform text-${accentColor}-400`}>
                                    <IconComponent className="w-10 h-10" />
                                </div>
                                <h3 className="text-lg font-bold text-white mb-2">
                                    {feature.title}
                                </h3>
                                <p className="text-slate-400 text-sm leading-relaxed">
                                    {feature.description}
                                </p>
                            </div>
                        );
                    })}
                </div>
            </div>
        </section>
    );
}

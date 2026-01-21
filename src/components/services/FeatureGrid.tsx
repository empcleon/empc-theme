import React from 'react';
import { getIconComponent } from '../../utils/iconMapper';

export interface Feature {
    icon: string; // Icon name as string
    iconColor: string;
    title: string;
    description: string;
}

export interface FeatureGridProps {
    title: string;
    subtitle: string;
    description?: string;
    features: Feature[];
    columns?: 2 | 3 | 4;
}

const FeatureGrid: React.FC<FeatureGridProps> = ({
    title,
    subtitle,
    description,
    features,
    columns = 3
}) => {
    const gridCols = {
        2: 'md:grid-cols-2',
        3: 'md:grid-cols-2 lg:grid-cols-3',
        4: 'md:grid-cols-2 lg:grid-cols-4'
    };

    return (
        <section className="py-24 bg-slate-900">
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

                <div className={`grid ${gridCols[columns]} gap-8`}>
                    {features.map((feature, index) => {
                        const IconComponent = getIconComponent(feature.icon);
                        return (
                            <div
                                key={index}
                                className="bg-slate-800/50 border border-slate-700 rounded-2xl p-8 hover:border-blue-500/50 transition group"
                            >
                                <div className={`w-14 h-14 bg-${feature.iconColor}-500/10 rounded-xl flex items-center justify-center mb-6 group-hover:bg-${feature.iconColor}-500/20 transition`}>
                                    <IconComponent className={`w-7 h-7 text-${feature.iconColor}-400`} />
                                </div>
                                <h3 className="text-xl font-bold text-white mb-3">{feature.title}</h3>
                                <p className="text-slate-400 leading-relaxed">
                                    {feature.description}
                                </p>
                            </div>
                        );
                    })}
                </div>
            </div>
        </section>
    );
};

export default FeatureGrid;

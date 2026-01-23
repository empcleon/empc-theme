import React from 'react';

export interface Stat {
    number: string;
    suffix: string;
    label: string;
}

export interface StatsBarProps {
    stats: Stat[];
    darkMode?: boolean;
}

const StatsBar: React.FC<StatsBarProps> = ({ stats, darkMode = true }) => {
    return (
        <section className={`${darkMode ? 'bg-slate-800 border-slate-700' : 'bg-white border-gray-200'} border-y py-12`}>
            <div className="max-w-7xl mx-auto px-4 sm:px-6">
                <div className={`grid grid-cols-2 md:grid-cols-${Math.min(stats.length, 4)} gap-8`}>
                    {stats.map((stat, index) => (
                        <div key={index} className="text-center">
                            <p className={`text-4xl md:text-5xl font-bold mb-1 ${darkMode ? 'text-white' : 'text-gray-900'}`}>
                                {stat.number}
                                <span className="text-blue-400">{stat.suffix}</span>
                            </p>
                            <p className={darkMode ? 'text-slate-300' : 'text-gray-600'}>{stat.label}</p>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default StatsBar;

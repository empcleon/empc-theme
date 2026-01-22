import React from 'react';
import { Store, Globe, Check } from 'lucide-react';

interface ComparisonItem {
    aspect: string;
    physical: string;
    online: string;
    winner: 'physical' | 'online';
}

export interface ComparisonTableProps {
    title: string;
    subtitle: string;
    items: ComparisonItem[];
    conclusion: string;
}

export function ComparisonTable({
    title,
    subtitle,
    items,
    conclusion
}: ComparisonTableProps) {
    return (
        <section className="py-20 bg-slate-800 border-y border-slate-700">
            <div className="max-w-6xl mx-auto px-4 sm:px-6">
                {/* Header */}
                <div className="text-center mb-12">
                    <h2 className="text-2xl md:text-3xl font-bold text-white mb-3">
                        {title}
                    </h2>
                    <p className="text-slate-400">{subtitle}</p>
                </div>

                {/* Table */}
                <div className="overflow-x-auto">
                    <table className="w-full">
                        <thead>
                            <tr>
                                <th className="text-left py-4 px-6 text-slate-400 font-medium" />
                                <th className="py-4 px-6 text-center">
                                    <div className="inline-flex items-center gap-2 bg-slate-700 px-4 py-2 rounded-lg">
                                        <Store className="w-5 h-5 text-slate-300" />
                                        <span className="text-white font-semibold">Tienda Física</span>
                                    </div>
                                </th>
                                <th className="py-4 px-6 text-center">
                                    <div className="inline-flex items-center gap-2 bg-emerald-500/20 border border-emerald-500/30 px-4 py-2 rounded-lg">
                                        <Globe className="w-5 h-5 text-emerald-400" />
                                        <span className="text-emerald-400 font-semibold">Tienda Online</span>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            {items.map((item, index) => (
                                <tr
                                    key={index}
                                    className={index % 2 === 0 ? 'bg-slate-900/50' : ''}
                                >
                                    <td className="py-4 px-6 text-white font-medium">
                                        {item.aspect}
                                    </td>
                                    <td className="py-4 px-6 text-center text-slate-400">
                                        {item.physical}
                                    </td>
                                    <td className="py-4 px-6 text-center">
                                        <span className="inline-flex items-center gap-2 text-emerald-400 font-semibold">
                                            {item.winner === 'online' && (
                                                <Check className="w-4 h-4" />
                                            )}
                                            {item.online}
                                        </span>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>

                {/* Conclusion */}
                <div className="text-center mt-8">
                    <p
                        className="text-slate-400"
                        dangerouslySetInnerHTML={{ __html: conclusion }}
                    />
                </div>
            </div>
        </section>
    );
}

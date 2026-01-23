import React from 'react';
import { ArrowRight, Quote } from 'lucide-react';

interface CaseResult {
    value: string;
    label: string;
}

interface CaseStudy {
    name: string;
    sector: string;
    image?: string;
    results: CaseResult[];
    testimonial: string;
    author: string;
    role: string;
}

export interface CaseStudyCardsProps {
    badge: string;
    title: string;
    description: string;
    cases: CaseStudy[];
    cta?: { text: string; href: string };
    theme?: 'emerald' | 'blue' | 'purple';
}

export function CaseStudyCards({
    badge,
    title,
    description,
    cases,
    cta,
    theme = 'emerald'
}: CaseStudyCardsProps) {
    const accentColor = theme;

    return (
        <section id="casos" className="py-24 bg-slate-900">
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

                {/* Cases Grid */}
                <div className="grid lg:grid-cols-3 gap-8">
                    {cases.map((caseStudy, index) => (
                        <div
                            key={index}
                            className={`bg-slate-800 border border-slate-700 rounded-2xl overflow-hidden hover:border-${accentColor}-500/30 transition-all group`}
                        >
                            {/* Image */}
                            <div className={`relative h-48 bg-gradient-to-br from-${accentColor}-900/50 to-slate-900 overflow-hidden`}>
                                {caseStudy.image ? (
                                    <img
                                        src={caseStudy.image}
                                        alt={caseStudy.name}
                                        className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    />
                                ) : (
                                    <div className="absolute inset-0 flex items-center justify-center">
                                        <span className="text-6xl opacity-50">🛒</span>
                                    </div>
                                )}
                                <div className="absolute bottom-4 left-4">
                                    <span className="bg-slate-900/80 backdrop-blur text-slate-300 text-xs px-3 py-1 rounded-full">
                                        {caseStudy.sector}
                                    </span>
                                </div>
                            </div>

                            {/* Content */}
                            <div className="p-6">
                                <h3 className="text-xl font-bold text-white mb-4">{caseStudy.name}</h3>

                                {/* Results */}
                                <div className="grid grid-cols-3 gap-4 mb-6 py-4 border-y border-slate-700">
                                    {caseStudy.results.map((result, rIndex) => (
                                        <div key={rIndex} className="text-center">
                                            <p className={`text-2xl font-bold text-${accentColor}-400`}>
                                                {result.value}
                                            </p>
                                            <p className="text-xs text-slate-500">{result.label}</p>
                                        </div>
                                    ))}
                                </div>

                                {/* Testimonial */}
                                <div className="relative">
                                    <Quote className={`absolute -top-2 -left-2 w-6 h-6 text-${accentColor}-500/20`} />
                                    <blockquote className="text-slate-300 text-sm italic mb-4 leading-relaxed pl-4">
                                        "{caseStudy.testimonial}"
                                    </blockquote>
                                </div>

                                {/* Author */}
                                <div className="flex items-center gap-3">
                                    <div className={`w-10 h-10 bg-${accentColor}-500/20 rounded-full flex items-center justify-center text-${accentColor}-400 font-bold text-sm`}>
                                        {caseStudy.author.split(' ').map(n => n[0]).join('')}
                                    </div>
                                    <div>
                                        <p className="text-white font-medium text-sm">{caseStudy.author}</p>
                                        <p className="text-slate-500 text-xs">{caseStudy.role}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>

                {/* CTA */}
                {cta && (
                    <div className="text-center mt-12">
                        <a
                            href={cta.href}
                            className="inline-flex items-center gap-2 bg-slate-800 hover:bg-slate-700 border border-slate-700 text-white px-6 py-3 rounded-xl font-medium transition"
                        >
                            {cta.text}
                            <ArrowRight className="w-4 h-4" />
                        </a>
                    </div>
                )}
            </div>
        </section>
    );
}

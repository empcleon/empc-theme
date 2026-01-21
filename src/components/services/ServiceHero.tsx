import React from 'react';
import { ArrowRight, Code2 } from 'lucide-react';

export interface ServiceHeroProps {
    badge: string;
    title: string;
    highlight: string;
    description: string;
    bulletPoints: Array<{ icon: string; text: string }>;
    ctaPrimary: { text: string; href: string };
    ctaSecondary: { text: string; href: string };
    stats?: Array<{ number: string; suffix: string; label: string }>;
}

const ServiceHero: React.FC<ServiceHeroProps> = ({
    badge,
    title,
    highlight,
    description,
    bulletPoints,
    ctaPrimary,
    ctaSecondary,
    stats
}) => {
    return (
        <div className="relative min-h-[90vh] flex items-center bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 overflow-hidden">
            {/* Background Elements */}
            <div className="absolute inset-0 opacity-30">
                <div className="absolute top-20 left-10 w-72 h-72 bg-blue-500 rounded-full blur-[120px]"></div>
                <div className="absolute bottom-20 right-10 w-96 h-96 bg-purple-500 rounded-full blur-[150px]"></div>
            </div>

            {/* Grid Pattern */}
            <div className="absolute inset-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_100%)] pointer-events-none"></div>

            <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-20">
                <div className="grid lg:grid-cols-2 gap-12 items-center">

                    {/* Texto */}
                    <div>
                        {/* Badge */}
                        <div className="inline-flex items-center gap-2 bg-blue-500/10 border border-blue-500/20 px-4 py-2 rounded-full mb-6">
                            <span className="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                            <span className="text-blue-400 text-sm font-medium">{badge}</span>
                        </div>

                        <h1 className="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
                            {title}{' '}
                            <span className="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400">
                                {highlight}
                            </span>
                        </h1>

                        <p className="text-xl text-slate-300 mb-8 leading-relaxed">
                            {description}
                        </p>

                        {/* Puntos clave */}
                        <ul className="space-y-3 mb-10">
                            {bulletPoints.map((point, index) => (
                                <li key={index} className="flex items-center gap-3 text-slate-300">
                                    <svg className="w-5 h-5 text-green-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    <span dangerouslySetInnerHTML={{ __html: point.text }} />
                                </li>
                            ))}
                        </ul>

                        {/* CTAs */}
                        <div className="flex flex-col sm:flex-row gap-4">
                            <a
                                href={ctaPrimary.href}
                                className="inline-flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-500 text-white px-8 py-4 rounded-xl font-semibold text-lg transition transform hover:scale-105 shadow-lg shadow-blue-600/25"
                            >
                                {ctaPrimary.text}
                                <ArrowRight className="w-5 h-5" />
                            </a>
                            <a
                                href={ctaSecondary.href}
                                className="inline-flex items-center justify-center gap-2 border-2 border-slate-600 hover:border-slate-500 text-white px-8 py-4 rounded-xl font-semibold text-lg transition"
                            >
                                <Code2 className="w-5 h-5 text-slate-400" />
                                {ctaSecondary.text}
                            </a>
                        </div>
                    </div>

                    {/* Visual - Browser Mockup */}
                    <div className="relative hidden lg:block">
                        <div className="bg-slate-800 rounded-2xl p-2 shadow-2xl border border-slate-700">
                            <div className="flex items-center gap-2 px-4 py-3 border-b border-slate-700">
                                <div className="flex gap-2">
                                    <div className="w-3 h-3 rounded-full bg-red-500"></div>
                                    <div className="w-3 h-3 rounded-full bg-yellow-500"></div>
                                    <div className="w-3 h-3 rounded-full bg-green-500"></div>
                                </div>
                                <div className="flex-1 bg-slate-700 rounded-lg px-4 py-1.5 text-sm text-slate-400 text-center">
                                    tunegocio.es
                                </div>
                            </div>
                            <div className="aspect-[4/3] bg-gradient-to-br from-slate-700 to-slate-800 rounded-b-lg flex items-center justify-center">
                                <div className="w-full h-full bg-gradient-to-br from-blue-500/10 to-purple-500/10 rounded-b-lg p-8">
                                    <div className="grid grid-cols-2 gap-4 h-full">
                                        <div className="bg-white/5 rounded-lg"></div>
                                        <div className="bg-white/5 rounded-lg"></div>
                                        <div className="col-span-2 bg-white/10 rounded-lg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {/* Floating elements */}
                        <div className="absolute -top-4 -right-4 bg-green-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg animate-bounce">
                            PageSpeed: 98
                        </div>
                        <div className="absolute -bottom-4 -left-4 bg-slate-800 border border-slate-700 px-4 py-3 rounded-xl shadow-lg">
                            <div className="flex items-center gap-2">
                                <div className="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                    +5
                                </div>
                                <span className="text-slate-300 text-sm">leads esta semana</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Scroll indicator */}
            <div className="absolute bottom-8 left-1/2 -translate-x-1/2 text-slate-500 animate-bounce">
                <svg className="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>
        </div>
    );
};

export default ServiceHero;

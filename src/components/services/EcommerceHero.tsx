import React from 'react';
import {
    ArrowRight,
    PlayCircle,
    ShoppingCart,
    Sparkles
} from 'lucide-react';

interface HeroStat {
    number: string;
    label: string;
}

interface CTAButton {
    text: string;
    href: string;
    icon?: string;
}

interface HeroBadge {
    icon?: string;
    text: string;
    subtext?: string;
}

export interface EcommerceHeroProps {
    badge: HeroBadge;
    title: string;
    highlight: string;
    description: string;
    stats: HeroStat[];
    ctaPrimary: CTAButton;
    ctaSecondary: CTAButton;
    theme?: 'emerald' | 'blue' | 'purple';
}

const themeColors = {
    emerald: {
        gradient: 'from-emerald-900 via-slate-900 to-slate-900',
        accent: 'text-emerald-400',
        accentBg: 'bg-emerald-500/10 border-emerald-500/20',
        glow1: 'bg-emerald-500/20',
        glow2: 'bg-teal-500/20',
        button: 'from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 shadow-emerald-500/25',
        buttonSecondary: 'border-slate-600 hover:border-emerald-500/50 hover:bg-emerald-500/5'
    },
    blue: {
        gradient: 'from-blue-900 via-slate-900 to-slate-900',
        accent: 'text-blue-400',
        accentBg: 'bg-blue-500/10 border-blue-500/20',
        glow1: 'bg-blue-500/20',
        glow2: 'bg-indigo-500/20',
        button: 'from-blue-500 to-indigo-500 hover:from-blue-400 hover:to-indigo-400 shadow-blue-500/25',
        buttonSecondary: 'border-slate-600 hover:border-blue-500/50 hover:bg-blue-500/5'
    },
    purple: {
        gradient: 'from-purple-900 via-slate-900 to-slate-900',
        accent: 'text-purple-400',
        accentBg: 'bg-purple-500/10 border-purple-500/20',
        glow1: 'bg-purple-500/20',
        glow2: 'bg-pink-500/20',
        button: 'from-purple-500 to-pink-500 hover:from-purple-400 hover:to-pink-400 shadow-purple-500/25',
        buttonSecondary: 'border-slate-600 hover:border-purple-500/50 hover:bg-purple-500/5'
    }
};

export function EcommerceHero({
    badge,
    title,
    highlight,
    description,
    stats,
    ctaPrimary,
    ctaSecondary,
    theme = 'emerald'
}: EcommerceHeroProps) {
    const colors = themeColors[theme];

    return (
        <section className={`relative min-h-screen flex items-center bg-gradient-to-br ${colors.gradient} overflow-hidden`}>
            {/* Background Effects */}
            <div className="absolute inset-0">
                <div className={`absolute top-1/4 left-0 w-96 h-96 ${colors.glow1} rounded-full blur-[150px]`} />
                <div className={`absolute bottom-1/4 right-0 w-80 h-80 ${colors.glow2} rounded-full blur-[120px]`} />
            </div>

            {/* Grid Pattern */}
            <div
                className="absolute inset-0 opacity-[0.03]"
                style={{
                    backgroundImage: 'linear-gradient(rgba(255,255,255,.1) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.1) 1px, transparent 1px)',
                    backgroundSize: '50px 50px'
                }}
            />

            <div className="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 py-20 lg:py-32">
                <div className="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                    {/* Content */}
                    <div>
                        {/* Badge */}
                        <div className={`inline-flex items-center gap-3 ${colors.accentBg} border px-5 py-2.5 rounded-full mb-8`}>
                            <span className="flex items-center gap-2">
                                <span className={`w-2 h-2 ${colors.accent.replace('text-', 'bg-')} rounded-full animate-pulse`} />
                                <span className={`${colors.accent} text-sm font-medium`}>{badge.text}</span>
                            </span>
                            {badge.subtext && (
                                <>
                                    <span className="text-slate-500">|</span>
                                    <span className="text-slate-300 text-sm">{badge.subtext}</span>
                                </>
                            )}
                        </div>

                        {/* Title */}
                        <h1 className="text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-white mb-6 leading-[1.1]">
                            {title}{' '}
                            <span className={`text-transparent bg-clip-text bg-gradient-to-r ${theme === 'emerald' ? 'from-emerald-400 via-teal-400 to-cyan-400' :
                                    theme === 'blue' ? 'from-blue-400 via-indigo-400 to-purple-400' :
                                        'from-purple-400 via-pink-400 to-rose-400'
                                }`}>
                                {highlight}
                            </span>
                        </h1>

                        {/* Description */}
                        <p
                            className="text-xl lg:text-2xl text-slate-300 mb-8 leading-relaxed max-w-xl"
                            dangerouslySetInnerHTML={{ __html: description }}
                        />

                        {/* Stats */}
                        <div className="grid grid-cols-3 gap-6 mb-10 py-6 border-y border-slate-700/50">
                            {stats.map((stat, index) => (
                                <div key={index}>
                                    <p className={`text-3xl lg:text-4xl font-bold ${colors.accent}`}>
                                        {stat.number}
                                    </p>
                                    <p className="text-slate-300 text-sm">{stat.label}</p>
                                </div>
                            ))}
                        </div>

                        {/* CTAs */}
                        <div className="flex flex-col sm:flex-row gap-4">
                            <a
                                href={ctaPrimary.href}
                                className={`group inline-flex items-center justify-center gap-3 bg-gradient-to-r ${colors.button} text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all transform hover:scale-105 shadow-lg`}
                            >
                                <span>{ctaPrimary.text}</span>
                                <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
                            </a>
                            <a
                                href={ctaSecondary.href}
                                className={`inline-flex items-center justify-center gap-2 border-2 ${colors.buttonSecondary} text-white px-8 py-4 rounded-xl font-semibold text-lg transition-all`}
                            >
                                <PlayCircle className="w-5 h-5" />
                                {ctaSecondary.text}
                            </a>
                        </div>
                    </div>

                    {/* Visual: Store Mockup */}
                    <div className="relative hidden lg:block">
                        <EcommerceMockup theme={theme} />
                    </div>
                </div>
            </div>

            {/* Scroll Indicator */}
            <div className="absolute bottom-8 left-1/2 -translate-x-1/2">
                <div className="flex flex-col items-center gap-2 text-slate-500">
                    <span className="text-xs uppercase tracking-wider">Descubre más</span>
                    <svg className="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                    </svg>
                </div>
            </div>
        </section>
    );
}

// Subcomponent: Store Mockup
function EcommerceMockup({ theme }: { theme: string }) {
    const accentColor = theme === 'emerald' ? 'emerald' : theme === 'blue' ? 'blue' : 'purple';

    return (
        <div className="relative">
            {/* Desktop Browser */}
            <div className="bg-slate-800 rounded-2xl p-3 shadow-2xl border border-slate-700 transform rotate-2 hover:rotate-0 transition-transform duration-500">
                <div className="flex items-center gap-2 px-4 py-2 border-b border-slate-700">
                    <div className="flex gap-1.5">
                        <div className="w-3 h-3 rounded-full bg-red-500" />
                        <div className="w-3 h-3 rounded-full bg-yellow-500" />
                        <div className="w-3 h-3 rounded-full bg-green-500" />
                    </div>
                    <div className="flex-1 bg-slate-700 rounded px-3 py-1 text-xs text-slate-300 text-center">
                        🔒 tutienda.es/productos
                    </div>
                </div>
                <div className="bg-white rounded-lg overflow-hidden">
                    <div className="p-4">
                        {/* Store Header */}
                        <div className="flex items-center justify-between mb-4 pb-3 border-b">
                            <div className="font-bold text-slate-800">TuMarca</div>
                            <div className="flex items-center gap-4 text-sm text-slate-600">
                                <span>Productos</span>
                                <span>Ofertas</span>
                                <div className="relative">
                                    <ShoppingCart className="w-5 h-5" />
                                    <span className={`absolute -top-2 -right-2 w-4 h-4 bg-${accentColor}-500 rounded-full text-[10px] text-white flex items-center justify-center`}>
                                        3
                                    </span>
                                </div>
                            </div>
                        </div>
                        {/* Product Grid */}
                        <div className="grid grid-cols-3 gap-3">
                            {[
                                `from-${accentColor}-200 to-teal-200`,
                                'from-blue-200 to-indigo-200',
                                'from-purple-200 to-pink-200'
                            ].map((gradient, i) => (
                                <div key={i} className="bg-slate-100 rounded-lg p-2">
                                    <div className={`aspect-square bg-gradient-to-br ${gradient} rounded mb-2`} />
                                    <div className="h-2 bg-slate-300 rounded w-3/4 mb-1" />
                                    <div className={`h-2 bg-${accentColor}-400 rounded w-1/2`} />
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>

            {/* Mobile Device */}
            <div className="absolute -bottom-8 -left-8 bg-slate-800 rounded-3xl p-2 shadow-2xl border border-slate-700 w-40 transform -rotate-6 hover:rotate-0 transition-transform duration-500">
                <div className="bg-white rounded-2xl overflow-hidden">
                    <div className="p-3">
                        <div className="aspect-square bg-gradient-to-br from-orange-200 to-rose-200 rounded-lg mb-2" />
                        <div className="h-2 bg-slate-300 rounded w-full mb-1" />
                        <div className="h-2 bg-slate-200 rounded w-2/3 mb-2" />
                        <div className="flex justify-between items-center">
                            <span className={`text-${accentColor}-600 font-bold text-sm`}>29,99€</span>
                            <div className={`bg-${accentColor}-500 text-white text-[10px] px-2 py-1 rounded`}>
                                Añadir
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {/* Floating Notification */}
            <div className="absolute top-4 -right-4 bg-white rounded-xl p-4 shadow-xl border border-slate-200 animate-bounce">
                <div className="flex items-center gap-3">
                    <div className={`w-10 h-10 bg-${accentColor}-100 rounded-full flex items-center justify-center`}>
                        <Sparkles className={`w-5 h-5 text-${accentColor}-600`} />
                    </div>
                    <div>
                        <p className="text-sm font-semibold text-slate-800">¡Nueva venta!</p>
                        <p className="text-xs text-slate-500">Hace 2 minutos · 89,99€</p>
                    </div>
                </div>
            </div>

            {/* Payment Methods */}
            <div className="absolute -bottom-4 right-4 bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 flex items-center gap-3">
                <span className="text-slate-300 text-xs">Pagos:</span>
                <div className="flex gap-2">
                    <div className="w-8 h-5 bg-blue-600 rounded text-[8px] text-white flex items-center justify-center font-bold">
                        VISA
                    </div>
                    <div className="w-8 h-5 bg-yellow-400 rounded text-[8px] text-blue-900 flex items-center justify-center font-bold">
                        PP
                    </div>
                    <div className={`w-8 h-5 bg-${accentColor}-500 rounded text-[8px] text-white flex items-center justify-center font-bold`}>
                        B
                    </div>
                </div>
            </div>
        </div>
    );
}

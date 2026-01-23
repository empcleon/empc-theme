import React from 'react';

export interface ProcessStep {
    step: string;
    title: string;
    description: string;
    duration: string;
}

export interface ProcessTimelineProps {
    title: string;
    subtitle: string;
    description?: string;
    steps: ProcessStep[];
}

const ProcessTimeline: React.FC<ProcessTimelineProps> = ({
    title,
    subtitle,
    description,
    steps
}) => {
    return (
        <section className="py-24 bg-slate-900" id="proceso">
            <div className="max-w-7xl mx-auto px-4 sm:px-6">
                <div className="text-center mb-16">
                    <span className="text-blue-400 font-medium tracking-widest uppercase text-sm">{subtitle}</span>
                    <h2 className="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">
                        {title}
                    </h2>
                    {description && (
                        <p className="text-slate-300 max-w-2xl mx-auto text-lg">
                            {description}
                        </p>
                    )}
                </div>

                <div className="grid md:grid-cols-4 gap-8">
                    {steps.map((step, index) => (
                        <div key={index} className="relative">
                            {/* Línea conectora */}
                            {index < steps.length - 1 && (
                                <div className="hidden md:block absolute top-8 left-full w-full h-0.5 bg-gradient-to-r from-blue-500 to-transparent -translate-x-4 z-0"></div>
                            )}

                            <div className="text-center relative z-10">
                                <div className="w-16 h-16 bg-blue-500/10 border-2 border-blue-500 rounded-full flex items-center justify-center mx-auto mb-6 relative">
                                    <span className="text-blue-400 font-bold text-xl">{step.step}</span>
                                </div>
                                <h3 className="text-lg font-bold text-white mb-2">{step.title}</h3>
                                <p className="text-slate-300 text-sm mb-3">{step.description}</p>
                                <span className="text-blue-400 text-xs font-medium">{step.duration}</span>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default ProcessTimeline;

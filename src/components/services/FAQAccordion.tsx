import React, { useState } from 'react';
import { ChevronDown, HelpCircle } from 'lucide-react';

export interface FAQ {
    question: string;
    answer: string;
}

export interface FAQAccordionProps {
    title: string;
    subtitle: string;
    faqs: FAQ[];
}

const FAQAccordion: React.FC<FAQAccordionProps> = ({
    title,
    subtitle,
    faqs
}) => {
    const [openIndex, setOpenIndex] = useState<number | null>(null);

    const toggleFAQ = (index: number) => {
        setOpenIndex(openIndex === index ? null : index);
    };

    return (
        <section className="py-24 bg-slate-900">
            <div className="max-w-3xl mx-auto px-4 sm:px-6">
                {/* Header con icono */}
                <div className="text-center mb-16">
                    <div className="flex items-center gap-3 justify-center mb-4">
                        <HelpCircle className="w-8 h-8 text-rose-500" />
                        <h2 className="text-3xl md:text-4xl font-bold text-white">
                            {title}
                        </h2>
                    </div>
                    <span className="text-slate-400 font-medium tracking-wide text-sm">{subtitle}</span>
                </div>

                <div className="space-y-4">
                    {faqs.map((faq, index) => (
                        <div
                            key={index}
                            className="bg-slate-800/50 backdrop-blur-sm rounded-xl border border-slate-700 overflow-hidden transition-all hover:border-rose-500/30"
                        >
                            <button
                                className="w-full flex items-center justify-between p-6 text-left hover:bg-slate-800/80 transition"
                                onClick={() => toggleFAQ(index)}
                                aria-expanded={openIndex === index}
                                aria-controls={`faq-answer-${index}`}
                            >
                                <span className="font-semibold text-white pr-4">{faq.question}</span>
                                <ChevronDown
                                    className={`w-5 h-5 text-rose-500 flex-shrink-0 transition-transform duration-300 ${openIndex === index ? 'rotate-180' : ''
                                        }`}
                                />
                            </button>
                            <div
                                id={`faq-answer-${index}`}
                                className={`transition-all duration-300 ease-in-out ${openIndex === index ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'
                                    }`}
                                style={{ overflow: 'hidden' }}
                            >
                                <p className="px-6 pb-6 text-slate-300 leading-relaxed border-t border-slate-700/50">
                                    {faq.answer}
                                </p>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default FAQAccordion;

import React, { useState } from 'react';
import { ChevronDown } from 'lucide-react';

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
                <div className="text-center mb-16">
                    <span className="text-blue-400 font-medium tracking-widest uppercase text-sm">{subtitle}</span>
                    <h2 className="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">
                        {title}
                    </h2>
                </div>

                <div className="space-y-4">
                    {faqs.map((faq, index) => (
                        <div
                            key={index}
                            className="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden transition-all"
                        >
                            <button
                                className="w-full flex items-center justify-between p-6 text-left hover:bg-slate-750 transition"
                                onClick={() => toggleFAQ(index)}
                                aria-expanded={openIndex === index}
                            >
                                <span className="font-semibold text-white pr-4">{faq.question}</span>
                                <ChevronDown
                                    className={`w-5 h-5 text-blue-400 flex-shrink-0 transition-transform duration-300 ${openIndex === index ? 'rotate-180' : ''
                                        }`}
                                />
                            </button>
                            <div
                                className={`transition-all duration-300 ease-in-out ${openIndex === index ? 'max-h-96 opacity-100' : 'max-h-0 opacity-0'
                                    }`}
                                style={{ overflow: 'hidden' }}
                            >
                                <p className="px-6 pb-6 text-slate-300 leading-relaxed">
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

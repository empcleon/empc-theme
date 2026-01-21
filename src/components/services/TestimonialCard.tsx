import React from 'react';
import { Star } from 'lucide-react';

export interface Testimonial {
    text: string;
    author: string;
    company: string;
    sector?: string;
    rating?: number;
    imageUrl?: string;
}

export interface TestimonialCardProps {
    title: string;
    subtitle: string;
    testimonials: Testimonial[];
}

const TestimonialCard: React.FC<TestimonialCardProps> = ({
    title,
    subtitle,
    testimonials
}) => {
    return (
        <section className="py-24 bg-slate-800">
            <div className="max-w-7xl mx-auto px-4 sm:px-6">
                <div className="text-center mb-16">
                    <span className="text-blue-400 font-medium tracking-widest uppercase text-sm">{subtitle}</span>
                    <h2 className="text-3xl md:text-4xl font-bold text-white mt-2 mb-4">
                        {title}
                    </h2>
                </div>

                <div className="grid md:grid-cols-3 gap-8">
                    {testimonials.map((testimonial, index) => (
                        <div key={index} className="bg-slate-900 rounded-2xl p-8 border border-slate-700 hover:border-blue-500/50 transition">
                            {/* Estrellas */}
                            <div className="flex gap-1 mb-4">
                                {Array.from({ length: testimonial.rating || 5 }).map((_, i) => (
                                    <Star key={i} className="w-5 h-5 text-yellow-400 fill-yellow-400" />
                                ))}
                            </div>

                            <p className="text-slate-300 mb-6 leading-relaxed italic">
                                "{testimonial.text}"
                            </p>

                            <div className="flex items-center gap-4">
                                {testimonial.imageUrl ? (
                                    <img
                                        src={testimonial.imageUrl}
                                        alt={testimonial.author}
                                        className="w-12 h-12 rounded-full object-cover"
                                    />
                                ) : (
                                    <div className="w-12 h-12 bg-blue-500/20 rounded-full flex items-center justify-center text-blue-400 font-bold">
                                        {testimonial.author.split(' ').map(n => n[0]).join('')}
                                    </div>
                                )}
                                <div>
                                    <p className="text-white font-semibold">{testimonial.author}</p>
                                    <p className="text-slate-500 text-sm">{testimonial.company}</p>
                                </div>
                            </div>
                        </div>
                    ))}
                </div>
            </div>
        </section>
    );
};

export default TestimonialCard;

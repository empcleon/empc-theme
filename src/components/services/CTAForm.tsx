import React, { useState } from 'react';
import { Send } from 'lucide-react';

export interface CTAFormProps {
    title: string;
    description: string;
    submitText?: string;
    onSubmit?: (data: FormData) => void | Promise<void>;
    showBudgetField?: boolean;
    showProjectType?: boolean;
}

interface FormData {
    nombre: string;
    email: string;
    telefono?: string;
    tipo?: string;
    mensaje: string;
    presupuesto?: string;
}

const CTAForm: React.FC<CTAFormProps> = ({
    title,
    description,
    submitText = 'Enviar solicitud',
    onSubmit,
    showBudgetField = true,
    showProjectType = true
}) => {
    const [formData, setFormData] = useState<FormData>({
        nombre: '',
        email: '',
        telefono: '',
        tipo: '',
        mensaje: '',
        presupuesto: ''
    });

    const [isSubmitting, setIsSubmitting] = useState(false);
    const [submitStatus, setSubmitStatus] = useState<'idle' | 'success' | 'error'>('idle');

    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });
    };

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setIsSubmitting(true);
        setSubmitStatus('idle');

        try {
            if (onSubmit) {
                await onSubmit(formData);
            } else {
                // Default: enviar a WordPress REST API o email
                const response = await fetch(window.empcConfig?.apiUrl + '/empc/v1/contact', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-WP-Nonce': window.empcConfig?.nonce || ''
                    },
                    body: JSON.stringify(formData)
                });

                if (!response.ok) throw new Error('Error al enviar');
            }

            setSubmitStatus('success');
            setFormData({
                nombre: '',
                email: '',
                telefono: '',
                tipo: '',
                mensaje: '',
                presupuesto: ''
            });
        } catch (error) {
            console.error('Error:', error);
            setSubmitStatus('error');
        } finally {
            setIsSubmitting(false);
        }
    };

    return (
        <section className="py-24 relative overflow-hidden" id="presupuesto">
            {/* Background elements */}
            <div className="absolute inset-0 bg-[#050505]"></div>
            <div className="absolute top-0 left-1/4 w-96 h-96 bg-[#FF007A]/10 rounded-full blur-[100px]"></div>
            <div className="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-900/10 rounded-full blur-[100px]"></div>

            <div className="max-w-4xl mx-auto px-4 sm:px-6 relative z-10">
                <div className="text-center mb-12">
                    <h2 className="text-3xl md:text-5xl font-bold text-white mb-6 font-syne">
                        {title}
                    </h2>
                    <p className="text-slate-400 text-lg font-inter">
                        {description}
                    </p>
                </div>

                <form onSubmit={handleSubmit} className="card-soberana rounded-2xl p-8 md:p-12 border border-white/5 backdrop-blur-md">
                    <div className="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label className="block text-slate-300 text-sm mb-2">Nombre *</label>
                            <input
                                type="text"
                                name="nombre"
                                required
                                value={formData.nombre}
                                onChange={handleChange}
                                className="w-full bg-black/40 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder:text-slate-500 focus:border-[#FF007A] focus:ring-1 focus:ring-[#FF007A] outline-none transition"
                                placeholder="Tu nombre"
                            />
                        </div>
                        <div>
                            <label className="block text-slate-300 text-sm mb-2">Email *</label>
                            <input
                                type="email"
                                name="email"
                                required
                                value={formData.email}
                                onChange={handleChange}
                                className="w-full bg-black/40 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder:text-slate-500 focus:border-[#FF007A] focus:ring-1 focus:ring-[#FF007A] outline-none transition"
                                placeholder="tu@email.com"
                            />
                        </div>
                    </div>

                    <div className="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label className="block text-slate-300 text-sm mb-2">Teléfono</label>
                            <input
                                type="tel"
                                name="telefono"
                                value={formData.telefono}
                                onChange={handleChange}
                                className="w-full bg-black/40 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder:text-slate-500 focus:border-[#FF007A] focus:ring-1 focus:ring-[#FF007A] outline-none transition"
                                placeholder="600 000 000"
                            />
                        </div>
                        {showProjectType && (
                            <div>
                                <label className="block text-slate-300 text-sm mb-2">Tipo de proyecto *</label>
                                <select
                                    name="tipo"
                                    required
                                    value={formData.tipo}
                                    onChange={handleChange}
                                    className="w-full bg-black/40 border border-slate-700 rounded-xl px-4 py-3 text-white focus:border-[#FF007A] focus:ring-1 focus:ring-[#FF007A] outline-none transition"
                                >
                                    <option value="" className="text-gray-400">Selecciona...</option>
                                    <option value="web-corporativa" className="text-black">Web corporativa</option>
                                    <option value="tienda-online" className="text-black">Tienda online</option>
                                    <option value="landing-page" className="text-black">Landing page</option>
                                    <option value="rediseno" className="text-black">Rediseño web existente</option>
                                    <option value="otro" className="text-black">Otro</option>
                                </select>
                            </div>
                        )}
                    </div>

                    <div className="mb-6">
                        <label className="block text-slate-300 text-sm mb-2">Cuéntame tu proyecto *</label>
                        <textarea
                            name="mensaje"
                            rows={4}
                            required
                            value={formData.mensaje}
                            onChange={handleChange}
                            className="w-full bg-black/40 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder:text-slate-500 focus:border-[#FF007A] focus:ring-1 focus:ring-[#FF007A] outline-none transition resize-none"
                            placeholder="Describe brevemente qué necesitas: tipo de negocio, objetivos, funcionalidades..."
                        ></textarea>
                    </div>

                    {showBudgetField && (
                        <div className="mb-6">
                            <label className="block text-slate-300 text-sm mb-2">Presupuesto aproximado</label>
                            <select
                                name="presupuesto"
                                value={formData.presupuesto}
                                onChange={handleChange}
                                className="w-full bg-black/40 border border-slate-700 rounded-xl px-4 py-3 text-white focus:border-[#FF007A] focus:ring-1 focus:ring-[#FF007A] outline-none transition"
                            >
                                <option value="" className="text-gray-400">No lo tengo definido</option>
                                <option value="500-1000" className="text-black">500€ - 1.000€</option>
                                <option value="1000-2000" className="text-black">1.000€ - 2.000€</option>
                                <option value="2000-5000" className="text-black">2.000€ - 5.000€</option>
                                <option value="5000+" className="text-black">Más de 5.000€</option>
                            </select>
                        </div>
                    )}

                    <button
                        type="submit"
                        disabled={isSubmitting}
                        className="w-full bg-[#FF007A] text-black py-4 rounded-xl font-bold text-lg hover:bg-[#FB7185] hover:shadow-[0_0_20px_rgba(255,0,122,0.6)] transition shadow-lg disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2 uppercase tracking-wide"
                    >
                        {isSubmitting ? (
                            <>
                                <svg className="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                                    <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Enviando...
                            </>
                        ) : (
                            <>
                                {submitText}
                                <Send className="w-5 h-5" />
                            </>
                        )}
                    </button>

                    {submitStatus === 'success' && (
                        <p className="text-center text-[#FF007A] mt-4 font-medium">
                            ✓ Mensaje enviado correctamente. Te responderemos pronto.
                        </p>
                    )}

                    {submitStatus === 'error' && (
                        <p className="text-center text-red-400 mt-4 font-medium">
                            ✗ Error al enviar. Por favor, inténtalo de nuevo.
                        </p>
                    )}

                    <p className="text-slate-500 text-sm text-center mt-4">
                        Sin compromiso. Respuesta garantizada en menos de 24 horas.
                    </p>
                </form>
            </div>
        </section>
    );
};

export default CTAForm;

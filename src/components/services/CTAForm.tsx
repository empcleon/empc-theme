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
        <section className="py-24 bg-gradient-to-br from-blue-600 to-purple-600" id="presupuesto">
            <div className="max-w-4xl mx-auto px-4 sm:px-6">
                <div className="text-center mb-12">
                    <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
                        {title}
                    </h2>
                    <p className="text-blue-100 text-lg">
                        {description}
                    </p>
                </div>

                <form onSubmit={handleSubmit} className="bg-white/10 backdrop-blur rounded-2xl p-8 md:p-12">
                    <div className="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label className="block text-white/80 text-sm mb-2">Nombre *</label>
                            <input
                                type="text"
                                name="nombre"
                                required
                                value={formData.nombre}
                                onChange={handleChange}
                                className="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder:text-white/50 focus:border-white focus:ring-1 focus:ring-white outline-none transition"
                                placeholder="Tu nombre"
                            />
                        </div>
                        <div>
                            <label className="block text-white/80 text-sm mb-2">Email *</label>
                            <input
                                type="email"
                                name="email"
                                required
                                value={formData.email}
                                onChange={handleChange}
                                className="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder:text-white/50 focus:border-white focus:ring-1 focus:ring-white outline-none transition"
                                placeholder="tu@email.com"
                            />
                        </div>
                    </div>

                    <div className="grid md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label className="block text-white/80 text-sm mb-2">Teléfono</label>
                            <input
                                type="tel"
                                name="telefono"
                                value={formData.telefono}
                                onChange={handleChange}
                                className="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder:text-white/50 focus:border-white focus:ring-1 focus:ring-white outline-none transition"
                                placeholder="600 000 000"
                            />
                        </div>
                        {showProjectType && (
                            <div>
                                <label className="block text-white/80 text-sm mb-2">Tipo de proyecto *</label>
                                <select
                                    name="tipo"
                                    required
                                    value={formData.tipo}
                                    onChange={handleChange}
                                    className="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition"
                                >
                                    <option value="" className="text-gray-900">Selecciona...</option>
                                    <option value="web-corporativa" className="text-gray-900">Web corporativa</option>
                                    <option value="tienda-online" className="text-gray-900">Tienda online</option>
                                    <option value="landing-page" className="text-gray-900">Landing page</option>
                                    <option value="rediseno" className="text-gray-900">Rediseño web existente</option>
                                    <option value="otro" className="text-gray-900">Otro</option>
                                </select>
                            </div>
                        )}
                    </div>

                    <div className="mb-6">
                        <label className="block text-white/80 text-sm mb-2">Cuéntame tu proyecto *</label>
                        <textarea
                            name="mensaje"
                            rows={4}
                            required
                            value={formData.mensaje}
                            onChange={handleChange}
                            className="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white placeholder:text-white/50 focus:border-white focus:ring-1 focus:ring-white outline-none transition resize-none"
                            placeholder="Describe brevemente qué necesitas: tipo de negocio, objetivos, funcionalidades..."
                        ></textarea>
                    </div>

                    {showBudgetField && (
                        <div className="mb-6">
                            <label className="block text-white/80 text-sm mb-2">Presupuesto aproximado</label>
                            <select
                                name="presupuesto"
                                value={formData.presupuesto}
                                onChange={handleChange}
                                className="w-full bg-white/10 border border-white/20 rounded-xl px-4 py-3 text-white focus:border-white focus:ring-1 focus:ring-white outline-none transition"
                            >
                                <option value="" className="text-gray-900">No lo tengo definido</option>
                                <option value="500-1000" className="text-gray-900">500€ - 1.000€</option>
                                <option value="1000-2000" className="text-gray-900">1.000€ - 2.000€</option>
                                <option value="2000-5000" className="text-gray-900">2.000€ - 5.000€</option>
                                <option value="5000+" className="text-gray-900">Más de 5.000€</option>
                            </select>
                        </div>
                    )}

                    <button
                        type="submit"
                        disabled={isSubmitting}
                        className="w-full bg-white text-blue-600 py-4 rounded-xl font-bold text-lg hover:bg-blue-50 transition shadow-lg disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
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
                        <p className="text-center text-green-200 mt-4 font-medium">
                            ✓ Mensaje enviado correctamente. Te responderemos pronto.
                        </p>
                    )}

                    {submitStatus === 'error' && (
                        <p className="text-center text-red-200 mt-4 font-medium">
                            ✗ Error al enviar. Por favor, inténtalo de nuevo.
                        </p>
                    )}

                    <p className="text-white/60 text-sm text-center mt-4">
                        Sin compromiso. Respuesta garantizada en menos de 24 horas.
                    </p>
                </form>
            </div>
        </section>
    );
};

export default CTAForm;

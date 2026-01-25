import React, { useState } from 'react';
import { Mail, ArrowRight, Check, User, MessageSquare, Send } from 'lucide-react';

const ContactForm = () => {
    const [step, setStep] = useState(1);
    const [formData, setFormData] = useState({
        name: '',
        email: '',
        service: '',
        message: ''
    });
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [isSuccess, setIsSuccess] = useState(false);

    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const nextStep = () => setStep(step + 1);
    const prevStep = () => setStep(step - 1);

    const handleSubmit = async (e: React.FormEvent) => {
        e.preventDefault();
        setIsSubmitting(true);

        try {
            // @ts-ignore - empcData viene del global de WP injected en functions.php
            const apiUrl = window.empcData?.restUrl + 'empc/v1/contact';
            // @ts-ignore
            const nonce = window.empcData?.nonce;

            const response = await fetch(apiUrl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-WP-Nonce': nonce
                },
                body: JSON.stringify(formData)
            });

            if (response.ok) {
                setIsSuccess(true);
            } else {
                alert('Hubo un error al enviar el mensaje. Por favor, intenta de nuevo.');
            }
        } catch (error) {
            console.error('Error enviando formulario:', error);
            alert('Error de conexión. Comprueba tu internet.');
        } finally {
            setIsSubmitting(false);
        }
    };

    if (isSuccess) {
        return (
            <div className="bg-slate-800 p-8 rounded-2xl shadow-xl text-center border border-emerald-500/30 animate-fade-in">
                <div className="w-16 h-16 bg-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <Check className="w-8 h-8 text-emerald-500" />
                </div>
                <h3 className="text-2xl font-bold text-white mb-2">¡Mensaje Recibido!</h3>
                <p className="text-slate-300">Gracias {formData.name}, te responderemos a {formData.email} en menos de 24h.</p>
                <button
                    onClick={() => { setIsSuccess(false); setStep(1); setFormData({ name: '', email: '', service: '', message: '' }); }}
                    className="mt-6 text-emerald-400 hover:text-emerald-300 font-medium"
                >
                    Enviar otro mensaje
                </button>
            </div>
        );
    }

    return (
        <div className="w-full max-w-2xl mx-auto bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl overflow-hidden mb-20">
            {/* Progress Bar */}
            <div className="bg-slate-800 h-2 w-full">
                <div
                    className="h-full bg-gradient-to-r from-rose-500 to-orange-500 transition-all duration-500 ease-out"
                    style={{ width: `${(step / 3) * 100}%` }}
                ></div>
            </div>

            <div className="p-8 md:p-12">
                <form onSubmit={handleSubmit}>
                    {/* Step 1: Identificación */}
                    {step === 1 && (
                        <div className="space-y-6 animate-fade-in">
                            <h3 className="text-2xl font-bold text-white mb-6">Empecemos por las presentaciones</h3>

                            <div className="space-y-2">
                                <label htmlFor="cf-name" className="block text-sm font-medium text-slate-300">¿Cómo te llamas?</label>
                                <div className="relative">
                                    <User className="absolute left-4 top-3.5 w-5 h-5 text-slate-500" />
                                    <input
                                        id="cf-name"
                                        type="text"
                                        name="name"
                                        value={formData.name}
                                        onChange={handleChange}
                                        className="w-full bg-slate-800 border border-slate-700 rounded-xl py-3 pl-12 pr-4 text-white focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition-all placeholder-slate-500"
                                        placeholder="Tu nombre o empresa"
                                        required
                                    />
                                </div>
                            </div>

                            <div className="space-y-2">
                                <label htmlFor="cf-email" className="block text-sm font-medium text-slate-300">Correo electrónico</label>
                                <div className="relative">
                                    <Mail className="absolute left-4 top-3.5 w-5 h-5 text-slate-500" />
                                    <input
                                        id="cf-email"
                                        type="email"
                                        name="email"
                                        value={formData.email}
                                        onChange={handleChange}
                                        className="w-full bg-slate-800 border border-slate-700 rounded-xl py-3 pl-12 pr-4 text-white focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition-all placeholder-slate-500"
                                        placeholder="nombre@empresa.com"
                                        required
                                    />
                                </div>
                            </div>

                            <div className="pt-4 flex justify-end">
                                <button
                                    type="button"
                                    onClick={nextStep}
                                    disabled={!formData.name || !formData.email}
                                    className="bg-white text-slate-900 px-6 py-3 rounded-xl font-bold flex items-center gap-2 hover:bg-slate-200 disabled:opacity-50 disabled:cursor-not-allowed transition-all"
                                >
                                    Siguiente <ArrowRight className="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                    )}

                    {/* Step 2: Servicio */}
                    {step === 2 && (
                        <div className="space-y-6 animate-fade-in">
                            <h3 className="text-2xl font-bold text-white mb-6">¿En qué podemos ayudarte?</h3>

                            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                                {['Desarrollo Web', 'E-commerce', 'Auditoría WPO', 'Consultoría IA'].map((service) => (
                                    <label
                                        key={service}
                                        className={`p-4 rounded-xl border cursor-pointer transition-all ${formData.service === service
                                            ? 'bg-rose-500/10 border-rose-500 text-white'
                                            : 'bg-slate-800 border-slate-700 text-slate-300 hover:border-slate-500'
                                            }`}
                                    >
                                        <input
                                            type="radio"
                                            name="service"
                                            value={service}
                                            checked={formData.service === service}
                                            onChange={handleChange}
                                            className="hidden"
                                        />
                                        <span className="font-medium">{service}</span>
                                    </label>
                                ))}
                            </div>

                            <div className="pt-4 flex justify-between">
                                <button
                                    type="button"
                                    onClick={prevStep}
                                    className="text-slate-300 hover:text-white font-medium px-4 py-2"
                                >
                                    Atrás
                                </button>
                                <button
                                    type="button"
                                    onClick={nextStep}
                                    disabled={!formData.service}
                                    className="bg-white text-slate-900 px-6 py-3 rounded-xl font-bold flex items-center gap-2 hover:bg-slate-200 disabled:opacity-50 disabled:cursor-not-allowed transition-all"
                                >
                                    Siguiente <ArrowRight className="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                    )}

                    {/* Step 3: Mensaje */}
                    {step === 3 && (
                        <div className="space-y-6 animate-fade-in">
                            <h3 className="text-2xl font-bold text-white mb-6">Cuéntanos los detalles</h3>

                            <div className="relative">
                                <MessageSquare className="absolute left-4 top-3.5 w-5 h-5 text-slate-500" />
                                <textarea
                                    name="message"
                                    value={formData.message}
                                    onChange={handleChange}
                                    rows={4}
                                    className="w-full bg-slate-800 border border-slate-700 rounded-xl py-3 pl-12 pr-4 text-white focus:outline-none focus:border-rose-500 focus:ring-1 focus:ring-rose-500 transition-all resize-none"
                                    placeholder="¿Cuál es tu objetivo principal con este proyecto?"
                                    required
                                />
                            </div>

                            <div className="pt-4 flex justify-between">
                                <button
                                    type="button"
                                    onClick={prevStep}
                                    className="text-slate-300 hover:text-white font-medium px-4 py-2"
                                >
                                    Atrás
                                </button>
                                <button
                                    type="submit"
                                    disabled={isSubmitting || !formData.message}
                                    className="bg-gradient-to-r from-rose-600 to-orange-600 text-white px-8 py-3 rounded-xl font-bold flex items-center gap-2 hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed transition-all shadow-lg shadow-rose-900/20"
                                >
                                    {isSubmitting ? 'Enviando...' : 'Enviar Solicitud'} <Send className="w-4 h-4" />
                                </button>
                            </div>
                        </div>
                    )}
                </form>
            </div>
        </div>
    );
};

export default ContactForm;

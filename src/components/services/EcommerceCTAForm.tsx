import React, { useState } from 'react';
import { Send, Phone, Loader2 } from 'lucide-react';

interface FormField {
    name: string;
    label: string;
    type: 'text' | 'email' | 'tel' | 'select' | 'textarea';
    required: boolean;
    placeholder?: string;
    options?: Array<{ value: string; label: string }>;
    rows?: number;
}

interface FormCheckbox {
    name: string;
    label: string;
}

interface PhoneInfo {
    text: string;
    number: string;
}

export interface EcommerceCTAFormProps {
    title: string;
    description: string;
    theme?: 'emerald' | 'blue' | 'purple';
    fields: FormField[];
    checkbox?: FormCheckbox;
    submitText: string;
    submitNote: string;
    phone?: PhoneInfo;
}

export function EcommerceCTAForm({
    title,
    description,
    theme = 'emerald',
    fields,
    checkbox,
    submitText,
    submitNote,
    phone
}: EcommerceCTAFormProps) {
    const accentColor = theme;
    const [formData, setFormData] = useState<Record<string, string | boolean>>({});
    const [isSubmitting, setIsSubmitting] = useState(false);
    const [isSuccess, setIsSuccess] = useState(false);

    // Initialize form state
    React.useEffect(() => {
        const initialData: Record<string, string | boolean> = {};
        fields.forEach(field => {
            initialData[field.name] = '';
        });
        if (checkbox) {
            initialData[checkbox.name] = false;
        }
        setFormData(initialData);
    }, [fields, checkbox]);

    const handleChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
        const { name, value, type } = e.target;
        if (type === 'checkbox') {
            const target = e.target as HTMLInputElement;
            setFormData(prev => ({ ...prev, [name]: target.checked }));
        } else {
            setFormData(prev => ({ ...prev, [name]: value }));
        }
    };

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        setIsSubmitting(true);

        // Simulate submission
        setTimeout(() => {
            setIsSubmitting(false);
            setIsSuccess(true);
            console.log('Form submitted:', formData);
        }, 1500);
    };

    if (isSuccess) {
        return (
            <section className="py-24 bg-slate-800" id="presupuesto">
                <div className="max-w-3xl mx-auto px-4 sm:px-6 text-center">
                    <div className={`w-20 h-20 bg-${accentColor}-500/20 rounded-full flex items-center justify-center mx-auto mb-6`}>
                        <Send className={`w-10 h-10 text-${accentColor}-400`} />
                    </div>
                    <h2 className="text-3xl font-bold text-white mb-4">¡Mensaje recibido!</h2>
                    <p className="text-slate-400 text-lg mb-8">
                        He recibido tu solicitud correctamente. Analizaré tu proyecto y te contactaré en menos de 24-48 horas.
                    </p>
                    <button
                        onClick={() => setIsSuccess(false)}
                        className={`text-${accentColor}-400 font-medium hover:underline`}
                    >
                        Enviar otra solicitud
                    </button>
                </div>
            </section>
        );
    }

    return (
        <section className="py-24 bg-slate-800" id="presupuesto">
            <div className="max-w-4xl mx-auto px-4 sm:px-6">
                <div className="bg-slate-900 rounded-3xl p-8 md:p-12 border border-slate-700 shadow-2xl">
                    <div className="text-center mb-10">
                        <h2 className="text-3xl md:text-4xl font-bold text-white mb-4">
                            {title}
                        </h2>
                        <p className="text-slate-400 text-lg">
                            {description}
                        </p>
                    </div>

                    <form onSubmit={handleSubmit} className="space-y-6">
                        <div className="grid md:grid-cols-2 gap-6">
                            {fields.map((field, index) => {
                                const isFullWidth = field.type === 'textarea' || field.type === 'select';

                                return (
                                    <div key={index} className={field.name === 'mensaje' || isFullWidth ? 'md:col-span-2' : ''}>
                                        <label htmlFor={field.name} className="block text-sm font-medium text-slate-300 mb-2">
                                            {field.label} {field.required && <span className={`text-${accentColor}-400`}>*</span>}
                                        </label>

                                        {field.type === 'textarea' ? (
                                            <textarea
                                                id={field.name}
                                                name={field.name}
                                                required={field.required}
                                                placeholder={field.placeholder}
                                                rows={field.rows || 4}
                                                className="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                                                onChange={handleChange}
                                                value={formData[field.name] as string}
                                            />
                                        ) : field.type === 'select' ? (
                                            <select
                                                id={field.name}
                                                name={field.name}
                                                required={field.required}
                                                className="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition appearance-none"
                                                onChange={handleChange}
                                                value={formData[field.name] as string}
                                            >
                                                {field.options?.map((opt, i) => (
                                                    <option key={i} value={opt.value}>{opt.label}</option>
                                                ))}
                                            </select>
                                        ) : (
                                            <input
                                                type={field.type}
                                                id={field.name}
                                                name={field.name}
                                                required={field.required}
                                                placeholder={field.placeholder}
                                                className="w-full bg-slate-800 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition"
                                                onChange={handleChange}
                                                value={formData[field.name] as string}
                                            />
                                        )}
                                    </div>
                                );
                            })}
                        </div>

                        {checkbox && (
                            <div className="flex items-start gap-3">
                                <input
                                    type="checkbox"
                                    id={checkbox.name}
                                    name={checkbox.name}
                                    className={`mt-1 w-5 h-5 rounded border-slate-600 bg-slate-800 text-${accentColor}-500 focus:ring-${accentColor}-500 focus:ring-offset-slate-900`}
                                    onChange={handleChange}
                                    checked={formData[checkbox.name] as boolean || false}
                                />
                                <label htmlFor={checkbox.name} className="text-sm text-slate-400">
                                    {checkbox.label}
                                </label>
                            </div>
                        )}

                        <div className="pt-4">
                            <button
                                type="submit"
                                disabled={isSubmitting}
                                className={`w-full bg-gradient-to-r from-${accentColor}-500 to-teal-500 hover:from-${accentColor}-400 hover:to-teal-400 text-white font-bold py-4 rounded-xl text-lg transition-all transform hover:scale-[1.01] shadow-lg shadow-${accentColor}-500/25 flex items-center justify-center gap-2 disabled:opacity-70 disabled:cursor-not-allowed`}
                            >
                                {isSubmitting ? (
                                    <>
                                        <Loader2 className="w-5 h-5 animate-spin" />
                                        Enviando...
                                    </>
                                ) : (
                                    <>
                                        <Send className="w-5 h-5" />
                                        {submitText}
                                    </>
                                )}
                            </button>
                            <p className="text-center text-slate-500 text-sm mt-4">
                                {submitNote}
                            </p>
                        </div>
                    </form>

                    {phone && (
                        <div className="mt-8 pt-8 border-t border-slate-800 grid place-items-center">
                            <a
                                href={`tel:${phone.number.replace(/\s/g, '')}`}
                                className="flex items-center gap-2 text-slate-400 hover:text-white transition-colors"
                            >
                                <Phone className="w-4 h-4" />
                                <span>{phone.text} <span className="text-white font-medium">{phone.number}</span></span>
                            </a>
                        </div>
                    )}
                </div>
            </div>
        </section>
    );
}

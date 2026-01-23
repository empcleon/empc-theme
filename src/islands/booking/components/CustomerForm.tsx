
import React, { useState, useEffect } from 'react';
import { User, Phone, ArrowRight } from 'lucide-react';
import { validateName, validatePhone } from '../lib/validation';

interface CustomerFormProps {
    data: { name: string; phone: string; notes?: string };
    onChange: (data: any) => void;
    onSubmit: () => void;
    isSubmitting: boolean;
}

const CustomerForm: React.FC<CustomerFormProps> = ({ data, onChange, onSubmit, isSubmitting }) => {
    const [touched, setTouched] = useState({ name: false, phone: false });
    const [errors, setErrors] = useState<Record<string, string | null>>({});

    // Validate on change if touched
    useEffect(() => {
        if (touched.name) setErrors(e => ({ ...e, name: validateName(data.name) }));
    }, [data.name, touched.name]);

    useEffect(() => {
        if (touched.phone) setErrors(e => ({ ...e, phone: validatePhone(data.phone) }));
    }, [data.phone, touched.phone]);

    const handleChange = (field: string, value: string) => {
        onChange({ ...data, [field]: value });
    };

    const handleBlur = (field: 'name' | 'phone') => {
        setTouched({ ...touched, [field]: true });
        // Trigger validation immediately on blur
        if (field === 'name') setErrors(e => ({ ...e, name: validateName(data.name) }));
        if (field === 'phone') setErrors(e => ({ ...e, phone: validatePhone(data.phone) }));
    };

    const isValid = !validateName(data.name) && !validatePhone(data.phone) && data.name && data.phone;

    return (
        <div className="space-y-6 animate-fade-in">
            <h3 className="text-xl font-bold text-white mb-4">Tus datos de contacto</h3>

            <div className="space-y-4">
                {/* Name */}
                <div className="space-y-1">
                    <label className="text-sm text-slate-300 ml-1">Nombre Completo</label>
                    <div className="relative">
                        <User className="absolute left-3 top-3.5 w-5 h-5 text-slate-500" />
                        <input
                            type="text"
                            value={data.name}
                            onChange={(e) => handleChange('name', e.target.value)}
                            onBlur={() => handleBlur('name')}
                            className={`w-full bg-slate-800 border rounded-xl py-3 pl-10 pr-4 text-white placeholder-slate-600 focus:outline-none focus:ring-1 focus:ring-rose-500 transition-all ${errors.name ? 'border-red-500' : 'border-slate-700'}`}
                            placeholder="Tu nombre"
                        />
                    </div>
                    {errors.name && <p className="text-xs text-red-400 ml-1">{errors.name}</p>}
                </div>

                {/* Phone */}
                <div className="space-y-1">
                    <label className="text-sm text-slate-300 ml-1">Teléfono (WhatsApp)</label>
                    <div className="relative">
                        <Phone className="absolute left-3 top-3.5 w-5 h-5 text-slate-500" />
                        <input
                            type="tel"
                            value={data.phone}
                            onChange={(e) => handleChange('phone', e.target.value)}
                            onBlur={() => handleBlur('phone')}
                            className={`w-full bg-slate-800 border rounded-xl py-3 pl-10 pr-4 text-white placeholder-slate-600 focus:outline-none focus:ring-1 focus:ring-rose-500 transition-all ${errors.phone ? 'border-red-500' : 'border-slate-700'}`}
                            placeholder="600 000 000"
                        />
                    </div>
                    {errors.phone && <p className="text-xs text-red-400 ml-1">{errors.phone}</p>}
                </div>
            </div>

            <button
                full-width="true"
                onClick={onSubmit}
                disabled={!isValid || isSubmitting}
                className="w-full bg-rose-600 hover:bg-rose-500 disabled:bg-slate-700 disabled:text-slate-500 disabled:cursor-not-allowed text-white font-bold py-3.5 rounded-xl flex items-center justify-center gap-2 transition-all shadow-lg hover:shadow-rose-900/20"
            >
                {isSubmitting ? 'Procesando...' : 'Confirmar Reserva'} <ArrowRight className="w-5 h-5" />
            </button>
        </div>
    );
};

export default CustomerForm;

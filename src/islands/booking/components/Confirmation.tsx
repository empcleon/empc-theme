
import React from 'react';
import { Check, MessageCircle } from 'lucide-react';
import { BookingPayload, BookingConfig } from '../types';
import { formatDateES } from '../lib/date';
import { buildWhatsAppMessage, buildWhatsAppUrl } from '../lib/whatsapp';

interface ConfirmationProps {
    data: BookingPayload;
    config: BookingConfig;
}

const Confirmation: React.FC<ConfirmationProps> = ({ data, config }) => {

    // Build WhatsApp URL
    const message = buildWhatsAppMessage(data, config.businessName);
    const url = buildWhatsAppUrl(config.businessPhone, message);

    const handleOpenWhatsApp = () => {
        window.open(url, '_blank');
    };

    return (
        <div className="text-center py-6 animate-fade-in">
            <div className="w-20 h-20 bg-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-6 border border-emerald-500/30">
                <Check className="w-10 h-10 text-emerald-400" />
            </div>

            <h2 className="text-2xl font-bold text-white mb-2">¡Todo listo!</h2>
            <p className="text-slate-400 mb-8 max-w-xs mx-auto">
                Tu cita está reservada para el <strong>{formatDateES(data.date)}</strong> a las <strong>{data.slot}</strong>.
            </p>

            <div className="bg-slate-800 p-6 rounded-xl border border-slate-700 mb-8 text-left">
                <h4 className="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Resumen</h4>
                <div className="text-white space-y-1">
                    <p><span className="text-slate-400">Nombre:</span> {data.name}</p>
                    <p><span className="text-slate-400">Teléfono:</span> {data.phone}</p>
                </div>
            </div>

            <button
                onClick={handleOpenWhatsApp}
                className="w-full bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold py-4 rounded-xl flex items-center justify-center gap-2 transition-all shadow-lg hover:shadow-emerald-900/20"
            >
                <MessageCircle className="w-6 h-6" />
                Confirmar por WhatsApp
            </button>
            <p className="text-xs text-slate-500 mt-4">Se abrirá WhatsApp para enviar los detalles.</p>
        </div>
    );
};

export default Confirmation;


import { formatDateES } from './date';
import { BookingPayload } from '../types';

export function normalizePhone(input: string, defaultCountryCode = '34'): string {
    let clean = input.replace(/\D/g, ''); // Solo dígitos

    // Si empieza por 00, quitarlo
    if (clean.startsWith('00')) {
        clean = clean.substring(2);
    }

    // Heurística simple para España: si tiene 9 dígitos y no empieza por 34, añadir 34
    if (clean.length === 9) {
        return `${defaultCountryCode}${clean}`;
    }

    return clean;
}

export function buildWhatsAppMessage(payload: BookingPayload, businessName?: string): string {
    const msg = [
        `📅 *Nueva Reserva* ${businessName ? `para ${businessName}` : ''}`,
        `👤 Cliente: ${payload.name}`,
        `📞 Tel: ${payload.phone}`,
        `🗓 Fecha: ${formatDateES(payload.date)}`,
        `⏰ Hora: ${payload.slot}`,
    ];

    if (payload.notes) {
        msg.push(`📝 Notas: ${payload.notes}`);
    }

    // Add signature/source
    msg.push('');
    msg.push('_Enviado desde la web_');

    return msg.join('\n');
}

export function buildWhatsAppUrl(targetPhone: string, message: string): string {
    const normalizedPhone = normalizePhone(targetPhone);
    const encodedMessage = encodeURIComponent(message);
    return `https://wa.me/${normalizedPhone}?text=${encodedMessage}`;
}


export function validateName(name: string): string | null {
    if (!name || name.trim().length < 3) {
        return 'El nombre debe tener al menos 3 caracteres.';
    }
    return null;
}

export function validatePhone(phone: string): string | null {
    // Normalizar: quitar espacios, guiones
    const cleaned = phone.replace(/[\s-]/g, '');

    // Regex simple: acepta + dígitos o 00 dígitos.
    // Longitud mínima 9 (España sin prefijo) a 15 (Internacional completo)
    // España fijo o movil: 9 digitos
    if (!/^\+?d{9,15}$/.test(cleaned) && !/^\d{9,15}$/.test(cleaned)) {
        return 'Introduce un teléfono válido (mínimo 9 dígitos).';
    }
    return null;
}

export function isStepSelectValid(date: Date | null, slot: string | null): boolean {
    return !!date && !!slot;
}

export const SERVICE_TYPES = {
    'diseno-web': 'Diseño web',
    'tienda-online': 'Tienda online WooCommerce',
    'mantenimiento-wordpress': 'Mantenimiento WordPress',
    'consultoria-wordpress': 'Consultoría WordPress',
    'reparacion-wordpress': 'Reparación WordPress',
    wpo: 'Optimización WPO',
    'alquiler-web': 'Alquiler de página web',
    'contenidos-web': 'Redacción de contenidos web'
} as const;

export type ServiceType = keyof typeof SERVICE_TYPES;

export interface ServiceAttribution {
    value: ServiceType;
    label: (typeof SERVICE_TYPES)[ServiceType];
}

export const SERVICE_OPTIONS: ServiceAttribution[] = Object.entries(SERVICE_TYPES).map(([value, label]) => ({
    value: value as ServiceType,
    label
}));

function normalizeServiceType(value: string): string {
    return value.trim().toLowerCase();
}

export function getServiceAttribution(value: string | null | undefined): ServiceAttribution | null {
    const normalized = normalizeServiceType(value ?? '');
    if (!Object.prototype.hasOwnProperty.call(SERVICE_TYPES, normalized)) {
        return null;
    }

    const serviceValue = normalized as ServiceType;
    return {
        value: serviceValue,
        label: SERVICE_TYPES[serviceValue]
    };
}

export function readServiceAttribution(search = typeof window === 'undefined' ? '' : window.location.search): ServiceAttribution | null {
    const value = new URLSearchParams(search).get('tipo');
    return getServiceAttribution(value);
}

declare global {
    interface Window {
        gtag?: (...args: unknown[]) => void;
        __empcAnalyticsConsent?: boolean;
    }
}

export function emitGenerateLead(serviceType: ServiceType, formName: string): boolean {
    if (typeof window === 'undefined' || typeof window.gtag !== 'function') {
        return false;
    }

    if (window.__empcAnalyticsConsent === false) {
        return false;
    }

    window.gtag('event', 'generate_lead', {
        form_name: formName,
        service_type: serviceType
    });
    return true;
}

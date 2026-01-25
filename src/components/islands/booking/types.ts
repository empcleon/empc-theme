
export interface BookingConfig {
    nonce?: string;
    restUrl?: string;
    city?: string;
    businessPhone: string; // wa.me format (digits)
    businessName?: string;
    timezone?: string;
}

export interface BookingPayload {
    name: string;
    phone: string;
    date: Date;
    slot: string;
    notes?: string;
}

export type BookingStep = 'select' | 'details' | 'confirm';

export interface BookingState {
    step: BookingStep;
    selectedDate: Date | null;
    selectedTimeSlot: string | null;
    customerName: string;
    customerPhone: string;
    isSubmitting: boolean;
    errors: Record<string, string>;
}


/**
 * Date Utilities for EMPC Booking Island
 * Week starts on Monday (Spain standard)
 */

export const MONTH_NAMES = [
    'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
];

export const WEEK_DAYS = ['L', 'M', 'X', 'J', 'V', 'S', 'D'];

export function getMonthMatrix(year: number, month: number): (Date | null)[][] {
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0);

    // 0 = Sunday, 1 = Monday. We want Monday=0, Sunday=6
    let startDayDetails = firstDay.getDay(); // 0(Sun) - 6(Sat)
    // Convert to Monday start: 0->6, 1->0, 2->1 ...
    // Map: 1->0, 2->1, ... 6->5, 0->6
    const startDow = (startDayDetails + 6) % 7;

    const daysInMonth = lastDay.getDate();
    const rows: (Date | null)[][] = [];
    let cells: (Date | null)[] = [];

    // Fill empty cells before first day
    for (let i = 0; i < startDow; i++) {
        cells.push(null);
    }

    // Fill days
    for (let d = 1; d <= daysInMonth; d++) {
        cells.push(new Date(year, month, d));
        if (cells.length === 7) {
            rows.push(cells);
            cells = [];
        }
    }

    // Fill remaining cells
    if (cells.length > 0) {
        while (cells.length < 7) {
            cells.push(null);
        }
        rows.push(cells);
    }

    return rows;
}

export function isPastDate(date: Date): boolean {
    const today = new Date();
    today.setHours(0, 0, 0, 0);
    // Compare new Date for 'date' to strip time components if any
    const d = new Date(date);
    d.setHours(0, 0, 0, 0);
    return d < today;
}

export function isToday(date: Date): boolean {
    const today = new Date();
    return date.getDate() === today.getDate() &&
        date.getMonth() === today.getMonth() &&
        date.getFullYear() === today.getFullYear();
}

/**
 * Check if a time slot (HH:MM) is in the past relative to now.
 * Only applicable if date is TODAY.
 */
export function isPastTime(slot: string): boolean {
    const now = new Date();
    const [h, m] = slot.split(':').map(Number);
    const slotDate = new Date();
    slotDate.setHours(h, m, 0, 0);
    return slotDate < now;
}

export function formatDateES(date: Date): string {
    return `${date.getDate()} de ${MONTH_NAMES[date.getMonth()]} de ${date.getFullYear()}`;
}

export function toISODate(date: Date): string {
    const y = date.getFullYear();
    const m = String(date.getMonth() + 1).padStart(2, '0');
    const d = String(date.getDate()).padStart(2, '0');
    return `${y}-${m}-${d}`;
}

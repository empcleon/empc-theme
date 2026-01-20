export type BookingMode = 'none' | 'reservation' | 'pickup';

export interface MenuItem {
  id: string;
  title: string;
  description: string;
  price: number;
  category: 'tapas' | 'main' | 'drinks';
  image: string; // Emoji or URL
}

export interface CartItem extends MenuItem {
  quantity: number;
}

export interface TimeSlot {
  id: string;
  time: string;
  period: 'lunch' | 'dinner';
  available: boolean;
  limited?: boolean;
}

export interface DayAvailability {
  date: Date;
  slots: TimeSlot[];
}

export interface ContactData {
  name: string;
  email: string;
  phone: string;
  notes: string;
}

export interface BookingState {
  mode: BookingMode;
  partySize: number;
  date: Date | null;
  slotId: string | null;
  cart: CartItem[];
  contact: ContactData;
}

export type StepProps = {
  bookingData: BookingState;
  updateBooking: (data: Partial<BookingState>) => void;
  onNext: () => void;
  onBack: () => void;
  reset?: () => void;
};

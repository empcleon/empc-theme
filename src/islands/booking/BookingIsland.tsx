
import React, { useState, useEffect } from 'react';
import { Calendar, CheckCircle2 } from 'lucide-react';
import CalendarGrid from './components/CalendarGrid';
import TimeSlotPicker from './components/TimeSlotPicker';
import CustomerForm from './components/CustomerForm';
import Confirmation from './components/Confirmation';
import { BookingConfig, BookingState } from './types';
import { formatDateES } from './lib/date';

const StepsIndicator = ({ currentStep }: { currentStep: string }) => {
    const steps = ['select', 'details', 'confirm'];
    const idx = steps.indexOf(currentStep);

    return (
        <div className="flex items-center gap-2 mb-6 justify-center">
            {steps.map((s, i) => (
                <div key={s} className={`h-1.5 w-8 rounded-full transition-all duration-500 ${i <= idx ? 'bg-rose-500' : 'bg-slate-700'}`} />
            ))}
        </div>
    );
};

const BookingIsland = () => {
    const [config, setConfig] = useState<BookingConfig | null>(null);
    const [state, setState] = useState<BookingState>({
        step: 'select',
        selectedDate: null,
        selectedTimeSlot: null,
        customerName: '',
        customerPhone: '',
        isSubmitting: false,
        errors: {}
    });

    useEffect(() => {
        // Load config from window
        // @ts-ignore
        const winConfig = window.empcConfig;
        if (winConfig) {
            setConfig(winConfig);
        } else {
            console.error("EMPC Booking: Config not found");
        }
    }, []);

    if (!config) {
        return null; // Fail silently or show skeleton
    }

    const { step, selectedDate, selectedTimeSlot, customerName, customerPhone, isSubmitting } = state;

    // --- Actions ---

    const handleDateSelect = (date: Date) => {
        setState(prev => ({ ...prev, selectedDate: date, selectedTimeSlot: null })); // Reset slot on date change
    };

    const handleSlotSelect = (slot: string) => {
        setState(prev => ({ ...prev, selectedTimeSlot: slot }));
    };

    const goToDetails = () => {
        if (selectedDate && selectedTimeSlot) {
            setState(prev => ({ ...prev, step: 'details' }));
        }
    };

    const handleSubmitBooking = async () => {
        // En MVP solo simulamos un pequeño delay y pasamos a confirm
        // Post-MVP: aquí llamamos a la API de WP para logging
        setState(prev => ({ ...prev, isSubmitting: true }));

        // Simular API call
        setTimeout(() => {
            setState(prev => ({ ...prev, isSubmitting: false, step: 'confirm' }));
        }, 800);
    };

    return (
        <div className="w-full max-w-md mx-auto bg-slate-900 border border-slate-800 rounded-2xl shadow-2xl overflow-hidden font-sans">
            {/* Header */}
            <div className="bg-slate-800/50 p-4 border-b border-slate-800 flex items-center justify-between">
                <div className="flex items-center gap-2">
                    <Calendar className="text-rose-500 w-5 h-5" />
                    <span className="font-bold text-white text-sm tracking-wide">RESERVAR CITA</span>
                </div>
                {selectedDate && step !== 'confirm' && (
                    <span className="text-xs font-medium text-rose-400 bg-rose-500/10 px-2 py-1 rounded">
                        {formatDateES(selectedDate)}
                    </span>
                )}
            </div>

            <div className="p-6">
                <StepsIndicator currentStep={step} />

                {/* Step 1: Select */}
                {step === 'select' && (
                    <div className="space-y-6 animate-fade-in">
                        <CalendarGrid selectedDate={selectedDate} onSelectDate={handleDateSelect} />

                        <div className="border-t border-slate-800 pt-6">
                            <h4 className="text-white font-bold mb-4 text-sm uppercase text-slate-400">Horarios Disponibles</h4>
                            <TimeSlotPicker selectedDate={selectedDate} selectedSlot={selectedTimeSlot} onSelectSlot={handleSlotSelect} />
                        </div>

                        <button
                            disabled={!selectedDate || !selectedTimeSlot}
                            onClick={goToDetails}
                            className="w-full mt-6 bg-white text-slate-900 hover:bg-slate-200 disabled:bg-slate-800 disabled:text-slate-600 font-bold py-3.5 rounded-xl transition-all disabled:cursor-not-allowed"
                        >
                            Continuar
                        </button>
                    </div>
                )}

                {/* Step 2: Details */}
                {step === 'details' && (
                    <CustomerForm
                        data={{ name: customerName, phone: customerPhone }}
                        onChange={(d) => setState(prev => ({ ...prev, customerName: d.name, customerPhone: d.phone }))}
                        onSubmit={handleSubmitBooking}
                        isSubmitting={isSubmitting}
                    />
                )}

                {/* Step 3: Confirm */}
                {step === 'confirm' && selectedDate && selectedTimeSlot && (
                    <Confirmation
                        config={config}
                        data={{
                            name: customerName,
                            phone: customerPhone,
                            date: selectedDate,
                            slot: selectedTimeSlot
                        }}
                    />
                )}

                {step === 'details' && (
                    <button onClick={() => setState(prev => ({ ...prev, step: 'select' }))} className="mt-4 w-full text-slate-500 text-sm hover:text-white pb-2">
                        Volver a calendario
                    </button>
                )}
            </div>
        </div>
    );
};

export default BookingIsland;

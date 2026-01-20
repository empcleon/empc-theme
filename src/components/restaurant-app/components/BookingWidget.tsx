import React, { useState } from 'react';
import { BookingState, BookingMode } from '../types';
import HomeSelection from './HomeSelection';
import StepPartySize from './StepPartySize';
import StepMenu from './StepMenu';
import StepDateTime from './StepDateTime';
import StepContact from './StepContact';
import StepSummary from './StepSummary';
import { ChevronLeft } from 'lucide-react';

const BookingWidget: React.FC = () => {
  const [step, setStep] = useState(0);
  const [bookingData, setBookingData] = useState<BookingState>({
    mode: 'none',
    partySize: 2,
    date: null,
    slotId: null,
    cart: [],
    contact: {
      name: '',
      email: '',
      phone: '',
      notes: ''
    }
  });

  const updateBooking = (data: Partial<BookingState>) => {
    setBookingData(prev => ({ ...prev, ...data }));
  };

  const nextStep = () => setStep(prev => prev + 1);
  const prevStep = () => setStep(prev => prev - 1);
  
  const reset = () => {
    setStep(0);
    setBookingData({
        mode: 'none',
        partySize: 2,
        date: null,
        slotId: null,
        cart: [],
        contact: { name: '', email: '', phone: '', notes: '' }
    });
  };

  const handleModeSelect = (mode: BookingMode) => {
    updateBooking({ mode });
    setStep(1);
  };

  // Progress logic
  const totalSteps = bookingData.mode === 'reservation' ? 4 : 3;
  const progress = (step / totalSteps) * 100;

  return (
    <div className="w-full max-w-lg mx-auto bg-white min-h-[600px] md:min-h-auto md:rounded-[2.5rem] shadow-2xl shadow-emerald-900/10 overflow-hidden flex flex-col relative border border-slate-100">
      
      {/* Simulation Header */}
      <div className="bg-slate-900 p-4 flex justify-between items-center text-white">
          <div className="flex items-center gap-2">
             <div className="w-2 h-2 rounded-full bg-emerald-500"></div>
             <span className="text-xs font-bold uppercase tracking-wider">Simulador Restaurante v1.0</span>
          </div>
          {step > 0 && (
              <button onClick={reset} className="text-xs bg-white/10 hover:bg-white/20 px-3 py-1 rounded-full transition-colors">
                  Reiniciar
              </button>
          )}
      </div>

      {/* Progress Bar (Only inside flows) */}
      {step > 0 && (
        <div className="h-1 bg-gray-100 w-full">
            <div 
            className={`h-full transition-all duration-500 ease-out ${bookingData.mode === 'reservation' ? 'bg-emerald-500' : 'bg-orange-500'}`}
            style={{ width: `${progress}%` }}
            ></div>
        </div>
      )}

      <div className="p-6 md:p-8 flex-1 flex flex-col">
        {step === 0 && <HomeSelection onSelect={handleModeSelect} />}

        {/* RESERVATION FLOW */}
        {bookingData.mode === 'reservation' && (
            <>
                {step === 1 && <StepPartySize bookingData={bookingData} updateBooking={updateBooking} onNext={nextStep} onBack={reset} />}
                {step === 2 && <StepDateTime bookingData={bookingData} updateBooking={updateBooking} onNext={nextStep} onBack={prevStep} />}
                {step === 3 && <StepContact bookingData={bookingData} updateBooking={updateBooking} onNext={nextStep} onBack={prevStep} />}
                {step === 4 && <StepSummary bookingData={bookingData} updateBooking={updateBooking} onNext={nextStep} onBack={prevStep} reset={reset} />}
            </>
        )}

        {/* PICKUP FLOW */}
        {bookingData.mode === 'pickup' && (
            <>
                {step === 1 && <StepMenu bookingData={bookingData} updateBooking={updateBooking} onNext={nextStep} onBack={reset} />}
                {step === 2 && <StepContact bookingData={bookingData} updateBooking={updateBooking} onNext={nextStep} onBack={prevStep} />}
                {step === 3 && <StepSummary bookingData={bookingData} updateBooking={updateBooking} onNext={nextStep} onBack={prevStep} reset={reset} />}
            </>
        )}
      </div>
    </div>
  );
};

export default BookingWidget;
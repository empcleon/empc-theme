import React, { useState, useMemo } from 'react';
import { StepProps, DayAvailability, TimeSlot } from '../types';
import { getAvailableDays } from '../constants';
import Button from './ui/Button';
import { Calendar, Clock, ChevronLeft, ChevronRight, Zap } from 'lucide-react';

const StepDateTime: React.FC<StepProps> = ({ bookingData, updateBooking, onNext, onBack }) => {
  const [selectedDayIndex, setSelectedDayIndex] = useState(0);
  
  const availableDays = useMemo<DayAvailability[]>(() => getAvailableDays(), []);
  const currentDay = availableDays[selectedDayIndex];

  const handleDateSelect = (index: number) => {
    setSelectedDayIndex(index);
    updateBooking({ date: availableDays[index].date, slotId: null });
  };

  const handleSlotSelect = (slotId: string) => {
    updateBooking({ 
        date: currentDay.date,
        slotId: slotId 
    });
  };

  // Group slots by restaurant periods
  const lunchSlots = currentDay?.slots.filter(s => s.period === 'lunch') || [];
  const dinnerSlots = currentDay?.slots.filter(s => s.period === 'dinner') || [];

  return (
    <div className="space-y-8 fade-in">
      <div className="text-center">
        <h2 className="text-2xl font-display font-bold text-gray-900">¿Cuándo vienes?</h2>
        <p className="text-gray-500 mt-2">Elige fecha y turno de comida o cena.</p>
      </div>

      {/* Date Selector */}
      <div className="bg-white p-4 rounded-3xl shadow-sm border border-gray-100">
        <div className="flex items-center justify-between mb-4 px-2">
            <span className="font-bold text-gray-700 flex items-center gap-2">
                <Calendar size={18} className="text-emerald-500"/> 
                {currentDay?.date.toLocaleDateString('es-ES', { month: 'long', year: 'numeric' })}
            </span>
            <div className="flex gap-2">
                <button 
                    disabled={selectedDayIndex === 0}
                    onClick={() => handleDateSelect(selectedDayIndex - 1)}
                    className="p-2 rounded-xl hover:bg-gray-100 disabled:opacity-30 text-gray-600"
                >
                    <ChevronLeft size={20} />
                </button>
                <button 
                    disabled={selectedDayIndex === availableDays.length - 1}
                    onClick={() => handleDateSelect(selectedDayIndex + 1)}
                    className="p-2 rounded-xl hover:bg-gray-100 disabled:opacity-30 text-gray-600"
                >
                    <ChevronRight size={20} />
                </button>
            </div>
        </div>
        
        <div className="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">
          {availableDays.map((day, idx) => {
            const isSelected = selectedDayIndex === idx;
            const dateStr = day.date.toLocaleDateString('es-ES', { weekday: 'short', day: 'numeric' });
            const [weekday, dayNum] = dateStr.split(' ');
            
            return (
              <button
                key={idx}
                onClick={() => handleDateSelect(idx)}
                className={`
                  flex-shrink-0 flex flex-col items-center justify-center w-20 h-24 rounded-2xl border-2 transition-all duration-200
                  ${isSelected 
                    ? 'border-emerald-500 bg-emerald-500 text-white shadow-lg shadow-emerald-500/25 transform scale-105' 
                    : 'border-gray-100 bg-white text-gray-600 hover:border-gray-200 hover:bg-gray-50'
                  }
                `}
              >
                <span className={`text-xs uppercase font-medium mb-1 ${isSelected ? 'text-emerald-100' : 'text-gray-400'}`}>
                  {weekday.replace('.', '')}
                </span>
                <span className="text-2xl font-bold">
                  {dayNum}
                </span>
              </button>
            );
          })}
        </div>
      </div>

      {/* Time Slots */}
      <div className="space-y-6">
        {lunchSlots.length > 0 && (
          <div>
            <h3 className="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 px-1 flex items-center gap-2">
                <span className="text-xl">☀️</span>
                Comidas (13:30 - 15:30)
            </h3>
            <div className="grid grid-cols-2 sm:grid-cols-4 gap-3">
              {lunchSlots.map(slot => (
                <TimeSlotButton 
                    key={slot.id} 
                    slot={slot} 
                    isSelected={bookingData.slotId === slot.id} 
                    onSelect={() => handleSlotSelect(slot.id)} 
                />
              ))}
            </div>
          </div>
        )}

        {dinnerSlots.length > 0 && (
          <div>
            <h3 className="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3 px-1 flex items-center gap-2">
                 <span className="text-xl">🌙</span>
                Cenas (20:30 - 22:30)
            </h3>
            <div className="grid grid-cols-2 sm:grid-cols-4 gap-3">
              {dinnerSlots.map(slot => (
                 <TimeSlotButton 
                    key={slot.id} 
                    slot={slot} 
                    isSelected={bookingData.slotId === slot.id} 
                    onSelect={() => handleSlotSelect(slot.id)} 
                />
              ))}
            </div>
          </div>
        )}
      </div>

      <div className="flex gap-4 pt-4">
        <Button onClick={onBack} variant="ghost" className="w-1/3">
          Atrás
        </Button>
        <Button 
          onClick={onNext} 
          disabled={!bookingData.slotId}
          fullWidth={true}
          className="flex-1 !bg-emerald-600 hover:!bg-emerald-700 focus:!ring-emerald-500 shadow-emerald-500/30"
        >
          Siguiente
        </Button>
      </div>
    </div>
  );
};

interface TimeSlotButtonProps {
    slot: TimeSlot;
    isSelected: boolean;
    onSelect: () => void;
}

const TimeSlotButton: React.FC<TimeSlotButtonProps> = ({ slot, isSelected, onSelect }) => {
    return (
        <button
          onClick={onSelect}
          disabled={!slot.available}
          className={`
            relative p-3 rounded-2xl border text-sm font-semibold transition-all duration-200
            flex items-center justify-center gap-2
            ${!slot.available 
                ? 'bg-gray-50 text-gray-300 border-gray-100 cursor-not-allowed decoration-slice' 
                : isSelected
                    ? 'bg-emerald-600 text-white border-emerald-600 shadow-md ring-2 ring-emerald-200 ring-offset-1'
                    : 'bg-white text-gray-700 border-gray-200 hover:border-emerald-300 hover:bg-emerald-50 hover:text-emerald-700'
            }
          `}
        >
          <Clock size={16} className={isSelected ? 'text-white' : 'text-gray-400'} />
          {slot.time}
          {slot.limited && slot.available && !isSelected && (
              <span className="absolute -top-2 -right-2 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full shadow-sm animate-pulse">
                  Última
              </span>
          )}
        </button>
    );
}

export default StepDateTime;
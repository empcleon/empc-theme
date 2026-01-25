
import React from 'react';
import { Clock } from 'lucide-react';
import { isToday, isPastTime } from '../lib/date';

interface TimeSlotPickerProps {
    selectedDate: Date | null;
    selectedSlot: string | null;
    onSelectSlot: (slot: string) => void;
}

const DEFAULT_SLOTS = ["10:00", "11:30", "16:00", "17:30"];

const TimeSlotPicker: React.FC<TimeSlotPickerProps> = ({ selectedDate, selectedSlot, onSelectSlot }) => {

    if (!selectedDate) {
        return (
            <div className="text-center py-8 text-slate-500 border border-dashed border-slate-700 rounded-xl bg-slate-800/30">
                <Clock className="w-8 h-8 mx-auto mb-2 opacity-50" />
                <p className="text-sm">Selecciona un día primero</p>
            </div>
        );
    }

    const checkIsDisabled = (slot: string) => {
        // Only check time if date is TODAY
        if (isToday(selectedDate)) {
            return isPastTime(slot);
        }
        return false;
    };

    return (
        <div className="grid grid-cols-2 gap-3 animate-fade-in">
            {DEFAULT_SLOTS.map(slot => {
                const disabled = checkIsDisabled(slot);
                const selected = selectedSlot === slot;

                return (
                    <button
                        key={slot}
                        disabled={disabled}
                        onClick={() => onSelectSlot(slot)}
                        className={`
                            py-3 px-4 rounded-xl border font-bold flex items-center justify-center transition-all
                            ${disabled
                                ? 'bg-slate-900 border-slate-800 text-slate-600 cursor-not-allowed line-through'
                                : selected
                                    ? 'bg-rose-500 border-rose-500 text-white shadow-lg shadow-rose-500/20'
                                    : 'bg-slate-800 border-slate-700 text-slate-300 hover:border-slate-500 hover:bg-slate-750'
                            }
                        `}
                    >
                        {slot}
                    </button>
                );
            })}
        </div>
    );
};

export default TimeSlotPicker;

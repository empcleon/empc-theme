import React from 'react';
import { StepProps } from '../types';
import Button from './ui/Button';
import { Users } from 'lucide-react';

const StepPartySize: React.FC<StepProps> = ({ bookingData, updateBooking, onNext, onBack }) => {
  const sizes = [1, 2, 3, 4, 5, 6, 8, 10];

  const handleSelect = (size: number) => {
    updateBooking({ partySize: size });
    onNext();
  };

  return (
    <div className="space-y-8 fade-in">
      <div className="text-center">
        <h2 className="text-2xl font-display font-bold text-gray-900">¿Mesa para cuántos?</h2>
        <p className="text-gray-500 mt-2">Indícanos el número de comensales.</p>
      </div>

      <div className="grid grid-cols-2 md:grid-cols-4 gap-4">
        {sizes.map((size) => (
          <button
            key={size}
            onClick={() => handleSelect(size)}
            className={`
              group relative p-6 rounded-3xl border-2 transition-all duration-200 flex flex-col items-center justify-center gap-3
              ${bookingData.partySize === size
                ? 'border-emerald-500 bg-emerald-50 text-emerald-700 shadow-lg shadow-emerald-500/10'
                : 'border-gray-100 bg-white text-gray-600 hover:border-emerald-200 hover:bg-emerald-50/30'
              }
            `}
          >
            <div className={`p-3 rounded-full ${bookingData.partySize === size ? 'bg-emerald-200 text-emerald-800' : 'bg-gray-100 text-gray-400 group-hover:bg-emerald-100 group-hover:text-emerald-600'}`}>
                <Users size={24} />
            </div>
            <span className="text-xl font-bold">{size}</span>
            {bookingData.partySize === size && (
                <div className="absolute top-2 right-2 w-3 h-3 bg-emerald-500 rounded-full"></div>
            )}
          </button>
        ))}
      </div>

      <div className="pt-4">
        <Button onClick={onBack} variant="ghost" fullWidth>
          Cancelar y Volver
        </Button>
      </div>
    </div>
  );
};

export default StepPartySize;
import React from 'react';
import { BookingMode } from '../types';
import { Calendar, ShoppingBag, Utensils } from 'lucide-react';

interface HomeSelectionProps {
  onSelect: (mode: BookingMode) => void;
}

const HomeSelection: React.FC<HomeSelectionProps> = ({ onSelect }) => {
  return (
    <div className="space-y-6 fade-in py-4">
      <div className="text-center mb-8">
        <div className="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <Utensils size={32} className="text-emerald-700" />
        </div>
        <h2 className="text-2xl font-display font-bold text-gray-900">¿Qué te apetece hoy?</h2>
        <p className="text-gray-500 mt-2">La mejor gastronomía de León, a tu manera.</p>
      </div>

      <div className="space-y-4">
        <button 
          onClick={() => onSelect('reservation')}
          className="w-full p-6 text-left border-2 border-gray-100 rounded-3xl hover:border-emerald-500 hover:bg-emerald-50 transition-all duration-300 group shadow-sm hover:shadow-emerald-100"
        >
          <div className="flex items-center gap-4">
            <div className="bg-emerald-100 text-emerald-700 p-4 rounded-2xl group-hover:bg-emerald-200 transition-colors">
                <Calendar size={28} />
            </div>
            <div>
                <div className="font-bold text-lg text-gray-900 group-hover:text-emerald-800">Reserva Mesa</div>
                <p className="text-sm text-gray-500 mt-1">Gestión de turnos en tiempo real.</p>
            </div>
          </div>
        </button>

        <button 
          onClick={() => onSelect('pickup')}
          className="w-full p-6 text-left border-2 border-gray-100 rounded-3xl hover:border-orange-500 hover:bg-orange-50 transition-all duration-300 group shadow-sm hover:shadow-orange-100"
        >
          <div className="flex items-center gap-4">
            <div className="bg-orange-100 text-orange-700 p-4 rounded-2xl group-hover:bg-orange-200 transition-colors">
                <ShoppingBag size={28} />
            </div>
            <div>
                <div className="font-bold text-lg text-gray-900 group-hover:text-orange-800">Pedido para Recoger</div>
                <p className="text-sm text-gray-500 mt-1">Carta digital "Click & Collect".</p>
            </div>
          </div>
        </button>
      </div>
      
      <div className="mt-8 text-center">
        <span className="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-gray-100 text-xs font-semibold text-gray-500">
            <span className="relative flex h-2 w-2">
              <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
              <span className="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
            </span>
            Cocina Abierta
        </span>
      </div>
    </div>
  );
};

export default HomeSelection;
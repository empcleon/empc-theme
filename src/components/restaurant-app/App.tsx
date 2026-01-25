import React from 'react';
import BookingWidget from './components/BookingWidget';
import { MapPin, Phone, ChefHat } from 'lucide-react';

const App: React.FC = () => {
  return (
    <div className="min-h-screen bg-slate-50 font-sans text-gray-900 selection:bg-emerald-200">
      
      {/* Background decoration */}
      <div className="fixed inset-0 z-0 overflow-hidden pointer-events-none">
        <div className="absolute -top-[20%] -left-[10%] w-[70%] h-[70%] rounded-full bg-emerald-100/40 blur-3xl"></div>
        <div className="absolute top-[20%] -right-[10%] w-[50%] h-[60%] rounded-full bg-orange-100/40 blur-3xl"></div>
      </div>

      <div className="relative z-10 max-w-5xl mx-auto px-4 py-8 md:py-12">
        
        {/* Header Content */}
        <header className="mb-10 text-center space-y-4">
          <div className="inline-flex items-center gap-2 bg-white px-4 py-1.5 rounded-full shadow-sm border border-gray-100 text-sm font-semibold text-slate-800 mb-2">
            <ChefHat size={16} className="text-emerald-600" />
            <span className="font-display">Gastronomía Auténtica</span>
          </div>
          
          <h1 className="text-4xl md:text-5xl font-display font-bold text-slate-900 tracking-tight">
            La Posada <span className="text-emerald-700">Leonesa</span>
          </h1>
          
          <p className="text-lg text-slate-600 max-w-xl mx-auto">
            Desde el cocido maragato hasta las mejores tapas del Húmedo. Reserva tu mesa o pide para llevar en segundos.
          </p>

          <div className="flex items-center justify-center gap-6 text-sm text-slate-500 pt-2">
            <div className="flex items-center gap-1 hover:text-emerald-600 cursor-pointer transition-colors">
                <MapPin size={16} /> Barrio Húmedo, León
            </div>
            <div className="flex items-center gap-1 hover:text-emerald-600 cursor-pointer transition-colors">
                <Phone size={16} /> 987 12 34 56
            </div>
          </div>
        </header>

        {/* The Simulation Widget */}
        <main id="island-restaurant-sim">
          <BookingWidget />
        </main>

        <footer className="mt-16 text-center text-sm text-slate-300">
          <p>© {new Date().getFullYear()} La Posada Leonesa. Simulador desarrollado por EMPC.</p>
        </footer>
      </div>
    </div>
  );
};

export default App;
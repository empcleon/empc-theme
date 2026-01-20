import React, { useState } from 'react';
import { StepProps } from '../types';
import { getAvailableDays } from '../constants';
import Button from './ui/Button';
import { Calendar, Clock, User, CheckCircle2, ShieldCheck, Mail, Phone, Utensils, Receipt } from 'lucide-react';

const StepSummary: React.FC<StepProps> = ({ bookingData, onBack, reset }) => {
  const [isSubmitting, setIsSubmitting] = useState(false);
  const [isSuccess, setIsSuccess] = useState(false);

  const days = getAvailableDays();
  const day = days.find(d => d.date.toDateString() === bookingData.date?.toDateString());
  const slot = day?.slots.find(s => s.id === bookingData.slotId);

  const cartTotal = bookingData.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);

  const handleConfirm = async () => {
    setIsSubmitting(true);
    await new Promise(resolve => setTimeout(resolve, 2000));
    setIsSubmitting(false);
    setIsSuccess(true);
  };

  if (isSuccess) {
    return (
      <div className="text-center py-10 fade-in flex flex-col items-center">
        <div className="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mb-6 animate-bounce">
          <CheckCircle2 size={40} className="text-emerald-600" />
        </div>
        <h2 className="text-3xl font-display font-bold text-gray-900 mb-2">
          {bookingData.mode === 'reservation' ? '¡Mesa Reservada!' : '¡Pedido Recibido!'}
        </h2>
        <p className="text-gray-500 mb-8 max-w-xs mx-auto">
          Hemos enviado los detalles a <span className="font-medium text-gray-900">{bookingData.contact.email}</span>.
        </p>
        
        <div className="bg-gray-50 rounded-2xl p-6 w-full mb-8 text-left border border-gray-100 border-dashed relative">
           <div className="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-transparent via-gray-200 to-transparent"></div>
           <p className="text-sm text-gray-400 uppercase font-bold tracking-wider mb-4 text-center">Ticket Digital</p>
           
           {bookingData.mode === 'reservation' ? (
             <div className="space-y-2 text-center">
                <p className="text-xl font-bold text-gray-900">{bookingData.partySize} Personas</p>
                <p className="text-gray-600">{bookingData.date?.toLocaleDateString()} - {slot?.time}</p>
             </div>
           ) : (
             <div className="space-y-2">
                {bookingData.cart.map(item => (
                    <div key={item.id} className="flex justify-between text-sm">
                        <span>{item.quantity}x {item.title}</span>
                        <span className="font-medium">{(item.price * item.quantity).toFixed(2)}€</span>
                    </div>
                ))}
                <div className="border-t border-gray-200 pt-2 mt-2 flex justify-between font-bold text-lg">
                    <span>Total</span>
                    <span>{cartTotal.toFixed(2)}€</span>
                </div>
             </div>
           )}
        </div>

        <Button onClick={reset} variant="outline" className="border-emerald-200 text-emerald-700 hover:bg-emerald-50">
          Volver al Inicio
        </Button>
      </div>
    );
  }

  return (
    <div className="space-y-6 fade-in">
      <div className="text-center">
        <h2 className="text-2xl font-display font-bold text-gray-900">Confirmación</h2>
        <p className="text-gray-500 mt-2">Revisa los detalles antes de finalizar.</p>
      </div>

      <div className="bg-white rounded-3xl shadow-lg shadow-gray-200/50 overflow-hidden border border-gray-100">
        <div className="bg-slate-800 p-6 text-white relative overflow-hidden">
            <div className="absolute -right-6 -top-6 w-24 h-24 bg-emerald-500 rounded-full opacity-20"></div>
            <h3 className="text-xl font-bold relative z-10">
                {bookingData.mode === 'reservation' ? 'Reserva de Mesa' : 'Pedido para Recoger'}
            </h3>
            {bookingData.mode === 'pickup' && (
                <div className="flex items-center gap-2 mt-2 opacity-90 relative z-10">
                    <span className="text-2xl font-bold">{cartTotal.toFixed(2)}€</span>
                    <span className="text-sm bg-white/20 px-2 py-0.5 rounded-lg">{bookingData.cart.reduce((a,b)=>a+b.quantity,0)} artículos</span>
                </div>
            )}
        </div>

        <div className="p-6 space-y-6">
            {bookingData.mode === 'reservation' && (
                <div className="flex items-start gap-4">
                    <div className="bg-emerald-50 p-3 rounded-2xl text-emerald-600">
                        <Calendar size={20} />
                    </div>
                    <div>
                        <p className="text-sm text-gray-500 font-medium">Fecha y Hora</p>
                        <p className="text-gray-900 font-bold capitalize">
                            {bookingData.date?.toLocaleDateString('es-ES', { weekday: 'long', day: 'numeric', month: 'long'})}
                        </p>
                        <div className="flex items-center gap-1 text-emerald-600 font-medium mt-1">
                            <Clock size={14} />
                            <span>{slot?.time}</span>
                            <span className="text-gray-400 mx-1">•</span>
                            <User size={14} />
                            <span>{bookingData.partySize} pax</span>
                        </div>
                    </div>
                </div>
            )}

            {bookingData.mode === 'pickup' && (
                 <div className="flex items-start gap-4">
                    <div className="bg-orange-50 p-3 rounded-2xl text-orange-600">
                        <Receipt size={20} />
                    </div>
                    <div className="flex-1">
                        <p className="text-sm text-gray-500 font-medium mb-1">Resumen del Pedido</p>
                        <ul className="text-sm text-gray-700 space-y-1">
                            {bookingData.cart.map(item => (
                                <li key={item.id} className="flex justify-between">
                                    <span>{item.quantity}x {item.title}</span>
                                    <span>{(item.price*item.quantity).toFixed(2)}€</span>
                                </li>
                            ))}
                        </ul>
                    </div>
                 </div>
            )}

            <div className="w-full h-px bg-gray-100"></div>

            <div className="flex items-start gap-4">
                <div className="bg-slate-50 p-3 rounded-2xl text-slate-600">
                    <User size={20} />
                </div>
                <div className="flex-1">
                    <p className="text-sm text-gray-500 font-medium">Tus Datos</p>
                    <p className="text-gray-900 font-bold">{bookingData.contact.name}</p>
                    <div className="mt-1 space-y-1">
                        <div className="flex items-center gap-2 text-sm text-gray-600">
                            <Mail size={14} /> {bookingData.contact.email}
                        </div>
                        <div className="flex items-center gap-2 text-sm text-gray-600">
                            <Phone size={14} /> {bookingData.contact.phone}
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <div className="flex gap-4 pt-2">
        <Button onClick={onBack} variant="ghost" className="w-1/3" disabled={isSubmitting}>
          Modificar
        </Button>
        <Button 
          onClick={handleConfirm} 
          fullWidth={true}
          className="flex-1 relative !bg-slate-900 hover:!bg-black shadow-slate-900/20"
          disabled={isSubmitting}
        >
          {isSubmitting ? (
              <span className="flex items-center justify-center gap-2">
                  <svg className="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle className="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" strokeWidth="4"></circle>
                    <path className="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  Procesando...
              </span>
          ) : (bookingData.mode === 'reservation' ? 'Confirmar Reserva' : 'Pagar y Pedir')}
        </Button>
      </div>
    </div>
  );
};

export default StepSummary;
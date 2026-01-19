import React, { useState } from 'react';
import { Calendar, Clock, Users, ArrowRight, Check, MapPin, Utensils } from 'lucide-react';

const RestaurantBooking = () => {
    const [step, setStep] = useState(1);
    const [booking, setBooking] = useState({
        date: '',
        time: '',
        people: 2,
        name: '',
        email: ''
    });
    const [status, setStatus] = useState<'idle' | 'submitting' | 'success'>('idle');

    // Datos simulados (Mock)
    const availableHours = ['13:30', '14:00', '14:30', '15:00', '21:00', '21:30', '22:00'];
    const today = new Date().toISOString().split('T')[0];

    const handleSubmit = (e: React.FormEvent) => {
        e.preventDefault();
        setStatus('submitting');
        // Simulamos llamada API
        setTimeout(() => {
            setStatus('success');
        }, 1500);
    };

    if (status === 'success') {
        return (
            <div className="bg-emerald-900/50 p-8 rounded-2xl border border-emerald-500/30 text-center animate-fade-in">
                <div className="w-16 h-16 bg-emerald-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <Check className="w-8 h-8 text-emerald-400" />
                </div>
                <h3 className="text-2xl font-bold text-white mb-2">¡Mesa Confirmada!</h3>
                <p className="text-emerald-200 mb-6">Te esperamos el <strong>{booking.date}</strong> a las <strong>{booking.time}</strong>.</p>
                <div className="text-white bg-slate-800 p-4 rounded-lg inline-block text-left">
                    <div className="flex items-center gap-2 mb-1">
                        <Users className="w-4 h-4 text-slate-400" />
                        <span className="font-bold">{booking.people} Personas</span>
                    </div>
                    <div className="flex items-center gap-2">
                        <MapPin className="w-4 h-4 text-slate-400" />
                        <span className="text-sm text-slate-300">Barrio Húmedo, León</span>
                    </div>
                </div>
                <button onClick={() => { setStatus('idle'); setStep(1); }} className="block w-full mt-6 text-sm text-emerald-400 hover:text-emerald-300">
                    Hacer otra reserva
                </button>
            </div>
        );
    }

    return (
        <div className="bg-white dark:bg-slate-900 rounded-2xl shadow-xl overflow-hidden border border-slate-200 dark:border-slate-700 transition-colors duration-300">
            {/* Header Visual */}
            <div className="bg-rose-600 p-6 text-white relative overflow-hidden">
                <div className="relative z-10">
                    <h3 className="text-xl font-bold flex items-center gap-2">
                        <Utensils className="w-5 h-5" />
                        Reserva tu Mesa
                    </h3>
                    <p className="text-rose-100 text-sm mt-1">Sin esperas, confirmación inmediata.</p>
                </div>
                <div className="absolute -right-4 -bottom-8 opacity-20">
                    <Utensils className="w-32 h-32 rotate-12" />
                </div>
            </div>

            <div className="p-6">
                {/* Step Indicator */}
                <div className="flex gap-2 mb-6">
                    {[1, 2, 3].map(i => (
                        <div key={i} className={`h-1.5 flex-1 rounded-full transition-all duration-300 ${step >= i ? 'bg-rose-500' : 'bg-slate-200 dark:bg-slate-700'}`} />
                    ))}
                </div>

                <form onSubmit={handleSubmit}>
                    {/* Step 1: Detalles Mesa */}
                    {step === 1 && (
                        <div className="space-y-4 animate-fade-in">
                            <div>
                                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">¿Cuándo vienes?</label>
                                <div className="relative">
                                    <input
                                        type="date"
                                        min={today}
                                        required
                                        className="w-full pl-10 pr-4 py-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 text-slate-900 dark:text-white focus:ring-2 focus:ring-rose-500 outline-none"
                                        value={booking.date}
                                        onChange={e => setBooking({ ...booking, date: e.target.value })}
                                    />
                                    <Calendar className="w-4 h-4 text-slate-400 absolute left-3 top-3" />
                                </div>
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">¿Cuántos sois?</label>
                                <div className="flex gap-2">
                                    {[2, 3, 4, 5, 6, 8].map(num => (
                                        <button
                                            key={num}
                                            type="button"
                                            onClick={() => setBooking({ ...booking, people: num })}
                                            className={`flex-1 py-2 rounded-lg border text-sm font-bold transition-all ${booking.people === num
                                                    ? 'bg-rose-600 text-white border-rose-600 shadow-md transform scale-105'
                                                    : 'bg-white dark:bg-slate-800 border-slate-300 dark:border-slate-600 text-slate-600 dark:text-slate-400 hover:border-rose-400'
                                                }`}
                                        >
                                            {num}
                                        </button>
                                    ))}
                                </div>
                            </div>

                            <button
                                type="button"
                                disabled={!booking.date}
                                onClick={() => setStep(2)}
                                className="w-full mt-4 bg-slate-900 dark:bg-white text-white dark:text-slate-900 py-3 rounded-xl font-bold hover:opacity-90 transition-opacity disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                            >
                                Ver Horas Disponibles <ArrowRight className="w-4 h-4" />
                            </button>
                        </div>
                    )}

                    {/* Step 2: Hora */}
                    {step === 2 && (
                        <div className="space-y-4 animate-fade-in">
                            <h4 className="font-bold text-slate-900 dark:text-white text-center">Horas disponibles para el {booking.date}</h4>
                            <div className="grid grid-cols-3 gap-2">
                                {availableHours.map(time => (
                                    <button
                                        key={time}
                                        type="button"
                                        onClick={() => { setBooking({ ...booking, time }); setStep(3); }}
                                        className="py-2 px-3 rounded-lg border border-slate-300 dark:border-slate-600 hover:border-rose-500 hover:bg-rose-50 dark:hover:bg-rose-900/20 hover:text-rose-600 transition-all text-sm font-medium text-slate-600 dark:text-slate-300"
                                    >
                                        <Clock className="w-3 h-3 inline mr-1 mb-0.5" />
                                        {time}
                                    </button>
                                ))}
                            </div>
                            <button
                                type="button"
                                onClick={() => setStep(1)}
                                className="w-full text-slate-400 text-sm hover:text-slate-600 dark:hover:text-slate-200 mt-2"
                            >
                                Volver atrás
                            </button>
                        </div>
                    )}

                    {/* Step 3: Confirmación */}
                    {step === 3 && (
                        <div className="space-y-4 animate-fade-in">
                            <div className="bg-slate-100 dark:bg-slate-800 p-4 rounded-xl flex items-center justify-between">
                                <div>
                                    <span className="block text-xs text-slate-500 uppercase">Resumen</span>
                                    <strong className="text-slate-900 dark:text-white">{booking.date} a las {booking.time}</strong>
                                    <span className="block text-sm text-slate-600 dark:text-slate-400">{booking.people} Personas</span>
                                </div>
                                <button type="button" onClick={() => setStep(1)} className="text-xs text-rose-500 font-bold hover:underline">Cambiar</button>
                            </div>

                            <div>
                                <input
                                    type="text"
                                    placeholder="Tu Nombre"
                                    required
                                    className="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 dark:text-white mb-3 outline-none focus:border-rose-500"
                                    value={booking.name}
                                    onChange={e => setBooking({ ...booking, name: e.target.value })}
                                />
                                <input
                                    type="email"
                                    placeholder="Tu Email (para la confirmación)"
                                    required
                                    className="w-full px-4 py-3 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 dark:text-white outline-none focus:border-rose-500"
                                    value={booking.email}
                                    onChange={e => setBooking({ ...booking, email: e.target.value })}
                                />
                            </div>

                            <button
                                type="submit"
                                disabled={status === 'submitting'}
                                className="w-full bg-rose-600 text-white py-3 rounded-xl font-bold hover:bg-rose-500 transition-colors shadow-lg shadow-rose-500/20 flex items-center justify-center gap-2"
                            >
                                {status === 'submitting' ? 'Confirmando...' : 'Confirmar Reserva Gratis'}
                            </button>
                        </div>
                    )}
                </form>
            </div>

            {/* Footer Dummy */}
            <div className="bg-slate-50 dark:bg-slate-800/50 p-3 text-center border-t border-slate-200 dark:border-slate-700">
                <p className="text-[10px] text-slate-400">Powered by Antigravity Booking Engine</p>
            </div>
        </div>
    );
};

export default RestaurantBooking;

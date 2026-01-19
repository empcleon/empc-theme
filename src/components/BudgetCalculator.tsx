import React, { useState } from 'react';
import { Calculator, Check, ArrowRight } from 'lucide-react';

const BudgetCalculator = () => {
    // Estado inicial (MVP)
    const [step, setStep] = useState(1);

    return (
        <div className="bg-slate-800 rounded-xl p-8 border border-slate-700 shadow-2xl relative overflow-hidden">
            {/* Decoración de fondo */}
            <div className="absolute top-0 right-0 -mt-10 -mr-10 w-40 h-40 bg-rose-500/10 rounded-full blur-3xl"></div>

            <div className="relative z-10">
                <div className="flex items-center gap-3 mb-6">
                    <div className="p-3 bg-rose-500/20 rounded-lg text-rose-500">
                        <Calculator className="w-6 h-6" />
                    </div>
                    <div>
                        <h3 className="text-xl font-bold text-white">Calculadora Inteligente</h3>
                        <p className="text-slate-400 text-sm">Estimación en tiempo real</p>
                    </div>
                </div>

                <div className="space-y-6">
                    <div className="p-6 bg-slate-900/50 rounded-xl border border-dashed border-slate-700 text-center">
                        <p className="text-slate-300 mb-4">
                            Configura tu proyecto para recibir un rango de precios estimado.
                        </p>
                        <button
                            className="bg-rose-600 hover:bg-rose-500 text-white font-bold py-3 px-6 rounded-lg transition-all flex items-center gap-2 mx-auto"
                            onClick={() => alert("Próximamente: Lógica de la calculadora")}
                        >
                            Comenzar Cálculo <ArrowRight className="w-4 h-4" />
                        </button>
                    </div>
                </div>
            </div>
        </div>
    );
};

export default BudgetCalculator;

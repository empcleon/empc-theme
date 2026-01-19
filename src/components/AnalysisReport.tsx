import React from 'react';
import { AlertTriangle, CheckCircle, ArrowRight } from 'lucide-react';

const AnalysisReport: React.FC = () => {
  return (
    <div className="py-20 bg-slate-800/50 border-y border-slate-700">
      <div className="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div className="mb-12">
          <h2 className="text-3xl font-bold text-white mb-4">
            <span className="text-rose-500">Fase 1:</span> Análisis de tu Web Actual
          </h2>
          <p className="text-slate-300 max-w-2xl">
            Antes de rediseñar, he analizado tu sitio actual (basado en la captura) para detectar puntos de fricción y oportunidades de mejora para el mercado de León.
          </p>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
          {/* Weaknesses */}
          <div className="bg-slate-900/80 p-6 rounded-2xl border border-red-900/30">
            <div className="flex items-center gap-3 mb-6">
              <div className="p-2 bg-red-500/10 rounded-lg">
                <AlertTriangle className="w-6 h-6 text-red-500" />
              </div>
              <h3 className="text-xl font-semibold text-white">Puntos de Dolor Detectados</h3>
            </div>
            <ul className="space-y-4">
              <li className="flex items-start gap-3">
                <span className="w-1.5 h-1.5 bg-red-500 rounded-full mt-2" />
                <p className="text-slate-400 text-sm">
                  <strong className="text-slate-200">Ruido Visual:</strong> El uso excesivo de líneas discontinuas, bordes y cajas de colores contrastantes (rojo/amarillo) fatiga la vista y resta profesionalidad técnica.
                </p>
              </li>
              <li className="flex items-start gap-3">
                <span className="w-1.5 h-1.5 bg-red-500 rounded-full mt-2" />
                <p className="text-slate-400 text-sm">
                  <strong className="text-slate-200">Propuesta de Valor Difusa:</strong> Aunque mencionas React, la estética "Theme Forest 2015" grita "Solo WordPress". No visualizas tu capacidad de programación a medida.
                </p>
              </li>
              <li className="flex items-start gap-3">
                <span className="w-1.5 h-1.5 bg-red-500 rounded-full mt-2" />
                <p className="text-slate-400 text-sm">
                  <strong className="text-slate-200">Jerarquía Tipográfica:</strong> Los textos son densos y los CTAs (llamadas a la acción) compiten entre sí.
                </p>
              </li>
            </ul>
          </div>

          {/* Solution Strategy */}
          <div className="bg-slate-900/80 p-6 rounded-2xl border border-emerald-900/30">
            <div className="flex items-center gap-3 mb-6">
              <div className="p-2 bg-emerald-500/10 rounded-lg">
                <CheckCircle className="w-6 h-6 text-emerald-500" />
              </div>
              <h3 className="text-xl font-semibold text-white">Estrategia de Rediseño (Propuesta)</h3>
            </div>
            <ul className="space-y-4">
              <li className="flex items-start gap-3">
                <span className="w-1.5 h-1.5 bg-emerald-500 rounded-full mt-2" />
                <p className="text-slate-400 text-sm">
                  <strong className="text-slate-200">Estética "Dev-First":</strong> Un diseño oscuro, limpio y minimalista que sugiere tecnología avanzada, diferenciándote de las agencias de marketing tradicionales en León.
                </p>
              </li>
              <li className="flex items-start gap-3">
                <span className="w-1.5 h-1.5 bg-emerald-500 rounded-full mt-2" />
                <p className="text-slate-400 text-sm">
                  <strong className="text-slate-200">WordPress Invisible, React Visible:</strong> Usar WordPress como motor (headless o tradicional) pero mostrar componentes React interactivos en la propia landing para demostrar capacidad (ver demo abajo).
                </p>
              </li>
              <li className="flex items-start gap-3">
                <span className="w-1.5 h-1.5 bg-emerald-500 rounded-full mt-2" />
                <p className="text-slate-400 text-sm">
                  <strong className="text-slate-200">Enfoque Local Premium:</strong> Elevar el discurso de "Diseño Freelance" a "Consultoría Tecnológica para PYMES".
                </p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  );
};

export default AnalysisReport;
import React, { useState } from 'react';
import { StepProps } from '../types';
import Button from './ui/Button';
import Input from './ui/Input';

const StepContact: React.FC<StepProps> = ({ bookingData, updateBooking, onNext, onBack }) => {
  const [errors, setErrors] = useState<Record<string, string>>({});

  const validate = () => {
    const newErrors: Record<string, string> = {};
    if (!bookingData.contact.name.trim()) newErrors.name = 'El nombre es obligatorio';
    if (!bookingData.contact.email.trim()) {
      newErrors.email = 'El email es obligatorio';
    } else if (!/\S+@\S+\.\S+/.test(bookingData.contact.email)) {
      newErrors.email = 'Email inválido';
    }
    if (!bookingData.contact.phone.trim()) newErrors.phone = 'El teléfono es obligatorio';

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleContinue = () => {
    if (validate()) {
      onNext();
    }
  };

  const handleChange = (field: string, value: string) => {
    updateBooking({
      contact: { ...bookingData.contact, [field]: value }
    });
    // Clear error when user types
    if (errors[field]) {
      setErrors(prev => ({ ...prev, [field]: '' }));
    }
  };

  return (
    <div className="space-y-6 fade-in">
      <div className="text-center mb-6">
        <h2 className="text-2xl font-display font-bold text-gray-900">Tus Datos</h2>
        <p className="text-gray-500 mt-2">Para poder contactarte y confirmar la cita.</p>
      </div>

      <div className="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 space-y-4">
        <Input
          label="Nombre Completo"
          placeholder="Ej. Juan Pérez"
          value={bookingData.contact.name}
          onChange={(e) => handleChange('name', e.target.value)}
          error={errors.name}
        />
        
        <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
          <Input
            label="Email"
            type="email"
            placeholder="juan@ejemplo.com"
            value={bookingData.contact.email}
            onChange={(e) => handleChange('email', e.target.value)}
            error={errors.email}
          />
          <Input
            label="Teléfono"
            type="tel"
            placeholder="+34 600 000 000"
            value={bookingData.contact.phone}
            onChange={(e) => handleChange('phone', e.target.value)}
            error={errors.phone}
          />
        </div>

        <div className="flex flex-col space-y-1.5">
          <label className="text-sm font-medium text-gray-700 pl-1">
            Notas especiales (Opcional)
          </label>
          <textarea
            className="block w-full px-4 py-3 rounded-2xl border border-gray-200 bg-gray-50 text-gray-900 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:bg-white transition-colors duration-200 resize-none"
            rows={3}
            placeholder="Alergias, necesidades específicas, etc."
            value={bookingData.contact.notes}
            onChange={(e) => handleChange('notes', e.target.value)}
          />
        </div>
      </div>

      <div className="flex gap-4 pt-2">
        <Button onClick={onBack} variant="ghost" className="w-1/3">
          Atrás
        </Button>
        <Button 
          onClick={handleContinue} 
          fullWidth={true}
          className="flex-1"
        >
          Ver Resumen
        </Button>
      </div>
    </div>
  );
};

export default StepContact;
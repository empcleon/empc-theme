import { MenuItem, DayAvailability } from './types';

export const MENU_ITEMS: MenuItem[] = [
  {
    id: 'm1',
    title: 'Tabla de Cecina de León',
    description: 'Cecina curada premium con un toque de aceite de oliva virgen.',
    price: 18.50,
    category: 'tapas',
    image: '🥩'
  },
  {
    id: 'm2',
    title: 'Croquetas de Valdeón',
    description: 'Cremosas por dentro con el potente sabor del queso azul de Picos.',
    price: 12.00,
    category: 'tapas',
    image: '🧀'
  },
  {
    id: 'm3',
    title: 'Morcilla de León',
    description: 'A la plancha, picante suave, acompañada de manzana reineta.',
    price: 14.00,
    category: 'tapas',
    image: '🥘'
  },
  {
    id: 'm4',
    title: 'Hamburguesa Buey del Esla',
    description: '200g de carne de buey, queso curado y cebolla caramelizada.',
    price: 16.50,
    category: 'main',
    image: '🍔'
  },
  {
    id: 'm5',
    title: 'Cocido Maragato Completo',
    description: 'Servido en tres vuelcos. Solo para valientes.',
    price: 24.00,
    category: 'main',
    image: '🍲'
  },
  {
    id: 'm6',
    title: 'Prieto Picudo (Copa)',
    description: 'Vino tinto D.O. Tierra de León. Intenso y frutal.',
    price: 3.50,
    category: 'drinks',
    image: '🍷'
  },
  {
    id: 'm7',
    title: 'Limonada Leonesa',
    description: 'Nuestra receta tradicional de Semana Santa, disponible todo el año.',
    price: 4.00,
    category: 'drinks',
    image: '🍋'
  }
];

export const getAvailableDays = (): DayAvailability[] => {
  const days: DayAvailability[] = [];
  const today = new Date();

  for (let i = 0; i < 5; i++) {
    const d = new Date(today);
    d.setDate(today.getDate() + i);
    
    // Restaurant open Tuesday to Sunday
    if (d.getDay() === 1) continue; 

    days.push({
      date: d,
      slots: [
        // Lunch
        { id: `slot-${i}-1330`, time: '13:30', period: 'lunch', available: true },
        { id: `slot-${i}-1400`, time: '14:00', period: 'lunch', available: true, limited: true },
        { id: `slot-${i}-1430`, time: '14:30', period: 'lunch', available: false },
        { id: `slot-${i}-1500`, time: '15:00', period: 'lunch', available: true },
        // Dinner
        { id: `slot-${i}-2030`, time: '20:30', period: 'dinner', available: true },
        { id: `slot-${i}-2100`, time: '21:00', period: 'dinner', available: true, limited: true },
        { id: `slot-${i}-2130`, time: '21:30', period: 'dinner', available: true },
        { id: `slot-${i}-2200`, time: '22:00', period: 'dinner', available: true }
      ]
    });
  }
  return days;
};

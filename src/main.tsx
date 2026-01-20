import React, { lazy, Suspense } from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import WhatsAppBubble from './components/WhatsAppBubble';
import './index.css';

// 1. Montar App principal (si existe el contenedor)
const rootElement = document.getElementById('root');
if (rootElement) {
    ReactDOM.createRoot(rootElement).render(
        <React.StrictMode>
            <App />
        </React.StrictMode>
    );
}

// 2. Montar WhatsApp Bubble (si existe el contenedor)
const waElement = document.getElementById('react-whatsapp-bubble');
if (waElement) {
    ReactDOM.createRoot(waElement).render(
        <React.StrictMode>
            <WhatsAppBubble />
        </React.StrictMode>
    );
}

// 3. Montar Island: Budget Calculator
const calculatorElement = document.getElementById('island-budget-calculator');
if (calculatorElement) {
    import('./components/BudgetCalculator').then(({ default: BudgetCalculator }) => {
        ReactDOM.createRoot(calculatorElement).render(
            <React.StrictMode>
                <BudgetCalculator />
            </React.StrictMode>
        );
    });
}

// 4. Montar Island: Restaurant Booking (Demo)
// Usamos lazy load para no cargar el código si no estamos en la página de la demo
// Usamos importación directa para evitar errores de chunk loading en local
import BookingWidget from './components/restaurant-app/components/BookingWidget';

const bookingElement = document.getElementById('island-booking');
if (bookingElement) {
    console.log("✅ [EMPC] Found #island-booking, attempting to mount React Widget...");
    ReactDOM.createRoot(bookingElement).render(
        <React.StrictMode>
            <BookingWidget />
        </React.StrictMode>
    );
}

import React from 'react';
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
const bookingElement = document.getElementById('island-booking');
if (bookingElement) {
    import('./components/RestaurantBooking').then(({ default: RestaurantBooking }) => {
        ReactDOM.createRoot(bookingElement).render(
            <React.StrictMode>
                <RestaurantBooking />
            </React.StrictMode>
        );
    });
}

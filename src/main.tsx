import React, { lazy, Suspense } from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import WhatsAppBubble from './components/WhatsAppBubble';
import MethodPage from './components/MethodPage'; // New import
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

// 5. Montar Island: Production Booking System (Generic)
const empcBookingElement = document.getElementById('empc-booking-root');
if (empcBookingElement) {
    // Dynamic import to split code
    import('./islands/booking/BookingIsland').then(({ default: BookingIsland }) => {
        ReactDOM.createRoot(empcBookingElement).render(
            <React.StrictMode>
                <BookingIsland />
            </React.StrictMode>
        );
    });
}

// 6. Montar Island: Method Page (Nuestro Método)
const methodElement = document.getElementById('island-method-page');
if (methodElement) {
    ReactDOM.createRoot(methodElement).render(
        <React.StrictMode>
            <MethodPage />
        </React.StrictMode>
    );
}

// 7. Service Page Islands - Dynamic mounting from data attributes
// These islands read their configuration from data-config attributes set by WordPress

// Helper function to mount service islands
function mountServiceIsland(elementId: string, Component: React.ComponentType<any>) {
    const element = document.getElementById(elementId);
    if (element) {
        const configAttr = element.getAttribute('data-config');
        const config = configAttr ? JSON.parse(configAttr) : {};

        ReactDOM.createRoot(element).render(
            <React.StrictMode>
                <Component {...config} />
            </React.StrictMode>
        );
    }
}

// Import service components
import('./components/services').then((services) => {
    mountServiceIsland('service-hero-island', services.ServiceHero);
    mountServiceIsland('service-stats-island', services.StatsBar);
    mountServiceIsland('service-features-island', services.FeatureGrid);
    mountServiceIsland('service-pricing-island', services.PricingCards);
    mountServiceIsland('service-process-island', services.ProcessTimeline);
    mountServiceIsland('service-testimonials-island', services.TestimonialCard);
    mountServiceIsland('service-faq-island', services.FAQAccordion);
    mountServiceIsland('service-cta-island', services.CTAForm);
});

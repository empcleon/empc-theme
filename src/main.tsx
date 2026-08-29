import React from 'react';
import ReactDOM from 'react-dom/client';
import App from './App';
import './index.css';

// 1. Montar App principal solo si existe el contenedor legado
const rootElement = document.getElementById('root');
if (rootElement) {
    ReactDOM.createRoot(rootElement).render(
        <React.StrictMode>
            <App />
        </React.StrictMode>
    );
}

// 2. Montar isla: Contact Form
const contactElement = document.getElementById('island-contact-form');
if (contactElement) {
    import('./components/ContactForm').then(({ default: ContactForm }) => {
        ReactDOM.createRoot(contactElement).render(
            <React.StrictMode>
                <ContactForm />
            </React.StrictMode>
        );
    });
}

// 3. Montar isla: solicitud de presupuesto de equipos
const equipmentQuoteElement = document.getElementById('island-equipment-quote-form');
if (equipmentQuoteElement) {
    import('./components/EquipmentQuoteForm').then(({ default: EquipmentQuoteForm }) => {
        ReactDOM.createRoot(equipmentQuoteElement).render(
            <React.StrictMode>
                <EquipmentQuoteForm />
            </React.StrictMode>
        );
    });
}

// 4. Montar isla: Budget Calculator
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

// 5. Montar isla: Pricing Calculator
const pricingCalculatorElement = document.getElementById('island-pricing-calculator');
if (pricingCalculatorElement) {
    import('./components/PricingCalculator').then(({ default: PricingCalculator }) => {
        ReactDOM.createRoot(pricingCalculatorElement).render(
            <React.StrictMode>
                <PricingCalculator />
            </React.StrictMode>
        );
    });
}

// 6. Montar isla: Booking demo
import BookingWidget from './components/restaurant-app/components/BookingWidget';
const bookingElement = document.getElementById('island-booking');
if (bookingElement) {
    ReactDOM.createRoot(bookingElement).render(
        <React.StrictMode>
            <BookingWidget />
        </React.StrictMode>
    );
}

// 7. Montar isla: Production booking system
const empcBookingElement = document.getElementById('empc-booking-root');
if (empcBookingElement) {
    import('./components/islands/booking/BookingIsland').then(({ default: BookingIsland }) => {
        ReactDOM.createRoot(empcBookingElement).render(
            <React.StrictMode>
                <BookingIsland />
            </React.StrictMode>
        );
    });
}

// 8. Montar islas de servicios / ecommerce existentes
function mountServiceIsland(elementId: string, Component: React.ComponentType<any>) {
    const element = document.getElementById(elementId);
    if (!element) return;

    const configAttr = element.getAttribute('data-config');
    const config = configAttr ? JSON.parse(configAttr) : {};

    ReactDOM.createRoot(element).render(
        <React.StrictMode>
            <Component {...config} />
        </React.StrictMode>
    );
}

import('./components/services').then((services) => {
    mountServiceIsland('service-hero-island', services.ServiceHero);
    mountServiceIsland('service-stats-island', services.StatsBar);
    mountServiceIsland('service-features-island', services.FeatureGrid);
    mountServiceIsland('service-pricing-island', services.PricingCards);
    mountServiceIsland('service-process-island', services.ProcessTimeline);
    mountServiceIsland('service-testimonials-island', services.TestimonialCard);
    mountServiceIsland('service-faq-island', services.FAQAccordion);
    mountServiceIsland('service-cta-island', services.CTAForm);

    mountServiceIsland('ecommerce-hero', services.EcommerceHero);
    mountServiceIsland('ecommerce-comparison', services.ComparisonTable);
    mountServiceIsland('ecommerce-features', services.FeaturesGrid);
    mountServiceIsland('ecommerce-pricing', services.EcommercePricing);
    mountServiceIsland('ecommerce-platforms', services.PlatformCards);
    mountServiceIsland('ecommerce-process', services.EcommerceProcess);
    mountServiceIsland('ecommerce-cases', services.CaseStudyCards);
    mountServiceIsland('ecommerce-cta', services.EcommerceCTAForm);
    mountServiceIsland('local-pack-simulator-island', services.LocalPackSimulator);

    const faqElement = document.getElementById('ecommerce-faq');
    if (faqElement) {
        const configAttr = faqElement.getAttribute('data-config');
        const config = configAttr ? JSON.parse(configAttr) : {};
        if (config.items && !config.faqs) {
            config.faqs = config.items;
        }
        ReactDOM.createRoot(faqElement).render(
            <React.StrictMode>
                <services.FAQAccordion {...config} />
            </React.StrictMode>
        );
    }
});

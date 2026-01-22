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

// 4. Montar Island: Pricing Calculator (León específico)
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

    // Mount Ecommerce Islands
    mountServiceIsland('ecommerce-hero', services.EcommerceHero);
    mountServiceIsland('ecommerce-comparison', services.ComparisonTable);
    mountServiceIsland('ecommerce-features', services.FeaturesGrid);
    mountServiceIsland('ecommerce-pricing', services.EcommercePricing);
    mountServiceIsland('ecommerce-platforms', services.PlatformCards);
    mountServiceIsland('ecommerce-process', services.EcommerceProcess);
    mountServiceIsland('ecommerce-cases', services.CaseStudyCards);
    mountServiceIsland('ecommerce-cta', services.EcommerceCTAForm);

    // Note: FAQ for ecommerce might use a different component or different props. 
    // The data structure in get_tiendas_online_config() uses 'items' instead of 'faqs' for questions.
    // If FAQAccordion strictly expects 'faqs', we might need to map it or use a specific adapter.
    // However, for now, let's assume we might need a dedicated FAQ component or mapped props.
    // Given the props difference, I'll mount a wrapper or just use a generic approach if possible.
    // But services.FAQAccordion expects FAQAccordionProps.
    // Let's create a wrapper or simple adapter here if needed, or just let the component handle extra props if it's flexible.
    // Actually, looking at the config, 'faq' has 'items' array. FAQAccordion expects 'faqs' array.
    // I should probably map the config before passing it, but mountServiceIsland takes component and mounts it with config as props.
    // I will mount a temporary adapter here or just assume the user might update the component/config later.
    // Better yet, I'll update the PHP config to match the prop names if possible? No, PHP config was given by user.
    // I'll update the mounting to transform props for FAQ if I can, but standard ReactDOM.render doesn't easily allow prop mapping in this helper without modifying helper.
    // I'll skip mounting generic FAQAccordion for ecommerce-faq and instead mount a specific EcommerceFAQ if I had one, or just...
    // Wait, the user didn't provide EcommerceFAQ.tsx. The user provided "inc/service-pages-data.php" with 'faq' section.
    // Maybe I should use the text in the prompt? "revvvisa esto de claude...". 
    // I'll just mount it. If props mismatch, it won't render items. 
    // Let's look at FAQAccordion definition in index.ts -> it exports FAQAccordion.
    // I will leave it for now. If it breaks, I'll fix it in verification.
    // Actually, `EcommerceCTAForm` was provided but `EcommerceFAQ` was NOT.
    // Maybe I should use `services.FAQAccordion` and hope it works or I should have created `EcommerceFAQ`?
    // The prompt didn't ask for `EcommerceFAQ`.
    // I'll check `FAQAccordion.tsx` (via `index.ts` I saw it exists) to see if it's flexible.
    // But I can't check it now easily without another step.
    // I'll just mount it.

    // mountServiceIsland('ecommerce-faq', services.FAQAccordion); // Potential prop mismatch 'items' vs 'faqs'

    // FIX: I will read the element, parse config, map 'items' to 'faqs', and then render.
    const faqElement = document.getElementById('ecommerce-faq');
    if (faqElement) {
        import('./components/services').then((services) => {
            const configAttr = faqElement.getAttribute('data-config');
            const config = configAttr ? JSON.parse(configAttr) : {};
            // Adapt props: items -> faqs
            // The PHP config has 'items', React component likely expects 'faqs' (based on service-pages-data.php for the other page)
            if (config.items && !config.faqs) {
                config.faqs = config.items;
            }
            ReactDOM.createRoot(faqElement).render(
                <React.StrictMode>
                    <services.FAQAccordion {...config} />
                </React.StrictMode>
            );
        });
    }
});

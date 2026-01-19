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

// 3. Componente ContactForm (Integrado en App.tsx ahora)
// const contactElement = document.getElementById('react-contact-root');
// if (contactElement) {
//    ...
// }

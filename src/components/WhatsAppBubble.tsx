import React from 'react';

const WhatsAppBubble = () => {
    return (
        <a
            href="https://wa.me/34600000000"
            className="fixed bottom-6 right-6 bg-green-500 text-white p-4 rounded-full shadow-lg hover:scale-110 transition-transform z-50 flex items-center justify-center hover:bg-green-600"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="Contactar por WhatsApp"
        >
            <svg className="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.588-5.946 0-6.556 5.332-11.888 11.888-11.888 3.176 0 6.161 1.237 8.404 3.48s3.481 5.229 3.481 8.408c0 6.556-5.332 11.888-11.888 11.888-2.003 0-3.963-.505-5.7-1.467l-6.305 1.688z" />
            </svg>
        </a>
    );
};

export default WhatsAppBubble;

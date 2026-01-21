// Demo configuration for Diseño Web León service page
// This will be replaced by WordPress post meta in production

import { Zap, Users, Shield, Clock, Heart, Target } from 'lucide-react';

export const disenoWebLeonConfig = {
    hero: {
        badge: 'Disponibilidad inmediata para proyectos',
        title: 'Diseño Web en León que',
        highlight: 'genera resultados',
        description: 'Creamos páginas web profesionales, rápidas y optimizadas para convertir visitantes en clientes. Sin plantillas genéricas. Sin sorpresas en la factura.',
        bulletPoints: [
            { icon: 'check', text: '<strong class="text-white">PageSpeed 90+</strong> - Tu web volará' },
            { icon: 'check', text: '<strong class="text-white">SEO incluido</strong> - Posicionamiento desde el día 1' },
            { icon: 'check', text: '<strong class="text-white">Entrega en 2-3 semanas</strong> - Sin eternizarse' }
        ],
        ctaPrimary: { text: 'Solicitar presupuesto gratis', href: '#presupuesto' },
        ctaSecondary: { text: 'Ver cómo trabajo', href: '#proceso' }
    },

    stats: {
        stats: [
            { number: '98', suffix: '/100', label: 'PageSpeed medio' },
            { number: '50', suffix: '+', label: 'Webs entregadas' },
            { number: '4.9', suffix: '★', label: 'Valoración clientes' },
            { number: '0', suffix: '', label: 'Proyectos abandonados' }
        ]
    },

    features: {
        title: 'Por qué trabajar conmigo',
        subtitle: 'Diferenciación',
        description: 'No soy una agencia enorme con 50 comerciales. Soy un desarrollador senior que trabaja directamente contigo, sin intermediarios.',
        features: [
            { icon: Zap, iconColor: 'blue', title: 'Rendimiento real', description: 'No prometo velocidad, la demuestro. Todas mis webs superan 90 en PageSpeed.' },
            { icon: Users, iconColor: 'purple', title: 'Trato directo', description: 'Hablas conmigo, no con un comercial. Sin ruido, sin malentendidos.' },
            { icon: Shield, iconColor: 'green', title: 'Sin letra pequeña', description: 'Presupuesto cerrado desde el día 1. Lo que acordamos es lo que pagas.' },
            { icon: Clock, iconColor: 'yellow', title: 'Plazos cumplidos', description: 'Si digo 3 semanas, son 3 semanas. Mi reputación depende de cumplir.' },
            { icon: Heart, iconColor: 'red', title: 'Entiendo tu negocio', description: 'La web se construye para generar negocio, no para ganar premios de diseño.' },
            { icon: Target, iconColor: 'cyan', title: 'Soporte de verdad', description: 'No te dejo tirado después de entregar. Tienes mi teléfono directo.' }
        ],
        columns: 3
    },

    pricing: {
        title: 'Soluciones adaptadas a tu negocio',
        subtitle: 'Planes',
        description: 'Elige el plan que mejor se ajuste a tus necesidades. Todos incluyen diseño responsive, SEO básico y soporte.',
        tiers: [
            {
                title: 'Web Corporativa',
                price: 'desde 800€',
                description: 'Presencia profesional para tu empresa',
                features: ['Diseño personalizado', '5-8 páginas', 'Responsive 100%', 'Formulario de contacto', 'SEO básico', 'Alta en Google Business'],
                idealFor: 'Empresas y autónomos que necesitan presencia online profesional',
                ctaText: 'Solicitar presupuesto',
                ctaHref: '#presupuesto'
            },
            {
                title: 'Web Premium',
                price: 'desde 1.500€',
                description: 'Máximo rendimiento y conversión',
                highlighted: true,
                badge: 'Más popular',
                features: ['Todo lo anterior +', 'Hasta 15 páginas', 'Blog integrado', 'SEO avanzado', 'PageSpeed 90+', 'Redes sociales', 'Chat en vivo', '3 meses soporte'],
                idealFor: 'Negocios que quieren destacar y generar leads',
                ctaText: 'Solicitar presupuesto',
                ctaHref: '#presupuesto'
            },
            {
                title: 'Solución a Medida',
                price: 'consultar',
                description: 'Desarrollo personalizado',
                features: ['Análisis de necesidades', 'Funcionalidades custom', 'Integraciones API', 'Panel admin', 'Formación incluida', 'Soporte prioritario'],
                idealFor: 'Proyectos complejos con requisitos específicos',
                ctaText: 'Consultar proyecto',
                ctaHref: '#presupuesto'
            }
        ],
        note: 'Todos los precios son orientativos. Cada proyecto se presupuesta de forma personalizada.'
    },

    process: {
        title: 'Cómo trabajo',
        subtitle: 'Metodología',
        description: 'Un proceso claro y transparente. Siempre sabrás en qué punto estamos.',
        steps: [
            { step: '01', title: 'Reunión inicial', description: 'Analizamos tu negocio, competencia y objetivos.', duration: '1-2 días' },
            { step: '02', title: 'Propuesta y diseño', description: 'Iteramos hasta que estés 100% satisfecho.', duration: '3-5 días' },
            { step: '03', title: 'Desarrollo', description: 'Código limpio, optimizado y preparado para crecer.', duration: '7-14 días' },
            { step: '04', title: 'Lanzamiento', description: 'Publicamos y te formamos en el uso del panel.', duration: '1-2 días' }
        ]
    },

    testimonials: {
        title: 'Lo que dicen mis clientes',
        subtitle: 'Testimonios',
        testimonials: [
            { text: 'Las solicitudes de presupuesto han subido un 40%.', author: 'Carlos Martínez', company: 'Talleres Martínez', rating: 5 },
            { text: => 'Me vendieron una herramienta que genera clientes cada semana.', author: 'Laura Fernández', company: 'Clínica Dental Sonrisa', rating: 5 },
            { text: 'Comunicación clara, plazos cumplidos y resultado impecable.', author: 'Miguel Ángel Pérez', company: 'Asesoría P&A', rating: 5 }
        ]
    },

    faq: {
        title: 'Preguntas frecuentes',
        subtitle: 'FAQ',
        faqs: [
            { question: '¿Cuánto tarda en estar lista mi web?', answer: 'Una web corporativa estándar: 2-3 semanas. Proyectos más complejos: 4-6 semanas.' },
            { question: '¿Qué pasa si no me gusta el diseño?', answer: 'Incluimos hasta 3 rondas de revisiones sin coste adicional.' },
            { question: '¿Necesito saber de tecnología?', answer: 'No. Entregamos un panel fácil de usar y te damos formación.' },
            { question: '¿El hosting está incluido?', answer: 'El primer año de hosting está incluido en todos los planes.' }
        ]
    },

    cta: {
        title: '¿Listo para impulsar tu negocio?',
        description: 'Cuéntame tu proyecto. Te respondo en menos de 24 horas con una propuesta personalizada.',
        submitText: 'Enviar solicitud',
        showBudgetField: true,
        showProjectType: true
    }
};

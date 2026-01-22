<?php
/**
 * Service Page Configurations
 * Define all service page content here
 */

// Configuration for "Diseño Web en León"
function get_diseno_web_leon_config()
{
    return [
        'hero' => [
            'badge' => 'Disponibilidad inmediata para proyectos',
            'title' => 'Diseño Web en León que',
            'highlight' => 'genera resultados',
            'description' => 'Creamos páginas web profesionales, rápidas y optimizadas para convertir visitantes en clientes. Sin plantillas genéricas. Sin sorpresas en la factura.',
            'bulletPoints' => [
                ['text' => 'PageSpeed 90+ - Tu web volará', 'strong' => 'PageSpeed 90+'],
                ['text' => 'SEO incluido - Posicionamiento desde el día 1', 'strong' => 'SEO incluido'],
                ['text' => 'Entrega en 2-3 semanas - Sin eternizarse', 'strong' => 'Entrega en 2-3 semanas']
            ],
            'ctaPrimary' => ['text' => 'Solicitar presupuesto gratis', 'href' => '#presupuesto'],
            'ctaSecondary' => ['text' => 'Ver cómo trabajo', 'href' => '#proceso']
        ],
        'stats' => [
            'stats' => [
                ['number' => '98', 'suffix' => '/100', 'label' => 'PageSpeed medio'],
                ['number' => '50', 'suffix' => '+', 'label' => 'Webs entregadas'],
                ['number' => '4.9', 'suffix' => '★', 'label' => 'Valoración clientes'],
                ['number' => '0', 'suffix' => '', 'label' => 'Proyectos abandonados']
            ]
        ],
        'features' => [
            'title' => 'Por qué trabajar conmigo',
            'subtitle' => 'Diferenciación',
            'description' => 'No soy una agencia enorme. Soy un desarrollador senior que trabaja directamente contigo.',
            'features' => [
                ['icon' => 'Zap', 'iconColor' => 'blue', 'title' => 'Rendimiento real', 'description' => 'Todas mis webs superan 90 en PageSpeed. Tu competencia está en 40-60.'],
                ['icon' => 'Users', 'iconColor' => 'purple', 'title' => 'Trato directo', 'description' => 'Hablas conmigo, no con un comercial. Sin ruido, sin malentendidos.'],
                ['icon' => 'Shield', 'iconColor' => 'green', 'title' => 'Sin letra pequeña', 'description' => 'Presupuesto cerrado desde el día 1. Lo que acordamos es lo que pagas.'],
                ['icon' => 'Clock', 'iconColor' => 'yellow', 'title' => 'Plazos cumplidos', 'description' => 'Si digo 3 semanas, son 3 semanas. Mi reputación depende de cumplir.'],
                ['icon' => 'Heart', 'iconColor' => 'red', 'title' => 'Entiendo tu negocio', 'description' => 'La web se construye para generar negocio, no para premios.'],
                ['icon' => 'Target', 'iconColor' => 'cyan', 'title' => 'Soporte de verdad', 'description' => 'No te dejo tirado. Tienes mi teléfono directo.']
            ],
            'columns' => 3
        ],
        'pricing' => [
            'title' => 'Soluciones adaptadas a tu negocio',
            'subtitle' => 'Planes',
            'description' => 'Elige el plan que mejor se ajuste. Todos incluyen responsive, SEO y soporte.',
            'tiers' => [
                [
                    'title' => 'Web Corporativa',
                    'price' => 'desde 800€',
                    'description' => 'Presencia profesional',
                    'features' => ['Diseño personalizado', '5-8 páginas', 'Responsive', 'Contacto', 'SEO básico', 'Google Business'],
                    'idealFor' => 'Empresas y autónomos',
                    'ctaText' => 'Solicitar',
                    'ctaHref' => '#presupuesto'
                ],
                [
                    'title' => 'Web Premium',
                    'price' => 'desde 1.500€',
                    'description' => 'Máximo rendimiento',
                    'highlighted' => true,
                    'badge' => 'Más popular',
                    'features' => ['Todo anterior +', '15 páginas', 'Blog', 'SEO avanzado', 'PageSpeed 90+', 'Redes sociales', 'Chat', 'Soporte 3 meses'],
                    'idealFor' => 'Negocios que quieren generar leads',
                    'ctaText' => 'Solicitar',
                    'ctaHref' => '#presupuesto'
                ],
                [
                    'title' => 'A Medida',
                    'price' => 'consultar',
                    'description' => 'Desarrollo custom',
                    'features' => ['Análisis', 'Funcionalidades custom', 'APIs', 'Panel admin', 'Formación', 'Soporte prioritario'],
                    'idealFor' => 'Proyectos complejos',
                    'ctaText' => 'Consultar',
                    'ctaHref' => '#presupuesto'
                ]
            ],
            'note' => 'Precios orientativos. Cada proyecto se presupuesta individualmente.'
        ],
        'process' => [
            'title' => 'Cómo trabajo',
            'subtitle' => 'Metodología',
            'description' => 'Proceso claro y transparente.',
            'steps' => [
                ['step' => '01', 'title' => 'Reunión', 'description' => 'Analizamos negocio y objetivos.', 'duration' => '1-2 días'],
                ['step' => '02', 'title' => 'Diseño', 'description' => 'Wireframes y mockups.', 'duration' => '3-5 días'],
                ['step' => '03', 'title' => 'Desarrollo', 'description' => 'Código limpio y optimizado.', 'duration' => '7-14 días'],
                ['step' => '04', 'title' => 'Lanzamiento', 'description' => 'Publicación y formación.', 'duration' => '1-2 días']
            ]
        ],
        'testimonials' => [
            'title' => 'Lo que dicen mis clientes',
            'subtitle' => 'Testimonios',
            'testimonials' => [
                ['text' => 'Las solicitudes subieron un 40%.', 'author' => 'Carlos Martínez', 'company' => 'Talleres Martínez', 'rating' => 5],
                ['text' => 'Genera clientes cada semana.', 'author' => 'Laura Fernández', 'company' => 'Clínica Dental', 'rating' => 5],
                ['text' => 'Plazos cumplidos, resultado impecable.', 'author' => 'Miguel Ángel Pérez', 'company' => 'Asesoría P&A', 'rating' => 5]
            ]
        ],
        'faq' => [
            'title' => 'Preguntas frecuentes',
            'subtitle' => 'FAQ',
            'faqs' => [
                ['question' => '¿Cuánto tarda?', 'answer' => 'Web corporativa: 2-3 semanas. Proyectos complejos: 4-6 semanas.'],
                ['question' => '¿Y si no me gusta?', 'answer' => '3 rondas de revisiones incluidas sin coste.'],
                ['question' => '¿Necesito conocimientos técnicos?', 'answer' => 'No. Panel fácil + formación incluida.'],
                ['question' => '¿Hosting incluido?', 'answer' => 'Primer año incluido. Dominio aparte (~12€/año).']
            ]
        ],
        'cta' => [
            'title' => '¿Listo para impulsar tu negocio?',
            'description' => 'Respuesta en menos de 24 horas.',
            'submitText' => 'Enviar solicitud',
            'showBudgetField' => true,
            'showProjectType' => true
        ]
    ];
}

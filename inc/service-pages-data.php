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

/**
 * Configuración de la página: Tiendas Online en León
 */
function get_tiendas_online_config(): array
{
    return [
        // ============================================
        // HERO
        // ============================================
        'hero' => [
            'badge' => [
                'icon' => 'shopping-cart',
                'text' => 'E-commerce que convierte',
                'subtext' => 'WooCommerce · Shopify · PrestaShop'
            ],
            'title' => 'Tu tienda online',
            'highlight' => 'abierta 24/7',
            'description' => 'Vende mientras duermes. Creamos tiendas online profesionales que <strong>convierten visitantes en clientes</strong> de forma automática.',
            'stats' => [
                ['number' => '+40', 'label' => 'Tiendas lanzadas'],
                ['number' => '2.8%', 'label' => 'Conversión media'],
                ['number' => '3-4', 'label' => 'Semanas de entrega']
            ],
            'ctaPrimary' => [
                'text' => 'Quiero mi tienda online',
                'href' => '#presupuesto',
                'icon' => 'arrow-right'
            ],
            'ctaSecondary' => [
                'text' => 'Ver casos de éxito',
                'href' => '#casos',
                'icon' => 'play-circle'
            ],
            'theme' => 'emerald' // emerald, blue, purple, etc.
        ],

        // ============================================
        // COMPARATIVA TIENDA FÍSICA VS ONLINE
        // ============================================
        'comparison' => [
            'title' => '¿Por qué vender online?',
            'subtitle' => 'La comparativa habla por sí sola',
            'items' => [
                [
                    'aspect' => 'Inversión inicial',
                    'physical' => '30.000€ - 100.000€',
                    'online' => '1.200€ - 5.000€',
                    'winner' => 'online'
                ],
                [
                    'aspect' => 'Costes fijos mensuales',
                    'physical' => '2.000€ - 8.000€',
                    'online' => '50€ - 300€',
                    'winner' => 'online'
                ],
                [
                    'aspect' => 'Horario de venta',
                    'physical' => '10-12 horas/día',
                    'online' => '24 horas / 7 días',
                    'winner' => 'online'
                ],
                [
                    'aspect' => 'Alcance geográfico',
                    'physical' => 'Radio local (5-20 km)',
                    'online' => 'Nacional / Internacional',
                    'winner' => 'online'
                ],
                [
                    'aspect' => 'Empleados necesarios',
                    'physical' => '1-5 personas',
                    'online' => '0 (automatizado)',
                    'winner' => 'online'
                ],
                [
                    'aspect' => 'Escalabilidad',
                    'physical' => 'Limitada por espacio',
                    'online' => 'Ilimitada',
                    'winner' => 'online'
                ]
            ],
            'conclusion' => 'Una tienda online bien hecha se paga sola en <strong>2-6 meses</strong>'
        ],

        // ============================================
        // FUNCIONALIDADES (12 features)
        // ============================================
        'features' => [
            'badge' => 'Funcionalidades',
            'title' => 'Todo lo que necesitas para vender',
            'description' => 'Una tienda online profesional no es solo "un catálogo con carrito". Es un sistema completo de ventas automatizado.',
            'items' => [
                [
                    'icon' => 'credit-card',
                    'title' => 'Pagos seguros',
                    'description' => 'Stripe, PayPal, Redsys, Bizum... Todas las opciones que tus clientes esperan, con máxima seguridad PCI DSS.'
                ],
                [
                    'icon' => 'package',
                    'title' => 'Gestión de envíos',
                    'description' => 'Integración con SEUR, MRW, Correos, GLS. Cálculo automático de portes, seguimiento en tiempo real.'
                ],
                [
                    'icon' => 'bar-chart-3',
                    'title' => 'Inventario inteligente',
                    'description' => 'Control de stock en tiempo real, alertas de reposición, gestión de variantes (tallas, colores, etc.).'
                ],
                [
                    'icon' => 'shopping-cart',
                    'title' => 'Carrito optimizado',
                    'description' => 'Proceso de compra en 3 pasos, guardado de carrito, checkout como invitado. Diseñado para convertir.'
                ],
                [
                    'icon' => 'mail',
                    'title' => 'Emails automáticos',
                    'description' => 'Confirmación de pedido, seguimiento de envío, recuperación de carritos, emails de fidelización.'
                ],
                [
                    'icon' => 'smartphone',
                    'title' => '100% móvil',
                    'description' => 'El 70% de las compras online son desde móvil. Tu tienda se verá perfecta en cualquier dispositivo.'
                ],
                [
                    'icon' => 'search',
                    'title' => 'SEO para productos',
                    'description' => 'URLs amigables, meta descripciones, schema de producto, sitemap automático. Aparece en Google Shopping.'
                ],
                [
                    'icon' => 'trending-up',
                    'title' => 'Analítica avanzada',
                    'description' => 'Dashboard de ventas, productos más vendidos, comportamiento de usuarios, embudos de conversión.'
                ],
                [
                    'icon' => 'gift',
                    'title' => 'Marketing integrado',
                    'description' => 'Cupones, descuentos por volumen, productos relacionados, upselling, cross-selling automático.'
                ],
                [
                    'icon' => 'globe',
                    'title' => 'Multi-idioma',
                    'description' => 'Vende en toda Europa. Traducciones profesionales, moneda local, impuestos por país.'
                ],
                [
                    'icon' => 'link',
                    'title' => 'Integraciones',
                    'description' => 'Conecta con tu ERP, CRM, contabilidad, email marketing (Mailchimp, Klaviyo), redes sociales.'
                ],
                [
                    'icon' => 'shield',
                    'title' => 'Seguridad total',
                    'description' => 'SSL, backups diarios, protección anti-fraude, cumplimiento RGPD, pasarelas certificadas.'
                ]
            ]
        ],

        // ============================================
        // PLANES Y PRECIOS
        // ============================================
        'pricing' => [
            'badge' => 'Planes',
            'title' => 'Inversión transparente',
            'description' => 'Sin sorpresas ni costes ocultos. Presupuesto cerrado desde el día 1.',
            'plans' => [
                [
                    'name' => 'Starter',
                    'price' => '1.200',
                    'currency' => '€',
                    'period' => null,
                    'description' => 'Perfecta para empezar a vender online',
                    'productLimit' => 'Hasta 50 productos',
                    'featured' => false,
                    'features' => [
                        'Diseño responsive personalizado',
                        'Hasta 50 productos',
                        'Pasarela de pago (Stripe/PayPal)',
                        'Gestión de inventario básica',
                        'Envíos nacionales configurados',
                        'Certificado SSL incluido',
                        'Panel de administración fácil',
                        'Formación inicial (2h)',
                        '1 mes de soporte incluido'
                    ],
                    'notIncluded' => [
                        'Productos ilimitados',
                        'Multi-idioma',
                        'Integraciones avanzadas'
                    ],
                    'idealFor' => 'Artesanos, pequeños comercios, primera tienda online',
                    'cta' => ['text' => 'Solicitar presupuesto', 'href' => '#presupuesto']
                ],
                [
                    'name' => 'Business',
                    'price' => '2.500',
                    'currency' => '€',
                    'period' => null,
                    'description' => 'La más elegida por negocios en crecimiento',
                    'productLimit' => 'Hasta 500 productos',
                    'featured' => true,
                    'badge' => '⭐ MÁS POPULAR',
                    'features' => [
                        'Todo lo del plan Starter +',
                        'Hasta 500 productos',
                        'Variantes de producto (tallas, colores)',
                        'Cupones y descuentos',
                        'Envíos internacionales',
                        'Emails automáticos personalizados',
                        'Recuperación de carritos abandonados',
                        'Blog integrado',
                        'Integración con redes sociales',
                        'SEO avanzado para productos',
                        'Google Analytics + Search Console',
                        '3 meses de soporte incluido'
                    ],
                    'notIncluded' => [
                        'Multi-idioma',
                        'ERP/CRM integración'
                    ],
                    'idealFor' => 'Comercios establecidos, marcas en crecimiento',
                    'cta' => ['text' => 'Solicitar presupuesto', 'href' => '#presupuesto']
                ],
                [
                    'name' => 'Enterprise',
                    'price' => 'Desde 5.000',
                    'currency' => '€',
                    'period' => null,
                    'description' => 'Solución completa para grandes operaciones',
                    'productLimit' => 'Productos ilimitados',
                    'featured' => false,
                    'features' => [
                        'Todo lo del plan Business +',
                        'Productos ilimitados',
                        'Multi-idioma (ES/EN/FR...)',
                        'Multi-moneda',
                        'Integración con ERP/CRM',
                        'Sincronización de stock automática',
                        'Marketplaces (Amazon, eBay...)',
                        'App móvil opcional',
                        'Servidor dedicado',
                        'Soporte prioritario 24/7',
                        'Consultoría de conversión',
                        '12 meses de soporte incluido'
                    ],
                    'notIncluded' => [],
                    'idealFor' => 'Empresas con alto volumen, expansión internacional',
                    'cta' => ['text' => 'Contactar', 'href' => '#presupuesto']
                ]
            ],
            'note' => 'Todos los precios son orientativos. Cada proyecto se presupuesta según sus necesidades específicas.'
        ],

        // ============================================
        // PLATAFORMAS
        // ============================================
        'platforms' => [
            'badge' => 'Tecnología',
            'title' => '¿Qué plataforma elegir?',
            'description' => 'Te asesoro según tu situación. No hay una "mejor" plataforma, hay una más adecuada para ti.',
            'items' => [
                [
                    'name' => 'WooCommerce',
                    'logo' => 'woocommerce',
                    'tagline' => 'La solución más flexible sobre WordPress',
                    'pros' => [
                        'Máxima personalización',
                        'Miles de plugins',
                        'Coste bajo',
                        'Propiedad total'
                    ],
                    'cons' => [
                        'Requiere mantenimiento',
                        'Hosting propio'
                    ],
                    'idealFor' => 'Negocios que quieren control total y escalabilidad'
                ],
                [
                    'name' => 'Shopify',
                    'logo' => 'shopify',
                    'tagline' => 'Todo en uno, sin complicaciones técnicas',
                    'pros' => [
                        'Fácil de usar',
                        'Hosting incluido',
                        'Seguridad gestionada',
                        'Soporte 24/7'
                    ],
                    'cons' => [
                        'Comisiones por venta',
                        'Menos flexible',
                        'Coste mensual'
                    ],
                    'idealFor' => 'Quien quiere empezar rápido sin preocuparse de técnica'
                ],
                [
                    'name' => 'PrestaShop',
                    'logo' => 'prestashop',
                    'tagline' => 'Potente y pensado para e-commerce desde cero',
                    'pros' => [
                        'Muy completo',
                        'Sin comisiones',
                        'Multitienda',
                        'Fuerte en Europa'
                    ],
                    'cons' => [
                        'Curva de aprendizaje',
                        'Módulos de pago'
                    ],
                    'idealFor' => 'Tiendas medianas-grandes con necesidades específicas'
                ]
            ],
            'cta' => [
                'text' => 'Te asesoro gratis según tu caso',
                'href' => '#presupuesto'
            ]
        ],

        // ============================================
        // PROCESO
        // ============================================
        'process' => [
            'badge' => 'Metodología',
            'title' => 'De la idea a vender online en 4 semanas',
            'description' => 'Un proceso probado con más de 40 tiendas lanzadas. Sin improvisaciones.',
            'steps' => [
                [
                    'number' => '01',
                    'title' => 'Análisis y estrategia',
                    'duration' => '2-3 días',
                    'description' => 'Estudiamos tu catálogo, competencia, público objetivo y definimos la estrategia de venta online.',
                    'deliverables' => ['Análisis de mercado', 'Arquitectura de tienda', 'Propuesta de diseño']
                ],
                [
                    'number' => '02',
                    'title' => 'Diseño UX/UI',
                    'duration' => '5-7 días',
                    'description' => 'Diseñamos una experiencia de compra fluida, con foco en conversión y facilidad de uso.',
                    'deliverables' => ['Wireframes', 'Diseño visual', 'Prototipo navegable']
                ],
                [
                    'number' => '03',
                    'title' => 'Desarrollo',
                    'duration' => '10-15 días',
                    'description' => 'Construimos tu tienda con código limpio, optimizado para velocidad y SEO.',
                    'deliverables' => ['Tienda funcional', 'Panel de gestión', 'Pasarelas configuradas']
                ],
                [
                    'number' => '04',
                    'title' => 'Carga de productos',
                    'duration' => '3-5 días',
                    'description' => 'Subimos tu catálogo con fotos optimizadas, descripciones SEO y variantes configuradas.',
                    'deliverables' => ['Productos publicados', 'Categorías organizadas', 'Imágenes optimizadas']
                ],
                [
                    'number' => '05',
                    'title' => 'Testing y lanzamiento',
                    'duration' => '2-3 días',
                    'description' => 'Probamos cada funcionalidad, simulamos compras reales y lanzamos tu tienda.',
                    'deliverables' => ['Tests completados', 'Tienda online', 'Formación de uso']
                ],
                [
                    'number' => '06',
                    'title' => 'Optimización continua',
                    'duration' => 'Ongoing',
                    'description' => 'Analizamos datos, optimizamos conversión y te ayudamos a vender más cada mes.',
                    'deliverables' => ['Informes mensuales', 'Mejoras continuas', 'Soporte activo']
                ]
            ]
        ],

        // ============================================
        // CASOS DE ÉXITO
        // ============================================
        'caseStudies' => [
            'badge' => 'Resultados',
            'title' => 'Tiendas que ya están vendiendo',
            'description' => 'No te cuento lo que puedo hacer. Te enseño lo que ya he hecho.',
            'cases' => [
                [
                    'name' => 'Bodega Tierras de León',
                    'sector' => 'Alimentación / Vinos',
                    'image' => '/wp-content/themes/empc-theme/assets/cases/bodega.jpg',
                    'results' => [
                        ['value' => '+340%', 'label' => 'Ventas'],
                        ['value' => '3.8%', 'label' => 'Conversión'],
                        ['value' => '68€', 'label' => 'Ticket medio']
                    ],
                    'testimonial' => 'Pasamos de vender solo en la bodega a enviar a toda España. El primer mes facturamos más online que en todo el año anterior en tienda física.',
                    'author' => 'Roberto Fernández',
                    'role' => 'Propietario'
                ],
                [
                    'name' => 'Moda Urbana León',
                    'sector' => 'Moda / Ropa',
                    'image' => '/wp-content/themes/empc-theme/assets/cases/moda.jpg',
                    'results' => [
                        ['value' => '+180%', 'label' => 'Ventas'],
                        ['value' => '2.4%', 'label' => 'Conversión'],
                        ['value' => '89€', 'label' => 'Ticket medio']
                    ],
                    'testimonial' => 'La recuperación de carritos abandonados nos genera un 20% extra de ventas. Es dinero que antes perdíamos.',
                    'author' => 'Elena Martínez',
                    'role' => 'Directora'
                ],
                [
                    'name' => 'Artesanía Bierzo',
                    'sector' => 'Artesanía / Regalos',
                    'image' => '/wp-content/themes/empc-theme/assets/cases/artesania.jpg',
                    'results' => [
                        ['value' => '+520%', 'label' => 'Ventas'],
                        ['value' => '4.2%', 'label' => 'Conversión'],
                        ['value' => '45€', 'label' => 'Ticket medio']
                    ],
                    'testimonial' => 'Empezamos vendiendo en ferias. Ahora el 80% de nuestra facturación viene de la tienda online. Enviamos a 12 países.',
                    'author' => 'Marta Rodríguez',
                    'role' => 'Fundadora'
                ]
            ],
            'cta' => [
                'text' => 'Ver más casos de éxito',
                'href' => '/portafolio'
            ]
        ],

        // ============================================
        // FAQ
        // ============================================
        'faq' => [
            'badge' => 'FAQ',
            'title' => 'Preguntas frecuentes',
            'description' => 'Todo lo que necesitas saber antes de dar el paso',
            'items' => [
                [
                    'question' => '¿Cuánto tarda en estar lista mi tienda online?',
                    'answer' => 'Depende de la complejidad, pero una tienda estándar con 50-100 productos está lista en 3-4 semanas. Proyectos más grandes pueden llevar 6-8 semanas. Siempre te damos un calendario detallado antes de empezar.'
                ],
                [
                    'question' => '¿Qué plataforma me recomiendas: WooCommerce o Shopify?',
                    'answer' => 'Depende de tu situación. WooCommerce si quieres control total, máxima personalización y evitar comisiones por venta. Shopify si prefieres no preocuparte de hosting ni actualizaciones y empezar muy rápido. Te asesoro según tu caso específico.'
                ],
                [
                    'question' => '¿Puedo gestionar la tienda yo mismo después?',
                    'answer' => 'Absolutamente. Entregamos un panel de administración intuitivo y te damos formación para que puedas subir productos, gestionar pedidos, aplicar descuentos, etc. Aun así, siempre estoy disponible si necesitas ayuda.'
                ],
                [
                    'question' => '¿Qué métodos de pago puedo ofrecer?',
                    'answer' => 'Todos los principales: tarjeta (Stripe/Redsys), PayPal, Bizum, transferencia, contrareembolso, financiación (Sequra, Aplazame). Configuramos los que tengan sentido para tu negocio y público.'
                ],
                [
                    'question' => '¿Cómo se gestionan los envíos?',
                    'answer' => 'Integramos tu tienda con las principales agencias (SEUR, MRW, Correos, GLS, DHL). El cliente ve el coste en tiempo real, puede elegir método de envío, y recibe seguimiento automático. Tú solo preparas el paquete.'
                ],
                [
                    'question' => '¿Hay costes mensuales después del desarrollo?',
                    'answer' => 'El hosting para WooCommerce parte de 15-30€/mes según tráfico. En Shopify, el plan básico es 36€/mes + comisión por venta. Yo ofrezco planes de mantenimiento opcionales desde 99€/mes que incluyen hosting, actualizaciones, backups y soporte.'
                ],
                [
                    'question' => '¿Qué pasa si tengo miles de productos?',
                    'answer' => 'Sin problema. Usamos importación masiva por CSV/Excel para subir catálogos grandes. También podemos conectar con tu ERP para sincronización automática de stock y precios.'
                ],
                [
                    'question' => '¿La tienda será visible en Google?',
                    'answer' => 'Sí, aplicamos SEO desde el desarrollo: URLs amigables, meta tags, schema de producto, velocidad optimizada, sitemap. Además, te ayudo a configurar Google Merchant Center para aparecer en Google Shopping.'
                ],
                [
                    'question' => '¿Puedo vender en Amazon/eBay desde mi tienda?',
                    'answer' => 'Sí, en el plan Enterprise incluimos conexión con marketplaces. Tu stock se sincroniza automáticamente y gestionas todos los pedidos desde un solo panel.'
                ],
                [
                    'question' => '¿Qué garantías tengo?',
                    'answer' => '30 días de garantía post-lanzamiento donde corrijo cualquier bug sin coste. Además, si no quedas satisfecho con el diseño durante el desarrollo, lo rehacemos hasta 3 veces incluidas en el precio.'
                ]
            ],
            'ctaText' => '¿Tienes más dudas?',
            'ctaDescription' => 'Escríbeme y te respondo personalmente',
            'ctaLink' => ['text' => 'Contactar', 'href' => '#presupuesto']
        ],

        // ============================================
        // CTA / FORMULARIO
        // ============================================
        'cta' => [
            'title' => '¿Listo para empezar a vender online?',
            'description' => 'Cuéntame tu proyecto. Analizaré tu caso y te enviaré una propuesta personalizada en menos de 48 horas. Sin compromiso.',
            'theme' => 'emerald',
            'fields' => [
                ['name' => 'nombre', 'label' => 'Nombre', 'type' => 'text', 'required' => true, 'placeholder' => 'Tu nombre'],
                ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true, 'placeholder' => 'tu@email.com'],
                ['name' => 'telefono', 'label' => 'Teléfono', 'type' => 'tel', 'required' => false, 'placeholder' => '600 000 000'],
                [
                    'name' => 'sector',
                    'label' => '¿Qué quieres vender?',
                    'type' => 'select',
                    'required' => true,
                    'options' => [
                        ['value' => '', 'label' => 'Selecciona...'],
                        ['value' => 'moda', 'label' => 'Moda / Ropa / Complementos'],
                        ['value' => 'alimentacion', 'label' => 'Alimentación / Gourmet'],
                        ['value' => 'artesania', 'label' => 'Artesanía / Handmade'],
                        ['value' => 'electronica', 'label' => 'Electrónica / Tecnología'],
                        ['value' => 'hogar', 'label' => 'Hogar / Decoración'],
                        ['value' => 'belleza', 'label' => 'Belleza / Cosmética'],
                        ['value' => 'servicios', 'label' => 'Servicios / Cursos'],
                        ['value' => 'otro', 'label' => 'Otro']
                    ]
                ],
                [
                    'name' => 'productos',
                    'label' => '¿Cuántos productos tienes?',
                    'type' => 'select',
                    'required' => false,
                    'options' => [
                        ['value' => '', 'label' => 'Selecciona...'],
                        ['value' => '1-20', 'label' => '1 - 20 productos'],
                        ['value' => '20-50', 'label' => '20 - 50 productos'],
                        ['value' => '50-100', 'label' => '50 - 100 productos'],
                        ['value' => '100-500', 'label' => '100 - 500 productos'],
                        ['value' => '500+', 'label' => 'Más de 500']
                    ]
                ],
                [
                    'name' => 'presupuesto',
                    'label' => 'Presupuesto aproximado',
                    'type' => 'select',
                    'required' => false,
                    'options' => [
                        ['value' => '', 'label' => 'No lo tengo definido'],
                        ['value' => '1000-2000', 'label' => '1.000€ - 2.000€'],
                        ['value' => '2000-3500', 'label' => '2.000€ - 3.500€'],
                        ['value' => '3500-5000', 'label' => '3.500€ - 5.000€'],
                        ['value' => '5000+', 'label' => 'Más de 5.000€']
                    ]
                ],
                ['name' => 'mensaje', 'label' => 'Cuéntame más sobre tu proyecto', 'type' => 'textarea', 'required' => true, 'placeholder' => '¿Qué productos vendes? ¿Ya tienes tienda física? ¿Qué funcionalidades necesitas?', 'rows' => 4]
            ],
            'checkbox' => [
                'name' => 'urgente',
                'label' => 'Es urgente, necesito la tienda lo antes posible (te contactaré con prioridad)'
            ],
            'submitText' => 'Solicitar propuesta personalizada',
            'submitNote' => 'Sin compromiso. Respuesta garantizada en menos de 48 horas.',
            'phone' => [
                'text' => '¿Prefieres hablar directamente?',
                'number' => '+34 600 000 000'
            ]
        ],

        // ============================================
        // SEO
        // ============================================
        'seo' => [
            'title' => 'Tiendas Online en León | E-commerce Profesional - EMPC',
            'description' => 'Creamos tiendas online que venden. WooCommerce, Shopify, PrestaShop. Diseño profesional, pasarelas de pago, gestión de envíos. Presupuesto sin compromiso.',
            'schema' => [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => 'Desarrollo de Tiendas Online en León',
                'provider' => [
                    '@type' => 'LocalBusiness',
                    'name' => 'EMPC',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressLocality' => 'León',
                        'addressCountry' => 'ES'
                    ]
                ],
                'areaServed' => [
                    '@type' => 'Country',
                    'name' => 'España'
                ],
                'serviceType' => 'E-commerce Development',
                'offers' => [
                    '@type' => 'AggregateOffer',
                    'lowPrice' => '1200',
                    'highPrice' => '10000',
                    'priceCurrency' => 'EUR'
                ]
            ]
        ]
    ];
}

/**
 * Configuración de la página: SEO Local en León
 */
function get_seo_local_leon_config(): array
{
    return [
        // ============================================
        // HERO
        // ============================================
        'hero' => [
            'badge' => [
                'icon' => 'map-pin',
                'text' => 'SEO Local para negocios de León',
                'subtext' => 'Google Business Profile · reseñas · Local Pack',
            ],
            'title' => 'SEO Local en León',
            'highlight' => 'para aparecer en el mapa',
            'description' => 'Te ayudo a que tu negocio salga en el <strong>Local Pack de Google</strong> (el bloque con mapa y 3 resultados) cuando tus clientes buscan tu servicio en León.',
            'bulletPoints' => [
                ['text' => 'Optimización completa de Google Business Profile'],
                ['text' => 'Estrategia de reseñas y reputación'],
                ['text' => 'On-page SEO local en tu web existente'],
            ],
            'ctaPrimary' => [
                'text' => 'Quiero salir en el mapa',
                'href' => '#presupuesto',
                'icon' => 'map',
            ],
            'ctaSecondary' => [
                'text' => 'Simular impacto del Local Pack',
                'href' => '#simulador-local-pack',
                'icon' => 'activity',
            ],
            'stats' => [
                ['number' => '76%', 'label' => 'de clics van al Local Pack y top 3'],
                ['number' => '3x', 'label' => 'más llamadas desde Google Maps'],
                ['number' => '30+', 'label' => 'fichas optimizadas en León'],
            ],
            'theme' => 'emerald', // para los degradados en el hero
        ],

        // ============================================
        // FEATURES / BENEFICIOS
        // ============================================
        'features' => [
            'badge' => 'Qué incluye',
            'title' => 'SEO local más allá de rellenar la ficha',
            'description' => 'No se trata solo de verificar tu negocio en Google. Trabajamos estrategia, contenidos, reseñas y autoridad local.',
            'features' => [
                [
                    'icon' => 'map-pin',
                    'title' => 'Optimización de ficha',
                    'description' => 'Categorías correctas, descripción optimizada, servicios, productos, fotos y configuración avanzada.',
                    'iconColor' => 'emerald'
                ],
                [
                    'icon' => 'star',
                    'title' => 'Estrategia de reseñas',
                    'description' => 'Sistema sencillo para pedir reseñas reales a tus clientes y responder de forma profesional a todas.',
                    'iconColor' => 'emerald'
                ],
                [
                    'icon' => 'file-text',
                    'title' => 'SEO on-page local',
                    'description' => 'Páginas específicas por servicio y zona, marcado schema local y textos orientados a búsquedas locales.',
                    'iconColor' => 'emerald'
                ],
                [
                    'icon' => 'route',
                    'title' => 'Citas y menciones locales',
                    'description' => 'Presencia en directorios relevantes y medios locales que refuercen tu autoridad en la ciudad.',
                    'iconColor' => 'emerald'
                ],
                [
                    'icon' => 'phone-call',
                    'title' => 'Más llamadas, no solo clics',
                    'description' => 'Medimos llamadas y solicitudes desde Google Business Profile, no solo posiciones.',
                    'iconColor' => 'emerald'
                ],
                [
                    'icon' => 'radar',
                    'title' => 'Mapas de calor de visibilidad',
                    'description' => 'Opcionalmente, escaneamos en qué barrios de León sales o no sales para tus keywords clave.',
                    'iconColor' => 'emerald'
                ],
            ],
        ],

        // ============================================
        // SIMULADOR LOCAL PACK (ISLAND REACT)
        // ============================================
        'localPackSimulator' => [
            'id' => 'local-pack-simulator-island', // ID del div donde montas el island
            'title' => 'Simulador de impacto del Local Pack',
            'subtitle' => 'Calcula cuántos clientes podrías ganar saliendo en el Top 3 del mapa',
            'description' => 'Introduce cuántas búsquedas mensuales tiene tu servicio y te muestro la diferencia entre <strong>no salir en el Local Pack</strong> y aparecer en el <strong>puesto #1</strong> del mapa.',
            'defaultValues' => [
                'monthlySearches' => 800,   // Búsquedas mensuales por defecto
                'conversionRate' => 0.08,  // 8% (se mostrará como 8 en el input)
                'avgTicket' => 70,    // 70€ por cliente
                'currentPosition' => 'no_pack', // 'no_pack' | 'pack_3' | 'pack_2' | 'pack_1'
            ],
            'notes' => [
                'Son estimaciones basadas en CTR medios del Local Pack.',
                'Los resultados reales dependen de tu sector, reseñas y competencia.',
            ],
        ],

        // ============================================
        // PRICING
        // ============================================
        'pricing' => [
            'badge' => 'Planes',
            'title' => 'Planes de SEO Local',
            'description' => 'Trabajo siempre sobre negocios reales en León y alrededores. Planes pensados para pymes y autónomos.',
            'tiers' => [
                [
                    'title' => 'Setup Inicial',
                    'price' => '450€',
                    'description' => 'De cero a tener presencia local sólida',
                    'features' => [
                        'Alta y verificación de ficha (si hace falta)',
                        'Optimización completa de Google Business Profile',
                        'Configuración de categorías, servicios y productos',
                        'Revisión on-page básica de tu web',
                        'Plantilla para pedir reseñas a clientes',
                    ],
                    'idealFor' => 'Negocios que no tienen ficha o la tienen muy abandonada',
                    'ctaText' => 'Quiero poner en orden mi presencia local',
                    'ctaHref' => '#presupuesto',
                ],
                [
                    'title' => 'SEO Local Mensual',
                    'price' => '350€/mes',
                    'description' => 'Trabajamos posiciones y reputación mes a mes',
                    'highlighted' => true,
                    'badge' => '⭐ RECOMENDADO',
                    'features' => [
                        'Todo lo del Setup Inicial',
                        'Publicación mensual de posts en la ficha',
                        'Revisión y respuesta a reseñas',
                        'Ajustes on-page en tu web (SEO local)',
                        'Informe mensual con posiciones y llamadas',
                    ],
                    'idealFor' => 'Clínicas, restaurantes, talleres y negocios con competencia fuerte',
                    'ctaText' => 'Quiero mejorar en el mapa',
                    'ctaHref' => '#presupuesto',
                ],
                [
                    'title' => 'Multi-ubicación',
                    'price' => 'Desde 600€/mes',
                    'description' => 'Para franquicias o negocios con varias sedes',
                    'features' => [
                        'Estrategia global de SEO local',
                        'Optimización por sede',
                        'Coordinación de reseñas por centros',
                        'Informes comparativos entre ubicaciones',
                    ],
                    'idealFor' => 'Cadenas de clínicas, academias, etc.',
                    'ctaText' => 'Hablar de mi caso',
                    'ctaHref' => '#presupuesto',
                ],
            ],
            'note' => 'Sin permanencias largas. Si no ves progreso en 3-4 meses, revisamos estrategia juntos.',
        ],

        // ============================================
        // PROCESO
        // ============================================
        'process' => [
            'badge' => 'Metodología',
            'title' => 'Cómo trabajo el SEO local',
            'description' => 'Proceso pensado para que entiendas qué estamos haciendo y por qué.',
            'steps' => [
                [
                    'number' => '01',
                    'title' => 'Auditoría local',
                    'duration' => '1 semana',
                    'description' => 'Revisamos tu ficha actual, web, reseñas, menciones y competencia en León.',
                    'deliverables' => ['Informe de situación', 'Lista de oportunidades rápidas'],
                ],
                [
                    'number' => '02',
                    'title' => 'Acciones de base',
                    'duration' => '2-3 semanas',
                    'description' => 'Ponemos en orden ficha, web y datos de negocio en todos los sitios importantes.',
                    'deliverables' => ['Ficha optimizada', 'On-page local implementado'],
                ],
                [
                    'number' => '03',
                    'title' => 'Reputación y contenidos',
                    'duration' => 'Continuo',
                    'description' => 'Sistema de reseñas y publicaciones periódicas orientadas a tus servicios clave.',
                    'deliverables' => ['Calendario de reseñas', 'Posts en ficha'],
                ],
                [
                    'number' => '04',
                    'title' => 'Seguimiento y mejora',
                    'duration' => 'Mensual',
                    'description' => 'Monitorizamos palabras clave, llamadas y rutas para ajustar la estrategia.',
                    'deliverables' => ['Informe mensual', 'Ajustes tácticos'],
                ],
            ],
        ],

        // ============================================
        // FAQ
        // ============================================
        'faq' => [
            'badge' => 'FAQ',
            'title' => 'Preguntas frecuentes sobre SEO local',
            'description' => 'Lo que solemos aclarar antes de empezar a trabajar juntos.',
            'faqs' => [
                [
                    'question' => '¿En cuánto tiempo se ven resultados?',
                    'answer' => 'En negocios sin casi presencia, solemos ver mejoras en visibilidad y llamadas en 4-8 semanas. Para sectores muy competidos, el trabajo es más de medio plazo (3-6 meses).',
                ],
                [
                    'question' => '¿Garantizas salir el primero?',
                    'answer' => 'No. Nadie serio puede garantizar posiciones concretas. Lo que sí garantizo es aplicar buenas prácticas, transparencia y revisar juntos los datos mes a mes.',
                ],
                [
                    'question' => '¿Necesito una web para hacer SEO local?',
                    'answer' => 'Tener una buena web ayuda mucho, pero podemos mejorar tu ficha de Google incluso aunque tu web sea básica. A medio plazo, lo ideal es alinear web + SEO local.',
                ],
                [
                    'question' => '¿Trabajas solo en León?',
                    'answer' => 'Estoy especializado en León y provincia, pero también trabajo con negocios de otras ciudades si encaja el proyecto.',
                ],
            ],
            'ctaText' => '¿Dudas sobre tu caso concreto?',
            'ctaDescription' => 'Mándame un mensaje y vemos juntos si el SEO local tiene sentido para tu negocio.',
            'ctaLink' => ['text' => 'Contactar', 'href' => '#presupuesto'],
        ],

        // ============================================
        // CTA / FORMULARIO FINAL
        // ============================================
        'cta' => [
            'title' => '¿Quieres salir en el mapa cuando te busquen en León?',
            'description' => 'Cuéntame qué tipo de negocio tienes y para qué búsquedas locales quieres aparecer.',
            'theme' => 'emerald',
            'fields' => [
                ['name' => 'nombre', 'label' => 'Nombre', 'type' => 'text', 'required' => true, 'placeholder' => 'Tu nombre'],
                ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'required' => true, 'placeholder' => 'tu@email.com'],
                ['name' => 'telefono', 'label' => 'Teléfono', 'type' => 'tel', 'required' => false, 'placeholder' => '600 000 000'],
                [
                    'name' => 'tipo_negocio',
                    'label' => 'Tipo de negocio',
                    'type' => 'select',
                    'required' => true,
                    'options' => [
                        ['value' => '', 'label' => 'Selecciona...'],
                        ['value' => 'restaurante', 'label' => 'Restaurante / Bar'],
                        ['value' => 'clinica', 'label' => 'Clínica / Salud'],
                        ['value' => 'taller', 'label' => 'Taller mecánico'],
                        ['value' => 'tienda', 'label' => 'Tienda física'],
                        ['value' => 'servicios', 'label' => 'Servicios a domicilio'],
                        ['value' => 'otro', 'label' => 'Otro'],
                    ],
                ],
                [
                    'name' => 'palabras_clave',
                    'label' => '¿Para qué búsquedas te gustaría salir?',
                    'type' => 'textarea',
                    'required' => true,
                    'placeholder' => 'Ej: "dentista en León", "fisioterapeuta en Eras de Renueva", etc.',
                    'rows' => 3,
                ],
            ],
            'submitText' => 'Analizar mi visibilidad local',
            'submitNote' => 'Te responderé con una mini auditoría gratuita en menos de 72 horas.',
        ],

        // ============================================
        // SEO META / SCHEMA
        // ============================================
        'seo' => [
            'title' => 'SEO Local en León | Sal en el mapa de Google - EMPC',
            'description' => 'Optimización de Google Business Profile y SEO local en León. Más visibilidad en el mapa, más llamadas y más clientes cerca de ti.',
            'schema' => [
                '@context' => 'https://schema.org',
                '@type' => 'Service',
                'name' => 'SEO Local en León',
                'provider' => [
                    '@type' => 'LocalBusiness',
                    'name' => 'EMPC',
                    'address' => [
                        '@type' => 'PostalAddress',
                        'addressLocality' => 'León',
                        'addressCountry' => 'ES',
                    ],
                ],
                'serviceType' => 'Local SEO',
            ],
        ],
    ];
}

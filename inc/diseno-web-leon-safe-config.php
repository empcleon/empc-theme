<?php
/**
 * Configuración editorial segura para /diseno-web-leon/.
 * No incluye cifras, testimonios ni garantías que no estén acreditados.
 */

defined('ABSPATH') || exit;

if (!function_exists('empc_diseno_web_leon_safe_config')) {
    function empc_diseno_web_leon_safe_config(): array
    {
        return [
            'seo' => [
                'title' => 'Diseño web en León para empresas y autónomos | EMPC',
                'description' => 'Diseño web en León con WordPress, rendimiento y soporte directo. Creamos páginas claras para empresas y autónomos que quieren captar clientes.',
            ],
            'hero' => [
                'badge' => 'Diseño web en León',
                'title' => 'Diseño web en León para empresas y autónomos',
                'highlight' => '',
                'description' => 'Creo páginas web claras, administrables y orientadas a que tus clientes entiendan qué haces y sepan cómo contactar contigo. Trabajo directamente contigo y te explico el alcance antes de empezar.',
                'bulletPoints' => [
                    ['text' => 'WordPress administrable y adaptado a tu negocio'],
                    ['text' => 'Presupuesto y alcance definidos antes del desarrollo'],
                    ['text' => 'Rendimiento, estructura y soporte posterior'],
                ],
                'ctaPrimary' => ['text' => 'Solicitar presupuesto'],
                'ctaSecondary' => ['text' => 'Ver cómo trabajo'],
            ],
            'features' => [
                'title' => 'Una web pensada para ser útil',
                'description' => 'El objetivo no es añadir tecnología porque sí. Es construir una web que explique tu oferta, resuelva dudas y facilite que una persona interesada dé el siguiente paso.',
                'features' => [
                    ['title' => 'Contenido claro', 'description' => 'Ordenamos tus servicios, tu propuesta y tus datos de contacto para que un visitante pueda entenderlos sin conocimientos técnicos.'],
                    ['title' => 'WordPress administrable', 'description' => 'Podrás gestionar los contenidos habituales de tu negocio con una herramienta conocida y con una estructura preparada para crecer.'],
                    ['title' => 'Rendimiento cuidado', 'description' => 'Optimizamos la carga, las imágenes y los recursos necesarios sin convertir una cifra concreta en una promesa que no podamos garantizar para todos los casos.'],
                    ['title' => 'Trato directo', 'description' => 'Hablas con Emma durante el proyecto, sin pasar por un equipo comercial que después no conoce las decisiones tomadas.'],
                    ['title' => 'Alcance transparente', 'description' => 'El presupuesto describe qué se entrega, qué queda fuera y qué opciones pueden añadirse más adelante.'],
                    ['title' => 'Base para captar contactos', 'description' => 'La web se estructura con llamadas a la acción, formularios y páginas de servicio que pueden medirse y mejorarse con el tiempo.'],
                ],
            ],
            'process' => [
                'title' => 'Cómo trabajo',
                'description' => 'Un proceso sencillo para que conozcas el siguiente paso y no tengas que adivinar qué está ocurriendo con tu proyecto.',
                'steps' => [
                    ['step' => '01', 'title' => 'Hablamos del negocio', 'description' => 'Reviso qué vendes, a quién te diriges, qué debe conseguir la web y qué información ya tienes disponible.'],
                    ['step' => '02', 'title' => 'Definimos el alcance', 'description' => 'Concretamos páginas, funcionalidades, contenidos, integraciones y responsabilidades antes de preparar el presupuesto.'],
                    ['step' => '03', 'title' => 'Diseño y desarrollo', 'description' => 'Construyo la web en WordPress con una estructura comprensible, adaptada a móvil y preparada para que el contenido sea visible.'],
                    ['step' => '04', 'title' => 'Revisión y entrega', 'description' => 'Revisamos el resultado, corrijo los ajustes incluidos y te explico cómo administrar los contenidos acordados.'],
                ],
            ],
            'faq' => [
                'title' => 'Preguntas frecuentes',
                'faqs' => [
                    ['question' => '¿Trabajas con empresas y autónomos de León?', 'answer' => 'Sí. El servicio está pensado para pequeños negocios, profesionales y empresas que necesitan una web clara para presentar sus servicios y recibir contactos.'],
                    ['question' => '¿La web se puede editar después?', 'answer' => 'Sí. La web se desarrolla con WordPress y se entrega con una estructura administrable. También podemos hablar del mantenimiento posterior si quieres delegar las actualizaciones.'],
                    ['question' => '¿Incluye posicionamiento SEO?', 'answer' => 'La estructura se prepara con criterios técnicos y de contenido básicos. El posicionamiento orgánico continuo es un servicio distinto y debe presupuestarse según objetivos, competencia y trabajo necesario.'],
                    ['question' => '¿Qué ocurre después de publicar?', 'answer' => 'Puedes encargarte de la gestión diaria o contratar mantenimiento posterior. Si ya tienes una web que necesita atención, consulta el servicio específico de mantenimiento WordPress.'],
                    ['question' => '¿También haces tiendas online?', 'answer' => 'Sí, pero las tiendas online tienen necesidades, costes y procesos diferentes. Consulta la página específica de tiendas online para no mezclar ambos servicios.'],
                    ['question' => '¿Puedes revisar una web existente?', 'answer' => 'Sí. Podemos valorar una web ya creada, sus problemas y el alcance de los cambios antes de decidir si conviene mejorarla o rehacer solo una parte.'],
                ],
            ],
            'cta' => [
                'title' => 'Cuéntame qué necesitas',
                'description' => 'Envíame los datos básicos de tu proyecto y te responderé con el siguiente paso y un presupuesto ajustado al alcance real.',
                'submitText' => 'Solicitar presupuesto',
                'showBudgetField' => false,
                'showProjectType' => true,
            ],
        ];
    }
}

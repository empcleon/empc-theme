<?php

$theme_uri = get_template_directory_uri();

return [
    'meta' => [
        'page_size' => 8,
        'hero_note_html' => 'Cada ficha muestra <strong>publicación</strong>, <strong>última revisión</strong> y <strong>última prueba</strong>. Los recursos propios siguen en estado <strong>EXPERIMENTAL</strong> hasta que se ejecutan de verdad.',
    ],
    'items' => [
        [
            'id' => 'lab-prompt-personaje-consistente',
            'slug' => 'ficha-canonica-personaje-consistente',
            'titulo' => 'Ficha canónica para un personaje ilustrado consistente',
            'descripcion_corta' => 'Prompt base para fijar identidad, estilo, proporciones y vestuario sin que el modelo se desvíe.',
            'tipo_key' => 'prompt',
            'tipo_label' => 'Prompt EMPC',
            'categoria' => 'Imagen',
            'objetivo' => 'Definir un personaje reutilizable para series de imágenes, portadas o storyboard visual.',
            'plataformas' => ['ChatGPT', 'Gemini', 'Midjourney', 'Flux'],
            'nivel_key' => 'intermedio',
            'nivel' => 'Intermedio',
            'estado' => 'EXPERIMENTAL',
            'publication_date' => '2026-08-14',
            'last_review_date' => '2026-08-25',
            'last_test_date' => null,
            'autor' => 'EMPC',
            'source_name' => 'Original EMPC',
            'source_url' => '',
            'licencia_o_condiciones' => 'Original EMPC',
            'material_necesario' => 'Foto o referencia base, descripción del personaje y uso final.',
            'instrucciones' => 'Usa una única referencia, fija rostro y ropa, define lo que no debe cambiar y evita sobre-retocar.',
            'variables' => ['identidad', 'estilo', 'vestuario', 'expresión', 'encuadre'],
            'prompt' => <<<'PROMPT'
Use my uploaded reference as the visual anchor and preserve the same identity across every image.

Keep the face recognizable, the proportions stable, the hairstyle coherent, and the wardrobe consistent.
Do not redesign the character.
Do not invent new accessories.
Do not change the age, body type, or style direction.

Define clearly:
- identity;
- hairstyle;
- clothing;
- expression;
- lighting;
- background;
- what must never change.

Aim for a consistent character sheet that can be reused in future images, storyboards, or social media pieces.
PROMPT,
            'version_corta' => 'Fija identidad, estilo y límites; no rediseñar el personaje.',
            'version_avanzada' => 'Añade encuadre, iluminación, restricciones y negative prompt.',
            'resultado_esperado' => 'Un personaje reconocible y repetible en distintas escenas.',
            'resultado_ejemplo' => 'Tres imágenes distintas con el mismo rostro, pelo y vestuario base.',
            'limitaciones' => 'Si el modelo suaviza demasiado o cambia el peinado, usar una versión más cerrada.',
            'errores_conocidos' => 'Tiende a simplificar detalles o a variar la textura de piel y cabello.',
            'advertencias' => 'No usar fotos de terceros sin permiso.',
            'version' => '0.2.0',
            'historial_cambios' => [
                ['fecha' => '2026-08-14', 'cambio' => 'Creación inicial de la ficha canónica.'],
                ['fecha' => '2026-08-25', 'cambio' => 'Añadidos campos de portada y prueba.'],
            ],
            'recursos_relacionados' => ['de-una-idea-a-un-reel-vertical-de-15-segundos', 'prompt-para-resumen-operativo'],
            'copy_text' => <<<'COPY'
Use my uploaded reference as the visual anchor and preserve the same identity across every image.
Keep the face recognizable, the proportions stable, the hairstyle coherent, and the wardrobe consistent.
Do not redesign the character. Do not invent new accessories. Do not change the age, body type, or style direction.
Define clearly identity, hairstyle, clothing, expression, lighting, background, and what must never change.
COPY,
            'external' => false,
            'cover_type' => 'prompt',
            'cover_image' => $theme_uri . '/assets/laboratorio-ia/covers/prompt.svg',
            'cover_alt' => 'Portada coral para una ficha de prompt EMPC',
            'cover_focal_position' => 'center',
            'sort_weight' => 10,
            'summary_html' => 'Prompt base para fijar identidad, estilo, proporciones y vestuario sin que el modelo se desvíe.',
        ],
        [
            'id' => 'lab-prompt-reel-15s',
            'slug' => 'de-una-idea-a-un-reel-vertical-de-15-segundos',
            'titulo' => 'De una idea a un reel vertical de 15 segundos',
            'descripcion_corta' => 'Prompt para convertir una idea en un reel breve con guion, escenas y CTA sin prometer viralidad.',
            'tipo_key' => 'prompt',
            'tipo_label' => 'Prompt EMPC',
            'categoria' => 'Vídeo',
            'objetivo' => 'Pasar de una idea inicial a una pieza vertical breve lista para producir.',
            'plataformas' => ['ChatGPT', 'Gemini', 'Runway', 'Veo'],
            'nivel_key' => 'basico',
            'nivel' => 'Básico',
            'estado' => 'EXPERIMENTAL',
            'publication_date' => '2026-08-14',
            'last_review_date' => '2026-08-25',
            'last_test_date' => null,
            'autor' => 'EMPC',
            'source_name' => 'Original EMPC',
            'source_url' => '',
            'licencia_o_condiciones' => 'Original EMPC',
            'material_necesario' => 'Idea inicial, objetivo, audiencia, tono y duración.',
            'instrucciones' => 'Pide objetivo, gancho, escenas, texto en pantalla, CTA y comprobaciones antes de producir.',
            'variables' => ['objetivo', 'audiencia', 'gancho', 'tono', 'duración'],
            'prompt' => <<<'PROMPT'
Turn one idea into a vertical 15-second reel.

Ask for:
- objective;
- target audience;
- hook;
- narrative structure;
- literal script;
- scenes;
- camera notes;
- on-screen text;
- CTA;
- 9:16 adaptation;
- final checks before export.

Do not promise virality.
Do not assume the idea is already good.
Do not skip validation.
PROMPT,
            'version_corta' => 'Convierte una idea en un reel breve con estructura y CTA.',
            'version_avanzada' => 'Añade guion literal, plano por plano, texto en pantalla y checklist final.',
            'resultado_esperado' => 'Una estructura accionable para producir el reel sin improvisar.',
            'resultado_ejemplo' => 'Brief de 15 segundos con gancho, 4 escenas y cierre claro.',
            'limitaciones' => 'No sustituye la edición ni garantiza rendimiento en redes.',
            'errores_conocidos' => 'Puede alargar demasiado el guion si no se acota el objetivo.',
            'advertencias' => 'Revisar derechos de música, imagen y uso de terceros.',
            'version' => '0.2.0',
            'historial_cambios' => [
                ['fecha' => '2026-08-14', 'cambio' => 'Creación inicial del workflow a reel.'],
                ['fecha' => '2026-08-25', 'cambio' => 'Añadidos campos de portada y prueba.'],
            ],
            'recursos_relacionados' => ['ficha-canonica-personaje-consistente', 'workflow-investigacion-publicacion'],
            'copy_text' => <<<'COPY'
Turn one idea into a vertical 15-second reel.
Ask for objective, target audience, hook, narrative structure, literal script, scenes, camera notes, on-screen text, CTA, 9:16 adaptation, and final checks before export.
Do not promise virality.
COPY,
            'external' => false,
            'cover_type' => 'prompt',
            'cover_image' => $theme_uri . '/assets/laboratorio-ia/covers/prompt.svg',
            'cover_alt' => 'Portada coral para un prompt de vídeo corto',
            'cover_focal_position' => 'center',
            'sort_weight' => 20,
            'summary_html' => 'Prompt para convertir una idea en un reel breve con guion, escenas y CTA sin prometer viralidad.',
        ],
        [
            'id' => 'lab-prompt-resumen-operativo',
            'slug' => 'prompt-para-resumen-operativo',
            'titulo' => 'Prompt para resumen operativo de reunión',
            'descripcion_corta' => 'Prompt para convertir notas sueltas en un resumen accionable con decisiones, tareas y responsables.',
            'tipo_key' => 'prompt',
            'tipo_label' => 'Prompt EMPC',
            'categoria' => 'Documentación',
            'objetivo' => 'Obtener un resumen claro sin perder decisiones, fechas o tareas.',
            'plataformas' => ['ChatGPT', 'Gemini', 'NotebookLM'],
            'nivel_key' => 'basico',
            'nivel' => 'Básico',
            'estado' => 'EXPERIMENTAL',
            'publication_date' => '2026-08-25',
            'last_review_date' => '2026-08-25',
            'last_test_date' => null,
            'autor' => 'EMPC',
            'source_name' => 'Original EMPC',
            'source_url' => '',
            'licencia_o_condiciones' => 'Original EMPC',
            'material_necesario' => 'Notas, lista de asistentes, objetivos y acuerdos.',
            'instrucciones' => 'Pide contexto, decisiones, tareas, responsables, plazos y próximos pasos.',
            'variables' => ['contexto', 'decisiones', 'tareas', 'responsables', 'plazos'],
            'prompt' => <<<'PROMPT'
Turn messy meeting notes into a concise operational summary.

Return:
- summary;
- decisions;
- action items;
- owners;
- deadlines;
- open questions;
- next step.

Do not invent details that were not discussed.
Do not lose deadlines.
Do not hide uncertainties.
PROMPT,
            'version_corta' => 'Convierte notas desordenadas en un resumen operativo.',
            'version_avanzada' => 'Añade decisiones, tareas, responsables, plazos y preguntas abiertas.',
            'resultado_esperado' => 'Un resumen listo para reenviar al equipo o al cliente.',
            'resultado_ejemplo' => 'Acta breve con 3 decisiones, 4 tareas y 2 plazos.',
            'limitaciones' => 'Si las notas son ambiguas, el resultado también lo será.',
            'errores_conocidos' => 'Puede sintetizar en exceso si no se le obliga a listar tareas.',
            'advertencias' => 'Revisar nombres propios y fechas antes de distribuir.',
            'version' => '0.1.0',
            'historial_cambios' => [
                ['fecha' => '2026-08-25', 'cambio' => 'Creación inicial del prompt de resumen operativo.'],
            ],
            'recursos_relacionados' => ['prompt-para-resumen-de-evidencias', 'workflow-investigacion-publicacion'],
            'copy_text' => <<<'COPY'
Turn messy meeting notes into a concise operational summary.
Return summary, decisions, action items, owners, deadlines, open questions, and next step.
Do not invent details that were not discussed.
COPY,
            'external' => false,
            'cover_type' => 'prompt',
            'cover_image' => $theme_uri . '/assets/laboratorio-ia/covers/prompt.svg',
            'cover_alt' => 'Portada coral para un prompt de resumen operativo',
            'cover_focal_position' => 'center',
            'sort_weight' => 30,
            'summary_html' => 'Prompt para convertir notas sueltas en un resumen accionable con decisiones, tareas y responsables.',
        ],
        [
            'id' => 'lab-prompt-evidencias',
            'slug' => 'prompt-para-resumen-de-evidencias',
            'titulo' => 'Prompt para resumen de evidencias',
            'descripcion_corta' => 'Prompt para resumir fuentes, capturas y hallazgos sin perder trazabilidad ni límites.',
            'tipo_key' => 'prompt',
            'tipo_label' => 'Prompt EMPC',
            'categoria' => 'Auditoría',
            'objetivo' => 'Convertir materiales de soporte en un resumen con evidencias y huecos detectados.',
            'plataformas' => ['ChatGPT', 'Gemini', 'NotebookLM'],
            'nivel_key' => 'intermedio',
            'nivel' => 'Intermedio',
            'estado' => 'EXPERIMENTAL',
            'publication_date' => '2026-08-25',
            'last_review_date' => '2026-08-25',
            'last_test_date' => null,
            'autor' => 'EMPC',
            'source_name' => 'Original EMPC',
            'source_url' => '',
            'licencia_o_condiciones' => 'Original EMPC',
            'material_necesario' => 'Notas, fuentes, capturas y conclusiones preliminares.',
            'instrucciones' => 'Pide qué está confirmado, qué falta por verificar y qué evidencia lo sostiene.',
            'variables' => ['fuentes', 'hallazgos', 'limitaciones', 'riesgos'],
            'prompt' => <<<'PROMPT'
Summarize the evidence trail clearly.

Return:
- confirmed facts;
- supporting evidence;
- unresolved questions;
- risks and limitations;
- next verification steps.

Do not blur evidence with assumptions.
Do not remove the source trail.
PROMPT,
            'version_corta' => 'Resume fuentes y hallazgos sin perder trazabilidad.',
            'version_avanzada' => 'Incluye confirmados, pendientes, riesgos y próximos pasos.',
            'resultado_esperado' => 'Un informe corto útil para revisión o decisión.',
            'resultado_ejemplo' => 'Informe con 5 pruebas, 2 dudas y 3 siguientes pasos.',
            'limitaciones' => 'No reemplaza una verificación humana ni la lectura de las fuentes.',
            'errores_conocidos' => 'Puede mezclar hipótesis y hechos si el contexto entra sucio.',
            'advertencias' => 'Mantener la cadena de fuentes para no perder trazabilidad.',
            'version' => '0.1.0',
            'historial_cambios' => [
                ['fecha' => '2026-08-25', 'cambio' => 'Creación inicial del prompt de evidencias.'],
            ],
            'recursos_relacionados' => ['prompt-para-resumen-operativo', 'workflow-investigacion-publicacion'],
            'copy_text' => <<<'COPY'
Summarize the evidence trail clearly.
Return confirmed facts, supporting evidence, unresolved questions, risks and limitations, and next verification steps.
Do not blur evidence with assumptions.
COPY,
            'external' => false,
            'cover_type' => 'prompt',
            'cover_image' => $theme_uri . '/assets/laboratorio-ia/covers/prompt.svg',
            'cover_alt' => 'Portada coral para un prompt de evidencias',
            'cover_focal_position' => 'center',
            'sort_weight' => 40,
            'summary_html' => 'Prompt para resumir fuentes, capturas y hallazgos sin perder trazabilidad ni límites.',
        ],
        [
            'id' => 'lab-external-clicmayores',
            'slug' => 'prompt-en-clicmayores',
            'titulo' => 'Prompt en ClicMayores',
            'descripcion_corta' => 'Biblioteca en español con prompts, tutoriales y pequeñas aplicaciones de apoyo.',
            'tipo_key' => 'radar',
            'tipo_label' => 'Radar externo',
            'categoria' => 'Biblioteca',
            'objetivo' => 'Servir como radar de recursos externos y referencia comparativa para EMPC.',
            'plataformas' => ['Web'],
            'nivel_key' => 'basico',
            'nivel' => 'Básico',
            'estado' => 'RECURSO EXTERNO REVISADO',
            'publication_date' => '2026-08-14',
            'last_review_date' => '2026-08-25',
            'last_test_date' => '2026-08-25',
            'autor' => 'ClicMayores',
            'source_name' => 'ClicMayores',
            'source_url' => 'https://www.clicmayores.com/prompt/',
            'licencia_o_condiciones' => 'PENDIENTE DE VERIFICACIÓN',
            'material_necesario' => 'Navegador y criterio de revisión.',
            'instrucciones' => 'Revisa la ficha oficial, resume con tus palabras y evita copiar contenido ajeno.',
            'variables' => [],
            'prompt' => '',
            'version_corta' => 'Biblioteca de prompts y tutoriales con enfoque práctico.',
            'version_avanzada' => 'Incluye explicaciones, pequeñas utilidades y ejemplos de uso.',
            'resultado_esperado' => 'Una referencia útil para estudiar formatos y estructura de fichas.',
            'resultado_ejemplo' => 'Listado de recursos para comparar cómo presentan prompts y workflows.',
            'limitaciones' => 'La generación real suele hacerse en otra IA; no conviene copiar sin permiso.',
            'errores_conocidos' => 'Puede haber mezcla de tutorial, prompt y utilidad en la misma ficha.',
            'advertencias' => 'No reutilizar prompts completos ni código sin revisar términos de uso.',
            'version' => '0.1.0',
            'historial_cambios' => [
                ['fecha' => '2026-08-14', 'cambio' => 'Alta del radar externo de ClicMayores.'],
                ['fecha' => '2026-08-25', 'cambio' => 'Revisión documental y de licencia pendiente.'],
            ],
            'recursos_relacionados' => ['hrp-4k-constructor-de-hojas-de-personaje'],
            'copy_text' => '',
            'external' => true,
            'cover_type' => 'radar',
            'cover_image' => $theme_uri . '/assets/laboratorio-ia/covers/radar.svg',
            'cover_alt' => 'Portada azul y cian para un radar externo',
            'cover_focal_position' => 'center',
            'sort_weight' => 50,
            'summary_html' => 'Biblioteca en español con prompts, tutoriales y pequeñas aplicaciones de apoyo.',
        ],
        [
            'id' => 'lab-external-hrp-4k',
            'slug' => 'hrp-4k-constructor-de-hojas-de-personaje',
            'titulo' => 'HRP 4K — Constructor de hojas de personaje',
            'descripcion_corta' => 'Herramienta de composición 4K para organizar imágenes y extraer fotogramas de referencia.',
            'tipo_key' => 'radar',
            'tipo_label' => 'Radar externo',
            'categoria' => 'Herramienta',
            'objetivo' => 'Referenciar un constructor visual de hojas de personaje sin atribuirle capacidades que no ofrece.',
            'plataformas' => ['Web'],
            'nivel_key' => 'intermedio',
            'nivel' => 'Intermedio',
            'estado' => 'RECURSO EXTERNO REVISADO',
            'publication_date' => '2026-08-14',
            'last_review_date' => '2026-08-25',
            'last_test_date' => '2026-08-25',
            'autor' => 'ClicMayores',
            'source_name' => 'ClicMayores HRP 4K Suite',
            'source_url' => 'https://www.clicmayores.com/prompt/hrp-4k-suite.html',
            'licencia_o_condiciones' => 'PENDIENTE DE VERIFICACIÓN',
            'material_necesario' => 'Vídeo o imágenes base para componer una hoja.',
            'instrucciones' => 'Consulta el recurso oficial y verifica qué parte es composición, qué parte es generación y qué parte depende de otra IA.',
            'variables' => [],
            'prompt' => '',
            'version_corta' => 'Organiza imágenes y exporta una composición 3840 × 2160.',
            'version_avanzada' => 'Puede extraer cinco fotogramas y montar hojas de personaje.',
            'resultado_esperado' => 'Una hoja visual útil como referencia, no una garantía de detalle absoluto.',
            'resultado_ejemplo' => 'Composición PNG para revisar rostro, vestuario y continuidad.',
            'limitaciones' => '4K de lienzo no garantiza más detalle en los originales ni consistencia absoluta.',
            'errores_conocidos' => 'Se puede confundir el lienzo 4K con detalle real del contenido.',
            'advertencias' => 'No copiar su prompt de vídeo ni el código asociado.',
            'version' => '0.1.0',
            'historial_cambios' => [
                ['fecha' => '2026-08-14', 'cambio' => 'Alta del radar externo HRP 4K.'],
                ['fecha' => '2026-08-25', 'cambio' => 'Revisión documental y de licencia pendiente.'],
            ],
            'recursos_relacionados' => ['prompt-en-clicmayores'],
            'copy_text' => '',
            'external' => true,
            'cover_type' => 'radar',
            'cover_image' => $theme_uri . '/assets/laboratorio-ia/covers/radar.svg',
            'cover_alt' => 'Portada azul y cian para un recurso radar externo',
            'cover_focal_position' => 'center',
            'sort_weight' => 60,
            'summary_html' => 'Constructor de hojas de personaje con composición 4K y extracción de fotogramas.',
        ],
        [
            'id' => 'lab-external-openai-prompting',
            'slug' => 'guia-openai-prompt-engineering',
            'titulo' => 'Guía de prompt engineering de OpenAI',
            'descripcion_corta' => 'Referencia oficial para entender cómo estructurar instrucciones, ejemplos y límites.',
            'tipo_key' => 'radar',
            'tipo_label' => 'Radar externo',
            'categoria' => 'Documentación',
            'objetivo' => 'Comparar buenas prácticas de prompting con una fuente oficial y estable.',
            'plataformas' => ['Web'],
            'nivel_key' => 'intermedio',
            'nivel' => 'Intermedio',
            'estado' => 'RECURSO EXTERNO REVISADO',
            'publication_date' => '2026-08-25',
            'last_review_date' => '2026-08-25',
            'last_test_date' => '2026-08-25',
            'autor' => 'OpenAI',
            'source_name' => 'OpenAI Docs',
            'source_url' => 'https://platform.openai.com/docs/guides/prompt-engineering',
            'licencia_o_condiciones' => 'Según documentación oficial',
            'material_necesario' => 'Navegador y criterio de revisión.',
            'instrucciones' => 'Leer la guía oficial, resumir y enlazar solo aquello útil para EMPC.',
            'variables' => [],
            'prompt' => '',
            'version_corta' => 'Guía oficial para estructurar instrucciones y ejemplos.',
            'version_avanzada' => 'Incluye buenas prácticas, ejemplos y límites de formato.',
            'resultado_esperado' => 'Una base para comparar los prompts de EMPC con una referencia canónica.',
            'resultado_ejemplo' => 'Checklist para evaluar claridad, contexto y ejemplos de un prompt.',
            'limitaciones' => 'No sustituye la experimentación con modelos reales.',
            'errores_conocidos' => 'Puede llevar a sobreestructurar prompts si no se adapta al caso.',
            'advertencias' => 'No copiar sin adaptar; la guía es para orientar, no para calcarlos.',
            'version' => '0.1.0',
            'historial_cambios' => [
                ['fecha' => '2026-08-25', 'cambio' => 'Alta del radar externo de OpenAI Docs.'],
            ],
            'recursos_relacionados' => ['prompt-en-clicmayores'],
            'copy_text' => '',
            'external' => true,
            'cover_type' => 'radar',
            'cover_image' => $theme_uri . '/assets/laboratorio-ia/covers/radar.svg',
            'cover_alt' => 'Portada azul y cian para documentación externa',
            'cover_focal_position' => 'center',
            'sort_weight' => 70,
            'summary_html' => 'Referencia oficial para entender cómo estructurar instrucciones, ejemplos y límites.',
        ],
        [
            'id' => 'lab-workflow-character-video',
            'slug' => 'de-personaje-consistente-a-video-corto',
            'titulo' => 'De personaje consistente a vídeo corto',
            'descripcion_corta' => 'Workflow para pasar de una identidad estable a un vídeo breve con continuidad visual.',
            'tipo_key' => 'workflow',
            'tipo_label' => 'Workflow EMPC',
            'categoria' => 'Vídeo',
            'objetivo' => 'Conectar investigación, imágenes, validación y animación en un flujo editorial corto.',
            'plataformas' => ['EMPC', 'NotebookLM', 'Runway', 'Veo'],
            'nivel_key' => 'avanzado',
            'nivel' => 'Avanzado',
            'estado' => 'EN PRUEBAS',
            'publication_date' => '2026-08-14',
            'last_review_date' => '2026-08-25',
            'last_test_date' => null,
            'autor' => 'EMPC',
            'source_name' => 'Workflow EMPC',
            'source_url' => '',
            'licencia_o_condiciones' => 'Original EMPC',
            'material_necesario' => 'Identidad canónica, imagen maestra, guion y herramientas externas.',
            'instrucciones' => 'Separa claramente qué hace una persona, qué hace EMPC y qué hace cada herramienta externa.',
            'variables' => ['identidad', 'escenas', 'duración', 'tono'],
            'prompt' => '',
            'workflow_steps' => [
                'Definir identidad canónica.',
                'Aprobar imagen maestra.',
                'Generar vistas necesarias.',
                'Validar continuidad.',
                'Crear storyboard.',
                'Generar una imagen limpia por toma.',
                'Animar cada toma.',
                'Añadir textos en edición.',
                'Revisar identidad, manos, vestuario y movimiento.',
                'Exportar y etiquetar contenido sintético cuando corresponda.',
            ],
            'version_corta' => 'De una ficha aprobada a un vídeo breve con continuidad.',
            'version_avanzada' => 'Incluye storyboard, validación de continuidad y revisión final.',
            'resultado_esperado' => 'Un vídeo corto coherente con el personaje, sin saltos de identidad.',
            'resultado_ejemplo' => 'Secuencia de 3-5 planos con estilo coherente y subtítulos en edición.',
            'limitaciones' => 'Si falla la continuidad, hay que volver a la imagen maestra.',
            'errores_conocidos' => 'Las manos y los cambios de plano suelen exigir revisión humana.',
            'advertencias' => 'Etiquetar como contenido sintético cuando proceda.',
            'version' => '0.2.0',
            'historial_cambios' => [
                ['fecha' => '2026-08-14', 'cambio' => 'Creación inicial del workflow de vídeo corto.'],
                ['fecha' => '2026-08-25', 'cambio' => 'Añadidos campos de portada y prueba.'],
            ],
            'recursos_relacionados' => ['ficha-canonica-personaje-consistente', 'prompt-para-resumen-operativo'],
            'copy_text' => '',
            'external' => false,
            'cover_type' => 'workflow',
            'cover_image' => $theme_uri . '/assets/laboratorio-ia/covers/workflow.svg',
            'cover_alt' => 'Portada verde para un workflow EMPC',
            'cover_focal_position' => 'center',
            'sort_weight' => 80,
            'summary_html' => 'Workflow para pasar de una identidad estable a un vídeo breve con continuidad visual.',
        ],
        [
            'id' => 'lab-workflow-investigacion-publicacion',
            'slug' => 'workflow-investigacion-publicacion',
            'titulo' => 'Workflow de investigación a publicación',
            'descripcion_corta' => 'Workflow para llevar una investigación breve desde el hallazgo hasta la pieza final revisada.',
            'tipo_key' => 'workflow',
            'tipo_label' => 'Workflow EMPC',
            'categoria' => 'Documentación',
            'objetivo' => 'Unificar búsqueda, síntesis, verificación, redacción y revisión antes de publicar.',
            'plataformas' => ['EMPC', 'NotebookLM', 'ChatGPT', 'Gemini'],
            'nivel_key' => 'avanzado',
            'nivel' => 'Avanzado',
            'estado' => 'EN PRUEBAS',
            'publication_date' => '2026-08-25',
            'last_review_date' => '2026-08-25',
            'last_test_date' => null,
            'autor' => 'EMPC',
            'source_name' => 'Workflow EMPC',
            'source_url' => '',
            'licencia_o_condiciones' => 'Original EMPC',
            'material_necesario' => 'Fuentes, conclusiones, notas y una revisión humana final.',
            'instrucciones' => 'Mantener separadas evidencias, hipótesis, redacción y decisión de publicación.',
            'variables' => ['fuentes', 'hipótesis', 'revisión', 'publicación'],
            'prompt' => '',
            'workflow_steps' => [
                'Recolectar fuentes.',
                'Separar hechos de hipótesis.',
                'Escribir el resumen base.',
                'Validar citas y nombres propios.',
                'Hacer una revisión editorial.',
                'Publicar solo lo aprobado.',
            ],
            'version_corta' => 'De hallazgos a una publicación revisada sin mezclar fases.',
            'version_avanzada' => 'Incluye recopilación, síntesis, validación y publicación controlada.',
            'resultado_esperado' => 'Una pieza final clara, trazable y revisada.',
            'resultado_ejemplo' => 'Borrador con fuentes, revisión y versión final aprobada.',
            'limitaciones' => 'Sin fuentes confiables no hay buen resultado.',
            'errores_conocidos' => 'Si la revisión humana se salta, la publicación pierde calidad.',
            'advertencias' => 'No publicar nada sin confirmar la trazabilidad mínima.',
            'version' => '0.1.0',
            'historial_cambios' => [
                ['fecha' => '2026-08-25', 'cambio' => 'Alta del workflow de investigación a publicación.'],
            ],
            'recursos_relacionados' => ['prompt-para-resumen-operativo', 'prompt-para-resumen-de-evidencias'],
            'copy_text' => '',
            'external' => false,
            'cover_type' => 'workflow',
            'cover_image' => $theme_uri . '/assets/laboratorio-ia/covers/workflow.svg',
            'cover_alt' => 'Portada verde para un workflow de investigación y publicación',
            'cover_focal_position' => 'center',
            'sort_weight' => 90,
            'summary_html' => 'Workflow para llevar una investigación breve desde el hallazgo hasta la pieza final revisada.',
        ],
    ],
];

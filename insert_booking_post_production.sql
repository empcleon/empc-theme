-- SQL para insertar el post de Booking Island en producción
-- Ejecutar en phpMyAdmin o terminal MySQL de producción

-- IMPORTANTE: Cambiar el ID del post si ya existe un post con ID 28
-- Puedes usar MAX(ID)+1 para obtener el siguiente ID disponible

INSERT INTO wp_posts (
    post_author,
    post_date,
    post_date_gmt,
    post_content,
    post_title,
    post_excerpt,
    post_status,
    comment_status,
    ping_status,
    post_name,
    post_modified,
    post_modified_gmt,
    post_type
) VALUES (
    1,
    NOW(),
    NOW(),
    '<!-- wp:html -->
<h1>Webs para Restaurantes en León: Cómo llenar tus mesas sin descolgar el teléfono</h1>
<p>En una ciudad con la competencia gastronómica de <strong>León</strong>, desde las tapas del Barrio Húmedo hasta los manteles del Cid, el éxito de un restaurante ya no solo depende de la cocina. Depende de lo fácil que sea para un cliente reservar una mesa un viernes por la noche desde su móvil.</p>
<h2>El fin de las llamadas perdidas y los PDFs lentos</h2>
<p>Muchos negocios en León siguen confiando en el teléfono o en subir un PDF de la carta que tarda siglos en cargar. Con nuestra arquitectura <strong>Antigravity (WordPress + React)</strong>, eliminamos la fricción. Ofrecemos una experiencia instantánea donde el cliente ve la disponibilidad real y confirma su reserva en segundos.</p>
<h3>¿Qué hace único a nuestro sistema de reservas?</h3>
<ul>
<li><strong>Calendario Inteligente:</strong> Gestión visual de días, bloqueando fechas pasadas y optimizado para el ritmo de León.</li>
<li><strong>Slots de tiempo reales:</strong> El sistema sabe qué horas han pasado y solo ofrece huecos disponibles para hoy.</li>
<li><strong>Confirmación vía WhatsApp:</strong> Una vez reservado, el sistema genera un mensaje automático para que el cliente y el dueño estén conectados al instante.</li>
<li><strong>Velocidad de carga 98/100:</strong> Tu web será la más rápida de la provincia, algo que Google premia con mejores posiciones.</li>
</ul>
<div class="my-12 p-6 bg-slate-50 rounded-3xl border-2 border-slate-100 shadow-inner">
<h3 class="text-center text-xl font-bold text-slate-900 mb-6">Prueba aquí nuestra Isla de Reservas (Demo León)</h3>
[empc_booking phone="34600111222" business="Asador Casa Pepe" city="León"]
<p class="text-center text-xs text-slate-400 mt-6 italic">Esta es una simulación real de lo que tus clientes verán en tu web: rapidez, claridad y contacto directo por WhatsApp.</p>
</div>
<h2>Tecnología leonesa para negocios que no quieren límites</h2>
<p>Al integrar este <strong>Booking Island</strong> en tu web de <strong>León</strong>, no solo ahorras tiempo en gestión; estás mejorando tu imagen de marca. Un sistema que funciona bien en el móvil transmite la misma calidad que tus platos. Es el momento de dejar de ser "uno más" en Google Maps para ser el primero en reservas.</p>
<h2>¿Preparado para digitalizar tu restaurante?</h2>
<p>Si quieres ver cómo este sistema de reservas puede adaptarse a tu menú, tus horarios y tu local en León, usa nuestra calculadora de presupuestos o contacta directamente con nosotros.</p>
<!-- /wp:html -->',
    'Webs para Restaurantes en León: Reservas automáticas con WhatsApp',
    'Sistema de reservas online para restaurantes en León. Booking Island con WhatsApp integration.',
    'publish',
    'open',
    'open',
    'webs-restaurantes-leon-reservas',
    NOW(),
    NOW(),
    'post'
);

-- Obtener el ID del post recién insertado
SET @post_id = LAST_INSERT_ID();

-- Insertar el post meta necesario para que React se cargue
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES
(@post_id, '_empc_react_config', '{"post_type":"blog","post_id":"webs-restaurantes-leon-reservas","primary_cta":"empc-booking-island"}');

-- Verificar que se insertó correctamente
SELECT ID, post_title, post_name FROM wp_posts WHERE ID = @post_id;

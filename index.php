<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div id="root" class="empc-react-container">
        <!-- React App se monta aquí -->
        <noscript>
            <div style="text-align: center; padding: 50px;">
                <h1>EMPC - Desarrollo Web en León</h1>
                <p>Por favor, habilita JavaScript para ver este sitio.</p>
            </div>
        </noscript>
    </div>

    <?php wp_footer(); ?>
</body>

</html>
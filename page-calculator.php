<?php
/**
 * Template Name: Calculadora de Presupuesto
 * Template for budget calculator page
 */

get_header(); ?>

<main class="bg-gradient-to-b from-slate-900 to-slate-950 min-h-screen pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Island container for PricingCalculator React component -->
        <div id="island-pricing-calculator"></div>
    </div>

    <!-- WordPress content (if any additional text is needed) -->
    <?php if (have_posts()): ?>
        <div class="prose prose-invert prose-lg max-w-4xl mx-auto mt-16 px-6">
            <?php while (have_posts()):
                the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
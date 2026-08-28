<?php

$data = require get_template_directory() . '/inc/laboratorio-ia-data.php';
$items = $data['items'] ?? [];
$meta = $data['meta'] ?? [];
$catalog_url = home_url('/laboratorio-ia/');
$request_path = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/', '/');
$segments = array_values(array_filter(explode('/', $request_path)));
$current_slug = $segments[1] ?? '';
$current_item = null;

foreach ($items as $item) {
    if (($item['slug'] ?? '') === $current_slug) {
        $current_item = $item;
        break;
    }
}

$is_unknown_detail = $current_slug !== '' && $current_item === null;

$lab_asset_url = static function (string $relative): string {
    return trailingslashit(get_template_directory_uri()) . ltrim($relative, '/');
};

$lab_slug = static function (string $value): string {
    return sanitize_title(remove_accents($value));
};

$lab_normalize = static function (string $value) use ($lab_slug): string {
    return $lab_slug(wp_strip_all_tags($value));
};

$lab_date_label = static function (?string $value): string {
    if (empty($value)) {
        return 'Pendiente';
    }

    $timestamp = strtotime($value);
    if (!$timestamp) {
        return $value;
    }

    return date_i18n('d/m/Y', $timestamp);
};

$lab_build_url = static function (string $base, array $args = []) use ($catalog_url): string {
    return add_query_arg(array_filter($args, static fn($v) => $v !== '' && $v !== null), $base);
};

$lab_current_filters = [
    'q' => sanitize_text_field(wp_unslash($_GET['q'] ?? '')),
    'type' => sanitize_key(wp_unslash($_GET['type'] ?? '')),
    'platform' => sanitize_key(wp_unslash($_GET['platform'] ?? '')),
    'level' => sanitize_key(wp_unslash($_GET['level'] ?? '')),
    'state' => sanitize_key(wp_unslash($_GET['state'] ?? '')),
    'sort' => sanitize_key(wp_unslash($_GET['sort'] ?? 'recommended')),
];
$page = max(1, absint($_GET['page'] ?? 1));

$filterable = [];
foreach ($items as $item) {
    $item['type_slug'] = $lab_slug((string) ($item['tipo_key'] ?? $item['tipo_label'] ?? ''));
    $item['level_slug'] = $lab_slug((string) ($item['nivel_key'] ?? $item['nivel'] ?? ''));
    $item['state_slug'] = $lab_slug((string) ($item['estado'] ?? ''));
    $item['platform_slugs'] = array_map($lab_slug, $item['plataformas'] ?? []);
    $item['search_blob'] = $lab_normalize(implode(' ', [
        $item['titulo'] ?? '',
        $item['descripcion_corta'] ?? '',
        $item['objetivo'] ?? '',
        $item['categoria'] ?? '',
        $item['tipo_label'] ?? '',
        $item['nivel'] ?? '',
        $item['estado'] ?? '',
        implode(' ', $item['plataformas'] ?? []),
        $item['source_name'] ?? '',
    ]));
    $filterable[] = $item;
}

$active_filters = array_filter($lab_current_filters, static fn($v) => $v !== '');

$filtered_items = array_values(array_filter($filterable, static function (array $item) use ($lab_normalize, $lab_current_filters): bool {
    if ($lab_current_filters['q'] !== '') {
        $needle = $lab_normalize($lab_current_filters['q']);
        if (strpos($item['search_blob'], $needle) === false) {
            return false;
        }
    }

    if ($lab_current_filters['type'] !== '' && $item['type_slug'] !== $lab_current_filters['type']) {
        return false;
    }

    if ($lab_current_filters['level'] !== '' && $item['level_slug'] !== $lab_current_filters['level']) {
        return false;
    }

    if ($lab_current_filters['state'] !== '' && $item['state_slug'] !== $lab_current_filters['state']) {
        return false;
    }

    if ($lab_current_filters['platform'] !== '' && !in_array($lab_current_filters['platform'], $item['platform_slugs'], true)) {
        return false;
    }

    return true;
}));

usort($filtered_items, static function (array $a, array $b) use ($lab_date_label, $lab_slug, $lab_current_filters): int {
    $sort = $lab_current_filters['sort'] ?: 'recommended';

    switch ($sort) {
        case 'title':
            return strcasecmp($a['titulo'] ?? '', $b['titulo'] ?? '');
        case 'review':
            return strcmp((string) ($b['last_review_date'] ?? ''), (string) ($a['last_review_date'] ?? ''));
        case 'published':
            return strcmp((string) ($b['publication_date'] ?? ''), (string) ($a['publication_date'] ?? ''));
        case 'type':
            return strcmp((string) ($a['type_slug'] ?? ''), (string) ($b['type_slug'] ?? '')) ?: strcasecmp($a['titulo'] ?? '', $b['titulo'] ?? '');
        case 'recommended':
        default:
            $weightA = (int) ($a['sort_weight'] ?? 9999);
            $weightB = (int) ($b['sort_weight'] ?? 9999);
            if ($weightA !== $weightB) {
                return $weightA <=> $weightB;
            }
            return strcmp((string) ($a['publication_date'] ?? ''), (string) ($b['publication_date'] ?? ''));
    }
});

$page_size = (int) ($meta['page_size'] ?? 8);
$total_items = count($filtered_items);
$total_pages = max(1, (int) ceil(max(1, $total_items) / $page_size));
$page = min($page, $total_pages);
$offset = ($page - 1) * $page_size;
$visible_items = array_slice($filtered_items, $offset, $page_size);
$first_item_index = $total_items > 0 ? $offset + 1 : 0;
$last_item_index = min($offset + $page_size, $total_items);

$type_options = [];
$platform_options = [];
$level_options = [];
$state_options = [];
foreach ($filterable as $item) {
    $type_options[$item['type_slug']] = $item['tipo_label'] ?? $item['tipo_key'] ?? '';
    $level_options[$item['level_slug']] = $item['nivel'] ?? '';
    $state_options[$item['state_slug']] = $item['estado'] ?? '';
    foreach (($item['platform_slugs'] ?? []) as $index => $slug) {
        $platform_options[$slug] = $item['plataformas'][$index] ?? ucfirst($slug);
    }
}
ksort($type_options);
ksort($platform_options);
ksort($level_options);
ksort($state_options);

$sort_options = [
    'recommended' => 'Recomendado',
    'title' => 'Título A–Z',
    'review' => 'Última revisión',
    'published' => 'Publicación reciente',
    'type' => 'Tipo',
];

$landing_meta_description = $current_item
    ? ($current_item['descripcion_corta'] ?? 'Ficha del Laboratorio IA de EMPC.')
    : 'Explora prompts, recursos y workflows de inteligencia artificial probados por EMPC, con ejemplos, compatibilidad, fecha de revisión y límites conocidos.';

add_filter('pre_get_document_title', function ($title) use ($current_item) {
    if ($current_item) {
        return $current_item['titulo'] . ' | Laboratorio IA | EMPC';
    }

    return 'Laboratorio IA: prompts y workflows en español | EMPC';
}, 20);

add_action('wp_head', function () use ($landing_meta_description, $current_item, $catalog_url) {
    $canonical = $current_item
        ? home_url('/laboratorio-ia/' . $current_item['slug'] . '/')
        : $catalog_url;

    echo '<meta name="description" content="' . esc_attr($landing_meta_description) . '">';
    echo '<link rel="canonical" href="' . esc_url($canonical) . '">';
    echo '<meta name="robots" content="index,follow">';
}, 20);

if ($is_unknown_detail) {
    status_header(404);
    global $wp_query;
    $wp_query->is_404 = true;
}

get_header();

$accent_class = static function (string $type_key): string {
    return match ($type_key) {
        'prompt' => 'border-[#F2A0A4]/25 bg-[#F2A0A4]/12 text-[#F7F8FC]',
        'radar' => 'border-[#55C7E8]/25 bg-[#55C7E8]/12 text-[#F7F8FC]',
        'workflow' => 'border-[#55D6A5]/25 bg-[#55D6A5]/12 text-[#F7F8FC]',
        default => 'border-white/10 bg-white/5 text-slate-100',
    };
};

$card_frame_class = static function (string $type_key): string {
    return match ($type_key) {
        'prompt' => 'border-[#F2A0A4]/25 bg-[radial-gradient(circle_at_88%_0%,rgba(242,160,164,0.12),transparent_30%),linear-gradient(180deg,#192132_0%,#141A28_34%)] shadow-[inset_0_1px_0_rgba(255,255,255,0.05),0_22px_60px_-34px_rgba(0,0,0,0.95)] hover:border-[#F2A0A4]/50 hover:shadow-[inset_0_1px_0_rgba(255,255,255,0.06),0_26px_70px_-38px_rgba(0,0,0,1)]',
        'radar' => 'border-[#55C7E8]/25 bg-[radial-gradient(circle_at_88%_0%,rgba(85,199,232,0.12),transparent_30%),linear-gradient(180deg,#192132_0%,#141A28_34%)] shadow-[inset_0_1px_0_rgba(255,255,255,0.05),0_22px_60px_-34px_rgba(0,0,0,0.95)] hover:border-[#55C7E8]/50 hover:shadow-[inset_0_1px_0_rgba(255,255,255,0.06),0_26px_70px_-38px_rgba(0,0,0,1)]',
        'workflow' => 'border-[#55D6A5]/25 bg-[radial-gradient(circle_at_88%_0%,rgba(85,214,165,0.12),transparent_30%),linear-gradient(180deg,#192132_0%,#141A28_34%)] shadow-[inset_0_1px_0_rgba(255,255,255,0.05),0_22px_60px_-34px_rgba(0,0,0,0.95)] hover:border-[#55D6A5]/50 hover:shadow-[inset_0_1px_0_rgba(255,255,255,0.06),0_26px_70px_-38px_rgba(0,0,0,1)]',
        default => 'border-white/12 bg-[radial-gradient(circle_at_88%_0%,rgba(170,180,200,0.08),transparent_30%),linear-gradient(180deg,#192132_0%,#141A28_34%)] shadow-[inset_0_1px_0_rgba(255,255,255,0.05),0_22px_60px_-34px_rgba(0,0,0,0.95)] hover:border-white/20 hover:shadow-[inset_0_1px_0_rgba(255,255,255,0.06),0_26px_70px_-38px_rgba(0,0,0,1)]',
    };
};

$cover_frame_class = static function (string $type_key): string {
    return match ($type_key) {
        'prompt' => 'overflow-hidden rounded-[1.25rem] border border-[#F2A0A4]/18 bg-[radial-gradient(circle_at_88%_0%,rgba(242,160,164,0.10),transparent_30%),linear-gradient(180deg,#111827_0%,#0D1320_100%)] p-[1px] shadow-[0_18px_40px_-28px_rgba(0,0,0,0.92)]',
        'radar' => 'overflow-hidden rounded-[1.25rem] border border-[#55C7E8]/18 bg-[radial-gradient(circle_at_88%_0%,rgba(85,199,232,0.10),transparent_30%),linear-gradient(180deg,#111827_0%,#0D1320_100%)] p-[1px] shadow-[0_18px_40px_-28px_rgba(0,0,0,0.92)]',
        'workflow' => 'overflow-hidden rounded-[1.25rem] border border-[#55D6A5]/18 bg-[radial-gradient(circle_at_88%_0%,rgba(85,214,165,0.10),transparent_30%),linear-gradient(180deg,#111827_0%,#0D1320_100%)] p-[1px] shadow-[0_18px_40px_-28px_rgba(0,0,0,0.92)]',
        default => 'overflow-hidden rounded-[1.25rem] border border-white/15 bg-[radial-gradient(circle_at_88%_0%,rgba(170,180,200,0.08),transparent_30%),linear-gradient(180deg,#111827_0%,#0D1320_100%)] p-[1px] shadow-[0_18px_40px_-28px_rgba(0,0,0,0.92)]',
    };
};

$primary_cta_class = static function (string $type_key): string {
    return match ($type_key) {
        'prompt' => 'bg-[#F2A0A4] text-[#121826] hover:bg-[#f4adb0] focus-visible:ring-[#F2A0A4]/35',
        'radar' => 'bg-[#55C7E8] text-[#0B101A] hover:bg-[#74d1ec] focus-visible:ring-[#55C7E8]/35',
        'workflow' => 'bg-[#55D6A5] text-[#0B101A] hover:bg-[#6bdeb0] focus-visible:ring-[#55D6A5]/35',
        default => 'bg-[#F2A0A4] text-[#121826] hover:bg-[#f4adb0] focus-visible:ring-[#F2A0A4]/35',
    };
};

$secondary_cta_class = static function (): string {
    return 'border border-[#2C364B] bg-[#1D2536] text-[#F7F8FC] hover:border-white/20 hover:bg-[#242E42] focus-visible:ring-white/30';
};

$render_cover = static function (array $item, string $extra_class = '') use ($lab_asset_url, $cover_frame_class): void {
    $cover = $item['cover_image'] ?? '';
    if ($cover === '') {
        $cover = 'assets/laboratorio-ia/covers/' . ($item['cover_type'] ?? 'prompt') . '.svg';
    }
    $cover_url = str_starts_with($cover, 'http') ? $cover : $lab_asset_url($cover);
    $alt = $item['cover_alt'] ?? ($item['titulo'] ?? 'Portada del laboratorio IA');
    $position = $item['cover_focal_position'] ?? 'center';
    $type_key = $item['cover_type'] ?? $item['tipo_key'] ?? 'prompt';
    ?>
    <div class="<?php echo esc_attr($cover_frame_class($type_key)); ?>">
        <div class="overflow-hidden rounded-[1.15rem] bg-[#0A0F1C]">
            <img
                src="<?php echo esc_url($cover_url); ?>"
                alt="<?php echo esc_attr($alt); ?>"
                class="h-full w-full aspect-[16/9] object-cover <?php echo esc_attr($extra_class); ?>"
                style="object-position: <?php echo esc_attr($position); ?>;"
                loading="lazy"
            >
        </div>
    </div>
    <?php
};

$render_meta_line = static function (string $label, string $value): void {
    ?>
    <div class="bg-[#1D2536] p-4">
        <p class="text-[11px] uppercase tracking-[0.22em] text-slate-400"><?php echo esc_html($label); ?></p>
        <p class="mt-2 text-sm text-[#F7F8FC]"><?php echo esc_html($value); ?></p>
    </div>
    <?php
};

$build_item_url = static function (array $item, array $filters = []) use ($catalog_url): string {
    $base = trailingslashit($catalog_url . $item['slug']);
    return add_query_arg(array_filter($filters, static fn($v) => $v !== '' && $v !== null), $base);
};

$build_catalog_url = static function (array $filters = [], int $page = 1) use ($catalog_url): string {
    $args = array_filter($filters, static fn($v) => $v !== '' && $v !== null);
    if ($page > 1) {
        $args['page'] = $page;
    }
    return add_query_arg($args, $catalog_url);
};

$catalog_link = $build_catalog_url([], 1);
$clear_link = $catalog_link;
$current_context_filters = array_filter($lab_current_filters, static fn($v) => $v !== '' && $v !== null);
$js_config = [
    'pageSize' => $page_size,
    'totalItems' => $total_items,
    'totalPages' => $total_pages,
    'currentPage' => $page,
    'filters' => $lab_current_filters,
];
?>

<?php if ($is_unknown_detail): ?>
    <main class="min-h-screen bg-[#0A0F1C] text-slate-100">
        <section class="mx-auto max-w-4xl px-4 py-20 sm:px-6 lg:px-8">
            <div class="rounded-[2rem] border border-white/10 bg-white/5 p-8 text-center">
                <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#F4C7C7]">404 · Ficha no encontrada</p>
                <h1 class="mt-4 text-3xl font-semibold text-white">La ruta solicitada no corresponde a ninguna ficha del laboratorio.</h1>
                <p class="mt-4 text-sm leading-7 text-slate-400">Revisa la URL o vuelve al catálogo para seguir navegando el laboratorio IA.</p>
                <div class="mt-6 flex flex-col justify-center gap-3 sm:flex-row">
                    <a href="<?php echo esc_url($catalog_url); ?>" class="inline-flex items-center justify-center rounded-xl bg-[#E29595] px-5 py-3 text-sm font-semibold text-[#121826] transition hover:bg-[#f0aaaa] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#E29595]/40">Volver al catálogo</a>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center justify-center rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:border-white/20 hover:bg-white/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/30">Ir a la portada</a>
                </div>
            </div>
        </section>
    </main>
    <?php get_footer(); return; ?>
<?php endif; ?>

<main class="min-h-screen bg-[#0A0F1C] text-slate-100">
    <section class="relative overflow-hidden border-b border-white/5">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,rgba(226,149,149,0.18),transparent_32%),radial-gradient(circle_at_bottom_left,rgba(96,200,255,0.13),transparent_35%)] pointer-events-none"></div>
        <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
            <div class="grid grid-cols-1 gap-10 lg:grid-cols-[minmax(0,1.05fr)_minmax(0,0.95fr)] lg:items-center">
                <div>
                    <?php if ($current_item): ?>
                        <a href="<?php echo esc_url($build_catalog_url($current_context_filters, 1)); ?>"
                           class="inline-flex min-h-11 items-center justify-start rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm font-semibold text-white transition hover:border-white/20 hover:bg-white/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/30 w-full sm:w-auto">
                            ← Volver al catálogo
                        </a>
                        <div class="mt-4 flex flex-wrap gap-2">
                            <span class="inline-flex items-center rounded-full border px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] <?php echo esc_attr($accent_class($current_item['tipo_key'] ?? '')); ?>">
                                <?php echo esc_html($current_item['tipo_label'] ?? ''); ?>
                            </span>
                            <span class="inline-flex items-center rounded-full border border-[#2C364B] bg-[#20283A] px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-300">
                                <?php echo esc_html($current_item['nivel'] ?? ''); ?>
                            </span>
                            <span class="inline-flex items-center rounded-full border border-emerald-400/18 bg-emerald-400/8 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-100">
                                <?php echo esc_html($current_item['estado'] ?? ''); ?>
                            </span>
                        </div>
                        <h1 class="mt-5 max-w-4xl text-3xl font-semibold leading-tight text-white sm:text-4xl lg:text-5xl"><?php echo esc_html($current_item['titulo'] ?? ''); ?></h1>
                        <p class="mt-4 max-w-4xl text-base leading-8 text-[#AAB4C8]"><?php echo esc_html($current_item['descripcion_corta'] ?? ''); ?></p>
                        <div class="mt-5 flex flex-wrap gap-1.5">
                            <?php foreach (($current_item['plataformas'] ?? []) as $platform): ?>
                                <span class="inline-flex items-center rounded-full border border-white/10 bg-transparent px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.18em] text-slate-300">
                                    <?php echo esc_html($platform); ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="inline-flex items-center gap-2 rounded-full border border-[#E29595]/20 bg-[#E29595]/10 px-4 py-2 text-[11px] font-semibold uppercase tracking-[0.24em] text-[#F4C7C7]">
                            Laboratorio IA · EMPC
                        </div>
                        <h1 class="mt-5 max-w-3xl text-4xl font-semibold leading-tight text-white sm:text-5xl lg:text-6xl">
                            Laboratorio IA de EMPC
                        </h1>
                        <p class="mt-6 max-w-3xl text-lg leading-8 text-slate-300">
                            Prompts, herramientas y workflows de inteligencia artificial en español, explicados paso a paso, probados en plataformas reales y actualizados cuando los modelos cambian.
                        </p>
                        <div class="mt-5 max-w-3xl text-sm leading-7 text-slate-400">
                            <?php echo wp_kses_post($meta['hero_note_html'] ?? ''); ?>
                        </div>
                        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:flex-wrap">
                            <a href="#fichas"
                               class="inline-flex min-h-11 items-center justify-center rounded-xl bg-[#E29595] px-6 py-3.5 text-sm font-semibold text-[#121826] transition hover:scale-[1.01] hover:bg-[#f0aaaa] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#E29595]/40">
                                Explorar el catálogo
                            </a>
                            <a href="#como-probamos"
                               class="inline-flex min-h-11 items-center justify-center rounded-xl border border-white/10 bg-white/5 px-6 py-3.5 text-sm font-semibold text-white transition hover:border-white/20 hover:bg-white/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/30">
                                Ver cómo probamos los recursos
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if (!$current_item): ?>
                <div class="lg:justify-self-end w-full max-w-2xl">
                    <div class="rounded-[2rem] border border-white/10 bg-white/5 p-5 shadow-[0_24px_80px_-40px_rgba(0,0,0,0.85)] backdrop-blur-md lg:p-6">
                        <?php if ($current_item): ?>
                            <?php $render_cover($current_item); ?>
                        <?php else: ?>
                            <div class="rounded-[1.4rem] border border-dashed border-[#E29595]/30 bg-[#0f1624] p-5">
                                <?php $render_cover(['cover_image' => $lab_asset_url('assets/laboratorio-ia/hero.svg'), 'cover_alt' => 'Ilustración propia del Laboratorio IA EMPC', 'cover_focal_position' => 'center', 'titulo' => 'Laboratorio IA'], ''); ?>
                            </div>
                            <div class="mt-5 grid gap-4 sm:grid-cols-3">
                                <div class="rounded-2xl border border-[#E29595]/18 bg-[#E29595]/10 p-5 text-sm">
                                    <p class="text-[11px] uppercase tracking-[0.22em] text-[#F4C7C7]">Prompts</p>
                                    <p class="mt-3 text-slate-100">Instrucciones curadas y reutilizables.</p>
                                </div>
                                <div class="rounded-2xl border border-cyan-400/18 bg-cyan-400/10 p-5 text-sm">
                                    <p class="text-[11px] uppercase tracking-[0.22em] text-cyan-100">Radar</p>
                                    <p class="mt-3 text-slate-100">Recursos externos revisados.</p>
                                </div>
                                <div class="rounded-2xl border border-emerald-400/18 bg-emerald-400/10 p-5 text-sm">
                                    <p class="text-[11px] uppercase tracking-[0.22em] text-emerald-100">Workflows</p>
                                    <p class="mt-3 text-slate-100">Procesos que conectan pasos y validación.</p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php if ($current_item): ?>
        <section class="mx-auto max-w-7xl px-4 pb-12 sm:px-6 lg:px-8">
            <div class="grid gap-6 lg:grid-cols-[minmax(0,0.72fr)_minmax(0,1.28fr)] lg:items-start">
                <aside class="space-y-6">
                    <div class="rounded-[2rem] border border-white/10 bg-white/5 p-5 shadow-[0_24px_80px_-40px_rgba(0,0,0,0.85)]">
                        <?php $render_cover($current_item); ?>
                    </div>

                    <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-[0_20px_60px_-44px_rgba(0,0,0,0.95)]">
                        <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#F4C7C7]">Ficha técnica</p>
                        <div class="mt-5 grid gap-px sm:grid-cols-2">
                            <?php $render_meta_line('Publicación', $lab_date_label($current_item['publication_date'] ?? null)); ?>
                            <?php $render_meta_line('Última revisión', $lab_date_label($current_item['last_review_date'] ?? null)); ?>
                            <?php $render_meta_line('Última prueba', !empty($current_item['last_test_date']) ? $lab_date_label($current_item['last_test_date']) : 'Pendiente'); ?>
                            <?php $render_meta_line('Fuente', $current_item['source_name'] ?? ''); ?>
                        </div>
                    </div>

                    <div class="rounded-[2rem] border border-white/10 bg-white/5 p-6 shadow-[0_20px_60px_-44px_rgba(0,0,0,0.95)]">
                        <div class="grid gap-4">
                            <div class="rounded-2xl border border-white/10 bg-[#1D2536] p-5">
                                <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#F4C7C7]">Para qué sirve</p>
                                <p class="mt-4 leading-7 text-slate-300"><?php echo esc_html($current_item['objetivo'] ?? ''); ?></p>
                            </div>
                            <div class="grid gap-4 sm:grid-cols-2">
                                <div class="rounded-2xl border border-white/10 bg-[#1D2536] p-5">
                                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#F4C7C7]">Qué necesita</p>
                                    <p class="mt-4 leading-7 text-slate-300"><?php echo esc_html($current_item['material_necesario'] ?? ''); ?></p>
                                </div>
                                <div class="rounded-2xl border border-white/10 bg-[#1D2536] p-5">
                                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#F4C7C7]">Resultado esperado</p>
                                    <p class="mt-4 leading-7 text-slate-300"><?php echo esc_html($current_item['resultado_esperado'] ?? ''); ?></p>
                                </div>
                            </div>
                            <?php if (!empty($current_item['variables'])): ?>
                                <div class="rounded-2xl border border-white/10 bg-[#1D2536] p-5">
                                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#F4C7C7]">Variables</p>
                                    <div class="mt-4 flex flex-wrap gap-2">
                                        <?php foreach ($current_item['variables'] as $variable): ?>
                                            <span class="inline-flex items-center rounded-full border border-white/10 bg-white/5 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-200">
                                                <?php echo esc_html($variable); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </aside>

                <div class="space-y-6">
                    <?php if (!empty($current_item['prompt'])): ?>
                        <section class="rounded-[2rem] border border-white/10 bg-[#0f1624] p-6 shadow-[0_24px_80px_-40px_rgba(0,0,0,0.85)] lg:p-8">
                            <div class="flex flex-col gap-3 border-b border-white/10 pb-4 sm:flex-row sm:items-center sm:justify-between">
                                <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#F4C7C7]">Prompt</p>
                                <button type="button"
                                        data-copy-button
                                        data-copy-target="copy-<?php echo esc_attr($current_item['slug']); ?>"
                                        class="inline-flex min-h-11 w-full items-center justify-center rounded-xl px-5 py-3 text-sm font-semibold transition hover:scale-[1.01] focus-visible:outline-none focus-visible:ring-2 motion-reduce:transform-none sm:w-auto <?php echo esc_attr($primary_cta_class($current_item['tipo_key'] ?? '')); ?>">
                                    Copiar prompt
                                </button>
                            </div>
                            <pre class="mt-5 overflow-x-auto whitespace-pre-wrap rounded-2xl border border-white/10 bg-black/30 p-5 text-sm leading-7 text-slate-200" id="copy-<?php echo esc_attr($current_item['slug']); ?>"><?php echo esc_html($current_item['copy_text'] ?: $current_item['prompt']); ?></pre>
                        </section>
                    <?php elseif (!empty($current_item['workflow_steps'])): ?>
                        <section class="rounded-[2rem] border border-white/10 bg-[#0f1624] p-6 shadow-[0_24px_80px_-40px_rgba(0,0,0,0.85)] lg:p-8">
                            <div class="flex flex-col gap-3 border-b border-white/10 pb-4 sm:flex-row sm:items-center sm:justify-between">
                                <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#F4C7C7]">Workflow</p>
                                <button type="button"
                                        data-copy-button
                                        data-copy-target="copy-<?php echo esc_attr($current_item['slug']); ?>"
                                        class="inline-flex min-h-11 w-full items-center justify-center rounded-xl px-5 py-3 text-sm font-semibold transition hover:scale-[1.01] focus-visible:outline-none focus-visible:ring-2 motion-reduce:transform-none sm:w-auto <?php echo esc_attr($primary_cta_class($current_item['tipo_key'] ?? '')); ?>">
                                    Copiar workflow
                                </button>
                            </div>
                            <ol class="mt-5 space-y-4 text-slate-200">
                                <?php foreach ($current_item['workflow_steps'] as $index => $step): ?>
                                    <li class="rounded-2xl border border-white/10 bg-white/5 px-5 py-4 leading-7">
                                        <span class="mr-2 font-semibold text-[#F4C7C7]"><?php echo esc_html($index + 1); ?>.</span>
                                        <?php echo esc_html($step); ?>
                                    </li>
                                <?php endforeach; ?>
                            </ol>
                            <textarea id="copy-<?php echo esc_attr($current_item['slug']); ?>" class="sr-only"><?php echo esc_textarea(implode("\n", array_map(static fn($i, $s) => ($i + 1) . '. ' . $s, array_keys($current_item['workflow_steps']), $current_item['workflow_steps']))); ?></textarea>
                        </section>
                    <?php endif; ?>

                    <?php if (!empty($current_item['source_url'])): ?>
                        <section class="rounded-[2rem] border border-cyan-400/20 bg-cyan-400/10 p-6 text-cyan-50 shadow-[0_24px_80px_-40px_rgba(0,0,0,0.85)] lg:p-8">
                            <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-cyan-100">Fuente externa</p>
                            <p class="mt-4 text-sm leading-7 text-cyan-50/90">
                                Esta ficha lleva a un recurso externo. Al pulsar <strong>Abrir recurso oficial ↗</strong> abandonas EMPC y accedes al dominio original.
                            </p>
                            <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:flex-wrap sm:items-center">
                                <a href="<?php echo esc_url($current_item['source_url']); ?>" target="_blank" rel="noopener noreferrer"
                                   class="inline-flex min-h-11 w-full items-center justify-center rounded-xl px-5 py-3 text-sm font-semibold transition hover:scale-[1.01] focus-visible:outline-none focus-visible:ring-2 motion-reduce:transform-none sm:w-auto <?php echo esc_attr($primary_cta_class($current_item['tipo_key'] ?? '')); ?>">
                                    Abrir recurso oficial ↗
                                </a>
                                <span class="text-xs uppercase tracking-[0.22em] text-cyan-100/80">
                                    <?php echo esc_html($current_item['source_name'] ?? ''); ?>
                                </span>
                            </div>
                        </section>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
            <a href="<?php echo esc_url($build_catalog_url($current_context_filters, 1)); ?>" class="inline-flex min-h-11 items-center rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:border-white/20 hover:bg-white/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/30">
                ← Volver al catálogo
            </a>
        </section>
    <?php else: ?>
        <section id="familias" class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid gap-4 md:grid-cols-3">
                <div class="rounded-[1.5rem] border border-white/10 bg-white/5 p-7">
                    <p class="text-[11px] uppercase tracking-[0.22em] text-[#F4C7C7]">1. Prompts EMPC</p>
                    <p class="mt-4 text-lg font-semibold text-white">Instrucciones originales, adaptables y preparadas para resolver tareas concretas.</p>
                </div>
                <div class="rounded-[1.5rem] border border-white/10 bg-white/5 p-7">
                    <p class="text-[11px] uppercase tracking-[0.22em] text-cyan-100">2. Radar de recursos externos</p>
                    <p class="mt-4 text-lg font-semibold text-white">Herramientas y repositorios revisados por EMPC, con lo que hacen realmente y sus límites.</p>
                </div>
                <div class="rounded-[1.5rem] border border-white/10 bg-white/5 p-7">
                    <p class="text-[11px] uppercase tracking-[0.22em] text-emerald-100">3. Workflows EMPC</p>
                    <p class="mt-4 text-lg font-semibold text-white">Procesos completos que conectan investigación, creación, generación, revisión y publicación.</p>
                </div>
            </div>
        </section>

        <section id="como-probamos" class="mx-auto max-w-7xl px-4 pb-10 sm:px-6 lg:px-8">
            <div class="rounded-[2rem] border border-white/10 bg-white/5 p-7 text-sm leading-7 text-slate-300">
                <p class="font-semibold text-white">Aviso de uso</p>
                <p class="mt-3">No introduzcas datos personales, documentos confidenciales ni imágenes de terceros sin autorización. Comprueba siempre el resultado antes de utilizarlo o publicarlo.</p>
            </div>
            </section>

        <section id="fichas" class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
            <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="text-[11px] font-semibold uppercase tracking-[0.22em] text-[#F4C7C7]">Explora el catálogo</p>
                    <h2 class="mt-2 text-3xl font-semibold text-white">Busca por tema, plataforma o tipo de recurso.</h2>
                </div>
                <p class="max-w-2xl text-sm leading-6 text-slate-400">Los filtros funcionan por URL, permiten volver atrás en el navegador y soportan búsqueda normalizada sin depender de mayúsculas o tildes.</p>
            </div>

            <form id="lab-filter-form" class="rounded-[1.5rem] border border-white/10 bg-[#0f1624] p-5 lg:p-6" method="get" action="<?php echo esc_url($catalog_link); ?>" data-state='<?php echo esc_attr(wp_json_encode($js_config)); ?>'>
                <div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-7">
                    <label class="md:col-span-2 lg:col-span-3 xl:col-span-2">
                        <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Buscar</span>
                        <input id="lab-search" name="q" value="<?php echo esc_attr($lab_current_filters['q']); ?>" type="search" placeholder="Buscar por título, idea o detalle" class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white placeholder:text-slate-500 focus:border-[#E29595] focus:outline-none focus:ring-2 focus:ring-[#E29595]/30" />
                    </label>
                    <label>
                        <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Tipo</span>
                        <select name="type" data-auto-submit class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-[#E29595] focus:outline-none focus:ring-2 focus:ring-[#E29595]/30">
                            <option value="">Todos</option>
                            <?php foreach ($type_options as $slug => $label): ?>
                                <option value="<?php echo esc_attr($slug); ?>" <?php selected($lab_current_filters['type'], $slug); ?>><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Plataforma</span>
                        <select name="platform" data-auto-submit class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-[#E29595] focus:outline-none focus:ring-2 focus:ring-[#E29595]/30">
                            <option value="">Todas</option>
                            <?php foreach ($platform_options as $slug => $label): ?>
                                <option value="<?php echo esc_attr($slug); ?>" <?php selected($lab_current_filters['platform'], $slug); ?>><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Nivel</span>
                        <select name="level" data-auto-submit class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-[#E29595] focus:outline-none focus:ring-2 focus:ring-[#E29595]/30">
                            <option value="">Todos</option>
                            <?php foreach ($level_options as $slug => $label): ?>
                                <option value="<?php echo esc_attr($slug); ?>" <?php selected($lab_current_filters['level'], $slug); ?>><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label>
                        <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Estado</span>
                        <select name="state" data-auto-submit class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-[#E29595] focus:outline-none focus:ring-2 focus:ring-[#E29595]/30">
                            <option value="">Todos</option>
                            <?php foreach ($state_options as $slug => $label): ?>
                                <option value="<?php echo esc_attr($slug); ?>" <?php selected($lab_current_filters['state'], $slug); ?>><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                    <label class="md:col-span-2 lg:col-span-2 xl:col-span-1">
                        <span class="mb-2 block text-xs font-semibold uppercase tracking-[0.18em] text-slate-400">Orden</span>
                        <select name="sort" data-auto-submit class="w-full rounded-xl border border-white/10 bg-white/5 px-4 py-3 text-sm text-white focus:border-[#E29595] focus:outline-none focus:ring-2 focus:ring-[#E29595]/30">
                            <?php foreach ($sort_options as $slug => $label): ?>
                                <option value="<?php echo esc_attr($slug); ?>" <?php selected($lab_current_filters['sort'], $slug); ?>><?php echo esc_html($label); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
                <div class="mt-6 flex flex-col gap-4 border-t border-white/10 pt-5 sm:flex-row sm:items-center sm:justify-between">
                    <button type="submit" class="inline-flex min-h-11 items-center justify-center rounded-xl bg-[#E29595] px-5 py-3 text-sm font-semibold text-[#121826] transition hover:scale-[1.01] hover:bg-[#f0aaaa] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#E29595]/40">
                        Aplicar filtros
                    </button>
                    <div class="flex flex-col items-start gap-3 sm:flex-row sm:flex-wrap sm:items-center">
                        <a href="<?php echo esc_url($clear_link); ?>" class="inline-flex min-h-11 items-center justify-center rounded-xl border border-white/10 bg-white/5 px-5 py-3 text-sm font-semibold text-white transition hover:border-white/20 hover:bg-white/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/30">
                            Limpiar filtros
                        </a>
                        <p class="text-sm text-slate-400" aria-live="polite">
                            Mostrando <?php echo esc_html($total_items); ?> resultados<?php echo $total_items > 0 ? ' · ' . esc_html($first_item_index) . '–' . esc_html($last_item_index) . ' de ' . esc_html($total_items) : ''; ?>
                        </p>
                    </div>
                </div>
                <noscript>
                    <p class="mt-4 text-sm leading-6 text-slate-400">Sin JavaScript, usa el botón Aplicar filtros para refrescar el catálogo con la URL actual.</p>
                </noscript>
            </form>

            <?php if (empty($visible_items)): ?>
                <div class="mt-6 rounded-[1.5rem] border border-white/10 bg-white/5 p-8 text-center">
                    <p class="text-xl font-semibold text-white">No hay resultados para esos filtros.</p>
                    <p class="mt-2 text-sm leading-7 text-slate-400">Prueba a limpiar filtros o cambiar la búsqueda.</p>
                    <a href="<?php echo esc_url($clear_link); ?>" class="mt-5 inline-flex min-h-11 items-center justify-center rounded-xl bg-[#E29595] px-5 py-3 text-sm font-semibold text-[#121826] transition hover:bg-[#f0aaaa] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#E29595]/40">
                        Limpiar filtros
                    </a>
                </div>
            <?php else: ?>
                <div class="mt-6 grid gap-6 lg:grid-cols-2 lg:gap-7" id="lab-card-grid">
                    <?php foreach ($visible_items as $item): ?>
                        <?php
                        $item_url = $build_item_url($item, $current_context_filters);
                        $type_badge_class = $accent_class($item['tipo_key'] ?? '');
                        $frame_class = $card_frame_class($item['tipo_key'] ?? '');
                        ?>
                        <article data-lab-card data-title="<?php echo esc_attr($lab_normalize(implode(' ', [$item['titulo'] ?? '', $item['descripcion_corta'] ?? '', $item['objetivo'] ?? '']))); ?>" class="group flex h-full flex-col rounded-[1.5rem] p-6 transition-[transform,border-color,box-shadow] duration-300 hover:-translate-y-0.5 motion-reduce:transform-none <?php echo esc_attr($frame_class); ?>">
                            <?php $render_cover($item); ?>
                            <div class="mt-6 flex flex-wrap gap-2">
                                <span class="inline-flex items-center rounded-full border px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] <?php echo esc_attr($type_badge_class); ?>">
                                    <?php echo esc_html($item['tipo_label'] ?? ''); ?>
                                </span>
                                <span class="inline-flex items-center rounded-full border border-[#2C364B] bg-[#20283A] px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-300">
                                    <?php echo esc_html($item['nivel'] ?? ''); ?>
                                </span>
                                <span class="inline-flex items-center rounded-full border border-emerald-400/18 bg-emerald-400/8 px-3 py-1 text-[11px] font-semibold uppercase tracking-[0.18em] text-emerald-100">
                                    <?php echo esc_html($item['estado'] ?? ''); ?>
                                </span>
                            </div>
                            <h3 class="mt-5 text-2xl font-semibold leading-tight text-white"><?php echo esc_html($item['titulo'] ?? ''); ?></h3>
                            <p class="mt-4 text-sm leading-6 text-[#AAB4C8]"><?php echo wp_kses_post($item['summary_html'] ?? ($item['descripcion_corta'] ?? '')); ?></p>
                            <div class="mt-5 flex flex-wrap gap-1.5">
                                <?php foreach (($item['plataformas'] ?? []) as $platform): ?>
                                    <span class="inline-flex items-center rounded-full border border-white/10 bg-transparent px-2.5 py-1 text-[10px] font-semibold uppercase tracking-[0.18em] text-slate-300">
                                        <?php echo esc_html($platform); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                            <div class="mt-6 overflow-hidden rounded-2xl border border-white/10 bg-white/10 shadow-[inset_0_1px_0_rgba(255,255,255,0.05)] sm:grid sm:grid-cols-2 sm:gap-px">
                                <?php $render_meta_line('Publicación', $lab_date_label($item['publication_date'] ?? null)); ?>
                                <?php $render_meta_line('Última revisión', $lab_date_label($item['last_review_date'] ?? null)); ?>
                                <?php $render_meta_line('Última prueba', !empty($item['last_test_date']) ? $lab_date_label($item['last_test_date']) : 'Pendiente'); ?>
                                <?php $render_meta_line('Fuente', $item['source_name'] ?? ''); ?>
                            </div>
                            <div class="mt-auto flex flex-wrap items-center gap-3 pt-6">
                                <?php if (!empty($item['external']) && !empty($item['source_url'])): ?>
                                    <a href="<?php echo esc_url($item['source_url']); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex min-h-11 w-full items-center justify-center rounded-xl px-4 py-2.5 text-sm font-semibold transition focus-visible:outline-none focus-visible:ring-2 motion-reduce:transform-none sm:w-auto <?php echo esc_attr($primary_cta_class($item['tipo_key'] ?? '')); ?>">
                                        Abrir recurso oficial ↗
                                    </a>
                                <?php endif; ?>
                                <a href="<?php echo esc_url($item_url); ?>" class="inline-flex min-h-11 w-full items-center justify-center rounded-xl px-4 py-2.5 text-sm font-semibold transition focus-visible:outline-none focus-visible:ring-2 motion-reduce:transform-none sm:w-auto <?php echo !empty($item['external']) ? $secondary_cta_class() : $primary_cta_class($item['tipo_key'] ?? ''); ?>">
                                    <?php echo !empty($item['external']) ? 'Ver ficha ↗' : 'Ver ficha'; ?>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <?php if ($total_pages > 1): ?>
                    <nav class="mt-10 flex flex-col gap-3 rounded-[1.5rem] border border-white/10 bg-[#0f1624] p-5 sm:flex-row sm:items-center sm:justify-between" aria-label="Paginación del laboratorio IA">
                        <div class="text-sm text-slate-400">
                            Página <?php echo esc_html($page); ?> de <?php echo esc_html($total_pages); ?>
                        </div>
                        <div class="flex flex-wrap items-center gap-2">
                            <?php if ($page > 1): ?>
                                <a href="<?php echo esc_url($build_catalog_url($active_filters, $page - 1)); ?>" class="inline-flex min-h-11 items-center rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-white transition hover:border-white/20 hover:bg-white/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/30">Anterior</a>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <a href="<?php echo esc_url($build_catalog_url($active_filters, $i)); ?>" <?php echo $i === $page ? 'aria-current="page"' : ''; ?> class="inline-flex min-h-11 min-w-11 items-center justify-center rounded-xl border px-4 text-sm font-semibold transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/30 <?php echo $i === $page ? 'border-[#E29595]/35 bg-[#E29595] text-[#121826]' : 'border-white/10 bg-white/5 text-white hover:border-white/20 hover:bg-white/10'; ?>">
                                    <?php echo esc_html((string) $i); ?>
                                </a>
                            <?php endfor; ?>
                            <?php if ($page < $total_pages): ?>
                                <a href="<?php echo esc_url($build_catalog_url($active_filters, $page + 1)); ?>" class="inline-flex min-h-11 items-center rounded-xl border border-white/10 bg-white/5 px-4 py-2.5 text-sm font-semibold text-white transition hover:border-white/20 hover:bg-white/10 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-white/30">Siguiente</a>
                            <?php endif; ?>
                        </div>
                    </nav>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    <?php endif; ?>
</main>

<script>
(function() {
    const form = document.getElementById('lab-filter-form');
    const searchInput = document.getElementById('lab-search');
    const autoFields = document.querySelectorAll('[data-auto-submit]');
    const copyButtons = document.querySelectorAll('[data-copy-button]');
    const liveRegion = document.createElement('div');
    liveRegion.setAttribute('aria-live', 'polite');
    liveRegion.className = 'sr-only';
    document.body.appendChild(liveRegion);

    const announce = (message) => {
        liveRegion.textContent = message;
    };

    if (form && searchInput) {
        let timer = null;
        const submit = () => {
            if (typeof form.requestSubmit === 'function') {
                form.requestSubmit();
            } else {
                form.submit();
            }
        };

        searchInput.addEventListener('input', () => {
            window.clearTimeout(timer);
            timer = window.setTimeout(submit, 250);
        });

        autoFields.forEach((field) => {
            field.addEventListener('change', submit);
        });
    }

    copyButtons.forEach((button) => {
        button.addEventListener('click', async () => {
            const targetId = button.getAttribute('data-copy-target');
            const target = document.getElementById(targetId);
            const text = target ? (target.value || target.textContent || '').trim() : '';

            if (!text) {
                announce('No hay contenido para copiar.');
                return;
            }

            const feedback = async () => {
                const original = button.textContent;
                button.textContent = 'Copiado';
                announce('Contenido copiado al portapapeles.');
                window.setTimeout(() => {
                    button.textContent = original;
                }, 1500);
            };

            try {
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    await navigator.clipboard.writeText(text);
                    await feedback();
                    return;
                }
            } catch (error) {
                // Fall back below.
            }

            const fallback = document.createElement('textarea');
            fallback.value = text;
            fallback.setAttribute('readonly', 'readonly');
            fallback.style.position = 'fixed';
            fallback.style.left = '-9999px';
            fallback.style.top = '0';
            document.body.appendChild(fallback);
            fallback.select();
            try {
                document.execCommand('copy');
                await feedback();
            } catch (error) {
                announce('No se pudo copiar el contenido.');
            }
            document.body.removeChild(fallback);
        });
    });
})();
</script>

<?php get_footer();

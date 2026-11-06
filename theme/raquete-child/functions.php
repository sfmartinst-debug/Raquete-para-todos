<?php
/**
 * Raquete Child — RASCUNHO v0.2. Escopo v1: site de apresentação,
 * sem formulários, sem rastreamento, sem chamadas externas.
 */

add_action('wp_head', function () {
    $u = get_stylesheet_directory_uri() . '/assets/favicons';
    echo '<link rel="icon" type="image/png" sizes="32x32" href="' . esc_url($u . '/favicon-32.png') . '">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url($u . '/apple-touch-icon.png') . '">' . "\n";
}, 2);

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('raquete-iris-tl', get_stylesheet_directory_uri() . '/assets/iris-linha-do-tempo.css', [], '0.4.4');
    wp_enqueue_style('raquete-child', get_stylesheet_uri(), ['raquete-iris-tl'], '0.4.12');
    wp_enqueue_style('raquete-iris-h1', get_stylesheet_directory_uri() . '/assets/iris-h1-mobile.css', ['raquete-child'], '0.4.4');
    wp_enqueue_style('raquete-iris-contraste', get_stylesheet_directory_uri() . '/assets/iris-contraste-faixas.css', ['raquete-child','raquete-iris-h1'], '0.4.4');
    wp_enqueue_style('raquete-iris-fotos', get_stylesheet_directory_uri() . '/assets/iris-hero-fotos.css', ['raquete-child','raquete-iris-contraste'], '0.4.13');
    wp_enqueue_script('raquete-iris-fotos', get_stylesheet_directory_uri() . '/assets/iris-hero-fotos.js', [], '0.4.13', true);
});

/* Links e arquivos do tema eram absolutos na raiz do domínio (/o-projeto/,
   /wp-content/themes/...). Num WordPress em subdiretório — e no export que
   o fix-static.py torna relativo — isso quebra o projeto no GitHub Pages.
   O filtro reescreve só caminhos internos da raiz para a URL real do site. */
add_filter('render_block', function ($content) {
    if (!is_string($content) || $content === '') {
        return $content;
    }
    $home = trailingslashit(home_url('/'));
    $theme = trailingslashit(get_stylesheet_directory_uri());
    $content = str_replace('/wp-content/themes/raquete-child/', $theme, $content);
    $content = preg_replace_callback(
        '#\b(href|src|poster)="/(?!/)([^"]*)"#',
        function ($m) use ($home) {
            return $m[1] . '="' . $home . $m[2] . '"';
        },
        $content
    );
    return $content;
}, 20);

// Sem emojis do CDN do WordPress.
add_action('init', function () {
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
    add_filter('emoji_svg_url', '__return_false');
    // Sem oEmbed (descoberta e consumo).
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
    remove_action('rest_api_init', 'wp_oembed_register_route');
    add_filter('embed_oembed_discover', '__return_false');
    remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);
    // Cabeçalhos desnecessários.
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'feed_links', 2);
    remove_action('wp_head', 'feed_links_extra', 3);
});
add_filter('wp_resource_hints', function ($urls, $type) {
    return $type === 'dns-prefetch' ? [] : $urls;
}, 10, 2);
add_action('wp_default_scripts', function ($s) {
    if (!is_admin() && isset($s->registered['wp-embed'])) { $s->remove('wp-embed'); }
});

// Title e meta description por página (post meta rq_title / rq_desc).
add_filter('pre_get_document_title', function ($t) {
    if (is_home()) return 'Blog | Raquete para Todos – Valinhos (SP)';
    if (is_singular()) { $v = get_post_meta(get_queried_object_id(), 'rq_title', true); if ($v) return $v; }
    return $t;
});
add_action('wp_head', function () {
    if (is_home()) { echo '<meta name="description" content="Artigos do Raquete para Todos sobre tênis, educação, inclusão e esporte em Valinhos (SP).">'."\n".'<meta name="robots" content="noindex, nofollow">'."\n"; return; }
    if (!is_singular()) return;
    $d = get_post_meta(get_queried_object_id(), 'rq_desc', true);
    if ($d) echo '<meta name="description" content="' . esc_attr($d) . "\">\n";
    echo '<meta name="robots" content="noindex, nofollow">' . "\n"; // rascunho
}, 1);

// Faixa de rascunho.
add_action('wp_body_open', function () {
    echo '<div class="rq-draft" role="note">Versão de demonstração — conteúdo em validação</div>';
});

// Remove ?ver= dos assets (export estático limpo).
$rq_nover = function ($src) { return $src ? remove_query_arg('ver', $src) : $src; };
add_filter('style_loader_src', $rq_nover, 9999);
add_filter('script_loader_src', $rq_nover, 9999);
add_filter('script_module_loader_src', $rq_nover, 9999);

// v0.3 — categoria dos padrões de bloco do projeto (arquivos em /patterns).
add_action('init', function () {
    register_block_pattern_category('raquete', ['label' => 'Raquete para Todos']);
});

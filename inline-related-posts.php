<?php
/**
 * Plugin Name: Inline Related Posts
 * Description: Menambahkan related posts di dalam konten menggunakan shortcode dan auto-insert.
 * Version: 1.0
 * Author: NeonWebId
 * Author URI: https://neon.web.id
 * License: GPL2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/helper.php';
require_once __DIR__ . '/customizer.php';

// Shortcode
function irp_shortcode( $atts ) {
    $atts = shortcode_atts([
        'items' => 1,
        'use_thumb' => false,
    ], $atts );

    $items = intval( $atts['items'] );
    $use_thumb = filter_var( $atts['use_thumb'], FILTER_VALIDATE_BOOLEAN );

    global $post;
    $related = irp_get_related_posts( $post->ID, $items );

    if ( empty( $related ) ) return '';

    ob_start();
    echo '<div class="irp-wrapper">';
    foreach ( $related as $rel ) {
        echo '<div class="irp-item">';
        if ( $use_thumb && has_post_thumbnail( $rel->ID ) ) {
            echo get_the_post_thumbnail( $rel->ID, 'thumbnail' );
        }
        echo '<a href="' . get_permalink( $rel->ID ) . '">' . get_the_title( $rel->ID ) . '</a>';
        echo '</div>';
    }
    echo '</div>';

    return ob_get_clean();
}
add_shortcode( 'inline_related_posts', 'irp_shortcode' );

add_action( 'wp_enqueue_scripts', function() {
    wp_enqueue_style( 'irp-style', plugin_dir_url( __FILE__ ) . 'style.css' );
} );

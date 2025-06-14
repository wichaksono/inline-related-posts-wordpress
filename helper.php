<?php

defined('ABSPATH') || exit;

// Inisialisasi global di awal
global $shown_related_posts;
$shown_related_posts = [];

function get_related_posts( $post_id, $items = 1 ) {
    global $shown_related_posts;

    $post_categories = wp_get_post_categories( $post_id );
    if ( empty( $post_categories ) ) return [];

    $args = [
        'category__in'   => $post_categories,
        'post__not_in'   => array_merge( [ $post_id ], $shown_related_posts ),
        'posts_per_page' => $items,
        'post_status'    => 'publish',
        'orderby'        => 'rand',
    ];

    $query = new WP_Query( $args );
    $posts = [];

    if ( $query->have_posts() ) {
        foreach ( $query->posts as $related_post ) {
            // Simpan ID agar tidak ditampilkan dua kali
            $shown_related_posts[] = $related_post->ID;
            $posts[] = $related_post;
        }
    }

    return $posts;
}

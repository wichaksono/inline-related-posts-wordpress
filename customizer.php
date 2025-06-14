<?php

defined('ABSPATH') || exit;

add_action( 'customize_register', function( $wp_customize ) {
    $wp_customize->add_section( 'irp_settings', [
        'title'    => 'Inline Related Posts',
        'priority' => 130,
    ] );

    $wp_customize->add_setting( 'irp_auto_insert', [
        'default' => true,
        'type'    => 'theme_mod',
    ] );

    $wp_customize->add_control( 'irp_auto_insert', [
        'label'   => 'Aktifkan Auto Insert',
        'section' => 'irp_settings',
        'type'    => 'checkbox',
    ] );

    $wp_customize->add_setting( 'irp_paragraph', [
        'default' => 2,
        'type'    => 'theme_mod',
    ] );

    $wp_customize->add_control( 'irp_paragraph', [
        'label'   => 'Paragraf ke berapa',
        'section' => 'irp_settings',
        'type'    => 'number',
        'input_attrs' => [
            'min' => 1,
            'max' => 10
        ]
    ] );
} );

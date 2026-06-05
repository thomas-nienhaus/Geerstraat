<?php

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);

    register_nav_menus([
        'primary' => 'Hoofdmenu',
    ]);
});

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Newsreader:opsz,wght@6..72,400;6..72,500;6..72,600;6..72,700&family=Hanken+Grotesque:wght@400;500;600;700&display=swap',
        [],
        null
    );
    wp_enqueue_style('geerstraat', get_stylesheet_uri(), ['google-fonts'], '1.0');
    wp_enqueue_script('geerstraat', get_template_directory_uri() . '/assets/menu.js', [], '1.0', true);
});

// Custom Post Types
add_action('init', function () {

    register_post_type('evenement', [
        'labels' => [
            'name'          => 'Evenementen',
            'singular_name' => 'Evenement',
            'add_new_item'  => 'Nieuw evenement',
            'edit_item'     => 'Evenement bewerken',
            'view_item'     => 'Evenement bekijken',
            'search_items'  => 'Evenementen zoeken',
        ],
        'public'            => true,
        'show_in_rest'      => true,
        'supports'          => ['title'],
        'menu_icon'         => 'dashicons-calendar-alt',
        'has_archive'       => false,
    ]);

    register_post_type('club', [
        'labels' => [
            'name'          => 'Clubs',
            'singular_name' => 'Club',
            'add_new_item'  => 'Nieuwe club',
            'edit_item'     => 'Club bewerken',
        ],
        'public'            => true,
        'show_in_rest'      => true,
        'supports'          => ['title'],
        'menu_icon'         => 'dashicons-groups',
        'has_archive'       => false,
    ]);

    register_post_type('fotoalbum', [
        'labels' => [
            'name'          => 'Fotoalbums',
            'singular_name' => 'Fotoalbum',
            'add_new_item'  => 'Nieuw fotoalbum',
            'edit_item'     => 'Fotoalbum bewerken',
        ],
        'public'            => true,
        'show_in_rest'      => true,
        'supports'          => ['title'],
        'menu_icon'         => 'dashicons-format-gallery',
        'has_archive'       => false,
    ]);
});

// ACF veldgroepen via code (alleen als ACF actief is)
add_action('acf/init', function () {
    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group([
        'key'      => 'group_evenement',
        'title'    => 'Evenement details',
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'evenement']]],
        'fields'   => [
            ['key' => 'field_ev_maand',     'label' => 'Maand',      'name' => 'maand',      'type' => 'text'],
            ['key' => 'field_ev_jaar',      'label' => 'Jaar',       'name' => 'jaar',       'type' => 'text'],
            ['key' => 'field_ev_datum',     'label' => 'Dag (getal)', 'name' => 'datum',     'type' => 'text'],
            ['key' => 'field_ev_activiteit','label' => 'Activiteit', 'name' => 'activiteit', 'type' => 'text'],
            ['key' => 'field_ev_kleur',     'label' => 'Kleur',      'name' => 'kleur',      'type' => 'select',
             'choices' => ['sage' => 'Groen (sage)', 'blush' => 'Roze (blush)', 'gold' => 'Goud', 'terra' => 'Terra']],
            ['key' => 'field_ev_note',      'label' => 'Notitie (ipv evenementen)', 'name' => 'note', 'type' => 'textarea', 'rows' => 2],
        ],
    ]);

    acf_add_local_field_group([
        'key'      => 'group_club',
        'title'    => 'Club details',
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'club']]],
        'fields'   => [
            ['key' => 'field_club_dag',    'label' => 'Dag',         'name' => 'dag',    'type' => 'text'],
            ['key' => 'field_club_tijd',   'label' => 'Tijd',        'name' => 'tijd',   'type' => 'text'],
            ['key' => 'field_club_desc',   'label' => 'Beschrijving','name' => 'beschrijving', 'type' => 'textarea', 'rows' => 2],
            ['key' => 'field_club_icon',   'label' => 'Icoon',       'name' => 'icon',   'type' => 'select',
             'choices' => ['ball' => 'Bal (sport)', 'dumb' => 'Gewicht (fitness)', 'cup' => 'Beker (sociaal)', 'craft' => 'Schaar (creatief)', 'heart' => 'Hart (zorg)']],
            ['key' => 'field_club_volgorde','label' => 'Volgorde',   'name' => 'volgorde','type' => 'number', 'default_value' => 10],
        ],
    ]);

    acf_add_local_field_group([
        'key'      => 'group_fotoalbum',
        'title'    => 'Fotoalbum details',
        'location' => [[['param' => 'post_type', 'operator' => '==', 'value' => 'fotoalbum']]],
        'fields'   => [
            ['key' => 'field_foto_url', 'label' => 'Google Photos URL', 'name' => 'url', 'type' => 'url'],
        ],
    ]);
});

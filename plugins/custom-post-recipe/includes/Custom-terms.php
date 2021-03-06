<?php

class Custom_Terms
{
    function __construct()
    {
        register_activation_hook(__FILE__, array($this, 'activate'));
        add_action('init', array($this, 'activate'));
    }

    function activate()
    {
        $this->create_taxonomies();
        $this->register_new_terms();
    }

    function create_taxonomies()
    {

        $args = array(
            'hierarchical'                      => true,
            'public'                            => true,
            'labels'                            => array(
                'name'                          => _x('Variétés', 'taxonomy general name'),
                'singular_name'                 => _x('Variété', 'taxonomy singular name'),
                'search_items'                  => __('Search Variété'),
                'popular_items'                 => __('Popular Variété'),
                'all_items'                     => __('All Variété'),
                'edit_item'                     => __('Edit Variété'),
                'edit_item'                     => __('Edit Variété'),
                'update_item'                   => __('Update Variété'),
                'add_new_item'                  => __('Add New Variété'),
                'new_item_name'                 => __('New Variété Name'),
                'separate_items_with_commas'    => __('Seperate Variété with Commas'),
                'add_or_remove_items'           => __('Add or Remove Variété'),
                'choose_from_most_used'         => __('Choose from Most Used Variété')
            ),
            'query_var'                         => true,
            'rewrite'                           => array('slug' => 'test-tax'),
            'show_in_rest'                      => true,
            'show_in_admin_column'              => true
        );
        register_taxonomy('variety', array('recipe'), $args);
    }

    function register_new_terms()
    {
        $this->taxonomy = 'variety';
        $this->terms = array(
            array(
                'name'          => 'Apéritifs',
                'slug'          => 'aperitifs',
                'description'   => 'This is a test term one',
            ),
            array(
                'name'          => 'Entrées',
                'slug'          => 'entrees',
                'description'   => 'This is a test term one',
            ),
            array(
                'name'          => 'Plats',
                'slug'          => 'plats',
                'description'   => 'This is a test term one',
            ),
            array(
                'name'          => 'Desserts',
                'slug'          => 'desserts',
                'description'   => 'This is a test term one',
            ),
            array(
                'name'          => 'Boissons',
                'slug'          => 'boissons',
                'description'   => 'This is a test term one',
            ),
        );

        foreach ($this->terms as $term) {
            wp_insert_term(
                $term['name'],
                $this->taxonomy,
                array(
                    'description'   => $term['description'],
                    'slug' => $term['slug'],
                )
            );
            unset($term);
        }
    }
}

<?php
/**
 * Plugin Name: API Improvements
 * Plugin URI: https://github.com/txuselo/wordpress-api-improvements
 * Description: Custom REST API enhancements for Rank Math meta fields and user email.
 * Version: 1.0
 * Author: txuselo
 * Author URI: https://github.com/txuselo
 * License: Apache License 2.0
 */

// Register Rank Math meta fields for posts.
function register_rank_math_meta() {
    register_meta('post', 'rank_math_title', [
        'object_subtype'    => 'post',
        'type'              => 'string',
        'single'            => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => function() {
            return current_user_can('edit_posts');
        },
        'show_in_rest'      => [
            'schema' => [
                'type'        => 'string',
                'description' => 'RankMath SEO Title',
                'context'     => ['view', 'edit'],
            ],
        ],
    ]);

    register_meta('post', 'rank_math_description', [
        'object_subtype'    => 'post',
        'type'              => 'string',
        'single'            => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => function() {
            return current_user_can('edit_posts');
        },
        'show_in_rest'      => [
            'schema' => [
                'type'        => 'string',
                'description' => 'RankMath SEO Description',
                'context'     => ['view', 'edit'],
            ],
        ],
    ]);
	
    register_meta('post', 'rank_math_focus_keyword', [
        'object_subtype'    => 'post',
        'type'              => 'string',
        'single'            => true,
        'sanitize_callback' => 'sanitize_text_field',
        'auth_callback'     => function() {
            return current_user_can('edit_posts');
        },
        'show_in_rest'      => [
            'schema' => [
                'type'        => 'string',
                'description' => 'RankMath Keyword',
                'context'     => ['view', 'edit'],
            ],
        ],
    ]);
}
add_action('rest_api_init', 'register_rank_math_meta');

// Register custom REST field for user email.
function register_user_email_rest_field() {
    register_rest_field( 'user', 'user_email',
      array(
        'get_callback'    => function ( $user ) {
            return get_userdata($user['id'])->user_email;
        },
        'update_callback' => null,
        'schema'          => null,
      )
    );
}
add_action('rest_api_init', 'register_user_email_rest_field');

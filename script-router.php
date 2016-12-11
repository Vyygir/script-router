<?php
/**
 * Plugin Name: Script Router
 * Plugin URI: https://github.com/Vyygir/script-router
 * Version: 0.1.3
 * Description: A very basic plugin to generate scripts to be loaded in, based on the current user's location on the website
 * Requires at least: 4.0
 * Author: Vyygir
 * Author URI: http://vyygir.me
 * License: GPL2
 *
 * @package WordPress
**/
if (!defined('ABSPATH')) {
	exit; // get the fuck outta here
}

define('THEME_PATH', get_template_directory());
define('THEME_URL', get_template_directory_uri());
define('THEME_JS_PATH', THEME_PATH . '/js');
define('THEME_JS_URL', THEME_URL . '/js');

function get_current_route() {
	$routes = array('default');

	if (is_home()) {
		$routes[] = 'home';
	} elseif (is_front_page()) {
		$routes[] = 'front-page';
	} elseif (is_page()) {
		global $post;
		$template = str_replace(array('/', '.php'), array('-', ''), basename(get_page_template($post->ID)));
		$routes[] = 'page';
		$routes[] = sprintf('page/%s', $post->ID);
		$routes[] = sprintf('page/%s', $post->post_name);
		$routes[] = sprintf('page/%s', (($template == 'page') ? 'default' : $template));
	} elseif (is_singular()) {
		global $post;
		$routes[] = 'single';
		$routes[] = sprintf('single/%s', get_post_type($post->ID));
		$routes[] = sprintf('single/%s', $post->ID);
	} elseif (is_category()) {
		$_category = get_queried_object();
		$routes[] = 'category';
		$routes[] = sprintf('category/%s', $_category->slug);
		$routes[] = sprintf('category/%s', $_category->term_id);
	} elseif (is_tag()) {
		$_tag = get_queried_object();
		$routes[] = 'tag';
		$routes[] = sprintf('tag/%s', $_tag->slug);
		$routes[] = sprintf('tag/%s', $_tag->term_id);
	} elseif (is_tax()) {
		$_taxonomy = get_queried_object();
		$routes[] = 'taxonomy';
		$routes[] = sprintf('taxonomy/%s', $_taxonomy->taxonomy);
		$routes[] = sprintf('taxonomy/%s', $_taxonomy->slug);
		$routes[] = sprintf('taxonomy/%s', $_taxonomy->term_id);
	} elseif (is_author()) {
		$routes[] = 'author';
	} elseif (is_archive()) {
		$routes[] = 'archive';
		$routes[] = sprintf('archive/%s', get_post_type());
	} elseif (is_search()) {
		$routes[] = 'search';
	} elseif (is_attachment()) {
		$routes[] = 'attachment';
	} elseif (is_404()) {
		$routes[] = '404';
	}

	return $routes;
}

function enqueue_routing_scripts() {
	$file_names = get_current_route();

	if (!empty($file_names)) {
		foreach ($file_names as $file_name) {
			$path = sprintf('%s/routes/%s.js', THEME_JS_PATH, $file_name);
			$url = sprintf('%s/routes/%s.js', THEME_JS_URL, $file_name);

			if (file_exists($path)) {
				wp_enqueue_script(sprintf('theme-route_%s', str_replace('/', '-', $file_name)), $url, null, true);
			}
		}
	}
}

add_action('wp_enqueue_scripts', 'enqueue_routing_scripts');

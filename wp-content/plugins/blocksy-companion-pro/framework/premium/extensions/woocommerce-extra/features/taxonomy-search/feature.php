<?php

namespace Blocksy\Extensions\WoocommerceExtra;

class TaxonomySearch {
	public function __construct() {
		add_filter('posts_where', function ($where, \WP_Query $query) {
			if (
				! $query->is_search()
				||
				is_admin()
				||
				! isset($_GET['ct_search_taxonomies'])
				||
				empty($query->get('s'))
			) {
				return $where;
			}

			global $wpdb;

			$tax_query = [
				'relation' => 'OR'
			];

			$post_types = $query->get('post_type');

			if (! is_array($post_types)) {
				$post_types = [$post_types];
			}

			foreach ($post_types as $key => $post_type) {
				$taxonomies = get_object_taxonomies($post_type, 'objects');

				foreach($taxonomies as $taxonomy) {
					$tax_query[] = [
						'taxonomy' => $taxonomy->name,
						'field' => 'slug',
						'terms' => strtolower($query->get('s')),
						'operator' => 'IN'
					];
				}
			}

			if (count($tax_query) === 1) {
				return $where;
			}

			$posts = new \WP_Query([
				'post_type' => $post_types,
				'posts_per_page' => -1,
				'status' => 'publish',
				'fields' => 'ids',
				'suppress_filters' => false,
				'tax_query' => $tax_query
			]);

			if (empty($posts->posts)) {
				return $where;
			}

			return str_replace(
				'))',
				") OR ({$wpdb->posts}.ID IN (" . implode(',', $posts->posts) . ")))",
				$where
			);
		}, 9, 2);
	}
}

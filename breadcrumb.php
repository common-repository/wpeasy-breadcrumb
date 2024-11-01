<?php
/*
Plugin Name: WpEasy Breadcrumb
Plugin URI: http://logicsart.com
Description: A very simple and easy WordPress Plugin of Breadcrumbs for Pages,posts,blog
Version: 1.0
Author: Dileep Awasthi
Author URI: http://logicsart.com
Min WP Version: 3.2.1
*/


function wpeasy_breadcrumb($showHome='') {
    global $post;
    echo '<div class="wpeasybread">';
	if (!is_front_page() && !is_404()) {
		echo '<a href="'.get_option('home').'">'.bloginfo('name').'</a> » ';
		if ( is_category() || is_single() ) {
			the_category(', ');
			if ( is_single() ) {
				echo " » ";
				the_title();
			}
		} elseif ( is_page() && $post->post_parent ) {
			$home = get_page_by_title('home');
			for ($start = count($post->ancestors)-1; $start >= 0; $start--) {
				if (($home->ID) != ($post->ancestors[$start])) {
					echo '<a href="'.get_permalink($post->ancestors[$start]).'">';
					echo get_the_title($post->ancestors[$start]);
					echo "</a> » ";
				}
			}
			echo the_title();
		} elseif(is_home()) {
			echo "Blog";
		} elseif (is_page()) {
			echo the_title();
		} 
	} else {
		if($showHome == 1)
		{
			bloginfo('name');
		}
	}
	echo '</div>';
}


?>
<?php

/**
 * Wrap functions to use in the theme.
 */


/**
 * Get poll attached to current post.
 * @param  integer [$post_id = 0] ID or object of post, attached poll of which you want to get.
 * @return string  Poll HTML code.
 */
function get_post_poll_id( $post_id = 0 ){
	$post_id = ( is_numeric($post_id) && $post_id ) ? intval($post_id) : get_post( $post_id )->ID; // current post

	return $poll_id = (int) get_post_meta( $post_id, Democracy_Poll::$pollid_meta_key, 1 );
}

/**
 * Display specified democracy poll.
 *
 * @see get_democracy_poll()
 */
function democracy_poll( $id = 0, $before_title = '', $after_title = '', $from_post = 0 ){
	echo get_democracy_poll( $id, $before_title, $after_title, $from_post );
}

/**
 * Get specified democracy poll.
 * @param  integer  [$poll_id = 0]       Poll ID
 * @param  string   [$before_title = ''] HTML/text before poll title.
 * @param  string   [$after_title = '']  HTML/text after poll title.
 * @param  integer  [$from_post = 0]     Post ID from which the poll was called - to which the poll must be attached.
 * @return string   Poll HTML code.
 */
function get_democracy_poll( $poll_id = 0, $before_title = '', $after_title = '', $from_post = 0 ){
	$poll = new DemPoll( $poll_id );

	if( ! $poll ) return 'Poll not found';

	// обновим ID записи с которой вызван опрос, если такого ID нет в данных
	$from_post = is_object($from_post) ? $from_post->ID : intval($from_post);
	if( $from_post && ( ! $poll->in_posts || ! preg_match('~(?:^|,)'. $from_post .'(?:,|$)~', $poll->in_posts) ) ){
		global $wpdb;

		$new_in_posts = $poll->in_posts ? "$poll->in_posts,$from_post" : $from_post;
		$new_in_posts = trim( $new_in_posts, ','); // на всякий...
		$wpdb->update( $wpdb->democracy_q, array('in_posts'=>$new_in_posts), array('id'=>$poll_id) );
	}

	$show_screen = dem__query_poll_screen_choose( $poll );

	return $poll->get_screen( $show_screen, $before_title, $after_title );
}

/**
 * Gets poll results screen.
 * @param  integer  [$poll_id = 0]       Poll ID
 * @param  string   [$before_title = ''] HTML/text before poll title.
 * @param  string   [$after_title = '']  HTML/text after poll title.
 * @return string   Poll HTML code.
 */
function get_democracy_poll_results( $poll_id = 0, $before_title = '', $after_title = '' ){
	if( ! $poll = new DemPoll( $poll_id ) ) return '';

	if( $poll->open && ! $poll->show_results ) return __('Poll results hidden for now...','democracy-poll');

	return $poll->get_screen( 'voted', $before_title, $after_title );
}

/**
 * Для вывода архивов.
 *
 * @see get_democracy_archives()
 *
 * @param bool $hide_active Не показывать активные опросы?
 * @return HTML
 */
function democracy_archives( $hide_active = false, $before_title = '', $after_title = '' ){
	echo get_democracy_archives( $hide_active, $before_title, $after_title );
}

function get_democracy_archives( $hide_active = false, $before_title = '', $after_title = '' ){
	global $wpdb;

	$WHERE = $hide_active ? 'WHERE active = 0' : '';
	$ids   = $wpdb->get_col("SELECT id FROM $wpdb->democracy_q $WHERE ORDER BY active DESC, open DESC, id DESC");

	$polls_elm = array();

	foreach( $ids as $poll_id ){
		$elm_html = '';

		$DemPoll = new DemPoll( $poll_id );
		$poll    = $DemPoll->poll;

		$show_screen = isset($_REQUEST['dem_act']) ? dem__query_poll_screen_choose( $DemPoll ) : 'voted';

		$elm_html .= $DemPoll->get_screen( $show_screen, $before_title, $after_title );

		// in posts
		if( $posts = democr()->get_in_posts_posts($poll) ){
			$links = array();
			foreach( $posts as $post ) $links[] = '<a href="'. get_permalink($post) .'">'. esc_html($post->post_title) .'</a>';

			$elm_html .= '
			<div class="dem-moreinfo">
				<b>'. __('From posts:','democracy-poll') .'</b>
				<ul>
					<li>'. implode("</li>\n<li>", $links) .'</li>
				</ul>
			</div>';
		}

		$polls_elm[] = '<div class="dem-elem-wrap">'. $elm_html .'</div>';
	}

	return '<div class="dem-archives">' . implode("\n", $polls_elm) . '</div>';
}

## Какой экран показать, на основе переданных запросов: 'voted' или 'vote'
function dem__query_poll_screen_choose( $poll ){
	if( $poll->open && ! $poll->show_results )
		return 'vote'; // view results is closed in options

	$screen = ( isset($_REQUEST['dem_act']) && isset($_REQUEST['dem_pid']) && $_REQUEST['dem_act'] == 'view' && $_REQUEST['dem_pid'] == $poll->id ) ? 'voted' : 'vote';

	return apply_filters('dem_poll_screen_choose', $screen, $poll );
}


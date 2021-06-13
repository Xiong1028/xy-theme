<?php
/* Handle Comment Post to Wordpress and prevents duplicate comment posting */

/* Sets up the Wordpress Enviromentsg */
require('../../../wp-load.php');

define('WP_USE_THEMES', false);

if ('POST' != $_SERVER['REQUEST_METHOD']) {
    $protocol = $_SERVER['SERVER_PROTOCOL'];

    if (!in_array($protocol, array('HTTP/1.1', 'HTTP/2', 'HTTP/2.0'))) {
        $protocol = 'HTTP/1.0';
    }

    header('Allow: POST');
    header("$protocol 405 Method Not Allowed");
    header('Content-Type: text/plain');

    exit;
}

nocache_headers();

$user             = wp_get_current_user();
$post_id          = $_POST['comment_post_ID'];
$comment_parent   = $_POST['comment_parent'];
$comment          = $_POST['reply'];
$time             = current_time('mysql');
$email            = isset($_POST['email']) ? esc_html($_POST['email']) : $user->user_email;
$author           = isset($_POST['author']) ? esc_html($_POST['author']) : $user->display_name;


$data = array(
  'comment_post_ID'      => $post_id,
  'comment_author'       => $author,
  'comment_author_email' => $email,
  'comment_content'      => $comment,
  'user_id'              => $user->ID,
  'comment_date'         => $time,
  'comment_approved'     => 0,
  'comment_parent'       => $comment_parent,
);


$comment_ID = wp_insert_comment($data);

add_comment_meta($comment_ID, 'lastname', isset($_POST['lastname']) ? esc_html($_POST['lastname']) : '');


$location = empty($_POST['redirect_to']) ? get_comment_link($comment_ID) : $_POST['redirect_to'] . '#comment_' . $comment_ID;

$location = apply_filters('comment_post_redirect', $location, $comment);

wp_safe_redirect($location);

exit;

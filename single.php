<?php get_header(); ?>

<div class="container">
  <?php the_title("<h1>", "</h1>"); ?>
  <div>
    <?php
    $post_tags = get_the_tags();
    if ($post_tags) :
        foreach ($post_tags as $tag) :
            ?>
        <a href="<?php echo get_tag_link($tag->term_id); ?>"><?php echo $tag->name . ", " ?></a>
            <?php
        endforeach;
    endif;
    ?>
  </div>
  <div class="content">
    <?php the_content(); ?>
  </div>
  <?php
    $post_id = get_the_ID();

    if (comments_open() || get_comments_number()) :
        comments_template();
    endif;

    $page   = (get_query_var('page')) ? get_query_var('page') : 1;
    $limit  = 5;
    $offset = ($page * $limit) - $limit;
    $total_comments = get_comments(array(
    'orderby' => 'post_date',
    'order'   => 'DESC',
    'post_id' => $post_id,
    'status'  => 'approve',
    'parent'  => 0
    ));

    $pages = ceil(count($total_comments) / $limit);

    $comments = get_comments(array(
    'post_id' => $post_id,
    'offset'  => $offset,
    'number'  => $limit,
    'parent'  => 0,
    'status'  => 'approve'
    ));

    if (count($comments)) :
        ?>
    <div class="comment" id="comment-wrapper">
        <?php
        foreach ($comments as $comment) :
            ?>
        <div class="comment-row">
            <?php $lastname = get_comment_meta($comment->comment_ID, 'lastname', true); ?>
          <div style="margin-bottom:12px; margin-top:20px;" id="<?php echo 'comment-' . $comment->comment_ID ?>">
            <?php $avatar = get_avatar($comment->user_id, $size = 35); ?>
            <?php echo $avatar; ?>
            <span class="author"><?php echo $comment->comment_author . ' ' . $lastname; ?></span>
            <span class="devider">|</span>
            <span class="date"><?php echo date('F j, Y', strtotime($comment->comment_date)); ?></span>
            <div style="padding-left:35px;"><?php echo $comment->comment_content; ?></div>
          </div>
        </div>
        <div class="reply">
            <?php
            $replies = get_comments(array(
            'post_id' => $post_id,
            'parent'  => $comment->comment_ID,
            'number'  => 200,
            'status'  => 'approve'
            ));

            foreach ($replies as $reply) :
                $lastname = get_comment_meta($reply->comment_ID, 'lastname', true);
                ?>

            <div id="comment_<?php echo $reply->comment_ID; ?>">
              <div style="margin-bottom:12px; margin-top:20px; padding-left:45px;">
                <?php
                $avatar = get_avatar($reply->user_id, $size = 35);
                echo $avatar;
                ?>
                <span class="author"><?php echo $reply->comment_author . ' ' . $lastname; ?></span>
                <span class="devider">|</span>
                <span class="date"><?php echo date('F j, Y', strtotime($comment->comment_date)); ?></span>
                <div><?php echo $reply->comment_content; ?></div>
              </div>
            </div>
                <?php
            endforeach;
            ?>
        </div>
        <div class="show-reply">
          <button onClick="hide_show('<?php echo $comment->comment_ID; ?>'); return false;" style="border-radius:15%; background-color: orange; color:red;"><span class="reply-link">Reply</span></button>
        </div>
        <div class="reply_form">
            <?php $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]/wp-content/themes/xy-theme/wp-comments-reply-post.php";  ?>
          <div id="<?php echo 'comment_' . $comment->comment_ID ?>" style="display:none">
            <form method="post" action="<?php echo $actual_link; ?>" class="custom-reply-form">
              <input type="hidden" name="action" value="save_contact" />
              <input type="hidden" name="redirect_to" value="<?php echo $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";  ?>" />
              <input type="hidden" name="comment_parent" value="<?php echo $comment->comment_ID; ?>">
              <input type="hidden" name="comment_post_ID" value="<?php echo $post_id; ?>">
              <textarea name="reply" id="reply" cols="600" rows="4" placeholder="Enter your reply."></textarea>
              <?php if (!is_user_logged_in()) : ?>
                <label for="author_field">firstname</label> <input type="text" id="author_field" name="author" />
                <label for="lastname_field">lastname</label> <input type="text" id="lastname_field" name="lastname" />
                <label for="email_field">email</label><input type="email" id="email_field" name="email" />
              <?php endif; ?>
              <div style="text-align:right">
                <span class="submit-text"><span><button name="submit_reply" class="submit_reply" id="submit_reply">Submit</button>
              </div>
            </form>
          </div>
        </div>
            <?php
        endforeach;
        ?>
    </div>
        <?php
    endif;
    ?>
</div>

<?php get_footer(); ?>

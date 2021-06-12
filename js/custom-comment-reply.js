const $ = jQuery;
let $ajax_url;

if (typeof $url === "undefined") {
  $ajax_url = "/wp-comments-reply-post.php";
} else {
  $ajax_url = $url;
}

$(".custom-reply-form").submit(ajaxSubmit);

function ajaxSubmit(e) {
  e.preventDefault();

  var formData = $(this).serialize();

  $.ajax({
    type: "POST",
    url: $ajax_url,
    data: formData,
    success: function (response) {
      console.log(response);
    },
    error: function (error) {
      console.log(error);
    },
  });

  return false;
}

function hide_show($id) {
  $reply_form = document.getElementById("comment_" + $id);
  $display_attrbute = $reply_form.style.display;
  if ($display_attrbute === "none") {
    $reply_form.style.display = "block";
  } else {
    $reply_form.style.display = "none";
  }
}

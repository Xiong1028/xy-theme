<!doctype html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php wp_title('|', true, 'right'); ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

  <?php wp_head(); ?>
  <style>
    #page-container {
      position: relative;
      min-height: 100vh;
    }

    #content-wrap {
      /* padding-bottom: 2.5rem; */
      /* Footer height */
    }

    #footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      height: 2.5rem;
      /* Footer height */
    }
  </style>
</head>

<body <?php body_class(); ?>>
  <div id="page-container">
    <div id="content-wrap">
      <header>
        <nav class="bg-secondary navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand px-3" href="#">
            <img src="<?php echo get_theme_root_uri() . "/xy-theme/images/haha-logo.png"; ?>" width="100" alt="haha">
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </nav>
      </header>

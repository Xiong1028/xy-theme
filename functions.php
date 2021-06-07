<?php
function xy_dump($obj)
{
    echo '<pre>';
    var_dump($obj);
    echo '</pre>';
}

add_theme_support('nav-menus');

register_nav_menus(array(
    'header-menu' => __('header-menu'),
    'footer-menu' => __('footer-menu')
));

function xy_theme_custom_logo_setup()
{
    $defaults = array(
        'height'               => 100,
        'width'                => 400,
        'flex-height'          => true,
        'flex-width'           => true,
        'header-text'          => array('site-title', 'site-description'),
        'unlink-homepage-logo' => true,
    );

    add_theme_support('custom-logo', $defaults);
}

add_action('after_setup_theme', 'xy_theme_custom_logo_setup');

function xy_theme_post_formats_setup()
{
    add_theme_support('post-formats', array('aside', 'gallery'));
}

add_action('after_setup_theme', 'xy_theme_post_formats_setup');

/* register sidebar */
add_action('widgets_init', 'xy_theme_widgets_init');

function xy_theme_widgets_init()
{
    register_sidebar(array(
        'name'          => __('xy header sidebar', 'xy-theme'),
        'id'            => 'sidebar-1',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title"',
        'after_title'   => '</h3>',
    ));

    register_sidebar(array(
        'name'          => __('xx footer sidebar', 'xy-theme'),
        'id'            => 'sidebar-2',
        'before_widget' => '<ul><li id="%1$s" class="widget %2$s">',
        "after_widget"  => '</li></ul>',
        "before_title"  => '<h3 class="widget-title">',
        "after_title"   => '</h3>',
    ));
}

/* register a custom post type */
function wp_custom_post_type()
{
    register_post_type(
        'workshops',
        array(
            'labels'      => array(
                'name'          => __('Workshops', 'xy-theme'),
                'singular_name' => __('Workshop', 'xy-theme'),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array('slug' => 'workshops'),
        )
    );
    register_post_type(
        'sessions',
        array(
            'labels'      => array(
                'name'          => __('Sessions', 'xy-theme'),
                'singular_name' => __('Session', 'xy-theme'),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array('slug' => 'sessions'),
        )
    );
}
add_action('init', 'wp_custom_post_type', 7);

add_action('init', 'add_wp_cli', 8);

function add_wp_cli()
{
    if (!class_exists('WP_CLI')) {
        return;
    }

    WP_CLI::add_command('update-data', 'add_data_from_apis');
}

function add_data_from_apis()
{
    $api_urls = array(
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/PS/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/ARE/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/ASR/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/ACE/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/CB/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/ERM/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/EDI/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/FD/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/FRMRDH/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/HP/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/HIS/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/LED/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/LA/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/GAME/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/PHW/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/QI/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/SIM/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/TL/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/SURG/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/RES/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/TEC/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/WW/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/WC/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/CHAT/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/WCW/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/VC/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/PRV/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/FM/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/SPONSORED/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/FR/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/PRE/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/SE/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/AM/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/INV/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/NAP/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/RECORD/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/PS/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/ARE/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/ASR/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/ACE/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/CB/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/ERM/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/EDI/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/FD/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/FRMRDH/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/HP/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/HIS/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/LED/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/LA/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/GAME/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/PHW/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/QI/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/SIM/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/TL/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/SURG/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/RES/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/TEC/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/WW/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/WC/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/CHAT/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/WCW/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/VC/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/PRV/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/FM/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/SPONSORED/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/FR/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/PRE/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/SE/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/AM/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/INV/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/NAP/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionTracksListings/10/5436/RECORD/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionDaysListings/10/5436/10-19-2021/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionDaysListings/10/5436/10-20-2021/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionDaysListings/10/5436/10-21-2021/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionDaysListings/10/5436/10-22-2021/en',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionDaysListings/10/5436/10-19-2021/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionDaysListings/10/5436/10-20-2021/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionDaysListings/10/5436/10-21-2021/fr',
        'https://royalcollege-web.ungerboeck.com/wriservice/api/Sessions/GetSessionDaysListings/10/5436/10-22-2021/fr',
    );

    create_custom_table();
    $i = 0;

    foreach ($api_urls as $key => $url) {
        $has_error = update_data_from_external_api($url);

        if ($has_error) {
            echo "$url    -- [ failed ]   -- $key \n";
            $i++;
        }
    }
    echo "failed in total: $i";
}

function update_data_from_external_api($url)
{

    global $wp_version;

    $args            = array(
        'timeout'     => 10,
        'httpversion' => '1.0',
        'user-agent'  => 'WordPress/' . $wp_version . '; ' . home_url(),
        'blocking'    => true,
        'body'        => '',
        'compress'    => false,
        'decompress'  => true,
        'sslverify'   => false,
        'stream'      => false,
        'filename'    => ''
    );
    $splited_urls = explode("/", $url, -1);
    $searchtext = end($splited_urls);
    $api_lang = strtolower(substr($url, -2));

    $request  = wp_remote_get($url, $args);
    $body        = wp_remote_retrieve_body($request);
    $data        = json_decode($body);

    global $wpdb;
    $hasError    = false;

    if (!empty($data)) {
        $hasError = insert_data_to_db($wpdb, $data, $searchtext, $api_lang);
    } else {
        $hasError = true;
    }
    return $hasError;
}

function insert_data_to_db($wpdb, $data, $searchtext, $api_lang)
{
    foreach ($data as $item) {
        $building             = property_exists($item, 'BUILDING') ? $item->BUILDING : '';
        $changedon            = property_exists($item, 'CHANGEDON') ? $item->CHANGEDON : date('Y-m-d H:i:s', time());
        $endtime              = property_exists($item, 'ENDTIME') && property_exists($item, 'SESSIONDATE') ? $item->SESSIONDATE . ' ' . $item->ENDTIME : '';
        $evaluationnote       = property_exists($item, 'EVALUATIONNOTE') ? $item->EVALUATIONNOTE : '';
        $funclink             = property_exists($item, 'FUNCLINK') ? $item->FUNCLINK : '';
        $language             = property_exists($item, 'LANGUAGE') ? $item->LANGUAGE : '';
        $learnerlevel         = property_exists($item, 'LEARNERLEVEL') ? $item->LEARNERLEVEL : '';
        $presenters           = property_exists($item, 'PRESENTERS') ? $item->PRESENTERS : '';
        $room                 = property_exists($item, 'ROOM') ? $item->ROOM : '';
        $sessdetailslist      = property_exists($item, 'SESSDETAILSLIST') ? json_encode($item->SESSDETAILSLIST) : '';
        $session              = property_exists($item, 'SESSION') ? $item->SESSION : '';
        $sessionnote          = property_exists($item, 'SESSIONNOTE') ? $item->SESSIONNOTE : '';
        $starttime            = property_exists($item, 'STARTTIME') && property_exists($item, 'SESSIONDATE') ? $item->SESSIONDATE . ' ' . $item->STARTTIME : '';
        $track                = property_exists($item, 'TRACK') ? $item->TRACK : '';

        /* $wpdb->show_errors(); */
        $query_result          = $wpdb->insert(
            $wpdb->prefix . 'workshops',
            array(
                'building'        => $building,
                'changedon'       => strcmp($api_lang, 'en') == 0 ? formatDate($changedon) : formatDate(translateDateIntoEn($changedon)),
                'endtime'         => strcmp($api_lang, 'en') == 0 ? formatWeekDate($endtime) : formatWeekDate(translateDateIntoEn($endtime)),
                'evaluationnote'  => $evaluationnote,
                'funclink'        => $funclink,
                'language'        => $language,
                'learnerlevel'    => $learnerlevel,
                'presenters'      => $presenters,
                'room'            => $room,
                'sessdetailslist' => $sessdetailslist,
                'session'         => $session,
                'sessionnote'     => $sessionnote,
                'starttime'       => strcmp($api_lang, 'en') == 0 ? formatWeekDate($starttime) : formatWeekDate(translateDateIntoEn($starttime)),
                'track'           => $track,
                'searchtext'      => $searchtext,
                'apitype'         => isDate($searchtext) ? 'days' : 'tracks',
                'apilang'         => $api_lang,
            )
        );
        /* $wpdb->print_error(); */

        if (!$query_result) {
            return true;
        }
    }
    return false;
}

function create_custom_table()
{
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    /* Create the workshop table */
    $table_name = $wpdb->prefix . 'workshops';
    $sql = "CREATE TABLE $table_name(
    workshop_id INTEGER NOT NULL AUTO_INCREMENT,
    building TEXT NOT NULL,
    changedon DATETIME NOT NULL,
    endtime DATETIME NOT NULL,
    evaluationnote TEXT NOT NULL,
    funclink TEXT NOT NULL, 
    language TEXT NOT NULL,
    learnerlevel TEXT NOT NULL,
    presenters TEXT NOT NULL,
    room TEXT NOT NULL,
    sessdetailslist TEXT NOT NULL,
    session TEXT NOT NULL,
    sessionnote TEXT NOT NULL,
    starttime DATETIME NOT NULL,
    track TEXT NOT NULL,
    searchtext TEXT NOT NULL,
    apitype TEXT NOT NULL,
    apilang TEXT NOT NULL,
    PRIMARY KEY(workshop_id)
) $charset_collate;";

    $query          = $wpdb->prepare('SHOW TABLES LIKE %s', $wpdb->esc_like($table_name));
    $drop_tbl_query = 'DROP TABLE ' . $table_name;

    if (!$wpdb->get_var($query) == $table_name) {
        dbDelta($sql);
    } else {
        echo "table exists. droping table starts....\n";
        $wpdb->query($drop_tbl_query);

        echo "create table....\n";
        dbDelta($sql);
    }
}


function translateDateIntoEn($date_fr)
{
    $english_months_weeks = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_months_weeks = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');

    $date_en_raw = str_replace($french_months_weeks, $english_months_weeks, strtolower($date_fr));
    $date_en = preg_replace("#[\n\r\s]+le[\n\r\s]+#", ' ', $date_en_raw);
    return $date_en;
}

function formatDate($time_str)
{
    $timestamp = strtotime($time_str);
    $date      = date('Y-m-d H:i:s', $timestamp);

    return $date;
}

function formatWeekDate($time_str)
{
    $timestamp = strtotime($time_str);
    $date      = date('Y-m-d H:i:s', $timestamp);
    $weekarray = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
    $week      = $weekarray[date('w', $timestamp)];
    return $date . ', ' . $week;
}

function formatDateByCustomFormat($time_str, $format = 'Y-m-d H:i:s')
{
    $timestamp = strtotime($time_str);
    $date      = date($format, $timestamp);
    $weekarray = array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
    $week      = $weekarray[date('w', $timestamp)];
    return $week . ', ' . $date;
}

function isDate($date, $format = 'm-d-Y')
{
    try {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date ? true : false;
    } catch (Exception $e) {
        return false;
    }
}

/*
 * wp create-posts command
 *
 * */
add_action('init', 'wp_cli_create_posts');

function wp_cli_create_posts()
{
    if (!class_exists('WP_CLI')) {
        return;
    }

    WP_CLI::add_command('create-posts', 'insert_workshop_posts');
}

function insert_workshop_posts()
{
    global $wpdb;

    $workshopTexts = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT searchtext FROM wp_workshops WHERE apitype=%s", 'days'));

    foreach ($workshopTexts as $key => $workshopText) {
        $workshopsByDay = $wpdb->get_results($wpdb->prepare("SELECT workshop_id, CONCAT(DATE_FORMAT(starttime,%s),'-',DATE_FORMAT(endtime,%s)) AS time, DATE_FORMAT(starttime, %s) AS workshop_date, starttime, changedon, evaluationnote, funclink, room, building, learnerlevel, session, track, language,presenters,sessionnote,sessdetailslist, apitype, searchtext FROM wp_workshops WHERE searchtext=%s AND apilang=%s ORDER BY starttime", '%H:%i', '%H:%i', '%Y-%m-%d', $workshopText, 'en'));

        $workshop_date  = '';
        $workshop_infos = array();
        $workshop_table = array();

        foreach ($workshopsByDay as $workshopByDay) {
            $workshop_date = $workshop_date !== '' ? $workshop_date : formatDateByCustomFormat($workshopByDay->starttime, 'd F Y');
            $workshop_row  = array(
                'session_id'      => $workshopByDay->workshop_id,
                'time'            => $workshopByDay->time,
                'workshop_date'   => $workshop_date !== '' ? $workshop_date : formatDateByCustomFormat($workshopByDay->starttime, 'd F Y'),
                'changedon'       => $workshopByDay->changedon,
                'evaluationnote'  => $workshopByDay->evaluationnote,
                'funclink'        => $workshopByDay->funclink,
                'room'            => $workshopByDay->room,
                'building'        => $workshopByDay->building,
                'learnerlevel'    => $workshopByDay->learnerlevel !== '' ? $workshopByDay->learnerlevel : 'all levels',
                'program'         => $workshopByDay->session,
                'track'           => $workshopByDay->track,
                'language'        => $workshopByDay->language !== '' ? $workshopByDay->language : 'English',
                'presenters'      => $workshopByDay->presenters,
                'sessionnote'     => $workshopByDay->sessionnote,
                'sessdetailslist' => $workshopByDay->sessdetailslist,
                'searchtext'      => $workshopByDay->searchtext,
            );
            /* create session post first */
            $post_content_by_session = normalize_whitespace(load_template_part('content', 'session', $workshop_row));

            /* insert single session post */
            $session_post_id = wp_insert_post(array(
                'post_title'     => $workshop_row['program'],
                'post_content'   => $post_content_by_session,
                'post_status'    => 'publish',
                'comment_status' => 'closed',
                'ping_status'    => 'closed',
                'post_date'      => date($workshop_row['changedon']),
                'post_type'      => 'sessions'
            ));

            if ($session_post_id) {
                echo "Session {$session_post_id} is inserted \n";
                add_post_meta($session_post_id, 'sesssion_id', $workshop_row['session_id']);
                add_post_meta($session_post_id, 'session_date', date($workshopByDay->starttime));
                $workshop_row['session_post_id'] = $session_post_id;
                /* add slug */
                wp_insert_post(array(
                    'ID' => $session_post_id,
                    'post_name' => 'session ' . $session_post_id
                ));
                /* add categories here  */

                /* add tags here  */
            }

            array_push($workshop_table, $workshop_row);
        }

        $workshop_infos = array(
            'workshop_date'  => $workshop_date,
            'workshop_table' => $workshop_table
        );

        $post_event_content = normalize_whitespace(load_template_part('content', 'workshop', $workshop_infos));
        $post_event_excerpt = "<h2></h2>";

        /* insert event post */
        $workshop_event_post_id = wp_insert_post(array(
            'post_title'     => 'workshop ' . $workshop_date,
            'post_name'      => $workshopText,
            'post_content'   => $post_event_content,
            'post_status'    => 'publish',
            'comment_status' => 'closed',
            'ping_status'    => 'closed',
            'post_date'      => date(end($workshopsByDay)->changedon),
            'post_type'      => 'tribe_events',
            'post_excerpt'  => '<h2>2021 Conference on Residency Education – La Conférence internationale sur la formation des résidents virtuelle 2021</h2><p><em>' . $workshop_date . '</em></p>'
        ));

        if ($workshop_event_post_id) {
            echo "Workshop Event {$workshop_event_post_id} is inserted \n";
            add_post_meta($workshop_event_post_id, '_EventStartDate', date("Y-m-d H:i:s", strtotime("$workshop_date 00:00:00")));
            add_post_meta($workshop_event_post_id, '_EventEndDate', date("Y-m-d H:i:s", strtotime("$workshop_date 23:59:59")));
            var_dump("$workshop_date 00:00:00");
            var_dump(date("Y-m-d H:i:s", strtotime("$workshop_date 00:00:00")));
            var_dump("$workshop_date 23:59:59");
            var_dump(date("Y-m-d H:i:s", strtotime("$workshop_date 23:59:59")));
            add_post_meta($workshop_event_post_id, '_EventAllDay', true);
        }
    }
}


function load_template_part($template_name, $part_name = null, $args = array())
{
    ob_start();
    get_template_part($template_name, $part_name, $args);
    $var = ob_get_contents();
    ob_end_clean();
    return $var;
}

/*
 * wp delete-post command
 *
 * */
add_action('init', 'wp_delete_post_command');

function wp_delete_post_command()
{
    if (!class_exists('WP_CLI')) {
        return;
    }

    WP_CLI::add_command('delete-posts', function () {
        delete_all_posts();
    });
}

function delete_all_posts($args = array('post_type' => array('sessions', 'workshops', 'tribe_events'), 'numberposts' => -1))
{
    $all_posts = get_posts($args);

    foreach ($all_posts as $post) {
        wp_delete_post($post->ID, true);
        if ($post->post_type == "sessions") {
            echo "session $post->ID is deleted ... \n";
        } elseif ($post->post_type == "workshops") {
            echo "workshops $post->ID is deleted ... \n";
        } else {
            echo "tribe_events $post->ID is deleted ... \n";
        }
    }
}

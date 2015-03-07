<?php
class WordPress_Appify {

  function __construct ($pages_to_create) {
    $this -> init($pages_to_create);
  }

  /*----------------------------------------------------------------------------------------------------------------------*/
  /*    Init Methods
  /*----------------------------------------------------------------------------------------------------------------------*/

  function init($pages_to_create) {
    // Setup
    $this -> appify_create_wp_pages($pages_to_create);
    //$this -> appify_create_user_roles();

    // Actions and filters
    //$this -> appify_add_xml_rpc_functions();

    // Register task post type
    add_action('init', array(&$this, 'register_task_post'));

    add_filter('template_include', array(&$this, 'appify_get_template'), 1, 1);
    //add_filter('get_header', array(&$this, 'appify_authenticate'), 1, 1);

    // Remove admin bar
    //add_filter('show_admin_bar', '__return_false');

    // WP Admin Dashboard Redirect
    //add_action('admin_init', array(&$this, 'appify_wp_dashboard_redirect'));
  }

  function register_task_post () {
     $args = array();

    $labels = array(
      'name'               => _x( 'Tasks', 'post type general name' ),
      'singular_name'      => _x( 'Task', 'post type singular name' ),
      'add_new'            => _x( 'Add New', 'todo' ),
      'add_new_item'       => __( 'Add New Task' ),
      'edit_item'          => __( 'Edit Task' ),
      'new_item'           => __( 'New Task' ),
      'all_items'          => __( 'All Tasks' ),
      'view_item'          => __( 'View Task' ),
      'search_items'       => __( 'Search Tasks' ),
      'not_found'          => __( 'No tasks found' ),
      'not_found_in_trash' => __( 'No tasks found in the Trash' ), 
      'parent_item_colon'  => '',
      'menu_name'          => 'Tasks'
    );

    $args = array(
      'labels'        => $labels,
      'description'   => 'Holds todo tasks',
      'public'        => true,
      'menu_position' => 5,
      'supports'      => array( 'title', 'editor'),
      'has_archive'   => true,
    );

    register_post_type( 'task', $args);
  }

  function appify_create_wp_pages ($pages_to_create) {
    foreach ($pages_to_create as $page) {
      if (get_page_by_title($page) == null) {
        $page_args = array (
          'post_type' => 'page',
          'post_title' => $page,
          'post_content' => '',
          'post_status' => 'publish',
          'author' => 1
        );

        wp_insert_post($page_args);
      }
    }
  }


  /*----------------------------------------------------------------------------------------------------------------------*/
  /*    Authenticate 
  /*----------------------------------------------------------------------------------------------------------------------*/
    function appify_authenticate () {
    }

  /*----------------------------------------------------------------------------------------------------------------------*/
  /*    Dashboard Redirect
  /*----------------------------------------------------------------------------------------------------------------------*/

  function appify_wp_dashboard_redirect () {
    $location = 'http://grayurban-projects.dev/wp-scratchpad/';
    wp_redirect( $location);
    exit;
  }


  /*----------------------------------------------------------------------------------------------------------------------*/
  /*    Routing
  /*----------------------------------------------------------------------------------------------------------------------*/
  function appify_get_template ($template) {

    if (is_array($pages_test) && $in_array_test) {
      $page_to_get = strtolower($pages_test[$post->ID]);
      $template = get_template_directory() . '/appify/views/page-' . $page_to_get . '.php';

    } elseif (is_post_type_archive('task')) {
      $page_to_get = 'todo';
      $template = get_template_directory() . '/appify/views/page-' . $page_to_get . '.php';

    } elseif (is_tax('taskstatus')) {
      $page_to_get = 'status-archive';
      $template = get_template_directory() . '/appify/views/page-' . $page_to_get . '.php';

    } elseif (is_home()) {

    } elseif (is_page('Dashboard')) {
      $template = get_template_directory() . '/appify/views/page-dashboard.php';
    } else {
      $template = $template;
    }

    return $template;
  }

  // Custom Tasks Filter
  //add_action('pre_get_posts', 'woo_tasks_filter');
  //function woo_tasks_filter($query) {
    //global $wp_query;
    //$current_user = wp_get_current_user;

    //if ($query->is_tax('taskstatus') || $query->is_post_type_archive('task')) {
      //// Only author posts
      //$query->set('author', $current_user->ID);
      //$query->parse_query();
    //}

    //return $query;
  //}


  /*
  // Current user
  <?php
  if (empty($current_user->first_name)) {
    $display_name = $current_user->display_name;
  } else {
    $display_name = $current_user->first_name . ' ' . $current_user->last_name;
  }
  ?>

  <div>
    <h2><?php echo $display_name ?></h2>
  </div>
  */


  // New Task
  //$task_args = array(
    //'post_type' => 'task',
    //'post_title' => $_POST['taskName'],
    //'post_content' => $_POST['taskContent'],
    //'post_status' => 'publish',
    //'author' => $current_user->ID
  //);

  //$post_id = wp_insert_post($task_args);

  //if ($post_id >0) {
    //wp_set_post_terms($post_id, 4, 'taskstatus');
    //array_push($messages, array('tick' => 'Task Added Sucessfully.'));
  //} else {
    //array_push($messages, array('alert' => 'An error occured. Please consult your system administartor'));
  //}


}

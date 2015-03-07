<?php
  /*
   *  Redirects if user not logged in
   */
        if (empty($current_user->ID)) {
          wp_redirect(home_url());
          exit;
        }

  /*
   *  If post submitted
   */
  if (isset($_POST['submitted'])) {
    if ($_POST['task_item'] != '')
    {
      //New Task
      $task_args = array(
        'post_type' => 'task',
        'post_title' => $_POST['task_item'],
        'post_status' => 'publish',
        'author' => $current_user->ID
      );

      $post_id = wp_insert_post($task_args);
      }
    }
?>

<?php get_header(); ?>


<div id="content" class="col-full">
  <div id="inner" class="col-full aligncenter">

  <form action="<?php echo the_permalink();?>" method="post">
    <fieldset>
      <input style="width:100%;font-size:30px;" type="text" name="task_item" placeholder="What do you want to do..." value=""/>
      <input type="hidden" name="submitted" value="true" />
    </fieldset>
  </form>
</div>

  <div id="inner" class="col-full">


  <?php
  /* Retrive list of task */

  $args = array('post_type' => 'task', 'author' => $current_user->ID);
  // The Query
  $the_query = new WP_Query( $args );

  // The Loop
  if ( $the_query->have_posts() ) {
    echo '<ul>';
    while ( $the_query->have_posts() ) {
      $the_query->the_post();
      echo '<li>' . get_the_title() . '</li>';
    }
    echo '</ul>';
  } else {
    // no posts found
  }
  /* Restore original Post Data */
  wp_reset_postdata();
  ?>


<hr />
  </div>
</div>
<?php
  get_footer();
?>

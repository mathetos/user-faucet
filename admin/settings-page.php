<?php

/*
 *  Creates the main settings page
 *
 */

 /**
 * Adds a new top-level menu to the bottom of the WordPress administration menu.
 */
function wip_userfaucet_create_submenu_page() {
  global $wipuf_adminpage;

  $wipuf_adminpage = add_submenu_page(
    'users.php',                  // Register this submenu with the menu defined above
    'User Faucet',          // The text to the display in the browser when this menu item is active
    'User Faucet',                  // The text for this menu item
    'administrator',            // Which type of users can see this menu
    'user-faucet',          // The unique ID - the slug - for this menu item
    'wip_userfaucet_submenu_page_display'   // The function used to render the menu for this page to the screen
  );

} // end sandbox_create_menu_page
add_action('admin_menu', 'wip_userfaucet_create_submenu_page');

/**
 * Renders the basic display of the menu page for the theme.
 */
function wip_userfaucet_submenu_page_display() {

    // Create a header in the default WordPress 'wrap' container
    $header = '<div class="wrap">';
        $header .= '<img src="' . WIPUF_URL . '/assets/img/user-faucet-icon.png" width="100px" style="display: inline-block; width: 50px; vertical-align: bottom; margin-right: 20px;"><h2 style="display: inline-block;">User Faucet</h2><hr />';
    $header .= '</div>';

    // Send the markup to the browser
    echo $header; ?>
    <script>
    jQuery(document).ready(function($) {
      $('#example').DataTable();
    } );
    </script>
    <table id="example" class="dataTable" cellspacing="0" width="100%">
      <thead>
          <tr>
            <th>Full Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
          </tr>
      </thead>
      <tfoot>
          <tr>
              <th>Full Name</th>
              <th>Username</th>
              <th>Email</th>
              <th>Role</th>
          </tr>
      </tfoot>
      <tbody>
        <?php wipuf_display_users(); ?>
      </tbody>
    </table>

    <?php
} // end sandbox_menu_page_display

function wipuf_display_users() {
  // WP_User_Query arguments
$args = array (
	'role'           => 'Subscriber',
);

// The User Query
$user_query = new WP_User_Query( $args );

// The User Loop
if ( ! empty( $user_query->results ) ) {
	foreach ( $user_query->results as $user ) {
    $info = $user->data;
    $meta = get_user_meta($info->ID);
    $data = get_userdata($info->ID);
    $firstname = $meta['first_name'][0];
    $lastname = $meta['last_name'][0];
    $getrole = $meta['wp_capabilities'];
    $role = $data->roles;
    $username = $info->display_name;
    $email = $info->user_email;
    ?>

    <tr>
      <td><?php echo $firstname . '&nbsp;' . $lastname; ?><br />
        <a href="<?php echo get_edit_user_link($info->ID); ?>">Edit this user</a>
      </td>
      <td><?php echo $username; ?></td>
      <td><?php echo $email; ?></td>
      <td><?php echo ucwords($role[0]); ?></td>
    </tr>

    <?php
	}
  var_dump($role);
} else {
	// no users found
  $results = 'Sorry! No Users Found';
}

return $results;

}

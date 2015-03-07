<?php
/*----------------------------------------------------------------------------------------------------------------------*/
/*    Appify My Theme     */
/*----------------------------------------------------------------------------------------------------------------------*/

global $appify_object;

require_once( get_template_directory() . '/appify/appify.class.php');

$pages_to_create = array(
  'Dashboard'
);

$user_roles = array(
  'standarduser' => array( 'Standard Registered User', 'subscriber' ),
  'premiumuser' => array( 'Premium User', 'contributor' ),
  'adminuser' => array( 'Admin User', 'administrator')
);

$user_menus = array(
  'public' => array( 'Login', 'Register' ),
  'private' => array ( 'Dashboard', 'Profile' )
);

//$xml_rpc_functions = array( 'appify_xml_rpc_loader' );

$appify_object = new WordPress_Appify( $pages_to_create, $user_roles, $user_menus, $xml_rpc_functions );




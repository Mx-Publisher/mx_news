<?php
/**
*
* @package MX-Publisher Module - mx_news
* @version $Id: db_upgrade.php,v 1.7 2013/04/04 12:24:06 orynider Exp $
* @copyright (c) 2002-2006 [Jon Ohlsson, Mohd Basri, wGEric, PHP Arena, pafileDB, CRLin] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
*
*/

define( 'IN_PORTAL', true );
if ( !defined( 'IN_ADMIN' ) )
{
	$mx_root_path = './../../';
	$phpEx = substr(strrchr(__FILE__, '.'), 1);
	include( $mx_root_path . 'common.' . $phpEx );
	// Start session management
	$mx_user->init($user_ip, PAGE_INDEX);

	if ( !$userdata['session_logged_in'] )
	{
		die( "Hacking attempt(1)" );
	}

	if ( $userdata['user_level'] != ADMIN )
	{
		die( "Hacking attempt(2)" );
	}
	// End session management
}

$mx_module_version = '1.0.3';
$mx_module_copy = 'Designed for MX-Publisher by [Jon Ohlsson] <a href="http://www.mx-publisher.com" target="_blank">The MX-Publisher Development Team</a>.</a>';

// For compatibility with core 2.7.+
define( 'MXBB_27x', file_exists( $mx_root_path . 'mx_login.php' ) );

$sql = array();

// Precheck
if ( $result = $db->sql_query( "SELECT config_name from " . $mx_table_prefix . "simplenews_config" ) )
{
	// Upgrade checks
	$upgrade_280 = true; // MX-Publisher 2.8 branch ->
	
	$message = "<b>Upgrading!</b><br/><br/>";
	
	if ($upgrade_280 == 1)
	{
		$upgrade_280 = 1;
		$message .= "<b>Upgrading to v. 2.8.0...ok</b><br/><br/>";
		$sql[] = "ALTER TABLE " . $mx_table_prefix . "simplenews_comments CHANGE comments_text comments_text LONGTEXT DEFAULT NULL";	
	}
	else
	{
		$message .= "<b>Validating v. 2.8.0...ok</b><br/><br/>";
	}	

	if ( !MXBB_27x )
	{
		$sql[] = "UPDATE " . $mx_table_prefix . "module" . "
				    SET module_version  = '" . $mx_module_version . "',
				      module_copy  = '" . $mx_module_copy . "'
				    WHERE module_id = '" . $mx_module_id . "'";
	}

	$message .= mx_do_install_upgrade($sql);
	$message .= "<b>...Now upgraded to v. $mx_module_version :-)</b><br/><br/>";

	//
	// Empty module cache
	//
	include_once( $mx_root_path . 'includes/mx_functions_tools.' . $phpEx );
	$module_cache = new module_cache($mx_root_path . 'modules/mx_news/mx_news/');
	$module_cache->tidy();
	$module_cache->save();
}
else
{
	// If not installed
	$message = "<b>Module not installed...and thus cannot be upgraded ;)</b><br/><br/>";
}

echo "<br /><br />";
echo "<table  width=\"90%\" align=\"center\" cellpadding=\"4\" cellspacing=\"1\" border=\"0\" class=\"forumline\">";
echo "<tr><th class=\"thHead\" align=\"center\">Module Installation/Upgrading/Uninstalling Information - module specific db tables</th></tr>";
echo "<tr><td class=\"row1\"  align=\"left\"><span class=\"gen\">" . $message . "</span></td></tr>";
echo "</table><br />";

?>
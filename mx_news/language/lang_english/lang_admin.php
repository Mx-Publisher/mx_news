<?php
/**
*
* @package mxBB Portal Module - mx_news
* @version $Id: lang_admin.php,v 1.1 2008/02/08 21:57:56 jonohlsson Exp $
* @copyright (c) 2002-2006 [Jon Ohlsson, Mohd Basri, wGEric, PHP Arena, pafileDB, CRLin] mxBB Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
*
*/

//
// adminCP index
//
$lang['mxNews_title'] = 'News Admin';
$lang['0_Configuration'] = 'General Settings';

//
// Configuration
//
$lang['Settingstitle'] ='News Config Control';
$lang['Settingsexplain'] = 'You can change the general settings of your news here';

$lang['Settings_changed'] = 'Your settings have been successfully updated';
$lang['Click_return_news_config'] = 'Click %sHere%s to return to the Link Config Manager';

//
// Admin Panels - Configuration
//
$lang['Panel_config_title'] = 'Download Configuration';
$lang['Panel_config_explain'] = 'The form below will allow you to customize all the general download options.';

//
// General
//
$lang['General_title'] = 'News Config Control';

$lang['Module_name'] = 'Database Name';
$lang['Module_name_explain'] = 'This is the name of the database, such as \'Download Index\'';

$lang['Enable_module'] = 'Enable this module';
$lang['Enable_module_explain'] = 'This will make the download section unavailable to users. This is a good option to use when making modifications to your database. Only Admins will be able to view the database.';

$lang['Wysiwyg_path'] = 'Path to WYSIWYG software';
$lang['Wysiwyg_path_explain'] = 'This is the path (from mxBB/phpBB root) to the WYSIWYG software folder, eg \'modules/mx_shared/\' if you have uploaded, for example, TinyMCE in modules/mx_shared/tinymce.';

//
// Comments
//
$lang['Comments_title'] = 'Comments';
$lang['Comments_title_explain'] = 'Some comments settings are default settings, and can be overridden per category';

$lang['Internal_comments'] = 'Internal or phpBB Comments';
$lang['Internal_comments_explain'] = 'Use internal comments, or phpBB comments';

$lang['Select_topic_id'] = 'Select phpBB Comments Topic!';

$lang['Internal_comments_phpBB'] = 'phpBB Comments';
$lang['Internal_comments_internal'] = 'Internal Comments';

$lang['Forum_id'] = 'phpBB Forum ID';
$lang['Forum_id_explain'] = 'If phpBB comments are used, this is the forum where the comments will be kept';

//$lang['Autogenerate_comments'] = 'Autogenerate comments when fil are managed';
//$lang['Autogenerate_comments_explain'] = 'When editing/adding a link, a notifying reply is posted in the link topic.';

//$lang['Del_topic'] = 'Delete Topic';
//$lang['Del_topic_explain'] = 'When you delete a link, do you want its comments topic to be deleted also?';

$lang['Comments_pag'] = 'Comments pagination';
$lang['Comments_pag_explain'] = 'The number of comments to show before pagination.';

$lang['Allow_Wysiwyg'] = 'Use WYSIWYG editor';
$lang['Allow_Wysiwyg_explain'] = 'If enabled, the standard BBCode/HTML/Smilies input dialog is replaced by a WYSIWYG editor.';

$lang['Allow_links'] = 'Allow Links';
$lang['Allow_links_message'] = 'Default \'No Links\' Message';
$lang['Allow_links_explain'] = 'If links are not allowed this text will be displayed instead';

$lang['Allow_images'] = 'Allow Images';
$lang['Allow_images_message'] = 'Default \'No Images\' Message';
$lang['Allow_images_explain'] = 'If images are not allowed this text will be displayed instead';

$lang['Max_subject_char'] = 'Maximum Number of charcters in subject';
$lang['Max_subject_char_explain'] = 'If to big, you get an error message (Limit the subject).';

$lang['Max_desc_char'] = 'Maximum Number of charcters in description';
$lang['Max_desc_char_explain'] = 'If to big, you get an error message (Limit the subject).';

$lang['Max_char'] = 'Maximum Number of charcters in text';
$lang['Max_char_explain'] = 'If to big, you get an error message (Limit the comment).';

$lang['Format_wordwrap'] = 'Word wrapping';
$lang['Format_wordwrap_explain'] = 'Text control filter';

$lang['Format_truncate_links'] = 'Truncate Links';
$lang['Format_truncate_links_explain'] = 'Links are shortened, eg t ex \'www.mxbb-portal...\'';

$lang['Format_image_resize'] = 'Image resize';
$lang['Format_image_resize_explain'] = 'Resize images to this width (pixels)';

//
// Notifications
//
$lang['Notifications_title'] = 'Notification';

$lang['Notify'] = 'Notify admin by';
$lang['Notify_explain'] = 'Choose which way to receive notices that news have been written';
$lang['PM'] = 'PM';
$lang['Notify_group'] = 'and groupmembers ';
$lang['Notify_group_explain'] = 'Also send notification to members in this group';

//
//Java script messages and php errors
//
$lang['Cat_name_missing'] = 'Please fill the category name field';
$lang['Missing_field'] = 'Please complete all the required fields';
$lang['Link_same_cat'] = 'You can\'t move the links to the same deleted category.';
$lang['Link_move_cat'] = 'You can\'t move the sub category to the same deleted category.';
$lang['Cat_conflict'] = 'You can\'t have a category with no links in side a category that doesn\'t allow links';
$lang['Cat_id_missing'] = 'Please select a category';

$lang['Need_validation'] = 'Validate links?';
?>
<?php
/**
*
* @package mxBB Portal Module - mx_news
* @version $Id: lang_admin.php,v 1.1 2008/02/13 21:20:01 jonohlsson Exp $
* @copyright (c) 2002-2006 [Jon Ohlsson, Mohd Basri, wGEric, PHP Arena, pafileDB, CRLin] mxBB Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
*
*/

//
// adminCP index
//
$lang['mxNews_title'] = 'News Admin';
$lang['0_Configuration'] = 'Inställningar';

//
// Admin Panels - Configuration
//
$lang['Panel_config_title'] = 'Inställningar';
$lang['Panel_config_explain'] = 'Här bestämmer du alla allmänna konfigurationsinställningar.';

$lang['Settings_changed'] = 'Dina inställningar sparades';
$lang['Click_return_news_config'] = 'Klicka %shär%s för att återgå till nyhetsinställningarna';

//
// General
//
$lang['General_title'] = 'Allmänt';

$lang['Module_name'] = 'Databasens namn';
$lang['Module_name_explain'] = 'Detta är namnet på din nerladdningsdatabas, t ex \'Min databas\'';

$lang['Enable_module'] = 'Aktivera modulen';
$lang['Enable_module_explain'] = 'Detta alternativ inaktiverar all nerladdning för alla användare utan admin, som då kan utföra underhåll av databasen eller liknande';

$lang['Wysiwyg_path'] = 'Var finns wysiwyg mjukvaran?';
$lang['Wysiwyg_path_explain'] = 'Sövägen till (från mxBB roten) mappen där wysiwyg mjukvaran är uppladdad, t ex \'modules/mx_shared/\' om tinymce finns i mappen modules/mx_shared/tinymce.';

//
// Comments
//
$lang['Comments_title'] = 'Kommentarer';
$lang['Comments_title_explain'] = 'Vissa kommentarinställningar är defaultvärden, och kan ändras per kategori';

$lang['Internal_comments'] = 'Interna eller phpBB kommentarer';
$lang['Internal_comments_explain'] = 'Använd interna eller phpBB kommentarer';

$lang['Select_topic_id'] = 'Välj phpBB kommentarforum!';

$lang['Internal_comments_phpBB'] = 'phpBB kommentarer';
$lang['Internal_comments_internal'] = 'Interna kommentarer';

$lang['Forum_id'] = 'phpBB Forum ID';
$lang['Forum_id_explain'] = 'Om phpBB kommentarer används är detta det forum där kommentarerna samlas';

//$lang['Autogenerate_comments'] = 'Skapa autokommentarer';
//$lang['Autogenerate_comments_explain'] = 'När en länk ändras/skrivs, görs ett inlägg i kommentarforumet automatiskt.';

//$lang['Del_topic'] = 'Ta bort forumkommentarer';
//$lang['Del_topic_explain'] = 'När en länk tas bort, skall även associerade forumkommentarer tas bort?';

$lang['Comments_pag'] = 'Kommentarer och sidbrytning';
$lang['Comments_pag_explain'] = 'Antal kommentarer att visa innan sidbrytning.';

$lang['Allow_Wysiwyg'] = 'Använd wysiwyg editor';
$lang['Allow_Wysiwyg_explain'] = 'Om aktiverad, ersätts den vanliga bbcode/html/smilies redigeraren med en wysiwyg editor.';

$lang['Allow_links'] = 'Tillåt länkar';
$lang['Allow_links_message'] = 'Default \'inga länkar\' meddelande';
$lang['Allow_links_explain'] = 'Om länkar ej är tillåtna visas detta meddelande istället';

$lang['Allow_images'] = 'Tillåt bilder';
$lang['Allow_images_message'] = 'Default \'No Images\' meddelande';
$lang['Allow_images_explain'] = 'Om bilder ej är tillåtna visas detta meddelande istället';

$lang['Max_subject_char'] = 'Max antal tecken (i titel)';
$lang['Max_subject_char_explain'] = 'Om man skriven en titel med fler tecken visas ett felmeddelande.';

$lang['Max_desc_char'] = 'Max antal tecken (i beskrivning)';
$lang['Max_desc_char_explain'] = 'Om man skriven en titel med fler tecken visas ett felmeddelande.';

$lang['Max_char'] = 'Max antal tecken';
$lang['Max_char_explain'] = 'Om man skriven en kommentar med fler tecken visas ett felmeddelande.';

$lang['Format_wordwrap'] = 'Avstavning';
$lang['Format_wordwrap_explain'] = '';

$lang['Format_truncate_links'] = 'Förkorta länkar';
$lang['Format_truncate_links_explain'] = 'Länkar skrivs om, t ex \'www.mxbb-portal...\'';

$lang['Format_image_resize'] = 'Skala om bilder';
$lang['Format_image_resize_explain'] = 'Bilder omskalas till denna bredd (pixlar)';

//
// Notifications
//
$lang['Notifications_title'] = 'Påminnelser';

$lang['Notify'] = 'Informera admin via: ';
$lang['Notify_explain'] = 'Bestäm på vilket sätt admin skall bli informerad om nya/redigerade artiklar';
$lang['PM'] = 'PM';

$lang['Notify_group'] = 'och till grupp: ';
$lang['Notify_group_explain'] = 'Informera dessutom medlemmarna i denna grupp.';

//
//Java script messages and php errors
//
$lang['Cat_name_missing'] = 'Fyll i kategorinamnfältet';
$lang['Missing_field'] = 'Fyll i alla fält som krävs';
$lang['Link_same_cat'] = 'You can\'t move the links to the same deleted category.';
$lang['Link_move_cat'] = 'You can\'t move the sub category to the same deleted category.';
$lang['Cat_conflict'] = 'Du kan inte ha en kategori utan länkar i en annan kateogri utan länkar';
$lang['Cat_id_missing'] = 'Välj en kategori';

$lang['Need_validation'] = 'Godkänn länkar?';
?>
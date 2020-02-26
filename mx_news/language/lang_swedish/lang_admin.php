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
$lang['0_Configuration'] = 'Inst�llningar';

//
// Admin Panels - Configuration
//
$lang['Panel_config_title'] = 'Inst�llningar';
$lang['Panel_config_explain'] = 'H�r best�mmer du alla allm�nna konfigurationsinst�llningar.';

$lang['Settings_changed'] = 'Dina inst�llningar sparades';
$lang['Click_return_news_config'] = 'Klicka %sh�r%s f�r att �terg� till nyhetsinst�llningarna';

//
// General
//
$lang['General_title'] = 'Allm�nt';

$lang['Module_name'] = 'Databasens namn';
$lang['Module_name_explain'] = 'Detta �r namnet p� din nerladdningsdatabas, t ex \'Min databas\'';

$lang['Enable_module'] = 'Aktivera modulen';
$lang['Enable_module_explain'] = 'Detta alternativ inaktiverar all nerladdning f�r alla anv�ndare utan admin, som d� kan utf�ra underh�ll av databasen eller liknande';

$lang['Wysiwyg_path'] = 'Var finns wysiwyg mjukvaran?';
$lang['Wysiwyg_path_explain'] = 'S�v�gen till (fr�n mxBB roten) mappen d�r wysiwyg mjukvaran �r uppladdad, t ex \'modules/mx_shared/\' om tinymce finns i mappen modules/mx_shared/tinymce.';

//
// Comments
//
$lang['Comments_title'] = 'Kommentarer';
$lang['Comments_title_explain'] = 'Vissa kommentarinst�llningar �r defaultv�rden, och kan �ndras per kategori';

$lang['Internal_comments'] = 'Interna eller phpBB kommentarer';
$lang['Internal_comments_explain'] = 'Anv�nd interna eller phpBB kommentarer';

$lang['Select_topic_id'] = 'V�lj phpBB kommentarforum!';

$lang['Internal_comments_phpBB'] = 'phpBB kommentarer';
$lang['Internal_comments_internal'] = 'Interna kommentarer';

$lang['Forum_id'] = 'phpBB Forum ID';
$lang['Forum_id_explain'] = 'Om phpBB kommentarer anv�nds �r detta det forum d�r kommentarerna samlas';

//$lang['Autogenerate_comments'] = 'Skapa autokommentarer';
//$lang['Autogenerate_comments_explain'] = 'N�r en l�nk �ndras/skrivs, g�rs ett inl�gg i kommentarforumet automatiskt.';

//$lang['Del_topic'] = 'Ta bort forumkommentarer';
//$lang['Del_topic_explain'] = 'N�r en l�nk tas bort, skall �ven associerade forumkommentarer tas bort?';

$lang['Comments_pag'] = 'Kommentarer och sidbrytning';
$lang['Comments_pag_explain'] = 'Antal kommentarer att visa innan sidbrytning.';

$lang['Allow_Wysiwyg'] = 'Anv�nd wysiwyg editor';
$lang['Allow_Wysiwyg_explain'] = 'Om aktiverad, ers�tts den vanliga bbcode/html/smilies redigeraren med en wysiwyg editor.';

$lang['Allow_links'] = 'Till�t l�nkar';
$lang['Allow_links_message'] = 'Default \'inga l�nkar\' meddelande';
$lang['Allow_links_explain'] = 'Om l�nkar ej �r till�tna visas detta meddelande ist�llet';

$lang['Allow_images'] = 'Till�t bilder';
$lang['Allow_images_message'] = 'Default \'No Images\' meddelande';
$lang['Allow_images_explain'] = 'Om bilder ej �r till�tna visas detta meddelande ist�llet';

$lang['Max_subject_char'] = 'Max antal tecken (i titel)';
$lang['Max_subject_char_explain'] = 'Om man skriven en titel med fler tecken visas ett felmeddelande.';

$lang['Max_desc_char'] = 'Max antal tecken (i beskrivning)';
$lang['Max_desc_char_explain'] = 'Om man skriven en titel med fler tecken visas ett felmeddelande.';

$lang['Max_char'] = 'Max antal tecken';
$lang['Max_char_explain'] = 'Om man skriven en kommentar med fler tecken visas ett felmeddelande.';

$lang['Format_wordwrap'] = 'Avstavning';
$lang['Format_wordwrap_explain'] = '';

$lang['Format_truncate_links'] = 'F�rkorta l�nkar';
$lang['Format_truncate_links_explain'] = 'L�nkar skrivs om, t ex \'www.mxbb-portal...\'';

$lang['Format_image_resize'] = 'Skala om bilder';
$lang['Format_image_resize_explain'] = 'Bilder omskalas till denna bredd (pixlar)';

//
// Notifications
//
$lang['Notifications_title'] = 'P�minnelser';

$lang['Notify'] = 'Informera admin via: ';
$lang['Notify_explain'] = 'Best�m p� vilket s�tt admin skall bli informerad om nya/redigerade artiklar';
$lang['PM'] = 'PM';

$lang['Notify_group'] = 'och till grupp: ';
$lang['Notify_group_explain'] = 'Informera dessutom medlemmarna i denna grupp.';

//
//Java script messages and php errors
//
$lang['Cat_name_missing'] = 'Fyll i kategorinamnf�ltet';
$lang['Missing_field'] = 'Fyll i alla f�lt som kr�vs';
$lang['Link_same_cat'] = 'You can\'t move the links to the same deleted category.';
$lang['Link_move_cat'] = 'You can\'t move the sub category to the same deleted category.';
$lang['Cat_conflict'] = 'Du kan inte ha en kategori utan l�nkar i en annan kateogri utan l�nkar';
$lang['Cat_id_missing'] = 'V�lj en kategori';

$lang['Need_validation'] = 'Godk�nn l�nkar?';
?>
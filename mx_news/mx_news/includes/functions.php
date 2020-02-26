<?php
/**
*
* @package MX-Publisher Module - mx_news
* @version $Id: functions.php,v 1.8 2008/07/15 22:06:18 jonohlsson Exp $
* @copyright (c) 2002-2006 [Jon Ohlsson, Mohd Basri, wGEric, PHP Arena, pafileDB, CRLin] MX-Publisher Project Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
*
*/

if( !defined('IN_PORTAL') )
{
	die("Hacking attempt");
}

/**
 * mx_news_functions.
 *
 * This class is used for general mx_news handling
 *
 * @access public
 * @author Jon Ohlsson
 *
 */
class mx_news_functions
{
	/**
	 * This class is used for general mx_news handling
	 *
	 * @param unknown_type $config_name
	 * @param unknown_type $config_value
	 */
	function set_config( $config_name, $config_value )
	{
		global $mx_news_cache, $db, $mx_news_config;

		$sql = "UPDATE " . MX_NEWS_CONFIG_TABLE . " SET
			config_value = '" . str_replace( "\'", "''", $config_value ) . "'
			WHERE config_name = '$config_name'";
		if ( !$db->sql_query( $sql ) )
		{
			mx_message_die( GENERAL_ERROR, "Failed to update mx_news configuration for $config_name", "", __LINE__, __FILE__, $sql );
		}

		if ( !$db->sql_affectedrows() && !isset( $mx_news_config[$config_name] ) )
		{
			$sql = 'INSERT INTO ' . MX_NEWS_CONFIG_TABLE . " (config_name, config_value)
				VALUES ('$config_name', '" . str_replace( "\'", "''", $config_value ) . "')";

			if ( !$db->sql_query( $sql ) )
			{
				mx_message_die( GENERAL_ERROR, "Failed to update mx_news configuration for $config_name", "", __LINE__, __FILE__, $sql );
			}
		}

		$mx_news_config[$config_name] = $config_value;
		$mx_news_cache->put( 'config', $mx_news_config );
	}

	function mx_news_config()
	{
		global $db;

		$sql = "SELECT *
			FROM " . MX_NEWS_CONFIG_TABLE;

		if ( !( $result = $db->sql_query( $sql ) ) )
		{
			mx_message_die( GENERAL_ERROR, 'Couldnt query mx_news configuration', '', __LINE__, __FILE__, $sql );
		}

		while ( $row = $db->sql_fetchrow( $result ) )
		{
			$mx_news_config[$row['config_name']] = trim( $row['config_value'] );
		}

		$db->sql_freeresult( $result );

		return ( $mx_news_config );
	}

	/**
	 * encode_lang
	 * Developed by FlorinCB aka orynider for MXP-CMS 3.0.0-BETA
	 * $default_lang = $mxp_translator->encode_lang($config['default_lang']);
	 *
	 * @param unknown_type $lang
	 * @return unknown
	 */
	function encode_lang($displayname, 'language')
	{
			if (PORTAL_BACKEND == 'phpbb2')
			{
				return $displayname;
			}
			else
			{
				//Str replace and upper case of language name just to be certain
				$lang = strtoupper(str_replace(array(" ","_"), "_", $displayname)), 
			}
			
			switch($lang)
			{
				case 'AFAR':
					$lang_iso = 'aa';
				break;
				case 'ABKHAZIAN':
					$lang_iso = 'ab';
				break;
				case 'AVESTAN':
					$lang_iso = 'ae';
				break;
				case 'AFRIKAANS':
					$lang_iso = 'af';
				break;
				case 'AKAN':
					$lang_iso = 'ak';
				break;
				case 'AMHARIC':
					$lang_iso = 'am';
				break;
				case 'ARAGONESE':
					$lang_iso = 'an';
				break;
				case 'ARABIC':
					$lang_iso = 'ar';
				break;
				case 'ASSAMESE':
					$lang_iso = 'as';
				break;
				case 'AVARIC':
					$lang_iso = 'av';
				break;
				case 'AYMARA':
					$lang_iso = 'ay';
				break;
				case 'AZERBAIJANI':
					$lang_iso = 'az';
				break;
				case 'BASHKIR':
					$lang_iso = 'ba';
				break;
				case 'BELARUSIAN':
					$lang_iso = 'be';
				break;
				case 'BULGARIAN':
					$lang_iso = 'bg';
				break;
				case 'BIHARI':
					$lang_iso = 'bh';
				break;
				case 'BISLAMA':
					$lang_iso = 'bi';
				break;
				case 'BAMBARA':
					$lang_iso = 'bm';
				break;
				case 'BENGALI':
					$lang_iso = 'bn';
				break;
				case 'TIBETAN':
					$lang_iso = 'bo';
				break;
				case 'BRETON':
					$lang_iso = 'br';
				break;
				case 'BOSNIAN':
					$lang_iso = 'bs';
				break;
				case 'CATALAN':
					$lang_iso = 'ca';
				break;
				case 'CHECHEN':
					$lang_iso = 'ce';
				break;
				case 'CHAMORRO':
					$lang_iso = 'ch';
				break;
				case 'CORSICAN':
					$lang_iso = 'co';
				break;
				case 'CREE':
					$lang_iso = 'cr';
				break;
				case 'CZECH':
					$lang_iso = 'cs';
				break;
				case 'SLAVONIC':
					$lang_iso = 'cu';
				break;
				case 'CHUVASH':
					$lang_iso = 'cv';
				break;
				case 'WELSH_CYMRAEG':
					$lang_iso = 'cy';
				break;
				case 'DANISH':
					$lang_iso = 'da';
				break;
				case 'GERMAN':
					$lang_iso = 'de';
				break;
				case 'DIVEHI':
					$lang_iso = 'dv';
				break;
				case 'DZONGKHA':
					$lang_iso = 'dz';
				break;
				case 'EWE':
					$lang_iso = 'ee';
				break;
				case 'GREEK':
					$lang_iso = 'el';
				break;
				case 'HEBREW':
					$lang_iso = 'he';
				break;
				case 'ENGLISH':
					$lang_iso = 'en';
				break;
				case 'ENGLISH_US':
					$lang_iso = 'en_us';
				break;
				case 'ESPERANTO':
					$lang_iso = 'eo';
				break;
				case 'SPANISH':
					$lang_iso = 'es';
				break;
				case 'ESTONIAN':
					$lang_iso = 'et';
				break;
				case 'BASQUE':
					$lang_iso = 'eu';
				break;
				case 'PERSIAN':
					$lang_iso = 'fa';
				break;
				case 'FULAH':
					$lang_iso = 'ff';
				break;
				case 'FINNISH':
					$lang_iso = 'fi';
				break;
				case 'FIJIAN':
					$lang_iso = 'fj';
				break;
				case 'FAROESE':
					$lang_iso = 'fo';
				break;
				case 'FRENCH':
					$lang_iso = 'fr';
				break;
				case 'FRISIAN':
					$lang_iso = 'fy';
				break;
				case 'IRISH':
					$lang_iso = 'ga';
				break;
				case 'SCOTTISH':
					$lang_iso = 'gd';
				break;
				case 'GALICIAN':
					$lang_iso = 'gl';
				break;
				case 'GUARANI':
					$lang_iso = 'gn';
				break;
				case 'GUJARATI':
					$lang_iso = 'gu';
				break;
				case 'MANX':
					$lang_iso = 'gv';
				break;
				case 'HAUSA':
					$lang_iso = 'ha';
				break;
				case 'HEBREW':
					$lang_iso = 'he';
				break;
				case 'HINDI':
					$lang_iso = 'hi';
				break;
				case 'HIRI_MOTU':
					$lang_iso = 'ho';
				break;
				case 'CROATIAN':
					$lang_iso = 'hr';
				break;
				case 'HAITIAN':
					$lang_iso = 'ht';
				break;
				case 'HUNGARIAN':
					$lang_iso = 'hu';
				break;
				case 'ARMENIAN':
					$lang_iso = 'hy';
				break;
				case 'HERERO':
					$lang_iso = 'hz';
				break;
				case 'INTERLINGUA':
					$lang_iso = 'ia';
				break;
				case 'INDONESIAN':
					$lang_iso = 'id';
				break;
				case 'INTERLINGUE':
					$lang_iso = 'ie';
				break;
				case 'IGBO':
					$lang_iso = 'ig';
				break;
				case 'SICHUAN_YI':
					$lang_iso = 'ii';
				break;
				case 'INUPIAQ':
					$lang_iso = 'ik';
				break;
				case 'IDO':
					$lang_iso = 'io';
				break;
				case 'ICELANDIC':
					$lang_iso = 'is';
				break;
				case 'ITALIAN':
					$lang_iso = 'it';
				break;
				case 'INUKTITUT':
					$lang_iso = 'iu';
				break;
				case 'JAPANESE':
					$lang_iso = 'ja';
				break;
				case 'JAVANESE':
					$lang_iso = 'jv';
				break;
				case 'GEORGIAN':
					$lang_iso = 'ka';
				break;
				case 'KONGO':
					$lang_iso = 'kg';
				break;
				case 'KIKUYU':
					$lang_iso = 'ki';
				break;
				case 'KWANYAMA':
					$lang_iso = 'kj';
				break;
				case 'KAZAKH':
					$lang_iso = 'kk';
				break;
				case 'KALAALLISUT':
					$lang_iso = 'kl';
				break;
				case 'KHMER':
					$lang_iso = 'km';
				break;
				case 'KANNADA':
					$lang_iso = 'kn';
				break;
				case 'KOREAN':
					$lang_iso = 'ko';
				break;
				case 'KANURI':
					$lang_iso = 'kr';
				break;
				case 'KASHMIRI':
					$lang_iso = 'ks';
				break;
				case 'KURDISH':
					$lang_iso = 'ku';
				break;
				case 'KOMI':
					$lang_iso = 'kv';
				break;
				case 'CORNISH_KERNEWEK':
					$lang_iso = 'kw';
				break;
				case 'KIRGHIZ':
					$lang_iso = 'ky';
				break;
				case 'LATIN':
					$lang_iso = 'la';
				break;
				case 'LUXEMBOURGISH':
					$lang_iso = 'lb';
				break;
				case 'GANDA':
					$lang_iso = 'lg';
				break;
				case 'LIMBURGISH':
					$lang_iso = 'li';
				break;
				case 'LINGALA':
					$lang_iso = 'ln';
				break;
				case 'LAO':
					$lang_iso = 'lo';
				break;
				case 'LITHUANIAN':
					$lang_iso = 'lt';
				break;
				case 'LUBA_KATANGA':
					$lang_iso = 'lu';
				break;
				case 'LATVIAN':
					$lang_iso = 'lv';
				break;
				case 'MALAGASY':
					$lang_iso = 'mg';
				break;
				case 'MARSHALLESE':
					$lang_iso = 'mh';
				break;
				case 'MAORI':
					$lang_iso = 'mi';
				break;
				case 'MACEDONIAN':
					$lang_iso = 'mk';
				break;
				case 'MALAYALAM':
					$lang_iso = 'ml';
				break;
				case 'MONGOLIAN':
					$lang_iso = 'mn';
				break;
				case 'MOLDAVIAN':
					$lang_iso = 'mo';
				break;
				case 'MARATHI':
					$lang_iso = 'mr';
				break;
				case 'MALAY':
					$lang_iso = 'ms';
				break;
				case 'MALTESE':
					$lang_iso = 'mt';
				break;
				case 'BURMESE':
					$lang_iso = 'my';
				break;
				case 'NAURUAN':
					$lang_iso = 'na';
				break;
				case 'NORWEGIAN':
					$lang_iso = 'nb';
				break;
				case 'NDEBELE':
					$lang_iso = 'nd';
				break;
				case 'NEPALI':
					$lang_iso = 'ne';
				break;
				case 'NDONGA':
					$lang_iso = 'ng';
				break;
				case 'DUTCH':
					$lang_iso = 'nl';
				break;
				case 'NORWEGIAN_NYNORSK':
					$lang_iso = 'nn';
				break;
				case 'NORWEGIAN':
					$lang_iso = 'no';
				break;
				case 'SOUTHERN_NDEBELE':
					$lang_iso = 'nr';
				break;
				case 'NAVAJO':
					$lang_iso = 'nv';
				break;
				case 'CHICHEWA':
					$lang_iso = 'ny';
				break;
				case 'OCCITAN':
					$lang_iso = 'oc';
				break;
				case 'OJIBWA':
					$lang_iso = 'oj';
				break;
				case 'OROMO':
					$lang_iso = 'om';
				break;
				case 'ORIYA':
					$lang_iso = 'or';
				break;
				case 'OSSETIAN':
					$lang_iso = 'os';
				break;
				case 'PUNJABI':
				case 'PANJABI':
				case 'GURMIKI':
					$lang_iso = 'pa';
				break;
				case 'PALI':
					$lang_iso = 'pi';
				break;
				case 'POLISH':
					$lang_iso = 'pl';
				break;
				case 'PASHTO':
					$lang_iso = 'ps';
				break;
				case 'PORTUGUESE':
					$lang_iso = 'pt';
				break;
				case 'PORTUGUESE_BRASIL':
					$lang_iso = 'pt_br';
				break;
				case 'QUECHUA':
					$lang_iso = 'qu';
				break;
				case 'ROMANSH':
					$lang_iso = 'rm';
				break;
				case 'KIRUNDI':
					$lang_iso = 'rn';
				break;
				case 'ROMANIAN':
					$lang_iso = 'ro';
				break;
				case 'RUSSIAN':
					$lang_iso = 'ru';
				break;
				case 'KINYARWANDA':
					$lang_iso = 'rw';
				break;
				case 'SANSKRIT':
					$lang_iso = 'sa';
				break;
				case 'SARDINIAN':
					$lang_iso = 'sc';
				break;
				case 'SINDHI':
					$lang_iso = 'sd';
				break;
				case 'NORTHERN_SAMI':
					$lang_iso = 'se';
				break;
				case 'SANGO':
					$lang_iso = 'sg';
				break;
				case 'SERBO_CROATIAN':
					$lang_iso = 'sh';
				break;
				case 'SINHALA':
					$lang_iso = 'si';
				break;
				case 'SLOVAK':
					$lang_iso = 'sk';
				break;
				case 'SLOVENIAN':
					$lang_iso = 'sl';
				break;
				case 'SAMOAN':
					$lang_iso = 'sm';
				break;
				case 'SHONA':
					$lang_iso = 'sn';
				break;
				case 'SOMALI':
					$lang_iso = 'so';
				break;
				case 'ALBANIAN':
					$lang_iso = 'sq';
				break;
				case 'SERBIAN':
					$lang_iso = 'sr';
				break;
				case 'SWATI':
					$lang_iso = 'ss';
				break;
				case 'SOTHO':
					$lang_iso = 'st';
				break;
				case 'SUNDANESE':
					$lang_iso = 'su';
				break;
				case 'SWEDISH':
					$lang_iso = 'sv';
				break;
				case 'SWAHILI':
					$lang_iso = 'sw';
				break;
				case 'TAMIL':
					$lang_iso = 'ta';
				break;
				case 'TELUGU':
					$lang_iso = 'te';
				break;
				case 'TAJIK':
					$lang_iso = 'tg';
				break;
				case 'THAI':
					$lang_iso = 'th';
				break;
				case 'TIGRINYA':
					$lang_iso = 'ti';
				break;
				case 'TURKMEN':
					$lang_iso = 'tk';
				break;
				case 'TAGALOG':
					$lang_iso = 'tl';
				break;
				case 'TSWANA':
					$lang_iso = 'tn';
				break;
				case 'TONGA':
					$lang_iso = 'to';
				break;
				case 'TURKISH':
					$lang_iso = 'tr';
				break;
				case 'TSONGA':
					$lang_iso = 'ts';
				break;
				case 'TATAR':
					$lang_iso = 'tt';
				break;
				case 'TWI':
					$lang_iso = 'tw';
				break;
				case 'TAHITIAN':
					$lang_iso = 'ty';
				break;
				case 'UIGHUR':
					$lang_iso = 'ug';
				break;
				case 'UKRAINIAN':
					$lang_iso = 'uk';
				break;
				case 'URDU':
					$lang_iso = 'ur';
				break;
				case 'UZBEK':
					$lang_iso = 'uz';
				break;
				case 'VENDA':
					$lang_iso = 've';
				break;
				case 'VIETNAMESE':
					$lang_iso = 'vi';
				break;
				case 'VOLAPUK':
					$lang_iso = 'vo';
				break;
				case 'WALLOON':
					$lang_iso = 'wa';
				break;
				case 'WOLOF':
					$lang_iso = 'wo';
				break;
				case 'XHOSA':
					$lang_iso = 'xh';
				break;
				case 'YIDDISH':
					$lang_iso = 'yi';
				break;
				case 'YORUBA':
					$lang_iso = 'yo';
				break;
				case 'ZHUANG':
					$lang_iso = 'za';
				break;
				case 'CHINESE':
					$lang_iso = 'zh';
				break;
				case 'CHINESE_SIMPLIFIED':
					$lang_iso = 'zh_cmn_hans';
				break;
				case 'CHINESE_TRADITIONAL':
					$lang_iso = 'zh_cmn_hant';
				break;
				case 'ZULU':
					$lang_iso = 'zu';
				break;
				default:
					$lang_iso = (strlen($lang) > 2) ? substr($lang, 0, 2) : $lang;
				break;
			}
		return $lang_name;
	}

	// since that I can't use the original function with new template system
	// I just copy it and chagne it

	function sql_query_limit( $query, $total, $offset = 0 )
	{
		global $db;

		$query .= ' LIMIT ' . ( ( !empty( $offset ) ) ? $offset . ', ' . $total : $total );
		return $db->sql_query( $query );
	}
	
	/**
	* List all countries for witch languages files are installed 
	* and multilangual files uploaded
	* $this->countries = $this->get_countries()
	* Credit: 
	* Based on phpBB or MXP function language_select()
	* Ported by FlorinCB aka orynider@users.sourceforge.net
	 *
	 * @param string $default
	 * @param string $select_name
	 * @param string $dirname
	 * @return string (html)
	 */
	function get_countries($default, $select_name = "en", $dirname="language")
	{
		global $phpEx, $mx_root_path, $mx_user;

		// get all countries installed
		$dir = opendir($mx_root_path . $dirname);
		$countries = array();
		while ( $file = readdir($dir) )
		{
			if (preg_match('#^lang_#i', $file) && !is_file(@realpath($mx_root_path . $dirname . '/' . $file)) && !is_link(@realpath($mx_root_path . $dirname . '/' . $file)))
			{
				$filename = trim(str_replace('lang_', '', $file));
				$displayname = preg_replace("/^(.*?)_(.*)$/", "\\1 [ \\2 ]", $filename);
				$displayname = preg_replace("/\[(.*?)_(.*)\]/", "[ \\1 - \\2 ]", $displayname);
				$countries[$file] = ucfirst($displayname);
				$lang_code = $this->encode_lang($displayname, 'language');
			}
		}

		@closedir($dir);

		@asort($countries);
		@reset($countries);

		$lang_select = $select_name;
		while ( list($displayname, $filename) = @each($countries) )
		{
			$lang_select .= . ucwords($displayname);
		}
		return $lang_select;
	}
	/**
	 * page header.
	 *
	 */
	function page_header()
	{
		global $lang, $mx_user, $mx_news_config, $images, $template;

		//overwrite some phpBB3 vars
		$images['mx_news_icon_minipost'] = $mx_user->img('icon_post_reply', 'REPLY_POST', false, '', 'src');		
		$images['mx_news_icon_edit'] = $mx_user->img('icon_post_edit', 'EDIT_POST', false, '', 'src');
		$images['mx_news_icon_delpost'] = $mx_user->img('icon_post_delete', 'DELETE_POST', false, '', 'src');
		
		$template->assign_vars( array(
			'L_NEWS_TITLE' => $lang['mx_news_title'],
			'L_NEWS_DISABLE' => $lang['mx_news_disable'],
			'L_CLICK_HERE' => $lang['Read_full_link'],
			'L_AUTHOR' => $lang['Submiter'],
			'L_EDIT' => $lang['Comment_edit'],
			'L_DELETE' => $lang['Comment_delete'],
			'L_REPLY' => $lang['Comment_add'],

			'TRANSLATE_DEFAULT_LANG'	=> (isset($mx_news_config['translate_default_lang'])) ? $mx_news_config['translate_default_lang'] : $mx_user->data['default_lang'],
			'TRANSLATE_CHOICE_LANG'		=> (isset($mx_news_config['translate_choice_lang'])) ? $mx_news_config['translate_choice_lang'] : 'ro,fr,it,de,ru,el,hu,he',

			'DELETE_IMG' => $images['mx_news_icon_delpost'],
			'EDIT_IMG' => $images['mx_news_icon_edit'],
			'REPLY_IMG' => $images['mx_news_icon_minipost'],

			// Buttons
			//'B_REPLY_IMG' => $mx_user->create_button('mx_news_icon_minipost', $lang['Comment_add'], $this->this_mxurl()),
			//'B_DELETE_IMG' => $mx_user->create_button('mx_news_icon_delpost', $lang['Comment_delete'], "javascript:delete_item('". mx_append_sid( $this->this_mxurl()) . "')"),
			//'B_EDIT_IMG' => $mx_user->create_button('mx_news_icon_edit', $lang['Comment_edit'], mx_append_sid($this->this_mxurl()))
		));
	}

	/**
	 * page footer.
	 *
	 */
	function page_footer()
	{
		global $mx_news_cache;
		$mx_news_cache->unload();
	}

	/**
	 * Since we must a have scalar identity, with both block_id and virtual_id be create a composite.
	 * The first 4 digits are the block_id, the rest are the virtual id
	 *
	 * @param unknown_type $block_id
	 */
	function generate_virtualId($block_id)
	{
		global $mx_request_vars;

		if ($mx_request_vars->is_request('virtual') && $mx_request_vars->request('virtual', MX_TYPE_INT, '0') > 0)
		{
			$key = -1000 - $block_id; // We support 8999 virtual blocks and unlimited virtual ids
			return $key . $mx_request_vars->request('virtual', MX_TYPE_INT, '0');
		}
		return $block_id;
	}
}

/**
 * mx_news_notification.
 *
 * This class extends general mx_notification class
 *
 * // MODE: MX_PM_MODE/MX_MAIL_MODE, $id: get all file/article data for this id
 * $mx_notification->init($mode, $id); // MODE: MX_PM_MODE/MX_MAIL_MODE
 *
 * // MODE: MX_PM_MODE/MX_MAIL_MODE, ACTION: MX_NEW_NOTIFICATION/MX_EDITED_NOTIFICATION/MX_APPROVED_NOTIFICATION/MX_UNAPPROVED_NOTIFICATION
 * $mx_notification->notify( $mode = MX_PM_MODE, $action = MX_NEW_NOTIFICATION, $to_id, $from_id, $subject, $message, $html_on, $bbcode_on, $smilies_on )
 *
 * @access public
 * @author Jon Ohlsson
 */
class mx_news_notification extends mx_notification
{
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $item_id
	 */
	function init( $item_id = 0, $allow_comment_wysiwyg = 0)
	{
		global $db, $lang, $module_root_path, $phpbb_root_path, $mx_root_path, $phpEx, $userdata, $mx_news;

			// =======================================================
			// item id is not set, give him/her a nice error message
			// =======================================================
			if (empty($item_id))
			{
				mx_message_die(GENERAL_ERROR, 'Bad Init pars');
			}

			unset($this->langs);

			//
			// Build up generic lang keys
			//
			$this->langs['item_not_exist'] = $lang['Link_not_exist'];
			$this->langs['module_title'] = $lang['mx_news_prefix'];

			$this->langs['notify_subject_new'] = $lang['mx_news_notify_subject_new'];
			$this->langs['notify_subject_edited'] = $lang['mx_news_notify_subject_edited'];
			$this->langs['notify_subject_approved'] = $lang['mx_news_notify_subject_approved'];
			$this->langs['notify_subject_unapproved'] = $lang['mx_news_notify_subject_unapproved'];
			$this->langs['notify_subject_deleted'] = $lang['mx_news_notify_subject_deleted'];

			$this->langs['notify_new_body'] = $lang['mx_news_notify_new_body'];
			$this->langs['notify_edited_body'] = $lang['mx_news_notify_edited_body'];
			$this->langs['notify_approved_body'] = $lang['mx_news_notify_approved_body'];
			$this->langs['notify_unapproved_body'] = $lang['mx_news_notify_unapproved_body'];
			$this->langs['notify_deleted_body'] = $lang['mx_news_notify_deleted_body'];

			$this->langs['item_title'] = $lang['Link'];
			$this->langs['author'] = $lang['Submiter'];
			$this->langs['item_description'] = $lang['Desc'];
			$this->langs['item_type'] = '';
			$this->langs['category'] = $lang['Sitecat'];
			$this->langs['read_full_item'] = $lang['Read_full_link'];
			$this->langs['edited_item_info'] = $lang['Edited_Link_info'];

			unset($this->data);

			//
			// File data
			//
			$this->data['item_id'] = $item_id;
			$this->data['item_title'] = $item_data['link_name'];
			$this->data['item_desc'] = $item_data['link_longdesc'];


			//
			// Category data
			//
			$this->data['item_category_id'] = $item_data['cat_id'];
			$this->data['item_category_name'] = $item_data['cat_name'];

			//
			// File author
			//
			$this->data['item_author_id'] = $item_data['user_id'];
			$this->data['item_author'] = ( $item_data['user_id'] != ANONYMOUS ) ? $item_data['username'] : $lang['Guest'];

			//
			// File editor
			//
			$this->data['item_editor_id'] = $userdata['user_id'];
			$this->data['item_editor'] = ( $userdata['user_id'] != '-1' ) ? $userdata['username'] : $lang['Guest'];

			$mx_root_path_tmp = $mx_root_path; // Stupid workaround, since phpbb posts need full paths.
			$mx_root_path = '';
			$this->temp_url = PORTAL_URL . $mx_news->this_mxurl("action=" . "main&link_id=" . $this->data['item_id'], false, true);
			$mx_root_path = $mx_root_path_tmp;

			//
			// Toggles
			//
			$this->allow_comment_wysiwyg = $allow_comment_wysiwyg;
	}
}
?>
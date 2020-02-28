<?php
/**
*
* @package MX-Publisher Module - mx_news
* @version $Id: mx_news_rss_news.php,v 1.5 2008/06/03 20:12:40 orynider Exp $
* @copyright (c) 2002-2020 [FlorinCB, Jon Ohlsson, Mohd Basri, wGEric, PHP Arena, pafileDB, CRLin] MX-Publisher Development Team
* @license http://opensource.org/licenses/gpl-license.php GNU General Public License v2
*
*/

if ( !defined( 'IN_PORTAL' ) )
{
	die( "Hacking attempt" );
}

/**
 * Enter description here...
 *
 */
class mx_news_rss_news extends mx_news_public
{
	/**
	 * Enter description here...
	 *
	 * @param unknown_type $action
	 */
	function main( $action )
	{
		global $template, $mx_news_functions, $lang, $board_config, $phpEx, $mx_news_config, $db, $images, $userdata;
		global $html_entities_match, $html_entities_replace, $unhtml_specialchars_match, $unhtml_specialchars_replace;
		global $mx_root_path, $module_root_path, $phpbb_root_path, $is_block, $mx_request_vars;
		global $mx_block, $theme, $phpBB2, $phpBB3;
		
		//
		// Go full page
		//
		$mx_block->full_page = true;

		//
		// Request vars
		//
		$cid = $mx_request_vars->request('cid', MX_TYPE_INT, 1);

		$item_id = $this->block_id;
		$virtual_id = $mx_request_vars->request('virtual', MX_TYPE_INT, 0);

		$delete = $mx_request_vars->request('delete', MX_TYPE_NO_TAGS, '');
		$submit = $mx_request_vars->is_request('submit');
		$preview = $mx_request_vars->is_request('preview');

		$item_data = array();
		$item_data['link_catid'] = $item_id;
		$item_data['link_id'] = $item_id;
		$item_data['topic_id'] = $item_id;

		// XML and nocaching headers
		header ('Cache-Control: private, pre-check=0, post-check=0, max-age=0');
		header ('Expires: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
		header ('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
		header ('Content-Type: text/xml');

		$rss_time = $phpBB2->create_date('D, d M Y H:i:s T', time(), $board_config['board_timezone']);

		// Create main board url (some code borrowed from functions_post.php)
		$script_name = preg_replace('/^\/?(.*?)\/?$/', '\1', trim($board_config['script_path']));
		$server_name = trim($board_config['server_name']);
		$server_protocol = ( $board_config['cookie_secure'] ) ? 'https://' : 'http://';
		$server_port = ( $board_config['server_port'] <> 80 ) ? ':' . trim($board_config['server_port']) . '/' : '/';
		$site_name = strip_tags($board_config['sitename']);
		$site_description = strip_tags($board_config['site_desc']);

		// Change below to point to your rss-logo
		$logo = 'logo.gif';
		// Change above to point to your rss-logo

		$images['logo_url'] = PORTAL_URL . 'templates/' . $theme['template_name'] . '/images/' . $logo;

		$site_url = mx_append_sid(PORTAL_URL);
		$news_url = mx_append_sid($this->this_mxurl());
		/* */
		$rss = '<?xml version="1.0" encoding="UTF-8" ?>
		<!-- generator="MXP NEWS - Module, version 1.3.x (GNU-GPL v2.0)" -->
		<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/"
				 xmlns:wfw="http://wellformedweb.org/CommentAPI/"
				 xmlns:dc="http://purl.org/dc/elements/1.1/">
		<channel>
			<title>' . $this->make_xml_compatible($board_config['sitename']) . ' News Manager Sindication (XXX needs registering)</title>
		 	<link>' . $news_url . '</link>
			<description>' . $this->make_xml_compatible($board_config['site_desc']) . '</description>
			<language>' . substr($board_config['default_lang'], 0, 2) . '</language>
			<copyright>This may be copyrighted (c) by ' . $this->make_xml_compatible($board_config['sitename']) . '</copyright>
			<managingEditor>' . $board_config['board_email'] . '</managingEditor>
			<webMaster>' . $board_config['board_email'] . '</webMaster>
			<pubDate>'. $rss_time .'</pubDate>
			<lastBuildDate>'. $rss_time .'</lastBuildDate>
			<docs>http://backend.userland.com/rss</docs>  
			<generator>MXP Module - News Manager, version 1.0.x</generator>
			<image> 
				<title>' . $this->make_xml_compatible($board_config['sitename']) . '</title>
				<link>' . $news_url . '</link>
				<description>' . $this->make_xml_compatible($board_config['site_desc']) . '</description>
				<url>' . $images['logo_url'] . '</url>
			</image>  
		';
		
		if ( $this->comments[$item_id]['internal_comments'] )
		{
			//
			// Query internal comment to edit
			//
			$sql = 'SELECT c.*, u.*
					FROM ' . MX_NEWS_COMMENTS_TABLE . ' AS c
						LEFT JOIN ' . USERS_TABLE . " AS u ON c.poster_id = u.user_id
					WHERE c.block_id = '" . $item_id . "'";

			$comment_arg_title = 'comments_title';
			$comment_arg_message = 'comments_text';
			$comment_arg_bbcode_uid = 'comment_bbcode_uid';
		}
		else
		{
			//
			// Query internal comment to edit
			// Note: cid = post_id
			//
			$sql = "SELECT u.username, u.user_id, u.user_posts, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_sig_bbcode_uid, u.user_avatar, u.user_avatar_type, u.user_allowavatar, u.user_allowsmile, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
				FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
				WHERE pt.post_id = p.post_id
					AND u.user_id = p.poster_id";

			$comment_arg_title = 'post_subject';
			$comment_arg_message = 'post_text';
			$comment_arg_bbcode_uid = 'bbcode_uid';
		}

		if ( !( $result = $db->sql_query( $sql ) ) )
		{
			mx_message_die( GENERAL_ERROR, 'Couldnt select comments', '', __LINE__, __FILE__, $sql );
		}

		//$comment_row = $db->sql_fetchrow( $result );
		$topics = $db->sql_fetchrowset($result);
		$total_topics = count($topics);
		
		$LastPostTime = 0;
		if ($total_topics == 0)
		{
		    die("No news found");
		}
		else
		{
			
			// $topics contains all interesting data
			for ($i = 0; $i < $total_topics; $i++)
			{
				if ( $this->comments[$item_id]['internal_comments'] )
				{
					//
					// Query internal comment to edit
					//
					$sql = 'SELECT c.*, u.*
						FROM ' . MX_NEWS_COMMENTS_TABLE . ' AS c
							LEFT JOIN ' . USERS_TABLE . " AS u ON c.poster_id = u.user_id
						WHERE c.block_id = '" . $item_id . "'
						AND c.comments_id = '" . $topics[$i]['comments_id']  . "'";
					
					$comment_arg_title = 'comments_title';
					$comment_arg_message = 'comments_text';
					$comment_arg_bbcode_uid = 'comment_bbcode_uid';
				}
				else
				{
					//
					// Query internal comment to edit
					// Note: cid = post_id
					//
					$sql = "SELECT u.username, u.user_id, u.user_posts, u.user_from, u.user_website, u.user_email, u.user_icq, u.user_aim, u.user_yim, u.user_regdate, u.user_msnm, u.user_viewemail, u.user_rank, u.user_sig, u.user_sig_bbcode_uid, u.user_avatar, u.user_avatar_type, u.user_allowavatar, u.user_allowsmile, p.*,  pt.post_text, pt.post_subject, pt.bbcode_uid
						FROM " . POSTS_TABLE . " p, " . USERS_TABLE . " u, " . POSTS_TEXT_TABLE . " pt
						WHERE pt.post_id = p.post_id
							AND u.user_id = p.poster_id
							AND p.post_id = '" . $topics[$i]['post_id']  . "'";
					
					$comment_arg_title = 'post_subject';
					$comment_arg_message = 'post_text';
					$comment_arg_bbcode_uid = 'bbcode_uid';
				}
				
				if ( !( $result = $db->sql_query( $sql ) ) )
				{
					mx_message_die( GENERAL_ERROR, 'Couldnt select comments', '', __LINE__, __FILE__, $sql );
				}
				$comment_row = $db->sql_fetchrow( $result );
			}

			$comment_title = $preview || isset($_POST['subject']) ? $_POST['subject'] : $comment_row[$comment_arg_title];
			$comment_body = $preview || isset($_POST['message']) ? $_POST['message'] : $comment_row[$comment_arg_message];
			$bbcode_uid = $preview ? '' : $comment_row[$comment_arg_bbcode_uid];
			
			//
			// wysiwyg
			//
			if ( $mx_news_config['allow_comment_wysiwyg'] && file_exists( $mx_root_path . $mx_news_config['wysiwyg_path'] . 'tinymce/jscripts/tiny_mce/blank.htm' ))
			{
				//
				// Toggles
				//
				$allow_wysiwyg = true;
				$bbcode_on = false;
				$html_on = true;
				$smilies_on = false;
				$links_on = false;
				$images_on = false;

				$langcode = mx_get_langcode();

				if ($mx_block->auth_mod)
	         	{
					$template->assign_block_vars( "tinyMCE_admin", array(
						'PATH' => $mx_root_path,
						'LANG' => !empty($langcode) ? $langcode : $_SERVER['HTTP_ACCEPT_LANGUAGE'],
						'TEMPLATE' => $mx_root_path . 'templates/'. $theme['template_name'] . '/' . $theme['head_stylesheet']
					));
	         	}
	         	else
	         	{
					$template->assign_block_vars( "tinyMCE", array(
						'PATH' => $mx_root_path,
						'LANG' => !empty($langcode) ? $langcode : $_SERVER['HTTP_ACCEPT_LANGUAGE'],
						'TEMPLATE' => $mx_root_path . 'templates/'. $theme['template_name'] . '/' . $theme['head_stylesheet']
					));
	         	}
			}
			else
			{
				//
				// Toggles
				//
				$enclosure = '';
				$allow_wysiwyg = false;
				$html_on = ( $mx_news_config['allow_comment_html'] ) ? true : 0;
				$bbcode_on = ( $mx_news_config['allow_comment_bbcode'] ) ? true : 0;
				$smilies_on = ( $mx_news_config['allow_comment_smilies'] ) ? true : 0;
				$links_on = ( $mx_news_config['allow_comment_links'] ) ? true : 0;
				$images_on = ( $mx_news_config['allow_comment_images'] ) ? true : 0;

				$board_config['allow_html_tags'] = $mx_news_config['allowed_comment_html_tags'];

				if ($smilies_on)
				{
					$mx_news_functions->generate_smilies( 'inline', PAGE_POSTING );
				}
			}

			//
			// Instantiate the mx_text and mx_text_formatting classes
			//
			$mx_text = new mx_text();
			$mx_text->init($html_on, $bbcode_on, $smilies_on);

			$mx_text_formatting = new mx_text_formatting();

			//
			// Allow all html tags
			// Fix: Setting 'emtpy' enables all
			//
			$mx_text->allow_all_html_tags = $allow_wysiwyg;
			
			// =======================================================
			// Main
			// =======================================================
			$html_status = ( $html_on ) ? $lang['HTML_is_ON'] : $lang['HTML_is_OFF'];
			$bbcode_status = ( $bbcode_on ) ? $lang['BBCode_is_ON'] : $lang['BBCode_is_OFF'];
			$smilies_status = ( $smilies_on ) ? $lang['Smilies_are_ON'] : $lang['Smilies_are_OFF'];
			$links_status = ( $links_on ) ? $lang['Links_are_ON'] : $lang['Links_are_OFF'];
			$images_status = ( $images_on ) ? $lang['Images_are_ON'] : $lang['Images_are_OFF'];

			//
			// Decode for form editing
			//
			$comment_title = $this->make_xml_compatible($mx_text->decode_simple($comment_title));
			$comment_body = $mx_text->decode($comment_body, $bbcode_uid);
			

			$description_code = $lang['Message_body'] . ': ' . nl2br($comment_body);
			$description = $description_code;
			if (strlen($description) > 2000)
			{
				$description_encoded = '<div>' . substr($comment_body, 0, 1957) . '</div><br />'; 
			}
			else
			{
				$description_encoded = '<div>' . $description_code . '</div><div>&nbsp;</div><br />'; 
			}
			
			//
			// Output the data to the template
			//
			$rss .= '
			<item>
				<title>' . $comment_title . '</title>
				<link>' . $this->this_mxurl('mode=main&item_id=' . $item_id) . '</link>
				<description><![CDATA[' . $description_encoded .']]></description>
				<dc:creator>' . $topics[$i]['poster_id'] . '</dc:creator>
				<enclosure ' . $enclosure . ' />
				<comments>' . $this->u_more . '</comments>
				<guid>' . $this->this_mxurl() . '</guid>            
			</item>
			';
		}
		
		// Create RDF footer
		$rss .= '
		</channel>
		</rss>';

		// Discritics Replace
		$rss = str_replace("&auml;","ä",$rss);
		$rss = str_replace("&ouml;","ö",$rss);
		$rss = str_replace("&uuml;","ü",$rss);

		// Output the RDF
		echo($rss);
	}
}
?>
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
					$country_name = 'AFAR'; //Ethiopia
				break;
				
				case 'AFRICAN-AMERICAN_ENGLISH':
					$lang_iso = 'aae';
					$country_name = 'UNITED_STATES'; 
				break;

				case 'ABKHAZIAN':
					$lang_iso = 'ab';
					$country_name = 'ABKHAZIA';
				break;

				case 'ANGOLA':
					$lang_iso = 'ad';
					$country_name = 'ANGOLA';
				break;

				case 'AVESTAN':
					$lang_iso = 'ae';
					$country_name = 'UNITED_ARAB_EMIRATES'; //Persia
				break;

				case 'AFRIKAANS':
					$country_name = 'AFGHANISTAN'; // langs: pashto and dari
					$lang_iso = 'af'; // speakers: 6,855,082 - 13,4%
				break;

				case 'ENGLISH-CREOLE':
					$lang_iso = 'ag';
					$country_name = 'ANTIGUA_&AMP;_BARBUDA';
				break;
				
				case 'ANGUILLA':
					$lang_iso = 'ai';
					$country_name = 'ANGUILLA';
				break;
				
				case 'AROMANIAN':
					$lang_iso = 'aj';
					$country_name = 'Aromaya';
				break;
				
				case 'AKAN':
					$lang_iso = 'ak';
					$country_name = 'AKAN';
				break;

				case 'ALBANIAN':
					$lang_iso = 'al';
					$country_name = 'ALBANIA';
				break;

				case 'AMHARIC':
					$lang_iso = 'am';
					$country_name = 'ARMENIA';
				break;

				case 'ARAGONESE':
					$lang_iso = 'an';
					//$country_name = 'Andorra';
					$country_name = 'NETHERLAND_ANTILLES';
				break;
				
				case 'ANGOLIAN':
					$lang_iso = 'ao';
					$country_name = 'ANGOLA';
				break;
				
				case 'ANGIKA':
					$lang_iso = 'ap';
					$country_name = 'ANGA'; //India
				break;

				case 'ARABIC':
					$lang_iso = 'ar';
					$country_name = 'ARGENTINA';
				break;

				case 'ALGERIAN_ARABIC':
					$lang_iso = 'arq'; //known as Darja or Dziria in Algeria
					$country_name = 'ALGERIA';
				break;

				case 'MOROCCAN_ARABIC':
					$lang_iso = 'ary'; //known as Moroccan Arabic or Moroccan Darija or Algerian Saharan Arabic
					$country_name = 'MOROCCO';
				break;
				
				//jrb – Judeo-Arabic
				//yhd – Judeo-Iraqi Arabic
				//aju – Judeo-Moroccan Arabic
				//yud – Judeo-Tripolitanian Arabic
				//ajt – Judeo-Tunisian Arabic
				//jye – Judeo-Yemeni Arabic
				case 'JUDEO-ARABIC':
					$lang_iso = 'jrb';
					$country_name = 'JUDEA';
				break;
				
				case 'KABYLE':
					$lang_iso = 'kab'; //known as Kabyle (Tamazight)
					$country_name = 'ALGERIA';
				break;
				
				case 'aq':
					$lang_iso = 'aq';
					$country_name = 'ANTARCTICA';
				break;

				case 'ASSAMESE':
					$lang_iso = 'as';
					$country_name = 'AMERICAN_SAMOA';
				break;

				case 'GERMAN_AUSTRIA':
					$lang_iso = 'at';
					$country_name = 'AUSTRIA';
				break;

				case 'AVARIC':
					$lang_iso = 'av';
					$country_name = '';
				break;

				case 'AVARIAN_KHANATE':
					$lang_iso = 'av_da';
					$country_name = 'Daghestanian';
				break;

				case 'AYMARA':
					$lang_iso = 'ay';
					$country_name = 'AYMARA';
				break;

				case 'ARUBA':
					$lang_iso = 'aw';
					$country_name = 'ARUBA';
				break;

				case 'en_au':
					$lang_iso = 'au'; //
					$country_name = 'AUSTRALIA';
				break;

				case 'AZERBAIJANI':
					$lang_iso = 'az';
					$country_name = 'AZERBAIJAN';
				break;
				
				case 'FINNISH':
					$lang_iso = 'ax';
					$country_name = 'ÅLAND_ISLANDS';  //The Åland Islands or Åland (Swedish: Åland, IPA: [ˈoːland]; Finnish: Ahvenanmaa) is an archipelago province at the entrance to the Gulf of Bothnia in the Baltic Sea belonging to Finland.
				break;
				
				case 'BASHKIR':
					$lang_iso = 'ba'; //Baskortostán (Rusia)
					$country_name = 'BOSNIA_&AMP;_HERZEGOVINA'; //Bosnian, Croatian, Serbian
				break;
				
				//Bavarian (also known as Bavarian Austrian or Austro-Bavarian; Boarisch [ˈbɔɑrɪʃ] or Bairisch; 
				//German: Bairisch [ˈbaɪʁɪʃ] (About this soundlisten); Hungarian: bajor.
				case 'BAVARIAN':
					$lang_iso = 'bar';
					$country_name = 'BAVARIA'; //Germany
				break;
				
				case 'BARBADOS':
					$lang_iso = 'bb';
					$country_name = 'BARBADOS';
				break;

				case 'BANGLADESH':
					$lang_iso = 'bd';
					$country_name = 'BANGLADESH';
				break;

				case 'BELARUSIAN':
					$lang_iso = 'be';
					$country_name = 'BELGIUM';
				break;

				case 'BURKINA_FASO':
					$lang_iso = 'bf';
					$country_name = 'BURKINA_FASO';
				break;
				
				case 'BULGARIAN':
					$lang_iso = 'bg';
					$country_name = 'BULGARIA';
				break;
				case 'BIHARI':
					$lang_iso = 'bh';
				break;
				case 'BHOJPURI':
					$lang_iso = 'bh'; // Bihar (India) 
					$country_name = 'BAHRAIN'; // Mamlakat al-Ba?rayn (arabic)
				break;

				case 'BISLAMA':
					$lang_iso = 'bi';
					$country_name = 'BURUNDI';
				break;

				case 'BENIN':
					$lang_iso = 'bj';
					$country_name = 'BENIN';
				break;
				
				case 'BONAIRE':
					$lang_iso = 'bl';
					$country_name = 'BONAIRE';
				break;
				
				case 'BAMBARA':
					$lang_iso = 'bm';
					$country_name = 'Bermuda';
				break;

				case 'BENGALI':
					$country_name = 'BRUNEI';
					$lang_iso = 'bn';

				break;
				
				case 'TIBETAN':
					$lang_iso = 'bo';
					$country_name = 'BOLIVIA';
				break;
				
				case 'BRETON':
					$lang_iso = 'br';
					$country_name = 'BRAZIL'; //pt
				break;
				
				case 'BOSNIAN':
					$lang_iso = 'bs';
					$country_name = 'BAHAMAS';
				break;

				case 'BHUTAN':
					$lang_iso = 'bt';
					$country_name = 'Bhutan';
				break;

				case 'BOTSWANA':
					$lang_iso = 'bw';
					$country_name = 'BOTSWANA';
				break;

				case 'BELIZE':
					$lang_iso = 'bz';
					$country_name = 'BELIZE';
				break;

				case 'BELARUSIAN':
					$lang_iso = 'by';
					$country_name = 'Belarus';
				break;
				
				case 'CAMEROONIAN_PIDGIN_ENGLISH':
					$lang_iso = 'en_cm';
					$country_name = 'Cameroon';
				break;
				
				case 'CAMEROONIAN':
					$lang_iso = 'wes'; //Kamtok
					$country_name = 'CAMEROON'; //Wes Cos
				break;

				case 'CAMEROON':
					$lang_iso = 'cm';
					$country_name = 'CAMEROON';
				break;

				case 'CATALAN':
					$lang_iso = 'ca';
					$country_name = 'CANADA';
				break;
				
				case 'COA_A_COCOS':
					$lang_iso = 'cc'; //COA A Cocos dialect of Betawi Malay [ente (you) and ane (me)] and AU-English
					$country_name = 'COCOS_ISLANDS'; //CC 	Cocos (Keeling) Islands
				break;
				
				case 'CONGO_DEMOCRATIC_REPUBLIC':
					$lang_iso = 'cd';
					$country_name = 'CONGO_DEMOCRATIC_REPUBLIC';
				break;
				
				//нохчийн мотт
				case 'CHECHEN':
					$lang_iso = 'ce';
					$country_name = 'Chechenya';
				break;

				case 'CENTRAL_AFRICAN_REPUBLIC':
					$lang_iso = 'cf';
					$country_name = 'CENTRAL_AFRICAN_REPUBLIC';
				break;

				case 'CONGO':
					$lang_iso = 'cg';
					$country_name = 'CONGO';
				break;
				
				case 'CHAMORRO':
					$lang_iso = 'ch'; //Finu' Chamoru
					$country_name = 'SWITZERLAND';
				break;
				
				case 'COTE_D-IVOIRE':
					$lang_iso = 'ci';
					$country_name = 'COTE_D-IVOIRE';
				break;
				
				case 'COOK_ISLANDS':
					$lang_iso = 'ck';
					$country_name = 'COOK_ISLANDS'; //CK 	Cook Islands
				break;
				
				case 'CHILE':
					$lang_iso = 'cl';
					$country_name = 'CHILE';
				break;
				
				case 'CHINESE':
				//Chinese Macrolanguage
				//case 'zh': //639-1: zh
				//case 'chi': //639-2/B: chi
				//case 'zho': //639-2/T and 639-3: zho
					$lang_iso = 'cn';
					$country_name = 'CHINA';
				break;
				//Chinese Individual Languages 
			    //	中文
				// Fujian Province, Republic of China
				case 'CHINESE_FUJIAN':
					$lang_iso = 'cn-fj';
					$country_name = 'FUJIAN_PROVINCE';
				break;
				//	閩東話
				case 'CHINESE_DONG': 	//Chinese Min Dong  
					$lang_iso = 'cdo';
					$country_name = 'CHINA';
				break;
				//1. Bingzhou		spoken in central Shanxi (the ancient Bing Province), including Taiyuan.
				//2. Lüliang		spoken in western Shanxi (including Lüliang) and northern Shaanxi.
				//3. Shangdang	spoken in the area of Changzhi (ancient Shangdang) in southeastern Shanxi.
				//4. Wutai			spoken in parts of northern Shanxi (including Wutai County) and central Inner Mongolia.
				//5. Da–Bao		spoken in parts of northern Shanxi and central Inner Mongolia, including Baotou.
				//6. Zhang-Hu	spoken in Zhangjiakou in northwestern Hebei and parts of central Inner Mongolia, including Hohhot.
				//7. Han-Xin		spoken in southeastern Shanxi, southern Hebei (including Handan) and northern Henan (including Xinxiang).
				//8. Zhi-Yan		spoken in Zhidan County and Yanchuan County in northern Shaanxi.
				//	晋语 / 晉語
				case 'CHINA_JINYU': 	//Chinese Jinyu 晉 	
					$lang_iso = 'cjy';
					$country_name = 'CHINA';
				break;
				// Cantonese is spoken in Hong Kong
				// 官話
				case 'CHINESE_MANDARIN': 	//Chinese Mandarin 普通话 (Pǔ tōng huà) literally translates into “common tongue.” 
					$lang_iso = 'cmn';
					$country_name = 'CHINA';
				break;
				// Mandarin is spoken in Mainland China and Taiwan
				// 閩語 / 闽语
				//semantic shift has occurred in Min or the rest of Chinese: 
			    //*tiaŋB 鼎 "wok". The Min form preserves the original meaning "cooking pot".
			    //*dzhənA "rice field". scholars identify the Min word with chéng 塍 (MC zying) "raised path between fields", but Norman argues that it is cognate with céng 層 (MC dzong) "additional layer or floor".
			    //*tšhioC 厝 "house". the Min word is cognate with shù 戍 (MC syuH) "to guard".
			    //*tshyiC 喙 "mouth". In Min this form has displaced the common Chinese term kǒu 口. It is believed to be cognate with huì 喙 (MC xjwojH) "beak, bill, snout; to pant".
				//Austroasiatic origin for some Min words:
			    //*-dəŋA "shaman" compared with Vietnamese đồng (/ɗoŋ2/) "to shamanize, to communicate with spirits" and Mon doŋ "to dance (as if) under demonic possession".
			    //*kiɑnB 囝 "son" appears to be related to Vietnamese con (/kɔn/) and Mon kon "child".
				
				// Southern Min: 
				//		Datian Min; 
				//		Hokkien 話; Hokkien-Taiwanese 閩台泉漳語 - Philippine Hokkien 咱儂話.
				//		Teochew; 
				//		Zhenan Min; 
				//		Zhongshan Min, etc.
				
				//Pu-Xian Min (Hinghwa); Putian dialect: Xianyou dialect.
				
				//Northern Min:  Jian'ou dialect; Jianyang dialect; Chong'an dialect; Songxi dialect; Zhenghe dialect;
				
				//Shao-Jiang Min: Shaowu dialect, Jiangle dialect, Guangze dialect, Shunchang dialect;
				//http://www.shanxigov.cn/
				//Central Min: Sanming dialect; Shaxian dialect; Yong'an dialect,
				
				//Leizhou Min	: Leizhou Min.
				
				//Abbreviation
				//Simplified Chinese:	闽
				//Traditional Chinese:	閩
				//Literal meaning:	Min [River]	
				
				//莆仙片  
				case 'CHINESE_PU-XIAN': 	//Chinese Pu-Xian Min, Sing-iú-uā / 仙游話, (Xianyou dialect) http://www.putian.gov.cn/
					$lang_iso = 'cpx';
					$country_name = 'CHINA';
				break;
				// 徽語
				case 'CHINESE_HUIZHOU': 	//Chinese HuiZhou 	惠州 http://www.huizhou.gov.cn/ | Song dynasty
					$lang_iso = 'czh';
					$country_name = 'CHINA';
				break;
				// 閩中片
				case 'CHINESE_ZHONG': 	//Chinese Min Zhong 閩中語 |  闽中语  http://zx.cq.gov.cn/ | Zhong-Xian | Zhong  忠县
					$lang_iso = 'czo';
					$country_name = 'CHINA';
				break;
				// 東干話 SanMing: http://www.sm.gov.cn/ | Sha River (沙溪)
				case 'dng': 	//Ding  Chinese 
					$lang_iso = 'DING_CHINESE';
					$country_name = 'CHINA';
				break;
				//	贛語
				case 'GAN_CHINESE': 	//Gan Chinese  
					$lang_iso = 'gan';
					$country_name = 'CHINA';
				break;
				// 客家話
				case 'CHINESE_HAKKA': 	//Chinese  Hakka 
					$lang_iso = 'hak';
					$country_name = 'CHINA';
				break;
				
				case 'XIANG_CHINESE': 	//Xiang Chinese 湘語/湘语	
					$lang_iso = 'hsn';
					$country_name = 'CHINA';
				break;
				//	文言
				case 'LITERARY_CHINESE': 	//Literary Chinese 	
					$lang_iso = 'lzh';
					$country_name = 'CHINA';
				break;
				// 閩北片
				case 'MIN_BEI_CHINESE': 	//Min Bei Chinese 
					$lang_iso = 'mnp';
					$country_name = 'CHINA';
				break;
				// 閩南語
				case 'MIN_NAN_CHINESE': 	//Min Nan Chinese 	
					$lang_iso = 'nan';
					$country_name = 'CHINA';
				break;
				 // 吴语
				case 'WU_CHINESE': 	//Wu Chinese 
					$lang_iso = 'wuu';
					$country_name = 'CHINA';
				break;
				// 粵語
				case 'YUE_CHINESE': 	//Yue or Cartonese Chinese
					$lang_iso = 'yue';
					$country_name = 'CHINA';
				break;
				
				case 'CORSICAN':
					$lang_iso = 'co'; // Corsica
					$country_name = 'COLUMBIA';
				break;
				//Eeyou Istchee ᐄᔨᔨᐤ ᐊᔅᒌ
				case 'CREE':
					$lang_iso = 'cr';
					$country_name = 'COSTA_RICA';
				break;

				case 'CZECH':
					$lang_iso = 'cs';
					$country_name = 'CZECH_REPUBLIC';
				break;

				case 'SLAVONIC':
					$lang_iso = 'cu';
					$country_name = 'CUBA'; //langs: 
				break;

				case 'CHUVASH':
					$country_name = 'CAPE_VERDE';
					$lang_iso = 'cv';
				break;
				case 'WELSH_CYMRAEG':
					$lang_iso = 'cy';
				break;				
				case 'MALAYSIAN_CHINESE':
					$lang_iso = 'cx'; // Malaysian Chinese origin and  European Australians 
					$country_name = 'CHRISTMAS_ISLAND';
				break;
				
				case 'CYPRUS':
					$lang_iso = 'cy';
					$country_name = 'CYPRUS';
				break;
				
				case 'CZECH':
					$lang_iso = 'cz';
					$country_name = 'CZECH_REPUBLIC';
				break;
				
				case 'PAPIAMENTU':
					$lang_iso = 'cw';   // Papiamentu (Portuguese-based Creole), Dutch, English
					$country_name = 'CURAÇÃO'; // Ilha da Curação (Island of Healing)
				break;
				
				case 'DANISH':
					$lang_iso = 'da';
					$country_name = 'DENMARK';
				break;
				
				//Geman (Deutsch)
				/*	deu – German
					gmh – Middle High German
					goh – Old High German
					gct – Colonia Tovar German
					bar – Bavarian
					cim – Cimbrian
					geh – Hutterite German
					ksh – Kölsch
					nds – Low German
					sli – Lower Silesian
					ltz – Luxembourgish
					vmf – Mainfränkisch
					mhn – Mòcheno
					pfl – Palatinate German
					pdc – Pennsylvania German
					pdt – Plautdietsch
					swg – Swabian German
					gsw – Swiss German
					uln – Unserdeutsch
					sxu – Upper Saxon
					wae – Walser German
					wep – Westphalian
					hrx – Riograndenser Hunsrückisch
					yec – Yenish	*/

				
				//Germany 	84,900,000 	75,101,421 (91.8%) 	5,600,000 (6.9%) 	De facto sole nationwide official language
				case 'GERMAN':
					$lang_iso = 'de';
					$country_name = 'GERMANY';
				break;
				case 'GERMAN_GERMANY':
					$lang_iso = 'de_de';
					$country_name = 'GERMANY';
				break;
				case 'DEUTSCH':
					$lang_iso = 'deu';
					$country_name = 'GERMANY';
				break;
				//Belgium 	11,420,163 	73,000 (0.6%) 	2,472,746 (22%) 	De jure official language in the German speaking community
				case 'BELGIUM_GERMAN':
					$lang_iso = 'de_be';
					$country_name = 'BELGIUM';
				break; 
				 //Austria 	8,838,171 	8,040,960 (93%) 	516,000 (6%) 	De jure sole nationwide official language
				case 'AUSTRIAN_GERMAN':
					$lang_iso = 'de_at';
					$country_name = 'AUSTRIA';
				break; 
				 // Switzerland 	8,508,904 	5,329,393 (64.6%) 	395,000 (5%) 	Co-official language at federal level; de jure sole official language in 17, co-official in 4 cantons (out of 26)
				case 'SWISS_GERMAN':
					$lang_iso = 'de_sw';
					$country_name = 'SWITZERLAND';
				break;
				
				 //Luxembourg 	602,000 	11,000 (2%) 	380,000 (67.5%) 	De jure nationwide co-official language
				case 'LUXEMBOURG_GERMAN':
					$lang_iso = 'de_lu';
					$country_name = 'LUXEMBOURG';
				break; 
				case 'LUXEMBOURGIAN':
					$lang_iso = 'ltz';
					$country_name = 'LUXEMBOURG';
				break; 
				 //Liechtenstein 	37,370 	32,075 (85.8%) 	5,200 (13.9%) 	De jure sole nationwide official language	
				//Alemannic, or rarely Alemmanish
				case 'LIECHTENSTEIN_GERMAN':
					$lang_iso = 'de_li';
					$country_name = 'LIECHTENSTEIN';
				break;
				case 'ALEMANNIC_GERMAN':
					$lang_iso = 'gsw';
					$country_name = 'SWITZERLAND';
				break;
				//mostly spoken on Lifou Island, Loyalty Islands, New Caledonia. 
				case 'DREHU':
					$lang_iso = 'dhv';
					$country_name = 'NEW_CALEDONIA';
				break;
				
				case 'DANISH':
					$lang_iso = 'dk';
					$country_name = 'DENMARK';
				break;
				
				//acf – Saint Lucian / Dominican Creole French
				case 'DOMINICAN_CREOLE_FRENCH':
					$lang_iso = 'acf'; //ROSEAU 
					$country_name = 'DOMINICA';
				break;
				
				case 'DOMINICA_ENGLISH':
					$lang_iso = 'en_dm'; 
					$country_name = 'DOMINICA';
				break;

				case 'SANTO_DOMINGO_SPANISH':
					$lang_iso = 'do'; //Santo Domingo
					$country_name = 'DOMINICAN_REPUBLIC';
				break;
				case 'SANTO_DOMINGO_ENGLISH':
					$lang_iso = 'en_do'; //Santo Domingo
					$country_name = 'DOMINICAN_REPUBLIC';
				break;

				case 'DJIBOUTI':
					$lang_iso = 'dj'; //Yibuti, Afar
					$country_name = 'REPUBLIC_OF_DJIBOUTI'; //République de Djibouti
				break;
				case 'AFAR_DJIBOUTI':
					$lang_iso = 'aa_dj'; //Yibuti, Afar
					$country_name = 'REPUBLIC_OF_DJIBOUTI'; //République de Djibouti
				break;

				case 'DIVEHI':
					$lang_iso = 'dv'; //Maldivian
					$country_name = 'MALDIVIA';
				break;
				
				//Berbera Taghelmustă (limba oamenilor albaștri), zisă și Tuaregă, este vorbită în Sahara occidentală.
				//Berbera Tamazigtă este vorbită în masivul Atlas din Maroc, la sud de oraşul Meknes.
				//Berbera Zenatică zisă şi Rifană, este vorbită în masivul Rif din Maroc, în nord-estul ţării.
				//Berbera Şenuană zisă și Telică, este vorbită în masivul Tell din Algeria, în nordul ţării.
				//Berbera Cabilică este vorbită în jurul masivelor Mitigea și Ores din Algeria, în nordul ţării.
				//Berbera Şauiană este vorbită în jurul orașului Batna din Algeria.
				//Berbera Tahelhită, zisă şi Şlănuană (în limba franceză Chleuh) este vorbită în jurul masivului Tubkal din Maroc, în sud-vestul ţării.
				//Berbera Tamașekă, zisă şi Sahariană, este vorbită în Sahara de nord, în Algeria, Libia şi Egipt.
				//Berber: Tacawit (@ city Batna from Chaoui, Algery), Shawiya (Shauian)
				case 'SHAWIYA_BERBER':
					$lang_iso = 'shy';
					$country_name = 'ALGERIA'; 
				break;

				case 'DZONGKHA':
					$lang_iso = 'dz';
					$country_name = 'ALGERIA'; //http://www.el-mouradia.dz/
				break;

				case 'ECUADOR':
					$country_name = 'ec';
					$lang_iso = 'ECUADOR';
				break;

				case 'EGYPT':
					$country_name = 'eg';
					$lang_iso = 'EGYPT';
				break;

				case 'WESTERN_SAHARA':
					$lang_iso = 'eh';
					$country_name = 'WESTERN_SAHARA';
				break;

				case 'EWE':
					//Kɔsiɖagbe (Sunday)
					//Dzoɖagbe (Monday) 	
					//Braɖagbe, Blaɖagbe (Tuesday) 	
					//Kuɖagbe (Wednesday)
					//Yawoɖagbe (Thursday)
					//Fiɖagbe (Friday)
					//Memliɖagbe (Saturday)
					$lang_iso = 'ee'; //Èʋegbe Native to Ghana, Togo
					$country_name = 'ESTONIA';
				break;
				
				//Greek Language:
				//ell – Modern Greek
				//grc – Ancient Greek
				//cpg – Cappadocian Greek
				//gmy – Mycenaean Greek
				//pnt – Pontic
				//tsd – Tsakonian
				//yej – Yevanic
				
				case 'GREEK':
					$lang_iso = 'el'; 
					$country_name = 'GREECE';
				break;
				
				case 'CAPPADOCIAN_GREEK':
					$lang_iso = 'cpg';
					$country_name = 'GREECE';
				break;
				case 'MYCENAEAN_GREEK':
					$lang_iso = 'gmy';
					$country_name = 'GREECE';
				break;
				case 'PONTIC':
					$lang_iso = 'pnt';
					$country_name = 'GREECE';
				break;
				case 'TSAKONIAN':
					$lang_iso = 'tsd';
					$country_name = 'GREECE';
				break;
				//Albanian: Janina or Janinë, Aromanian: Ianina, Enina, Turkish: Yanya;
				case 'YEVANIC':
					$lang_iso = 'yej';
					$country_name = 'GREECE';
				break;
				
				case 'BRITISH_ENGLISH':
					$lang_iso = 'en_uk'; //used in United Kingdom
					$country_name = 'GREAT_BRITAIN';
				break;
				case 'BRITISH':
					$lang_iso = 'uk'; //used in United Kingdom
					$country_name = 'GREAT_BRITAIN';
				break;
					
				case 'FIJIAN_ENGLISH':
					$lang_iso = 'en_fj';
					$country_name = 'FIJI';
				break;
				
				case 'GIBRALTARIAN':
					$lang_iso = 'GibE'; //used in Gibraltar
					$country_name = 'GIBRALTAR';
				break;
				case 'GIBRALTARIAN _ENGLISH':
					$lang_iso = 'en_gb'; //used in Gibraltar
					$country_name = 'GIBRALTAR';
				break;
				case 'GIBRALTAR':
					$lang_iso = 'gb'; //used in Gibraltar
					$country_name = 'GIBRALTAR';
				break;
				case 'ENGLISH':
					$lang_iso = 'en';
				break;				
				case 'AMERICAN_ENGLISH':
					$lang_iso = 'en_us';
					$country_name = 'UNITED_STATES_OF_AMERICA';
				break;
				
				case 'HIBERNO_ENGLISH':
					$lang_iso = 'en_ie'; //Irish English
					$country_name = 'IRELAND';
				break;
				case 'US_ENGLISH':
					$lang_iso = 'USEng'; //Irish English
					$country_name = 'IRELAND';
				break;
				
				case 'en_il':
					$lang_iso = 'ENGLISH_ISRAEL'; 
					$country_name = 'ISRAEL';
				break;
				case 'ILEng':
					$lang_iso = 'ISRAELY_ENGLISH'; 
					$country_name = 'ISRAEL';
				break;
				case 'HEBLISH':
					$lang_iso = 'heb'; 
					$country_name = 'ISRAEL';
				break;
				case 'ENGBREW':
					$lang_iso = 'engbrew'; 
					$country_name = 'ISRAEL';
				break;
				
				case 'ENGLISH_CANADA':
					$lang_iso = 'en_ca'; 
					$country_name = 'CANADA';
				break;
				case 'CANADIAN_ENGLISH':
					$lang_iso = 'CanE'; 
					$country_name = 'CANADA';
				break;
				
				case 'COOK_ISLANDS_ENGLISH':
					$lang_iso = 'en_ck';
					$country_name = 'COOK_ISLANDS'; //CK 	Cook Islands
				break;
				
				case 'INDIAN_ENGLISH':
					$lang_iso = 'en_in'; 
					$country_name = 'REPUBLIC_OF_INDIA';
				break;
				
				case 'ANGUILLAN_ENGLISH':
					$lang_iso = 'en_ai'; 
					$country_name = 'ANGUILLA';
				break;
				
				case 'AUSTRALIAN_ENGLISH':
					$lang_iso = 'en_au'; 
					$country_name = 'AUSTRALIA';
				break;
				case 'AUSTRALIAN_ENGLISH': 
					$lang_iso = 'AuE'; 
					$country_name = 'AUSTRALIA';
				break;
				
				case 'ENGLISH_NEW_ZEALAND':
					$lang_iso = 'en_nz'; 
					$country_name = 'NEW_ZEALAND';
				break;
				case 'NEW_ZEALAND_ENGLISH': 
					$lang_iso = 'nze'; 
					$country_name = 'NEW_ZEALAND';
				break;
				
				//New England English
				case 'NEW_ENGLAND_ENGLISH':
					$lang_iso = 'en_ne';
					$country_name = 'NEW_ENGLAND';
				break;
				
				//
				case 'BERMUDIAN ENGLISH':
					$lang_iso = 'en_bm';
					$country_name = 'BERMUDA';
				break;
					
				case 'NIUEAN_ENGLISH':
					$lang_iso = 'en_nu'; //Niuean (official) 46% (a Polynesian language closely related to Tongan and Samoan)
					$country_name = 'NIUE'; // Niuean: Niuē
				break;
				
				case 'MONTSERRAT_ENGLISH':
					$lang_iso = 'en_ms';
					$country_name = 'MONTSERRAT';
				break;
				
				case 'PITCAIRN_ISLAND_ENGLISH':
					$lang_iso = 'en_pn';
					$country_name = 'PITCAIRN_ISLAND';
				break;
					
				case 'ST_HELENA_ENGLISH':
					$lang_iso = 'en_sh';
					$country_name = 'ST_HELENA';
				break;
				
				case 'ENGLISH_TURKS_CAICOS':
					$lang_iso = 'en_tc';
					$country_name = 'TURKS_&AMP;_CAICOS_IS_ENGLISH';
				break;

				case 'VIRGIN_ISLANDS_ENGLISH':
					$lang_iso = 'en_vg';
					$country_name = 'VIRGIN_ISLANDS_(BRIT)';
				break;
				
				case 'ESPERANTO':
					$lang_iso = 'eo'; //created in the late 19th century by L. L. Zamenhof, a Polish-Jewish ophthalmologist. In 1887
					$country_name = 'EUROPE';
				break;

				case 'ERITREA':
					$lang_iso = 'er';
					$country_name = 'ERITREA';
				break;

				//See: 
				// http://www.webapps-online.com/online-tools/languages-and-locales
				// https://www.ibm.com/support/knowledgecenter/ko/SSS28S_3.0.0/com.ibm.help.forms.doc/locale_spec/i_xfdl_r_locale_quick_reference.html
				case 'SPANISH':
				//Spanish Main
					$lang_iso = 'es';
					$country_name = 'SPAIN';
				break;
				case 'SPANISH_MEXICO':
				//Spanish (Mexico) (es-MX)
					$lang_iso = 'es_mx';
					$country_name = 'MEXICO';
				break;
				case 'SPANISH_UNITED_STATES':
					$lang_iso = 'es_us';
					$country_name = 'UNITED_STATES';
				break;
				case 'SPANISH_CARIBBEAN':
				//Spanish	Latin America and the Caribbean
					$lang_iso = 'es_419';
					$country_name = 'CARIBBE';
				break;
				case 'SPANISH_ARGENTINIAN':
				//		Spanish	Argentina
					$lang_iso = 'es_ar';
					$country_name = 'ARGENTINA';
				break;
				case 'SPANISH_BOLIVIAN':
					$lang_iso = 'es_bo';
					$country_name = 'BOLIVIA';
				break;
				case 'SPANISH_BRAZILIAN':
					$lang_iso = 'es_br';
					$country_name = 'BRAZIL';
				break;
				case 'SPANISH_CHILEAN':
				//		Spanish	Chile
					$lang_iso = 'es_cl';
					$country_name = 'CHILE';
				break;
				case 'SPANISH_COLOMBIAN':
				//	Spanish (Colombia) (es-CO)
					$lang_iso = 'es_co';
					$country_name = 'COLOMBIA';
				break;
				case 'SPANISH_COSTA_RICA':
					$lang_iso = 'es_cr';
					$country_name = 'COSTA_RICA';
				break;
				case 'SPANISH_DOMINICAN_REPUBLIC':
				//Spanish (Dominican Republic) (es-DO)
					$lang_iso = 'es_do';
					$country_name = 'DOMINICAN_REPUBLIC';
				break;
				case 'SPANISH_ECUADOR':
				//		Spanish (Ecuador) (es-EC)
					$lang_iso = 'es_ec';
					$country_name = 'SPAIN';
				break;
				case 'SPANISH_SPAIN':
				//		Spanish	Spain
					$lang_iso = 'es_es';
					$country_name = 'SPAIN';
				break;
				case 'SPANISH_NL':
					$lang_iso = 'es_es_tradnl';
					$country_name = 'NL';
				break;
				case 'SPANISH_EUROPE':
					$lang_iso = 'es_eu';
					$country_name = 'EUROPE';
				break;
				case 'SPANISH_GUATEMALA':
				//	Spanish (Guatemala) (es-GT)
					$lang_iso = 'es_gt';
					$country_name = 'SPAIN';
				break;
				case 'SPANISH_HONDURAS':
				//Spanish (Honduras) (es-HN)
					$lang_iso = 'es_hn';
					$country_name = 'SPAIN';
				break;
				case 'SPANISH_LAO':
				//		Spanish	Lao
					$lang_iso = 'es_la';
					$country_name = 'SPAIN';
				break;
				case 'SPANISH_NICARAGUA':
				//		Spanish (Nicaragua) (es-NI)
					$lang_iso = 'es_ni';
					$country_name = 'NICARAGUA';
				break;
				case 'SPANISH_PANAMIAN':
				//Spanish (Panama) (es-PA)
					$lang_iso = 'es_pa';
					$country_name = 'PANAMA';
				break;
				case 'SPANISH_PERU':
				//Spanish (Peru) (es-PE)
					$lang_iso = 'es_pe';
					$country_name = 'PERU';
				break;
				case 'SPANISH_PUERTO_RICO':
				//Spanish (Puerto Rico) (es-PR)
					$lang_iso = 'es_pr';
					$country_name = 'PUERTO_RICO';
				break;
				case 'SPANISH_PARAGUAY':
				//Spanish (Paraguay) (es-PY)
					$lang_iso = 'es_py';
					$country_name = 'PARAGUAY';
				break;
				case 'SPANISH_EL_SALVADOR':
				//Spanish (El Salvador) (es-SV)
					$lang_iso = 'es_sv';
					$country_name = 'EL_SALVADOR';
				break;
				case 'SPANISH_UNITED_STATES':
				//	Spanish (United States) (es-US)
					$lang_iso = 'es_us';
					$country_name = 'UNITED_STATES';
				break;
				case 'SPANISH_URUGUAY':
				//Spanish (Uruguay) (es-UY)
					$lang_iso = 'es_uy';
					$country_name = 'URUGUAY';
				break;
				case 'SPANISH_VENEZUELA':
				//	Spanish (Venezuela) (es-VE)
					$lang_iso = 'es_ve';
					$country_name = 'BOLIVARIAN_REPUBLIC_OF_VENEZUELA';
				break;
				case 'SPANISH_LATIN_AMERICA':
				//	Spanish	Latin America	
					$lang_iso = 'es_xl';
					$country_name = 'LATIN_AMERICA';
				break;

				case 'ESTONIAN':
					$lang_iso = 'et';
					$country_name = 'ESTONIA';
				break;

				case 'BASQUE':
					$lang_iso = 'eu';
					$country_name = 'BASQUE';
				break;

				case 'PERSIAN':
					$lang_iso = 'fa';
					$country_name = 'PERSIA';
				break;
				
				//for Fulah (also spelled Fula) the ISO 639-1 code is ff.
			    //fub – Adamawa Fulfulde
			    //fui – Bagirmi Fulfulde
			    //fue – Borgu Fulfulde
			    //fuq – Central-Eastern Niger Fulfulde
			    //ffm – Maasina Fulfulde
			    //fuv – Nigerian Fulfulde
			    //fuc – Pulaar
			    //fuf – Pular
			    //fuh – Western Niger Fulfulde
			
				case 'ADAMAWA_FULFULDE':
					$lang_iso = 'fub';
					$country_name = 'FULAH';
				break;
				
				case 'BAGIRMI_FULFULDE':
					$lang_iso = 'fui';
					$country_name = 'FULAH';
				break;
				
				case 'BORGU_FULFULDE':
					$lang_iso = 'fue';
					$country_name = 'FULAH';
				break;
				
				case 'NIGER_FULFULDE':
					$lang_iso = 'fuq';
					$country_name = 'FULAH';
				break;
				
				case 'MAASINA_FULFULDE':
					$lang_iso = 'ffm';
					$country_name = 'FULAH';
				break;
				
				case 'NIGERIAN_FULFULDE':
					$lang_iso = 'fuv';
					$country_name = 'FULAH';
				break;
				
				case 'PULAAR':
					$lang_iso = 'fuc';
					$country_name = 'SENEGAMBIA_CONFEDERATION'; //sn //gm
				break;
				
				case 'PULAR':
					$lang_iso = 'fuf';
					$country_name = '';
				break;
				
				case 'WESTERN_NIGER_FULFULDE':
					$lang_iso = 'fuh';
					$country_name = '';
				break;
				
				case 'FULAH':
					$lang_iso = 'ff';
					$country_name = 'FULAH';
				break;
				
				case 'FINNISH':
					$lang_iso = 'fi';
					$country_name = 'FINLAND';
				break;
				
				case 'KVEN':
					$lang_iso = 'fkv';
					$country_name = 'NORWAY';
				break;
				
				case 'KVEN':
					$lang_iso = 'fit';
					$country_name = 'SWEDEN';
				break;
				
				case 'FIJIAN':
					$lang_iso = 'fj';
					$country_name = 'FIJI';
				break;

				case 'FALKLANDIAN':
					$lang_iso = 'fk';
					$country_name = 'FALKLAND_ISLANDS';
				break;

				case 'MICRONESIA':
					$lang_iso = 'fm';
					$country_name = 'MICRONESIA';
				break;

				case 'FAROESE':
					$lang_iso = 'fo';
					$country_name = 'FAROE_ISLANDS';
				break;
				
				//Metropolitan French (French: France Métropolitaine or la Métropole)
				case 'FRENCH':
					$lang_iso = 'fr';
					$country_name = 'FRANCE';
				break;
				case 'METROPOLITAN_FRENCH':
					$lang_iso = 'fr_me';
					$country_name = 'FRANCE';
				break;
				//Acadian French
				case 'ACADIAN_FRENCH':
					$lang_iso = 'fr_ac';
					$country_name = 'ACADIA';
				break;
				
				case 'DOMINICA_FRENCH':
					$lang_iso = 'fr_dm'; 
					$country_name = 'DOMINICA';
				break;
				
				//al-dîzāyīr
				case 'ALGERIAN_FRENCH':
					$lang_iso = 'fr_dz';
					$country_name = 'ALGERIA';
				break;
				//Aostan French (French: français valdôtain)
				//Seventy:		septante[a] [sɛp.tɑ̃t]
				//Eighty:		huitante[b] [ɥi.tɑ̃t]
				//Ninety:		nonante[c] [nɔ.nɑ̃t]
				case 'AOSTAN_FRENCH':
					$lang_iso = 'fr_ao';
					$country_name = 'ITALY';
				break;
				//Belgian French
				case 'BELGIAN_FRENCH':
					$lang_iso = 'fr_bl';
					$country_name = 'BELGIUM';
				break;
				//Cambodian French -  French Indochina
				case 'CAMBODIAN_FRENCH':
					$lang_iso = 'fr_cb';
					$country_name = 'CAMBODIA';
				break;
				//Cajun French - Le Français Cajun - New Orleans
				case 'CAJUN_FRENCH':
					$lang_iso = 'fr_cj';
					$country_name = 'UNITED_STATES';
				break;
				//Canadian French  (French: Français Canadien)
				//Official language in Canada,  New Brunswick, Northwest Territories, Nunavut, Quebec, Yukon, 
				//Official language in United States, Maine (de facto),  New Hampshire
				case 'CANADIAN_FRENCH':
					$lang_iso = 'fr_ca';
					$country_name = 'CANADA';
				break;
				//Guianese French
				case 'GUIANESE_FRENCH':
					$lang_iso = 'gcr';
					$country_name = 'FRENCH_GUIANA';
				break;
				case 'FRENCH_GUIANA':
					$lang_iso = 'fr_gu';
					$country_name = 'FRENCH_GUIANA';
				break;
				//Guianese English
				case 'GUYANESE_CREOLE':
					$lang_iso = 'gyn';
					$country_name = 'ENGLISH_GUIANA';
				break;
				case 'GUIANESE_ENGLISH':
					$lang_iso = 'en_gy';
					$country_name = 'ENGLISH_GUIANA';
				break;
				//Haitian French
				case 'HAITIAN_FRENCH':
					$lang_iso = 'fr_ht';
					$country_name = 'HAITI'; //UNITED_STATES
				break;
				//Haitian English
				case 'HAITIAN_CREOLE':
					$lang_iso = 'en_ht';
					$country_name = 'HAITI'; //UNITED_STATES
				break;
				//Indian French
				case 'INDIAN_FRENCH':
					$lang_iso = 'fr_id';
					$country_name = 'INDIA';
				break;
				case 'INDIAN_ENGLISH':
					$lang_iso = 'en_id';
					$country_name = 'INDIA';
				break;
				//Jersey Legal French - Anglo-Norman French 
				case 'ANGLO_NORMAN_FRENCH':
					$lang_iso = 'xno';
					$country_name = 'UNITED_STATES';
				break;
				case 'JERSEY_LEGAL_FRENCH':
					$lang_iso = 'fr_je';
					$country_name = 'UNITED_STATES';
				break;
				
				case 'CAMBODIAN_FRENCH':
					$lang_iso = 'fr_kh';
					$country_name = 'CAMBODIA';
				break;
				
				//Lao French
				case 'LAO_FRENCH':
					$lang_iso = 'fr_la';
					$country_name = 'LAOS';
				break;
				//Louisiana French (French: Français de la Louisiane, Louisiana Creole: Françé la Lwizyàn)
				case 'FRENCH_CREOLE':
					$lang_iso = 'frc';
					$country_name = 'LOUISIANA'; 
				break;
				case 'LOUISIANIAN_FRENCH':
					$lang_iso = 'fr_lu';
					$country_name = 'LOUISIANA'; 
				break;
				//Louisiana Creole
				case 'LOUISIANA_CREOLE':
					$lang_iso = 'lou';
					$country_name = 'LOUISIANA'; 
				break;
				//Meridional French (French: Français Méridional, also referred to as Francitan)
				case 'MERIDIONAL_FRENCH':
					$lang_iso = 'fr_mr'; 
					$country_name = 'OCCITANIA';
				break;
				//Missouri French
				case 'MISSOURI_FRENCH':
					$lang_iso = 'fr_mi';
					$country_name = 'MISSOURI‎';
				break;
				//New Caledonian French vs New Caledonian Pidgin French
				case 'NEW_CALEDONIAN_FRENCH':
					$lang_iso = 'fr_nc';
					$country_name = 'NEW_CALEDONIA';
				break;
				//Newfoundland French (French: Français Terre-Neuvien),
				case 'NEWFOUNDLAND_FRENCH':
					$lang_iso = 'fr_nf';
					$country_name = 'CANADA';
				break;
				//New England French
				case 'NEW_ENGLAND_FRENCH':
					$lang_iso = 'fr_ne';
					$country_name = 'NEW_ENGLAND';
				break;
				//Quebec French (French: français québécois; also known as Québécois French or simply Québécois)
				case 'QUEBEC_FRENCH':
					$lang_iso = 'fr_qb';
					$country_name = 'CANADA';
				break;
				//Swiss French
				case 'SWISS_FRENCH':
					$lang_iso = 'fr_sw';
					$country_name = 'SWITZERLAND';
				break;
				//French Southern and Antarctic Lands
				case 'FRENCH_TERRITORIES':
					$lang_iso = 'fr_tf'; //
					$country_name = 'SOUTHERN_TERRITORIES'; //Terres australes françaises
				break;
				//Vietnamese French
				case 'VIETNAMESE_FRENCH':
					$lang_iso = 'fr_vt';
					$country_name = 'VIETNAM';
				break;
				//West Indian French
				case 'WEST_INDIAN_FRENCH':
					$lang_iso = 'fr_if';
					$country_name = 'INDIA';
				break;
				
				case 'WALLISIAN_FRENCH':
					$country_name = 'TERRITORY_OF_THE_WALLIS_AND_FUTUNA_ISLANDS';
					$lang_iso = 'fr_wf'; 
				break;
				
				case 'WESTERN_FRISIAN':
					$lang_iso = 'fy';
					$country_name = 'FRYSK';
				break;
				
				case 'IRISH_GABON':
					$lang_iso = 'ga';
					$country_name = 'GABON';
				break;
				
				case 'GENERAL_AMERICAN':
					$lang_iso = 'GenAm';
					$country_name = 'UNITED_STATES';
				break;

				//gcf – Guadeloupean Creole
				case 'GUADELOUPEAN_CREOLE_FRENCH':
					$lang_iso = 'gcf'; 
					$country_name = 'GUADELOUPE';
				break;
				
				case 'SCOTTISH_GRENADA':
					$lang_iso = 'gd';
					$country_name = 'GRENADA';
				break;
				
				case 'GEORGIAN':
					$lang_iso = 'ge';
					$country_name = 'GEORGIA';
				break;
				
				case 'LLANITO':
					$lang_iso = 'gi'; //Llanito or Yanito
					$country_name = 'GIBRALTAR';
				break;
				
				case 'GUERNESIAIS':
					$lang_iso = 'gg'; //English, Guernésiais, Sercquiais, Auregnais
					$country_name = 'GUERNSEY';
				break;
				
				case 'GHANA':
					$lang_iso = 'gh';
					$country_name = 'GHANA';
				break;
				
				case 'MODERN_GREEK':
					$lang_iso = 'ell'; 
					$country_name = 'GREECE';
				break;
				
				case 'MODERN_GREEK':
				//case 'gre':
					$lang_iso = 'gr'; 
					$country_name = 'GREECE';
				break;
				
				case 'ANCIENT_GREEK':
					$lang_iso = 'grc'; 
					$country_name = 'GREECE';
				break;
				
				//Galician is spoken by some 2.4 million people, mainly in Galicia, 
				//an autonomous community located in northwestern Spain.
				case 'GALICIAN':
					$lang_iso = 'gl'; //Galicia
					$country_name = 'GREENLAND';
				break;
				
				case 'GAMBIA':
					$lang_iso = 'gm';
					$country_name = 'GAMBIA';
				break;
				 
				//grn is the ISO 639-3 language code for Guarani. Its ISO 639-1 code is gn. 
				//    nhd – Chiripá
				//    gui – Eastern Bolivian Guaraní
				//    gun – Mbyá Guaraní
				//    gug – Paraguayan Guaraní
				//    gnw – Western Bolivian Guaraní
				case 'GUARANI':
					$lang_iso = 'gn';
					$country_name = 'GUINEA';
				break;
				//Nhandéva is also known as Chiripá. 
				//The Spanish spelling, Ñandeva, is used in the Paraguayan Chaco 
				// to refer to the local variety of Eastern Bolivian, a subdialect of Avá.
				case 'CHIRIPA':
					$lang_iso = 'nhd';
					$country_name = 'PARAGUAY';
				break;
				case 'EASTERN_BOLIVIAN_GUARANI':
					$lang_iso = 'gui';
					$country_name = 'BOLIVIA';
				break;
				case 'MBYA_GUARANI':
					$lang_iso = 'gun';
					$country_name = 'PARAGUAY';
				break;
				case 'PARAGUAYAN_GUARANI':
					$lang_iso = 'gug';
					$country_name = 'PARAGUAY';
				break;
				case 'WESTERN_BOLIVIAN_GUARANI':
					$lang_iso = 'gnw';
					$country_name = 'BOLIVIA';
				break;
				
				case 'SOUTH_GEORGIA_ENGLISH':
					$lang_iso = 'gs';
					$country_name = 'SOUTH_GEORGIA_AND_THE_SOUTH_SANDWICH_ISLANDS';
				break;
				
				case 'GUATEMALA':
					$lang_iso = 'gt';
					$country_name = 'GUATEMALA';
				break;
				
				case 'EQUATORIAL_GUINEAN':
					$lang_iso = 'gq';
					$country_name = 'EQUATORIAL_GUINEA';
				break;

				case 'GUJARATI':
					$lang_iso = 'gu';
					$country_name = 'GUAM';
				break;

				case 'MANX':
					$lang_iso = 'gv';
					$country_name = '';
				break;
				
				case 'GUINEA_BISSAU':
					$lang_iso = 'gw';
					$country_name = 'GUINEA_BISSAU';
				break;

				case 'GUYANA':
					$lang_iso = 'gy';
					$country_name = 'GUYANA';
				break;

				case 'HAUSA':
					$country_name = 'ha';
					$lang_iso = 'HAUSA';
				break;

				//heb – Modern Hebrew
				//hbo – Classical Hebrew (liturgical)
				//smp – Samaritan Hebrew (liturgical)
				//obm – Moabite (extinct)
				//xdm – Edomite (extinct)
				case 'HEBREW':
					$country_name = 'ISRAEL';
					$lang_iso = 'he';
				break;
				case 'MODERN_HEBREW':
					$country_name = 'ISRAEL';
					$lang_iso = 'heb';
				break;
				case 'CLASSICAL_HEBREW':
					$country_name = 'ISRAEL';
					$lang_iso = 'hbo';
				break;
				case 'SAMARITAN_ARAMEIC':
					$country_name = 'SAMARIA';
					$lang_iso = 'sam';
				break;
				case 'SAMARITAN_HEBREW':
					$country_name = 'SAMARIA';
					$lang_iso = 'smp';
				break;
				case 'MOABITE_HEBREW':
					$country_name = 'MOAB';
					$lang_iso = 'obm';
				break;
				case 'EDOMITE_HEBREW':
					$country_name = 'EDOM';
					$lang_iso = 'xdm';
				break;
				case 'HINDI':
					$lang_iso = 'hi';
					$country_name = '';
				break;
				
				case 'HIRI_MOTU':
					$lang_iso = 'ho';
					$country_name = '';
				break;
				
				case 'CHINESE_HONG_KONG':
					$lang_iso = 'hk';
					$country_name = 'HONG_KONG';
				break;
				
				case 'HONDURAS':
					$country_name = 'Honduras';
					$lang_iso = 'hn';
				break;
				
				case 'CROATIAN':
					$lang_iso = 'hr';
					$country_name = 'CROATIA';
				break;
				
				case 'HAITIAN':
					$lang_iso = 'ht';
					$country_name = 'HAITI';
				break;
				

				
				case 'HUNGARIAN':
					$lang_iso = 'hu';
					$country_name = 'HUNGARY';
				break;
				
				case 'ARMENIAN':
					$lang_iso = 'hy';
					$country_name = 'ARMENIA';
				break;

				case 'ARMENIAN_ARTSAKH':
					$lang_iso = 'hy_at';
					$country_name = 'REPUBLIC_OF_ARTSAKH';
				break;

				case 'HERERO':
					$lang_iso = 'hz';
					$country_name = '';
				break;
				
				case 'INTERLINGUA':
					$lang_iso = 'ia';
					$country_name = '';
				break;
				
				case 'CANARY_ISLANDS':
					$lang_iso = 'ic';
					$country_name = 'CANARY_ISLANDS';
				break;
				
				case 'INDONESIAN':
					$lang_iso = 'id';
					$country_name = 'INDONESIA';
				break;
				
				case 'INTERLINGUE':
					$lang_iso = 'ie';
					$country_name = 'IRELAND';
				break;
				
				case 'IGBO':
					$lang_iso = 'ig';
					$country_name = '';
				break;
				
				case 'SICHUAN_YI':
					$lang_iso = 'ii';
					$country_name = '';
				break;
				
				case 'INUPIAQ':
					$lang_iso = 'ik';
					$country_name = '';
				break;
				
				//Mostly spoken on  Ouvéa Island or Uvea Island of the Loyalty Islands, New Caledonia. 
				case 'IAAI':
					$lang_iso = 'iai';
					$country_name = 'NEW_CALEDONIA';
				break;
				
				case 'IBRIT':
					$lang_iso = 'il';
					$country_name = 'ISRAEL';
				break;
				
				case 'ISLE_OF_MAN':
					$lang_iso = 'im';
					$country_name = 'ISLE_OF_MAN';
				break;
				
				case 'INDIA':
					$lang_iso = 'in';
					$country_name = 'INDIA';
				break;
				
				
				case 'IRANIAN':
					$lang_iso = 'ir';
					$country_name = 'IRAN';
				break;
				case 'IDO':
					$lang_iso = 'io';
				break;
				case 'ICELANDIC':
					$lang_iso = 'is';
					$country_name = 'ICELAND';
				break;
				
				case 'ITALIAN':
					$lang_iso = 'it';
					$country_name = 'ITALY';
				break;
				case 'INUKTITUT':
					$lang_iso = 'iu';
				break;				
				case 'IRAQIAN':
					$lang_iso = 'iq';
					$country_name = 'IRAQ';
				break;
				
				case 'JERRIAIS':
					$lang_iso = 'je'; //Jèrriais
					$country_name = 'JERSEY'; //Bailiwick of Jersey
				break;
				
				case 'JAMAICA':
					$lang_iso = 'jm';
					$country_name = 'JAMAICA';
				break;
				
				case 'JORDAN':
					$lang_iso = 'jo';
					$country_name = 'JORDAN';
				break;
				
				case 'JAPANESE':
					$lang_iso = 'ja'; //jp
					$country_name = 'JAPAN';
				break;
				
				case 'JAVANESE':
					$lang_iso = 'jv';
					$country_name = '';
				break;
				
				case 'CAMBODIAN':
					$lang_iso = 'kh';
					$country_name = 'CAMBODIA';
				break;
				
				case 'KENYAN':
					$lang_iso = 'ke';
					$country_name = 'KENYA';
				break;
				case 'KONGO':
					$lang_iso = 'kg';
				break				
				case 'KIKUYU':
					$lang_iso = 'ki';
					$country_name = 'KIRIBATI';
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
				//Bantu languages 
				//zdj – Ngazidja Comorian
				case 'NGAZIDJA_COMORIAN':
					$lang_iso = 'zdj';
					$country_name = 'COMOROS';
				break;
				//wni – Ndzwani  Comorian (Anjouani) dialect
				case 'NDZWANI_COMORIAN':
					$lang_iso = 'wni';
					$country_name = 'COMOROS';
				break;
				//swb – Maore Comorian dialect
				case 'MAORE_COMORIAN':
					$lang_iso = 'swb';
					$country_name = 'COMOROS';
				break;
				//wlc – Mwali Comorian dialect
				case 'MWALI_COMORIAN':
					$lang_iso = 'wlc';
					$country_name = 'COMOROS';
				break;
				
				case 'KHMER':
					$lang_iso = 'km';
					$country_name = 'COMOROS';
				break;
				
				case 'KANNADA':
					$lang_iso = 'kn';
					$country_name = 'ST_KITTS-NEVIS';
				break;
				
				//case 'KOREAN':
				//case 'ko':
				//	$lang_iso = 'kp';
					// kor – Modern Korean
					// jje – Jeju
					// okm – Middle Korean
					// oko – Old Korean
					// oko – Proto Korean
					// okm Middle Korean
					 // oko Old Korean
				//	$country_name = 'Korea North';
				//break;
				
				case 'KOREAN':
					$lang_iso = 'ko';
					$country_name = 'KOREA_SOUTH';
				break;
				case 'KANURI':
					$lang_iso = 'kr';
				break;				
				case 'ST_KITTS_NEVIS':
					$lang_iso = 'kn';
					$country_name = 'ST_KITTS-NEVIS';
				break;
				
				case 'KASHMIRI':
					$lang_iso = 'ks'; //Kashmir
					$country_name = 'KOREA_SOUTH';
				break;
				
				case 'CAYMAN_ISLANDS':
					$lang_iso = 'ky';
					$country_name = 'CAYMAN_ISLANDS';
				break;

				case 'KAZAKHSTAN':
					$lang_iso = 'kz';
					$country_name = 'KAZAKHSTAN';
				break;

				case 'CORNISH':
					//endonim: Kernewek
					$lang_iso = 'kw';
					$country_name = 'KUWAIT';
				break;

				case 'KYRGYZSTAN':
					$lang_iso = 'kg';
					$country_name = 'KYRGYZSTAN';
				break;

				case 'LAOS':
					$lang_iso = 'la';
					$country_name = 'LAOS';
				break;

				case 'SRI_LANKA':
					$lang_iso = 'lk';
					$country_name = 'SRI_LANKA';
				break;

				case 'LATVIAN':
					$lang_iso = 'lv';
					$country_name = 'LATVIA';
				break;
				
				case 'LUXEMBOURGISH':
					$lang_iso = 'lb';
					$country_name = 'LEBANON';
				break;
				
				case 'ST_LUCIA':
					$lang_iso = 'lc';
					$country_name = 'ST_LUCIA';
				break;
				
				case 'LESOTHO':
					$lang_iso = 'ls';
					$country_name = 'LESOTHO';
				break;
				
				case 'LAO':
					$lang_iso = 'lo';
					$country_name = 'LAOS'; 
				break;
				
				case 'LIBERIA':
					$lang_iso = 'lr';
					$country_name = 'LIBERIA';
				break;

				case 'LIBYA':
					$lang_iso = 'ly';
					$country_name = 'Libya';
				break;

				case 'LIMBURGISH':
					$lang_iso = 'li';
					$country_name = 'LIECHTENSTEIN';
				break;

				case 'LINGALA':
					$lang_iso = 'ln';
				break;
				case 'LAO':
					$lang_iso = 'lo';
				break;
				case 'LITHUANIAN':
					$country_name = 'LITHUANIA';
					$lang_iso = 'lt';
				break;

				case 'LUBA_KATANGA':
					$lang_iso = 'lu';
					$country_name = 'LUXEMBOURG';
				break;
				case 'LATVIAN':
					$lang_iso = 'lv';
				break;				
				case 'MOROCCO':
					$lang_iso = 'ma';
					$country_name = 'MOROCCO';
				break;
				
				case 'MONACO':
					$country_name = 'mc';
					$lang_iso = 'Monaco';
				break;
		
				case 'MOLDOVIAN':
					$country_name = 'MOLDAVIA';
					$lang_iso = 'md';
				break;	
				
				case 'MONTENEGRIN':
					$lang_iso = 'me'; //Serbo-Croatian, Cyrillic, Latin
					$country_name = 'MONTENEGRO'; //Црна Гора
				break;
				
				case 'SAINT_MARTIN_FRENCH':
					$lang_iso = 'mf'; //
					$country_name = 'SAINT_MARTIN_(FRENCH_PART)'; 
				break;
				
				case 'MALAGASY':
					$lang_iso = 'mg';
					$country_name = 'MADAGASCAR';
				break;

				case 'MARSHALLESE':
					$lang_iso = 'mh';
					$country_name = 'MARSHALL_ISLANDS';
				break;
				
				case 'MAORI':
					$lang_iso = 'mi';
					$country_name = 'Maori';
				break;
				
				//Mi'kmaq hieroglyphic writing was a writing system and memory aid used by the Mi'kmaq, 
				//a First Nations people of the east coast of Canada, Mostly spoken in Nova Scotia and Newfoundland.
				case 'MIKMAQ':
					$lang_iso = 'mic';
					$country_name = 'CANADA';
				break;
				
				case 'MACEDONIAN':
					$lang_iso = 'mk';
					$country_name = 'MACEDONIA';
				break;
				case 'MALAYALAM':
					$lang_iso = 'ml';
				break;
				case 'MAURITANIAN':
					$lang_iso = 'mr';
					$country_name = 'Mauritania';
				break;

				case 'MAURITIUS':
					$lang_iso = 'mu';
					$country_name = 'MAURITIUS';
				break;

				case 'MONGOLIAN':
					$lang_iso = 'mn';
					$country_name = 'MONGOLIA';
				break;
				case 'MOLDAVIAN':
					$lang_iso = 'mo';
					$country_name = 'MACAU';
				break;
				case 'MONTSERRAT':
					$lang_iso = 'ms';
					$country_name = 'MONTSERRAT';
				break;
				
				case 'mz':
					$lang_iso = 'Mozambique';
					$country_name = 'MOZAMBIQUE';
				break;
				
				case 'mm':
					$lang_iso = 'Myanmar';
					$country_name = 'MYANMAR';
				break;
				
				case 'mp':
					$lang_iso = 'chamorro'; //Carolinian
					$country_name = 'NORTHERN_MARIANA_ISLANDS';
				break;
				
				case 'mw':
					$country_name = 'Malawi';
					$lang_iso = 'MALAWI';
				break;

				case 'my':
					$lang_iso = 'Myanmar';
					$country_name = 'MALAYSIA';
				break;

				case 'mv':
					$lang_iso = 'Maldives';
					$country_name = 'MALDIVES';
				break;

				case 'ml':
					$lang_iso = 'Mali';
					$country_name = 'MALI';
				break;

				case 'MALTESE':
					$lang_iso = 'mt';
					$country_name = 'MALTA';
				break;
				case 'BURMESE':
					$lang_iso = 'my';
				break;				
				case 'mx':
					$lang_iso = 'Mexico';
					$country_name = 'MEXICO';
				break;
				
				case 'ANTILLEAN-CREOLE':
					$lang_iso = 'mq'; // Antillean Creole (Créole Martiniquais)
					$country_name = 'MARTINIQUE';
				break;
				
				case 'na':
					$lang_iso = 'Nambia';
					$country_name = 'NAMBIA';
				break;
				
				case 'ni':
					$lang_iso = 'Nicaragua';
					$country_name = 'NICARAGUA';
				break;
				
				//Barber: Targuí, tuareg
				case 'ne':
					$lang_iso = 'Niger';
					$country_name = 'NIGER';
				break;
				
				//Mostly spoken on  Maré Island of the Loyalty Islands, New Caledonia. 
				case 'nen':
					$lang_iso = 'NENGONE';
					$country_name = 'NEW_CALEDONIA';
				break;
				
				case 'new':
					$lang_iso = 'NEW_LANGUAGE'; 
					$country_name = 'NEW_COUNTRY';
				break;
				
				case 'NENGONE':
					$lang_iso = 'nc'; //French, Nengone, Paicî, Ajië, Drehu
					$country_name = 'NEW_CALEDONIA';
				break;
				
				case 'nk':
					$lang_iso = 'Korea North';
					$country_name = 'KOREA_NORTH';
				break;
				
				case 'ng':
					$lang_iso = 'Nigeria';
					$country_name = 'NIGERIA';
				break;
				
				case 'nf':
					$lang_iso = 'Norfolk Island';
					$country_name = 'NORFOLK_ISLAND';
				break;
				
				case 'DUTCH':
					$lang_iso = 'nl'; //Netherlands, Flemish.
					$country_name = 'NETHERLANDS';
				break;
				
				case 'no':
					$lang_iso = 'Norway';
					$country_name = 'NORWAY';
				break;
				
				case 'np':
					$lang_iso = 'Nepal';
					$country_name = 'NEPAL';
				break;
				
				case 'nr':
					$lang_iso = 'Nauru';
					$country_name = 'NAURU';
				break;
				
				case 'NIUEAN':
					$lang_iso = 'niu'; //Niuean (official) 46% (a Polynesian language closely related to Tongan and Samoan)
					$country_name = 'NIUE'; // Niuean: Niuē
				break;
				
				case 'NU':
					$lang_iso = 'nu'; //Niuean (official) 46% (a Polynesian language closely related to Tongan and Samoan)
					$country_name = 'NIUE'; // Niuean: Niuē
				break;
				
				case 'nz':
					$lang_iso = 'New Zealand';
					$country_name = 'NEW_ZEALAND';
				break;
				
				case 'ny':
					$lang_iso = 'Chewa';
					$country_name = 'Nyanja';
				break;
				//langue d'oc
				case 'oc':
					$lang_iso = 'OCCITAN';
					$country_name = 'OCCITANIA';
				break;

				case 'oj':
					$lang_iso = 'ojibwa';
					$country_name = '';
				break;

				case 'om':
					$lang_iso = 'Oman';
					$country_name = 'OMAN';
				break;

				case 'or':
					$lang_iso = 'oriya';
					$country_name = '';
				break;

				case 'os':
					$lang_iso = 'ossetian';
					$country_name = '';
				break;

				case 'pa':
					$country_name = 'Panama';
					$lang_iso = 'PANAMA';
				break;


				case 'pe':
					$country_name = 'Peru';
					$lang_iso = 'PERU';
				break;

				case 'ph':
					$lang_iso = 'Philippines';
					$country_name = 'PHILIPPINES';
				break;
				
				case 'pf':
					$country_name = 'French Polynesia';
					$lang_iso = 'tahitian'; //Polynésie française
				break;
				
				case 'pg':
					$country_name = 'PAPUA_NEW_GUINEA';
					$lang_iso = 'Papua New Guinea';
				break;
				
				case 'pi':
					$lang_iso = 'pali';
					$country_name = '';
				break;
				
				case 'POLISH':
					$lang_iso = 'pl';
					$country_name = 'POLAND';
				break;
				
				case 'pn':
					$lang_iso = 'Pitcairn Island';
					$country_name = 'PITCAIRN_ISLAND';
				break;
				
				case 'PASHTO':
					$lang_iso = 'ps';
				
				break;
				
				case 'pr':
					$lang_iso = 'Puerto Rico';
					$country_name = 'PUERTO_RICO';
				
				break;
				
				case 'PORTUGUESE':
					$lang_iso = 'pt';
					$country_name = 'PORTUGAL';
				
				break;
				
				case 'PORTUGUESE_BRASIL':
					$lang_iso = 'pt_br'
					;
				break;				
				
				case 'pk':
					$lang_iso = 'Pakistan';
					$country_name = 'PAKISTAN';
				break;
				
				case 'pw':
					$country_name = 'Palau Island';
					$lang_iso = 'PALAU_ISLAND';
				break;
				
				case 'ps':
					$country_name = 'Palestine';
					$lang_iso = 'PALESTINE';
				break;
				
				case 'py':
					$country_name = 'PARAGUAY';
					$lang_iso = 'PARAGUAY';
				break;
				
				case 'qa':
					$lang_iso = 'Qatar';
					$country_name = 'QATAR';
				break;
				
				case 'QUECHUA':
					$lang_iso = 'qu';
				
				break;
				
				case 'ROMANSH':
					$lang_iso = 'rm';
				
				break;				
				
				//    rmn – Balkan Romani
				//    rml – Baltic Romani
				//    rmc – Carpathian Romani
				//    rmf – Kalo Finnish Romani
				//    rmo – Sinte Romani
				//    rmy – Vlax Romani
				//    rmw – Welsh Romani
				case 'ROMANI':
					$country_name = 'EASTEN_EUROPE';
					$lang_iso = 'ri';
				break;
				
				case 'KIRUNDI':
					$lang_iso = 'rn';
				
				break;
				
				case 'ROMANIAN':
					$country_name = 'ROMANIA';
					$lang_iso = 'ro';
				break;
				
				case 'ro_md':
				case 'ro_MD':
					$country_name = 'ROMANIA';
					$lang_iso = 'ROMANIAN_MOLDAVIA';
				break;
				
				case 'ro_ro':
				case 'ro_RO':
					$country_name = 'ROMANIA';
					$lang_iso = 'ROMANIAN_ROMANIA';
				break;
				
				case 'rn':
					$lang_iso = 'kirundi';
					$country_name = '';
				break;
				
				case 'rm':
					$country_name = '';
					$lang_iso = 'romansh'; //Switzerland
				break;
				
				case 'rs':
					$country_name = 'REPUBLIC_OF_SERBIA'; //Република Србија //Republika Srbija
					$lang_iso = 'serbian'; //Serbia, Србија / Srbija
				break;
				
				//case 'ru':
				//case 'ru_ru':
				case 'RUSSIAN':
					$country_name = 'RUSSIA';
					$lang_iso = 'ru';
				break;
				
				case 'KINYARWANDA':
					$country_name = 'RWANDA';
					$lang_iso = 'rw';
				break;

				
				case 'SANSKRIT':
					$lang_iso = 'sa';
					$country_name = 'SAUDI_ARABIA';
				break;
				
				case 'sb':
					$lang_iso = 'Solomon Islands';
					$country_name = 'SOLOMON_ISLANDS';
				break;
				
				case 'SARDINIAN':
					$lang_iso = 'sc';
					$country_name = 'SEYCHELLES';
				break;
				
				case 'sco':
					$lang_iso = 'SCOTISH';
					$country_name = 'Scotland';
				break;

				//scf – San Miguel Creole French (Panama)		
				case 'scf':
					$lang_iso = 'SAN_MIGUEL_CREOLE_FRENCH';  
					$country_name = 'SAN_MIGUEL';
				break;	
				
				case 'SINDHI':
					$lang_iso = 'sd';
					$country_name = 'SUDAN';
				break;
				
				case 'NORTHERN_SAMI':
					$lang_iso = 'se';
				break;
				
				case 'SANGO':
					$country_name = 'SINGAPORE';
					$lang_iso = 'sg';
				break;
				
				case 'SERBO_CROATIAN':
					$lang_iso = 'sh';
					$country_name = 'ST_HELENA';
				break;
				
				case 'SINHALA':
					$lang_iso = 'si';
					$country_name = 'SLOVENIA';
				break;
								
				case 'SLOVAK':
					$country_name = 'SLOVAKIA';
					$lang_iso = 'sk';
				break;
				

				
				case 'SLOVENIAN':
					$country_name = 'SIERRA_LEONE';
					$lang_iso = 'sl';
				break;
				
				case 'SAMOAN':
					$lang_iso = 'sm';
					$country_name = 'SAN_MARINO';
				break;
				
				case 'smi':
					$lang_iso = 'Sami';
					$country_name = 'Norway'; //Native to	Finland, Norway, Russia, and Sweden
				break;
				
				case 'SHONA':
					$lang_iso = 'sn';
					$country_name = 'SENEGAL';
				break;
				
				case 'SOMALI':
					$lang_iso = 'so';
					$country_name = 'SOMALIA';
				break;
				
				case 'ALBANIAN':
					$lang_iso = 'sq';
					$country_name = 'Albania';
				break;
				
				case 'SERBIAN':
					$lang_iso = 'sr';
					$country_name = 'SURINAME';
				break;
				
				case 'SWATI':
					$lang_iso = 'ss'; //Bari [Karo or Kutuk ('mother tongue', Beri)], Dinka, Luo, Murle, Nuer, Zande
					$country_name = 'REPUBLIC_OF_SOUTH_SUDAN';
				break;
				
				case 'sse':
					$lang_iso = 'STANDARD_SCOTTISH_ENGLISH';
					$country_name = 'Scotland';
				break;
				
				case 'SOTHO':
					$lang_iso = 'st';
					$country_name = 'SAO_TOME_&AMP;_PRINCIPE';
				break;
				
				case 'SUNDANESE':
					$lang_iso = 'su';
				
				break;
				

				
				case 'SINT_MAARTEN_DUTCH':
					$lang_iso = 'sx';
					$country_name = 'SINT_MAARTEN_(DUTCH_PART)';
				break;
				
				
				case 'SWAZILAND':
					$lang_iso = 'sz';
					$country_name = 'SWAZILAND';
				break;
				
				case 'SWEDISH':
					$lang_iso = 'sv';
					$country_name = 'EL_SALVADOR';
				// case 'se':
				// case 'sv-SE':
				// case 'sv-se':
				//Swedish (Sweden) (sv-SE)
				//$country_name = 'SWEDEN';
				break;

				case 'sy':
					$lang_iso = 'SYRIAC'; //arabic syrian
					$country_name = 'SYRIA';
				break;
				
				case 'SWAHILI':
					$lang_iso = 'sw';
				
				break;
				
				case 'tc':
					$lang_iso = 'Turks &amp; Caicos Is';
					$country_name = 'TURKS_&AMP;_CAICOS_IS';
				break;
				
				case 'td':
					$lang_iso = 'Chad';
					$country_name = 'CHAD';
				break;
				
				case 'FRENCH_TERRITORIES':
					$lang_iso = 'tf'; //
					$country_name = 'FRENCH_SOUTHERN_TERRITORIES'; //Terres australes françaises
				break;
				
				case 'TAJIKISTAN':
					$lang_iso = 'tj';
					$country_name = 'TAJIKISTAN';
				break;
				
				case 'TAMIL':
					$lang_iso = 'ta';
			
				break;
			
				case 'TELUGU':
					$lang_iso = 'te';
				
				break;
				
				case 'TAJIK':
					$lang_iso = 'tg';
					$country_name = 'TOGO';
				break;
				
				case 'THAI':
					$country_name = 'Thailand';
					$lang_iso = 'th';
				break;
				
				case 'TIGRINYA':
					$lang_iso = 'ti';
				
				break;
				
				case 'TURKMEN':
					$lang_iso = 'tk';
				
				break;				
				
				case 'TOKELAUAN':
					//260 speakers of Tokelauan, of whom 2,100 live in New Zealand, 
					//1,400 in Tokelau, 
					//and 17 in Swains Island
					$lang_iso = 'tk'; // /toʊkəˈlaʊən/ Tokelauans or Polynesians
					$country_name = 'TOKELAUAU'; //Dependent territory of New Zealand
				break;
				
				case 'TAGALOG':
					$country_name = 'East Timor';
					$lang_iso = 'tl';
				break;	
				
				
				case 'TRINIDAD_TOBAGO':
					$country_name = 'Trinidad &amp; Tobago';
					$lang_iso = 'tt';
				break;
				
				case 'TSWANA':
					$lang_iso = 'tn';
					$country_name = 'TUNISIA';
				break;
				
				case 'TONGA':
					$country_name = 'TONGA';
					$lang_iso = 'to';
				break;
								
				case 'TURKMENISTAN':
					$lang_iso = 'tm';
					$country_name = 'TURKMENISTAN';
				break;
				
				case 'TURKISH':
					$lang_iso = 'tr';
					$country_name = 'TURKEY';
				
				case 'TSONGA':
					$lang_iso = 'ts';
				
				break;
				
				case 'TUVALU':
					$lang_iso = 'tv';
					$country_name = 'TUVALU';
				break;
				
				case 'TATAR':
					$lang_iso = 'tt';
				
				break;
				
				case 'TAIWANESE_HOKKIEN': //Taibei Hokkien											
				case 'TWI':				
					$lang_iso = 'tw'; 
					$country_name = 'TAIWAN';
				break;
				
				case 'TAHITIAN':
					$lang_iso = 'ty';
				
				break;				
				
				case 'TANZANIA':
					$country_name = 'TANZANIA';
					$lang_iso = 'tz';
				break;


				
				case 'UIGHUR':
					$lang_iso = 'ug';
					$country_name = 'UGANDA';
				break;

				case 'UKRAINEAN':
					$lang_iso = 'uk';				
					//$lang_iso = 'ua';
					$country_name = 'UKRAINE';
				break;

				case 'ENGLISH_US':
					$lang_iso = 'en-us';
					$country_name = 'UNITED_STATES_OF_AMERICA';
				break;
				
				case 'URDU':
					$lang_iso = 'ur';
				
				break;				
				
				case 'UZBEK':
					$lang_iso = 'uz'; //Uyghur Perso-Arabic alphabet
					$country_name = 'UZBEKISTAN';
				break;
				
				case 'uy':
					$lang_iso = 'Uruguay';
					$country_name = 'URUGUAY';
				break;
				
				case 'LATIN':
					$country_name = 'VATICAN_CITY'; //Holy See
					$lang_iso = 'lat';
				break;
				
				case 'VENDA':
					$lang_iso = 've';
				
				break;				
				
				
				case 'VINCENTIAN-CREOLE':
					$country_name = 'ST_VINCENT_&AMP;_GRENADINES'; //
					$lang_iso = 'vc';
				break;
				
				case 'VENDA':
					$lang_iso = 've';
					$country_name = 'VENEZUELA';
				break;
				
				case 'VIETNAMESE':
					$lang_iso = 'vi';
					$country_name = 'VIRGIN_ISLANDS_(USA)';
				break;
				
				case 'VOLAPUK':
					$lang_iso = 'vo';
				
				break;				
				
				case 'FRENCH_VIETNAM':
					$lang_iso = 'fr_vn';
					$country_name = 'VIETNAM';
				break;
				
				case 'VIETNAM':
					$lang_iso = 'vn';
					$country_name = 'VIETNAM';
				break;

				case 'vg':
					$lang_iso = 'Virgin Islands (Brit)';
					$country_name = 'VIRGIN_ISLANDS_(BRIT)';
				break;
				
				case 'Vanuatu':
					$lang_iso = 'vu';
					$country_name = 'VANUATU';
				break;
				
				case 'WALLISIAN':
					$lang_iso = 'wls';
					$country_name = 'WALES';
				break;
				
				case 'WF':
					$country_name = 'TERRITORY_OF_THE_WALLIS_AND_FUTUNA_ISLANDS';
					$lang_iso = 'wf'; 
					//Wallisian, or ʻUvean 
					//Futunan - Austronesian, Malayo-Polynesian
				break;
				
				case 'SAMOA':
					$country_name = 'ws';
					$lang_iso = 'Samoa';
				break;
				
				case 'YEMEN':
					$lang_iso = 'ye';
					$country_name = 'YEMEN';
				break;
				
				case 'MAYOTTE':
					$lang_iso = 'yt'; //Shimaore:
					$country_name = 'DEPARTMENT_OF_MAYOTTE'; //Département de Mayotte
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
					$country_name = 'SOUTH_AFRICA';
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
				
				case 'ZAMBIAN':
					$lang_iso = 'zm';
					$country_name = 'ZAMBIA';
				break;
				case 'ZIMBABWE':
					$lang_iso = 'zw';
					$country_name = 'ZIMBABWE';
				break;
				case 'ZULU':
					$lang_iso = 'zu';
					$country_name = 'ZULU';
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

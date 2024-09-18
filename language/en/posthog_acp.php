<?php
/**
*
* PostHog extension for the phpBB Forum Software package.
* Forked from Google Analytics extension for the phpBB Forum Software package.
*
* @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>, (c) 2024 Clutch Engineering <https://clutch.engineering>
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = array();
}

// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_POSTHOG'				=> 'PostHog',
	'ACP_POSTHOG_ID'			=> 'PostHog Key',
	'ACP_POSTHOG_HOST'			=> 'PostHog Host',
	'ACP_POSTHOG_ID_EXPLAIN'	=> 'Enter your PostHog Tracking Key <samp>phc_...</samp>. Leave this field empty if you do not use PostHog.<br /><br />PostHog can track your registered users across multiple devices and sessions, for a more accurate user count in your reports.',
	'ACP_POSTHOG_ID_INVALID'	=> '"%s" is not a valid PostHog Key.<br />It should be in the form "phc_..."',
	'ACP_POSTHOG_HOST_EXPLAIN'	=> 'Select your PostHog Tracking Host.',
	'ACP_POSTHOG_HOST_INVALID'	=> '"%s" is not a valid PostHog Host.<br />It should be either https://eu.i.posthog.com or https://us.i.posthog.com.',
	'ACP_POSTHOG_EU_HOST'		=> 'European Union host',
	'ACP_POSTHOG_US_HOST'		=> 'US host',
));

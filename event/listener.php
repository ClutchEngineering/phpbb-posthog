<?php
/**
 *
 * PostHog extension for the phpBB Forum Software package.
 * Forked from Google Analytics extension for the phpBB Forum Software package on 2024-09-18.
 *
 * @copyright (c) 2014 phpBB Limited <https://www.phpbb.com>, (c) 2024 Clutch Engineering <https://clutch.engineering>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace clutchengineering\posthog\event;

use phpbb\config\config;
use phpbb\language\language;
use phpbb\template\template;
use phpbb\user;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 */
class listener implements EventSubscriberInterface
{
	/** @var config */
	protected $config;

	/** @var language */
	protected $language;

	/** @var template */
	protected $template;

	/** @var user */
	protected $user;

	/**
	 * Constructor
	 *
	 * @param config   $config   Config object
	 * @param language $language Language object
	 * @param template $template Template object
	 * @param user     $user     User object
	 * @access public
	 */
	public function __construct(config $config, language $language, template $template, user $user)
	{
		$this->config = $config;
		$this->language = $language;
		$this->template = $template;
		$this->user = $user;
	}

	/**
	 * Assign functions defined in this class to event listeners in the core
	 *
	 * @return array
	 * @static
	 * @access public
	 */
	public static function getSubscribedEvents()
	{
		return [
			'core.acp_board_config_edit_add'	=> 'add_posthog_configs',
			'core.page_header'					=> 'load_posthog',
			'core.validate_config_variable'		=> 'validate_posthog_configuration',
		];
	}

	/**
	 * Load PostHog js code
	 *
	 * @return void
	 * @access public
	 */
	public function load_posthog()
	{
		$this->template->assign_vars([
			'POSTHOG_ID'		=> $this->config['posthog_id'],
			'POSTHOG_HOST'		=> $this->config['posthog_host'],
		]);
	}

	/**
	 * Add config vars to ACP Board Settings
	 *
	 * @param \phpbb\event\data $event The event object
	 * @return void
	 * @access public
	 */
	public function add_posthog_configs($event)
	{
		// Add a config to the settings mode, after warnings_expire_days
		if ($event['mode'] === 'settings' && isset($event['display_vars']['vars']['warnings_expire_days']))
		{
			// Load language file
			$this->language->add_lang('posthog_acp', 'phpbb/posthog');

			// Store display_vars event in a local variable
			$display_vars = $event['display_vars'];

			// Define the new config vars
			$ga_config_vars = [
				'legend_posthog' => 'ACP_POSTHOG',
				'posthog_id' => [
					'lang'		=> 'ACP_POSTHOG_ID',
					'validate'	=> 'posthog_id',
					'type'		=> 'text:40:20',
					'explain'	=> true,
				],
				'posthog_host' => [
					'lang'		=> 'ACP_POSTHOG_HOST',
					'validate'	=> 'int',
					'type'		=> 'select',
					'function'	=> 'build_select',
					'params'	=> [[
						0	=> 'ACP_POSTHOG_EU_HOST',
						1	=> 'ACP_POSTHOG_US_HOST',
					], '{CONFIG_VALUE}'],
					'explain'	=> true,
				],
			];

			// Add the new config vars after warnings_expire_days in the display_vars config array
			$insert_after = ['after' => 'warnings_expire_days'];
			$display_vars['vars'] = phpbb_insert_config_array($display_vars['vars'], $ga_config_vars, $insert_after);

			// Update the display_vars event with the new array
			$event['display_vars'] = $display_vars;
		}
	}

	/**
	 * Validate the PostHog configuration
	 *
	 * @param \phpbb\event\data $event The event object
	 * @return void
	 * @access public
	 */
	public function validate_posthog_configuration($event)
	{
		// Check if the validate test is for posthog
		if ($event['config_definition']['validate'] !== 'posthog_id' || empty($event['cfg_array']['posthog_id']))
		{
			return;
		}

		// Store the input and error event data
		$input = $event['cfg_array']['posthog_id'];
		$error = $event['error'];

		// Add error message if the input is not a valid PostHog Key
		if (!preg_match('^phc_[\w\d]{43}$', $input))
		{
			$error[] = $this->language->lang('ACP_POSTHOG_ID_INVALID', $input);
		}

		// Update error event data
		$event['error'] = $error;
	}
}

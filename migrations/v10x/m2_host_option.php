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

namespace clutchengineering\posthog\migrations\v10x;

/**
 * Migration stage 2: Add PostHog host config option
 */
class m3_tag_option extends \phpbb\db\migration\migration
{
	/**
	 * {@inheritdoc}
	 */
	public static function depends_on()
	{
		return ['\clutchengineering\posthog\migrations\v10x\m1_initial_data'];
	}

	/**
	 * {@inheritdoc}
	 */
	public function effectively_installed()
	{
		return $this->config->offsetExists('posthog_host');
	}

	/**
	 * {@inheritdoc}
	 *
	 * Defaults to EU host.
	 */
	public function update_data()
	{
		return [
			['config.add', ['posthog_host', (int) 0]],
		];
	}
}

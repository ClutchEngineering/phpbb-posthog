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
 * Migration stage 1: Initial data changes to the database
 */
class m1_initial_data extends \phpbb\db\migration\migration
{
	/**
	 * Assign migration file dependencies for this migration
	 *
	 * @return array Array of migration files
	 * @static
	 * @access public
	 */
	public static function depends_on()
	{
		return ['\phpbb\db\migration\data\v310\gold'];
	}

	/**
	 * Add PostHog data to the database.
	 *
	 * @return array Array of table data
	 * @access public
	 */
	public function update_data()
	{
		return [
			['config.add', ['posthog_id', '']],
		];
	}
}

<?php
/**
 *
* PostHog extension for the phpBB Forum Software package.
* Forked from Google Analytics extension for the phpBB Forum Software package.
*
* @copyright (c) 2021 phpBB Limited <https://www.phpbb.com>, (c) 2024 Clutch Engineering <https://clutch.engineering>
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace clutchengineering\posthog;

use phpbb\extension\base;

class ext extends base
{
	/**
	 * {@inheritDoc}
	 */
	public function is_enableable()
	{
		return phpbb_version_compare(PHPBB_VERSION, '3.2.0', '>=')
			&& phpbb_version_compare(PHPBB_VERSION, '4.0.0-dev', '<');
	}
}

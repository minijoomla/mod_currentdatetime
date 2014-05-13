<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_currentdatetime
 *
 * @copyright   Copyright (C) 2013 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once dirname(__FILE__) . '/helper.php';

$params->id = $module->id;

$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

$items = $params->get('items');

foreach($items as $item)
{
	switch ($item)
	{
		case 'analog':
			$analog_clock = ModDateTimeHelper::getAnalogClock($params);
			break;

		case 'digital':
			$digital_clock = ModDateTimeHelper::getDigitalClock($params);
			break;

		case 'day':
			$offset   = $params->get('offset', 'UTC');
			$today    = new JDate('now', $offset);
			$day_name = $today->calendar('l',true);
			break;

		case 'timezone':
			$timezone = ModDateTimeHelper::getTimeZoneText($params);
			break;

		case 'gregorian':
			$gregorian_date = ModDateTimeHelper::getGregorianDate($params);
			break;

		case 'solar':
			$solar_date = ModDateTimeHelper::getSolarDate($params);
			break;

		case 'lunar':
			$lunar_date = ModDateTimeHelper::getLunarDate($params);
			break;
	}
}

require JModuleHelper::getLayoutPath('mod_currentdatetime', $params->get('layout', 'default'));

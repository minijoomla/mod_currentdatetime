<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_currentdatetime
 *
 * @copyright   Copyright (C) 2013 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<script type="text/javascript" >
	var currentTime_<?php echo $params->id; ?>_CoolClock = new Date("<?php echo $analog_clock->time; ?>");

	var jstime_<?php echo $params->id; ?>_CoolClock = new Date().getTime() - 1000;

	function leoClockUpdate_<?php echo $params->id; ?>_CoolClock()
	{
		jstime_<?php echo $params->id; ?>_CoolClock = jstime_<?php echo $params->id; ?>_CoolClock + 1000;
		var jsnow_<?php echo $params->id; ?>_CoolClock = new Date().getTime();
		var offset_<?php echo $params->id; ?>_CoolClock = jsnow_<?php echo $params->id; ?>_CoolClock - jstime_<?php echo $params->id; ?>_CoolClock;
		if(offset_<?php echo $params->id; ?>_CoolClock > 1000)
		{
			jstime_<?php echo $params->id; ?>_CoolClock = jstime_<?php echo $params->id; ?>_CoolClock + offset_<?php echo $params->id; ?>_CoolClock;
			var offsetseconds_<?php echo $params->id; ?>_CoolClock = Math.round(offset_<?php echo $params->id; ?>_CoolClock / 1000);
			currentTime_<?php echo $params->id; ?>_CoolClock.setSeconds(currentTime_<?php echo $params->id; ?>_CoolClock.getSeconds() + offsetseconds_<?php echo $params->id; ?>_CoolClock);
		}

		currentTime_<?php echo $params->id; ?>_CoolClock.setSeconds(currentTime_<?php echo $params->id; ?>_CoolClock.getSeconds() + 1);
		return currentTime_<?php echo $params->id; ?>_CoolClock;
	}
</script>
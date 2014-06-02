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
	var currentTime_<?php echo $params->id; ?> = new Date(<?php echo ($digital_clock->source == 'gmt' ? '"' . $digital_clock->time . '"' : ''); ?>);
	var format_<?php echo $params->id; ?> = "<?php echo $digital_clock->format; ?>";
	var seconds_<?php echo $params->id; ?> = <?php echo $digital_clock->seconds; ?>;
	var leadingZeros_<?php echo $params->id; ?> = "<?php echo $digital_clock->leadingZeros; ?>";

	var jstime_<?php echo $params->id; ?> = new Date().getTime() - 1000;

	function leoClockUpdate_<?php echo $params->id; ?>()
	{
		jstime_<?php echo $params->id; ?> = jstime_<?php echo $params->id; ?> + 1000;
		var jsnow_<?php echo $params->id; ?> = new Date().getTime();
		var offset_<?php echo $params->id; ?> = jsnow_<?php echo $params->id; ?> - jstime_<?php echo $params->id; ?>;
		if(offset_<?php echo $params->id; ?> > 1000)
		{
			jstime_<?php echo $params->id; ?> = jstime_<?php echo $params->id; ?> + offset_<?php echo $params->id; ?>;
			var offsetseconds_<?php echo $params->id; ?> = Math.round(offset_<?php echo $params->id; ?> / 1000);
			currentTime_<?php echo $params->id; ?>.setSeconds(currentTime_<?php echo $params->id; ?>.getSeconds() + offsetseconds_<?php echo $params->id; ?>);
		}

		currentTime_<?php echo $params->id; ?>.setSeconds(currentTime_<?php echo $params->id; ?>.getSeconds() + 1);
		var currentHours_<?php echo $params->id; ?> = currentTime_<?php echo $params->id; ?>.getHours();	
		var currentMinutes_<?php echo $params->id; ?> = currentTime_<?php echo $params->id; ?>.getMinutes();
		var currentSeconds_<?php echo $params->id; ?> = currentTime_<?php echo $params->id; ?>.getSeconds();

		// Handles 12h format
		if(format_<?php echo $params->id; ?> == "12h")
		{
			//convert 24 to 00
			if(currentHours_<?php echo $params->id; ?> == 24)
			{
				currentHours_<?php echo $params->id; ?> = 0;
			}

			//save a AM/PM variable
			if(currentHours_<?php echo $params->id; ?> < 12)
			{
				var ampm_<?php echo $params->id; ?> = "<?php echo JText::_('AM_SHORT'); ?>";
			}

			if(currentHours_<?php echo $params->id; ?> >= 12)
			{
				var ampm_<?php echo $params->id; ?> = "<?php echo JText::_('PM_SHORT'); ?>";
				if(currentHours_<?php echo $params->id; ?> > 12)
				{
					currentHours_<?php echo $params->id; ?> = currentHours_<?php echo $params->id; ?> - 12;
				}
			}
		}

		// Pad the hours, minutes and seconds with leading zeros, if required
		if(leadingZeros_<?php echo $params->id; ?> == 1)
		{
			currentHours_<?php echo $params->id; ?> = ( currentHours_<?php echo $params->id; ?> < 10 ? "0" : "" ) + currentHours_<?php echo $params->id; ?>;
		}

		if(leadingZeros_<?php echo $params->id; ?> == 1 || leadingZeros_<?php echo $params->id; ?> == 'nothour')
		{
			currentMinutes_<?php echo $params->id; ?> = ( currentMinutes_<?php echo $params->id; ?> < 10 ? "0" : "" ) + currentMinutes_<?php echo $params->id; ?>;
			currentSeconds_<?php echo $params->id; ?> = ( currentSeconds_<?php echo $params->id; ?> < 10 ? "0" : "" ) + currentSeconds_<?php echo $params->id; ?>;
		}

		// Compose the string for display
		var currentTimeString_<?php echo $params->id; ?> = currentHours_<?php echo $params->id; ?> + ":" + currentMinutes_<?php echo $params->id; ?>;

		// Add seconds if that has been selected
		if(seconds_<?php echo $params->id; ?>)
		{
			currentTimeString_<?php echo $params->id; ?> = currentTimeString_<?php echo $params->id; ?> + ":" + currentSeconds_<?php echo $params->id; ?>;
		}

		// Add AM/PM if 12h format
		if(format_<?php echo $params->id; ?> == "12h")
		{
			currentTimeString_<?php echo $params->id; ?> = currentTimeString_<?php echo $params->id; ?> + " " + ampm_<?php echo $params->id; ?>;
		}

		// Translate numbers
		var numbers = new Array ("<?php echo JText::_('N0'); ?>", "<?php echo JText::_('N1'); ?>", "<?php echo JText::_('N2'); ?>", "<?php echo JText::_('N3'); ?>", "<?php echo JText::_('N4'); ?>", "<?php echo JText::_('N5'); ?>", "<?php echo JText::_('N6'); ?>", "<?php echo JText::_('N7'); ?>", "<?php echo JText::_('N8'); ?>", "<?php echo JText::_('N9'); ?>");

		for(var i = 0; i <= 9; i++)
		{
			currentTimeString_<?php echo $params->id; ?> = currentTimeString_<?php echo $params->id; ?>.replace(new RegExp(i, 'gi'), numbers[i]);
		}

		// Update the time display
		document.getElementById("leoClockTime_<?php echo $params->id; ?>").innerHTML = currentTimeString_<?php echo $params->id; ?>;
	}

	leoClockUpdate_<?php echo $params->id; ?>();
	setInterval('leoClockUpdate_<?php echo $params->id; ?>()', 1000);
</script>
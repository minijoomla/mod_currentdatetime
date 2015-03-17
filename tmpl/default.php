<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_currentdatetime
 *
 * @copyright   Copyright (C) 2013 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$document = JFactory::getDocument();
$jsPath   = JURI::root(true) . '/modules/mod_currentdatetime/js';

if($params->get('css'))
{
	$document->addStyleDeclaration($params->get('css'));
}

if(in_array("analog", $items))
{
	if($params->get('jquery',1))
	{
		$joomlaVersion = new JVersion();

		if($joomlaVersion->isCompatible('3'))
		{
			JHtml::_('jquery.framework');
		}
		else
		{
			$document->addScript($jsPath . '/25/jquery.min.js');
		}
	}

	$browser = new JBrowser();

	if($params->get('debug_mode',0))
	{
		if($browser->isBrowser('msie'))
		{
			$document->addScript($jsPath . '/nomin/excanvas.js');
		}

		$document->addScript($jsPath . '/nomin/coolclock.js');
		$document->addScript($jsPath . '/nomin/moreskins.js');
	}
	else
	{
		if($browser->isBrowser('msie'))
		{
			$document->addScript($jsPath . '/excanvas.min.js');
		}

		$document->addScript($jsPath . '/coolclock.min.js');
		$document->addScript($jsPath . '/moreskins.min.js');
	}
}
?>

<div class="datetime<?php echo $params->get('class_sfx') ?>" id="datetime_<?php echo $module->id; ?>">
<?php
	// echo items by order
	foreach($items as $item)
	{
		switch ($item)
		{
			case 'analog':
				echo '<div class="time analog">' . $analog_clock->string . '</div>';
				if($params->get('analog_source') == 'gmt')
				{
					require JPATH_ROOT . '/modules/mod_currentdatetime/js/coolclock-leoclock.php';
				}
				break;

			case 'digital':
				echo '<div class="time digital">' . $digital_clock->html . '</div>';
				require JPATH_ROOT . '/modules/mod_currentdatetime/js/leoclock.php';
				break;

			case 'day':
				echo '<div class="dayname">' . $day_name . '</div>';
				break;

			case 'timezone':
				echo '<div class="timezone">' . $timezone . '</div>';
				break;

			case 'gregorian':
				echo '<div class="date gregorian">' . $gregorian_date . '</div>';
				break;

			case 'solar':
				echo '<div class="date solar">' . $solar_date . '</div>';
				break;

			case 'lunar':
				echo '<div class="date lunar">' . $lunar_date . '</div>';
				break;
		}
	}
?>
</div>

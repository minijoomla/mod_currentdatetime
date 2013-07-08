<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_currentdatetime
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

if($params->get('css'))
{
	$document = JFactory::getDocument();
	$document->addStyleDeclaration($params->get('css'));
}

if(in_array("analog", $items))
{
	$document = JFactory::getDocument();

	if($params->get('jquery',1))
	{
		$joomlaVersion = new JVersion();
		if($joomlaVersion->isCompatible('3'))
		{
			JHtml::_('jquery.framework');
		}
		else
		{
			$document->addScript(JURI::root().'modules/mod_currentdatetime/js/25/jquery.min.js');
		}
	}

	if($params->get('debug_mode',0))
	{
		$browser = new JBrowser();
		if($browser->isBrowser('msie'))
		{
			$document->addScript(JURI::root().'modules/mod_currentdatetime/js/nomin/excanvas.js');
		}
		$document->addScript(JURI::root().'modules/mod_currentdatetime/js/nomin/coolclock.js');
		$document->addScript(JURI::root().'modules/mod_currentdatetime/js/nomin/moreskins.js');
	}
	else
	{
		$browser = new JBrowser();
		if($browser->isBrowser('msie'))
		{
			$document->addScript(JURI::root().'modules/mod_currentdatetime/js/excanvas.min.js');
		}
		$document->addScript(JURI::root().'modules/mod_currentdatetime/js/coolclock.min.js');
		$document->addScript(JURI::root().'modules/mod_currentdatetime/js/moreskins.min.js');
	}
}
?>

<div class="datetime<?php echo $moduleclass_sfx ?>">
<?php
	// echo items by order
	foreach($items as $item)
	{
		switch ($item)
		{
			case 'analog':
				echo '<div class="time analog">'.$analog_clock.'</div>';
				if($params->get('analog_source') == 'gmt')
				{
					require_once JPATH_BASE . '/modules/mod_currentdatetime/js/coolclock-leoclock.php';
				}
				break;
			case 'digital':
				echo '<div class="time digital">'.$digital_clock->html.'</div>';
				require_once JPATH_BASE . '/modules/mod_currentdatetime/js/leoclock.php';
				break;
			case 'day':
				echo '<div class="dayname">'.$day_name.'</div>';
				break;
			case 'timezone':
				echo '<div class="dayname">'.$timezone.'</div>';
				break;
			case 'gregorian':
				echo '<div class="date gregorian">'.$gregorian_date.'</div>';
				break;
			case 'solar':
				echo '<div class="date solar">'.$solar_date.'</div>';
				break;
			case 'lunar':
				echo '<div class="date lunar">'.$lunar_date.'</div>';
				break;
		}
	}
?>
</div>

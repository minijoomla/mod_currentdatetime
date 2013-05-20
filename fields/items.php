<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_PLATFORM') or die;

JFormHelper::loadFieldClass('list');

/**
 * Form Field class for the Joomla Platform.
 * Supports a generic list of options.
 *
 * @package     Joomla.Platform
 * @subpackage  Form
 * @since       11.1
 */
class JFormFieldItems extends JFormFieldList
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  11.1
	 */
	protected $type = 'Items';

	/**
	 * Method to get the field input markup for a generic list.
	 * Use the multiple attribute to enable multiselect.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   11.1
	 */
	protected function getInput()
	{
		JHtml::_('jquery.ui', array('core', 'sortable'));
	
		$document = JFactory::getDocument();
		$document->addScript(JURI::root().'modules/mod_currentdatetime/js/jquery-chosen-sortable.js');

		$script =
'jQuery(function(){
	jQuery(".chzn-sortable").chosenSortable();
});';

		$document->addScriptDeclaration($script);

		$html = parent::getInput();
		
		return $html;
	}

	/**
	 * Method to get the field options.
	 *
	 * @return  array  The field option objects.
	 *
	 * @since   11.1
	 */
	protected function getOptions()
	{
		$value = $this->value;

		// Build the Education filter options.
		$options = array();

		$options['analog']    = JHtml::_('select.option', 'analog', JText::_('MOD_CURRENTDATETIME_ANALOG_CLOCK'));
		$options['digital']   = JHtml::_('select.option', 'digital', JText::_('MOD_CURRENTDATETIME_DIGITAL_CLOCK'));
		$options['day']       = JHtml::_('select.option', 'day', JText::_('MOD_CURRENTDATETIME_DAY_NAME'));
		$options['gregorian'] = JHtml::_('select.option', 'gregorian', JText::_('MOD_CURRENTDATETIME_GREGORIAN_DATE'));
		$options['solar']     = JHtml::_('select.option', 'solar', JText::_('MOD_CURRENTDATETIME_SOLAR_DATE'));
		$options['lunar' ]    = JHtml::_('select.option', 'lunar', JText::_('MOD_CURRENTDATETIME_LUNAR_DATE'));

		// sort options based on value
		$options = $this->sort_array_from_array($options,$value);

		return $options;
	}

	// SOrt an array based on other array
	// @param $array array need to sort
	// @param $orderArray based array consider as correct order;
	function sort_array_from_array($array,$orderArray)
	{
		$ordered = array();
		foreach($orderArray as $key => $value)
		{
			if(array_key_exists($value,$array))
			{
				$ordered[] = $array[$value];
				unset($array[$value]);
			}
		}
		return $ordered + $array;
	}
}

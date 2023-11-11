<?php
namespace GHSVS\Plugin\System\IconsGhsvs\Field;

\defined('_JEXEC') or die;

use Joomla\CMS\Form\FormField;
use Joomla\CMS\Language\Text;

class IconsGhsvsInstalledField extends FormField
{
	protected $type = 'IconsGhsvsInstalled';

	protected function getInput()
	{
		if (is_file(JPATH_SITE . '/media/iconsghsvs/svgs/prepped-icons.json'))
		{
			return '';
		}

		return Text::_('PLG_SYSTEM_ICONSGHSVS_ICONSGHSVS_MISSING');
	}
}

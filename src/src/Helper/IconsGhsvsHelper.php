<?php

namespace GHSVS\Plugin\System\IconsGhsvs\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Utility\Utility;
use Joomla\Registry\Registry;

class IconsGhsvsHelper
{

	/** Beispiel: {svg{bi/x-circle-fill}class="text-danger"}
	 * $txt Search in for $muster and repalce $muster with SVG or SPAN/SVG.
	 * $options array:
	 * addSpan Surround SVG with SPAN.
	 * spanClass CSS class of surrounding SPAN.
	 * removeTag Remove tag/$muster from $txt if no SVG file found
	 * removeSpaces Removes newlines and spaces around tag respectively SVG.
	*/
	public function replaceSvgPlaceholders(
		string $txt,
		$options = []
	) {
		$matches = [];
		$options = new Registry($options);

		if (strpos($txt, '{svg{') !== false)
		{
			if ($options->get('removeSpaces'))
			{
				$muster  = '\s*{svg{([^}]+)}[^}]*}\s*';
			}
			else
			{
				$muster  = '{svg{([^}]+)}[^}]*}';
			}

			$results = [];

			if (preg_match_all('/' . $muster . '/m', $txt, $matches, PREG_SET_ORDER))
			{
				foreach ($matches as $key => $match)
				{
					$results['replaceWhat'][$key] = $match[0];
					$svg = JPATH_SITE . '/media/iconsghsvs/svgs/' . $match[1] . '.svg';

					if (file_exists($svg))
					{
						$svg = file_get_contents($svg);

						if ($options->get('addSpan'))
						{
							$class = trim($options->get('spanClass', ''));
							$passedAttributes = Utility::parseAttributes($match[0]);

							if (isset($passedAttributes['class']))
							{
								$class .= ' ' . $passedAttributes['class'];
							}

							$svg   = '<span aria-hidden="true"' . ($class ? ' class="' . $class . '"' : '') . '>'
								. $svg . '</span>';

							if (!empty($passedAttributes['href']))
							{
								$svg = '<a href="' . $passedAttributes['href'] . '">' . $svg
									. '</a>';
							}
						}
						$results['replaceWith'][$key] = $svg;
					}
					elseif ($options->get('removeTag'))
					{
						$results['replaceWith'][$key] = '';
					}
					else
					{
						unset($results['replaceWhat'][$key]);
					}
				}

				if (!empty($results['replaceWith']))
				{
					$txt = str_replace($results['replaceWhat'], $results['replaceWith'], $txt);
				}
			}
		}

		return $txt;
	}
}

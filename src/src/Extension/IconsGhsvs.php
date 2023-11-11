<?php
namespace GHSVS\Plugin\System\IconsGhsvs\Extension;

\defined('_JEXEC') or die;

use Exception;
use Joomla\Application\ApplicationInterface;
use Joomla\CMS\Application\CMSApplication;
use Joomla\CMS\Access\Access;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Form\Form;
use Joomla\Input\Input;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\Event\DispatcherInterface;
use GHSVS\Plugin\System\IconsGhsvs\Helper\IconsGhsvsHelper;

final class IconsGhsvs extends CMSPlugin
{
	/**
	 * Load plugin language files automatically
	 *
	 * @var    boolean
	 * @since  3.6.3
	 */
	protected $autoloadLanguage = true;

	// Are SVGG icons installed?
	protected $iconsghsvsinstalled = false;

	private $helper;

	public function __construct(
		DispatcherInterface $dispatcher,
		array $config,
		IconsGhsvsHelper $helper,
	) {
		parent::__construct($dispatcher, $config);

		$this->helper = $helper;

		$this->iconsghsvsinstalled =
			is_file(JPATH_SITE . '/media/iconsghsvs/svgs/prepped-icons.json');
	}

	public function onAfterRender()
	{
		if (!$this->getApplication()->isClient('site'))
		{
			return;
		}

		if ($this->params->get('svgSupport', 1) === 1 && $this->iconsghsvsinstalled)
		{
			$html   = [];
			$all    = $this->getApplication()->getBody();
			$checks = ['<body ', '<body>'];
			$sepa   = '';

			foreach ($checks as $check)
			{
				if (strpos($all, $check) !== false)
				{
					$html = explode($check, $all);

					if (count($html) === 2)
					{
						$sepa = $check;
					}
					break;
				}
			}

			if ($sepa === '')
			{
				return;
			}

			$done = 0;

			// Beispiel: {svg{bi/x-circle-fill}class="text-danger" href="//ghsvs.de"}
			if (strpos($html[1], '{svg{') !== false)
			{
				$html[1] = $this->helper->replaceSvgPlaceholders(
					$html[1],
					[
						'addSpan'   => $this->params->get('svgSpan', 1),
						'spanClass' => $this->params->get('svgSpanClass', 'svgSpan'),
						'removeTag' => $this->params->get('removeTagIfNoSvg', 1),
						'removeSpaces' => $this->params->get('svgRemoveSpaces', 0),
					]
				);
				$done = 1;
			}

			if ($done)
			{
				$this->getApplication()->setBody(implode($sepa, $html));
			}
		}
	}
}

<?php
\defined('_JEXEC') or die;

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use GHSVS\Plugin\System\IconsGhsvs\Extension\IconsGhsvs;
use GHSVS\Plugin\System\IconsGhsvs\Helper\IconsGhsvsHelper;

return new class () implements ServiceProviderInterface
{
	public function register(Container $container): void
	{
		$container->set(
			PluginInterface::class,
			function (Container $container)
			{
				$dispatcher = $container->get(DispatcherInterface::class);
				$plugin = new IconsGhsvs(
					$dispatcher,
					(array) PluginHelper::getPlugin('system', 'iconsghsvs'),
					new IconsGhsvsHelper()
				);
				$plugin->setApplication(Factory::getApplication());

				return $plugin;
			}
		);
	}
};

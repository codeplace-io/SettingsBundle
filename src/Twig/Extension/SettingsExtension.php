<?php
declare(strict_types=1);

namespace Codeplace\SettingsBundle\Twig\Extension;

use Codeplace\SettingsBundle\Service\SettingsService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class SettingsExtension extends AbstractExtension
{
    private SettingsService $settingsService;

    public function __construct(SettingsService $settingsService)
    {
        $this->settingsService = $settingsService;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction(
                'get_setting_value',
                [$this, 'getSettingValue']
            ),
        ];
    }

    public function getSettingValue(string $property)
    {
        return $this->settingsService->get($property);
    }
}

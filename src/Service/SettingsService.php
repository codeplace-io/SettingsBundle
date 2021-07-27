<?php
declare(strict_types=1);

namespace Codeplace\SettingsBundle\Service;

use Codeplace\SettingsBundle\Model\SettingsInterface;
use Codeplace\SettingsBundle\Provider\SettingsProvider;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class SettingsService
{
    private SettingsProvider $settingsProvider;

    public function __construct(SettingsProvider $settingsProvider)
    {
        $this->settingsProvider = $settingsProvider;
    }

    public function get(string $property, ?string $slug = null)
    {
        return $this->settingsProvider->getSetting($slug)->get($property);
    }
}

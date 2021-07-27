<?php
declare(strict_types=1);

namespace Codeplace\SettingsBundle\Provider;

use Codeplace\SettingsBundle\Model\SettingsInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

final class SettingsProvider
{
    private EntityRepository $entityRepository;
    private ?string $settingsClass = null;

    private array $cache = [];
    private ?SettingsInterface $mainSetting;

    public function __construct(?string $settingsClass, EntityManagerInterface $entityManager)
    {
        $this->settingsClass = $settingsClass;
        $this->entityRepository = $entityManager->getRepository($settingsClass);
    }

    public function getSetting(?string $slug): SettingsInterface
    {
        if (null == $slug) {
            return $this->getMainSettings();
        }
        
        if (!isset($this->cache[$slug])) {
            $setting = $this->findBySlug($slug);

            if (null === $setting) {
                throw new \Exception(sprintf('Setting "%s" not found', $slug));
            }

            $this->cache[$slug] = $setting;
        }

        return $this->cache[$slug];
    }

    private function findBySlug(string $slug): ?SettingsInterface
    {
        return $this->entityRepository->findOneBy(['slug' => $slug]);
    }

    private function getMainSettings(): ?SettingsInterface
    {
        if (!isset($this->mainSetting)) {
            $this->mainSetting = $this->entityRepository->findOneBy(['main' => true]);
        }
        
        return $this->mainSetting;
    }
}

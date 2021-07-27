<?php
declare(strict_types=1);

namespace Codeplace\SettingsBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Settings
 * @ORM\MappedSuperclass()
 */
class Settings implements SettingsInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * @ORM\Column(type="string", length=50)
     *
     * @Assert\NotBlank()
     * @Assert\Length(max=50)
     */
    protected ?string $name = null;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     *
     * @Assert\Length(max=50)
     */
    protected ?string $slug = null;

    /**
     * @ORM\Column(type="boolean")
     */
    protected bool $main = false;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     * @return Settings
     */
    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     * @return Settings
     */
    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return bool
     */
    public function isMain(): bool
    {
        return $this->main;
    }

    /**
     * @param bool $main
     * @return Settings
     */
    public function setMain(bool $main): self
    {
        $this->main = $main;

        return $this;
    }

    public function get($name)
    {
        $getter = 'get'.ucfirst($name);
        return $this->$getter();
    }
}

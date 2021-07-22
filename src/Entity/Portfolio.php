<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PortfolioRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PortfolioRepository::class)
 * @Vich\Uploadable
 */
class Portfolio
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(max="255")
     * @Assert\NotBlank()
     */
    private $projectName;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="image_file", fileNameProperty="image")
     * @Assert\File(
     * maxSize="2048000",
     * mimeTypes = {
     *     "image/png",
     *     "image/jpeg",
     *     "image/jpg",
     *     "image/webp",
     *     "image/svg",
     * })
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\ManyToMany(targetEntity=Skill::class, inversedBy="portfolios")
     */
    private $technology;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="portfolios")
     */
    private $category;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeInterface|null
     */
    private $updatedAt;

    public function __construct()
    {
        $this->technology = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProjectName(): ?string
    {
        return $this->projectName;
    }

    public function setProjectName(string $projectName): self
    {
        $this->projectName = $projectName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /*
    * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $imageFile
    */
    public function setImageFile(?File $imageFile = null): Portfolio
    {
        $this->imageFile = $imageFile;
        if ($imageFile) {
            $this->updatedAt = new DateTime('now');
        }
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    /**
     * @return Collection|Skill[]
     */
    public function getTechnology(): Collection
    {
        return $this->technology;
    }

    public function addTechnology(Skill $technology): self
    {
        if (!$this->technology->contains($technology)) {
            $this->technology[] = $technology;
        }

        return $this;
    }

    public function removeTechnology(Skill $technology): self
    {
        $this->technology->removeElement($technology);

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}

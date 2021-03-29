<?php

namespace App\Entity;

use App\Repository\PdfRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PdfRepository::class)
 */
class Pdf extends File
{

    /**
     * @ORM\Column(type="integer")
     */
    private $page_number;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $orientation;

    public function getPageNumber(): ?int
    {
        return $this->page_number;
    }

    public function setPageNumber(int $page_number): self
    {
        $this->page_number = $page_number;

        return $this;
    }

    public function getOrientation(): ?string
    {
        return $this->orientation;
    }

    public function setOrientation(string $orientation): self
    {
        $this->orientation = $orientation;

        return $this;
    }
}

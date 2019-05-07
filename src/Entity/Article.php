<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="date")
     */
    private $date_publication;

    /**
     * @ORM\Column(type="time")
     */
    private $time_publication;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $descritpion): self
    {
        $this->description = $descritpion;

        return $this;
    }

    public function getDatePublication(): ?\DateTimeInterface
    {
        $stringValue ="";
        if ($this->date_publication instanceof \DateTime) {
            $stringValue = $this->date_publication->format('Y-m-d H:i:s');
        }
        return $this->date_publication;
    }

    public function getDateText()
    {
        $stringValue ="";
        if ($this->date_publication instanceof \DateTime) {
            $stringValue = $this->date_publication->format('Y-m-d');
        }
        return $stringValue;
    }

    public function getTimeText()
    {
        $stringValue ="";
        if ($this->time_publication instanceof \DateTime) {
            $stringValue = $this->date_publication->format('H:i:s');
        }
        return $stringValue;
    }


    public function setDatePublication(\DateTimeInterface $date_publication): self
    {
        $this->date_publication = $date_publication;

        return $this;
    }

    public function getTimePublication(): ?\DateTimeInterface
    {
        return $this->time_publication;
    }

    public function setTimePublication(\DateTimeInterface $time_publication): self
    {
        $this->time_publication = $time_publication;

        return $this;
    }
}
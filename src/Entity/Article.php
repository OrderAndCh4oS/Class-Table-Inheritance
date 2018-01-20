<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="article")
 */
class Article extends PageAbstract
{

    /**
     * @var string $title
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SectionAbstract", mappedBy="article")
     */
    private $sections;

    /**
     * Article constructor.
     */
    public function __construct()
    {
        $this->sections = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getSections()
    {
        return $this->sections;
    }

    /**
     * @param mixed $sections
     */
    public function setSections($sections): void
    {
        $this->sections = $sections;
    }

    public function __toString() {
        return (string) $this->title;
    }

    public function addSection(SectionAbstract $section)
    {
        $this->sections->add($section);
    }
}

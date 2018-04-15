<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="article")
 */
class Article extends PageAbstract
{
    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Archive", inversedBy="articles")
     */
    private $archive;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SectionAbstract", mappedBy="article", cascade={"remove"})
     * @ORM\OrderBy({"orderNumber" = "ASC"})
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
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * @param mixed $archive
     */
    public function setArchive($archive): void
    {
        $this->archive = $archive;
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

    /**
     * @param SectionAbstract $section
     */
    public function addSection(SectionAbstract $section)
    {
        $this->sections->add($section);
    }
}

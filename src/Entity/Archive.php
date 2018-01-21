<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArchiveRepository")
 */
class Archive extends PageAbstract
{
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="archive")
     * @var ArrayCollection
     */
    private $articles;

    /**
     * Archive constructor.
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    /**
     * @param Article $article
     */
    public function addArchive(Article $article)
    {
        $this->articles->add($article);
    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles($articles): void
    {
        $this->articles = $articles;
    }
}

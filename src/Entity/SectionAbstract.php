<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\DiscriminatorColumn;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\InheritanceType;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Entity
 * @InheritanceType("JOINED")
 * @DiscriminatorColumn(name="section_type", type="string")
 * @DiscriminatorMap({
 *     "text" = "App\Entity\TextBlock",
 *     "quote" = "App\Entity\QuoteBlock",
 *     "image" = "App\Entity\ImageBlock"
 * })
 */
abstract class SectionAbstract
{
    const TYPE = 'section';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(min="3", max="255")
     */
    private $title;
    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     */
    private $orderNumber;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="sections")
     */
    private $article;

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @param mixed $article
     */
    public function setArticle($article): void
    {
        $this->article = $article;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    public function getOrderNumber()
    {
        return $this->orderNumber;
    }

    /**
     * @param mixed $orderNumber
     */
    public function setOrderNumber($orderNumber): void
    {
        $this->orderNumber = $orderNumber;
    }

    public static function getType()
    {
        $c = get_called_class();

        return $c::TYPE;
    }

}

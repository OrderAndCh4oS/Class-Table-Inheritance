<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity()
 * @ORM\Table(name="image_block")
 */
class ImageBlock extends SectionAbstract
{
    const TYPE = 'image_block';

    /**
     * @var Image
     * @ORM\OneToOne(targetEntity="App\Entity\Image", inversedBy="section", cascade={"persist", "remove"}, fetch="EAGER")
     */
    private $image;

    /**
     * @return mixed
     */
    public function getImage(): ?Image
    {
        return $this->image;
    }

    /**
     * @param Image $image
     */
    public function setImage(Image $image): void
    {
        $this->image = $image;
    }

    public function getImageFile(): ?File
    {
        return $this->image->getImageFile();
    }
}

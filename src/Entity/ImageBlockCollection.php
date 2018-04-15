<?php
/**
 * Created by PhpStorm.
 * User: sarcoma
 * Date: 15/04/18
 * Time: 01:04
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

//ToDo: Implement class

/**
 * Class ImageBlockCollection
 * @package App\Entity
 * @ORM\Entity()
 * @ORM\Table(name="image_block_collection")
 */
class ImageBlockCollection extends SectionAbstract
{
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ImageBlock")
     */
    private $imageBlocks;

    public function __construct()
    {
        $this->imageBlocks = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getImageBlocks()
    {
        return $this->imageBlocks;
    }

    /**
     * @param mixed $imageBlocks
     */
    public function setImageBlocks($imageBlocks): void
    {
        $this->imageBlocks = $imageBlocks;
    }

    /**
     * @param ImageBlock $imageBlock
     */
    public function addImageBlock(ImageBlock $imageBlock)
    {
        $this->imageBlocks->add($imageBlock);
    }
}

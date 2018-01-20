<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="text_block")
 */
class TextBlock extends SectionAbstract
{
    const TYPE = 'text_block';

    /**
     * @ORM\Column(type="string")
     */
    private $text;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text): void
    {
        $this->text = $text;
    }
}

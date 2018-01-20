<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="quote_block")
 */
class QuoteBlock extends SectionAbstract
{
    const TYPE = 'quote_block';

    /**
     * @ORM\Column(type="string")
     */
    private $quote;

    /**
     * @ORM\Column(type="string")
     */
    private $citation;

    /**
     * @return mixed
     */
    public function getQuote()
    {
        return $this->quote;
    }

    /**
     * @param mixed $quote
     */
    public function setQuote($quote): void
    {
        $this->quote = $quote;
    }

    /**
     * @return mixed
     */
    public function getCitation()
    {
        return $this->citation;
    }

    /**
     * @param mixed $citation
     */
    public function setCitation($citation): void
    {
        $this->citation = $citation;
    }
}

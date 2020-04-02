<?php

namespace Site\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Im1920Product
 *
 * @ORM\Table(name="im1920_product")
 * @ORM\Entity(repositoryClass="Site\SiteBundle\Repository\Im1920ProductRepository")
 */
class Im1920Product
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="plabel", type="string", length=255, unique=true)
     */
    private $plabel;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2)
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="amount", type="integer", length=10)
     */
    private $amount;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set plabel
     *
     * @param string $plabel
     *
     * @return Im1920Product
     */
    public function setPlabel($plabel)
    {
        $this->plabel = $plabel;

        return $this;
    }

    /**
     * Get plabel
     *
     * @return string
     */
    public function getPlabel()
    {
        return $this->plabel;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Im1920Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     *
     * @return Im1920Product
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }
}

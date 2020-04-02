<?php

namespace Site\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Im1920Prod_cmd
 *
 * @ORM\Table(name="im1920_prod_cmd")
 * @ORM\Entity(repositoryClass="Site\SiteBundle\Repository\Im1920Prod_cmdRepository")
 */
class Im1920Prod_cmd
{

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="prodId", type="integer")
     */
    private $prodId;

    /**
     * @var int
     *
     * @ORM\Column(name="cmdID", type="integer")
     * @ORM\Id
     */
    private $cmdId;

    /**
     * @var int
     *
     * @ORM\Column(name="qte", type="integer")
     */
    private $qte;


    

    /**
     * Set prodId
     *
     * @param integer $prodId
     *
     * @return Im1920Prod_cmd
     */
    public function setProdId($prodId)
    {
        $this->prodId = $prodId;

        return $this;
    }

    /**
     * Get prodId
     *
     * @return int
     */
    public function getProdId()
    {
        return $this->prodId;
    }

    /**
     * Set cmdId
     *
     * @param integer $cmdId
     *
     * @return Im1920Prod_cmd
     */
    public function setCmdId($cmdId)
    {
        $this->cmdId = $cmdId;

        return $this;
    }

    /**
     * Get cmdId
     *
     * @return int
     */
    public function getCmdId()
    {
        return $this->cmdId;
    }

    /**
     * Set qte
     *
     * @param integer $qte
     *
     * @return Im1920Prod_cmd
     */
    public function setQte($qte)
    {
        $this->qte = $qte;

        return $this;
    }

    /**
     * Get qte
     *
     * @return int
     */
    public function getQte()
    {
        return $this->qte;
    }
}


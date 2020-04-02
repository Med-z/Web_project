<?php

namespace Site\SiteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Im1920Command
 *
 * @ORM\Table(name="im1920_command")
 * @ORM\Entity(repositoryClass="Site\SiteBundle\Repository\Im1920CommandRepository")
 */
class Im1920Command
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
     * @var int
     *
     * @ORM\Column(name="userID", type="integer", nullable=false)
     */
    private $userID;

    /**
     * @var int
     *
     * @ORM\Column(name="ID", type="integer", nullable=false)
     */
    private $ID;


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
     * Set userID
     *
     * @param integer $userID
     *
     * @return Im1920Command
     */
    public function setUserID($userID)
    {
        $this->userID = $userID;

        return $this;
    }

    /**
     * Get userID
     *
     * @return int
     */
    public function getUserID()
    {
        return $this->userID;
    }

    /**
     * Set ID
     *
     * @param integer $ID
     *
     * @return Im1920Command
     */
    public function setID($ID)
    {
        $this->ID = $ID;

        return $this;
    }

    /**
     * Get ID
     *
     * @return int
     */
    public function get_ID()
    {
        return $this->ID;
    }
}


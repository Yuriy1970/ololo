<?php

namespace Bundles\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use FOS\UserBundle\Entity\User as BaseUser;
use Sonata\UserBundle\Entity\BaseUser as BaseUser;
/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        parent::__construct();
    }
   
}

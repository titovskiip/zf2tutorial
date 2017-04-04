<?php

namespace Album\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 * A music album.
 *
 * @ORM\Entity
 * @ORM\Table(name="role")
 * @property int $idrole
 * @property string $role
 */
class Role
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idrole", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $idrole;
    /**
     *
     * @ORM\Column(name="role", type="string")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $role;


    /**
     * @return mixed
     */
    public function getIdrole()
    {
        return $this->idrole;
    }

    /**
     * @param mixed $idrole
     * @return $this
     */
    public function setIdrole($idrole)
    {
        $this->idrole = $idrole;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     * @return $this
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

}
<?php

namespace Album\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Factory as InputFactory;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

/**
 *
 * @ORM\Entity(repositoryClass="Album\Repository\RoleRepository")
 * @ORM\Table(name="role")
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
     * @return int
     */
    public function getIdrole()
    {
        return $this->idrole;
    }

    /**
     * @param int $idrole
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
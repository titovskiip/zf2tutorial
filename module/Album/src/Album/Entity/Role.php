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
 * @property int $idRole
 * @property string $Role
 */
class Role implements InputFilterAwareInterface
{
    protected $idRole;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $Role;

    /**
     * @ORM\Column(type="string")
     */

    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        throw new \Exception("Not used");
    }

    public function getInputFilter()
    {

    }
}
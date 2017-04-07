<?php

namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rights
 *
 * @ORM\Table(name="rights")
 * @ORM\Entity
 */
class Rights
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idrole", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $idrole;

    /**
     * @var string
     *
     * @ORM\Column(name="right", type="string", length=45, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $right;


}

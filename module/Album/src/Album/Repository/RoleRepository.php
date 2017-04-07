<?php

namespace Album\Repository;

use Doctrine\ORM\EntityRepository;

class RoleRepository extends EntityRepository
{
    public function getRole()
    {
        $querybuilder = $this->createQueryBuilder('c');
        return $querybuilder->select('c')
                ->orderBy('c.id', 'ASC')
                ->getQuery()->getResult();
    }
}
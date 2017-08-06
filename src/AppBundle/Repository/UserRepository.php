<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function dataTable($data = array(), $page = 0, $max = NULL, $getResult = true, $columnOrder = NULL, $dirOrder = NULL)
    {
        $qb = $this->createQueryBuilder("u");
        $query = isset($data['query']) && $data['query'] ? $data['query'] : null;
        $qb->select('u');
        if ($query)
            $qb
                ->andWhere(
                    $qb->expr()->orX(
                        $qb->expr()->like("UPPER(u.username)", "UPPER(:query)"),
                        $qb->expr()->like("UPPER(u.roles)", "UPPER(:query)"),
                        $qb->expr()->like("UPPER(u.email)", "UPPER(:query)"),
                        $qb->expr()->like("UPPER(u.fullName)", "UPPER(:query)"),
                        $qb->expr()->like("UPPER(u.id)", "UPPER(:query)")
                    )
                )
                ->setParameter('query', "%" . $query . "%");
        if ($columnOrder)
            $qb->orderBy("u.$columnOrder", $dirOrder);
        if ($max)
            $preparedQuery = $qb
                ->getQuery()
                ->setMaxResults($max)
                ->setFirstResult($page * $max);
        else
            $preparedQuery = $qb->getQuery();
        return $getResult ? $preparedQuery->getResult() : $preparedQuery;
    }
}

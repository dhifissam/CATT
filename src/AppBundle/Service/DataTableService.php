<?php

namespace AppBundle\Service;


use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;

class DataTableService
{
    private $requestStack;
    private $em;

    public function __construct(EntityManager $em, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->requestStack = $requestStack;
    }

    function getFilter()
    {
        $request = $this->requestStack->getCurrentRequest();

        $length = $request->get('length');
        $length = $length && ($length != -1) ? $length : 0;

        $start = $request->get('start');
        $start = $length ? ($start && ($start != -1) ? $start : 0) / $length : 0;

        $column = $search = $request->get('columns');

        $order = $request->get('order')[0];

        $columnOrder = $order['column'];
        $dirOrder = $order['dir'];
        $columNameOrder = $column[$columnOrder]['data'];
        $search = $request->get('search');
        $filters = [
            'query' => @$search['value']
        ];
        return array(
            'filters'        => $filters,
            'start'          => $start,
            'length'         => $length,
            'columNameOrder' => $columNameOrder,
            'dirOrder'       => $dirOrder,

        );
    }

    /**
     * @param $date
     * @return string
     */
    function dateStringify($date)
    {
        return empty($date) ? '' : $date->format('d-m-Y');
    }

    /**
     * @param $password
     * @param $passwordConfirm
     * @return null|string
     */
    function editUserCheck($password, $passwordConfirm, $email)
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $error = null;
        if (!$uppercase || !$lowercase || !$number || strlen($password) < 8)
        {
            $error = "Mot de passe incorrect de confirmation (8 caractères; différence majuscules, minuscules, caractères spéciaux).";
        }
        if ($password != $passwordConfirm)
        {
            $error = "Le mot de passe et la confirmation ne correspondent pas.";
        }
        return $error;
    }

    public function getDatesBetween($dStart, $dEnd)
    {
        if ($dStart > $dEnd)
        {
            $var = $dStart;
            $dStart = $dEnd;
            $dEnd = $var;
        }
        $iStart = strtotime($dStart);
        $iEnd = strtotime($dEnd);
        if (false === $iStart || false === $iEnd)
        {
            return false;
        }
        $aStart = explode('-', $dStart);
        $aEnd = explode('-', $dEnd);
        if (count($aStart) !== 3 || count($aEnd) !== 3)
        {
            return false;
        }
        if (false === checkdate($aStart[1], $aStart[2], $aStart[0]) || false === checkdate($aEnd[1], $aEnd[2], $aEnd[0]) || $iEnd < $iStart)
        {
            return false;
        }
        for ($i = $iStart; $i < $iEnd + 86400; $i = strtotime('+1 day', $i))
        {
            $sDateToArr = strftime('%Y-%m-%d', $i);
            $sYear = substr($sDateToArr, 0, 4);
            $sMonth = substr($sDateToArr, 5, 2);
            //$aDates[$sYear][$sMonth][]=$sDateToArr;
            $aDates[] = $sDateToArr;
        }
        if (isset($aDates) && !empty($aDates))
        {
            return $aDates;
        } else
        {
            return false;
        }
    }

}
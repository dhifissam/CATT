<?php

namespace AppBundle\Twig\Extension;

class TwigExtension extends \Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('created', array($this, 'getTime')),
            new \Twig_SimpleFilter('showEtat', array($this, 'showEtat')),
        );
    }


    public function showEtat($etat)
    {
        switch ($etat)
        {
            case 1:
                $label = "En attente";
                $class = "label-info";
                break;
            case 2:
                $label = "Confirmée";
                $class = "label-success";
                break;
            case 3:
                $label = "Annulée";
                $class = "label-danger";
                break;
            case 4:
                $label = "Terminée";
                $class = "label-default";
                break;
        }
        return "<span class='label $class'>" . $label . "</span>";

    }

    public function getTime($date)
    {
        $start_date = $date;
        $since_start = $start_date->diff(new \DateTime());
        if ($since_start->y == 1)
            return $since_start->y . ' <small class="display-block text-size-small no-margin"> Year </small>';
        if ($since_start->y != 0)
            return $since_start->y . ' <small class="display-block text-size-small no-margin">Years</small>';
        if ($since_start->m == 1)
            return $since_start->m . ' <small class="display-block text-size-small no-margin">Month</small>';
        if ($since_start->m != 0)
            return $since_start->m . ' <small class="display-block text-size-small no-margin">Months</small>';
        if ($since_start->d == 1)
            return $since_start->d . ' <small class="display-block text-size-small no-margin">Day</small>';
        if ($since_start->d != 0)
            return $since_start->d . ' <small class="display-block text-size-small no-margin">Days</small>';
        if ($since_start->h == 1)
            return $since_start->h . '<small class="display-block text-size-small no-margin"> Hour</small>';
        if ($since_start->h != 0)
            return $since_start->h . ' <small class="display-block text-size-small no-margin">Hours</small>';
        if ($since_start->i == 1)
            return $since_start->i . '<small class="display-block text-size-small no-margin"> Minute</small>';
        if ($since_start->i != 0)
            return $since_start->i . ' <small class="display-block text-size-small no-margin">Minutes</small>';
        return $since_start->s . ' <small class="display-block text-size-small no-margin">Seconds</small>';
    }
}
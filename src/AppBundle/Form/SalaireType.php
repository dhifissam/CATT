<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SalaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('montant')
            ->add('nbrJourTravailer')
            ->add('montantDejeuner')
            ->add('monatantDinee')
            ->add('montantNuitee')
            ->add('heureSupp50')
            ->add('heureSupp75')
            ->add("annee",ChoiceType::class,array(
                'choices'=>array(
                    2017=>2017,
                    2018=>2018,
                    2019=>2019,
                    2020=>2020
                )
            ))
            ->add("mois",ChoiceType::class,array(
                'choices'=>array(
                    "Janvier"=>1,
                    "Fevrier"=>2,
                    "Mars"=>3,
                    "Avril"=>4,
                    "Mai"=>5,
                    "Juin"=>6,
                    "Juillet"=>7,
                    "Aout"=>8,
                    "Septembre"=>9,
                    "Octobre"=>10,
                    "Nouvembre"=>11,
                    "Decemebre"=>12
                )
            ))


        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Salaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_salaire';
    }


}

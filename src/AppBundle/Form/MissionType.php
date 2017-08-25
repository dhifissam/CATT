<?php

namespace AppBundle\Form;

use AppBundle\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\ORM\EntityRepository;

class MissionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prix')
            ->add('date',DateType::class,array(
                'widget'=>"single_text"
            ))
            ->add('commentaire')
            ->add('client')
            ->add('depotChargement')
            ->add('depotDechargement')
            ->add('vehicule',EntityType::class,array(
                "class"=>Vehicule::class,
                "placeholder"=>"",
                "required"=>true,
                "query_builder"=>function(EntityRepository $er)  {
                    return $er->createQueryBuilder('v')
                        ->where("v.enable = 1");
                }
            ))
            ->add('remorque');
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Mission'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_mission';
    }


}

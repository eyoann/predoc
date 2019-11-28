<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use libphonenumber\PhoneNumberFormat;
use AppBundle\Entity\Specialisation;
use AppBundle\Repository\SpecialisationRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use AppBundle\Entity\Contact;

class ContactType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        


        $builder
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'required' => true,
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'required' => true,
            ])
            
            
            ->add('rpps', TextType::class, [
                'label' => 'RPPS',
                'required' => true,
            ])
            ->add('phone', PhoneNumberType::class,
                [
                    'default_region' => 'FR',
                    'format' => PhoneNumberFormat::NATIONAL,
                    'label' => 'Téléphone',
                    'attr' => [
                        'class' => 'required-focus-only'
                    ],
                    'required' => true,
                ]
            )
            ->add('address1', TextType::class, [
                'label' => 'Adresse 1',
                'required' => true,
            ])
            ->add('address2', TextType::class, [
                'label' => 'Adresse 2',
                'required' => false,
            ])
            ->add('address3', TextType::class, [
                'label' => 'Adresse 3',
                'required' => false,
            ])
            ->add('zipcode', TextType::class, [
                'label' => 'Code Postal',
                'required' => true,
            ])
            ->add('city', TextType::class, [
                'label' => 'Ville',
                'required' => true,
            ])
            ->add('country', TextType::class, [
                'label' => 'Pays',
                'required' => true,
            ])
            /*
            ->add(
                'specialisations',
                EntityType::class,
                [
                    'class'         => Specialisation::class,
                    'choice_label'  => 'name',
                    'query_builder' => function (SpecialisationRepository $repository) {
                        return $repository->createQueryBuilder('f')
                            ->addOrderBy('f.name', 'ASC');
                    },
                    'label'         => 'Spécialisation',
                    'empty_data'   => '-',
                ]
            )*/
            ->add('user',   UserType::class)

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Contact::class
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_contact';
    }


}

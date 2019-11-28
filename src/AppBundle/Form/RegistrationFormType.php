<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use libphonenumber\PhoneNumberFormat;
use AppBundle\Entity\Specialisation;
use AppBundle\Repository\SpecialisationRepository;
use Symfony\Component\Validator\Constraints as Assert;


class RegistrationFormType extends AbstractType
{
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
            ->add('email',
                EmailType::class,
                array(
                    'label' => 'Email',
                    'required' => true,
                    'constraints' =>[
                        new Assert\Email([
                        'message'=>'This is not the corect email format'
                        ]),
                        new Assert\NotBlank([
                        'message' => 'This field can not be blank'
                        ])
                    ],
                ))
            ->add('plainPassword',
                PasswordType::class,
                array(
                    'label' => 'Mot de passe',
                    'required' => true,
                    'attr' => array(
                        'class' => 'required-focus-only'
                    ),
                    'constraints' =>[
                        new Assert\NotBlank([
                        'message' => 'This field can not be blank'
                        ])
                    ]
                ))
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
                    'constraints' =>[
                        new Assert\NotBlank([
                        'message' => 'This field can not be blank'
                        ])
                    ]
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
            ->add('address1', TextType::class, [
                'label' => 'Adresse 1',
                'required' => true,
            ])
            ->add(
                'specialisation',
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
            )

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Form\Model\ContactRegistration',
        ));
    }
}

<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Utilisateurs;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('username', TextType::class, [
                'label' => 'Pseudo <span class="text-danger">*</span>',
                'label_html' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom <span class="text-danger">*</span>',
                'label_html' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom <span class="text-danger">*</span>',
                'label_html' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('civilite', ChoiceType::class, [
                'label' => 'Civilité <span class="text-danger">*</span>',
                'label_html' => true,
                'choices' => [
                    'Monsieur' => 'M',
                    'Madame' => 'Mme',
                    'Mademoiselle' => 'Mlle',
                ],
                'attr' => ['class' => 'form-control'],
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email <span class="text-danger">*</span>',
                'label_html' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dateDeNaissance', BirthdayType::class, [
                'label' => 'Date de naissance <span class="text-danger">*</span>',
                'label_html' => true,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => ['class' => 'form-control datepicker', 'placeholder' => 'Cliquez pour choisir une date'],
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse <span class="text-danger">*</span>',
                'label_html' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville <span class="text-danger">*</span>',
                'label_html' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('codePostal', TextType::class, [
                'label' => 'Code postal <span class="text-danger">*</span>',
                'label_html' => true,
                'attr' => ['class' => 'form-control'],
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les deux mots de passe ne sont pas identique.',
                'required' => true,
                'first_options'  => [
                    'label' => 'Mot de passe<span class="text-danger">*</span>',
                    'label_html' => true,
                    'attr' => [
                        'class' => 'form-control',
                        'autocomplete' => 'new-password',
                        'data-help' => 'Doit contenir au moins 1 majuscule, 1 caractère spécial et 12 caractères.',

                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmez le mot de passe <span class="text-danger">*</span>',
                    'label_html' => true,
                    'attr' => [
                        'class' => 'form-control',
                        'autocomplete' => 'new-password',

                    ],
                ],
                'constraints' => [
                    new Length([
                        'min' => 12,
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[A-Z])(?=.*[!@#$%^&*()-_=+{};:,<.>]).*$/',
                        'message' => 'Le mot de passe doit contenir au moins 1 majuscule et 1 caractère spécial.',
                    ]),
                ],
            ])


            ->add('accepte_photos', CheckboxType::class, [
                'label' => 'J\'accepte les conditions d\'utilisations. <span class="text-danger">*</span>',
                'label_html' => true,
                'mapped' => false,
                'required' => true,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les conditions d\'utilisations..',
                    ]),
                ],
            ])
            ->add('btn_submit', SubmitType::class, [
                'label' => 'Inscription',
                'attr' => ['class' => 'btnIns btnIns-block btnIns-primary'],

            ])

            ->add('token', HiddenType::class, [
                'mapped' => false,
            ])
            ->add('isVerified', HiddenType::class, [
                'mapped' => false,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}

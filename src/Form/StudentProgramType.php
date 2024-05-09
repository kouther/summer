<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;


class StudentProgramType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field cannot be blank.',
                    ]),
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field cannot be blank.',
                    ]),
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field cannot be blank.',
                    ]),
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'This field cannot be blank.',
                    ]),
                ]
            ])
            ->add('university_name', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('interesrt_course', ChoiceType::class, [
                'choices' => [
                    'Third-Party Logistics and the Supply Chain Industry' => 'Third-Party Logistics and the Supply Chain Industry',
                    'Leading Change: Women and Ethical Leadership in Global Societies' => 'Leading Change: Women and Ethical Leadership in Global Societies',
                    'The Business of International Higher Education' => 'The Business of International Higher Education',
                    'Innovation and Entrepreneurship' => 'Innovation and Entrepreneurship',
                    'Regression Analysis: Understanding and Building Business and Economic Models Using Excel' => 'Regression Analysis: Understanding and Building Business and Economic Models Using Excel',
                    'Community Engagement: An Arab-American Perspective' => 'Community Engagement: An Arab-American Perspective',
                    'The Future of Global Commerce' => 'The Future of Global Commerce',
                    'Artificial Intelligence: Promise, Peril and Issues' => 'Artificial Intelligence: Promise, Peril and Issue',
                    'Navigating the Future: Leadership and Innovation at the Frontier of Space' => 'Navigating the Future: Leadership and Innovation at the Frontier of Space',
                    'Building Bridges: Public-Private Partnerships to Empower Small Enterprises' => 'Building Bridges: Public-Private Partnerships to Empower Small Enterprises',
                    'The Legacy of Hannibal Barca' => 'The Legacy of Hannibal Barca',

                ],
                'choice_attr' => function($choice, $key, $value) {
                    return ['class' => 'form-check-input choice'];
                },
                'label_attr' => [
                    'class' => 'form-check-label', // Add classes to the label element
                ],
                
                
                'expanded' => true, // This will render checkboxes instead of a select dropdown
                'multiple' => true,
                'label'=>'',
             
            ]) 
       
            ->add('payment', FileType::class, [
                'data_class' => null,
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '500K',
                        'maxSizeMessage' => 'The maximum size allowed is 500K.',
                        'mimeTypes' => [
                            'application/pdf',
                            'application/x-pdf',
                            'image/jpeg',
                            'image/png',
                            // Add more mime types here if needed
                        ],
                        'mimeTypesMessage' => "Please upload your document in PDF, JPEG or PNG format.",
                    ]),
                ],
            ])
            
             ->add('payment_date', DateType::class, [
                'label' => false,
                'required'=>true,
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
           
            ->add('payment_id', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                ],
                
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

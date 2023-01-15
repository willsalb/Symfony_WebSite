<?php

namespace App\Form;

use App\ValueObject\ContactForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints as Assert;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        #definindo classes para CSS
        $formTypeOptions = [
            'row_attr' => [
                'class' => 'mb-3',
            ],
            /*
            'label_attr' => [
                'class' => 'col-form-label',
            ],
            'attr' => [
                'class' => 'form-control',
            ],
            */

            //Adicionando validações para os campos
        ];

        $builder
            ->add('name', TextType::class, $formTypeOptions)
            ->add('email', TextType::class, $formTypeOptions)
            ->add('subject', TextType::class, $formTypeOptions)
            ->add('message', TextareaType::class, $formTypeOptions)
            ->add('button', ButtonType::class, [
                'attr' => [
                    /*'class' => 'btn btn-secondary',*/
                    'data-bs-dismiss' => 'modal',
                ],
                #classes para larguras específicas e exibindo botões como bloco embutido
                'row_attr' => [
                    'class' => 'w-25 d-inline-block',
                ],
                'label' => 'Close',
            ])
            ->add('submit', SubmitType::class, [
                /*
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
                */
                'row_attr' => [
                    'class' => 'w-50 d-inline-block',
                ],
                'label' => 'Send Message',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class,
        ]);
    }
}

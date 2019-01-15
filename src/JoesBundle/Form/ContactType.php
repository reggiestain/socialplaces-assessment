<?php

namespace App\JoesBundle\Form;

use App\JoesBundle\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;

class ContactType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('firstname', TextType::class, [
                    'attr' => ['label' => false, 'placeholder' => 'Enter first name', 
                               'class' => 'txt','data-custom-error-css-class' => 'has-error'
                        ]
                ])
                ->add('surname', TextType::class, [
                    'attr' => ['placeholder' => 'Enter surname', 'class' => 'txt']
                ])
                ->add('mobile', TelType::class, [
                    'attr' => ['placeholder' => 'Enter mobile number', 'class' => 'txt'],
                ]);
               
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }

}

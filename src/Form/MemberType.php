<?php

namespace App\Form;

use App\Entity\Member;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('lastName')
//            ->add('firstName')
            ->add('dateOfBirthAt')
            ->add('sex')
            ->add('longAgo')
            ->add('isParticipateSmallGroup')
            ->add('smallGroupName')
            ->add('smallGroupGuide')
            ->add('isServeChurch')
            ->add('whereServeChurch')
            ->add('tradeProfession')
            ->add('workExperience')
            ->add('artisticSkills')
            ->add('currentOccupation')
            ->add('address')
            ->add('churchExperience')
            ->add('servicesUsed')
            ->add('enjoyMost')
            ->add('yourAreaInterest')
            ->add('yourNeeds')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}

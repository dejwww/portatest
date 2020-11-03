<?php


namespace App\Form;


use App\Entity\NewsletterEmail;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsletterEmailForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        return $builder
            ->add("email", EmailType::class, [
                "required" => true,
                "label" => "E-mail"
            ])
            ->add("verify", TextType::class,[
                "required" => true,
                "mapped" => false,
                "label" => "Write 'porta' to confirm you are human"
            ])
            ->add("submit", SubmitType::class,
            [
                "label" => "I want to receive your newsletter"
            ])
            ->getForm()
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewsletterEmail::class
        ]);
        parent::configureOptions($resolver);
    }
}
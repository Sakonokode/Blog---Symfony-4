<?php
/**
 * Created by PhpStorm.
 * User: coltluger
 * Date: 06/02/19
 * Time: 16:22
 */

namespace Blog\Form;

use Blog\Entity\Category;
use Blog\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class PostType
 * @package Blog\Form
 */
class PostType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'attr' => [
                    'autofocus' => true,
                    'placeholder' => 'form.title',
                    'class' => 'form-control',
                ],
                'label' => 'label.title',
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'cols' => 10,
                    'rows' => 10,
                    'class' => 'form-control',
                    ],
                'help' => 'description',
                'label' => 'label.description',
            ])
            ->add('content', TextareaType::class, [
                'attr' => [
                    'rows' => 10,
                    'cols' => 10,
                    'class' => 'form-control',
                ],
                'help' => 'help.post_content',
                'label' => 'label.content',
            ])
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'multiple' => true,
                'attr' => [
                    'placeholder' => 'form.categories',
                    'class' => 'form-control',
                ],
                'label' => 'label.categories'
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
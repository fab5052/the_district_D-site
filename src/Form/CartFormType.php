<?php

namespace App\Form;

use App\Controller\CartController;
use App\Entity\Categorie;
use App\Entity\Plat;
use App\Repository\PlatRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Positive;

class CartFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('image')
            ->add('libelle', options:[
                'label' => 'Nom'
            ])
            ->add('description')
            ->add('quantite')
            ->add('prix', MoneyType::class, options:[
                'label' => 'Prix',
                'divisor' => 100,
                'constraints' => [
                    new Positive(
                        message: 'Le prix ne peut être négatif'
                    )
                ]
            ])
            // ->add('stock', options:[
            //     'label' => 'Unités en stock'
            // ])
            ->add('plat', EntityType::class, [
                'class' => Plat::class,
                'choice_label' => 'libelle',
                'label' => 'Plat',
                
                'group_by' => 'parent.libelle',
                'query_builder' => function(PlatRepository $platRepository){
                    return $platRepository->createQueryBuilder('c')
                        ->where('p.parent IS NOT NULL')
                        ->orderBy('p.libelle', 'ASC');
                }
            ])
            ->add('image', FileType::class, [
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new All(
                        new Image([
                            'maxWidth' => 1280,
                            'maxWidthMessage' => 'L\'image doit faire {{ max_width }} pixels de large au maximum'
                        ])
                    )
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CartController::class,
        ]);
    }
}

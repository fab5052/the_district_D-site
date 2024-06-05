<?php

// namespace App\Controller;

// use App\Entity\Commande;
// use App\Entity\Utilisateur;
// use Doctrine\ORM\EntityManagerInterface;
// use App\Repository\UtilisateurRepository;
// use Symfony\Component\HttpFoundation\Response;
// use Symfony\Component\Routing\Attribute\Route;
// use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

// class ProfileController extends AbstractController
// {
//     public function index(EntityManagerInterface $em): Response
//     {
//         return $this->render('profile/profile.html.twig', [
//             'controller_name' => 'ProfileController'
//         ]);
//     }



//     private $utilisateurRepo;
//     public function __construct(UtilisateurRepository $utilisateurRepo)
//     {
//         $this->utilisateurRepo = $utilisateurRepo;
//     }

//     public function profile(EntityManagerInterface $em): Response
//     {

//         $identifiant = $this->getUser()->getUserIdentifier();
//         if ($identifiant) {
//             $info = $this->utilisateurRepo->findOneBy(["email" => $identifiant]);
//         }
//         $commande = $em->getRepository(Commande::class)->findAll();
//         return $this->render('profile/index.html.twig', [
//             'controller_name' => 'ProfileController',
//             'informations' => $info,
//             'commandes' => $commande,

//         ]);
//     }
// }


namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UtilisateurRepository;
use App\Repository\ProfileRepository;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

 #[IsGranted("ROLE_USER")]
#[Route('/profile', name: 'profile_')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'Profil de l\'utilisateur',
        ]);
    }

    #[Route('/commandes', name: 'profile')]
    public function commande(): Response
    {
        return $this->render('profile/profile.html.twig', [
            'controller_name' => 'Commandes de l\'utilisateur',
        ]);
    }
}

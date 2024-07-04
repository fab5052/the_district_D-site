<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('utilisateur', name: 'utilisateur_')]
class UtilisateurController extends AbstractController
{
    #[Route('/', name: 'index')]
    // public function index(UtilisateurRepository $utilisateurRepository): Response
    // {
    //     $utilisateur = $utilisateurRepository->findBy([], ['prenom' => 'asc']);
    //     return $this->render('admin/utilisateur/index.html.twig', compact('utilisateur'));
    // }


    public function informations
    (UtilisateurRepository $utilisateurRepository): Response
    {
       $utilisateur = $utilisateurRepository
        ->findAll();
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
            'Profil de l\'utilisateur',

            'informations' => $utilisateur,
        ]);
    }
}
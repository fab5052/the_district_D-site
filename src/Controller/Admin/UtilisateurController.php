<?php

namespace App\Controller\Admin;

use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/utilisateur', name: 'admin_utilisateur_')]
class UtilisateurController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(UtilisateurRepository $utilisateurRepository): Response
    {
        $utilisateur = $utilisateurRepository->findBy([], ['prenom' => 'asc']);
        return $this->render('admin/utilisateur/index.html.twig', compact('utilisateur'));
    }
}
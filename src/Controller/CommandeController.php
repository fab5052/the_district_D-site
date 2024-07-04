<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Categorie;
use App\Entity\Plat;
use App\Repository\CommandeRepository;
use App\Repository\CategorieRepository;
use App\Repository\PlatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

#[Route('/commande', name: 'commande')]
class CommandeController extends AbstractController
{   
  #[Route('/', name: 'index')]
   
    public function validation( CartController $cartController, CommandeController $commandeController, PlatRepository $platRepository, SessionInterface $session, EntityManagerInterface $entityManagerInterface)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        // On récupère le panier existant
        $panier = $session->get('panier', []);

        // On crée une nouvelle commande
        $commande = new Commande();

        foreach ($panier as $id => $quantite) {
            $plat = $entityManagerInterface->getRepository(Plat::class)->find($id);

            if ($plat) {
                // On ajoute chaque plat à la commande
                // Assurez-vous d'avoir une relation entre Commande et Plat dans votre entité Commande
               $commande->getId();
               $commande->setQuantite( $quantite);
            }
        }

        // On persiste la commande
        $entityManagerInterface->persist($commande);
        $entityManagerInterface->flush();

        // On vide le panier
        $session->remove('panier');

        // On ajoute un message flash et on redirige
        $this->addFlash('success', 'Commande validée avec succès');
        
        return $this->redirectToRoute('cart_index');
    }
}
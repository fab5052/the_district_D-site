<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Entity\Plat;
use App\Entity\Detail;
use App\Entity\Commande;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TheDistrictFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager): void
    {
        include 'BaseScript.php';

        if (isset($categorie) && is_array($categorie)) {
            foreach ($categorie as $catData) {
                $categorieDB = new Categorie();
                $categorieDB
                    ->setLibelle($catData['libelle'])
                    ->setImage($catData['image'])
                    ->setActive($catData['active']);
                
                $manager->persist($categorieDB);
            }
            $manager->flush();
        }

        if (isset($plat) && is_array($plat)) {
            foreach ($plat as $platData) {
                $platDB = new Plat();
                $platDB
                    ->setLibelle($platData['libelle'])
                    ->setDescription($platData['description'])
                    ->setPrix($platData['prix'])
                    ->setImage($platData['image'])
                    ->setActive($platData['active']);
                
                $categorie = $manager->getRepository(Categorie::class)->find($platData['id_categorie']);
                if ($categorie) {
                    $platDB->setCategorie($categorie);
                }

                $manager->persist($platDB);
            }
            $manager->flush();
        }

        if (isset($detail) && is_array($detail)) {
            foreach ($detail as $detailData) {
            $detailDB = new Detail();
            $detailDB
                ->setQuantite($detailData['quantite']);
                
            $plat = $manager->getRepository(Plat::class)->find($detailData['id_plat']);
            if ($plat) {
                $detailDB->setPlat($plat);
            }

            $commande = $manager->getRepository(Commande::class)->find($detailData['id_commande']);
            if ($commande) {
                $detailDB->getCommande($commande);
            }

                $manager->persist($detailDB);
            }
            $manager->flush();
        }

        if (isset($commande) && is_array($commande)) {
            foreach ($commande as $commandeData) {
                $date = new \DateTime($commandeData['created_at']);
                $commandeDB = new Commande();
                $commandeDB
                    ->setCreatedAt($date)
                    ->setQuantite($commandeData['quantite'])
                    ->setTotal($commandeData['total'])
                    ->setEtat($commandeData['etat']);
                
                // $detail = $manager->getRepository(Detail::class)->find($commandeData['id_detail']);
                // if ($detail) {
                //     $commandeDB->addDetail($detail);
                // }

                $utilisateur = $manager->getRepository(Utilisateur::class)->find($commandeData['id_utilisateur']);
                if ($utilisateur) {
                    $commandeDB->setUtilisateur($utilisateur);
                }

                $manager->persist($commandeDB);
            }
            $manager->flush();
        }

        if (isset($utilisateur) && is_array($utilisateur)) {
            foreach ($utilisateur as $utilisateurData) {
                $utilisateurDB = new Utilisateur();
                $utilisateurDB 
                    ->setEmail($utilisateurData['email']) 
                    ->setNom($utilisateurData['nom'])
                    ->setPrenom($utilisateurData['prenom'])
                    ->setTelephone($utilisateurData['telephone'])
                    ->setAdresse($utilisateurData['adresse'])
                    ->setCp($utilisateurData['cp'])
                    ->setVille($utilisateurData['ville']);
                $utilisateurDB->setPassword(
                    $this->passwordEncoder->hashPassword($utilisateurDB, 'secret')
                );
                $manager->persist($utilisateurDB);
            }
        }

        $admin = new Utilisateur();
        $admin->setEmail('admin@thedistrict.fr');
        $admin->setNom('Fabrice');
        $admin->setPrenom('Beaujois');
        $admin->setTelephone('0322699875');
        $admin->setAdresse('12 rue du port');
        $admin->setCp('80850');
        $admin->setVille('Berto');
        $admin->setPassword(
            $this->passwordEncoder->hashPassword($admin, 'admin')
        );
        $admin->setRoles(['ROLE_ADMIN']);
        
        $manager->persist($admin);
        $manager->flush();
    }
}

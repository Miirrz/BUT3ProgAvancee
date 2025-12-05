<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Adresse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        foreach ($this::users as $mail => [$nom, $prenom, $roles, $mdp, $rue, $codePostal, $ville, $pays]) {
            $user = new User();
            $user->setEmail($mail);
            $user->setFirstName($nom);
            $user->setLastName($prenom);
            $user->setRoles($roles);
            $user->setPassword($mdp);

            $adresseUser = new Adresse();
            $adresseUser->setRue($rue);
            $adresseUser->setCodePostal($codePostal);
            $adresseUser->setVille($ville);
            $adresseUser->setPays($pays);

            $user->addAdress($adresseUser);

            $manager->persist($user);
        }
        $manager->flush();
    }

    // "nom du produit => "Lien de l'Image"
    const users = [
        "gatiendubot3@univ-lorraine.fr" => ["DUBOT", "Gatien", ["ROLE_ADMIN", "ROLE_USER"], "motdepasse", "53 Rue de Chaponost", "57160", "Moulins-lès-Metz", "France"],
        "gatienProjet1@gmail.com" => ["PIERRE","Jean",["ROLE_USER"],"motdepasse1", "2 Rue du Ragebait", "57160", "Moulins-lès-Metz", "France"], 
        "gatienProjet2@gmail.com" => ["ETMERDE","Maxence",["ROLE_USER"],"motdepasse2", "4A Rue de Chaponost", "75006", "Normandie", "France"],
        "gatienProjet3@gmail.com" => ["LEBOEUF","Frank",["ROLE_USER"],"motdepasse3", "6 Rue des fleurs", "13080", "Aix-en-Provence", "France"],
        "gatienProjet4@gmail.com" => ["ANOR","Londo",["ROLE_USER"],"motdepasse4", "12 Rue du boucher", "57160", "Cachan", "France"],
    ];
}

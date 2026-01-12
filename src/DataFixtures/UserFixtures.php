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

    const users = [
        "admin@gmail.com" => ["DUBOT", "Gatien", ["ROLE_ADMIN", "ROLE_USER"], "$2y$13\$XF4GqnBBQghqbMbUbToCnu/AxwgPizPkVCT2ZpEvIVzrSobZipu66", "53 Rue de Chaponost", "57160", "Moulins-lès-Metz", "France"], # mdp : motdepasse
        "user1@gmail.com" => ["PIERRE","Jean",["ROLE_USER"],"$2y$13\$JloAKUc8upZTtwSu0PSulubKXDSUWtaIbfTdD/oJE3jQ1PLrYGAJS", "2 Rue du Ragebait", "57160", "Moulins-lès-Metz", "France"],  # mdp : motdepasse1
        "user2@gmail.com" => ["ETMERDE","Maxence",["ROLE_USER"],"$2y$13$4VwkPgZRoLHcsPGGFef/TuZ3jhuhOTeO3ttOgXwhGDOlKRKTZ9rFG", "4A Rue de Chaponost", "75006", "Normandie", "France"], # mdp : motdepasse2
        "user3@gmail.com" => ["LEBOEUF","Frank",["ROLE_USER"],"$2y$13$0YpT7rl264lxEvXrTJi/XuYj2a/pr/wo2oW/vfjf17HHyhdyMfcVq", "6 Rue des fleurs", "13080", "Aix-en-Provence", "France"], # mdp : motdepasse3
        "user4@gmail.com" => ["ANOR","Londo",["ROLE_USER"],"$2y$13\$e9gmdOp4CjW.K7xqBw2gn.2yywxNg0cUAQ8u4AH.iB5jBGYpVseDC", "12 Rue du boucher", "57160", "Cachan", "France"], # mdp : motdepasse4
    ];
}
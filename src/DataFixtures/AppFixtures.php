<?php

namespace App\DataFixtures;

use App\Entity\Realisations;
use App\Entity\AProposEtInfos;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $aProposEtInfos = new AProposEtInfos();

        $aProposEtInfos->setNomEntreprise("Mon entreprise");
        $aProposEtInfos->setAdresse("12, rue des choux");
        $aProposEtInfos->setCodePostal("67000");
        $aProposEtInfos->setVille("Muckesturm-gare-sur-zinzel");
        $aProposEtInfos->setTelephone("0123456789");
        $aProposEtInfos->setEmailContact("aaa@bbb.pff");
        $aProposEtInfos->setPresentationAPropos("A propos de nous. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.

        Ut velit mauris, egestas sed, gravida nec, ornare ut, mi. Aenean ut orci vel massa suscipit pulvinar. Nulla sollicitudin.");
        $aProposEtInfos->setSlogan("Le lard du pot");
        $aProposEtInfos->setMentionsLegales("Mentions légales. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh. Mauris ac mauris sed pede pellentesque fermentum. Maecenas adipiscing ante non diam sodales hendrerit.");
        $aProposEtInfos->setEmailEnvoiFormulaire("ddd@eee.pff");

        $manager->persist($aProposEtInfos);


        $realisation1 = new Realisations();
        $realisation1->settitre("la fille qui fume")
            ->sethook("Ben oui, une fille tatouée qui fume !")
            ->setdescription("Description à la con de la fille qui fume, . Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker. ")
            ->setUpdatedAt(\DateTime::createFromFormat('Y-m-d H:i:s', '2020-01-01 16:00:00'));

        $manager->persist($realisation1);
        $manager->flush();
    }
}

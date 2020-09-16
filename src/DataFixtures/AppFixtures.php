<?php

namespace App\DataFixtures;

use App\Entity\Realisations;
use App\Entity\Images;
use App\Entity\Logo;
use App\Entity\Slogan;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $slogan = new Slogan();
        $logo = new Logo();

        $slogan->settexte("La peau dans l'art");

        $logo->settexte("Tattoo Kozak")
            ->setimage("assets/images/logoTatooRouge.png");

        $manager->persist($slogan);
        $manager->persist($logo);


        $realisation1 = new Realisations();
        $realisation2 = new Realisations();
        $realisation3 = new Realisations();
        $realisation4 = new Realisations();
        $realisation5 = new Realisations();

        $realisation1->settitre("la fille qui fume")
            ->sethook("Ben oui, une fille tatouée qui fume !")
            ->setdescription("Description à la con 1 des fixtures, . Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.")
            ->setdatedebut(\DateTime::createFromFormat('Y-m-d', '2020-04-01'))
            ->setdatefin(\DateTime::createFromFormat('Y-m-d', '2020-04-14'))
            ->setImageDefaut("assets/images/fille_blonde_fume.jpg");

        $realisation2->settitre("Super fille rose à lunettes")
            ->sethook("Le rose, dans tous ses états")
            ->setdescription("Description à la con 2 des fixtures. Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.")
            ->setdatedebut(\DateTime::createFromFormat('Y-m-d', '2020-05-05'))
            ->setdatefin(\DateTime::createFromFormat('Y-m-d', '2020-05-15'))
            ->setImageDefaut("assets/images/fille_rose_lunettes.jpg");

        $realisation3->settitre("La plage vue d'en haut")
            ->sethook("Ça change de voir une plage d'en haut")
            ->setdescription("Description à la con 3 des fixtures. Diantre, n'est-il pas ? est simplement du bla bla bla faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.")
            ->setdatedebut(\DateTime::createFromFormat('Y-m-d', '2020-06-11'))
            ->setdatefin(\DateTime::createFromFormat('Y-m-d', '2020-06-16'))
            ->setImageDefaut("assets/images/plage_de_haut.jpg");

        $realisation4->settitre("Super route")
            ->sethook("Choisi ta route")
            ->setdescription("Description à la con 4 des fixtures. Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.")
            ->setdatedebut(\DateTime::createFromFormat('Y-m-d', '2020-06-12'))
            ->setdatefin(\DateTime::createFromFormat('Y-m-d', '2020-06-17'))
            ->setImageDefaut("assets/images/route.jpg");

        $realisation5->settitre("Pont magnifique")
            ->sethook("Un pont plus loin")
            ->setdescription("Description à la con 5 des fixtures. Diantre, n'est-il pas ? est simplement du bla bla bla faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.")
            ->setdatedebut(\DateTime::createFromFormat('Y-m-d', '2020-06-13'))
            ->setdatefin(\DateTime::createFromFormat('Y-m-d', '2020-06-18'))
            ->setImageDefaut("assets/images/golden_gate.jpg");

        $manager->persist($realisation1);
        $manager->persist($realisation2);
        $manager->persist($realisation3);
        $manager->persist($realisation4);
        $manager->persist($realisation5);


        $image1 = new Images();
        $image2 = new Images();
        $image3 = new Images();
        $image4 = new Images();
        $image5 = new Images();
        $image6 = new Images();
        $image7 = new Images();

        $image1->setrealisationsid($realisation1)
            ->setlien("assets/images/fille_rousse_bibliotheque.jpg");

        $image2->setrealisationsid($realisation2)
            ->setlien("assets/images/fille_tatouee_nb_lunettes_soleil.jpg");

        $image3->setrealisationsid($realisation3)
            ->setlien("assets/images/mec_assis_bordure_metal_nb.jpg");

        $image4->setrealisationsid($realisation4)
            ->setlien("assets/images/route.jpg");

        $image5->setrealisationsid($realisation5)
            ->setlien("assets/images/goldengate.jpg");

        $image6->setrealisationsid($realisation5)
            ->setlien("assets/images/montgolfieres.jpg");

        $image7->setrealisationsid($realisation5)
            ->setlien("assets/images/harlem.jpg");


        $manager->persist($image1);
        $manager->persist($image2);
        $manager->persist($image3);
        $manager->persist($image4);
        $manager->persist($image5);
        $manager->persist($image6);
        $manager->persist($image7);


        $manager->flush();
    }
}

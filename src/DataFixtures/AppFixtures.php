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
            ->setdatefin(\DateTime::createFromFormat('Y-m-d', '2020-04-14'));

        $realisation2->settitre("Super fille rose à lunettes")
            ->sethook("Le rose, dans tous ses états")
            ->setdescription("Description à la con 2 des fixtures. Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.")
            ->setdatedebut(\DateTime::createFromFormat('Y-m-d', '2020-05-05'))
            ->setdatefin(\DateTime::createFromFormat('Y-m-d', '2020-05-15'));

        $realisation3->settitre("La plage vue d'en haut")
            ->sethook("Ça change de voir une plage d'en haut")
            ->setdescription("Description à la con 3 des fixtures. Diantre, n'est-il pas ? est simplement du bla bla bla faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.")
            ->setdatedebut(\DateTime::createFromFormat('Y-m-d', '2020-06-11'))
            ->setdatefin(\DateTime::createFromFormat('Y-m-d', '2020-06-16'));

        $realisation4->settitre("Super route")
            ->sethook("Choisi ta route")
            ->setdescription("Description à la con 4 des fixtures. Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.")
            ->setdatedebut(\DateTime::createFromFormat('Y-m-d', '2020-05-05'))
            ->setdatefin(\DateTime::createFromFormat('Y-m-d', '2020-05-15'));

        $realisation5->settitre("Pont magnifique")
            ->sethook("Un pont plus loin")
            ->setdescription("Description à la con 4 des fixtures. Diantre, n'est-il pas ? est simplement du bla bla bla faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.")
            ->setdatedebut(\DateTime::createFromFormat('Y-m-d', '2020-06-11'))
            ->setdatefin(\DateTime::createFromFormat('Y-m-d', '2020-06-16'));

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

        $image1->setrealisationsid($realisation1)
            ->setnom("fille blonde qui fume")
            ->setlien("assets/images/viktor-juric-8p5NJcy8Wr4-unsplash.jpg");

        $image2->setrealisationsid($realisation2)
            ->setnom("fille brune en rose lunettes et smartphone")
            ->setlien("assets/images/mateus-campos-felipe-1la1FHm89mg-unsplash.jpg");

        $image3->setrealisationsid($realisation3)
            ->setnom("plage vue d'en haut")
            ->setlien("assets/images/sergio-souza-bmPepl7vhUs-unsplash.jpg");

        $image4->setrealisationsid($realisation4)
        ->setnom("route vers infini")
        ->setlien("assets/images/route.jpg");

        $image5->setrealisationsid($realisation5)
            ->setnom("pont de san fransisco")
            ->setlien("assets/images/goldengate.jpg");

        $manager->persist($image1);
        $manager->persist($image2);
        $manager->persist($image3);
        $manager->persist($image4);
        $manager->persist($image5);


        $manager->flush();
    }
}

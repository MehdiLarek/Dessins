<?php

namespace App\Controller;


use App\Services\Compteur;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/", name="main_")
 */
class MainController extends AbstractController
{
    /**
     * @Route("", name="home")
     */
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }


    /**
     * @IsGranted("ROLE_USER")
     * @Route("monCompte/{id}", name="monCompte")
     */
    public function monCompte($id){
        return $this->render('main/monCompte.html.twig');
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("choix", name="choix")
     */
    public function choix(){
        return $this->render('main/choix.html.twig');
    }


    /**
     * @IsGranted("ROLE_USER")
     * @Route("selection", name="selection")
     */
    public function selection(){
        if($_POST["categorie"] == 1){
            return $this->render('main/animaux.html.twig');
        }elseif ($_POST["categorie"] == 2){
            return $this->render('main/personne.html.twig');
        }else{
            return $this->render('main/paysage.html.twig');
        }

    }


    //Apres selection de la Catégorie ANIMAUX

    /**
     * @IsGranted("ROLE_USER")
     * @Route("animaux", name="animaux")
     */
    public function animaux(){
        $categorie = "Animaux";
        $detail = " ";
        $ok = false;
       switch ($_POST["animaux"]){
           case 1:
               $selection = "Loups";
               break;
           case 2:
               $selection = "Canides";
               break;
           case 3:
               $selection = "Autre";
               break;
           default:
               throw $this->createNotFoundException('Cette categorie n\'existe absolument pas.');
       }

       return $this->render('main/recap.html.twig', [
           'selection' => $selection,
           'categorie' => $categorie,
           'detail' => $detail,
            'ok' => $ok
       ]);
    }


    //Apres selection de la Catégorie PERSONNE

    /**
     * @IsGranted("ROLE_USER")
     * @Route("personne", name="personne")
     */
    public function personne(){
        $categorie = "Personne";
        switch ($_POST["personne"]){
            case 1:
                $selection = "Hommes";
                break;
            case 2:
                $selection = "Femmes";
                break;
            default:
                throw $this->createNotFoundException('Cette categorie n\'existe absolument pas.');
        }

        return $this->render('main/detail.html.twig', ['selection' => $selection, 'categorie' => $categorie]);
    }

    //Apres selection de la Catégorie PAYSAGE

    /**
     * @IsGranted("ROLE_USER")
     * @Route("paysage", name="paysage")
     */
    public function paysage(){
        $detail = " ";
        $categorie = "Paysage";
        $ok = false;
        switch ($_POST["paysage"]){
            case 1:
                $selection = "Campagnes";
                break;
            case 2:
                $selection = "Villes";
                break;
            default:
                throw $this->createNotFoundException('Cette categorie n\'existe absolument pas.');
        }

        return $this->render('main/recap.html.twig', [
            'selection' => $selection,
            'categorie' => $categorie,
            'detail' => $detail,
            'ok' => $ok
        ]);
    }


    //Methode final ****************************************************************
    /**
     * @IsGranted("ROLE_USER")
     * @Route("duree", name="duree")
     */
    public function duree(EntityManagerInterface $entityManager){
        $dessinsfaitAvant = $this->getUser()->getNbDessins();

        $this->getUser()->setNbDessins($dessinsfaitAvant+1);
        $entityManager->persist($this->getUser());
        $entityManager->flush();
        //$dessinsfaitApres = $this->getUser()->getNbDessins();


        $categorie = $_POST["categorie"];
        $selection = $_POST["selection"];
        $duree = $_POST["duree"];
        $detail = $_POST["detail"];
        $ok = $_POST['ok'];

        $max = 10;

        $numero = random_int(1, $max);

        if($ok){
            $url = "references/$categorie/$selection/$detail/$numero.jpg";
        }else{
            $url = "references/$categorie/$selection/$numero.jpg";
        }


        return $this->render('main/canvas.html.twig', [
            'categorie' => $categorie,
            'selection' => $selection,
            'duree' => $duree,
            'detail' => $detail,
            'url' => $url
        ]);

    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("detail", name="detail")
     */
    public function detail(){
        $categorie = $_POST["categorie"];
        $selection = $_POST["selection"];
        $detail = $_POST["detail"];
        $ok = true;

        switch ($detail){
            case 1:
                $detail = "Corps";
                break;
            case 2:
                $detail = "Visage";
                break;
            case 3:
                $detail = "Mains";
                break;
            case 4:
                $detail = "Pieds";
                break;
            default:
                throw $this->createNotFoundException('Ce detail n\'existe absolument pas.');

        }

        return $this->render('main/recap.html.twig', [
            'categorie' => $categorie,
            'selection' => $selection,
            'detail' => $detail,
            'ok' => $ok

        ]);
    }

    // Methode AJAX **********************************************************************
    //non implementé

    /**
     * @param Request $request
     * @param Compteur $compteur
     * @Route("chronometre", name="chronometre")
     */
    public function chronometre(Request $request, Compteur $compteur){
        if($request->isXmlHttpRequest()){
            $compteur->leTempsQuiPasse($this->getUser());
        }
    }


}

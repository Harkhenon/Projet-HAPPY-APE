<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PageRepository;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController

{

    /**
     * @Route("/mentions-legales", name="legal_Mentions")
     */
    public function legalMentions(PageRepository $pageRepository)
    {
        $pageML= $pageRepository->findBy(['title'=>'Mentions Légales']);
        return $this->json($pageML);
    }
    
    /**
    * @Route("/conditions-vente", name="sales_conditions")
    */
    public function cgv(PageRepository $pageRepository)
    {
        $CGVPage = $pageRepository->findby(['title'=>'Conditions générales de vente']); 
        return $this->json($CGVPage);
    }
    
     /**
     * @Route("/conditions-utilisation", name="terms_of_use")
     */
    public function termsOfUse(PageRepository $pageRepository)
    {
        $termsOfUsePage = $pageRepository->findBy(['title'=> 'Conditions générales d\'utilisation']);
        return $this->json($termsOfUsePage);
    }
    
     /**
     * @Route("/qui-sommes-nous", name="about_us")
     */
    public function AboutUs(PageRepository $pageRepository)
    {
        $aboutPage = $pageRepository->findBy(['title' => 'Qui sommes-nous ?'] );
        return $this->json($aboutPage);
    }
    
     /**
     * @Route("/contact", name="contact")
     */
    public function contact(PageRepository $pageRepository)
    {
        $pageContact = $pageRepository->findBy(['title' => 'Contact'] );
        return $this->json($pageContact);
    }
    
}
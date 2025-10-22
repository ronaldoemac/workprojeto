<?php

namespace App\Controller;

use App\Service\NewsService;
use App\Service\StringManipulationService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HomeController extends AbstractController
{
    #[Route('/',name: 'app_home')]
    public function home(
        LoggerInterface $logger, 
        StringManipulationService $stringManipulation, 
        NewsService $service, 
        HttpClientInterface $httpClient): Response
    {
        $teste = 'asd[dfdf]dkfd[kdfk]';
        $novaString = $stringManipulation->cleanString($teste);

        $response = $httpClient->request('GET','https://viacep.com.br/ws/71919540/json/');
        //$slug = "isso-é-um-teste-string";
        //dd($stringManipulation->removeHifem($slug));
        $logger->info("Acessou a Home");

        $pageTitle = "Sistema de Notícias";

        $logger->info("Título definido");
        
        return $this->render('home.html.twig', [
            'categories' => $service->getCategoryList(),
            'pageTitle' => $pageTitle,
        ]);
    }

    #[Route('/categoria/{slug}',name: 'app_category')]
    public function category(String|null $slug=null, NewsService $service): Response
    {

        $pageTitle = $slug;
        return $this->render('category.html.twig', [
            'categories' => $service->getCategoryList(),
            'pageTitle' => $pageTitle,
            'news' => $service->getNewsList(),
        ]);
    }

    #[Route('/news/{id}')]
    public function newsDetail(int|null $id=null, HttpClientInterface $httpClient)
    {
        $response = $httpClient->request('GET','https://viacep.com.br/ws/71919540/json/');
        dd($response);
    }

}

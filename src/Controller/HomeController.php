<?php

namespace App\Controller;

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
    public function home(LoggerInterface $logger, StringManipulationService $stringManipulation, HttpClientInterface $httpClient): Response
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
            'categories' => $this->getCategoryList($httpClient),
            'pageTitle' => $pageTitle,
        ]);
    }

    #[Route('/categoria/{slug}',name: 'app_category')]
    public function category(String|null $slug=null, HttpClientInterface $httpClient): Response
    {

        $pageTitle = $slug;
        return $this->render('category.html.twig', [
            'categories' => $this->getCategoryList($httpClient),
            'pageTitle' => $pageTitle,
            'news' => $this->getNewsList($httpClient),
        ]);
    }

    #[Route('/news/{id}')]
    public function newsDetail(int|null $id=null, HttpClientInterface $httpClient)
    {
        $response = $httpClient->request('GET','https://viacep.com.br/ws/71919540/json/');
        dd($response);
    }

        public function getCategoryList($httpClient)
    {
        $url = "https://raw.githubusercontent.com/JonasPoli/array-news/refs/heads/main/arrayCategoryNews.json";
        $html = $httpClient->request('GET', $url);
        $categories = $html->toArray();

        return $categories;
    }
    public function getNewsList($httpClient)
    {
        $url = "https://raw.githubusercontent.com/JonasPoli/array-news/refs/heads/main/arrayNews.json";
        $html = $httpClient->request('GET', $url);
        $news = $html->toArray();

        return $news;
    }

}

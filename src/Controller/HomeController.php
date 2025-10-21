<?php

namespace App\Controller;

use App\Service\StringManipulationService;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        $categories = [
        ['title' => 'Mundo', 'text' => 'Notícias sobre o Mundo'],
        ['title' => 'Brasil', 'text' => 'Notícias sobre o Brasil'],
        ['title' => 'Tecnologia', 'text' => 'Notícias sobre Tecnologia'],
        ['title' => 'Design', 'text' => 'Notícias sobre Design'],
        ['title' => 'Cultura', 'text' => 'Notícias sobre Cultura'],
        ['title' => 'Negócios', 'text' => 'Notícias sobre Negócios'],
        ['title' => 'Política', 'text' => 'Notícias sobre Política'],
        ['title' => 'Opinião', 'text' => 'Notícias sobre Opinião'],
        ['title' => 'Ciência', 'text' => 'Notícias sobre Ciência'],
        ['title' => 'Saúde', 'text' => 'Notícias sobre Saúde'],
        ['title' => 'Estilo', 'text' => 'Notícias sobre Estilo'],
        ['title' => 'Viagens', 'text' => 'Notícias sobre Viagens'],
        ];
 
        $logger->error("Array criado");

        $pageTitle = "Sistema de Notícias";

        $logger->warning("Título definido");
        
        return $this->render('home.html.twig', [
            'categories' => $categories,
            'pageTitle' => $pageTitle,
        ]);
    }

    #[Route('/categoria/{slug}',name: 'app_category')]
    public function category(String|null $slug=null): Response
    {
         $categories = [
        ['title' => 'Mundo', 'text' => 'Notícias sobre o Mundo'],
        ['title' => 'Brasil', 'text' => 'Notícias sobre o Brasil'],
        ['title' => 'Tecnologia', 'text' => 'Notícias sobre Tecnologia'],
        ['title' => 'Design', 'text' => 'Notícias sobre Design'],
        ['title' => 'Cultura', 'text' => 'Notícias sobre Cultura'],
        ['title' => 'Negócios', 'text' => 'Notícias sobre Negócios'],
        ['title' => 'Política', 'text' => 'Notícias sobre Política'],
        ['title' => 'Opinião', 'text' => 'Notícias sobre Opinião'],
        ['title' => 'Ciência', 'text' => 'Notícias sobre Ciência'],
        ['title' => 'Saúde', 'text' => 'Notícias sobre Saúde'],
        ['title' => 'Estilo', 'text' => 'Notícias sobre Estilo'],
        ['title' => 'Viagens', 'text' => 'Notícias sobre Viagens'],
        ];

        $pageTitle = $slug;
        return $this->render('category.html.twig', [
            'categories' => $categories,
            'pageTitle' => $pageTitle,
        ]);
    }

    #[Route('/news/{id}')]
    public function newsDetail(int|null $id=null, HttpClientInterface $httpClient)
    {
        $response = $httpClient->request('GET','https://viacep.com.br/ws/71919540/json/');
        dd($response);
    }
}

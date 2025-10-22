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
            'news' => $this->getNewsList(),
        ]);
    }

    #[Route('/news/{id}')]
    public function newsDetail(int|null $id=null, HttpClientInterface $httpClient)
    {
        $response = $httpClient->request('GET','https://viacep.com.br/ws/71919540/json/');
        dd($response);
    }

    public function getNewsList()
    {
        $news = [
    [
        "title" => "Nova descoberta arqueológica no Egito",
        "description" => "Arqueólogos descobriram uma nova tumba faraônica com artefatos e múmias bem preservadas.",
        "image" => "https://exemplo.com/imagem1.jpg",
        "create_at" => new \DateTime("2022-01-15 10:00:00")
    ],
    [
        "title" => "Empresa anuncia novo produto revolucionário",
        "description" => "A empresa XYZ anunciou o lançamento de um novo produto que promete mudar o mercado.",
        "image" => "https://exemplo.com/imagem2.jpg",
        "create_at" => new \DateTime("2022-01-14 15:30:00")
    ],
    [
        "title" => "Novo estudo revela impactos do aquecimento global",
        "description" => "Um novo estudo mostra que o aquecimento global está causando mudanças drásticas em ecossistemas marinhos.",
        "image" => "https://exemplo.com/imagem3.jpg",
        "create_at" => new \DateTime("2022-01-13 09:45:00")
    ],
    [
        "title" => "Atleta brasileiro ganha medalha de ouro em competição internacional",
        "description" => "O atleta brasileiro João da Silva conquistou a medalha de ouro no campeonato mundial de atletismo.",
        "image" => "https://exemplo.com/imagem4.jpg",
        "create_at" => new \DateTime("2022-01-12 16:20:00")
    ],
    [
        "title" => "Novo filme de super-herói bate recorde de bilheteria",
        "description" => "O novo filme da franquia 'Super-Herói X' bateu recorde de bilheteria em sua primeira semana de exibição.",
        "image" => "https://exemplo.com/imagem5.jpg",
        "create_at" => new \DateTime("2022-01-11 13:10:00")
    ],
    [
        "title" => "Pesquisadores descobrem nova espécie de animal marinho",
        "description" => "Pesquisadores da Universidade de São Paulo descobriram uma nova espécie de peixe em águas profundas do oceano Atlântico.",
        "image" => "https://exemplo.com/imagem6.jpg",
        "create_at" => new \DateTime("2022-01-10 11:00:00")
    ],
    [
        "title" => "Grande incêndio atinge área de preservação ambiental",
        "description" => "Um grande incêndio atingiu uma área de preservação ambiental no estado do Amazonas.",
        "image" => "https://exemplo.com/imagem7.jpg",
        "create_at" => new \DateTime("2022-01-09 19:15:00")
    ],
    [
        "title" => "Novo parque é inaugurado na cidade",
        "description" => "A prefeitura inaugura o novo parque da cidade, com diversas atrações para todas as idades.",
        "image" => "https://exemplo.com/parque.jpg",
        "create_at" => new \DateTime('2022-02-10'),
    ],
    [
        "title" => "Acidente grave na rodovia",
        "description" => "Um acidente envolvendo três veículos deixou quatro pessoas feridas na rodovia BR-101.",
        "image" => "https://exemplo.com/acidente.jpg",
        "create_at" => new \DateTime('2023-02-16 12:50'),
    ],
        ];

        return $news;
    }

}

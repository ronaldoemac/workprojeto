<?php

namespace App\Controller;

use App\Entity\News;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    #[Route('api/news/{id}',name: 'app_api', methods: ['GET'])]
    public function getNew(String|null $id=null): Response
    {
        // TODO - criar uma query real
        $new = [
            "id" => $id,
            "titulo" => "Artista brasileiro é premiado em festival internacional de cinema",
            "categoria" => "Cultura",
            "descricao" => "O artista brasileiro João da Silva ganhou o prêmio de melhor filme no festival internacional de cinema na Suécia",
            "data" => "20251020",
            "imagem" => "https://exemplo.com/imagem/arte.jpg",
        ];
        return new JsonResponse($new);
    }

    #[Route('/newss/new', 'nova_rota')]
    public function new(EntityManagerInterface $entityManager): Response
    {
        $rand = rand(18,38);
        $news = new News();
        $news->setTitle('Jovem de '.$rand .' anos recebe um prêmio');
        $news->setDescription('Um jovem brasileiro de '.$rand .' anos recebeu um prêmio na Suécia');
        $entityManager->persist($news);
        $entityManager->flush();
        
        return new Response('<h1> Notícia Criada em: </h1>'.$news->getCreateAt()->format('d/m/y H:i:s'));
    }
}
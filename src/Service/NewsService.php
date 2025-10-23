<?php

namespace App\Service;

use Psr\Cache\CacheItemInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class NewsService
{
    public function __construct(
        private HttpClientInterface $httpClient,
        private CacheInterface $cache,
        #[Autowire('%kernel.debug%')]
        private bool $isDebug,
    ) {}

    public function getCategoryList()
    {
        //dd($this->isDebug);
        $categories = $this->cache->get('news_category', function (CacheItemInterface $cacheItem) {
            $cacheItem->expiresAfter($this->isDebug ? 5 : 60);
            $url = "https://raw.githubusercontent.com/JonasPoli/array-news/refs/heads/main/arrayCategoryNews.json";
            $html = $this->httpClient->request('GET', $url);
            $categories = $html->toArray();

            return $categories;
        });

        return $categories;
    }

    public function getNewsList()
    {
        $news = $this->cache->get('news', function (CacheItemInterface $cacheItem) {
            $cacheItem->expiresAfter($this->isDebug ? 5 : 60);
            $url = "https://raw.githubusercontent.com/JonasPoli/array-news/refs/heads/main/arrayNews.json";
            $html = $this->httpClient->request('GET', $url);
            $news = $html->toArray();

            return $news;
        });

        return $news;
    }
}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Article 
{
    /**
     * @var [App\models\ArticleRepository] 用于存放由容器取得的ArticleRepository实例
     */
    private $repository;

    /**
     * @var 
     * @var [Twig_Environment] 用于存放由容器取得的Twig_Environment实例
     */
    private $twig;

    public function show($id)
    {
        $article = $this->repository->getArticle($id);

        echo $this->twig->render('article.twig', [
            'article' => $article,
        ]);
    }
}

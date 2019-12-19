<?php

namespace App\models;

class ArticleRepository implements ArticleRepositoryInterface
{
    private $articles;

    public function __construct()
    {
        $this->articles = [
            1 => new Article(1, '这是使用依赖注入构建的页面', '其控制器类并不继承CI_Controller类，而是由PHP_DI容器取得控制器实例，该实例的依赖以及依赖的依赖均由容器注入，实现了高度松耦合。'),
        ];
    }

    public function getArticles()
    {
        return $this->articles;
    }

    public function getArticle($id)
    {
        return $this->articles[$id];
    }
}

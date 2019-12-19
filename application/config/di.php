<?php

use function DI\autowire;
use function DI\factory;
use function DI\create;
use function DI\get;
use App\models\ArticleRepository;
use App\libraries\CI_Instance as CI;
use App\third_party\Twig;

return [
    'Home' => autowire()
        ->property('repository', get(ArticleRepository::class))
        ->property('ci', factory([CI::class, 'get_instance']))
        ->property('twig', get(Twig::class)),

    'Article' => autowire()
        ->property('repository', get(ArticleRepository::class))
        ->property('twig', get(Twig::class)),
];

<?php
namespace App\third_party;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Twig extends Environment
{
    private static $filesystemLoader;

    public function __construct()
    {
        if (self::$filesystemLoader == NULL) {
            self::$filesystemLoader = new FilesystemLoader(VIEWPATH. 'Twig');
        }
        parent::__construct(self::$filesystemLoader);
    }

}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home
{
    /**
	 * @var [App\models\ArticleRepository] 用于存放由容器取得的数据模型实例
     */
    private $repository;

    /**
     * @var [Twig_Environment] 用于存放由容器取得的第三方模板引擎实例
     */
    private $twig;

    /**
     * @var [CI_Controller] CodeIgniter 对象，通过此对象可以访问 CodeIgniter 资源
     */
    private $ci;

    public function index()
    {
        echo $this->twig->render('home.twig', [
            'articles' => $this->repository->getArticles(),
        ]);
    }
    
    public function ci_raw()
    {
        $this->ci->load->view('welcome_message');
    }

}

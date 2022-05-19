<?php

namespace App\Core;

use App\Classes\Session;

/**
 * Classe que gerencia o conteúdo para o carregamento da visão
 */
class Controller
{
    private string $base;

    private string $area;

    /**
     * Método contrutor que inicializa a área e monta o diretório base do Twig
     *
     * @param  string $area Qual a área que a View precisa ser carregada. Por padrão carrega a Main.
     * @return void
     */
    public function __construct(string $area = 'Main')
    {
        $this->area = $area;

        $this->base = '../app/Sites/' . $this->area . '/View/';
    }

    /**
     * Método que carrega a visão
     *
     * @param  string $page Diretório e página a ser carregado, ex: contato.form
     * @param  array $params Array com os valores a serem enviados para a view
     * @return void
     */
    protected function view(string $page, array $params = [])
    {
        $page = str_replace('.', '/', $page) . '.twig';

        $loader = new \Twig\Loader\FilesystemLoader($this->base);

        $twig = new \Twig\Environment($loader, [
            //'cache' => '../cache/'
        ]);

        $twig->addGlobal('BASE', BASE);
        $twig->addGlobal('ADMIN_BASE', ADMIN_BASE);

        $twig->addGlobal('username', $_COOKIE['username'] ?? 'Usuário');
        $twig->addGlobal('permission', Session::get('permission'));

        echo $twig->render($page, $params);
    }

    /**
     * Carrega a página de mensagem geenérica da aplicação
     *
     * @param  string $title Título da mensagem
     * @param  string $description Descrição da mensagem
     * @param  string $link Link para retornar
     * @return void
     */
    protected function showMessage(string $title, string $description, string $link = '#', int $httpCode = 200)
    {
        http_response_code($httpCode);

        $this->view('partials.message', [
            'messageTitle' => $title,
            'messageDescription' => $description,
            'messageLink' => $link
        ]);
    }
}

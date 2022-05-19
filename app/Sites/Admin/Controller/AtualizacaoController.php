<?php

namespace App\Sites\Admin\Controller;


use App\Classes\Input;
use App\Core\Controller;
use App\Core\Security;
use App\Classes\Session;
use App\Sites\Admin\Entities\Atualizacao;
use App\Sites\Admin\Entities\Usuario;
use App\Sites\Admin\Model\AtualizacaoModel;

class AtualizacaoController extends Controller
{

    public function __construct()
    {
        parent::__construct('Admin');

        Security::protect([1, 2]);
    }

    public function index()
    {
        $atualizacoes = (new AtualizacaoModel())->getAll();

        return $this->view('atualizacao.index',  [
            'atualizacoes' => $atualizacoes
        ]);
    }

    public function add()
    {
        return $this->view('atualizacao.add');
    }

    public function edit($id = -1)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        if (!$id || $id == null || $id <= 0) {
            return $this->showMessage('Dados inválidos', 'Os dados fornecidos são inválidos.', ADMIN_BASE  . 'atualizacao/', 422);
        }

        $atualizacao = (new AtualizacaoModel())->getById($id);

        if ($atualizacao->getId() == null || $atualizacao->getId() <= 0) {
            return $this->showMessage('Não encontrada', 'A atualização informada não pode ser encontrada.', ADMIN_BASE  . 'atualizacao/', 422);
        }

        return $this->view('atualizacao.edit', [
            'atualizacao' => $atualizacao
        ]);
    }

    public function insert()
    {
        $atualizacao = $this->getInput();

        if (!$this->validate($atualizacao, false)) {
            return $this->showMessage('Formulário inválido', 'Formulário inválido, por favor, preencha corretamente todos os campos.', ADMIN_BASE  . 'atualizacao/add');
        }

        $insertResult = (new AtualizacaoModel())->insert($atualizacao);

        if ($insertResult <= 0) {
            return $this->showMessage('Erro', 'Houve um erro durante a tentativa de cadastrar uma nova atualização, tente novamente mais tarde.', ADMIN_BASE  . 'usuario/add');
        }

        return redirect(ADMIN_BASE . 'atualizacao/edit/' . $insertResult);
    }

    public function update($id = -1)
    {
        $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

        if (!$id || $id == null || $id <= 0) {
            return $this->showMessage('Dados inválidos', 'Os dados fornecidos são inválidos.', ADMIN_BASE  . 'atualizacao/', 422);
        }

        $atualizacao = $this->getInput($id);

        if (!$this->validate($atualizacao)) {
            return $this->showMessage('Formulário inválido', 'Formulário inválido, por favor, preencha corretamente todos os campos.', ADMIN_BASE  . 'atualizacao/edit/' . $id);
        }

        if (!(new AtualizacaoModel())->update($atualizacao)) {
            return $this->showMessage('Erro', 'Houve um erro durante a tentativa de cadastrar uma nova atualização, tente novamente mais tarde.', ADMIN_BASE  . 'usuario/add');
        }

        return redirect(ADMIN_BASE . 'atualizacao/edit/' . $id);
    }

    private function validate(Atualizacao $atualizacao, bool $validateId = true): bool
    {

        if ($validateId && ($atualizacao->getId() == null || $atualizacao->getId() <= 0))
            return false;

        if (strlen($atualizacao->getTitulo()) < 10)
            return false;

        if (strlen($atualizacao->getDescricao()) < 10)
            return false;

        if ($atualizacao->getUsuario()->getId() == null || $atualizacao->getUsuario()->getId() <= 0)
            return false;

        return true;
    }

    private function getInput(int $id = null): Atualizacao
    {

        $atualizacao = new Atualizacao();

        $atualizacao->setId($id);
        $atualizacao->setTitulo(INPUT::POST('titulo'));
        $atualizacao->setDescricao(INPUT::POST('descricao', FILTER_SANITIZE_SPECIAL_CHARS));

        $usuario = new Usuario();
        $usuario->setId(Session::get('id'));

        $atualizacao->setUsuario($usuario);

        //$atualizacao->setUsuario(new Usuario(Session::get('id')));

        return $atualizacao;
    }
}

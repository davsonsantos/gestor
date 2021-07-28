<?php $v->layout("admin/_dash"); ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-6 mb-4 mb-xl-0 text-sm-align">
            <h4 class="font-weight-bold text-dark">Usuários!</h4>
            <p class="font-weight-normal mb-2 text-muted">Lista de Usuários</p>
        </div>
        <div class="col-sm-6 mb-4 mb-xl-0">
            <a href="<?= $router->route("users.user") ?>" class="btn btn-primary btn-sm-block float-right" data-toggle="tooltip" data-placement="top" title="Novo Usuário">Novo Usuário</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card" id="list">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="" action="<?= $router->route("users.list"); ?>" novalidate="" method="post" autocomplete="off">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <a href="<?= $router->route("users.list") ?>" class="btn btn-danger link" data-toggle="tooltip" data-placement="top" title="Limpar Pesquisa"><i class="far fa-times-circle"></i></a>
                                    </div>
                                    <input type="text" class="form-control" name="s" placeholder="Pesquisar Usuário" aria-label="Pesquisar Usuário" id="input_search">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisa"><i class="fa fa-search btn-icon-prepend"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <?php if (!$users) : ?>
                            <?= flash() ?>
                        <?php else : ?>
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Tipo</th>
                                        <th>Desde</th>
                                        <th class="text-center">Ação </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $user) :
                                        $photo = $user->thumb;
                                        $userPhoto = ($photo ? image($photo, 300, 300) : asset("images/avatar.jpg"));
                                    ?>
                                        <tr>
                                            <td class="py-1"><img src="<?= $userPhoto ?>" alt="<?= "{$user->first_name} {$user->last_name}" ?>" title="<?= "{$user->first_name} {$user->last_name}" ?>" /></td>
                                            <td><?= "{$user->fullName()}" ?></td>
                                            <td><?= "{$user->email}" ?></td>
                                            <td><?= getLevel($user->level); ?></td>
                                            <td>Desde <?= date_fmt($user->created_at, "d/m/y \à\s H\hi"); ?></td>
                                            <td class="text-center"> <?php echo $router->route("user.list", ["user_id" => $user->id]) ?>
                                                <a href="<?= url("admin/dash/users/user/{$user->id}") ?>" class="text-primary">
                                                    <i class="mdi mdi-pen"></i> Editar
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2">
                                            <span class="float-left"><?= $pages ?></span>
                                        </td>
                                        <td colspan="4">
                                            <span class="float-right"><?= $paginator; ?></span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $v->start("scripts"); ?>

<?php $v->end(); ?>
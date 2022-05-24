<?php $this->layout("admin/_dash", ['head' => $head]); ?>
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <div class="page-header-title">
                    <h5 class="m-b-10">Dashboard</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= $router->route("dash.home"); ?>"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="<?= $router->route("dash.home"); ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= $router->route("users.list"); ?>">Lista de Usuários</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-sm-12">
        <div class="card">

            <div class="card-header">
                <h5>Usuários</h5>
                <div class="card-header-right">
                    <a href="<?= $router->route("users.user") ?>" class="btn btn-primary btn-sm-block float-right" data-toggle="tooltip" data-placement="top" title="Novo Usuário">Novo Usuário</a>
                </div>
            </div>
            <div class="card-body">

                <form action="<?= $router->route("users.list"); ?>" novalidate method="post" autocomplete="off">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <a class="btn  btn-danger" href="<?= $router->route("users.list") ?>" data-toggle="tooltip" data-placement="top" title data-original-title="Limpar Pesquisa"><i class="far fa-times-circle"></i></a>
                        </div>
                        <input type="text" class="form-control" name="s" placeholder="Pesquisar Usuário" value="<?= $search ?? "" ?>" id="input_search" required>
                        <div class="input-group-prepend">
                            <button class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title data-original-title="Pesquisar"><i class="fa fa-search btn-icon-prepend"></i></button>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row">
                    <?php if (!$users) : ?>
                        <div class="col-md-12">
                            <?= flash() ?>
                        </div>
                    <?php else : ?>
                        <div class="card-body table-border-style">
                            <div class="table-responsive">
                                <table class="table">
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
                                                <td><img class="img-radius profile-img cust-img m-b-15" style="width: 50px;" src="<?= $userPhoto ?>" alt="<?= "{$user->first_name} {$user->last_name}" ?>" title="<?= "{$user->first_name} {$user->last_name}" ?>" /></td>
                                                <td><?= "{$user->fullName()}" ?></td>
                                                <td><?= "{$user->email}" ?></td>
                                                <td><?= getLevel($user->level); ?></td>
                                                <td>Desde <?= date_fmt($user->created_at, "d/m/y \à\s H\hi"); ?></td>
                                                <td class="text-center"> <?php echo $router->route("user.list", ["user_id" => $user->id]) ?>
                                                    <button type="button" class="btn  btn-icon btn-warning" onclick="location.href='<?= url("admin/dash/users/user/{$user->id}") ?>'">
                                                        <i class="fa fa-pen"></i>
                                                    </button>
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
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
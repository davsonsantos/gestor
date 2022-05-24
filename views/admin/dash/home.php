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
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <h1>dasadsad</h1>
</div>
<!-- <div class="content-wrapper">
    <div class="row">
        <div class="col-sm-12 mb-4 mb-xl-0">
            <h4 class="font-weight-bold text-dark">Inicio!</h4>
            <p class="font-weight-normal mb-2 text-muted">
                <?php
                // echo ucfirst(data_portuguese('today'));
                ?>
            </p>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-xl-12 grid-margin-lg-0 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row w-100">
                        <div class="col-md-3">
                            <div class="card border-info mx-sm-1 p-3">
                                <div class="card border-info shadow text-info p-3 my-card"><span class="fa fa-users" aria-hidden="true"></span></div>
                                <div class="text-info text-center mt-3">
                                    <h4>Usuários</h4>
                                </div>
                                <div class="text-info text-center mt-2">
                                    <h1><?= $users->users; ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-success mx-sm-1 p-3">
                                <div class="card border-success shadow text-success p-3 my-card"><span class="fa fa-eye" aria-hidden="true"></span></div>
                                <div class="text-success text-center mt-3">
                                    <h4>Eyes</h4>
                                </div>
                                <div class="text-success text-center mt-2">
                                    <h1>9332</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-danger mx-sm-1 p-3">
                                <div class="card border-danger shadow text-danger p-3 my-card"><span class="fa fa-heart" aria-hidden="true"></span></div>
                                <div class="text-danger text-center mt-3">
                                    <h4>Hearts</h4>
                                </div>
                                <div class="text-danger text-center mt-2">
                                    <h1>346</h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card border-warning mx-sm-1 p-3">
                                <div class="card border-warning shadow text-warning p-3 my-card"><span class="fa fa-globe" aria-hidden="true"></span></div>
                                <div class="text-warning text-center mt-3">
                                    <h4>Online Agora</h4>
                                </div>
                                <div class="text-warning text-center mt-2">
                                    <h1><?= $onlineCount; ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-12 grid-margin-lg-0 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php if (!$online) : ?>
                        <div class="alert alert-info">
                            Não existem usuários online navegando no site neste momento. Quando tiver, você
                            poderá monitoriar todos por aqui.
                        </div>
                    <?php else : ?>
                        <h4 class="card-title">Páginas Acessadas</h4>

                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Usuário</th>
                                        <th>Páginas</th>
                                        <th>Links</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($online as $onlineNow) : ?>
                                        <tr>
                                            <td class="py-1">
                                                [<?= date_fmt($onlineNow->created_at, "H\hm"); ?> - <?= date_fmt($onlineNow->updated_at, "H\hm"); ?>] <?= ($onlineNow->user ? $onlineNow->user()->fullName() : "Guest User"); ?>
                                            </td>

                                            <td>
                                                <?= $onlineNow->pages; ?> páginas vistas
                                            </td>
                                            <td><a target="_blank" href="<?= url("/{$onlineNow->url}"); ?>"><b><?= strtolower(SITE['name']); ?></b><?= $onlineNow->url; ?>
                                                </a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div> -->
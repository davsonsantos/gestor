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
                    <li class="breadcrumb-item active"><a href="#"><?= ($user ?  $user->fullName() : 'Novo Usuário') ?></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="row">

    <div class="col-md-10">
        <div class="card">

            <div class="card-header">
                <h5><?= ($user ?  $user->fullName() : 'Novo Usuário') ?></h5>
                <div class="card-header-right">
                    <a href="<?= $router->route("users.list") ?>" class="btn btn-secondary" data-toggle="tooltip" data-placement="top" title="Voltar"><i class="fa fa-arrow-left"></i></a>
                    <a href="<?= $router->route("users.user") ?>" class="btn btn-primary btn-sm-block float-right" data-toggle="tooltip" data-placement="top" title="Novo Usuário">Novo Usuário</a>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="card-body">
                        <form method="post" class="my-login-validation" novalidate="" action="<?= url("/admin/dash/users/user" . ($user ? "/" . $user->id : null)); ?>">
                            <input type="hidden" name="action" value="<?= !$user ? "create" : "update"; ?>" />
                            <?= csrf_input(); ?>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Nome <span class='text-danger'>*</span></label>
                                        <input id="first_name" type="text" class="form-control" name="first_name" placeholder="Primeiro nome" required value="<?= $user ? $user->first_name : null; ?>">
                                        <div class="invalid-feedback">
                                            Informe o Primeiro nome
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Sobrenome <span class='text-danger'>*</span></label>
                                        <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Sobrenome" required value="<?= $user ? $user->last_name : null; ?>">
                                        <div class="invalid-feedback">
                                            Informe o Sobrenome
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Nascimento</label>
                                        <input id="datebirth" type="text" class="form-control mask mask-date" name="datebirth" placeholder="dd/mm/yyyy" value="<?= $user ? date_fmt_br($user->datebirth) : null; ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Profissão</label>
                                        <input id="skills" type="text" class="form-control" name="skills" placeholder="Profissão" value="<?= $user ? $user->skills : null; ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Foto (600x600px)</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="img-input" accept="image/*" name="photo" lang="pt-BR">
                                            <label class="custom-file-label" for="img-input" data-browse="Selecionar">Selecione a Imagem...</label>
                                        </div>
                                        <!-- <input type="file" id="img-input" accept="image/*" name="photo" class="form-control-file form-control height-auto"> -->
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Documento</label>
                                        <input id="document" type="text" class="form-control mask mask-doc" name="document" placeholder="CPF" value="<?= $user ? $user->document : null; ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>E-mail <span class='text-danger'>*</span></label>
                                        <input id="email" type="email" class="form-control" name="email" placeholder="Melhor E-mail" required value="<?= $user ? $user->email : null; ?>">
                                        <div class="invalid-feedback">
                                            Informe o E-mail
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Senha <?= $user ? "<span class='text-danger'>Só informe se for alterar</span>" : "<span class='text-danger'>*</span>"; ?></label>
                                        <input id="password" type="password" class="form-control" name="password" placeholder="Sua Senha" <?= !$user ? "required" : "" ?> value="">
                                        <div class="invalid-feedback">
                                            Informe a Senha
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Gênero</label>
                                        <select id="genre" class="form-control" name="genre">
                                            <option selected disabled></option>
                                            <?php foreach ($genres as $genre_i => $genre_v) : ?>
                                                <option <?= $user && $user->genre == $genre_i ? "selected" : ""; ?> value="<?= $genre_i ?>"><?= $genre_v ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Nível <span class='text-danger'>*</span></label>
                                        <select id="level" class="form-control" name="level" required>
                                            <option selected disabled></option>
                                            <?php foreach ($levels as $level_i => $level_v) : ?>
                                                <option <?= $user && $user->level == $level_i ? "selected" : ""; ?> value="<?= $level_i ?>"><?= $level_v ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Informe o Nível
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select id="status" class="form-control" name="status" required>
                                            <option selected disabled></option>
                                            <?php foreach ($status as $status_i => $status_v) : ?>
                                                <option <?= $user && $user->status == $status_i ? "selected" : ""; ?> value="<?= $status_i ?>"><?= $status_v ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Informe o status
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-4">
                                    <?php if (!$user) : ?>
                                        <button class="btn btn-info" type="submit">Criar Usuário</button>
                                    <?php else : ?>
                                        <button class="btn btn-warning" type="submit">Atualizar</button>
                                        <?php
                                        if (user()->id != $user->id && user()->level >= 4) :
                                        ?>
                                            <a class="btn btn-outline-danger" title="" href="#" data-post="<?= url("/admin/dash/users/user/{$user->id}"); ?>" data-action="delete" data-confirm="Tem certeza que deseja deletar esse usuário?" data-user_id="<?= $user->id; ?>">Deletar</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-8">
                                    <div class="ajax_response"><?= flash(); ?></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="card mb-3">
            <?php
            $photo = $user->thumb;
            $userPhoto = ($photo ? image($photo, 300, 300) : asset("images/avatar.jpg"));
            ?>
            <img id="preview" class="img-fluid card-img-top" src="<?= $userPhoto ?>">
        </div>
    </div>
</div>
<!--
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-6 mb-4 mb-xl-0">
            <h4 class="font-weight-bold text-dark">Usuário!</h4>
            <p class="font-weight-normal mb-2 text-muted"><?= ($user ? '<li class="breadcrumb-item active">' . $user->fullName() . '</li>' : 'Novo Usuário') ?></p>
        </div>
        <div class="col-sm-6 mb-4 mb-xl-0 ">
            <div class="input-group-append float-right">
                <a href="<?= $router->route("users.list") ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Voltar"><i class="fa fa-arrow-left"></i></a>
                <a href="<?= $router->route("users.user") ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Novo Usuário">
                    Novo Usuário
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card" id="user">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="my-login-validation" novalidate="" action="<?= url("/admin/dash/users/user" . ($user ? "/" . $user->id : null)); ?>">
                        <input type="hidden" name="action" value="<?= !$user ? "create" : "update"; ?>" />
                        <?= csrf_input(); ?>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Nome <span class='text-danger'>*</span></label>
                                    <input id="first_name" type="text" class="form-control" name="first_name" placeholder="Primeiro nome" required value="<?= $user ? $user->first_name : null; ?>">
                                    <div class="invalid-feedback">
                                        Informe o Primeiro nome
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Sobrenome <span class='text-danger'>*</span></label>
                                    <input id="last_name" type="text" class="form-control" name="last_name" placeholder="Sobrenome" required value="<?= $user ? $user->last_name : null; ?>">
                                    <div class="invalid-feedback">
                                        Informe o Sobrenome
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Nascimento</label>
                                    <input id="datebirth" type="text" class="form-control mask mask-date" name="datebirth" placeholder="dd/mm/yyyy" value="<?= $user ? date_fmt_br($user->datebirth) : null; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Profissão</label>
                                    <input id="skills" type="text" class="form-control" name="skills" placeholder="Profissão" value="<?= $user ? $user->skills : null; ?>">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Foto (600x600px)</label>
                                    <input type="file" name="photo" onchange="loadFile(event)" class="form-control-file form-control height-auto">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Documento</label>
                                    <input id="document" type="text" class="form-control mask mask-doc" name="document" placeholder="CPF" value="<?= $user ? $user->document : null; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>E-mail <span class='text-danger'>*</span></label>
                                    <input id="email" type="email" class="form-control" name="email" placeholder="Melhor E-mail" required value="<?= $user ? $user->email : null; ?>">
                                    <div class="invalid-feedback">
                                        Informe o E-mail
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Senha <?= $user ? "<span class='text-danger'>Só informe se for alterar</span>" : "<span class='text-danger'>*</span>"; ?></label>
                                    <input id="password" type="password" class="form-control" name="password" placeholder="Sua Senha" <?= !$user ? "required" : "" ?> value="">
                                    <div class="invalid-feedback">
                                        Informe a Senha
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Gênero</label>
                                    <select id="genre" class="form-control" name="genre">
                                        <option selected disabled></option>
                                        <?php foreach ($genres as $genre_i => $genre_v) : ?>
                                            <option <?= $user && $user->genre == $genre_i ? "selected" : ""; ?> value="<?= $genre_i ?>"><?= $genre_v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Nível <span class='text-danger'>*</span></label>
                                    <select id="level" class="form-control" name="level" required>
                                        <option selected disabled></option>
                                        <?php foreach ($levels as $level_i => $level_v) : ?>
                                            <option <?= $user && $user->level == $level_i ? "selected" : ""; ?> value="<?= $level_i ?>"><?= $level_v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Informe o Nível
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select id="status" class="form-control" name="status" required>
                                        <option selected disabled></option>
                                        <?php foreach ($status as $status_i => $status_v) : ?>
                                            <option <?= $user && $user->status == $status_i ? "selected" : ""; ?> value="<?= $status_i ?>"><?= $status_v ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Informe o status
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-4">
                                <?php if (!$user) : ?>
                                    <button class="btn btn-info" type="submit">Criar Usuário</button>
                                <?php else : ?>
                                    <button class="btn btn-warning" type="submit">Atualizar</button>
                                    <?php
                                    if (user()->id != $user->id && user()->level >= 4) :
                                    ?>
                                        <a class="btn btn-outline-danger" title="" href="#" data-post="<?= url("/admin/dash/users/user/{$user->id}"); ?>" data-action="delete" data-confirm="Tem certeza que deseja deletar esse usuário?" data-user_id="<?= $user->id; ?>">Deletar</a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="col-8">
                                <div class="ajax_response"><?= flash(); ?></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
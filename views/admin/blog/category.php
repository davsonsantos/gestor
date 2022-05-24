<?php $v->layout("admin/_dash"); ?>
<div class="content-wrapper">
<div class="row">
        <div class="col-sm-6 mb-4 mb-xl-0">
            <h4 class="font-weight-bold text-dark">Categoria!</h4>
            <p class="font-weight-normal mb-2 text-muted"><?= ($category ? '<li class="breadcrumb-item active">' . $category->title . '</li>' : 'Nova Categoria') ?></p>
        </div>
        <div class="col-sm-6 mb-4 mb-xl-0 ">
            <div class="input-group-append float-right">
                <a href="<?= $router->route("blog.categories") ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Voltar"><i class="fa fa-arrow-left"></i></a>
                <a href="<?= $router->route("blog.category") ?>" class="btn btn-primary btn-sm-block float-right" data-toggle="tooltip" data-placement="top" title="Nova Categoria">Nova Categoria</a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card" id="user">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="my-login-validation" novalidate="" action="<?= url("/admin/dash/blog/category" . ($category ? "/" . $category->id : null)); ?>">
                        <input type="hidden" name="action" value="<?= !$category ? "create" : "update"; ?>" />
                        <?= csrf_input(); ?>
                        <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Titulo <span class='text-danger'>*</span></label>
                            <input id="title" type="text" class="form-control" name="title" placeholder="Titulo" required value="<?= $category ? $category->title : null; ?>">
                            <div class="invalid-feedback">
                                Informe o titulo da categoria
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Foto (600x600px)</label>
                            <input type="file" name="cover" class="form-control-file form-control height-auto">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label>Descrição <span class='text-danger'>*</span></label>
                            <textarea id="description" class="form-control" name="description" placeholder="Sobre esta categoria" required><?= $category ? $category->description : null; ?></textarea>
                            <div class="invalid-feedback">
                                Faça uma descrição sobre a categoria
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <?php if (!$category) : ?>
                            <button class="btn btn-info" type="submit">Criar Categoria</button>
                        <?php else : ?>
                            <button class="btn btn-warning" type="submit">Atualizar</button>
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
<?php $v->layout("admin/_dash"); ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-6 mb-4 mb-xl-0 text-sm-align">
            <h4 class="font-weight-bold text-dark">Categorias!</h4>
            <p class="font-weight-normal mb-2 text-muted">Lista de categorias do blog</p>
        </div>
        <div class="col-sm-6 mb-4 mb-xl-0">
            <a href="<?= $router->route("blog.category") ?>" class="btn btn-primary btn-sm-block float-right" data-toggle="tooltip" data-placement="top" title="Nova Categoria">Nova Categoria</a>
        </div>
    </div>
   
    <div class="row mb-5">
        <div class="col-xl-12 grid-margin-lg-0 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card" id="list">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <?php if (!$categories) : ?>
                                            <div class="alert alert-info">Não há categorias cadastradas</div>
                                        <?php else : ?>
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Capa</th>
                                                        <th>Titulo</th>
                                                        <th>Descrição</th>
                                                        <th class="text-center">Ação </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($categories as $category) : 
                                                        $photo = $category->cover;
                                                        $categoryCover  = ($photo ? image($photo, 300, 300) : asset("images/no-image.jpg"));
														
                                                    ?>
                                                        <tr>
                                                            <td class="py-1"><img src="<?= $categoryCover ?>" alt="<?= "{$category->title}" ?>" title="<?= "{$category->title}" ?>" /></td>
                                                            <td><?= $category->title; ?> [ <b><?= $category->posts()->count(); ?> artigos aqui</b> ]</td>
                                                            <td><?= $category->description; ?></td>
                                                            <td class="text-center" style="width: 15%;">
                                                                <ul class="list-inline m-0">
                                                                    <li class="list-inline-item">
                                                                        <a href="<?= url("admin/dash/blog/categoria/{$category->id}") ?>" class="btn btn-warning btn-rounded btn-icon btm-sm" data-toggle="tooltip" data-placement="top" title="Editar categoria">
                                                                            <i class="fa fa-pen"></i>
                                                                        </a>
                                                                    </li>
                                                                    <li class="list-inline-item">
                                                                        <a class="btn btn-danger btn-rounded btn-icon btm-sm" href="#" title="" data-post="<?= url("/admin/dash/blog/category/{$category->id}"); ?>" data-action="delete" data-confirm="Tem certeza que deseja deletar a categoria?" data-category_id="<?= $category->id; ?>">
                                                                            <i class="fa fa-trash"></i>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr>
                                                        <td colspan="2">
                                                            <span class="float-left"><?= $pages ?></span>
                                                        </td>
                                                        <td colspan="2">
                                                            <span class="float-right"><?= $paginator; ?></span>
                                                        </td>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        <?php endif; ?>

                                    </div>
                                    <div class="row pt-3">
                                        <div class="col-12">
                                            <div class="ajax_response"><?= flash(); ?></div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
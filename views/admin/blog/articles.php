<?php $v->layout("admin/_dash"); ?>
<style>

</style>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-6 mb-4 mb-xl-0 text-sm-align">
            <h4 class="font-weight-bold text-dark">Artigos!</h4>
            <p class="font-weight-normal mb-2 text-muted">Lista de Posts</p>
        </div>
        <div class="col-sm-6 mb-4 mb-xl-0">
            <a href="<?= $router->route("blog.article") ?>" class="btn btn-primary btn-sm-block float-right" data-toggle="tooltip" data-placement="top" title="Novo Artigo">Novo Artigo</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card" id="list">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <form class="" action="<?= $router->route("blog.list"); ?>" novalidate="" method="post" autocomplete="off">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <a href="<?= $router->route("blog.list") ?>" class="btn btn-danger link" data-toggle="tooltip" data-placement="top" title="Limpar Pesquisa"><i class="far fa-times-circle"></i></a>
                                    </div>
                                    <input type="text" class="form-control" name="s" placeholder="Pesquisar Artigos" aria-label="Pesquisar artigos" id="input_search">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit" data-toggle="tooltip" data-placement="top" title="Pesquisa"><i class="fa fa-search btn-icon-prepend"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if (!$posts) : ?>
                        <?= flash() ?>
                    <?php else : ?>
                        <?php foreach ($posts as $post) :
                            $photo = $post->cover;
                            $postPhoto = ($photo ? image($photo, 300, 300) : asset("images/no-image.jpg"));
                        ?>
                            <div class="card-article">
                                <div class="row">
                                    <div class="col-sm-3" style="background: url(<?= $postPhoto ?>) center center no-repeat; background-size: cover">
                                        <!-- <img class="d-block" src="<?= $postPhoto ?>" alt="<?= $post->title ?>" title="<?= $post->title ?>"> -->
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="card-block-article mb-4">
                                            <h5 class="display1"><?= $post->title ?></h5>
                                            <p><?= $post->subtitle ?></p>
                                            <p class="info">
                                            <h6>
                                                Em: <?= date_fmt($post->post_at, "d.m.y \à\s H\hi"); ?> |
                                                Categoria: <?= $post->category()->title; ?> |
                                                por: <?= $post->author()->fullName(); ?>
                                            </h6>
                                            <h6>
                                                <p>
                                                    Visualizações: <?= $post->views; ?> |
                                                    Situação: <?= ($post->status == "post" ? "Artigo" : ($post->status == "draft" ? "Rascunho" : "Lixo")); ?>
                                                </p>
                                                <br>
                                                <a href="<?= url("/admin/dash/blog/artigo/{$post->id}"); ?>" class="btn btn-warning btn-sm float-right ml-2">Editar</a>
                                                <a class="btn btn-danger btn-sm float-right" title="" href="#" data-post="<?= url("/admin/dash/blog/article"); ?>" data-action="delete" data-confirm="Tem certeza que deseja deletar esse post?" data-post_id="<?= $post->id; ?>">Deletar</a>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <div class="col-12 mt-4">
                        <span class="float-left"><?= $pages ?></span>
                        <span class="float-right"><?= $paginator; ?></span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php $v->start("scripts"); ?>

<?php $v->end(); ?>
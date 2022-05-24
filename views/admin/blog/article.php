<?php $v->layout("admin/_dash"); ?>

<div class="mce_upload" style="z-index: 9999">
    <div class="mce_upload_box">
        <form class="app_form" action="<?= url("/admin/dash/blog/article"); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="upload" value="true" />
            <label>
                <label class="legend">Selecione uma imagem JPG ou PNG:</label>
                <input class="form-control" accept="image/*" type="file" name="image" required />
            </label>
            <button class="btn btn-primary">Enviar Imagem</button>
        </form>
    </div>
</div>


<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-6 mb-4 mb-xl-0">
            <h4 class="font-weight-bold text-dark">Artigos!</h4>
            <p class="font-weight-normal mb-2 text-muted"><?= ($post ? '<li class="breadcrumb-item active">' . $post->title . '</li>' : 'Novo Artigo') ?></p>
        </div>
        <div class="col-sm-6 mb-4 mb-xl-0 ">
            <div class="input-group-append float-right">
                <a href="<?= $router->route("blog.list") ?>" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Voltar"><i class="fa fa-arrow-left"></i></a>
                <a href="<?= $router->route("blog.article") ?>" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Novo Artigo">
                    Novo Artigo
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card" id="user">
            <div class="card">
                <div class="card-body">
                    <form method="post" class="my-login-validation" novalidate="" action="<?= url("/admin/dash/blog/article" . ($post ? "/" . $post->id : null)); ?>">
                        <input type="hidden" name="action" value="<?= !$post ? "create" : "update"; ?>" />
                        <?= csrf_input(); ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Titulo <span class='text-danger'>*</span></label>
                                    <input id="title" type="text" class="form-control" name="title" placeholder="Titulo do Artigo" required value="<?= $post ? $post->title : null; ?>">
                                    <div class="invalid-feedback">
                                        Informe o titulo artigo
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Subtitulo <span class='text-danger'>*</span></label>
                                    <textarea id="subtitle" name="subtitle" class="form-control" placeholder="O texto de apoio da manchete" required><?= $post ? $post->subtitle : null; ?></textarea>
                                    <div class="invalid-feedback">
                                        Informe o texto de apoio do artigo
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Foto (600x600px)</label>
                                    <input type="file" name="cover" class="form-control-file form-control height-auto" placeholder="Uma capa para o artigo">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Video [<span class="text-warning">Opcional</span>]</label>
                                    <input id="video" type="text" class="form-control" name="video" placeholder="Video do Artigo" value="<?= $post ? $post->video : null; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>Subtitulo <span class='text-danger'>*</span></label>
                                    <textarea id="subtitle" name="content" class="form-control mce" required><?= $post ? $post->content : null; ?></textarea>
                                    <div class="invalid-feedback">
                                        Digite o conteúdo do artigo
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Status <span class='text-danger'>*</span></label>
                                    <select id="status" name="status" required class="form-control">
                                        <?php
                                        $status = $post->status;
                                        $select = function ($value) use ($status) {
                                            return ($status == $value ? "selected" : "");
                                        };
                                        ?>
                                        <option <?= $select("post"); ?> value="post">Publicar</option>
                                        <option <?= $select("draft"); ?> value="draft">Rascunho</option>
                                        <option <?= $select("trash"); ?> value="trash">Lixo</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Informe a Categoria do Artigo
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Autor <span class='text-danger'>*</span></label>
                                    <select id="author_id" name="author_id" required class="form-control">
                                        <?php foreach ($authors as $author) :
                                            $authorId = $post->author;
                                            $select = function ($value) use ($authorId) {
                                                return ($authorId == $value ? "selected" : "");
                                            };
                                        ?>
                                            <option <?= $select($author->id); ?> value="<?= $author->id; ?>"><?= $author->fullName(); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Informe a Categoria do Artigo
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Categoria <span class='text-danger'>*</span></label>
                                    <select id="category_id" name="category_id" required class="form-control">
                                        <?php foreach ($categories as $category) :
                                            $categoryId = $post->category;
                                            $select = function ($value) use ($categoryId) {
                                                return ($categoryId == $value ? "selected" : "");
                                            };
                                        ?>
                                            <option <?= $select($category->id); ?> value="<?= $category->id; ?>"><?= $category->title; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Informe a Categoria do Artigo
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Data Publicação <span class='text-danger'>*</span></label>
                                    <input id="post_at" class="mask-datetime form-control" type="text" name="post_at" value="<?= $post ? date_fmt($post->post_at, "d/m/Y H:i") : date_fmt(date('Y-m-d H:i'), "d/m/Y H:i")  ?>" required />
                                    <div class="invalid-feedback">
                                        Informe a data de publicação
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-2">
                                <?php if (!$post) : ?>
                                    <button class="btn btn-info" type="submit">Criar Artigo</button>
                                <?php else : ?>
                                    <button class="btn btn-warning" type="submit">Atualizar</button>
                                <?php endif; ?>
                            </div>
                            <div class="col-10">
                                <div class="ajax_response"><?= flash(); ?></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $v->start("scripts"); ?>
<script src="<?= url("/shared/plugins/tinymce/tinymce.min.js"); ?>"></script>
<?php $v->end(); ?>
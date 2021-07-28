<?php $v->layout("admin/_dash"); ?>

<style>
    /**
 * Panels
 */
    /*** General styles ***/
    .panel {
        box-shadow: none;
    }

    .panel-heading {
        border-bottom: 0;
    }

    .panel-title {
        font-size: 17px;
    }

    .panel-title>small {
        font-size: .75em;
        color: #999999;
    }

    .panel-body *:first-child {
        margin-top: 0;
    }

    .panel-footer {
        border-top: 0;
    }

    .panel-default>.panel-heading {
        color: #333333;
        background-color: transparent;
        border-color: rgba(0, 0, 0, 0.07);
    }

    /**
 * Profile
 */
    /*** Profile: Header  ***/
    .profile__avatar {
        float: left;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        margin-right: 20px;
        overflow: hidden;
    }

    @media (min-width: 768px) {
        .profile__avatar {
            width: 100px;
            height: 100px;
        }
    }

    .profile__avatar>img {
        width: 100%;
        height: auto;
    }

    .profile__header {
        overflow: hidden;
    }

    .profile__header p {
        margin: 20px 0;
    }

    /*** Profile: Table ***/
    @media (min-width: 992px) {
        .profile__table tbody th {
            width: 200px;
        }
    }

    /*** Profile: Recent activity ***/
    .profile-comments__item {
        position: relative;
        padding: 15px 16px;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .profile-comments__item:last-child {
        border-bottom: 0;
    }

    .profile-comments__item:hover,
    .profile-comments__item:focus {
        background-color: #f5f5f5;
    }

    .profile-comments__item:hover .profile-comments__controls,
    .profile-comments__item:focus .profile-comments__controls {
        visibility: visible;
    }

    .profile-comments__controls {
        position: absolute;
        top: 0;
        right: 0;
        padding: 5px;
        visibility: hidden;
    }

    .profile-comments__controls>a {
        display: inline-block;
        padding: 2px;
        color: #999999;
    }

    .profile-comments__controls>a:hover,
    .profile-comments__controls>a:focus {
        color: #333333;
    }

    .profile-comments__avatar {
        display: block;
        float: left;
        margin-right: 20px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        overflow: hidden;
    }

    .profile-comments__avatar>img {
        width: 100%;
        height: auto;
    }

    .profile-comments__body {
        overflow: hidden;
    }

    .profile-comments__sender {
        color: #333333;
        font-weight: 500;
        margin: 5px 0;
    }

    .profile-comments__sender>small {
        margin-left: 5px;
        font-size: 12px;
        font-weight: 400;
        color: #999999;
    }

    @media (max-width: 767px) {
        .profile-comments__sender>small {
            display: block;
            margin: 5px 0 10px;
        }
    }

    .profile-comments__content {
        color: #999999;
    }

    /*** Profile: Contact ***/
    .profile__contact-btn {
        padding: 12px 20px;
        margin-bottom: 20px;
    }

    .profile__contact-hr {
        position: relative;
        border-color: rgba(0, 0, 0, 0.1);
        margin: 40px 0;
    }

    .profile__contact-hr:before {
        content: "OR";
        display: block;
        padding: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        background-color: #f5f5f5;
        color: #c6c6cc;
    }

    .profile__contact-info-item {
        margin-bottom: 30px;
    }

    .profile__contact-info-item:before,
    .profile__contact-info-item:after {
        content: " ";
        display: table;
    }

    .profile__contact-info-item:after {
        clear: both;
    }

    .profile__contact-info-item:before,
    .profile__contact-info-item:after {
        content: " ";
        display: table;
    }

    .profile__contact-info-item:after {
        clear: both;
    }

    .profile__contact-info-icon {
        float: left;
        font-size: 18px;
        color: #999999;
    }

    .profile__contact-info-body {
        overflow: hidden;
        padding-left: 20px;
        color: #999999;
    }

    .profile__contact-info-body a {
        color: #999999;
    }

    .profile__contact-info-body a:hover,
    .profile__contact-info-body a:focus {
        color: #999999;
        text-decoration: none;
    }

    .profile__contact-info-heading {
        margin-top: 2px;
        margin-bottom: 5px;
        font-weight: 500;
        color: #999999;
    }
</style>

<div class="content-wrapper">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="row">
                <div class="col-9">
                    <div class="card-body">

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">Perfil do Usuário</h4>
                            </div>
                            <div class="panel-body">
                                <div class="profile__avatar">
                                    <?php
                                    $photo = user()->thumb;
                                    $userPhoto = ($photo ? image($photo, 300, 300) : asset("images/avatar.jpg"));
                                    ?>
                                    <img src="<?= $userPhoto ?>" alt="<?= user()->first_name ?> <?= user()->last_name ?>" title="<?= user()->first_name ?> <?= user()->last_name ?>">
                                </div>
                                <div class="profile__header">
                                    <h4><?= user()->first_name ?> <?= user()->last_name ?> <small><?= user()->skills ?></small></h4>
                                    <p class="text-muted"><?= user()->resume ?></p>
                                    <p>
                                        <a href="#"><?= user()->email ?></a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-default mt-5">
                            <div class="panel-heading">
                                <h4 class="panel-title">Dados do Usuário</h4>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th><strong>Location</strong></th>
                                            <td>United States</td>
                                        </tr>
                                        <tr>
                                            <th><strong>Company name</strong></th>
                                            <td>Simpleqode.com</td>
                                        </tr>
                                        <tr>
                                            <th><strong>Position</strong></th>
                                            <td>Front-end developer</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel panel-default mt-5">
                            <div class="panel-heading">
                                <h4 class="panel-title">Comunidade</h4>
                            </div>
                            <div class="panel-body">
                                <table class="table table-striped">
                                    <tbody>
                                        <tr>
                                            <th><strong>Comments</strong></th>
                                            <td>58584</td>
                                        </tr>
                                        <tr>
                                            <th><strong>Member since</strong></th>
                                            <td>Jan 01, 2016</td>
                                        </tr>
                                        <tr>
                                            <th><strong>Last login</strong></th>
                                            <td>1 day ago</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="panel panel-default mt-5">
                            <div class="panel-heading">
                                <h4 class="panel-title">Posts Criados</h4>
                            </div>
                            <div class="panel-body">
                                <div class="profile__comments">
                                    <div class="profile-comments__item">
                                        <div class="profile-comments__controls">
                                            <a href="#"><i class="fa fa-eye"></i></a>
                                            <a href="#"><i class="fa fa-edit"></i></a>
                                            <a href="#"><i class="fa fa-trash"></i></a>
                                        </div>
                                        <div class="profile-comments__avatar">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="...">
                                        </div>
                                        <div class="profile-comments__body">
                                            <h5 class="profile-comments__sender">
                                                Richard Roe <small>2 hours ago</small>
                                            </h5>
                                            <div class="profile-comments__content">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, corporis. Voluptatibus odio perspiciatis non quisquam provident, quasi eaque officia.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-comments__item">
                                        <div class="profile-comments__controls">
                                            <a href="#"><i class="fa fa-share-square-o"></i></a>
                                            <a href="#"><i class="fa fa-edit"></i></a>
                                            <a href="#"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                        <div class="profile-comments__avatar">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="...">
                                        </div>
                                        <div class="profile-comments__body">
                                            <h5 class="profile-comments__sender">
                                                Richard Roe <small>5 hours ago</small>
                                            </h5>
                                            <div class="profile-comments__content">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero itaque dolor laboriosam dolores magnam mollitia, voluptatibus inventore accusamus illo.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-comments__item">
                                        <div class="profile-comments__controls">
                                            <a href="#"><i class="fa fa-share-square-o"></i></a>
                                            <a href="#"><i class="fa fa-edit"></i></a>
                                            <a href="#"><i class="fa fa-trash-o"></i></a>
                                        </div>
                                        <div class="profile-comments__avatar">
                                            <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="...">
                                        </div>
                                        <div class="profile-comments__body">
                                            <h5 class="profile-comments__sender">
                                                Richard Roe <small>1 day ago</small>
                                            </h5>
                                            <div class="profile-comments__content">
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore, esse, magni aliquam quisquam modi delectus veritatis est ut culpa minus repellendus.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-3">
                    <div class="card-body">
                        <p>
                            <a href="<?=url("admin/dash/users/user/".user()->id."")?>" class="profile__contact-btn btn btn-lg btn-block btn-info">
                                Editar Dados
                            </a>
                        </p>

                        <hr class="profile__contact-hr">

                        <div class="profile__contact-info">
                            <div class="profile__contact-info-item">
                                <div class="profile__contact-info-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="profile__contact-info-body">
                                    <h5 class="profile__contact-info-heading">Telefone</h5>
                                    <?=user()->phone?>
                                </div>
                            </div>
                            <div class="profile__contact-info-item">
                                <div class="profile__contact-info-icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="profile__contact-info-body">
                                    <h5 class="profile__contact-info-heading">Celular</h5>
                                    <?=user()->phone?>
                                </div>
                            </div>
                            <div class="profile__contact-info-item">
                                <div class="profile__contact-info-icon">
                                    <i class="fa fa-envelope-square"></i>
                                </div>
                                <div class="profile__contact-info-body">
                                    <h5 class="profile__contact-info-heading">E-mail</h5>
                                    <a href="mailto:<?=user()->email?>"><?=user()->email?></a>
                                </div>
                            </div>
                            <div class="profile__contact-info-item">
                                <div class="profile__contact-info-icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="profile__contact-info-body">
                                    <h5 class="profile__contact-info-heading">Endereço</h5>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="card">
            <div class="row">
                <div class="col-xs-12 col-sm-9">


                    <!-- User info -->


                    <!-- Community -->


                    <!-- Latest posts -->


                </div>
                <div class="col-xs-12 col-sm-3">

                    <!-- Contact user -->




                    <!-- Contact info -->


                </div>
            </div>
        </div>
    </div>



</div>
$(function () {

    var author = '<div style="position: fixed;bottom: 0;right: 20px;background-color: #fff;box-shadow: 0 4px 8px rgba(0,0,0,.05);border-radius: 3px 3px 0 0;font-size: 12px;padding: 5px 10px;">By <a href="https://github.com/davsonsantos">Davson Santos</a> &nbsp;&bull;&nbsp; <a href="https://www.davtech.com.br">DavTech</a></div>';
    $("body").append(author);
    /**data e hora */
    // dataHours();
    /**VALIDAÇÃO DE FORMULÁRIO */
    $("input[type='password'][data-eye]").each(function (i) {
        var $this = $(this),
            id = 'eye-password-' + i,
            el = $('#' + id);

        $this.wrap($("<div/>", {
            style: 'position:relative',
            id: id
        }));

        $this.css({
            paddingRight: 202
        });
        $this.after($("<div/>", {
            html: '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/></svg>',
            class: 'btn btn-primary btn-sm',
            id: 'passeye-toggle-' + i,
        }).css({
            position: 'absolute',
            right: 10,
            top: ($this.outerHeight() / 2) - 12,
            padding: '3px 7px',
            fontSize: 10,
            cursor: 'pointer',
        }));

        $this.after($("<input/>", {
            type: 'hidden',
            id: 'passeye-' + i
        }));

        var invalid_feedback = $this.parent().parent().find('.invalid-feedback');

        if (invalid_feedback.length) {
            $this.after(invalid_feedback.clone());
        }

        $this.on("keyup paste", function () {
            $("#passeye-" + i).val($(this).val());
        });
        $("#passeye-toggle-" + i).on("click", function () {
            if ($this.hasClass("show")) {
                $this.attr('type', 'password');
                $this.removeClass("show");
                $(this).removeClass("btn-outline-primary");
            } else {
                $this.attr('type', 'text');
                $this.val($("#passeye-" + i).val());
                $this.addClass("show");
                $(this).addClass("btn-outline-primary");
            }
        });
    });

    $("form:not('.ajax_off')").submit(function (e) {
        var form = $(this);
        if (form[0].checkValidity() === false) {
            e.preventDefault();
            e.stopPropagation();
            form.addClass('was-validated');
        } else {
            e.preventDefault();
            var load = $(".ajax_load");
            $(".ajax_response").fadeOut("fast");

            if (typeof tinyMCE !== 'undefined') {
                tinyMCE.triggerSave();
            }
            form.ajaxSubmit({
                url: form.attr("action"),
                type: "POST",
                dataType: "json",
                beforeSend: function () {
                    load.fadeIn(200).css("display", "flex");
                },
                uploadProgress: function (event, position, total, completed) {
                    var loaded = completed;
                    var load_title = $(".ajax_load_box_title");
                    load_title.text("Enviando (" + loaded + "%)");

                    if (completed >= 100) {
                        load_title.text("Aguarde, carregando...");
                    }
                },
                success: function (response) {
                    //redirect alias
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        form.find("input[type='file']").val(null);
                        load.fadeOut(200);
                    }
                    
                    if (response.reload) {
                        setTimeout(function () {
                            window.location.reload();
                        }, 3000);
                    } else {
                        load.fadeOut(200);
                    }

                    //message
                    if (response.message) {
                        ajaxMessage(response.message, response.type);
                    }

                    //alert
                    if (response.alert) {
                        alertSwit(response.alert[0], response.alert[1], response.alert[2]);
                    }

                    //image by fsphp mce upload
                    if (response.mce_image) {
                        $('.mce_upload').fadeOut(200);
                        tinyMCE.activeEditor.insertContent(response.mce_image);
                    }

                    if (response.reset) {
                        form.trigger("reset");
                    }

                },
                complete: function () {
                    if (form.data("reset") === true) {
                        form.trigger("reset");
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    load.fadeOut();
                    ajaxMessage("Encontramos um problema na plataforma o Suporte já foi informado. Volte mais tarde.", "danger")
                    // $.post(pathname + "/../../notification.php", { callback: 'Erro requisão Ajax', url: form.attr("action") }, function (data) {
                    //     $(".ajax_response").html(data.return).fadeIn("slow");
                    // }, 'json');
                }
            });
        }
    });

    //DATA SET
    $("[data-post]").click(function (e) {
        e.preventDefault();

        var clicked = $(this);
        var data = clicked.data();
        var load = $(".ajax_load");
        Swal.fire({
            title: data.confirm,
            text: "Você não poderá reverter isso!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: data.post,
                    type: "POST",
                    data: data,
                    dataType: "json",
                    beforeSend: function () {
                        load.fadeIn(200).css("display", "flex");
                    },
                    success: function (response) {
                        //redirect
                        if (response.redirect) {
                            Swal.fire({
                                timer: 2000,
                                title: 'Apagado!',
                                text: 'Registro excluido com sucesso.',
                                icon: 'success'
                            }).then(function () {
                                window.location.href = response.redirect;
                            });
                        } else {
                            load.fadeOut(200);
                        }

                        //reload
                        if (response.reload) {
                            Swal.fire({
                                timer: 2000,
                                title: 'Apagado!',
                                text: 'Registro excluido com sucesso.',
                                icon: 'success'
                            }).then(function () {
                                location.reload();
                            });
                        }
                        //message
                        if (response.message) {
                            ajaxMessage(response.message, response.type);
                        }

                        //alert
                        if (response.alert) {
                            alertSwit(response.alert[0], response.alert[1], response.alert[2]);
                        }

                    }, complete: function () {
                        if (form.data("reset") === true) {
                            form.trigger("reset");
                        }
                    },
                    error: function () {
                        ajaxMessage(ajaxResponseRequestError, 5);
                        load.fadeOut();
                    }
                });
            }

        });


    });


    // AJAX RESPONSE
    function ajaxMessage(message, type) {

        var view = '<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' +
            '' + message + '' +
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close">' +
            '    <span aria-hidden="true">&times;</span>' +
            '</button>' +
            '</div>';
        $(".ajax_response").html(view).fadeIn("slow");
    }
});

/**
 * @param mixed type
 * @param mixed title
 * @param string position
 * @param string redirect
 * 
 * @return [type]
 */
function alertSwit(type, title, position = "", redirect = "") {
    //positions: 'top', 'top-start', 'top-end', 'center', 'center-start', 'center-end', 'bottom', 'bottom-start', or 'bottom-end'
    //type: warning, error, success, info, question
    Swal.fire(
        {
            position: position,
            icon: type,
            title: title,
            showConfirmButton: true,
            // timer: 3000,
            toast: false,
            timerProgressBar: true
        }
    ).then(function () {
        window.location.href = redirect;
    });
}

// function dataHours() {
//     // Função para formatar 1 em 01
//     const zeroFill = n => {
//         return ('0' + n).slice(-2);
//     }

//     // Cria intervalo
//     const interval = setInterval(() => {
//         // Pega o horário atual
//         const now = new Date();

//         // Formata a data conforme dd/mm/aaaa hh:ii:ss
//         const dataHora = zeroFill(now.getUTCDate()) + '/' + zeroFill((now.getMonth() + 1)) + '/' + now.getFullYear() + ' ' + zeroFill(now.getHours()) + ':' + zeroFill(now.getMinutes()) + ':' + zeroFill(now.getSeconds());

//         // Exibe na tela usando a div#data-hora
//         document.getElementById('data-hora').innerHTML = dataHora;
//     }, 1000);
// }
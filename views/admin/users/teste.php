<?php $v->layout("admin/_dash"); ?>
<div class="content-wrapper">
    <div class="row">
        <div class="col-sm-6 mb-4 mb-xl-0">
            <h4 class="font-weight-bold text-dark">Teste!</h4>
            <p class="font-weight-normal mb-2 text-muted">Lista de Usuários</p>
        </div>
        <div class="col-sm-6 mb-4 mb-xl-0 float-right">
            <h4 class="font-weight-bold text-dark float-right">Usuários!</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card" id="list">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>level</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $v->start("scripts"); ?>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {

        $('#datatable').DataTable({
            "sPaginationType": "full_numbers",
            "responsive": true,
            "paging": true,
            "bFilter": true, // show search input
            "sFilter": "dataTables_filter text-right",
            "order": [
                [1, "desc"]
            ],
            "processing": true,
            "serverSide": true,
            "bInfo": false,
            "bSortable": true,
            "ajax": "<?= $router->route("users.search") ?>",
            "lengthMenu": [
                [10, 5, 25, 50, -1],
                [10, 5, 25, 50, "All"]
            ],
            "language": {
                // url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json',
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "",
                "searchPlaceholder": "Pesquisar usuário",
                "oPaginate": {
                    "sNext": "<i class='fas fa-angle-right'></i>",
                    "sPrevious": "<i class='fas fa-angle-left'></i>",
                    "sFirst": "<i class='fas fa-angle-double-left'></i>",
                    "sLast": "<i class='fas fa-angle-double-right'></i>"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                },
                "select": {
                    "rows": {
                        "0": "Nenhuma linha selecionada",
                        "1": "Selecionado 1 linha",
                        "_": "Selecionado %d linhas"
                    }
                },
                "buttons": {
                    "copy": "Copiar para a área de transferência",
                    "copyTitle": "Cópia bem sucedida",
                    "copySuccess": {
                        "1": "Uma linha copiada com sucesso",
                        "_": "%d linhas copiadas com sucesso"
                    }
                }
            }

        });

        $("#listingData_filter").addClass("hidden"); // hidden search input
        $("#searchInput").on("input", function(e) {
            e.preventDefault();
            $('#listingData').DataTable().search($(this).val()).draw();
        });

        // $('#example').DataTable({
        //     "responsive": true,
        //     paging: false,
        //     order: [
        //         [1, "asc"]
        //     ],
        //     "processing": true,
        //     "serverSide": true,
        //     "ajax": "<?= $router->route("users.search") ?>",
        //     language: {
        //         url: '//cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json',
        //     },
        //     columnDefs: [{
        //             "targets": [0],
        //             "orderable": false,
        //         },
        //         {
        //             className: "text-center",
        //             "targets": [0]
        //         }
        //     ]
        // });

    });
</script>

<?php $v->end(); ?>
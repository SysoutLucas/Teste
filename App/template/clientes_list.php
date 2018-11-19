<!DOCTYPE html>
<html lang="pt-br">
<?php require "includes/top.php"; ?>
<body>
    <div id="wrapper">
        <?php require "includes/nav.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Listagem de Clientes
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped  table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Data de Nascimento</th>
                                        <th>CPF</th>
                                        <th>E-mail</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                
                                    if(!empty($clientes)){
                                        foreach ($clientes as $cliente) {
                                            
                                            echo "
                                            <tr class=\" ",($cliente['status'] == 1) ? "success" : "danger","\">
                                                <td>",$cliente['id'],"</td>
                                                <td>",$cliente['nome'],"</td>
                                                <td>",date('d/m/Y',strtotime($cliente['data_nascimento'])),"</td>
                                                <td>",$cliente['documento'],"</td>
                                                <td>",$cliente['email'],"</td>
                                                <td>
                                                    <a class=\"btn btn-primary\" href=\"/clientes/view/",$cliente['id'],"\" role=\"button\">Visualizar</a>
                                                    <a class=\"btn btn-info\" href=\"/clientes/edit/",$cliente['id'],"\" role=\"button\">Editar</a>
                                                    <a class=\"btn btn-danger\" href=\"#\" role=\"button\" onClick=\"actionDelete('",$cliente['id'],"')\">Deletar</a>
                                                </td>
                                            </tr>";
                                        }
                                    }
                                ?>
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Deseja Realmente Escluir este Cliente?
                                <form>
                                    <input type="hidden" id="id_cliente" name="id">
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="button" class="btn btn-danger btn_delete">Excluir</button>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
    </div>
    <?php require "includes/bottom.php";?>
    <script src=<?="http://".$_SERVER['HTTP_HOST']."/App/template/dist/js/jquery.dataTables.min.js"?>></script>
    <script src=<?="http://".$_SERVER['HTTP_HOST']."/App/template/dist/js/dataTables.bootstrap.min.js"?>></script>
    <script src=<?="http://".$_SERVER['HTTP_HOST']."/App/template/dist/js/dataTables.responsive.js"?>></script>
    <script>
        $(document).ready(function(){
            $('#dataTables-example').DataTable({
                responsive: true
            });

            $('.btn_delete').click(function(event){
                event.preventDefault();
                $.ajax({
                    url: "/clientes/delete/"+$("#id_cliente").val(),
                    type: "DELETE",
                    dataType:'json',
                    success: function (retorno){
                        if(retorno.sucesso == 1) {
                            window.location.href = "/clientes/list";
                        } else {
                            console.log(retorno.error_message);
                        }
                    }
                })
            });
        });
        function actionDelete(id){
            $("#myModal").modal('show');
            $("#id_cliente").val(id);
        }
    </script>
</body>
</html>

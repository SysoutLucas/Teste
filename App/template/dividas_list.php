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
                            Listagem de Dividas
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped  table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Descricao</th>
                                        <th>Vencimento</th>
                                        <th>Valor</th>
                                        <th>Cliente</th>
                                        <th>Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                
                                    if(!empty($dividas)){
                                        foreach ($dividas as $divida) {
                                            
                                            echo "
                                            <tr class=\" ",($divida['status'] == 4) ? "success" : "danger","\">
                                                <td>",$divida['id'],"</td>
                                                <td>",$divida['descricao'],"</td>
                                                <td>",date('d/m/Y',strtotime($divida['vencimento'])),"</td>
                                                <td>",$divida['valor'],"</td>
                                                <td>",$divida['nome'],"</td>
                                                <td>
                                                    <a class=\"btn btn-primary\" href=\"/dividas/view/",$divida['id'],"\" role=\"button\">Visualizar</a>
                                                    <a class=\"btn btn-info\" href=\"/dividas/edit/",$divida['id'],"\" role=\"button\">Editar</a>
                                                    <a class=\"btn btn-danger\" href=\"#\" role=\"button\" onClick=\"actionDelete('",$divida['id'],"')\">Deletar</a>
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
                                Deseja Realmente Escluir esta Dívida?
                                <form>
                                    <input type="hidden" id="id_divida" name="id">
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
                    url: "/dividas/delete/"+$("#id_divida").val(),
                    type: "DELETE",
                    dataType:'json',
                    success: function (retorno){
                        if(retorno.sucesso == 1) {
                            window.location.href = "/dividas/list";
                        } else {
                            console.log(retorno.error_message);
                        }
                    }
                })
            });
        });
        function actionDelete(id){
            $("#myModal").modal('show');
            $("#id_divida").val(id);
        }
    </script>
</body>
</html>

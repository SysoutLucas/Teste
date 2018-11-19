<!DOCTYPE html>
<html lang="pt-br">
<?php require "includes/top.php"; ?>
<body>
 <div id="wrapper">
    <?php require "includes/nav.php"; ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                   
                </h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Dados sobre a Dívida
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                        <tr>
                                            <th>ID</th><td><?=$divida['id'];?></td>
                                        </tr>
                                        <tr>
                                            <th> Cliente </th><td><?=$divida['nome'];?> </td>
                                        </tr>
                                        <tr>
                                            <th> Descrição </th><td><?= $divida["descricao"];?></td>
                                        </tr>
                                        <tr>
                                            <th> Valor </th><td> <?=$divida['valor'];?></td>
                                        </tr>
                                        <tr>
                                            <th> Vencimento </th><td> <?= date("d/m/Y",strtotime($divida['vencimento']));?></td>
                                        </tr>
                                        <tr>
                                            <th> Status </th><td> <?=$divida['titulo'];?></td>
                                        </tr>
                                        <tr>
                                            <th> Criada em </th><td> <?=$divida['criado_em'];?></td>
                                        </tr>
                                        <tr>
                                            <th> Ultima atualização </th><td> <?=$divida['atualizado_em'];?></td>
                                        </tr>
                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
 </div>

<?php require "includes/bottom.php";?>
</body>
</html>

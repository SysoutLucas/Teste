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
                        Dados do Cliente
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                        <tr>
                                            <th>ID</th><td><?=$cliente['id'];?></td>
                                        </tr>
                                        <tr>
                                            <th> Nome </th><td><?=$cliente['nome'];?> </td>
                                        </tr>
                                        <tr>
                                            <th> Data de Nascimento </th><td><?= date("d/m/Y",strtotime($cliente['data_nascimento']));?></td>
                                        </tr>
                                        <tr>
                                            <th> Sexo </th><td> <?=$cliente['sexo'];?></td>
                                        </tr>
                                        <tr>
                                            <th> CPF </th><td> <?=$cliente['documento'];?></td>
                                        </tr>
                                        <tr>
                                            <th> E-mail </th><td> <?=$cliente['email'];?></td>
                                        </tr>
                                        <tr>
                                            <th> CEP </th><td> <?=$cliente['cep'];?></td>
                                        </tr>
                                        <tr>
                                            <th> Logradouro </th><td> <?=$cliente['logradouro'];?></td>
                                        </tr>
                                        <tr>
                                            <th> Numero </th><td> <?=$cliente['numero'];?></td>
                                        </tr>
                                        <tr>
                                            <th> Complemento </th><td> <?=$cliente['complemento'];?></td>
                                        </tr>
                                        <tr>
                                            <th> Bairro </th><td> <?=$cliente['bairro'];?></td>
                                        </tr>
                                        <tr>
                                            <th> UF </th><td> <?=$cliente['estado'];?></td>
                                        </tr>
                                        <tr>
                                            <th> Cidade </th><td> <?=$cliente['cidade'];?></td>
                                        </tr>
                                        <tr>
                                            <th> Status </th><td> <?=$cliente['titulo'];?></td>
                                        </tr>
                                        <tr>
                                            <th> Cadastrado em </th><td> <?=$cliente['criado_em'];?></td>
                                        </tr>
                                        <tr>
                                            <th> Ultima alteração </th><td> <?=$cliente['atualizado_em'];?></td>
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

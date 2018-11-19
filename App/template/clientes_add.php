<!DOCTYPE html>
<html lang="pt-br">
<?php require "includes/top.php"; ?>
<body>
 <div id="wrapper">
    <?php require "includes/nav.php"; ?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header"></h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger error-form" role="alert" style="display:none;">
                    
                </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    Formulário de <?php if(isset($cliente['id'])){echo "edição";} else {echo "cadastro";}?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="form_cliente" action="/clientes/add">
                                <div class="form-row">
                                    <div class="form-group col-md-6 ">
                                        <label for="Nome">Nome</label>
                                        <input type="text" class="form-control" id="nome" placeholder="Ex: Lucas Pereira" name="nome" value="<?= $cliente['nome'] ?? "" ;?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="email">E-mail</label>
                                        <input type="email" class="form-control" id="email" placeholder="Ex: sysoutlucas@gmail.com" name="email" value="<?= $cliente['email'] ?? "" ;?>">
                                    </div>
                                </div>
                                <?php 
                                    $data = $cliente['data_nascimento'] ?? "";
                                    if(!empty($data)){
                                        $data = date('d-m-Y',strtotime($data));
                                    }
                                ?>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                    <label for="data_nascimento">Data de nascimento</label>
                                    <input type="text" class="form-control" id="data_nascimento" name="data_nascimento" value="<?= $data ?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label for="documento">CPF</label>
                                    <input type="text" class="form-control" id="documento" name="documento" value="<?= $cliente['documento'] ?? "" ;?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label for="sexo">Sexo</label>
                                    <select class="form-control" id="sexo" name="sexo">
                                        <option value="masculino" selected>Masculino</option>
                                        <option value="feminino" >Feminino</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                    <label for="cep">Cep</label>
                                    <input type="text" class="form-control" id="cep" placeholder="Ex: 08411230" name="cep" value="<?= $cliente['cep'] ?? "" ;?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                    <label for="logradouro">Rua</label>
                                    <input type="text" class="form-control" id="logradouro" placeholder="Ex: Gil de Siqueira" name="logradouro" value="<?= $cliente['logradouro'] ?? "" ;?>">
                                    </div>
                                    <div class="form-group col-md-2">
                                    <label for="numero">Numero</label>
                                    <input type="text" class="form-control" id="numero" placeholder="Ex: 51" name="numero" value="<?= $cliente['numero'] ?? "" ;?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                    <label for="complemento">Complemento</label>
                                    <input type="text" class="form-control" id="cep" placeholder="Ex: Casa 2" name="complemento" value="<?= $cliente['complemento'] ?? "" ;?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label for="pais">Bairro</label>
                                    <input type="text" class="form-control" id="bairro" placeholder="Ex: Vila Aurea" name="bairro" value="<?= $cliente['bairro'] ?? "" ;?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label for="cidade">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" placeholder="Ex: São Paulo" name="cidade" value="<?= $cliente['cidade'] ?? "" ;?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="estado">UF</label>
                                    <input type="text" class="form-control" id="estado" placeholder="Ex: SP" name="estado" value="<?= $cliente['estado'] ?? "" ;?>">
                                    </div>
                                    <?php if( isset($cliente['id']) ){ ?>
                                        <div class="form-group col-md-4">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="1" <?php if( $cliente['status'] == 1 ) echo "selected";?>>Ativo</option>
                                            <option value="2" <?php if( $cliente['status'] == 2 ) echo "selected";?>>Inativo</option>
                                        </select>
                                        </div>
                                    <?php }?>
                                    
                                    <div class="form-group col-md-12">
                                    <input type="hidden" name="id" value="<?= $cliente["id"] ?? "" ;?>">
                                    <button type="submit" class="btn btn-primary submit_cliente"><?php if(isset($cliente['id'])){echo "Editar";} else {echo "Cadastrar";}?></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div>

<?php require "includes/bottom.php";?>
<script>
    $(".submit_cliente").click(function(event){
        event.preventDefault();
        form = $("#form_cliente");
        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: form.serialize(),
            dataType:'json',
            success: function (retorno){
                if(retorno.sucesso == 1) {
                    window.location.href = "/clientes/list";
                } else if(retorno.sucesso == 0){
                    var html = "<b>Por favor, verifique se preencheu os dados corretamente</b><br>";
                    retorno.errors.forEach(function(element){
                        html += "<p>"+element.error+"</p>"
                    });
                    $(".error-form").html(html).show();
                } else {
                    console.log(retorno.error_message);
                }
            }
        })
    });
    $(document).ready(function(){
        
        $('#data_nascimento').mask("00/00/0000", {placeholder: "__/__/____"});
        $('#documento').mask("000.000.000-00", {placeholder: "___.___.___-__"});
        $('#cep').mask("00000-000", {placeholder: "_____-___"});

        $("#cep").keyup(function(){
            var cep = $(this).val().replace(/\D/g, '');
            var validacep = /^[0-9]{8}$/;
            if(validacep.test(cep)){
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#logradouro").val(dados.logradouro);
                        $("#estado").val(dados.uf);
                        $("#cidade").val(dados.localidade);
                        $("#bairro").val(dados.bairro);
                        $("#numero").focus();
                    } else {
                        $("#logradouro").val("");
                        $("#estado").val("");
                        $("#cidade").val("");
                        $("#bairro").val("");
                    }
                });
            }
        });
    });
</script>
</body>
</html>

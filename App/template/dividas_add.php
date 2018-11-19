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
                    Formulário de <?php if(isset($divida['id'])){echo "edição";} else {echo "cadastro";}?>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form id="form_divida" action="/dividas/add">
                                <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="sexo">Cliente</label>
                                    <select class="form-control" id="cliente_id" name="cliente_id">
                                        <?php 
                                        $clienteId = $divida['cliente_id'] ?? "";
                                            foreach ($clientes as $cliente) {
                                                
                                                echo "<option value=\"",$cliente["id"],"\" ",($cliente['id'] == $clienteId) ? "selected" : "" ," >",$cliente["id"]," - ",$cliente["nome"],"</option>";
                                            }
                                        ?>
                                    </select>
                                    </div>
                                    <div class="form-group col-md-6 ">
                                        <label for="descricao">Descrição</label>
                                        <input type="text" class="form-control" id="descricao" placeholder="Ex: Reforma da cozinha" name="descricao" value="<?= $divida['descricao'] ?? "" ;?>">
                                    </div>
                                    
                                </div>
                                <?php 
                                    $data = $divida['vencimento'] ?? "";
                                    if(!empty($data)){
                                        $data = date('d-m-Y',strtotime($data));
                                    }

                                    $valor = $divida['valor'] ?? "";
                                    if(!empty($valor)){
                                        $valor = number_format($divida['valor'], 2, ',', '.');
                                    }
                                ?>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="valor">Valor</label>
                                        <input type="text" class="form-control" id="valor" placeholder="Ex: 100" name="valor" value="<?= $valor;?>">
                                    </div>
                                    <div class="form-group col-md-4">
                                    <label for="vencimento">Vencimento</label>
                                    <input type="text" class="form-control" id="vencimento" name="vencimento" value="<?= $data ?>">
                                    </div>
                                    <?php if( isset($divida['id']) ){ ?>
                                        <div class="form-group col-md-4">
                                        <label for="status">Status</label>
                                        <select class="form-control" id="status" name="status">
                                            <option value="4" <?php if( $divida['status'] == 4 ) echo "selected";?>>Ativa</option>
                                            <option value="6" <?php if( $divida['status'] == 6 ) echo "selected";?>>Inativa</option>
                                        </select>
                                        </div>
                                    <?php }?>
                                </div>
                                
                                <div class="form-row ">
                                    <div class="form-group col-md-6">
                                    <input type="hidden" name="id" value="<?= $divida["id"] ?? "" ;?>">
                                    <button type="submit" class="btn btn-primary submit_divida"><?php if(isset($divida['id'])){echo "Editar";} else {echo "Cadastrar";}?></button>
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
    $(".submit_divida").click(function(event){
        event.preventDefault();
        form = $("#form_divida");
        $.ajax({
            url: form.attr("action"),
            type: "POST",
            data: form.serialize(),
            dataType:'json',
            success: function (retorno){
                if(retorno.sucesso == 1) {
                    window.location.href = "/dividas/list";
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
        $("#cliente_id").select2({
            theme: "bootstrap"
        });
        $('#vencimento').mask("00/00/0000", {placeholder: "__/__/____"});
        $('#valor').mask('#.##0,00', {reverse: true});
    });
</script>
</body>
</html>

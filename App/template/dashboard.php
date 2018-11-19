<!DOCTYPE html>
<html lang="pt-br">
<?php require "includes/top.php"; ?>
<body>
 <div id="wrapper">
    <?php require "includes/nav.php"; ?>
    <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $total_clientes ;?></div>
                                    <div>Clientes</div>
                                </div>
                            </div>
                        </div>
                        <a href="/clientes/list">
                            <div class="panel-footer">
                                <span class="pull-left">Mais Detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-6 col-md-12">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-exclamation fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge"><?= $total_dividas ;?></div>
                                    <div>Dividas</div>
                                </div>
                            </div>
                        </div>
                        <a href="/dividas/list">
                            <div class="panel-footer">
                                <span class="pull-left">Mais detalhes</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
 </div>

<?php require "includes/bottom.php";?>
</body>
</html>

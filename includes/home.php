<div class="container-fluid">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading"><p align="center"><b>SEJA BEM-VINDO À <?php echo strtoupper($_SESSION['nome_sistema'])?>!</b></p></div>
            <div id="filtros" class="row" align="center">
                <!--GERENCIAMENTO INICIO-->
                <div id="painel_gerenciamento" class="col-md-4">
                    <h3 style="color: #337ab7;">Gerenciamento <i class="fa fa-gears"></i></h3>
                    <br>
                    <a id="usuario_menu" href="../views/menu.php?pag=usuarios" class="btn-lg btn-primary" title="Usuários">
                        <span class="fa fa-users"></span>
<!--                        Usuários-->
                    </a>&nbsp;
                    <a id="reagional_menu" href="../views/menu.php?pag=regionais" class="btn-lg btn-primary" title="Regionais">
                        <span class="glyphicon glyphicon-globe"></span>
<!--                        Regionais-->
                    </a>&nbsp;
                    <a id="cambista_menu" href="../views/menu.php?pag=cambistas" class="btn-lg btn-primary" title="Cambistas">
                        <span class="glyphicon glyphicon-phone"></span>
<!--                        Cambistas-->
                    </a>
                </div>
                <!--GERENCIAMENTO FIM-->
            </div>
                <br>
        </div>
    </div>
</div>
<br>
<!--QUADRO DE AVISOS-->
<div class="container-fluid">
    <div class="col-lg-12">
        <div class="panel panel-primary">
            <div class="panel-heading"><p align="center"><b>QUADRO DE AVISOS</b></p></div>
            <div class="panel-body" style=" padding-left: 40px;  padding-right: 40px;">
                <h4 style="color: #337ab7;">
                    <p align="justify">
                        <i class="fa fa-asterisk"></i>
                        Aqui vai um aviso qualquer do sistema para o usuário. Útil para informar sobre
                        novas funcionalidades e situação atual do sistema.
                    </p>
                </h4><br>
                <h4 style="color: #337ab7;">
                    <p align="justify">
                        <i class="fa fa-android"></i>
                        <a href="#">Clique aqui para baixar o instalador do aplicativo android.</a>
                    </p>
                </h4><br>
                <h4 style="color: #337ab7;">
                    <p align="justify">
                        <i class="fa fa-android"></i>
                        <a href="#">Tutorial de como instalar o aplicativo android.</a>
                    </p>
                </h4><br>
            </div>
        </div>
    </div>
</div>
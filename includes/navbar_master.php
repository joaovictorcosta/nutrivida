<nav id="barra_navegacao"class="navbar navbar-inverse navbar navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../views/menu.php?pag=home" title="Início">
                <i class="fa fa-soccer-ball-o"></i>
                <font style="color: #337ab7"><b><?php echo $_SESSION['nome_sistema'] ?></b></font>
            </a>
<!--            <a class="navbar-brand" href="../views/menu.php?pag=home">
                <img style="max-width: 100px;" src="../assets/imagens/logo_cental_apostas.png">
            </a>-->
        </div>
        <div id="navbar" class="navbar-collapse collapse">

            <ul class="nav navbar-nav">
                
                <!--Gerenciamento Dropdown-->
                <li id="gerenciamento-dropdown"class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Gerenciamento"><small>GERENCIAMENTO <span class="fa fa-gears"></span></small><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../views/menu.php?pag=usuarios"><small><i class="fa fa-users"></i> USUÁRIOS</small></a></li>
                        <li><a href="../views/menu.php?pag=regionais"><small><i class="fa fa-globe"></i> REGIONAIS</small></a></li>
                        <li><a href="../views/menu.php?pag=cambistas"><small><i class="glyphicon glyphicon-phone"></i> CAMBISTAS</small></a></li>
                    </ul>
                </li>
                
                <!--Jogos Dropdown-->
                <li id="jogos-dropdown"class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Jogos"><small>JOGOS <span class="fa fa-trophy"></span></small><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../views/menu.php?pag=jogos"><small><i class="fa fa-soccer-ball-o"></i> LISTA</small></a></li>
                        <li><a href="../views/menu.php?pag=cancelados"><small><i class="glyphicon glyphicon-ban-circle"></i> CANCELADOS</small></a></li>
                        <li><a href="../views/menu.php?pag=inativos"><small><i class="glyphicon glyphicon-unchecked"></i> INATIVOS</small></a></li>
                        <li><a href="../views/menu.php?pag=finalizados"><small><i class="glyphicon glyphicon-check"></i> FINALIZADOS</small></a></li>
                    </ul>
                </li>
                
                <!--Apostas Dropdown-->
                <li id="gerenciamento-dropdown"class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Apostas"><small>APOSTAS <span class="fa fa-ticket"></span></small><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="../views/menu.php?pag=apostas"><small><i class="fa fa-list"></i> LISTA</small></a></li>
                        <li><a href="../views/menu.php?pag=regionais"><small><i class="fa fa-bar-chart"></i> RESUMO</small></a></li>
                    </ul>
                </li>
            </ul>                    
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" title="Sair"><?php usuario_logado(); ?><span style="color: red;" class="fa fa-power-off"></span></a>
                    <ul class="dropdown-menu">
                        <li><a style="color: red;"href="../config/encerra_acesso.php"><span class="glyphicon glyphicon-log-out"></span> <small>SAIR</small></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>


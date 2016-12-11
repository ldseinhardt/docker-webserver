<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */
?>
 <div class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Agenda</a>
        </div>
        <div class="navbar-collapse collapse navbar-responsive-collapse">
            <ul class="nav navbar-nav">
                <li><a href="/contact"><i class="material-icons">&#xE0BA;</i> Contatos</a></li>
                <li><a href="/organization"><i class="material-icons">&#xE84F;</i> Organizações</a></li>
            </ul>
            <form class="navbar-form navbar-left" action="/search">
                <div class="form-group">
                    <input type="search" name="q" class="form-control" placeholder="Pesquisar">
                </div>
            </form>
        </div>
    </div>
</div>

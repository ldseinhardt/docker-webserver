<!--
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */
 -->
<!DOCTYPE html>
<html lang="pt-br" dir="ltr" class="no-js">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script>(function(d) { d.className = d.className.replace(/\bno-js/, 'js'); })(document.documentElement);</script>
        <title>Agenda</title>
        <link rel="icon" type="image/png" href="/assets/images/favicon.png">
        <meta name="description" content="Cadastre seus contatos...">
        <meta name="keywords" content="agenda, contatos, organizações, empresas">
        <meta name="robots" content="index, follow">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link rel="stylesheet" href="/vendor/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="/vendor/bootstrap-material-design/dist/css/bootstrap-material-design.min.css">
        <link rel="stylesheet" href="/vendor/bootstrap-material-design/dist/css/ripples.min.css">
        <link rel="stylesheet" href="/vendor/material-design-icons/iconfont/material-icons.css">
        <link rel="stylesheet" href="/assets/css/main.css">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- Mobile -->
        <meta name="theme-color" content="#009688">
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <!-- Facebook -->
       <meta property="og:type" content="website">
       <meta property="og:locale" content="pt_BR">
       <meta property="og:url" content="<?= $this->base?>">
       <meta property="og:title" content="Agenda">
       <meta property="og:site_name" content="Agenda">
       <meta property="og:description" content="Cadastre seus contatos...">
       <meta property="og:image" content="<?= $this->base?>assets/images/screen.png">
       <meta property="og:image:type" content="image/png">
       <meta property="og:image:width" content="1024">
       <meta property="og:image:height" content="768">
       <!-- Twitter -->
       <meta name="twitter:card" content="summary">
       <meta name="twitter:image" content="<?= $this->base?>assets/images/screen.png">
       <meta name="twitter:site" content="@ldseinhardt">
       <meta name="twitter:creator" content="@ldseinhardt">
       <meta name="twitter:url" content="<?= $this->base?>">
       <meta name="twitter:title" content="Agenda">
       <meta name="twitter:description" content="Cadastre seus contatos...">
       <!-- Google+ / Schema.org -->
       <link href="https://plus.google.com/u/0/105603009531136678236" rel="publisher">
       <meta itemprop="name" content="Agenda">
       <meta itemprop="description" content="Cadastre seus contatos...">
       <meta itemprop="image" content="<?= $this->base?>assets/images/screen.png">
    </head>
    <body id="home">
        <?php
            $this->load('Layout/navbar');

            if ($this->content) {
                echo "
                    <div class=\"container\">
                        {$this->content}

                        <a href=\"javascript:void(0)\" title=\"Adicionar Contato ou Organização\" class=\"btn btn-primary btn-raised btn-fab btn-float btn-add\">
                            <i class=\"material-icons\">&#xE145;</i>
                        </a>
                    </div>
                ";
            }
        ?>

        <div class="alert">
          Habilite o javascript em seu navegador.
        </div>

        <script src="/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="/vendor/bootstrap-material-design/dist/js/material.min.js"></script>
        <script src="/vendor/bootstrap-material-design/dist/js/ripples.min.js"></script>
        <script src="/vendor/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
        <script src="/assets/js/main.js"></script>
    </body>
</html>

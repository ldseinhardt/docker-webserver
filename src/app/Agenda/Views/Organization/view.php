<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

$this->content = "
    <h1>{$this->organization->name}</h1>

    <div class=\"row\">
        <div style=\"padding: 0 15px\">
            <div class=\"panel panel-default\">
                <div class=\"panel-body\">
                    <strong>Telefone:</strong> {$this->organization->phone}<br>
                    <a href=\"/organization/{$this->organization->id}/edit\" class=\"btn btn-raised btn-primary\">
                        <i class=\"material-icons\">&#xE254;</i> Editar
                    </a>
                    <a href=\"/organization/{$this->organization->id}/delete\" onclick=\"return confirm('Certeza que quer remover esta organização?')\" class=\"btn btn-raised btn-danger\">
                        <i class=\"material-icons\">&#xE872;</i> Apagar
                    </a>
                </div>
           </div>
        </div>
    </div>
";

if ($this->error === '1') {
    $this->content .= "
        <script>
            setTimeout(function() {
                alert('Esta organização não pode ser removida pois existem contatos que pertencem a mesma!');
            }, 100);
        </script>
    ";
}

$this->load('Layout/base');

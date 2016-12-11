<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

$this->content = "
    <h1>Empresas e Organizações</h1>

    <div class=\"row\">
        <div style=\"padding: 0 15px\">
            <div class=\"panel panel-default\">
                <div class=\"panel-body\">
                    <div class=\"list-group\">
";

if (!count($this->organizations)) {
    $this->content .= "Não há organizações cadastradas.";
}

foreach ($this->organizations as $organization) {
    $this->content .= "
        <div class=\"list-group-item\">
            <div class=\"row-action-primary\">
                <i class=\"material-icons\">&#xE84F;</i>
            </div>
            <div class=\"row-content\">
                <div class=\"action-secondary\">
                    <a href=\"/organization/{$organization->id}/edit\">
                        <i class=\"material-icons\" style=\"color: #009688\">&#xE254;</i>
                    </a>
                    <a href=\"/organization/{$organization->id}/delete\" onclick=\"return confirm('Certeza que quer remover esta organização?')\">
                        <i class=\"material-icons\" style=\"color: #fe6363\">&#xE872;</i>
                    </a>
                </div>
                <h4 class=\"list-group-item-heading\" style=\"text-overflow: clip; overflow: hidden; white-space: nowrap\">
                    <a href=\"/organization/{$organization->id}\" title=\"{$organization->name}\">
                        {$organization->name}
                    </a>
                </h4>
                <p class=\"list-group-item-text\">{$organization->phone}</p>
            </div>
        </div>
        <div class=\"list-group-separator\"></div>
    ";
}

$this->content .= "
                    </div>
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

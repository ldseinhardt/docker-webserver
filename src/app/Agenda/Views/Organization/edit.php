<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

$this->content = "
    <h1>Editar organização</h1>

    <div class=\"row\">
        <div style=\"padding: 0 15px\">
            <div class=\"panel panel-default\">
                <div class=\"panel-body\">
                    <form action=\"/organization/{$this->organization->id}/edit\" method=\"POST\" class=\"form-horizontal\">
                        <fieldset>
                            <legend>Cadastro</legend>

                            <div class=\"form-group\">
                                <label for=\"name\" class=\"col-md-2 control-label\">Nome</label>
                                <div class=\"col-md-10\">
                                    <input type=\"text\" class=\"form-control\" id=\"name\" name=\"name\" value=\"{$this->organization->name}\" placeholder=\"Nome\" minlength=\"2\" maxlength=\"128\" required>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"phone\" class=\"col-md-2 control-label\">Telefone</label>
                                <div class=\"col-md-10\">
                                    <input type=\"tel\" class=\"form-control\" id=\"phone\" name=\"phone\" value=\"{$this->organization->phone}\" placeholder=\"Telefone\" minlength=\"8\" maxlength=\"16\" required>
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"col-md-10 col-md-offset-2\">
                                    <button type=\"submit\" class=\"btn btn-primary\">
                                        <i class=\"material-icons\" style=\"color: #009688\">&#xE161;</i> Salvar
                                    </button>
                                    <a href=\"/organization\" class=\"btn btn-default\">
                                        Cancelar
                                    </a>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
           </div>
        </div>
    </div>
";

$this->load('Layout/base');

<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

$this->content = "
    <h1>Adicionar contato</h1>

    <div class=\"row\">
        <div style=\"padding: 0 15px\">
            <div class=\"panel panel-default\">
                <div class=\"panel-body\">

                    <form action=\"/contact/add\" method=\"POST\" class=\"form-horizontal\">
                        <fieldset>
                            <legend>Cadastro</legend>

                            <div class=\"row\">
                                <div class=\"col-md-6\">
                                    <div class=\"form-group\">
                                        <label for=\"first_name\" class=\"col-md-2 control-label\">Nome</label>
                                        <div class=\"col-md-10\">
                                            <input type=\"text\" class=\"form-control\" id=\"first_name\" name=\"first_name\" placeholder=\"Nome\" maxlength=\"16\">
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-md-6\">
                                    <div class=\"form-group\">
                                        <label for=\"last_name\" class=\"col-md-2 control-label\">Sobrenome</label>
                                        <div class=\"col-md-10\">
                                            <input type=\"text\" class=\"form-control\" id=\"last_name\" name=\"last_name\" placeholder=\"Sobrenome\" maxlength=\"32\">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"col-md-6\">
                                    <div class=\"form-group\">
                                        <label for=\"address\" class=\"col-md-2 control-label\">Endereço</label>
                                        <div class=\"col-md-10\">
                                            <input type=\"text\" class=\"form-control\" id=\"address\" name=\"address\" placeholder=\"Endereço\" maxlength=\"256\">
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-md-6\">
                                    <div class=\"form-group\">
                                        <label for=\"zip_code\" class=\"col-md-2 control-label\">CEP</label>
                                        <div class=\"col-md-10\">
                                            <input type=\"text\" class=\"form-control\" id=\"zip_code\" name=\"zip_code\" placeholder=\"CEP\" maxlength=\"16\">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=\"row\">
                                <div class=\"col-md-6\">
                                    <div class=\"form-group\">
                                        <label for=\"district\" class=\"col-md-2 control-label\">Bairro</label>
                                        <div class=\"col-md-10\">
                                            <input type=\"text\" class=\"form-control\" id=\"district\" name=\"district\" placeholder=\"Bairro\" maxlength=\"64\">
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-md-6\">
                                    <div class=\"form-group\">
                                        <label for=\"city\" class=\"col-md-2 control-label\">Cidade</label>
                                        <div class=\"col-md-10\">
                                            <input type=\"text\" class=\"form-control\" id=\"city\" name=\"city\" placeholder=\"Cidade\" maxlength=\"64\">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class=\"row\" id=\"box_phone_1\">
                                <div class=\"col-xs-12 col-md-4\">
                                    <div class=\"form-group\">
                                        <label for=\"phone_1\" class=\"col-md-3 control-label\">Telefone</label>
                                        <div class=\"col-md-9\">
                                            <input type=\"tel\" class=\"form-control\" id=\"phone_1\" name=\"phone[]\" placeholder=\"Telefone\" maxlength=\"16\">
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-xs-12 col-md-3\">
                                    <div class=\"form-group\">
                                        <label for=\"phone_type_1\" class=\"col-md-2 control-label\">Tipo</label>
                                        <div class=\"col-md-10\">
                                            <select id=\"phone_type_1\" name=\"phone_type_id[]\" class=\"form-control\">
                                                <option value=\"1\">Residencial</option>
                                                <option value=\"2\">Celular</option>
                                                <option value=\"3\">Trabalho</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-xs-7 col-xs-offset-1 col-md-3 col-md-offset-0\">
                                    <div class=\"form-group\">
                                        <div class=\"radio radio-primary\">
                                            <label>
                                                <input type=\"radio\" name=\"primary_phone_id\" value=\"1\" checked> Principal
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-xs-4 col-md-2\">
                                    <div class=\"form-group\">
                                        <a href=\"javascript:void(0)\" class=\"btn btn-primary btn-del-phone\" data-target=\"#box_phone_1\">
                                            <i class=\"material-icons\" style=\"color: #fe6363\">&#xE15D;</i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class=\"form-group text-center after_phones\">
                                <a href=\"javascript:void(0)\" class=\"btn btn-primary btn-add-phone\">
                                    <i class=\"material-icons\" style=\"color: #009688\">&#xE148;</i> Adicionar campo de telefone
                                </a>
                            </div>

                            <div class=\"row\" id=\"box_email_1\">
                                <div class=\"col-xs-12 col-md-6\">
                                    <div class=\"form-group\">
                                        <label for=\"email_1\" class=\"col-md-2 control-label\">Email</label>
                                        <div class=\"col-md-10\">
                                            <input type=\"email\" class=\"form-control\" id=\"email_1\" name=\"email[]\" placeholder=\"Email\" maxlength=\"256\">
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-xs-7 col-xs-offset-1 col-md-4 col-md-offset-0\">
                                    <div class=\"form-group\">
                                        <div class=\"radio radio-primary\">
                                            <label>
                                                <input type=\"radio\" name=\"primary_email_id\" value=\"1\" checked> Principal
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class=\"col-xs-4 col-md-2\">
                                    <div class=\"form-group\">
                                        <a href=\"javascript:void(0)\" class=\"btn btn-primary btn-del-email\" data-target=\"#box_email_1\">
                                            <i class=\"material-icons\" style=\"color: #fe6363\">&#xE15D;</i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class=\"form-group text-center after_emails\">
                                <a href=\"javascript:void(0)\" class=\"btn btn-primary btn-add-email\">
                                    <i class=\"material-icons\" style=\"color: #009688\">&#xE148;</i> Adicionar campo de email
                                </a>
                            </div>

                            <div class=\"form-group\">
                                <label for=\"organization_search\" class=\"col-md-1 control-label\">Organização</label>
                                <div class=\"col-md-11\">
                                    <input type=\"search\" class=\"form-control\" id=\"organization_search\" name=\"organization_search\" placeholder=\"Informe o nome ou telefone da organização\">
                                    <input type=\"hidden\" name=\"organization_id\" id=\"organization_id\">
                                </div>
                            </div>

                            <div class=\"form-group\">
                                <div class=\"col-md-11 col-md-offset-1\">
                                    <button type=\"submit\" class=\"btn btn-primary\">
                                        <i class=\"material-icons\" style=\"color: #009688\">&#xE161;</i> Salvar
                                    </button>
                                    <a href=\"/contact\" class=\"btn btn-default\">
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

if ($this->error === '1') {
    $this->content .= "
        <script>
            setTimeout(function() {
                alert('Houve algum erro ao salvar o contato!');
            }, 100);
        </script>
    ";
}

$this->load('Layout/base');

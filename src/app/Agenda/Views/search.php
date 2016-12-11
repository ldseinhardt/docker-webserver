<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

$this->content = "
    <h1>Resultados para: '{$this->search}'</h1>

    <div class=\"row\">
        <div style=\"padding: 0 15px\">
            <div class=\"panel panel-default\">
                <div class=\"panel-body\">

    ";

    if (!(count($this->contacts) || count($this->organizations))) {
        $this->content .= "<strong>Ops! Não há resultados... : (</strong>";
    }

    if (count($this->contacts)) {
        $this->content .= "<h2>Contatos:</h2><div class=\"list-group\">";

        foreach ($this->contacts as $contact) {
            $title = trim($contact->name);
            if (!$title) {
                $title = $contact->phone;
            }
            if (!$title) {
                $title = $contact->email;
            }
            if (!$title) {
                $title = $contact->organization;
            }
            if (!$title) {
                $title = 'Sem nome';
            }

            $info = '';
            if ($contact->phone) {
                $info = "{$contact->phone} ({$contact->phone_label})";
            } else if ($contact->email) {
                $info = $contact->email;
            } else if ($contact->organization) {
                $info = $contact->organization;
            }

            $this->content .= "
                <div class=\"list-group-item\">
                    <div class=\"row-action-primary\">
                        <i class=\"material-icons\">&#xE7FD;</i>
                    </div>
                    <div class=\"row-content\">
                        <div class=\"action-secondary\">
                            <a href=\"/contact/{$contact->id}/edit\">
                                <i class=\"material-icons\" style=\"color: #009688\">&#xE254;</i>
                            </a>
                            <a href=\"/contact/{$contact->id}/delete\" onclick=\"return confirm('Certeza que quer remover este contato?')\">
                                <i class=\"material-icons\" style=\"color: #fe6363\">&#xE872;</i>
                            </a>
                        </div>
                        <h4 class=\"list-group-item-heading\" style=\"text-overflow: clip; overflow: hidden; white-space: nowrap\">
                            <a href=\"/contact/{$contact->id}\" title=\"{$title}\">
                                {$title}
                            </a>
                        </h4>
                        <p class=\"list-group-item-text\">{$info}</p>
                    </div>
                </div>
                <div class=\"list-group-separator\"></div>
            ";
        }

        $this->content .= "</div>";
    }

    if (count($this->organizations)) {
        $this->content .= "<h2>Organizações:</h2><div class=\"list-group\">";

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

        $this->content .= "</div>";
    }

    $this->content .= "
                </div>
            </div>
        </div>
    </div>
";

$this->load('Layout/base');

<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

$title = trim($this->contact->name);
if (!$title) {
    $title = $this->contact->phone;
}
if (!$title) {
    $title = $this->contact->email;
}
if (!$title) {
    $title = $this->contact->organization;
}
if (!$title) {
    $title = 'Sem nome';
}

$this->content = "
    <h1>{$title}</h1>

    <div class=\"row\">
        <div style=\"padding: 0 15px\">
            <div class=\"panel panel-default\">
                <div class=\"panel-body\">
";

if ($this->contact->phone || count($this->contact->phones)) {
    $this->content .= "<p><strong>Telefone:</strong>";
    if ($this->contact->phone) {
        $this->content .= "<br>{$this->contact->phone_label}<br>{$this->contact->phone} [Principal]";
    }
    foreach ($this->contact->phones as $phone) {
        $this->content .= "<br>{$phone->phone_label}<br>{$phone->phone}";
    }
    $this->content .= "</p>";
}

if ($this->contact->email || count($this->contact->emails)) {
    $this->content .= "<p><strong>Email:</strong>";
    if ($this->contact->email) {
        $this->content .= "<br>{$this->contact->email} [Principal]";
    }
    foreach ($this->contact->emails as $email) {
        $this->content .= "<br>{$email->email}";
    }
    $this->content .= "</p>";
}

if ($this->contact->organization) {
    $this->content .= "
        <p>
            <strong>Organização:</strong>
            <a href=\"/organization/{$this->contact->organization_id}\">
                {$this->contact->organization}
            </a>
        </p>
    ";
}

if ($this->contact->address || $this->contact->zip_code || $this->contact->district || $this->contact->city) {
    $this->content .= "<p><strong>Endereço:</strong>";
    if ($this->contact->address) {
        $this->content .= "<br>{$this->contact->address}";
    }
    if ($this->contact->zip_code) {
        $this->content .= "<br>CEP: {$this->contact->zip_code}";
    }
    if ($this->contact->district) {
        $this->content .= "<br>Bairro: {$this->contact->district}";
    }
    if ($this->contact->city) {
        $this->content .= "<br>Cidade: {$this->contact->city}";
    }
    $this->content .= "</p>";
}

$this->content .= "
                    <strong>Data de criação:</strong> <span class=\"datetime\">{$this->contact->created}</span><br>
                    <strong>Últimas alterações:</strong> <span class=\"datetime\">{$this->contact->modified}</span><br>
                    <a href=\"/contact/{$this->contact->id}/edit\" class=\"btn btn-raised btn-primary\">
                        <i class=\"material-icons\">&#xE254;</i> Editar
                    </a>
                    <a href=\"/contact/{$this->contact->id}/delete\" onclick=\"return confirm('Certeza que quer remover este contato?')\" class=\"btn btn-raised btn-danger\">
                        <i class=\"material-icons\">&#xE872;</i> Apagar
                    </a>
                </div>
           </div>
        </div>
    </div>
";

$this->load('Layout/base');

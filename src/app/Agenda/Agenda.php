<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

namespace Agenda;

use Agenda\Controllers\Contact;
use Agenda\Controllers\Organization;
use Agenda\Models\Contact as ContactModel;
use Agenda\Models\Organization as OrganizationModel;

/**
 * Classe da aplicação agenda
 */
class Agenda
{
    /**
     * Controller da rota: / (Página inicial)
     */
    public static function home($app, $request)
    {
        $app->view('home');
    }

    /**
     * Controller da rota: /search (Página de resultados de buscas)
     */
    public static function search($app, $request)
    {
        $q = $request->getParam('q', '');

        $contact = new ContactModel($app);
        $contacts = $contact->all($q);

        $organization = new OrganizationModel($app);
        $organizations = $organization->all($q);

        $results = [
            'contacts' => $contacts,
            'organizations' => $organizations
        ];

        if ($request->isJson()) {
            $app->json($results);
        }

        $results['search'] = $q;

        $app->view('search', $results);
    }

    /**
     * Adiciona as rotas da aplicação
     */
    public static function addRoutes($router)
    {
        $router::get('/^\/?$/', [new self(), 'home']);

        $router::get('/^\/search\/?$/', [new self(), 'search']);

        Contact::addRoutes($router);

        Organization::addRoutes($router);
    }
}

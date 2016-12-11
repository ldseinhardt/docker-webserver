<?php
/**
 * Luan Einhardt
 * Contato: ldseinhardt@gmail.com
 */

namespace Agenda\Controllers;

use Agenda\Models\Organization as OrganizationModel;

/**
 * Classe Controller de Organizações/Empresas
 */
class Organization
{
    /**
     * Controller da rota: /organization (Página de organizações)
     */
    public static function all($app, $request)
    {
        $organization = new OrganizationModel($app);

        $organizations = $organization->all(
            $request->getParam('query'),
            $request->getParam('limit')
        );

        if ($request->isJson()) {
            $app->json($organizations);
        }

        $app->view('Organization/list', [
            'organizations' => $organizations,
            'error' => $request->getParam('error')
        ]);
    }

    /**
     * Controller da rota: /organization/{id} (Página de uma organização)
     */
    public static function view($id, $app, $request)
    {
        $organization = new OrganizationModel($app);

        $organization = $organization->get($id);

        if ($request->isJson()) {
            $app->json($organization);
        }

        if (!$organization) {
            $app->redirect('/organization');
        }

        $app->view('Organization/view', [
            'id' => $id,
            'organization' => $organization,
            'error' => $request->getParam('error')
        ]);
    }

    /**
     * Controller da rota: /organization/add (Página para adicionar uma organização)
     */
    public static function add($app, $request)
    {
        if ($request->isPost()) {
            $organization = new OrganizationModel($app);

            $id = $organization->add($request->getData());

            if ($request->isJson()) {
                $app->json($id);
            }

            if (!$id) {
                $app->redirect($request->getOrigin() . '?error=1');
            }

            $app->redirect('/organization/' . $id);
        }

        $app->view('Organization/add', [
            'error' => $request->getParam('error')
        ]);
    }

    /**
     * Controller da rota: /organization/{id}/edit (Página para editar uma organização)
     */
    public static function edit($id, $app, $request)
    {
        $organization = new OrganizationModel($app);

        $original = $organization->get($id);

        if (!$original) {
            $app->redirect('/organization');
        }

        if ($request->isPost()) {
            $data = $request->getData();
            foreach ($data as $key => $value) {
                if ($value !== $original->{$key}) {
                    $organization->update($id, $data);
                    break;
                }
            }

            if ($request->isJson()) {
                $app->json(true);
            }

            $app->redirect('/organization/' . $id);
        }

        $app->view('Organization/edit', [
            'id' => $id,
            'organization' => $original
        ]);
    }

    /**
     * Controller da rota: /organization/{id}/delete (Página para apagar uma organização)
     */
    public static function delete($id, $app, $request)
    {
        $organization = new OrganizationModel($app);

        $status = $organization->delete($id);

        if ($request->isJson()) {
            $app->json($status);
        }

        if (!$status) {
            $app->redirect($request->getOrigin() . '?error=1');
        }

        $app->redirect('/organization');
    }

    /**
     * Adiciona as rotas
     */
    public static function addRoutes($router)
    {
        $router::get('/^\/organization\/?$/', [new self(), 'all']);

        $router::get('/^\/organization\/(\d{1,8})\/?$/', [new self(), 'view']);

        $router::add('/^\/organization\/add\/?$/', [new self(), 'add'], 'GET | POST');

        $router::add('/^\/organization\/(\d{1,8})\/edit\/?$/', [new self(), 'edit'], 'GET | POST');

        $router::add('/^\/organization\/(\d{1,8})\/delete\/?$/', [new self(), 'delete'], 'GET | POST');
    }
}

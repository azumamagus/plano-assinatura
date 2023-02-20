<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    protected $locale;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['form'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();

        $this->setUpLanguageOptions($request);
    }

    protected function removeSpoofingFromRequest()
    {
        $data = $this->request->getPost();

        // garantimos o id nunca seja enviado no request, pois usamos esse método para fazer o preenchimento das propriedades dos objetos

        // quando precisamos do id utilizamos o $this->request->getGetPost('id') diretamente

        // Dessa forma garantimos que ao criar um registro não correremos o risco de atualizar algum registro

        // pois utilizamos o método model->save() que avalia se existe no $data uma posição 'id' e opera (insert ou update) de acordo com isso

        unset($data['id']);

        unset($data['_method']);



        return $data;

    }

    private function setUpLanguageOptions($request)
    {
        $this->locale = $request->getLocale();
        $view = service('renderer');
        $view->setVar('locale', $this->locale);

        // Criamos as opções de urls para os idiomas suportados
        $urls = [
            'url_en' => site_url($request->uri->setSegment(1, 'en')),
            'url_es' => site_url($request->uri->setSegment(1, 'es')),
            'url_pt_br' => site_url($request->uri->setSegment(1, 'pt-BR')),
        ];

        //Voltamos para o orignial
        $request->uri->setSegment(1, $this->locale);

        $view->setVar('urls', (object) $urls);

        helper('html');

        $language = match($this->locale){
            'en' => img('languade/english.png') . ' English',
            'es' => img('languade/espanhol.png') . ' Espanhol',
            'pt-BR' => img('languade/brasil.png') . ' Português',
        };

        $view->setVar('language', $language);
    }
}

<?php namespace App\Requests;

class MyBaseRequest
{
    protected $validation;
    protected $request;
    protected $response;

    public function __construct()
    {
        $this->validation  = service('validation');
        $this->request  = service('request');
        $this->response  = service('response');
    }

    protected function validate(string $ruleGroup, bool $respondWithRedirect = false)
    {
        $this->validation->setRuleGroup($ruleGroup);

        if(! $this->validation->withRequest($this->request)->run())
        {
            // Formulário não foi validado
            if($respondWithRedirect){
                $this->respondWithRedirect();
            }       
            
            $this->respondWithValidationErrors();
        }
    }

    private function respondWithRedirect()
    {
        redirect()->back()->with('danger', lang('App.danger_validations'))
                  ->with('errors_model', $this->validation->getErros())
                  ->withInput()
                  ->send();
        exit;
    }

    private function respondWithValidationErrors() : array
    {
        $response = [
            'success' => false,
            'token'   => csrf_hash(),
            'errors'  => $this->validation->getErrors()
        ];

        if(url_is('api*')){
            unset($response['token']);
        }

        $this->response->setJSON()->send($response);
        exit;
    }

    public function respondWithMessage(bool $success = true, string $message = '', int $statusCode = 200)
    {
        $response = [
            'code'    => $statusCode,
            'success' => $success,
            'token'   => csrf_hash(),
            'message'  => $message,
        ];

        if(url_is('api*')){
            unset($response['token']);
        }

        return $response;
    }
}

<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Requests\CategoryRequest;
use App\Services\CategoryService;
use CodeIgniter\Config\Factories;

class CategoriesController extends BaseController
{
    //Propriedade de categoria
    private $categoryService;
    private $categoryRequest;

    public function __construct()
    {
      $this->categoryService = Factories::class(CategoryService::class);      
      $this->categoryService = Factories::class(CategoryRequest::class);      
    }

    public function index()
    {
        $data = [
            'title' => 'Categorias',
        ];

        return View('Manager/Categories/index', $data);
    }

    public function getAllCategories()
    {
     
        if(! $this->request->isAJAX()){
            return redirect()->back();
        }        
   
        return $this->response->setJSON(['data' => $this->categoryService->getAllCategories()]);
    }

    public function getAllCategoryInfo()
    {
        if(! $this->request->isAJAX()){
            return redirect()->back();
        }        
           
        $category = $this->categoryService->getCategory($this->request->getGetPost('id'));

        $options = [
            'class' => 'form-control',
            'placeholder' => 'Escolha...',
            'selected' => !(empty($category->parent_id)) ? $category->parent_id :"",
        ];

        $response = [
            'category' => $category,
            'parents'  => $this->categoryService->getMultinivel('parent_id', $options),
        ];

        return $this->response->setJSON($response);
    }

    public function update()
    {
        /**
         * @todo validar form
         */

        $this->categoryRequest->validateBeforeSave('category');
        $category = $this->categoryService->getCategory($this->request->getGetPost('id'));
        $category->fill($this->removeSpoofingFromRequest());

        $this->categoryService->trySaveCategory($category);

        return $this->response->setJSON(['success' => true, 'token' => csrf_hash()]);
    }
}

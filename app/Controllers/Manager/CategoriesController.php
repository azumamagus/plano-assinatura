<?php

namespace App\Controllers\Manager;

use App\Controllers\BaseController;
use App\Services\CategoryService;
use CodeIgniter\Config\Factories;

class CategoriesController extends BaseController
{

    private $categoryService;

    public function __construct()
    {
      $this->categoryService = Factories::class(CategoryService::class);      
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
           
        $category = $this->categoryService->getCategory($this->request->getGet('id'));

        $response = [
            'category' => $category,
        ];

        return $this->response->setJSON($response);
    }
}

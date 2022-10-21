<?php namespace App\Services;

use App\Models\CategoryModel;
use CodeIgniter\Config\Factories;

class CategoryService
{
    private CategoryModel $categoryModel;
    
    public function __construct()
    {
        $this->categoryModel = Factories::models(CategoryModel::class);
    }

    public function getAllCategories() : array
    {  
        $categories = $this->categoryModel->asObject()->orderBy('id', 'DESC')->findAll();

        $data = [];

        foreach($categories as $category){
            $data[] = [
                'id'       => $category->id,
                'name'     => $category->name,
                'slug'     => $category->slug,
                'actions'  => '<button class="btn btn-primary btn-sm">Ações</button>',
            ];
        }

        return $data;
    }
    
}

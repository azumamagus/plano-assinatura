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

            $btnEdit = form_button(
                [
                    'data-id' => $category->id,
                    'id'      => 'updateCategoryBtn', //ID do html element
                    'class'   => 'btn btn-primary btn-sm'
                ],
                'Editar'
            );

            $btnArchive = form_button(
                [
                    'data-id' => $category->id,
                    'id'      => 'archiveCategoryBtn', //ID do html element
                    'class'   => 'btn btn-info btn-sm'
                ],
                'Arquivar'
            );

            $data[] = [
                'id'       => $category->id,
                'name'     => $category->name,
                'slug'     => $category->slug,
                'actions'  => $btnEdit . ' ' . $btnArchive,
            ];
        }

        return $data;
    }

    /**
     * Recupera a categoria de acorod com o ID
     *
     * @param integer $id
     * @param boolean $withDeleted
     * @throws Exception
     * @return null|Category
     */
    public function getCategory(int $id, bool $withDeleted = false)
    {
        $category = $this->categoryModel->withDeleted($withDeleted)->find($id);

        if(is_null($category)){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Category not found');
        }

        return $category;
    }
    
}

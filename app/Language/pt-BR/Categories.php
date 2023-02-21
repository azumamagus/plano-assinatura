<?php

return [
    'title_index' => 'Listando as Categorias',
    'title_new'   => 'Criar categoria',
    'title_edit'  => 'Editar Categoria' ,

    'label_name'            => 'Nome',
    'label_choose_category' => 'Escolha uma categoria...',
    'label_slug'            => 'Slug',
    'label_parent_name'     => 'Categoria pai',    

    //Validations
    'name' => [
        'required'     => 'O nome é obrigatório',
        'min_length'   => 'Informe pelo menos 3 caractéres no tamanho', 
        'max_length'   => 'Informe no máximo 90 caractéres no tamanho', 
        'is_unique'    => 'Essa categorai já existe' ,
    ],  

];

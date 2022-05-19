<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Category::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/category');
        CRUD::setEntityNameStrings('category', 'categories');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->addFilters();
        $this->crud->addColumn([
            'name'      => 'id',
            'label'     => 'Mã danh mục',
            'type'      => 'text',
        ]);
        $this->crud->addColumn([
            'name'      => 'name',
            'label'     => 'Tên danh mục',
            'type'      => 'text',
        ]);
        $this->crud->addColumn([
            'name'    => 'image',
            'label'   => 'Hình ảnh',
            'type'    => 'image ',
            'disk' => 'public', // filesystem disk if you're using S3 or something custom
            'height' => '60px',
            'width'  => '60px',
        ]);
        $this->crud->addColumn([
            'name'      => 'created_at',
            'label'     => 'Ngày tạo',
            'type'      => 'date',
            'format' => 'd/m/Y'
        ]);
        $this->crud->addColumn([
            'name'      => 'updated_at',
            'label'     => 'Cập nhật lần cuối',
            'type'      => 'date',
            'format' => 'd/m/Y'
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CategoryRequest::class);

        $this->crud->addField([
            'name'      => 'name',
            'label'     => 'Tên sản phẩm',
            'type'      => 'text',
        ]);
        $this->crud->addField([
            'label' => "Hình ảnh",
            'name' => "image",
            'type' => 'image',
            'crop' => false, // set to true to allow cropping, false to disable
            'aspect_ratio' => 1, // omit or set to 0 to allow any aspect ratio
            // 'disk'      => 's3_bucket', // in case you need to show images from a different disk
            // 'prefix'    => 'uploads/images/profile_pictures/' // in case your db value is only the file name (no path), you can use this to prepend your path to the image src (in HTML), before it's shown to the user;
        ]);
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
    protected function setupShowOperation()
    {
        $this->setupListOperation();
    }
    public function addFilters()
    {
        $this->crud->addFilter([
            'type'  => 'text',
            'name'  => 'id',
            'label' => 'ID'
        ]);
        $this->crud->addFilter([
            'type'  => 'text',
            'name'  => 'name',
            'label' => 'Tên danh mục',
        ],
            false,
            function($value) { // if the filter is active
                $this->crud->addClause('where', 'description', 'LIKE', "%$value%");
            });
        }
}

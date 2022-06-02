<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RateRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RateCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RateCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Rate::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/rate');
        CRUD::setEntityNameStrings('Đánh giá', 'Đánh giá');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->removeButton('create');
        $this->crud->removeButton('update');

        CRUD::column('id');
        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'customer_id', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Tên khách hàng', // Table column heading
            // OPTIONAL
             'entity'    => 'customer', // the method that defines the relationship in your Model
             'attribute' => 'name', // foreign key attribute that is shown to user
             'model'     => \App\Models\Customer::class, // foreign key model
        ]);
        $this->crud->addColumn([
            // any type of relationship
            'name'         => 'product_id', // name of relationship method in the model
            'type'         => 'relationship',
            'label'        => 'Tên sản phẩm', // Table column heading
            // OPTIONAL
            'entity'    => 'product', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'model'     => \App\Models\Product::class, // foreign key model
        ]);
        CRUD::column('content')->label('Nội dung');
        CRUD::column('created_at')->label('Ngày tạo');

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
        CRUD::setValidation(RateRequest::class);

        CRUD::field('id');
        CRUD::field('customer_id');
        CRUD::field('content');
        CRUD::field('product_id');
        CRUD::field('created_at');

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
}

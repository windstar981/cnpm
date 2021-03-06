<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CustommerRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class CustommerCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CustommerCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Customer::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/custommer');
        CRUD::setEntityNameStrings('Khách hàng', 'Khách hàng');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('id');
        CRUD::column('name')->label('Họ tên');
        CRUD::column('email');
        CRUD::column('telephone')->label('Số điện thoại');
        CRUD::column('address')->label('Địa chỉ');
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
        CRUD::setValidation(CustommerRequest::class);
        CRUD::field('id');
        CRUD::field('name')->label('Họ tên');
        CRUD::field('email');
        CRUD::field('telephone')->label('Số điện thoại');
        CRUD::field('address')->label('Địa chỉ');
        CRUD::field('created_at')->label('Ngày tạo');
        

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
        CRUD::field('id');
        CRUD::field('name')->label('Họ tên');
        CRUD::field('email');
        CRUD::field('telephone')->label('Số điện thoại');
        CRUD::field('address')->label('Địa chỉ');
        CRUD::field('created_at')->label('Ngày tạo');
        $this->setupCreateOperation();
    }
}

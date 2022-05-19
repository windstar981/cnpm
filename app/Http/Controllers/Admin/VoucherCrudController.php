<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VoucherRequest;
use AppMain\Product\Enum\ProductStatusEnum;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Carbon\Carbon;

/**
 * Class VoucherCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class VoucherCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Voucher::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/voucher');
        CRUD::setEntityNameStrings('voucher', 'vouchers');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumn([
               'name'      => 'id',
               'label'     => 'Mã voucher',
               'type'      => 'number',
           ]);
        $this->crud->addColumn([
            'name'      => 'name',
            'label'     => 'Tên sản phẩm',
            'type'      => 'text',
        ]);
        $this->crud->addColumn([
            'name'      => 'number',
            'label'     => 'Số lượng',
            'type'      => 'number',
        ]);
        $this->crud->addColumn([
            'name'      => 'time_start',
            'label'     => 'Thời gian bắt đầu',
            'type'      => 'datetime',
            'format' => 'DD/MM/YYYY'

        ]);
        $this->crud->addColumn([
            'name'      => 'time_end',
            'label'     => 'Thời gian kết thúc',
            'type'      => 'datetime',
            'format' => 'DD/MM/YYYY'
        ]);
        $this->crud->addColumn([
            'name'      => 'created_at',
            'label'     => 'Ngày tạo',
            'type'      => 'datetime',
            'format' => 'DD/MM/YYYY'
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
        $today = Carbon::now();
        $next7day = Carbon::now()->addDay(7);
        CRUD::setValidation(VoucherRequest::class);

        CRUD::field('name');
        CRUD::field('number');
        $this->crud->addField(
            [   // date_range
                'name'  => ['time_start', 'time_end'], // db columns for start_date & end_date
                'label' => 'Thời gian bắt đầu - kết thúc',
                'type'  => 'date_range',

                // OPTIONALS
                // default values for start_date & end_date
                'default'            => [$today,$next7day],
                // options sent to daterangepicker.js
                'date_range_options' => [
                    'drops' => 'down', // can be one of [down/up/auto]
                    'timePicker' => true,
                    'startDate' => $today,
                    'minDate' => $today,
                    'locale' => ['format' => 'YYYY-MM-DD HH:mm']
                ]
            ],
        );
        $this->crud->addField([  // Select
            'label'     => "Status",
            'type'      => 'select_from_array',
            'name'      => 'status', // the db column for the foreign key
            'options'   => ProductStatusEnum::$statusText, //  you can use this to filter the results show in the select
        ]);
        CRUD::field('price');

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

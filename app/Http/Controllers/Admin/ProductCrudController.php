<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\User;
use AppMain\Product\Service\ProductService;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use AppMain\Product\Enum\ProductStatusEnum;
/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
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
    protected $productService;

    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('product', 'products');

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
            'label'     => 'Mã sản phẩm',
            'type'      => 'text',
        ]);
        $this->crud->addColumn([
            'name'      => 'name',
            'label'     => 'Tên sản phẩm',
            'type'      => 'text',
        ]);

        $this->crud->addColumn([
            'name'    => 'thumbnail',
            'label'   => 'Image',
            'type'    => 'image ',
            'disk' => 'public', // filesystem disk if you're using S3 or something custom
            'height' => '60px',
            'width'  => '60px',
        ]);
        $this->crud->addColumn([
            'name'      => 'number',
            'label'     => 'Số lượng sản phẩm',
            'type'      => 'text',
        ]);

        $this->crud->addColumn([
            'name'    => 'category_id',
            'label'   => 'Danh mục',
            'type'    => 'closure',
            'function' => function($entry) {
                return Category::findOrFail($entry->category_id)->name;
            }
        ]);

        $this->crud->addColumn([
            'name'      => 'price',
            'label'     => 'Giá',
            'type'      => 'number',
        ]);
        $this->crud->addColumn([
            'name'      => 'price_voucher',
            'label'     => 'Giá khuyến mại',
            'type'      => 'number',
        ]);

//        CRUD::column('attribute');
        $this->crud->addColumn([
            'name'    => 'status',
            'label'   => 'Trạng thái',
            'type'    => 'closure',
            'function' => function($entry) {
                return ProductStatusEnum::$statusText[$entry->status];
            }
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
        CRUD::setValidation(ProductRequest::class);
        $this->crud->addField([
            'name'      => 'name',
            'label'     => 'Tên sản phẩm',
            'type'      => 'text',
            'tab' => 'Thông tin',
        ]);
        $this->crud->addField([
            'name'      => 'number',
            'label'     => 'Số lượng sản phẩm',
            'type'      => 'number',
            'tab' => 'Thông tin',
        ]);
        $this->crud->addField([
            'name'      => 'description',
            'label'     => 'Mô tả',
            'type'      => 'textarea',
            'tab' => 'Thông tin',
        ]);
        $this->crud->addField([  // Select
            'label'     => "Danh mục",
            'type'      => 'select',
            'name'      => 'category_id', // the db column for the foreign key
            'tab'       => 'Thông tin',
            'entity'    => 'category',
            'model'     => "App\Models\Category", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), //  you can use this to filter the results show in the select
        ]);
        $this->crud->addField([   // Upload
            'name'      => 'images',
            'label'     => 'Các hình ảnh',
            'type'      => 'upload_multiple',
            'upload'    => true,
            'tab'       => 'Thông tin',

//              'disk'      => 'public', // if you store files in the /public folder, please omit this; if you store them in /storage or S3, please specify it;
            // optional:
//            'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URLs this will make a URL that is valid for the number of minutes specified
        ]);
        $this->crud->addField([
            'name'      => 'price',
            'label'     => 'Giá',
            'type'      => 'number',
            'tab' => 'Thông tin',
        ]);
        $this->crud->addField([
            'name'      => 'price_voucher',
            'label'     => 'Giá khuyến mại',
            'type'      => 'number',
            'tab' => 'Thông tin',
        ]);

        $this->crud->addField([   // repeatable
            'name'  => 'attribute',
            'label' => 'Thuộc tính',
            'type'  => 'repeatable',
            'tab'       => 'Thuộc tính',
            'fields' => [
                [
                    'name'    => 'brand',
                    'type'    => 'text',
                    'label'   => 'Thương hiệu',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name'    => 'odor',
                    'type'    => 'text',
                    'label'   => 'Mùi hương',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name'    => 'capacity',
                    'type'    => 'text',
                    'label'   => 'Dung tích',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name'    => 'origin',
                    'type'    => 'text',
                    'label'   => 'Xuất xứ',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ]
            ],

            // optional
            'new_item_label'  => 'Add Group', // customize the text of the button
            'init_rows' => 1, // number of empty rows to be initialized, by default 1
            'min_rows' => 1, // minimum rows allowed, when reached the "delete" buttons will be hidden
            'max_rows' => 1, // maximum rows allowed, when reached the "new item" button will be hidden
        ]);
        $this->crud->addField([  // Select
            'label'     => "Trạng thái",
            'type'      => 'select_from_array',
            'name'      => 'status', // the db column for the foreign key
            'tab'       => 'Thông tin',
            // optional
            // defining entity will make Backpack guess 'model' and 'attribute'

            // optional - force the related options to be a custom query, instead of all();
            'options'   => ProductStatusEnum::$statusText, //  you can use this to filter the results show in the select
        ]);
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    protected function setupShowOperation()
    {

        $this->crud->addColumn([
            'name'      => 'id',
            'label'     => 'Mã sản phẩm',
            'type'      => 'text',
        ]);
        $this->crud->addColumn([
            'name'      => 'name',
            'label'     => 'Tên sản phẩm',
            'type'      => 'text',
        ]);
        $this->crud->addColumn([
            'name'      => 'number',
            'label'     => 'Số lượng sản phẩm',
            'type'      => 'text',
        ]);

        $this->crud->addColumn([
            'name'    => 'thumbnail',
            'label'   => 'Image',
            'type'    => 'image ',
            'disk' => 'public', // filesystem disk if you're using S3 or something custom
            'height' => '60px',
            'width'  => '60px',
        ]);
        $this->crud->addColumn([
            'name'    => 'category_id',
            'label'   => 'Danh mục',
            'type'    => 'closure',
            'function' => function($entry) {
                return Category::findOrFail($entry->category_id)->name;
            }
        ]);
        $this->crud->addColumn([
            'name'      => 'description',
            'label'     => 'Mô tả',
            'type'      => 'textarea',
        ]);

        $this->crud->addColumn([
            'name'    => 'images',
            'label'   => 'Photos',
            'type'    => 'upload_multiple',
            'disk' => 'public', // filesystem disk if you're using S3 or something custom
        ]);
        $this->crud->addColumn([
            'name'      => 'price',
            'label'     => 'Giá',
            'type'      => 'number',
        ]);
        $this->crud->addColumn([
            'name'      => 'price_voucher',
            'label'     => 'Giá khuyến mại',
            'type'      => 'number',
        ]);

//        CRUD::column('attribute');
        $this->crud->addColumn([
            'name'     => 'attribute',
            'label'    => 'Attribute',
            'type'     => 'closure',
            'function' => function($entry) {
                return 'Thương hiệu: '.json_decode($entry->attribute)[0]->brand.'</br>'
                 .'Xuất xứ: '.json_decode($entry->attribute)[0]->origin.'</br>'
                 .'Mùi hương: '.json_decode($entry->attribute)[0]->odor.'</br>'
                 .'Dung tích: '.json_decode($entry->attribute)[0]->capacity.'</br>';
            }
        ]);
        $this->crud->addColumn([
            'name'      => 'slug',
            'label'     => 'Slug',
            'type'      => 'text',
        ]);
        $this->crud->addColumn([
            'name'    => 'status',
            'label'   => 'Trạng thái',
            'type'    => 'closure',
            'function' => function($entry) {
                return ProductStatusEnum::$statusText[$entry->status];
            }
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
            'label' => 'Tên sản phẩm',
            ],
            false,
            function($value) { // if the filter is active
                 $this->crud->addClause('where', 'description', 'LIKE', "%$value%");
        });
        $this->crud->addFilter([
            'name' => 'status',
            'type' => 'dropdown',
            'label'=> 'Status',
        ],
            ProductStatusEnum::$statusText,
            function($value) { // if the filter is active
                $this->crud->addClause('where', 'status', $value);
            });
        $this->crud->addFilter([ // daterange filter
            'type'               => 'date_range',
            'name'               => 'created_at',
            'label'              => 'Created At',

        ],
            false,
            function ($value) { // if the filter is active, apply these constraints
                $dates = json_decode($value);
                $this->crud->addClause('where', 'created_at', '>=', $dates->from);
                $this->crud->addClause('where', 'created_at', '<=', $dates->to . ' 23:59:59');
            });

    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    public function store()
    {
        $this->crud->hasAccessOrFail('create');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();
        // insert item in the db
        $images = $request->images ?? null;
        $insert_data = $this->crud->getStrippedSaveRequest();
        $insert_data['user_id'] = backpack_auth()->user()->id;
      //  $insert_data['thumbnail'] = json_decode($images, true)[0] ?? null;
        //        dd($insert_data);
        $item = $this->crud->create($insert_data);

        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();
        $prodService = new ProductService;
        $image = $item->images[0] ?? null;
        $prodService->UpdateById($item->id, ['thumbnail'=>$image]);

        return $this->crud->performSaveAction($item->getKey());
    }

    public function update()
    {
        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();
        // insert item in the db
        $images = $request->images ?? null;
        $insert_data = $this->crud->getStrippedSaveRequest();
        $insert_data['user_id'] = backpack_auth()->user()->id;
        //  $insert_data['thumbnail'] = json_decode($images, true)[0] ?? null;
        //        dd($insert_data);
        $item = $this->crud->update($request->id,$insert_data);

        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();
        $prodService = new ProductService;
        $image = $item->images[0] ?? null;
        $prodService->UpdateById($item->id, ['thumbnail'=>$image]);

        return $this->crud->performSaveAction($item->getKey());
    }


    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}

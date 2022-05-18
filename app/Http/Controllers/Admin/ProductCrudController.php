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
        CRUD::column('id');
        $this->crud->addColumn([
            'name'    => 'thumbnail',
            'label'   => 'Image',
            'type'    => 'image ',
            'disk' => 'public', // filesystem disk if you're using S3 or something custom
            'height' => '60px',
            'width'  => '60px',
        ]);
        CRUD::column('name');
        $this->crud->addColumn([
            'name'    => 'category_id',
            'label'   => 'Category',
            'type'    => 'closure',
            'function' => function($entry) {
                return Category::findOrFail($entry->category_id)->name;
            }
        ]);
        CRUD::column('number');

        CRUD::column('description');

        $this->crud->addColumn([
            'name'    => 'images',
            'label'   => 'Photos',
            'type'    => 'upload_multiple',
            'disk' => 'public', // filesystem disk if you're using S3 or something custom
        ]);
        CRUD::column('price');
//        CRUD::column('price_voucher');
//        CRUD::column('attribute');
        CRUD::column('slug');
//        CRUD::column('published_at');
        $this->crud->addColumn([
            'name'    => 'status',
            'label'   => 'Status',
            'type'    => 'closure',
            'function' => function($entry) {
                return ProductStatusEnum::$statusText[$entry->status];
            }
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
        CRUD::field('name')->tab('Basic');
        CRUD::field('number')->tab('Basic');
        CRUD::field('description')->tab('Basic');
        $this->crud->addField([  // Select
            'label'     => "Category",
            'type'      => 'select',
            'name'      => 'category_id', // the db column for the foreign key
            'tab'       => 'Basic',
            'entity'    => 'category',
            'model'     => "App\Models\Category", // related model
            'attribute' => 'name', // foreign key attribute that is shown to user
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }), //  you can use this to filter the results show in the select
        ]);
        $this->crud->addField([   // Upload
            'name'      => 'images',
            'label'     => 'Photos',
            'type'      => 'upload_multiple',
            'upload'    => true,
            'tab'       => 'Basic',

//              'disk'      => 'public', // if you store files in the /public folder, please omit this; if you store them in /storage or S3, please specify it;
            // optional:
//            'temporary' => 10 // if using a service, such as S3, that requires you to make temporary URLs this will make a URL that is valid for the number of minutes specified
        ]);
        CRUD::field('price')->tab('Basic');
        CRUD::field('price_voucher')->tab('Basic');

        $this->crud->addField([   // repeatable
            'name'  => 'attribute',
            'label' => 'Attribute',
            'type'  => 'repeatable',
            'tab'       => 'Attribute',
            'fields' => [
                [
                    'name'    => 'compositions',
                    'type'    => 'text',
                    'label'   => 'Compositions',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name'    => 'paper_type',
                    'type'    => 'text',
                    'label'   => 'Paper type',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name'    => 'color',
                    'type'    => 'text',
                    'label'   => 'Color',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name'    => 'size',
                    'type'    => 'text',
                    'label'   => 'Size',
                    'wrapper' => ['class' => 'form-group col-md-4'],
                ],
                [
                    'name'    => 'frame_size',
                    'type'    => 'text',
                    'label'   => 'Frame Size',
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
            'label'     => "Status",
            'type'      => 'select_from_array',
            'name'      => 'status', // the db column for the foreign key
            'tab'       => 'Basic',
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

        CRUD::column('id');
        CRUD::column('name');
        CRUD::column('number');

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
            'label'   => 'Category',
            'type'    => 'closure',
            'function' => function($entry) {
                return Category::findOrFail($entry->category_id)->name;
            }
        ]);
        CRUD::column('description');

        $this->crud->addColumn([
            'name'    => 'images',
            'label'   => 'Photos',
            'type'    => 'upload_multiple',
            'disk' => 'public', // filesystem disk if you're using S3 or something custom
        ]);
        CRUD::column('price');
        CRUD::column('price_voucher');
//        CRUD::column('attribute');
        $this->crud->addColumn([
            'name'     => 'attribute',
            'label'    => 'Attribute',
            'type'     => 'closure',
            'function' => function($entry) {
                return 'Compositions: '.json_decode($entry->attribute)[0]->compositions.'</br>'
                 .'Paper type: '.json_decode($entry->attribute)[0]->paper_type.'</br>'
                 .'Color: '.json_decode($entry->attribute)[0]->color.'</br>'
                 .'Size: '.json_decode($entry->attribute)[0]->size.'</br>'
                 .'Frame Size: '.json_decode($entry->attribute)[0]->frame_size.'</br>';
            }
        ]);
        CRUD::column('slug');
        CRUD::column('published_at');
        $this->crud->addColumn([
            'name'    => 'status',
            'label'   => 'Status',
            'type'    => 'closure',
            'function' => function($entry) {
                return ProductStatusEnum::$statusText[$entry->status];
            }
        ]);

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

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}

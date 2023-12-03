<?php

//namespace App\Http\Livewire\Albums;
//
//use App\Models\Album;
//use LaravelViews\Views\GridView;
//use Illuminate\Database\Eloquent\Builder;
//
//class AlbumsGridView extends GridView
//{
//    /**
//     * Sets a model class to get the initial data
//     */
//    protected $model = Album::class;
//
//    public $maxCols = 3;
//
//    public $cardComponent = 'livewire.albums.grid-view-item';
//
//    /**
//     * Sets the searchable properties
//     */
//    public $searchBy = [
//        'name',
//        'description',
//        'manufacturer.name',
//        'categories.name',
//    ];
//
//    /**
//     * Sets a initial query with the data to fill the table
//     *
//     * @return Builder Eloquent query
//     */
//    public function repository(): Builder
//    {
//        $query = Product::query()
//            ->with(['manufacturer', 'categories']);
//        if (request()->user()->can('manage', Product::class)) {
//            $query->withTrashed();
//        }
//        return $query;
//    }
//
//    /**
//     * Sets the data to every card on the view
//     *
//     * @param $model Current model for each card
//     */
//    public function card($model)
//    {
//        return [
//            'image' => $model->imageUrl(),
//            'title' => $model->name,
//            'manufacturer' => $model->manufacturer->name,
//            'categories' => $model->categories,
//            'description' => $model->description,
//            'price' => $model->price,
//        ];
//    }
//}
//
//
//namespace App\Http\Livewire\Products;
//
//use App\Models\Product;
//use LaravelViews\Views\GridView;
//use Illuminate\Database\Eloquent\Builder;
//
//class ProductsGridView extends GridView
//{
//    /**
//     * Sets a model class to get the initial data
//     */
//    protected $model = Product::class;
//
//    public $maxCols = 3;
//
//    public $cardComponent = 'livewire.products.grid-view-item';
//
//    /**
//     * Sets the searchable properties
//     */
//    public $searchBy = [
//        'name',
//        'description',
//        'manufacturer.name',
//        'categories.name',
//    ];
//
//    /**
//     * Sets a initial query with the data to fill the table
//     *
//     * @return Builder Eloquent query
//     */
//    public function repository(): Builder
//    {
//        $query = Product::query()
//            ->with(['manufacturer', 'categories']);
//        if (request()->user()->can('manage', Product::class)) {
//            $query->withTrashed();
//        }
//        return $query;
//    }
//
//    /**
//     * Sets the data to every card on the view
//     *
//     * @param $model Current model for each card
//     */
//    public function card($model)
//    {
//        return [
//            'image' => $model->imageUrl(),
//            'title' => $model->name,
//            'manufacturer' => $model->manufacturer->name,
//            'categories' => $model->categories,
//            'description' => $model->description,
//            'price' => $model->price,
//        ];
//    }
//}

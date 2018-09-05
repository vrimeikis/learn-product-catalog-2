<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductStoreRequest;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\View\View;

class ProductController extends Controller
{
    const COVER_DIRECTORY = 'articles';

    private $productRepository;


    /**
     * ProductController constructor.
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(): View
    {
        $products = $this->productRepository->paginate(5);

//        dd($products);

        return view('admin.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductStoreRequest $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(ProductStoreRequest $request)
    {
//        dd('inside');
try{


//    dd('inside');

    $data = [
        'title' => $request->getTitle(),
        'context' => $request->getContext(),
        'cover' => $request->getCover() ? $request->getCover()->store(self::COVER_DIRECTORY) : null,
        'price' => $request->getPrice(),
        'slug' => $request->getSlug(),
        'active'=> $request->getActive(),
    ];

        $product = $this->productRepository->create($data);

//        dd($product);

        return redirect()
            ->route('admin.product.index')
            ->with('status', 'Product successfully created!');

    } catch (\Throwable $e)
        {
            dd($e->getMessage());
        }



//        dd($data);




    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

}

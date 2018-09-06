<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use App\Http\Controllers\Controller;
use App\Repositories\ProductRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    const COVER_DIRECTORY = 'products';

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
     */
    public function store(ProductStoreRequest $request)
    {
        try{

            $data = [
                'title' => $request->getTitle(),
                'context' => $request->getContext(),
                'cover' => $request->getCover() ? $request->getCover()->store(self::COVER_DIRECTORY) : null,
                'price' => $request->getPrice(),
                'slug' => $request->getSlug(),
                'active'=> $request->getActive(),
            ];

            $product = $this->productRepository->create($data);

            return redirect()
                ->route('admin.product.index')
                ->with('status', 'Product successfully created!');

        } catch (\Throwable $e)
            {
                dd($e->getMessage());
            }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product $product
     * @return void
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductUpdateRequest $request
     * @param int $productId
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function update(ProductUpdateRequest $request, int $productId): RedirectResponse
    {
        $data = [
            'title' => $request->getTitle(),
            'context' => $request->getContext(),
            'price' => $request->getPrice(),
            'active' => $request->getActive(),
        ];

        if($request->getCover()) {
            $data['cover'] = $request->getCover()->store(self::COVER_DIRECTORY);
        }

        $this->productRepository->update($data, $productId);

        return redirect()
            ->route('admin.product.index')
            ->with('status', 'Product updated successfully!');

    }

}
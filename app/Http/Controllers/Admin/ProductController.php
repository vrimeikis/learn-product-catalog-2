<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Product;
use App\Http\Controllers\Controller;
use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Illuminate\View\View;

/**
 * Class ProductController
 * @package App\Http\Controllers\Admin
 */
class ProductController extends Controller
{
    /**
     *
     */
    const COVER_DIRECTORY = 'products';

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * ProductController constructor.
     * @param ProductRepository $productRepository
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(ProductRepository $productRepository, CategoryRepository $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
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

        return view('admin.product.list', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create(): View
    {
        /** @var Collection $categories */
        $categories = $this->categoryRepository->all();

        return view('admin.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductStoreRequest $request
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $data = [
            'title' => $request->getTitle(),
            'context' => $request->getContext(),
            'cover' => $request->getCover() ? $request->getCover()->store(self::COVER_DIRECTORY) : null,
            'price' => $request->getPrice(),
            'slug' => $request->getSlug(),
            'active'=> $request->getActive(),
        ];

        /** @var Product $product */
        $product = $this->productRepository->create($data);

        $product->categories()->attach($request->getCategoriesIds());

        return redirect()
            ->route('admin.product.index')
            ->with('status', 'Product successfully created!');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $productId
     * @return View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function edit(int $productId): View
    {
        $product = $this->productRepository->find($productId);
        $categories = $this->categoryRepository->all();

        return view('admin.product.edit', compact('product', 'categories'));
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

        /** @var Product $product */
        $product = $this->productRepository->find($productId);

        $product->categories()->sync($request->getCategoriesIds());


        return redirect()
            ->route('admin.product.index')
            ->with('status', 'Product updated successfully!');
    }
}

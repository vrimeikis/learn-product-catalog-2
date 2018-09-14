<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryStoreRequest;
use App\Http\Requests\Admin\CategoryUpdateRequest;
use App\Repositories\CategoryRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class CategoryController
 * @package App\Http\Controllers\Admin
 */
class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
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
        $categories = $this->categoryRepository->paginate();

        return view('admin.category.list', compact('categories'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryStoreRequest $request
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(CategoryStoreRequest $request): RedirectResponse
    {
        $data = [
            'title' => $request->getTitle(),
            'slug' => $request->getSlug(),
            'active' => $request->getActive(),
        ];


        if ($request->getCover()) {
            $data['cover'] = $request->getCover()->store('categories');
        }

        $this->categoryRepository->create($data);

        return redirect()
            ->route('admin.categories.index')
            ->with('status', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $categoryId
     * @return View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function edit(int $categoryId): View
    {
        $category = $this->categoryRepository->find($categoryId);

        return view('admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryUpdateRequest $request
     * @param int $categoryId
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function update(CategoryUpdateRequest $request, int $categoryId): RedirectResponse
    {

        $data = [
            'title' => $request->getTitle(),
            'slug' => $request->getSlug(),
            'active' => $request->getActive(),
        ];

        if ($request->getCover()) {
            $data['cover'] = $request->getCover()->store('categories');
        }

        $this->categoryRepository->update($data, $categoryId);

        return redirect()
            ->route('admin.categories.index')
            ->with('status', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        //
    }
}

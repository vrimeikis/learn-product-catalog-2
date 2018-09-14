<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeatureItemStoreRequest;
use App\Http\Requests\Admin\FeatureItemUpdateRequest;
use App\Http\Requests\Admin\FeatureStoreRequest;
use App\Http\Requests\Admin\FeatureUpdateRequest;
use App\Repositories\FeatureItemRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class FeatureController
 * @package App\Http\Controllers\Admin
 */
class FeatureItemController extends Controller
{
    /**
     * @var FeatureItemRepository
     */
    private $featureItemRepository;

    /**
     * CategoryController constructor.
     * @param FeatureItemRepository $featureItemRepository
     */
    public function __construct(FeatureItemRepository $featureItemRepository)
    {
        $this->featureItemRepository = $featureItemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(): View
    {
        $items = $this->featureItemRepository->paginate();

        //dd($items);

        return view('admin.featureItem.list', compact('items'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.featureItem.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FeatureStoreRequest $request
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(FeatureItemStoreRequest $request): RedirectResponse
    {
        $data = [
            'title' => $request->getTitle(),
            'slug' => $request->getSlug(),
            'active' => $request->getActive(),
        ];

        $this->featureItemRepository->create($data);

        return redirect()
            ->route('admin.featuresItems.index')
            ->with('status', 'Feature item created successfully!');
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
     * @param int $featureItemId
     * @return View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function edit(int $featureItemId): View
    {
        $item = $this->featureItemRepository->find($featureItemId);

        return view('admin.featureItem.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FeatureItemUpdateRequest $request
     * @param int $featureItemId
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function update(FeatureItemUpdateRequest $request, int $featureItemId): RedirectResponse
    {

        $data = [
            'title' => $request->getTitle(),
            'slug' => $request->getSlug(),
            'active' => $request->getActive(),
        ];

        $this->featureItemRepository->update($data, $featureItemId);

        return redirect()
            ->route('admin.featuresItems.index')
            ->with('status', 'Feature item updated successfully!');
    }

//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int $id
//     * @return void
//     */
//    public function destroy($id)
//    {
//        //
//    }
}

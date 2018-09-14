<?php

declare(strict_types = 1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FeatureStoreRequest;
use App\Http\Requests\Admin\FeatureUpdateRequest;
use App\Repositories\FeatureRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class FeatureController
 * @package App\Http\Controllers\Admin
 */
class FeatureController extends Controller
{
    /**
     * @var FeatureRepository
     */
    private $featureRepository;

    /**
     * CategoryController constructor.
     * @param FeatureRepository $featureRepository
     */
    public function __construct(FeatureRepository $featureRepository)
    {
        $this->featureRepository = $featureRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function index(): View
    {
        $features = $this->featureRepository->paginate();

        //dd($features);

        return view('admin.feature.list', compact('features'));
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('admin.feature.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FeatureStoreRequest $request
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function store(FeatureStoreRequest $request): RedirectResponse
    {
        $data = [
            'title' => $request->getTitle(),
            'slug' => $request->getSlug(),
            'active' => $request->getActive(),
        ];

        $this->featureRepository->create($data);

        return redirect()
            ->route('admin.features.index')
            ->with('status', 'Feature created successfully!');
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
     * @param int $featureId
     * @return View
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function edit(int $featureId): View
    {
        $feature = $this->featureRepository->find($featureId);

        return view('admin.feature.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FeatureUpdateRequest $request
     * @param int $featureId
     * @return RedirectResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function update(FeatureUpdateRequest $request, int $featureId): RedirectResponse
    {

        $data = [
            'title' => $request->getTitle(),
            'slug' => $request->getSlug(),
            'active' => $request->getActive(),
        ];

        $this->featureRepository->update($data, $featureId);

        return redirect()
            ->route('admin.features.index')
            ->with('status', 'Feature updated successfully!');
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

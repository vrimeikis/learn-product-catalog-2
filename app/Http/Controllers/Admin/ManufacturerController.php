<?php

declare (strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ManufacturerStoreRequest;
use App\Repositories\ManufacturerRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\View\View;

/**
 * Class ManufacturerController
 * @package App\Http\Controllers\Admin
 */
class ManufacturerController extends Controller
{
    const COVER_DIRECTORY = 'manufactures';

    /** @var ManufacturerRepository */
    private $manufacturerRepository;

    /**
     * ManufacturerController constructor.
     * @param ManufacturerRepository $manufacturerRepository
     */
    public function __construct(ManufacturerRepository $manufacturerRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws BindingResolutionException
     */
    public function index(): View
    {
        $manufacturers = $this->manufacturerRepository->paginate();

        return view('admin.manufacturer.list', compact('manufacturers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.manufacturer.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ManufacturerStoreRequest $request
     * @return RedirectResponse
     * @throws BindingResolutionException
     */
    public function store(ManufacturerStoreRequest $request): RedirectResponse
    {
        $data = [
            'title' => $request->getTitle(),
            'description' => $request->getDescription(),
            'address' => $request->getAddress(),
            'email' => $request->getEmail(),
            'phone' => $request->getPhone(),
            'logo' => $request->getLogo() ? $request->getLogo()->store(self::COVER_DIRECTORY) : null,
            'active' => $request->getActive(),
        ];

        array_set($data, 'slug', empty($request->getSlug()) ? Str::slug($request->getTitle()) : Str::slug($request->getSlug()));

        $this->manufacturerRepository->create($data);

        return redirect()
            ->route('admin.manufacturers.index')
            ->with('status', 'Manufacturer created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return View
     * @throws BindingResolutionException
     */
    public function show(int $id): View
    {
        $manufacturer = $this->manufacturerRepository->find($id);

        return view('admin.manufacturer.view', compact('manufacturer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
}

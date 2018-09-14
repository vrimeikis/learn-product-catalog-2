<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SupplierStoreRequest;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use App\Repositories\SupplierRepository;

class SupplierController extends Controller
{
    protected $supplierRepository;

    /**
     * SupplierController constructor.
     * @param SupplierRepository $supplierRepository
     */
    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws BindingResolutionException
     */
    public function index(): View
    {
        $suppliers = $this->supplierRepository->paginate(5);

        return view('admin.supplier.list',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SupplierStoreRequest $request
     * @return RedirectResponse
     * @throws BindingResolutionException
     */
    public function store(SupplierStoreRequest $request): RedirectResponse
    {
        $data = [
            'title' => $request->getTitle(),
            'description' => $request->getDescription(),
            'address' => $request->getAddress(),
            'phone' => $request->getPhone(),
            'email' => $request->getEmail(),
            'slug' => $request->getSlug(),
            'active' => $request->getActive(),
        ];


        if ($request->getLogo()) {
            $data['logo'] = $request->getLogo()->store('logo');
        }
        $this->supplierRepository->create($data);

        return redirect()
            ->route('admin.suppliers.index')
            ->with('status', 'Supplier created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param $supplierId
     * @return View
     * @throws BindingResolutionException
     */
    public function show(int $supplierId): View
    {
        $supplier = $this->supplierRepository->find($supplierId);

        return view('admin.supplier.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $supplierId
     * @return View
     * @throws BindingResolutionException
     */
    public function edit(int $supplierId): View
    {
        $supplier = $this->supplierRepository->find($supplierId);

        return view('admin.supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

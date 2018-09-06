<?php

declare (strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserMetasStoreRequest;
use App\Repositories\UserMetasRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class UserMetasController
 * @package App\Http\Controllers\Admin
 */
class UserMetasController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param int $userId
     * @return View
     */
    public function create(int $userId): View
    {
        return view('admin.user.address.create', compact('userId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserMetasStoreRequest $request
     * @param int $userId
     * @return RedirectResponse
     * @throws BindingResolutionException
     */
    public function store(UserMetasStoreRequest $request, int $userId): RedirectResponse
    {
        /** @var UserMetasRepository $userMetasRepository */
        $userMetasRepository = app()->make(UserMetasRepository::class);

        $userMetasRepository->create([
                'address' => $request->getAddress(),
                'user_id' => $userId,
            ]);

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'Address added to user successfully!');
    }
}

<?php

declare (strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /** @var UserRepository */
    private $userRepository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws BindingResolutionException
     */
    public function index(): View
    {
        $users = $this->userRepository->paginate();

        return view('admin.user.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserStoreRequest $request
     * @return RedirectResponse
     * @throws BindingResolutionException
     */
    public function store(UserStoreRequest $request): RedirectResponse
    {
        $this->userRepository->create([
            'name' => $request->getName(),
            'last_name' => $request->getLastName(),
            'email' => $request->getEmail(),
            'password' => bcrypt($request->getPassword()),
        ]);

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'User created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $userId
     * @return View
     * @throws BindingResolutionException
     */
    public function show(int $userId): View
    {
        $user = $this->userRepository
            ->makeQuery()
            ->with('addresses')
            ->find($userId);

        return view('admin.user.index', compact('user', 'addresses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $userId
     * @return View
     * @throws BindingResolutionException
     */
    public function edit(int $userId): View
    {
        $user = $this->userRepository->find($userId);

        return view('admin.user.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param int $userId
     * @return RedirectResponse
     * @throws BindingResolutionException
     */
    public function update(UserUpdateRequest $request, int $userId): RedirectResponse
    {
        $data = [
            'name' => $request->getName(),
            'last_name' => $request->getLastName(),
            'email' => $request->getEmail(),
        ];

        if (!empty($request->getPassword())) {
            array_set($data, 'password', bcrypt($request->getPassword()));
        }

        $this->userRepository->update($data, $userId);

        return redirect()
            ->route('admin.users.index')
            ->with('status', 'User updated successfully!');
    }
}

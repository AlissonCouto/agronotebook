<?php

namespace App\Http\Controllers;

use App\Http\Requests\FarmStoreRequest;
use App\Http\Requests\FarmUpdateRequest;
use App\Services\FarmService;
use App\Models\Farm;
use App\DTO\Farm\FarmStoreData;
use App\DTO\Farm\FarmUpdateData;
use App\Models\User;
use Illuminate\Http\Request;

class FarmController extends Controller
{
    private $service;

    public function __construct(FarmService $farmService)
    {
        $this->service = $farmService;
    }

    public function index(Request $request)
    {
        $search = $request->search;

        $sort = $request->get('sort', 'id');
        $direction = $request->get('direction', 'desc');

        $farms = Farm::query()
            ->where('user_id', auth()->id())

            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            })

            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('layouts.farms.index', compact('farms'));
    }

    public function create()
    {
        return view('layouts.farms.create');
    }

    public function store(FarmStoreRequest $request)
    {
        $data = FarmStoreData::fromRequest($request->validated());

        $this->service->store($data);

        return redirect()
            ->route('farms.index')
            ->with('success', 'Fazenda criada com sucesso.');
    }

    public function edit($id)
    {
        $farm = Farm::where('user_id', auth()->id())
            ->findOrFail($id);

        return view('layouts.farms.edit', compact('farm'));
    }

    public function update(FarmUpdateRequest $request, $id)
    {
        $data = FarmUpdateData::fromRequest(
            $request->validated(),
            $id
        );

        $this->service->update($data);

        return redirect()
            ->route('farms.index')
            ->with('success', 'Fazenda atualizada com sucesso.');
    }

    public function destroy($id)
    {
        $this->service->destroy($id);

        return redirect()
            ->route('farms.index')
            ->with('success', 'Fazenda removida com sucesso.');
    }

    public function users(Request $request, $farmId)
    {
        $search = $request->search;

        $sort = $request->get('sort', 'users.id');
        $direction = $request->get('direction', 'desc');

        $allowedSorts = ['users.id', 'users.name', 'users.email'];

        if (!in_array($sort, $allowedSorts)) {
            $sort = 'users.id';
        }

        if (!in_array($direction, ['asc', 'desc'])) {
            $direction = 'desc';
        }

        $farm = Farm::findOrFail($farmId);

        $users = $farm->users()
            ->select('users.*', 'farm_users.role as pivot_role')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('users.name', 'like', "%{$search}%")
                        ->orWhere('users.email', 'like', "%{$search}%");
                });
            })
            ->orderBy($sort, $direction)
            ->paginate(10)
            ->withQueryString();

        return view('layouts.farms.users.index', compact('farm', 'users'));
    }

    public function createUser(Request $request, $farmId)
    {
        $farm = Farm::findOrFail($farmId);

        return view('layouts.farms.users.create')->with(compact('farm'));
    }

    public function storeUser(Request $request, $farmId)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'role' => 'required|in:OWNER,AGRONOMIST,EMPLOYEE,VIEWER',
        ]);

        $farm = Farm::findOrFail($farmId);

        $user = User::where('email', $request->email)->first();

        // evita duplicidade
        if ($farm->users()->where('user_id', $user->id)->exists()) {
            return back()->withErrors([
                'email' => 'Usuário já está vinculado a esta fazenda.'
            ]);
        }

        $farm->users()->attach($user->id, [
            'role' => $request->role
        ]);

        return redirect()
            ->route('farms.users', $farm->id)
            ->with('success', 'Usuário adicionado com sucesso.');
    }

    public function editUser($farmId, $userId)
    {
        $farm = Farm::findOrFail($farmId);

        $user = $farm->users()->where('users.id', $userId)->firstOrFail();

        return view('layouts.farms.users.edit', compact('farm', 'user'));
    }

    public function updateUser(Request $request, $farmId, $userId)
    {
        $request->validate([
            'role' => 'required|in:OWNER,AGRONOMIST,EMPLOYEE,VIEWER',
        ]);

        $farm = Farm::findOrFail($farmId);

        $user = $farm->users()->where('users.id', $userId)->firstOrFail();

        // regra: não deixar fazenda sem OWNER
        if ($user->pivot->role === 'OWNER' && $request->role !== 'OWNER') {

            $ownersCount = $farm->users()
                ->wherePivot('role', 'OWNER')
                ->count();

            if ($ownersCount <= 1) {
                return back()->withErrors([
                    'role' => 'A fazenda precisa de pelo menos um OWNER.'
                ]);
            }
        }

        // opcional: evitar múltiplos OWNER
        if ($request->role === 'OWNER') {
            $hasOwner = $farm->users()
                ->wherePivot('role', 'OWNER')
                ->where('users.id', '!=', $userId)
                ->exists();

            if ($hasOwner) {
                return back()->withErrors([
                    'role' => 'Já existe um OWNER nesta fazenda.'
                ]);
            }
        }

        $farm->users()->updateExistingPivot($userId, [
            'role' => $request->role
        ]);

        return redirect()
            ->route('farms.users', $farmId)
            ->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroyUser($farmId, $userId)
    {
        $farm = Farm::findOrFail($farmId);

        $user = $farm->users()
            ->where('users.id', $userId)
            ->firstOrFail();

        if ($user->pivot->role === 'OWNER') {

            $ownersCount = $farm->users()
                ->wherePivot('role', 'OWNER')
                ->count();

            if ($ownersCount <= 1) {
                return back()->withErrors([
                    'error' => 'A fazenda precisa de pelo menos um OWNER.'
                ]);
            }

            if ($user->id === auth()->id() && $user->pivot->role === 'OWNER') {
                return back()->withErrors([
                    'error' => 'Você não pode remover a si mesmo como OWNER.'
                ]);
            }
        }

        $farm->users()->detach($userId);

        return redirect()
            ->route('farms.users', $farmId)
            ->with('success', 'Usuário removido da fazenda.');
    }
}

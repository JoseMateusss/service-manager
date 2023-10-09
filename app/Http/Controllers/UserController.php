<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    function __construct(
        public User $user
    )
    {
        $this->middleware('can:Visualizar usuários')->only('index');
        $this->middleware('can:Criar usuários')->only('create', 'store');
        $this->middleware('can:Editar usuários')->only('edit', 'updated');
        $this->middleware('can:Excluir usuários')->only('destroy');
    }

    public function index(): View
    {
        return view('user.index', [
            'users' => $this->user->all()
        ]);
    }

    public function create(): View
    {
        return view('user.create', [
            'roles' => Role::all('id', 'name')
        ]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $user = User::query()->create($request->validated());

            $user->roles()->attach($request->input('role'));

            return redirect()->route('users.index')->with('success', 'Novo usuário adicionado');

        } catch (\Exception $e) {
            report($e);
        }

        return redirect()->route('users.index')->with('error', 'Error ao adicionar usuário');
    }

    public function edit(User $user): View
    {
        return view('user.edit', [
            'roles' => Role::all(),
            'user' => $user
        ]);
    }

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        try {
            $user->update($request->validated());

            $user->roles()->sync($request->input('role'));

            return redirect()->route('users.edit', ['user' => $user->id])->with('success', 'Informações atualizadas');

        } catch (\Exception $e){
            report($e);
        }

        return redirect()->route('users.edit', ['user' => $user->id])->with('error', 'Error ao atualizar informações');

    }

    public function destroy(User $user): RedirectResponse
    {
        try {
            $user->delete();

            return redirect()->route('users.index')->with('success', 'Usuário excluído');

        } catch (\Exception $e){
            report($e);
        }

        return redirect()->route('users.index')->with('error', 'Erro ao tentar excluir usuário');
    }
}

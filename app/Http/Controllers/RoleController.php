<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRequest;
use App\Http\Requests\Role\UpdateRequest;
use App\Models\GroupPermission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    function __construct(
        public Role $role
    )
    {
        $this->middleware('role:Super Admin');
    }

    public function index(): View
    {
        return view('role.index', [
            'roles' => $this->role->query()->whereNot('name', 'Super Admin')->get()
        ]);
    }

    public function create(): View
    {
        return view('role.create', [
            'groups' => GroupPermission::query()->with('permissions')->get()
        ]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $role = Role::query()->create($request->validated());

            $role->syncPermissions($request->input('permission_id'));

            return redirect()->route('roles.index')->with('success', 'Grupo de acesso criado');
        } catch (\Exception $e){
            report($e);
        }

        return redirect()->route('roles.index')->with('error', 'Erro ao cadastrar grupo de acesso');
    }

    public function edit(Role $role): View
    {
        return view('role.edit', [
            'groups' => GroupPermission::query()->with('permissions')->get(),
            'role' => $role->load('permissions')
        ]);
    }

    public function update(UpdateRequest $request, Role $role): RedirectResponse
    {
        try {
            $role->update($request->validated());
            $role->syncPermissions($request->input('permission_id'));

            return redirect()->route('roles.edit', ['role' => $role->id])->with('success','Informações atualizadas');
        }catch (\Exception $e){
            report($e);
        }

        return redirect()->route('roles.edit', ['role' => $role->id])->with('error','Erro ao tentar atualizar informações');
    }

    public function destroy(Role $role): RedirectResponse
    {
        if ($role->users()->count() > 0){
            return redirect()->route('roles.index')->with('error', 'Esse grupo de acesso deve ser mantido devido aos usuários relacionados');
        }

        try {
            $role->delete();

            return redirect()->route('roles.index')->with('success', 'Grupo de acesso excluído');

        } catch (\Exception $e){
            report($e);
        }

        return redirect()->route('users.index')->with('error', 'Erro ao tentar excluir grupo de acesso');
    }
}

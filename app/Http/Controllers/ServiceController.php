<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\StoreRequest;
use App\Models\Service;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ServiceController extends Controller
{
    function __construct(
        public Service $service
    )
    {
        $this->middleware('can:Visualizar ordens de serviços')->only('index');
        $this->middleware('can:Criar ordens de serviços')->only('create', 'store');
        $this->middleware('can:Editar ordens de serviços')->only('edit', 'updated');
        $this->middleware('can:Excluir ordens de serviços')->only('destroy');
    }

    public function reportService(Service $service): \Illuminate\Http\Response
    {
        $report = PDF::loadView('service.report', ['service' => $service]);
        return $report->download('invoice.pdf');
    }

    public function index(): View
    {
        return view('service.index', [
            'services' => $this->service->with('user')->get()
        ]);
    }

    public function create(): View
    {
        return view('service.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $user = Auth::user()->id;

        $protocol = $this->service->getNextProtocol();

        try {

            $data = $request->safe()->merge([
                'user_id' => $user,
                'protocol' => $protocol
            ]);

            $service = $this->service::create($data->toArray());

            return redirect()->route('services.index')->with('success', 'Nova ordem de serviço criada');

        } catch (\Exception $e) {
            report($e);
        }

        return redirect()->route('services.index')->with('error', 'Error ao tentar adicionar ordem de serviço');
    }

    public function edit(Service $service): View
    {
        return view('service.edit', [
            'service' => $service
        ]);
    }

    public function update(StoreRequest $request, Service $service): RedirectResponse
    {
        try {
            $service->update($request->validated());

            return redirect()->route('services.edit', ['service' => $service->id])->with('success', 'Informações atualizadas');

        } catch (\Exception $e){
            report($e);
        }

        return redirect()->route('services.edit', ['service' => $service->id])->with('error', 'Erro ao tentar atualizar ordem de serviço');
    }

    public function destroy(Service $service): RedirectResponse
    {
        try {
            $service->delete();

            return redirect()->route('services.index')->with('success', 'Ordem de serviço excluída');

        } catch (\Exception $e){
            report($e);
        }

        return redirect()->route('services.index')->with('error', 'Erro ao tentar excluir ordem de serviço');
    }
}

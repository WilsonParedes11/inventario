<div class="card">
    <div class="card-header">
        <div>
            <h3 class="card-title">
                {{ __('Seguimiento de Productos') }}
            </h3>
        </div>

    </div>

    <div class="card-body border-bottom py-3">
        <select class="form-select form-control-solid @error('customer_id') is-invalid @enderror" id="customer_id"
            wire:model="selectedProductId" name="customer_id" wire:change="loadMovements($event.target.value)">
            <option selected disabled>Seleccione un producto</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
            @endforeach
        </select>
        <br>
        <div class="d-flex">
            <div class="text-secondary">
                Mostrar
                <div class="mx-2 d-inline-block">
                    <select wire:model.live="perPage" class="form-select form-select-sm" aria-label="result per page">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                    </select>
                </div>
                elementos
            </div>
            <div class="ms-auto text-secondary">
                Buscar:
                <div class="ms-2 d-inline-block">
                    <input type="text" wire:model.live="search" class="form-control form-control-sm"
                        aria-label="Search invoice">
                </div>
            </div>
        </div>
    </div>

    <x-spinner.loading-spinner />

    <div class="table-responsive">
        <table wire:loading.remove class="table table-bordered card-table table-vcenter text-nowrap datatable">
            <thead class="thead-light">
                <tr>
                    <th class="align-middle text-center w-1">
                        {{ __('No.') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Fecha') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Entradas') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Salidas') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Precio unitario') }}
                    </th>
                    <th scope="col" class="align-middle text-center">
                        {{ __('Total') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @php
                    info($movements);
                @endphp
                @forelse ($movements as $movement)
                    <tr>
                        <td class="align-middle text-center">
                            {{ $loop->iteration }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $movement->date }}
                        </td>

                        <td class="align-middle text-center">
                            {{ $movement->type === 'purchase' ? $movement->quantity : '--' }}
                        </td>
                        <td class="align-middle text-center">
                            {{ $movement->type === 'order' ? $movement->quantity : '--' }}
                        </td>
                        <td class="align-middle text-center">
                            ${{ $movement->unitcost }}
                        </td>
                        <td class="align-middle text-center">
                            ${{ $movement->total }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="align-middle text-center" colspan="7">
                            No results found
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer d-flex align-items-center">
        <p class="m-0 text-secondary">
            Mostrando <span>{{ $products->firstItem() }}</span>
            to <span>{{ $products->lastItem() }}</span> of <span>{{ $products->total() }}</span> elementos
        </p>

        <ul class="pagination m-0 ms-auto">
            {{ $products->links() }}
        </ul>
    </div>
</div>

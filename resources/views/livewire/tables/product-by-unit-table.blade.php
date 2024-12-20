<div>
  <div class="card">
    <div class="card-header">
      <div>
        <h3 class="card-title">
          Unit: {{ $unit->name }}
        </h3>
      </div>

      <div class="card-actions btn-actions">
        <div class="dropdown">
          <a href="#" class="btn-action dropdown-toggle"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <!-- Download SVG icon from http://tabler-icons.io/i/dots-vertical -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon"
              width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
              stroke="currentColor" fill="none" stroke-linecap="round"
              stroke-linejoin="round">
              <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
              <path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
              <path d="M12 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
              <path d="M12 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0"></path>
            </svg>
          </a>

          <div class="dropdown-menu dropdown-menu-end" style="">
            <a href="{{ route('products.create', ['unit' => $unit]) }}"
              class="dropdown-item">
              <x-icon.plus />
              {{ __('Agregar Producto') }}
            </a>
          </div>
        </div>

        <x-action.close route="{{ route('units.index') }}" />
      </div>
    </div>

    <div class="card-body border-bottom py-3">
      <div class="d-flex">
        <div class="text-secondary">
          Mostrar
          <div class="mx-2 d-inline-block">
            <select wire:model.live="perPage" class="form-select form-select-sm"
              aria-label="result per page">
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
            <input type="text" wire:model.live="search"
              class="form-control form-control-sm" aria-label="Search invoice">
          </div>
        </div>
      </div>
    </div>

    <x-spinner.loading-spinner />

    <div class="table-responsive">
      <table wire:loading.remove
        class="table table-bordered card-table table-vcenter text-nowrap datatable">
        <thead class="thead-light">
          <tr>
            <th class="align-middle text-center w-1">
              {{ __('ID') }}
            </th>
            <th scope="col" class="align-middle text-center">
              <a wire:click.prevent="sortBy('name')" href="#"
                role="button">
                {{ __('Producto') }}
                @include('inclues._sort-icon', ['field' => 'name'])
              </a>
            </th>
            <th scope="col"
              class="align-middle text-center d-none d-sm-table-cell">
              <a wire:click.prevent="sortBy('code')" href="#"
                role="button">
                {{ __('Código') }}
                @include('inclues._sort-icon', ['field' => 'code'])
              </a>
            </th>
            <th scope="col"
              class="align-middle text-center d-none d-sm-table-cell">
              <a wire:click.prevent="sortBy('quantity')" href="#"
                role="button">
                {{ __('Cantidad') }}
                @include('inclues._sort-icon', [
                    'field' => 'quantity',
                ])
              </a>
            </th>
            <th scope="col" class="align-middle text-center">
              {{ __('Acciones') }}
            </th>
          </tr>
        </thead>
        <tbody>
          @forelse ($products as $product)
            <tr>
              <td class="align-middle text-center" style="width: 10%">
                {{ $product->id }}
              </td>
              <td class="align-middle text-center">
                {{ $product->name }}
              </td>
              <td class="align-middle text-center">
                {{ $product->code }}
              </td>
              <td class="align-middle text-center">
                {{ $product->quantity }}
              </td>
              <td class="align-middle text-center" style="width: 15%">
                <x-button.show class="btn-icon"
                  route="{{ route('products.show', $product->uuid) }}"
                  data-bs-toggle="tooltip" data-bs-placement="top"
                  title="Ver detalles" />
                <x-button.edit class="btn-icon"
                  route="{{ route('products.edit', $product->uuid) }}"
                  data-bs-toggle="tooltip" data-bs-placement="top"
                  title="Editar producto" />
                <x-button.delete class="btn-icon"
                  route="{{ route('products.destroy', $product->uuid) }}"
                  onclick="return confirm('¿Estás seguro de eliminar el producto {{ $product->name }} ?!')"
                  data-bs-toggle="tooltip" data-bs-placement="top"
                  title="Eliminar producto" />
              </td>
            </tr>
          @empty
            <tr>
              <td class="align-middle text-center" colspan="8">
                No existen resultados
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
    <div class="card-footer d-flex align-items-center">
      <p class="m-0 text-secondary">
        Mostrando <span>{{ $products->firstItem() }}</span> -
        <span>{{ $products->lastItem() }}</span> de
        <span>{{ $products->total() }}</span> elementos
      </p>

      <ul class="pagination m-0 ms-auto">
        {{ $products->links() }}
      </ul>
    </div>
  </div>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll(
      '[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  });
</script>

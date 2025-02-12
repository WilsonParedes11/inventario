<div class="card">
  <div class="card-header">
    <div>
      <h3 class="card-title">
        {{ __('Clientes') }}
      </h3>
    </div>

    <div class="card-actions">
      <x-action.create route="{{ route('customers.create') }}" />
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
          <th scope="col" class="align-middle text-center">
            <a wire:click.prevent="sortBy('id')" href="#" role="button">
              {{ __('Id') }}
              @include('inclues._sort-icon', ['field' => 'id'])
            </a>
          </th>
          <th scope="col" class="align-middle text-center">
            <a wire:click.prevent="sortBy('name')" href="#"
              role="button">
              {{ __('Nombre') }}
              @include('inclues._sort-icon', ['field' => 'name'])
            </a>
          </th>
          <th scope="col" class="align-middle text-center">
            <a wire:click.prevent="sortBy('email')" href="#"
              role="button">
              {{ __('Email') }}
              @include('inclues._sort-icon', ['field' => 'email'])
            </a>
          </th>
          <th scope="col" class="align-middle text-center">
            <a wire:click.prevent="sortBy('created_at')" href="#"
              role="button">
              {{ __('Creado el') }}
              @include('inclues._sort-icon', [
                  'field' => 'Created_at',
              ])
            </a>
          </th>
          <th scope="col" class="align-middle text-center">
            {{ __('Acciones') }}
          </th>
        </tr>
      </thead>
      <tbody>
        @forelse ($customers as $customer)
          <tr>
            <td class="align-middle text-center">
              {{ $loop->index }}
            </td>
            <td class="align-middle text-center">
              {{ $customer->name }}
            </td>
            <td class="align-middle text-center">
              {{ $customer->email }}
            </td>
            <td class="align-middle text-center">
              {{ $customer->created_at->locale('es')->diffForHumans() }}
            </td>
            <td class="align-middle text-center">
              <x-button.show class="btn-icon"
                route="{{ route('customers.show', $customer->uuid) }}"
                data-bs-toggle="tooltip" data-bs-placement="top"
                title="Ver detalles" />
              <x-button.edit class="btn-icon"
                route="{{ route('customers.edit', $customer->uuid) }}"
                data-bs-toggle="tooltip" data-bs-placement="top"
                title="Editar cliente" />
              <x-button.delete class="btn-icon"
                route="{{ route('customers.destroy', $customer->uuid) }}"
                onclick="return confirm('Are you sure to remove {{ $customer->name }} ?')"
                data-bs-toggle="tooltip" data-bs-placement="top"
                title="Eliminar cliente" />
            </td>
          </tr>
        @empty
          <tr>
            <td class="align-middle text-center" colspan="8">
              No results found
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="card-footer d-flex align-items-center">
    <p class="m-0 text-secondary">
      Mostrando <span>{{ $customers->firstItem() }}</span> -
      <span>{{ $customers->lastItem() }}</span> de
      <span>{{ $customers->total() }}</span> elementos
    </p>

    <ul class="pagination m-0 ms-auto">
      {{ $customers->links() }}
    </ul>
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

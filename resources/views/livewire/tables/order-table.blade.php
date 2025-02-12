<div class="card">
  <div class="card-header">
    <div>
      <h3 class="card-title">
        {{ __('Pedidos') }}
      </h3>
    </div>

    <div class="card-actions">
      <x-action.create route="{{ route('orders.create') }}" />
    </div>
  </div>

  <div class="card-body border-bottom py-3">
    <div class="d-flex">
      <div class="text-secondary">
        mostrar
        <div class="mx-2 d-inline-block">
          <select wire:model.live="perPage" class="form-select form-select-sm"
            aria-label="result per page">
            <option value="5">5</option>
            <option value="10">10</option>
            <option value="15">15</option>
            <option value="25">25</option>
          </select>
        </div>
        entradas
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
            {{ __('No.') }}
          </th>
          <th scope="col" class="align-middle text-center">
            <a wire:click.prevent="sortBy('invoice_no')" href="#"
              role="button">
              {{ __('Factura No.') }}
              @include('inclues._sort-icon', [
                  'field' => 'invoice_no',
              ])
            </a>
          </th>
          <th scope="col" class="align-middle text-center">
            <a wire:click.prevent="sortBy('customer_id')" href="#"
              role="button">
              {{ __('Cliente') }}
              @include('inclues._sort-icon', [
                  'field' => 'customer_id',
              ])
            </a>
          </th>
          <th scope="col" class="align-middle text-center">
            <a wire:click.prevent="sortBy('order_date')" href="#"
              role="button">
              {{ __('Fecha') }}
              @include('inclues._sort-icon', [
                  'field' => 'order_date',
              ])
            </a>
          </th>
          <th scope="col" class="align-middle text-center">
            <a wire:click.prevent="sortBy('payment_type')" href="#"
              role="button">
              {{ __('Pago') }}
              @include('inclues._sort-icon', [
                  'field' => 'payment_type',
              ])
            </a>
          </th>
          <th scope="col" class="align-middle text-center">
            <a wire:click.prevent="sortBy('total')" href="#"
              role="button">
              {{ __('Total') }}
              @include('inclues._sort-icon', ['field' => 'total'])
            </a>
          </th>
          <th scope="col" class="align-middle text-center">
            <a wire:click.prevent="sortBy('order_status')" href="#"
              role="button">
              {{ __('Estado') }}
              @include('inclues._sort-icon', [
                  'field' => 'order_status',
              ])
            </a>
          </th>
          <th scope="col" class="align-middle text-center">
            {{ __('Acción') }}
          </th>
        </tr>
      </thead>
      <tbody>
        @forelse ($orders as $order)
          <tr>
            <td class="align-middle text-center">
              {{ $loop->iteration }}
            </td>
            <td class="align-middle text-center">
              {{ $order->invoice_no }}
            </td>
            <td class="align-middle text-center">
              {{ $order->customer->name }}
            </td>
            <td class="align-middle text-center">
              {{ $order->order_date->format('d-m-Y') }}
            </td>
            <td class="align-middle text-center">
              {{ $order->payment_type }}
            </td>
            <td class="align-middle text-center">
              {{ Number::currency($order->total, 'USD') }}
            </td>
            <td class="align-middle text-center">
              <x-status dot
                color="{{ $order->order_status === \App\Enums\OrderStatus::COMPLETE ? 'green' : ($order->order_status === \App\Enums\OrderStatus::PENDING ? 'orange' : '') }}"
                class="text-uppercase">
                {{ $order->order_status->label() }}
              </x-status>
            </td>
            <td class="align-middle text-center">
              <x-button.show class="btn-icon"
                route="{{ route('orders.show', $order->uuid) }}"
                data-bs-toggle="tooltip" data-bs-placement="top"
                title="Ver detalles" />
              <x-button.print class="btn-icon"
                route="{{ route('order.downloadInvoice', $order->uuid) }}"
                data-bs-toggle="tooltip" data-bs-placement="top"
                title="Imprimir" />
              @if ($order->order_status === \App\Enums\OrderStatus::PENDING)
                <x-button.delete class="btn-icon"
                  route="{{ route('orders.cancel', $order) }}"
                  onclick="return confirm('¿Estás seguro de cancelar la factura no?. {{ $order->invoice_no }} ?')"
                  data-bs-toggle="tooltip" data-bs-placement="top"
                  title="Cancelar" />
              @endif
            </td>
          </tr>
        @empty
          <tr>
            <td class="align-middle text-center" colspan="8">
              No se han encontrado resultados
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <div class="card-footer d-flex align-items-center">
    <p class="m-0 text-secondary">
      Mostrando <span>{{ $orders->firstItem() }}</span> a
      <span>{{ $orders->lastItem() }}</span> de
      <span>{{ $orders->total() }}</span> entradas
    </p>

    <ul class="pagination m-0 ms-auto">
      {{ $orders->links() }}
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

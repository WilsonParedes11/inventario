@extends('layouts.tabler')

@section('content')
  <div class="page-body">
    @if (count($purchases) == 0)
      <x-empty title="No se encontraron compras aprobadas"
        message="Intente ajustar su búsqueda o filtro para encontrar lo que está buscando."
        button_label="{{ __('Agrega tu primera compra') }}"
        button_route="{{ route('purchases.create') }}" />
    @else
      <div class="container-xl">
        <div class="card">
          <div class="card-header">
            <div>
              <h3 class="card-title">
                {{ __('Compras: ') }}
                <span
                  class="btn btn-success btn-sm text-uppercase">{{ __('Aprobadas') }}</span>
              </h3>
            </div>

            <div class="card-actions">
              <a href="{{ route('purchases.create') }}"
                class="btn btn-icon btn-outline-success">
                <svg xmlns="http://www.w3.org/2000/svg"
                  class="icon icon-tabler icon-tabler-plus" width="24"
                  height="24" viewBox="0 0 24 24" stroke-width="2"
                  stroke="currentColor" fill="none" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M12 5l0 14" />
                  <path d="M5 12l14 0" />
                </svg>
              </a>
            </div>
          </div>
          <div class="table-responsive">
            <table
              class="table table-bordered card-table table-vcenter text-nowrap datatable">
              <thead class="thead-light">
                <tr>
                  <th scope="col" class="text-center">No.</th>
                  <th scope="col" class="text-center">COMPRA</th>
                  <th scope="col" class="text-center">PROVEEDOR</th>
                  <th scope="col" class="text-center">FECHA</th>
                  <th scope="col" class="text-center">Total</th>
                  <th scope="col" class="text-center">ACCIÓN</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($purchases as $purchase)
                  <tr>
                    <td class="text-center">
                      {{ $loop->iteration }}
                    </td>
                    <td class="text-center">
                      {{ $purchase->purchase_no }}
                    </td>
                    <td class="text-center">
                      {{ $purchase->supplier->name }}
                    </td>
                    <td class="text-center">
                      {{ $purchase->created_at->format('d-m-Y') }}
                    </td>
                    <td class="text-center">
                      {{ Number::currency($purchase->total_amount, 'USD') }}
                    </td>
                    <td class="text-center">
                      <a href="{{ route('purchases.show', $purchase) }}"
                        class="btn btn-icon btn-outline-info"
                        data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Ver detalles">
                        <svg xmlns="http://www.w3.org/2000/svg"
                          class="icon icon-tabler icon-tabler-eye" width="24"
                          height="24" viewBox="0 0 24 24" stroke-width="2"
                          stroke="currentColor" fill="none"
                          stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                          <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                          <path
                            d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                        </svg>
                      </a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="card-footer">
            {{-- - - --}}
          </div>
        </div>
      </div>
    @endif
  </div>
@endsection
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll(
      '[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  });
</script>

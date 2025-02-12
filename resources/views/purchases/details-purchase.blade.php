@extends('layouts.tabler')

@section('content')
<header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
    <div class="container-xl px-4">
        <div class="page-header-content">
            <div class="row align-items-center justify-content-between pt-3">
                <div class="col-auto mb-3">
                    <h1 class="page-header-title">
                        <div class="page-header-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg></div>
                        Detalles de la compra
                    </h1>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container-xl px-4">
    <div class="row">
        <div class="col-xl-12">
            <div class="card mb-4">
                <div class="card-header">
                    Información del  proveedor
                </div>
                <div class="card-body">
                    <!-- Form Row -->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (supplier name) -->
                        <div class="col-md-6">
                            <label class="small mb-1">Nombre</label>
                            <div class="form-control form-control-solid">{{ $purchase->supplier->name }}</div>
                        </div>
                        <!-- Form Group (supplier email) -->
                        <div class="col-md-6">
                            <label class="small mb-1">Email</label>
                            <div class="form-control form-control-solid">{{ $purchase->supplier->email }}</div>
                        </div>
                    </div>
                    <!-- Form Row -->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (supplier phone number) -->
                        <div class="col-md-6">
                            <label class="small mb-1">Teléfono</label>
                            <div class="form-control form-control-solid">{{ $purchase->supplier->phone }}</div>
                        </div>
                        <!-- Form Group (order date) -->
                        <div class="col-md-6">
                            <label class="small mb-1">Fecha de orden</label>
                            <div class="form-control form-control-solid">{{ $purchase->date }}</div>
                        </div>
                    </div>
                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">No Compra</label>
                            <div class="form-control form-control-solid">{{ $purchase->purchase_no }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Total</label>
                            <div class="form-control form-control-solid">{{ $purchase->total_amount }}</div>
                        </div>
                    </div>

                    <div class="row gx-3 mb-3">
                        <div class="col-md-6">
                            <label class="small mb-1">Creado por</label>
                            <div class="form-control form-control-solid">{{ $purchase->user_created->name }}</div>
                        </div>
                        <div class="col-md-6">
                            <label class="small mb-1">Actualizado por</label>
                            <div class="form-control form-control-solid">{{ $purchase->user_updated ? $purchase->user_updated->name : '-' }}</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label  class="small mb-1">Dirección</label>
                        <div class="form-control form-control-solid">{{ $purchase->supplier->address }}</div>
                    </div>

                    @if ($purchase->purchase_status == 0)
                    <form action="{{ route('purchases.update', ['purchase' => $purchase->id]) }}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="id" value="{{ $purchase->id }}">
                        <!-- Submit button -->
                        {{-- <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to approve this purchase?')">Approve Purchase</button> --}}
                        <a class="btn btn-primary" href="{{ URL::previous() }}">Atrás</a>
                    </form>
                    @else
                    <a class="btn btn-primary" href="{{ URL::previous() }}">Atrás</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-12">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">
                    Lista de productos
                </div>

                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">FOTO</th>
                                        <th scope="col">PRODUCTO</th>
                                        <th scope="col">CÓDIGO DE PRODUCTO</th>
                                        <th scope="col">STOCK ACTUAL</th>
                                        <th scope="col">CANTIDAD</th>
                                        <th scope="col">PRECIO</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchaseDetails as $item)
                                    <tr>
                                        <td scope="row">{{ $loop->iteration  }}</td>
                                        <td scope="row">
                                            <div style="max-height: 80px; max-width: 80px;">
                                                <img class="img-fluid"  src="{{ $item->product->product_image ? asset('storage/products/'.$item->product->product_image) : asset('assets/img/products/default.webp') }}">
                                            </div>
                                        </td>
                                        <td scope="row">{{ $item->product->name }}</td>
                                        <td scope="row">{{ $item->product->code }}</td>
                                        <td scope="row"><span class="btn btn-warning">{{ $item->product->quantity }}</span></td>
                                        <td scope="row"><span class="btn btn-success">{{ $item->quantity }}</span></td>
                                        <td scope="row">{{ $item->unitcost }}</td>
                                        <td scope="row">
                                            <span  class="btn btn-primary">{{ $item->total }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

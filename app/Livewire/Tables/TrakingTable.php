<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Product;
use App\Models\Movement; // Asegúrate de importar el modelo Movement si aún no lo has hecho
use Livewire\WithPagination;

class TrakingTable extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $sortField = 'id';
    public $sortAsc = false;
    public $selectedProductId = null; // Nueva propiedad para almacenar el ID del producto seleccionado

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    public function loadMovements($productId)
    {
        $this->selectedProductId = $productId;
    }

    public function render()
    {
        $products = Product::where("user_id", auth()->id())
            ->with(['category', 'unit'])
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        $movements = []; // Inicializamos $movements con null para evitar errores si no se encuentra ningún producto
        $query = [];
        if ($this->selectedProductId) { // Verificamos si se ha seleccionado un producto
            $query = Product::find($this->selectedProductId);

            if ($query) { // Verificamos si se encontró el producto
                $orderDetails = $query->orderDetails()->select(
                    'id',
                    'created_at as date',
                    'product_id',
                    'quantity',
                    'unitcost',
                    'total'
                )->get()
                    ->map(function ($item) {
                        $item['type'] = 'order';
                        return $item;
                    });

                $purchaseDetails = $query->purchaseDetails()->select(
                    'id',
                    'created_at as date',
                    'product_id',
                    'quantity',
                    'unitcost',
                    'total'
                )->get()
                    ->map(function ($item) {
                        $item['type'] = 'purchase';
                        return $item;
                    });

                $movements = collect();
                foreach ($orderDetails as $detail) {
                    $movements->push($detail);
                }

                foreach ($purchaseDetails as $detail) {
                    $movements->push($detail);
                }
                $movements = $movements->sortByDesc('date');
                $search = $this->search;
                // Aplicar búsqueda al campo 'date' después de ordenar la colección
                $movements = $movements->filter(function ($movement) use ($search) {
                    return stripos($movement['date'], $search) !== false;
                });
            }
        }
        return view('livewire.tables.traking-table', [
            'products' => $products,
            'movements' => $movements,
        ]);
    }
}

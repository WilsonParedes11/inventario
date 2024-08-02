<?php

namespace App\Livewire\Tables;

use Livewire\Component;
use App\Models\Product;
use App\Models\Movement;
use Livewire\WithPagination;

class TrakingTable extends Component
{
    use WithPagination;

    public $perPage = 5;
    public $search = '';
    public $sortField = 'id';
    public $sortAsc = false;
    public $selectedProductId = null;

    public function sortBy($field): void
    {
        if ($this->sortField === $field) {
            $this->sortAsc = !$this->sortAsc;
        } else {
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }

    public function loadMovements($productInput)
    {
        if (is_numeric($productInput)) {
            $this->selectedProductId = $productInput;
        } else {
            $product = Product::where('name', $productInput)->first();
            $this->selectedProductId = $product ? $product->id : null;
        }
    }

    public function render()
    {
        $products = Product::where("user_id", auth()->id())
            ->with(['category', 'unit'])
            ->orderBy($this->sortField, $this->sortAsc ? 'asc' : 'desc')
            ->paginate($this->perPage);

        $movements = [];
        $query = [];
        if ($this->selectedProductId) {
            $query = Product::find($this->selectedProductId);

            if ($query) {
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

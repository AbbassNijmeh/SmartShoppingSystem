@extends('layouts.admin')
@section('body')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <h5 class="mb-3 mb-md-0">Product List</h5>
        <div class="row align-items-center gap-4 py-3 border-bottom mb-3">
            <div class="col-12 col-md-4">
                <a href="{{ route('products.create') }}" class="btn btn-success btn-sm w-100">
                    <i class="bi bi-plus-circle me-1"></i> Add Product
                </a>
            </div>
            <div class="col-12 col-md-4">
                <form action="{{ route('products.import') }}" method="POST" enctype="multipart/form-data"
                    class="d-flex flex-column flex-md-row align-items-center gap-2">
                    @csrf
                    <input type="file" name="file" class="form-control form-control-sm" required>
                    <button type="submit" class="btn btn-outline-primary btn-sm w-100 w-md-auto">
                        <i class="bi bi-upload me-1"></i> Import
                    </button>
                </form>
            </div>
            <div class="col-12 col-md-4">
                <a href="{{ route('products.export') }}" class="btn btn-outline-secondary btn-sm w-100">
                    <i class="bi bi-download me-1"></i> Export
                </a>
            </div>
        </div>


        <table id="example" class="display responsive border text-center small">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Cost Price</th>
                    <th>Selling Price</th>
                    <th>Stock</th>
                    <th>Discount</th>
                    <th>Discount Start</th>
                    <th>Discount End</th>
                    <th>Barcode</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="text-center {{ $product->stock_quantity < 10 ? 'table-danger' : '' }}">
                        <td class="num">{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->cost_price }}</td>
                        <td>{{ $product->price }}</td>
                        <td @if ($product->stock_quantity < 10) class="table-danger" @endif>{{ $product->stock_quantity }}

                        </td>
                        <td>{{ $product->discount }}</td>
                        <td>{{ $product->discount_start }}</td>
                        <td>{{ $product->discount_end }}</td>
                        <td>{{ $product->barcode }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2" id="product-buttons">
                                <a class="btn btn-primary text-light"
                                    href="{{ route('products.show', $product->id) }}">View</a>
                                <button type="button" class="btn btn-warning restock-btn" data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}" data-toggle="modal" data-target="#restockModal">
                                    Restock
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Cost Price</th>
                    <th>Selling Price</th>
                    <th>Stock</th>
                    <th>Discount</th>
                    <th>Discount Start</th>
                    <th>Discount End</th>
                    <th>Barcode</th>
                    <th>Actions</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Restock Modal -->
    <div class="modal fade" id="restockModal" tabindex="-1" aria-labelledby="restockModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="restockModalLabel">Restock Product</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form id="restockForm" action="{{ route('products.restock') }}" method="POST">
                    @csrf
                    <input type="hidden" id="restockProductId" name="product_id">
                    <div class="modal-body">
                        <p id="restockProductName"></p>
                        <label for="restockQuantity" class="form-label">Quantity to Add</label>
                        <input type="number" class="form-control" id="restockQuantity" name="quantity" required
                            min="1">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Restock</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Using event delegation on the document to handle all clicks
            document.addEventListener('click', function(event) {
                if (event.target && event.target.classList.contains('restock-btn')) {
                    const productId = event.target.getAttribute('data-id');
                    const productName = event.target.getAttribute('data-name');

                    // Update modal with the product info
                    document.getElementById('restockProductId').value = productId;
                    document.getElementById('restockProductName').textContent = "Restocking: " +
                        productName;
                }
            });


            // DataTable initialization for the table descedning on id
            // Ensure the table has the correct ID
            const table = document.querySelector('#example');
            if (!table) {
                console.error('Table with ID "example" not found.');
                return;
            }

            new DataTable('#example', {

                    order: [
                        [0, 'desc'] // Sort by the first column (ID) in descending order
                    ],
                    columnDefs: [

                        {
                            targets: [10],
                            orderable: false,
                            searchable: false
                        }
                    ],
                }

            );

        });
    </script>
@endpush

@extends('layouts.admin')
@section('body')
    <nav style="--breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
    </nav>

    <div class="container-fluid">
        <!-- Add Category Button -->
        <div class="d-flex justify-content-between mb-3">
            <h5>Categories:</h5>

            <button class="btn btn-success rounded-pill px-4 py-2 shadow-sm" data-toggle="modal"
                data-target="#addCategoryModal">
                + Add Category
            </button>
        </div>

        <table id="example" class="display responsive category text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Image</th>
                    <th>Total Products</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr class="text-center">
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td> <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                class="img-thumbnail" style="max-width: 100px; height: auto;"></td>
                        <td>{{ $category->products_count }}</td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <!-- Edit button -->
                                <button type="button" class="btn btn-warning" data-toggle="modal"
                                    data-target="#editCategoryModal{{ $category->id }}" title="Edit">
                                    <i class="fas fa-pen"></i>
                                </button>
                                <!-- Edit Category Modal -->
                                <div class="modal fade" id="editCategoryModal{{ $category->id }}" tabindex="-1"
                                    aria-labelledby="editCategoryModalLabel{{ $category->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title text-white"
                                                    id="editCategoryModalLabel{{ $category->id }}">Edit
                                                    Category</h5>
                                                <button type="button" class="btn-close text-dark" data-dismiss="modal"
                                                    aria-label="Close">&times;</button>
                                            </div>
                                            <form action="{{ route('categories.update', $category->id) }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="category_name_{{ $category->id }}"
                                                            class="form-label">Category Name</label>
                                                        <input type="text" class="form-control"
                                                            id="category_name_{{ $category->id }}" name="name"
                                                            value="{{ $category->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="image_{{ $category->id }}" class="form-label">Category
                                                            Image (Optional)</label>
                                                        <input type="file" class="form-control"
                                                            id="image_{{ $category->id }}" name="image">
                                                        <small class="form-text text-muted">Current image:
                                                            {{ $category->image }}</small>
                                                        @if ($category->image)
                                                            <img src="{{ asset('storage/' . $category->image) }}"
                                                                alt="{{ $category->name }}" class="img-thumbnail mt-2"
                                                                style="max-width: 100px; height: auto;">
                                                        @else
                                                            <p class="text-muted mt-2">No image uploaded.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Update Category</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $category->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $category->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $category->id }}">Confirm
                                                    Deletion</h5>
                                                <button type="button" class="btn-close text-danger" data-dismiss="modal"
                                                    aria-label="Close">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                Are you sure you want to delete <strong>{{ $category->name }}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                                                </form>
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Delete button with conditional disable and modal trigger -->
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#deleteModal{{ $category->id }}" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Image</th>
                    <th>Total products</th>
                    <th>&nbsp;</th>

                </tr>
            </tfoot>
        </table>
    </div>


    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCategoryModalLabel">Add New Category</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="category_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Category Image</label>
                            <input type="file" class="form-control" id="image" name="image" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        new DataTable('#example', {
            order: [
                [0, 'desc'] // Sort by the first column (ID) in descending order
            ],
            columnDefs: [

                {
                    targets: [2, 4],
                    orderable: false,
                    searchable: false
                }
            ],
        });
    </script>
@endpush

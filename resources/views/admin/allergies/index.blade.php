@extends('layouts.admin')

@section('body')
    <div class="container-fluid ">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light p-3 rounded">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Manage Allergies & Ingredients</li>
            </ol>
        </nav>
        <p class="h4 text-center p-2">

            <i class="fas fa-allergies"></i> Manage Allergies & Ingredients
        </p>

        <div class="row align-items-center py-2">
            <div class="col-md-3 d-flex align-items-center">
                <h5 class="mb-0"><strong>Allergies List</strong></h5>
            </div>
            <div class="col-md-3">
                <button class="btn btn-success w-100" data-toggle="modal" data-target="#addAllergyModal">Add
                    Allergy</button>
            </div>
            <div class="col-md-3 d-flex align-items-center">
                <h5 class="mb-0"><strong>Ingredients List</strong></h5>
            </div>
            <div class="col-md-3">
                <button class="btn btn-success w-100" data-toggle="modal" data-target="#addIngredientModal">Add
                    Ingredient</button>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <table class="display responsive border " id="example" style="width: 100%;">
            <thead>
                <tr>
                    <th>Allergy</th>
                    <th>Caused by Ingredients</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allergies as $allergy)
                    <tr>
                        <td>{{ $allergy->name }}</td>
                        <td>{{ $allergy->ingredients->pluck('name')->join(', ') ?? 'N/A' }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" data-toggle="modal"
                                data-target="#editAllergyModal{{ $allergy->id }}">Edit</button>
                            <form action="{{ route('allergies.destroy', $allergy->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Allergy Modal -->
                    <div class="modal fade" id="editAllergyModal{{ $allergy->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Allergy</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal">&times;</button>
                                </div>
                                <form method="POST" action="{{ route('allergies.update', $allergy->id) }}">
                                    @csrf @method('PUT')
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Allergy Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $allergy->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Caused by Ingredients</label>
                                            <select name="ingredients[]" class="form-control select2" multiple
                                                style="width: 100%;">
                                                @foreach ($ingredients as $ingredient)
                                                    <option value="{{ $ingredient->id }}"
                                                        @if ($allergy->ingredients->contains($ingredient->id)) selected @endif>
                                                        {{ $ingredient->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>

    </div>

    <!-- Add Allergy Modal -->
    <div class="modal fade" id="addAllergyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Allergy</h5>
                    <button type="button" class="btn-close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="{{ route('allergies.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Allergy Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Caused by Ingredients</label>
                            <select name="ingredients[]" class="form-control select2" multiple style="width: 100%;">
                                @foreach ($ingredients as $ingredient)
                                    <option value="{{ $ingredient->id }}">{{ $ingredient->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Add Ingredient Modal -->
    <div class="modal fade" id="addIngredientModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Ingredient</h5>
                    <button type="button" class="btn-close" data-dismiss="modal">&times;</button>
                </div>
                <form method="POST" action="{{ route('ingredients.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Ingredient Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            new DataTable('#example');
            $('.select2').select2();
        });
    </script>
@endpush

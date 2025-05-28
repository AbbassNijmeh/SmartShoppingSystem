@extends('layouts.admin')
@section('body')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Orders</li>
        </ol>
    </nav>


    <div class="container-fluid">
        <table id="example" class="display responsive border text-center" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Status</th>
                    <th>Total Price</th>
                    <th>Created At</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr class="text-center @if ($order->status == 'pending') table-danger @endif">
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>{{ $order->user->phone }}</td>
                        <td>
                            @if ($order->status == 'ready')
                                Ready (No delivery required)
                            @elseif($order->status == 'pending')
                                pending -
                                <button class="btn btn-sm btn-primary approve-delivery" data-toggle="modal"
                                    data-target="#deliveryModal-{{ $order->id }}">
                                    Choose Delivery Guy
                                </button>
                            @elseif($order->status == 'delivered')
                                Delivered
                            @elseif ($order->status == 'not_paid')
                                @if ($order->userAddress)
                                    not paid-
                                    <button class="btn btn-sm btn-danger approve-delivery" data-toggle="modal"
                                        data-target="#deliveryModal-{{ $order->id }}">
                                        Assign Delivery
                                    </button>
                                @else
                                    <form method="POST"
                                        action="{{ route('admin.orders.markAsPaid', ['order' => $order->id]) }}"
                                        class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">Mark as Paid</button>
                                    </form>
                                @endif
                                @else
                                {{ ucfirst($order->status) }}
                            @endif

                        </td>
                        <td>{{ $order->total_price }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <div class="btn btn-primary "><a class="text-light"
                                    href="{{ route('admin.orders.show', $order->id) }}">View</a></div>


                        </td>
                    </tr>

                    <!-- Delivery Modal -->
                    <div class="modal fade" id="deliveryModal-{{ $order->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Assign Delivery for Order #{{ $order->id }}</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal">&times;</button>
                                </div>
                                <form action="{{ route('admin.orders.sendToDelivery') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{ $order->id }}">
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Select Delivery Agent</label>
                                            <select class="form-select" name="delivery_guy_id" required>
                                                <option value="">Choose...</option>
                                                @foreach ($deliveryUsers as $delivery)
                                                    <option value="{{ $delivery->id }}">{{ $delivery->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Assign Delivery</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Status</th>
                    <th>Total Price</th>
                    <th>Created At</th>
                    <th>&nbsp;</th>
                </tr>
            </tfoot>
        </table>
    </div>
@endsection
@push('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <!-- Optional: Responsive extension -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    <!-- Your custom sort script -->
    <script>
        $.fn.dataTable.ext.order['status-priority'] = function(settings, col) {
            return this.api().column(col, {
                order: 'index'
            }).nodes().map(function(td) {
                const rawText = $('<div>').html($(td).html()).text().trim().toLowerCase();
                const status = rawText.split('-')[0].trim();

                switch (status) {
                    case 'pending':
                        return 0;
                    case 'ready':
                        return 1;
                    case 'delivered':
                        return 2;
                    default:
                        return 999;
                }
            });
        };

        $(document).ready(function() {
            $('#example').DataTable({
                responsive: true,
                order: [
                    [3, 'asc']
                ],
                columnDefs: [{
                        targets: 3,
                        orderDataType: 'status-priority'
                    },
                    {
                        targets: 6,
                        orderable: false,
                        searchable: false
                    }
                ]
            });
        });
    </script>
@endpush

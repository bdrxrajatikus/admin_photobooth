    @extends('layouts.master')

    @section('content')

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title">Data Voucher</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bx bx-book-add"></i> Tambah Voucher
                    </button>
                </div>
                <!-- Table with stripped rows -->
                <div class="datatable-wrapper datatable-loading no-footer sortable searchable fixed-columns">
                    <div class="datatable-top">
                        <div class="datatable-dropdown">
                            <label>
                                <select class="datatable-selector">
                                    <option value="5">5</option>
                                    <option value="10" selected="">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                </select> entries per page
                            </label>
                        </div>
                        <div class="datatable-search">
                            <input id="searchInput" name="searchInput" class="datatable-input" placeholder="Search..." type="search" title="Search within table">
                        </div>
                    </div>
                    <div class="datatable-container">
                        <table id="voucherTable" class="table datatable datatable-table">
                            <thead>
                                <tr>
                                    <th data-sortable="true" aria-sort="ascending" class="datatable-ascending">
                                        <a href="#" class="datatable-sorter">No</a>
                                    </th>
                                    <th data-sortable="true">
                                        <a href="#" class="datatable-sorter">Promo Code</a>
                                    </th>
                                    <th data-sortable="true">
                                        <a href="#" class="datatable-sorter">Promo Name</a>
                                    </th>
                                    <th data-sortable="true">
                                        <a href="#" class="datatable-sorter">Quantity</a>
                                    </th>
                                    <th data-sortable="true">
                                        <a href="#" class="datatable-sorter">Amount</a>
                                    </th>
                                    <th data-sortable="true">
                                        <a href="#" class="datatable-sorter">Action</a>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vouchers as $index => $voucher)
                                    <tr data-index="{{ $index }}">
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $voucher->promo_code }}</td>
                                        <td>{{ $voucher->promo_name }}</td>
                                        <td>{{ $voucher->qty }}</td>
                                        <td>{{ $voucher->amount }}</td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" onclick="showEditModal({{ $voucher->id }}, '{{ $voucher->promo_code }}', '{{ $voucher->promo_name }}', '{{ $voucher->description }}', {{ $voucher->qty }}, {{ $voucher->is_percentage ? 'true' : 'false' }}, {{ $voucher->amount }})">Edit</button>
                                            <form action="{{ route('vouchers.destroy', $voucher->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus ?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="datatable-bottom">
                        <div class="datatable-info">Showing 1 to {{ count($vouchers) }} of {{ count($vouchers) }} entries</div>
                        <nav class="datatable-pagination">
                            <ul class="datatable-pagination-list"></ul>
                        </nav>
                    </div>
                </div>
                <!-- End Table with stripped rows -->

                </div>
            </div>

            </div>
        </div>
        </section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Voucher</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tambah Voucher</h5>

                    <!-- Form untuk menambahkan voucher -->
                    <form action="{{ route('vouchers.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="promo_code" class="form-label">Promo Code</label>
                            <input type="text" class="form-control" id="promo_code" name="promo_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="promo_name" class="form-label">Promo Name</label>
                            <input type="text" class="form-control" id="promo_name" name="promo_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="qty" name="qty" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="is_percentage" class="form-label">Is Percentage</label>
                            <select class="form-control" id="is_percentage" name="is_percentage" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required min="0.01">
                        </div>
                        <!-- Tambahkan elemen formulir lainnya sesuai kebutuhan -->
                        
                        <!-- Akhir Form -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Voucher</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Voucher</h5>

                    <!-- Form untuk mengedit voucher -->
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT') <!-- Gunakan metode PUT untuk mengirimkan perubahan -->
                        <div class="mb-3">
                            <label for="edit_promo_code" class="form-label">Promo Code</label>
                            <input type="text" class="form-control" id="edit_promo_code" name="promo_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_promo_name" class="form-label">Promo Name</label>
                            <input type="text" class="form-control" id="edit_promo_name" name="promo_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_description" class="form-label">Description</label>
                            <textarea class="form-control" id="edit_description" name="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="edit_qty" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="edit_qty" name="qty" required min="1">
                        </div>
                        <div class="mb-3">
                            <label for="edit_is_percentage" class="form-label">Is Percentage</label>
                            <select class="form-control" id="edit_is_percentage" name="is_percentage" required>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_amount" class="form-label">Amount</label>
                            <input type="number" step="0.01" class="form-control" id="edit_amount" name="amount" required min="0.01">
                        </div>
                        <!-- Tambahkan elemen formulir lainnya sesuai kebutuhan -->
                        
                        <!-- Akhir Form -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
    </div>

    <script>
        // Fungsi untuk menampilkan data voucher dalam modal edit
        function showEditModal(id, promo_code, promo_name, description, qty, is_percentage, amount) {
            $('#editModal').modal('show'); // Tampilkan modal edit
            // Isi data voucher ke dalam formulir edit
            $('#editForm').attr('action', '/vouchers/' + id); // Set action form sesuai dengan rute edit
            $('#edit_promo_code').val(promo_code);
            $('#edit_promo_name').val(promo_name);
            $('#edit_description').val(description);
            $('#edit_qty').val(qty);
            $('#edit_is_percentage').val(is_percentage);
            $('#edit_amount').val(amount);
        }
    </script>

    <script>
        $(document).ready(function() {
            var table = $('#voucherTable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "info": true,
            "search": {       
                "caseInsensitive": true,  // Gunakan pencarian tanpa memperhatikan huruf besar/kecil
                "regex": false,           // Nonaktifkan pencarian menggunakan regex
                "smart": true             // Aktifkan pencarian pintar (smart)
            }
        });

    // Mengaktifkan pencarian pada kolom Promo Code dan Promo Name
    table.columns([1, 2]).every(function() {
        var column = this;
            $('<input type="text" class="form-control">')
                .appendTo($(column.footer()).empty())
                .on('keyup change', function() {
                    column.search(this.value, false, true).draw(); // Parameter kedua adalah untuk pencarian caseInsensitive
            });
        });
    });

    </script>


    @stop

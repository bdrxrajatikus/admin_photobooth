@extends('layouts.master')

@section('content')
<section class="section">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Master Harga</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bx bx-book-add"></i> Tambah Harga
                    </button>
                </div>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Application Name</th>
                            <th>Master Price</th>
                            <th>Homepage Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($settings as $index => $setting)
                        <tr data-index="{{ $index }}">
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $setting->application_name }}</td>
                            <td>{{ $setting->master_price }}</td>
                            <td>
                                @if ($setting->homepage_image)
                                <img src="{{ asset('storage/' . $setting->homepage_image) }}" alt="Homepage Image" width="100">
                                @else
                                No Image
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm"
                                    onclick="showEditModal({{ $setting->id }}, '{{ $setting->application_name }}', {{ $setting->master_price }}, '{{ $setting->homepage_image }}')">Edit</button>
                                <form action="{{ route('settings.destroy', $setting->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin mau dihapus ?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Harga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Harga</h5>

                        <!-- Form untuk menambahkan setting -->
                        <form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="application_name" class="form-label">Application Name</label>
                                <input type="text" class="form-control" id="application_name" name="application_name"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="master_price" class="form-label">Master Price</label>
                                <input type="number" step="0.01" class="form-control" id="master_price"
                                    name="master_price" required min="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="homepage_image" class="form-label">Homepage Image</label>
                                <input type="file" class="form-control" id="homepage_image" name="homepage_image">
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
                <h5 class="modal-title" id="editModalLabel">Edit Harga</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit Harga</h5>

                        <!-- Form untuk mengedit setting -->
                        <form id="editForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') <!-- Gunakan metode PUT untuk mengirimkan perubahan -->
                            <div class="mb-3">
                                <label for="edit_application_name" class="form-label">Application Name</label>
                                <input type="text" class="form-control" id="edit_application_name"
                                    name="application_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="edit_master_price" class="form-label">Master Price</label>
                                <input type="number" step="0.01" class="form-control" id="edit_master_price"
                                    name="master_price" required min="0.01">
                            </div>
                            <div class="mb-3">
                                <label for="edit_homepage_image" class="form-label">Homepage Image</label>
                                <input type="file" class="form-control" id="edit_homepage_image" name="homepage_image">
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
@stop
@section('footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Fungsi untuk menampilkan data setting dalam modal edit
    function showEditModal(id, application_name, master_price, homepage_image) {
        $('#editModal').modal('show'); // Tampilkan modal edit
        // Isi data setting ke dalam formulir edit
        $('#editForm').attr('action', '{{ route('settings.update', '') }}/' + id); // Set action form sesuai dengan rute edit
        $('#edit_application_name').val(application_name);
        $('#edit_master_price').val(master_price);

        // Check if homepage_image exists and set the preview
        if (homepage_image) {
            $('#edit_homepage_image').attr('value', ''); // Clear the file input value
        } else {
            $('#edit_homepage_image').val('');
        }
    }
</script>
<script>
    $(document).ready(function () {
        var table = $('.datatable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "info": true,
            "search": {
                "caseInsensitive": true,
                "regex": false,
                "smart": true
            }
        });

        // Mengaktifkan pencarian pada kolom Application Name
        table.columns(1).every(function () {
            var column = this;
            $('<input type="text" class="form-control">')
                .appendTo($(column.footer()).empty())
                .on('keyup change', function () {
                    column.search(this.value, false, true).draw();
                });
        });
    });
</script>
@endsection

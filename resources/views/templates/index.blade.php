@extends('layouts.master')

@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Data Template</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bx bi-file-earmark-image-fill"></i> Tambah Template
                    </button>
                </div>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th data-sortable="true" aria-sort="ascending" class="datatable-ascending">
                                <a href="#" class="datatable-sorter">No</a>
                            </th>
                            <th data-sortable="true">
                                <a href="#" class="datatable-sorter">Name</a>
                            </th>
                            <th data-sortable="true">
                                <a href="#" class="datatable-sorter">Image</a>
                            </th>
                            <th data-sortable="true">
                                <a href="#" class="datatable-sorter">Action</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($templates as $index => $template)
                            <tr data-index="{{ $index }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $template->name }}</td>
                                <td><img src="{{ asset('images/' . $template->image) }}" alt="{{ $template->name }}" width="100"></td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" onclick="showEditModal('{{ $template->id }}', '{{ $template->name }}', '{{ $template->image }}')">Edit</button>
                                    <form action="{{ route('templates.destroy', $template->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau dihapus ?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- End Table with stripped rows -->
            </div>
        </div>
    </div>
</section>

<!-- Modal Tambah Template -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Isi modal sesuai kebutuhan Anda -->
            <form action="{{ route('templates.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk menambah template -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                    <!-- Akhir Form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit Template -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Isi modal sesuai kebutuhan Anda -->
            <form id="editForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Template</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form untuk mengedit template -->
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_image" class="form-label">Image</label>
                        <input type="file" class="form-control" id="edit_image" name="image">
                    </div>
                    <div class="mb-3">
                        <label for="edit_image_preview" class="form-label">Current Image</label>
                        <img src="" alt="Current Image" id="edit_image_preview" style="max-width: 100px;">
                    </div>
                    <!-- Akhir Form -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Fungsi untuk menampilkan data template dalam modal edit
    function showEditModal(id, name, image) {
    $('#editModal').modal('show'); // Tampilkan modal edit
    // Isi data template ke dalam formulir edit
    $('#editForm').attr('action', '/templates/' + id); // Set action form sesuai dengan rute edit
    $('#edit_name').val(name);

    // Tampilkan gambar template yang ada
    var imageUrl = "{{ asset('images/') }}" + '/' + image;
    $('#edit_image_preview').attr('src', imageUrl);

    // Inisialisasi input gambar saat modal edit ditampilkan
    $('#edit_image').change(function () {
        var input = this;
        var url = URL.createObjectURL(input.files[0]);
        $('#edit_image_preview').attr('src', url);
    });
}

</script>
@endsection

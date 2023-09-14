@extends('layouts.master')

@section('content')

<section class="section">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h5 class="card-title">Data User</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="bx ri-user-add-fill"></i> Tambah User
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
                                <a href="#" class="datatable-sorter">Email</a>
                            </th>
                            <th data-sortable="true">
                                <a href="#" class="datatable-sorter">Level</a>
                            </th>
                            <th data-sortable="true">
                                <a href="#" class="datatable-sorter">Action</a>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $user)
                            <tr data-index="{{ $index }}">
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->level }}</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-sm" onclick="showEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->level }}')">Edit</button>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
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
        </div>
    </div>
</section>

<!-- Modal Tambah User -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk menambahkan user -->
                <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="level" class="form-label">Level</label>
                        <select class="form-control" id="level" name="level" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="image" name="image">
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

<!-- Modal Edit User -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk mengedit user -->
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Gunakan metode PUT untuk mengirimkan perubahan -->
                    <div class="mb-3">
                        <label for="edit_name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="edit_name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="edit_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="edit_password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_level" class="form-label">Level</label>
                        <select class="form-control" id="edit_level" name="level" required>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Profile Image</label>
                        <input type="file" class="form-control" id="image" name="image">
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
@stop
@section('footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Fungsi untuk menampilkan data user dalam modal edit
    function showEditModal(id, name, email, level, image) {
        $('#editModal').modal('show'); // Tampilkan modal edit
        // Isi data user ke dalam formulir edit
        $('#editForm').attr('action', '/users/' + id); // Set action form sesuai dengan rute edit
        $('#edit_name').val(name);
        $('#edit_email').val(email);
        $('#edit_level').val(level);
        $('#edit_image').val(image);
    }
</script>
@endsection

@extends('layouts.master')

@section('content')
<section class="section profile">
    <div class="row">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="{{ asset($user->image) }}" alt="Profile" class="rounded-circle">
                    <h2>{{ $user->name }}</h2>
                    <!-- Tampilkan peran pengguna jika ada -->
                    @if ($user->level)
                        <h3>{{ $user->level }}</h3>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit" aria-selected="true" role="tab">Edit Profile</button>
                        </li>
                    </ul>

                    <div class="tab-pane fade profile-edit pt-3 active show" id="profile-edit" role="tabpanel">
                    <!-- Profile Edit Form -->
                    <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Gambar profil -->
                        <div class="row mb-3">
                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                            <div class="col-md-8 col-lg-9">
                                <img src="{{ asset($user->image) }}" alt="Profile" id="previewImage" class="rounded-circle">
                                <div class="pt-2">
                                    <input type="file" name="image" id="profileImage" style="display: none;">
                                    <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" id="uploadButton"><i class="bi bi-upload"></i></a>
                                    <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image" id="removeButton"><i class="bi bi-trash"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Nama -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="name" type="text" class="form-control" id="name" value="{{ $user->name }}">
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="email" type="email" class="form-control" id="email" value="{{ $user->email }}">
                            </div>
                        </div>

                        <!-- New Password -->
                        <div class="row mb-3">
                            <label for="new_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="new_password" type="password" class="form-control" id="new_password">
                            </div>
                        </div>

                        <!-- Confirm New Password -->
                        <div class="row mb-3">
                            <label for="new_password_confirmation" class="col-md-4 col-lg-3 col-form-label">Confirm New Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="new_password_confirmation" type="password" class="form-control" id="new_password_confirmation">
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div><!-- End Bordered Tabs -->
            </div>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const profileImageInput = document.getElementById('profileImage');
        const previewImage = document.getElementById('previewImage');
        const uploadButton = document.getElementById('uploadButton');
        const removeButton = document.getElementById('removeButton');

        // Tampilkan gambar yang dipilih saat memilih gambar
        profileImageInput.addEventListener('change', function() {
            const file = profileImageInput.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        // Buka dialog unggah gambar saat mengklik tombol "Upload"
        uploadButton.addEventListener('click', function(e) {
            e.preventDefault();
            profileImageInput.click();
        });

        // Hapus gambar profil saat mengklik tombol "Hapus"
        removeButton.addEventListener('click', function(e) {
            e.preventDefault();
            previewImage.src = "{{ asset('images_profile/default.jpg') }}"; // Ganti dengan gambar profil default Anda
            profileImageInput.value = null; // Bersihkan input file
        });
    });
</script>

@stop
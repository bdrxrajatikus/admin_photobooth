@extends('layouts.master')

@section('content')
<div class="row">
<!-- Left side columns -->
    <div class="col-lg-8">
        <div class="row">
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card sales-card">
                    <div class="filter">
                        <a class="icon" href="#" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item filter-dropdown-item-total-voucher" data-filter="all" href="#">All</a></li>
                            <li><a class="dropdown-item filter-dropdown-item-total-voucher" data-filter="today" href="#">Today</a></li>
                            <li><a class="dropdown-item filter-dropdown-item-total-voucher" data-filter="month" href="#">This Month</a></li>
                            <li><a class="dropdown-item filter-dropdown-item-total-voucher" data-filter="year" href="#">This Year</a></li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Total Voucher</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-cart"></i>
                            </div>
                            <div class="ps-3">
                                <h6 class="h6-total-voucher">{{ $data['totalVoucher'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>            
            </div>
            <div class="col-xxl-4 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="filter">
                        <a class="icon" href="#" id="filterDropdown" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <li class="dropdown-header text-start">
                                <h6>Filter</h6>
                            </li>
                            <li><a class="dropdown-item filter-dropdown-item-total-revenue" data-filter="today" href="#">Today</a></li>
                            <li><a class="dropdown-item filter-dropdown-item-total-revenue" data-filter="month" href="#">This Month</a></li>
                            <li><a class="dropdown-item filter-dropdown-item-total-revenue" data-filter="year" href="#">This Year</a></li>
                        </ul>
                    </div>

                    <div class="card-body">
                    <h5 class="card-title">Total Transaksi</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-currency-dollar"></i>
                            </div>
                            <div class="ps-3">
                                <h6 class="h6-total-revenue">Rp {{ $data['totalRevenue'] }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Right side columns -->
    <div class="col-lg-4">
    </div>
        
    </div>  
</div>

@stop
@section('footer')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.filter-dropdown-item-total-voucher').click(function () {
            var filter = $(this).data('filter');

            $.ajax({
                url: '/getTotalVoucher', // Rute yang mengambil data total voucher
                type: 'GET', // Ubah metode menjadi GET
                data: { filter: filter }, // Kirim filter ke server
                dataType: 'json', // Tipe data yang diharapkan dari server
                success: function (response) {
                    if (response.success) {
                        // Perbarui tampilan dengan data total voucher yang diterima dari server
                        $('.h6-total-voucher').html(response.totalVoucher);
                    }
                },
                error: function () {
                    // Handle error jika permintaan gagal
                }
            });
        });

        $('.filter-dropdown-item-total-revenue').click(function () {
            var filter = $(this).data('filter');

            $.ajax({
                url: '/getTotalRevenue', // Rute yang mengambil data total transaksi
                type: 'GET', // Ubah metode menjadi GET
                data: { filter: filter }, // Kirim filter ke server
                dataType: 'json', // Tipe data yang diharapkan dari server
                success: function (response) {
                    if (response.success) {
                        // Perbarui tampilan dengan data total transaksi yang diterima dari server
                        $('.h6-total-revenue').html(response.totalRevenue);
                    }
                },
                error: function () {
                    // Handle error jika permintaan gagal
                }
            });
        });
    });

</script>
@endsection

@extends('layouts.master')
@section('title')
    @lang('translation.Dashboard')
@endsection
@section('content')
    @component('common-components.breadcrumb')
        @slot('pagetitle')
            SIMAWA
        @endslot
        @slot('title')
            Kelola Talenta
        @endslot
    @endcomponent
    <style type="text/css">
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1005; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: 6% auto; /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 40%; /* Could be more or less, depending on screen size */
        }

        /* The Close Button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .br{
            margin-top: 2%;
        }
        .title-talenta{
            font-size: 25px;
            text-align: center;
            margin-bottom: 2%;
        }
        table{
            width: 100%
        }
        label{
            display: block;
            text-align: center;
        }
    </style>
    <button class='btn btn-primary' id="openModalBtn">Tambah Talenta</button>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div class="title-talenta">Tambah Talenta</div>
            <form method="POST">
                <table class="form-table">
                    <tr>
                        <td><label for="nama">Nama Kegiatan</label></td>
                        <td><input type="text" class="form-control br" id="nama" name="nama" placeholder="Nama Kegiatan" required></td>
                    </tr>
                    <tr>
                        <td><label for="singkatan">Singkatan Kegiatan</label></td>
                        <td><input type="text" class="form-control br" id="singkatan" name="singkatan" placeholder="Singkatan Kegiatan" required></td>
                    </tr>
                    <tr>
                        <td><label for="kategori">Kategori</label></td>
                        <td>
                            <select class="form-control br" id="kategori" name="kategori" required>
                                <option hidden>--- Pilih Kategori ---</option>
                                <option value="Riset dan Inovasi">Riset dan Inovasi</option>
                                <option value="Seni Budaya">Seni Budaya</option>
                                <option value="Olahraga">Olahraga</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="subkategori">Subkategori</label></td>
                        <td>
                            <select class="form-control br" id="subkategori" name="subkategori" required>
                                <option hidden>--- Pilih Subkategori ---</option>
                                <option value="Karya Tulis Ilmiah">Karya Tulis Ilmiah</option>
                                <option value="Esai Ilmiah">Esai Ilmiah</option>
                                <option value="Ulasan Literatur">Ulasan Literatur</option>
                                <option value="Olimpiade">Olimpiade</option>
                                <option value="Debat">Debat</option>
                                <option value="Cerdas Cermat">Cerdas Cermat</option>
                                <option value="Analisis Data">Analisis Data</option>
                                <option value="Fotografi">Fotografi</option>
                                <option value="Videografi">Videografi</option>
                                <option value="Poster">Poster</option>
                                <option value="Bisnis / Kewirausahaan">Bisnis / Kewirausahaan</option>
                                <option value="Seni Suara">Seni Suara</option>
                                <option value="Seni Gerak">Seni Gerak</option>
                                <option value="Seni Lukis">Seni Lukis</option>
                                <option value="Seni Rupa">Seni Rupa</option>
                                <option value="Sastra">Sastra</option>
                                <option value="Penyiaran / Presentasi">Penyiaran / Presentasi</option>
                                <option value="Hackathon">Hackathon</option>
                                <option value="Desain Aplikasi">Desain Aplikasi</option>
                                <option value="Desain Alat">Desain Alat</option>
                                <option value="Desain Produk">Desain Produk</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="penyelenggara">Penyelenggara Kegiatan</label></td>
                        <td><input type="text" class="form-control br" id="penyelenggara" name="penyelenggara" placeholder="Penyelenggara Kegiatan" required></td>
                    </tr>
                    <tr>
                        <td><label for="tempat">Tempat Kegiatan</label></td>
                        <td><input type="text" class="form-control br" id="tempat" name="tempat" placeholder="Tempat Kegiatan" required></td>
                    </tr>
                    <tr>
                        <td><label for="kategori_periode">Kategori Periode</label></td>
                        <td>
                            <select class="form-control br" id="kategori_periode" name="kategori_periode" required>
                                <option hidden>--- Pilih Kategori Periode ---</option>
                                <option value="Januari">Januari <script>document.write(new Date().getFullYear())</script></option>
                                <option value="Februari">Februari <script>document.write(new Date().getFullYear())</script></option>
                                <option value="Maret">Maret <script>document.write(new Date().getFullYear())</script></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><label for="tmulai">Tanggal Mulai</label></td>
                        <td><input type="date" class="form-control" id="tmulai" name="tmulai"></td>
                    </tr>
                    <tr>
                        <td><label for="takhir">Tanggal Akhir</label></td>
                        <td><input type="date" class="form-control" id="takhir" name="takhir"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>

    <script type="text/javascript">
    // Dapatkan modal
    var modal = document.getElementById("myModal");

    // Dapatkan tombol yang membuka modal
    var btn = document.getElementById("openModalBtn");

    // Dapatkan elemen <span> yang menutup modal
    var span = document.getElementsByClassName("close")[0];

    // Ketika tombol diklik, buka modal
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Ketika pengguna mengklik <span> (x), tutup modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Ketika pengguna mengklik di luar modal, tutup modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

</script>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
@endsection

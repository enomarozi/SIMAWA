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
            Profile
        @endslot
    @endcomponent
    <div class="table-responsive">
    <table class="table">
      <tbody>
        <tr>
          <th scope="row">Nama</th>
          <td>{{ session()->get('nama') }}</td>
        </tr>
        <tr>
          <th scope="row">NIM/NIP</th>
          <td>{{ session()->get('nim') }}</td>
        </tr>
        <tr>
          <th scope="row">Prodi</th>
          <td>{{ session()->get('prodi') }}</td>
        </tr>
        <tr>
          <th scope="row">Jenjang</th>
          <td>{{ session()->get('jenjang') }}</td>
        </tr>
      </tbody>
    </table>
  </div>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/pages/dashboard.init.js') }}"></script>
@endsection

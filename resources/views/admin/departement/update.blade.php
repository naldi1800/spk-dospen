@extends('template.main')
@section('container')
    <h1>Update Jurusan</h1>
    <h6><span class="text-danger">*</span> wajib diisi</h6>
    <form class="row g-3 needs-validation" action="/{{ $page }}/{{ $data->id }}" method="POST" novalidate>
        @method('PUT')
        @csrf
        <div class="col-md-12">
            <label for="department_name" class="form-label">Nama Jurusan<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="department_name" name="department_name" value="{{ $data->department_name }}"
                required>
            <div class="invalid-feedback">
                Masukan nama Jurusan!!!
            </div>
        </div>

        <div class="col-md-12">
            <label for="singkatan" class="form-label">Singkatan Jurusan<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="singkatan" name="singkatan" value="{{ $data->singkatan }}"
                required>
            <div class="invalid-feedback">
                Masukan Singkatan Jurusan!!!
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>
@endsection

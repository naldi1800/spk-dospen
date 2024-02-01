@extends('template.main')
@section('container')
    <h1>Update Keahlian</h1>
    <h6><span class="text-danger">*</span> wajib diisi</h6>
    <form class="row g-3 needs-validation" action="/skill/{{$data->id}}" method="POST" novalidate>
        @method('PUT')
        @csrf
        <div class="col-md-12">
            <label for="skill_name" class="form-label">Nama Keahlian<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="skill_name" name="skill_name" value="{{$data->skill_name}}" required>
            <div class="invalid-feedback">
                Masukan nama keahlian!!!
            </div>
        </div>

        <div class="col-md-12">
            <label for="singkatan" class="form-label">Singkatan Keahlian<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="singkatan" name="singkatan" value="{{$data->singkatan}}" required>
            <div class="invalid-feedback">
                Masukan Singkatan keahlian!!!
            </div>
        </div>
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>

@endsection

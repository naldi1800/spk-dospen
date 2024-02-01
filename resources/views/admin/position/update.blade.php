@extends('template.main')
@section('container')
    <h1>Tambah Jabatan</h1>
    <h6><span class="text-danger">*</span> wajib diisi</h6>
    <form class="row g-3 needs-validation" action="/{{ $page }}/{{$data->id}}" method="POST" novalidate>
        @method('PUT')
        @csrf
        <div class="col-md-12">
            <label for="position_name" class="form-label">Nama Jabatan<span class="text-danger">*</span></label>
            <input type="text" class="form-control" value="{{ $data->position_name }}" id="position_name"
                name="position_name" required>
            <div class="invalid-feedback">
                Masukan nama jabatan!!!
            </div>
        </div>

        <div class="col-md-12">
            <label for="level" class="form-label">Level<span class="text-danger">*</span></label>
            <input type="number" min="1" class="form-control" value="{{ $data->level }}" id="level" name="level"
                required>
            <div class="invalid-feedback">
                Masukan level!!!
            </div>
        </div>

        <div class="col-md-12">
            <label for="control" class="form-label">Pengontrol<span class="text-danger">*</span></label>
            <select name="control" id="control" class="form-select">
                <option value="0" {{ $data->control == 0 ? 'selected' : '' }}>YAYASAN</option>
                @foreach ($dataposition as $d)
                    <option value="{{ $d->id }}" {{ $data->control == $d->id ? 'selected' : '' }}>
                        {{ $d->position_name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Masukan control!!!
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>
@endsection

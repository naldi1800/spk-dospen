@extends('template.main')
@section('container')
    <h1>Update Judul</h1>
    <h6><span class="text-danger">*</span> wajib diisi</h6>
    <form class="row g-3 needs-validation" action="/{{$page}}/{{ $data->id }}" method="POST" novalidate>
        @method('PUT')
        @csrf
        <div class="col-md-6">
            <label for="name1" class="form-label">Nama Mahasiswa 1<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name1" name="name1"
                value="{{ is_null($data['mahasiswa_i']) ? '' : explode('|', $data['mahasiswa_i'])[0] }}" required>
            <div class="invalid-feedback">
                Masukan nama Mahasiswa 1 !!!
            </div>
        </div>

        <div class="col-md-6">
            <label for="nim1" class="form-label">Nim Mahasiswa 1<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="nim1" name="nim1"
                value="{{ is_null($data['mahasiswa_i']) ? '' : explode('|', $data['mahasiswa_i'])[1] }}" required>
            <div class="invalid-feedback">
                Masukan NIM 1 !!!
            </div>
        </div>
        <div class="col-md-6">
            <label for="name2" class="form-label">Nama Mahasiswa 2</label>
            <input type="text" class="form-control" id="name2" name="name2"
                value="{{ is_null($data['mahasiswa_ii']) ? '' : explode('|', $data['mahasiswa_ii'])[0] }}">
            <div class="invalid-feedback">
                Masukan nama Mahasiswa 2 !!!
            </div>
        </div>

        <div class="col-md-6">
            <label for="nim2" class="form-label">Nim Mahasiswa 2</label>
            <input type="text" class="form-control" id="nim2" name="nim2"
                value="{{ is_null($data['mahasiswa_ii']) ? '' : explode('|', $data['mahasiswa_ii'])[1] }}">
            <div class="invalid-feedback">
                Masukan NIM 2 !!!
            </div>
        </div>

        <div class="col-md-12">
            <label for="title" class="form-label">Judul<span class="text-danger">*</span></label>
            <textarea type="text" class="form-control" id="title" name="title" required>{{ $data['title'] }}</textarea>
            <div class="invalid-feedback">
                Masukan Judul !!!
            </div>
        </div>

        <div class="col-md-6">
            <label for="pembimbing_i" class="form-label">Pembimbing 1<span class="text-danger">*</span></label>
            <select name="pembimbing_i" id="pembimbing_i" class="form-select" required>
                <option value="">Pilih</option>
                @foreach ($teacher as $d)
                    <option value="{{ $d->id }}" {{ $data['pembimbing_i'] == $d->id ? 'selected' : '' }}>
                        {{ $d->name }} {{ $d->NIDN }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Masukan Pembimbing 1!!!
            </div>
        </div>

        <div class="col-md-6">
            <label for="pembimbing_ii" class="form-label">Pembimbing 2<span class="text-danger">*</span></label>
            <select name="pembimbing_ii" id="pembimbing_ii" class="form-select" required>
                <option value="">Pilih</option>
                @foreach ($teacher as $d)
                    <option value="{{ $d->id }}" {{ $data['pembimbing_ii'] == $d->id ? 'selected' : '' }}>
                        {{ $d->name }} {{ $d->NIDN }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Masukan Pembimbing 2!!!
            </div>
        </div>
        <div class="col-md-6">
            <label for="penguji_i" class="form-label">Penguji 1<span class="text-danger">*</span></label>
            <select name="penguji_i" id="penguji_i" class="form-select" required>
                <option value="">Pilih</option>
                @foreach ($teacher as $d)
                    <option value="{{ $d->id }}" {{ $data['penguji_i'] == $d->id ? 'selected' : '' }}>
                        {{ $d->name }} {{ $d->NIDN }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Masukan Penguji 1!!!
            </div>
        </div>
        <div class="col-md-6">
            <label for="penguji_ii" class="form-label">Penguji 2<span class="text-danger">*</span></label>
            <select name="penguji_ii" id="penguji_ii" class="form-select" required>
                <option value="">Pilih</option>
                @foreach ($teacher as $d)
                    <option value="{{ $d->id }}" {{ $data['penguji_ii'] == $d->id ? 'selected' : '' }}>
                        {{ $d->name }} {{ $d->NIDN }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Masukan Penguji 2!!!
            </div>
        </div>

        <div class="col-md-12">
            <label for="jurusan_id" class="form-label">Jurusan<span class="text-danger">*</span></label>
            <select name="jurusan_id" id="jurusan_id" class="form-select" required>
                <option value="">Pilih</option>
                @foreach ($department as $d)
                    <option value="{{ $d->id }}" {{ $data['jurusan_id'] == $d->id ? 'selected' : '' }}>
                        {{ $d->department_name }} ({{ $d->singkatan }})</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Masukan Jurusan!!!
            </div>
        </div>

        <div class="col-md-12">
            <label class="form-label">
                Keahlian<span class="text-danger">*</span>
            </label>
            <div class="row">
                <div class="col-md-12 row">
                    @foreach ($dataSkill as $d)
                        @php
                            $check = '';
                        @endphp
                        @foreach (json_decode($data['skill']) as $s)
                            @if ($s == $d->id)
                                @php
                                    $check = 'checked';
                                @endphp
                            @endif
                        @endforeach
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="keahlian{{ $loop->index + 1 }}"
                                    id="keahlian{{ $loop->index + 1 }}" value="{{ $d->id }}"
                                    {{ $check }}>
                                <label for="keahlian{{ $loop->index + 1 }}"class="text-capitalize form-check-label">
                                    {{ $d->skill_name }}
                                    <span class="text-uppercase"> {{ $d->singkatan == '-' ? '' : "($d->singkatan)" }}
                                    </span>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


        <div class="col-12">
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>
@endsection

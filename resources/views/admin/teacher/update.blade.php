@extends('template.main')
@section('container')
    <h1>Update Keahlian</h1>
    <h6><span class="text-danger">*</span> wajib diisi</h6>
    <form class="row g-3 needs-validation" action="/{{$page}}/{{$data->id}}" method="POST" novalidate>
        @method('PUT')
        @csrf
        <div class="col-md-12">
            <label for="NIDN" class="form-label">NIDN<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="NIDN" name="NIDN" required>
            <div class="invalid-feedback">
                Masukan NIDN!!!
            </div>
        </div>

        <div class="col-md-12">
            <label for="name" class="form-label">Nama Dosen<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" required>
            <div class="invalid-feedback">
                Masukan nama dosen!!!
            </div>
        </div>

        <div class="col-md-12">
            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email">
            <div class="invalid-feedback">
                Masukan Email!!!
            </div>
        </div>

        <div class="col-md-12">
            <label for="telp" class="form-label">Telp<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="telp" name="telp" required>
            <div class="invalid-feedback">
                Masukan telp!!! "if null please insert '-' "
            </div>
        </div>

        <div class="col-md-12">
            <label for="position_id" class="form-label">Jabatan<span class="text-danger">*</span></label>
            <select name="position_id" id="position_id" class="form-select" required>
                <option value="">Pilih</option>
                @foreach ($dataPosition as $d)
                    <option value="{{ $d->id }}">{{ $d->position_name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Masukan Jabatan!!!
            </div>
        </div>



        <div class="col-md-12" id="positionsContainer">
            <label for="position_idlabel" class="form-label">
                Pendidikan<span class="text-danger">*</span>
                <button class="btn btn-success" type="button" id="addSkill" onclick="tambahSkill()"><i
                        class="bi-plus"></i></button>
            </label>
            <div class="row" id="position_idlabel_1">
                <div class="col-md-2">
                    <label for="tingkat1" class="form-label">Tingkatan</label>
                    <select class="form-select" name="tingkat1" id="tingkat1">
                        <option value="D3">Diploma III (D3)</option>
                        <option value="D4">Diploma IV (D4)</option>
                        <option value="S1">Sarjana (S1)</option>
                        <option value="S2">Magister (S2)</option>
                        <option value="S3">Doktor (S3)</option>
                    </select>
                </div>
                <div class="col-md-10">
                    <label for="skill1" class="form-label">Gelar</label>
                    <input id="skill1" name="skill1" type="text" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <label class="form-label">
                Keahlian<span class="text-danger">*</span>
            </label>
            <div class="row">
                <div class="col-md-12 row">
                    @foreach ($dataSkill as $d)
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="keahlian{{ $loop->index + 1 }}"
                                    id="keahlian{{ $loop->index + 1 }}" value="{{ $d->id }}">
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

        <div class="col-md-12">
            <label class="form-label">
                Menjadi
            </label>
            <div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="pembimbing" id="pembimbing">
                    <label for="pembimbing" class="form-label">
                        Pembimbing
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="penguji" id="penguji">
                    <label for="penguji" class="form-label">
                        Penguji
                    </label>
                </div>
            </div>
        </div>


        <div class="col-12">
            <button class="btn btn-primary" type="submit">Simpan</button>
        </div>
    </form>

    <script>
        let skillCounter = 1;

        function tambahSkill() {
            skillCounter++;

            // Buat div baru dengan ID yang disesuaikan
            const newDiv = document.createElement('div');
            newDiv.className = 'col-md-12';
            newDiv.id = 'positionsContainer_' + skillCounter;

            // Buat elemen HTML untuk div baru
            newDiv.innerHTML = `
                <label for="position_idlabel" class="form-label">
                    Pendidikan<span class="text-danger">*</span>
                    <button class="btn btn-success" onclick="hapusSkill('${newDiv.id}')"><i class="bi-trash"></i></button>
                </label>
                <div class="row" id="position_idlabel_${skillCounter}">
                    <div class="col-md-2">
                        <label for="tingkat${skillCounter}" class="form-label">Tingkatan</label>
                        <select class="form-select" name="tingkat${skillCounter}" id="tingkat${skillCounter}">
                            <option value="D3">Diploma III (D3)</option>
                            <option value="D4">Diploma IV (D4)</option>
                            <option value="S1">Sarjana (S1)</option>
                            <option value="S2">Magister (S2)</option>
                            <option value="S3">Doktor (S3)</option>
                        </select>
                    </div>
                    <div class="col-md-10">
                        <label for="skill${skillCounter}" class="form-label">Gelar</label>
                        <input id="skill${skillCounter}" name="skill${skillCounter}" type="text" class="form-control">
                    </div>
                </div>
            `;

            // Sisipkan div baru ke dalam container
            document.getElementById('positionsContainer').appendChild(newDiv);
        }

        // Fungsi untuk menghapus div berdasarkan ID
        function hapusSkill(id) {
            document.getElementById(id).remove();
        }
    </script>


@endsection

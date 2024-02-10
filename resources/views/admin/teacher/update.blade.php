@extends('template.main')
@section('container')
    <h1>Update Keahlian</h1>
    <h6><span class="text-danger">*</span> wajib diisi</h6>
    @php
        $title_temp = json_decode($data['title'], true);
        $title = [];
        if ($title_temp) {
            foreach ($title_temp as $key => $t) {
                if (is_array($t)) {
                    foreach ($t as $value) {
                        array_push($title, [$key, $value]);
                    }
                } else {
                    array_push($title, [$key, $t]);
                }
            }
        }
        $countSkill = count($title);
        // dd($title);
    @endphp

    <form class="row g-3 needs-validation" action="/{{ $page }}/{{ $data->id }}" method="POST" novalidate>
        @method('PUT')
        @csrf
        <div class="col-md-12">
            <label for="NIDN" class="form-label">NIDN<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="NIDN" name="NIDN" value="{{ $data['NIDN'] }}" required>
            <div class="invalid-feedback">
                Masukan NIDN!!!
            </div>
        </div>

        <div class="col-md-12">
            <label for="name" class="form-label">Nama Dosen<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $data['name'] }}" required>
            <div class="invalid-feedback">
                Masukan nama dosen!!!
            </div>
        </div>

        <div class="col-md-12">
            <label for="email" class="form-label">Email<span class="text-danger">*</span></label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $data['email'] }}">
            <div class="invalid-feedback">
                Masukan Email!!!
            </div>
        </div>

        <div class="col-md-12">
            <label for="telp" class="form-label">Telp<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="telp" name="telp" value="{{ $data['telp'] }}" required>
            <div class="invalid-feedback">
                Masukan telp!!! "if null please insert '-' "
            </div>
        </div>

        <div class="col-md-12">
            <label for="position_id" class="form-label">Jabatan<span class="text-danger">*</span></label>
            <select name="position_id" id="position_id" class="form-select" required>
                <option value="" disabled>Pilih</option>
                @foreach ($dataPosition as $d)
                    <option value="{{ $d->id }}" {{ $data['position_id'] == $d->id ? 'selected' : '' }}>
                        {{ $d->position_name }}</option>
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
                        <option value="D3" {{ isset($title[0]) && $title[0][0] == 'D3' ? 'selected' : '' }}>Diploma
                            III (D3)</option>
                        <option value="D4" {{ isset($title[0]) && $title[0][0] == 'D4' ? 'selected' : '' }}>Diploma
                            IV (D4)</option>
                        <option value="S1" {{ isset($title[0]) && $title[0][0] == 'S1' ? 'selected' : '' }}>Sarjana
                            (S1)</option>
                        <option value="S2" {{ isset($title[0]) && $title[0][0] == 'S2' ? 'selected' : '' }}>Magister
                            (S2)</option>
                        <option value="S3" {{ isset($title[0]) && $title[0][0] == 'S3' ? 'selected' : '' }}>Doktor
                            (S3)</option>
                    </select>
                </div>
                <div class="col-md-10">
                    <label for="skill1" class="form-label">Gelar</label>
                    <input id="skill1" name="skill1" type="text" class="form-control"
                        value="{{ isset($title[0]) ? $title[0][1] : '' }}">
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
                        @php
                            $check_skill = '';
                            $decodedSkills = json_decode($data['skills'], true);
                            if (is_array($decodedSkills)) {
                                foreach ($decodedSkills as $sk) {
                                    if ($d->id == $sk) {
                                        $check_skill = 'checked';
                                        break;
                                    }
                                }
                            }
                        @endphp
                        <div class="col-md-4">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="keahlian{{ $loop->index + 1 }}"
                                    id="keahlian{{ $loop->index + 1 }}" value="{{ $d->id }}" {{ $check_skill }}>
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
                    <input class="form-check-input" type="checkbox" name="pembimbing" id="pembimbing"
                        {{ $data['pembimbing'] ? 'checked' : '' }}>
                    <label for="pembimbing" class="form-label">
                        Pembimbing
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="penguji" id="penguji"
                        {{ $data['pembimbing'] ? 'checked' : '' }}>
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
        let skillCounter = {{ $countSkill }};
        document.addEventListener('DOMContentLoaded', function() {
            // console.log(skillCounter);
            var title = @json($title);
            for (var i = 2; i <= skillCounter; i++) {


                const newDiv = document.createElement('div');
                newDiv.className = 'col-md-12';
                newDiv.id = 'positionsContainer_' + i;

                // Buat elemen HTML untuk div baru
                newDiv.innerHTML = `
                <label for="position_idlabel" class="form-label">
                    Pendidikan<span class="text-danger">*</span>
                    <button class="btn btn-success" onclick="hapusSkill('${newDiv.id}')"><i class="bi-trash"></i></button>
                </label>
                <div class="row" id="position_idlabel_${i}">
                    <div class="col-md-2">
                        <label for="tingkat${i}" class="form-label">Tingkatan</label>
                        <select class="form-select" name="tingkat${i}" id="tingkat${i}">
                            <option value="D3" ${(title[i-1][0] == "D3") ? "selected" : ""}>Diploma III (D3)</option>
                            <option value="D4" ${(title[i-1][0] == "D4") ? "selected" : ""}>Diploma IV (D4)</option>
                            <option value="S1" ${(title[i-1][0] == "S1") ? "selected" : ""}>Sarjana (S1)</option>
                            <option value="S2" ${(title[i-1][0] == "S2") ? "selected" : ""}>Magister (S2)</option>
                            <option value="S3" ${(title[i-1][0] == "S3") ? "selected" : ""}>Doktor (S3)</option>
                        </select>
                    </div>
                    <div class="col-md-10">
                        <label for="skill${i}" class="form-label">Gelar</label>
                        <input id="skill${i}" name="skill${i}" type="text" class="form-control" value="${title[i-1][1]}">
                    </div>
                </div>
            `;
                // Sisipkan div baru ke dalam container
                document.getElementById('positionsContainer').appendChild(newDiv);
            }
        });

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

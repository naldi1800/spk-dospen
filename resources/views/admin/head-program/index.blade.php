@extends('template.main')
@section('container')
    <h1>Data Ketua Jurusan</h1>
    {{-- <a class="btn btn-success" href="/{{ $page }}/create">Tambah Dosen</a> --}}

    <table class="table table-bordered text-center mt-3">
        <thead class="action">
            <tr>
                <th scope="col">#</th>
                <th scope="col">NIDN</th>
                <th scope="col">Nama</th>
                <th scope="col">Jabatan</th>
                <th scope="col">Username</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                use App\Models\Skill;
            @endphp
            @foreach ($data as $d)
                @php
                    $ti = json_decode($d->title, true);
                    $name = '';
                    if (array_key_exists('S3', $ti)) {
                        if (is_array($ti['S3'])) {
                            $temp = '';
                            foreach ($ti['S3'] as $value) {
                                $temp .= $value . '.,';
                            }
                            $name .= substr($temp, 0, -1);
                        } else {
                            $name .= $ti['S3'] . '.';
                        }
                    }
                    $name .= ' ' . $d->name;
                    if (array_key_exists('S1', $ti)) {
                        if (is_array($ti['S1'])) {
                            $temp = '';
                            foreach ($ti['S1'] as $value) {
                                $temp .= ', ' . $value . '.';
                            }
                            // $temp = rtrim($temp);
                            $name .= '' . $temp;
                        } else {
                            $name .= ', ' . $ti['S1'] . '.';
                        }
                    }

                    if (array_key_exists('S2', $ti)) {
                        if (is_array($ti['S2'])) {
                            $temp = '';
                            foreach ($ti['S1'] as $value) {
                                $temp .= ', ' . $value . '.';
                            }
                            // $temp = rtrim($temp);
                            $name .= ' ' . $temp;
                        } else {
                            $name .= ', ' . $ti['S2'] . '.';
                        }
                    }
                    // dd($name);
                    // $name = (array_key_exists('S3', $ti) ? $ti['S3'] : '') . $d->name . ' ' . (array_key_exists('S1', $ti) ? $ti['S1'] : '');
                    // if ($loop->last) {
                    //     dd($name);
                    // }
                @endphp

                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $d->NIDN }}</td>
                    <td>{{ $name }}</td>
                    <td>{{ $d->position->position_name }}</td>
                    <td>{{ $d->email }}</td>
                    <td class="d-flex justify-content-center">
                        @if (!$d->login)
                            <form action="/{{ $page }}/{{ $d->id }}/set-user" method="POST" class="">
                                @csrf
                                <input type="hidden" id="name" name="name" value="{{ $d->name }}">
                                <input type="hidden" id="email" name="email" value="{{ $d->email }}">
                                <input type="hidden" id="NIDN" name="NIDN" value="{{ $d->NIDN }}">
                                <input type="hidden" id="password" name="password" value="{{ $d->NIDN }}">
                                <button type="submit" class="btn btn-success"></i>Generate User Password</button>
                            </form>
                        @else
                            <form action="/{{ $page }}/{{ $d->id }}/delete-user" method="POST"
                                class="">
                                @csrf
                                <input type="hidden" id="NIDN" name="NIDN" value="{{ $d->NIDN }}">
                                <button type="submit" class="btn btn-danger"></i>Delete User Password</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

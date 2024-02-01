@extends('template.main')
@section('container')
    <h1>Data Judul</h1>
    <a class="btn btn-success" href="/{{ $page }}/create">Tambah Judul</a>

    <table class="table table-bordered text-center mt-3">
        <thead>
            <tr>
                <th scope="col" rowspan="2">#</th>
                <th scope="col" colspan="2">Mahasiswa</th>
                <th scope="col" rowspan="2">Judul</th>
                <th scope="col" colspan="2">Pembimbing</th>
                <th scope="col" colspan="2">Penguji</th>
                <th scope="col" rowspan="2">Jurusan</th>
                <th scope="col" rowspan="2">Proposal</th>
                <th scope="col" rowspan="2">Skripsi</th>
                <th scope="col" rowspan="2">Skill</th>
                <th scope="col" rowspan="2">Aksi</th>
            </tr>
            <tr>
                <th scope="col">1</th>
                <th scope="col">2</th>
                <th scope="col">1</th>
                <th scope="col">2</th>
                <th scope="col">1</th>
                <th scope="col">2</th>
            </tr>
        </thead>
        <tbody>
            @php
                use App\Models\Skill;
            @endphp
            @foreach ($data as $d)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ is_null($d->mahasiswa_i) ? '' : str_replace('|', PHP_EOL, $d->mahasiswa_i) }}</td>
                    <td>{{ is_null($d->mahasiswa_ii) ? '' : str_replace('|', PHP_EOL, $d->mahasiswa_ii) }}</td>
                    <td>{{ $d->title }}</td>
                    <td>{{ $d->pem_i->name }}</td>
                    <td>{{ $d->pem_ii->name }}</td>
                    <td>{{ $d->pen_i->name }}</td>
                    <td>{{ $d->pen_ii->name }}</td>
                    <td>{{ $d->department->singkatan }}</td>
                    <td>
                        {{ is_null($d->tanggal_proposal) ? "Belum Proposal" : $d->tanggal_proposal }}
                        @if (is_null($d->tanggal_proposal))
                        <a class='btn btn-success' href='/{{$page}}/{{$d->id}}/proposal'>tandai sudah proposal</a>
                        @endif
                    </td>
                    <td>
                        {{ is_null($d->tanggal_skripsi) ? 'Belum Skripsi' : $d->tanggal_skripsi }}
                        @if (is_null($d->tanggal_skripsi))
                        <a class='btn btn-success' href='/{{$page}}/{{$d->id}}/skripsi'>tandai sudah skripsi</a>
                        @endif
                    </td>
                    <td>
                        <ul class="list-group">
                            @foreach (json_decode($d->skill) as $s)
                                <li class="list-group-item">
                                    {{ Skill::find($s)->skill_name }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="d-flex justify-content-center">
                        <a href="/{{ $page }}/{{ $d->id }}/update" class="btn btn-primary me-2"><i
                                class="bi-pencil"></i>
                        </a>
                        <form action="/{{ $page }}/{{ $d->id }}" method="POST" class="">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"><i class="bi-trash"></i> </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

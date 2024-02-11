@extends('template.main')
@section('container')
    <h1>Data Jurusan</h1>
    <a class="btn foreground" href="/{{ $page }}/create">Tambah Jurusan</a>

    <table class="table table-bordered text-center mt-3">
        <thead class="action">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Jurusan</th>
                <th scope="col">Singkatan</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($data as $d)
                <tr>
                    <td scope="row">{{ $loop->index + 1 }}</td>
                    <td>{{ $d->department_name }}</td>
                    <td>{{ $d->singkatan }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="/{{ $page }}/{{ $d->id }}/update" class="btn btn-primary me-2"><i class="bi-pencil"></i>
                            Update</a>
                        <form action="/{{ $page }}/{{ $d->id }}" method="POST" class="">
                            @csrf
                            @method('delete')

                            <button type="submit" class="btn btn-danger"><i class="bi-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>

            @endforeach
        </tbody>
    </table>
@endsection

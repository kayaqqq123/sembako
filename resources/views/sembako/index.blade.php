@extends('layouts.master')
@section('title', 'Tabel Barang')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tabel Barang {{ $input }}
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Stok Barang(/Kg)</th>
                                    <th>Tanggal Input</th>
                                    <th>Tanggal Expired</th>
                                    <th>Message</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sembakos as $sembako)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td class="align-items-center">{{ $sembako->name }}</td>
                                    <td class="align-items-center">{{ $sembako->stock }}</td>
                                    <td>{{ $sembako->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $sembako->expired_date->format('d-m-Y') }}</td>
                                    <td><div class="btn text-uppercase {{ $sembako->bg_alert }}">{{ $sembako->message }}</div></td>
                                    <td>
                                        <a href="{{ route('sembako.edit.input',[$sembako->id,$input_sebelum_dirubah]) }}" class="btn btn-info">Update</a>
                                        <form action="{{ route('sembako.destroy',$sembako->id) }}" class=" d-inline-block" method="post">
                                          @csrf
                                          @method('DELETE')
                                            <button type="submit" class="btn btn-danger" >Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
@section('script')

@endsection

@stop

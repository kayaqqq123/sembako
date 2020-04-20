@extends('layouts.master')
​
@section('title')
    <title>Tambah Barang</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Tambah Barang</h1>
                    </div>

                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                            <form action="{{ route('sembako.store') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="">Nama Barang</label>
                                    <input type="text" name="name" required
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Stok Barang</label>
                                    <input type="text" name="stock" required
                                        class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('stock') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Expired</label>
                                    <input type="date" name="expired_date" required
                                        class="form-control {{ $errors->has('expired_date') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('expired_date') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fa fa-send"></i> Submit
                                    </button>
                                </div>
                            </form>
                            @slot('footer')
​
                            @endslot
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#kosong').click(function(){
                //alert('saas');
                $('form #nama').val('');
                $('form #exp').val('');
            });
        })
    </script>
@endsection

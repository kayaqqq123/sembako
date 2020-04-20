@extends('layouts.master')
​
@section('title')
    <title>Edit Barang</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Edit Barang</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="">Barang</a></li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                            <form action="{{ route('sembako.update',[$sembako->id,$input]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <div class="form-group">
                                    <label for="">Nama Barang</label>
                                    <input type="text" name="name" required
                                        value="{{ $sembako->name }}"
                                        class="form-control {{ $errors->has('name') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('name') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Stok Barang</label>
                                    <input type="text" name="stock" required
                                        value="{{ $sembako->stock }}"
                                        class="form-control {{ $errors->has('stock') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('stock') }}</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Expired</label>
                                    <input type="date" name="expired_date" required
                                        value="{{ $sembako->expired_date }}"
                                        class="form-control {{ $errors->has('expired_date') ? 'is-invalid':'' }}">
                                    <p class="text-danger">{{ $errors->first('expired_date') }}</p>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-info btn-sm">
                                        <i class="fa fa-refresh"></i> Update
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

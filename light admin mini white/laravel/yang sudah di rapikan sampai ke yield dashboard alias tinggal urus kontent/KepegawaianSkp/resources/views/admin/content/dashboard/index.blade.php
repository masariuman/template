@extends('admin.template')

@push('css')
@endpush


@section('title')
    Beranda
@endsection


@section('titleContent')
    <div class="top-bar color-scheme-transparent masariuman-height103px">
        <div class="top-menu-controls masariuman-marginleft30px">
            <div class="icon-w top-icon masariuman-titlecontent">
            <div class="os-icon os-icon-layout"></div>
            </div>
            <div class="masariuman-textleft">
                <span class="masariuman-bold">BERANDA</span> <br/>
                <small>ini adalah beranda</small>
            </div>
        </div>
        <div class="top-menu-controls">
            <button class="mr-2 mb-2 btn btn-outline-secondary" type="button"><i class="batch-icon-bulb-2"></i> PETUNJUK <i class="batch-icon-bulb"></i></button>
        </div>
    </div>
    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.html">Home</a>
        </li>
        <li class="breadcrumb-item">
            <span>Beranda</span>
        </li>
    </ul>
@endsection


@section('content')
    INI BERANDA
@endsection


@push('js')

@endpush

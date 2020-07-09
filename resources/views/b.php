@extends('layouts.admin')
@section('title', '')

@section('content')
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>TEST</h1>
        <div class="section-header-breadcrumb">
          <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
          <div class="breadcrumb-item"><a href="{{ route('admin.') }}"></a></div>
          <div class="breadcrumb-item">TEST</div>
        </div>
      </div>

      <div class="section-body">
        @if (Session::has('success'))
            <h2 class="section-title">
                {{ Session::get('success') }}
            </h2>
        @endif

        <div class="row">
          <div class="col-12">
          </div>
        </div>
      </div>
    </section>
</div>
@endsection
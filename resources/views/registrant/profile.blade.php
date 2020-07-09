@extends('layouts.registrant')
@section('title', Auth::user()->name)

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Akun</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('reg.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Akun</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Halo, {{ Auth::user()->name }}</h2>
            <p class="section-lead">
                @if (Session::has('success'))
                    {{ Session::get('success') }}
                @else
                    Selamat datang di {{ getSiteName() }}
                @endif
            </p>

            <div class="row mt-sm-4">
                <div class="col-12">
                    <div class="card">
                        <form method="post" class="needs-validation" action="{{ route('reg.account.store') }}">
                            @csrf
                            <div class="card-header">
                                <h4>Edit Akun</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="email">Email:</label>
                                    <input value="{{ old('email', Auth::user()->email) }}" type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required="required">
                                
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password">

                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
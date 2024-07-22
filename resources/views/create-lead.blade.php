@extends('layout.layout')

@section('content')
    <a href="{{ route('feed') }}">
        <button class="btn btn-outline-light">
            Feed Page
        </button>
    </a>
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-6">
            @include('shared.success-message')
            @include('shared.error-message')
            <form action="{{ route('create') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input name="fullname" placeholder="Fullname" class="form-control-plaintext border rounded py-1 px-3"
                        id="fullname" rows="3">
                    @error('lead')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                    <input name="email" placeholder="example@test.com"
                        class="form-control-plaintext border rounded py-1 px-3 mt-2" id="content" rows="3">
                    @error('email')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                    <input name="phone" placeholder="+79999999999"
                        class="form-control-plaintext border rounded py-1 px-3 mt-2" id="content" rows="3">
                    @error('phone')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                    <select name="city" class="form-control-plaintext border rounded py-1 px-3 mt-2">
                        @foreach (App\City::values() as $key => $value)
                            <option class="form-control-plaintext" value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('city')
                        <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="position-absolute start-50 translate-middle mt-4">
                    <button type="submit" class="btn btn-dark"> Create </button>
                </div>
            </form>
        </div>
        <div class="col-3">
        </div>
    </div>
@endsection

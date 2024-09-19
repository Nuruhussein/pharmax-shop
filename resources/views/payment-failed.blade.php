<@extends('layouts.commerce')

@section('content')
    <div class="container">
        <h1>Payment Failed</h1>
        <p>There was an issue processing your payment. Please try again or contact support.</p>
        <a href="{{ route('ecommerce.index') }}" class="btn btn-danger">Return to Cart</a>
    </div>
@endsection

@extends('admin.layouts.app')
@section('title', 'Edit Affiliate')
@section('page-title', 'Edit Affiliate - ' . $affiliate->name)
@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.affiliates.update', $affiliate) }}">
            @csrf
            @method('PUT')
            @include('admin.affiliates._form')
        </form>
    </div>
@endsection

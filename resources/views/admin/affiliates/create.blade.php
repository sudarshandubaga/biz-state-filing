@extends('admin.layouts.app')
@section('title', 'Add Affiliate')
@section('page-title', 'Add New Affiliate')
@section('content')
    <div class="bg-white rounded-lg shadow p-6">
        <form method="POST" action="{{ route('admin.affiliates.store') }}">
            @include('admin.affiliates._form')
        </form>
    </div>
@endsection

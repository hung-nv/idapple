@extends('backend.layouts.app')

@section('title')
    Administrator
@endsection

@section('content')
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
        @include('backend.blocks.theme-options')
        <!-- BEGIN PAGE BAR -->
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Dashboard</span>
                    </li>
                </ul>
            </div>

            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Administrator Dashboad
            </h3>
            <!-- END PAGE TITLE-->
        </div>
    </div>
@endsection
@extends('backend.layouts.app')

@section('title')
    Manage Menu of Administrator
@endsection

@section('content')
    <!-- BEGIN CONTENT -->
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
                        <a href="{{ route('menuSystem.index') }}">Menu of Administrator</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>All</span>
                    </li>
                </ul>
            </div>
            <!-- END PAGE BAR -->

            <!-- BEGIN PAGE TITLE-->
            <h3 class="page-title"> Managed Menu of Administrator
                <small>Create</small>
            </h3>
            <!-- END PAGE TITLE-->

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN SAMPLE FORM PORTLET-->
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption font-green-haze">
                                <i class="icon-settings font-green-haze"></i>
                                <span class="caption-subject bold uppercase"> Create Menu of Administrator</span>
                            </div>
                            <div class="actions">
                                <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;"
                                   data-original-title="" title=""> </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form action="{{ route('menuSystem.store') }}" class="form-horizontal" role="form"
                                  method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-body">

                                    @include('backend.blocks.errors')

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Label</label>
                                        <div class="col-md-4">
                                            <input type="text" name="label" class="form-control"
                                                   placeholder="Enter your Menu of Administrator name" required/></div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Icon</label>
                                        <div class="col-md-4">
                                            <input name="icon" type="text" class="form-control"
                                                   placeholder="Enter your Menu icon"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Route</label>
                                        <div class="col-md-4">
                                            <input name="route" type="text" class="form-control"
                                                   placeholder="Enter your Menu route"></div>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label col-md-3">Parent</label>
                                        <div class="col-md-4">
                                            <select class="form-control" name="parent_id">
                                                <option value="0">Select...</option>
                                                @foreach($data as $item)
                                                    <option value="{{ $item->id }}">{{ $item->label }}</option>
                                                    @if(isset($item->child) && $item->child)
                                                        @foreach($item->child as $sub)
                                                            <option value="{{ $sub->id }}">|---{{ $sub->label }}</option>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-offset-3 col-md-9">
                                            <button type="submit" class="btn green">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- END SAMPLE FORM PORTLET-->
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
@endsection
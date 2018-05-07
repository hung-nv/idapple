@extends('backend.layouts.app')

@section('title')
    Buy Apple ID
@endsection

@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('admin.dashboard') }}">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="{{ route('apple.index') }}">Apple Id</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>Buy ID</span>
                    </li>
                </ul>
            </div>

            <h3 class="page-title"> Apple ID
                <small>Buy</small>
            </h3>

            <div class="row page-buyid">
                <div class="col-md-6 col-md-offset-3">
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="icon-share font-green-sharp"></i>
                                <span class="caption-subject font-green-sharp bold uppercase">Buy Apple ID</span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            @if(Session::has('success_message'))
                                <div class="well">
                                    {{Session::get('success_message')}}
                                </div>
                            @endif

                            @if(Session::has('error_message'))
                                <div class="alert alert-warning">
                                    {{Session::get('error_message')}}
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger hidden error-get-id">
                                    </div>
                                </div>

                                <div class="col-md-6 col-md-offset-3">
                                    <form method="post" role="form" id="frm-getid">
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <select id="domain" class="form-control">
                                                    <option value="">Select domain...</option>
                                                    @foreach($domains as $domain)
                                                        <option value="{{ $domain['domain'] }}">{{ $domain['domain'] }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label class="control-label col-md-3">
                                                <a class="btn btn-info" id="get-first-id" style="width: 100px;">GET</a>
                                            </label>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <input type="text" name="apple_id" id="apple_id" value="" class="form-control">
                                            </div>
                                            <label class="control-label col-md-3">
                                                <a class="btn btn-info" id="copy-apple-id" style="width: 100px;">COPY</a>
                                            </label>
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-9">
                                                <input type="text" name="password" id="password" value="" class="form-control">
                                            </div>
                                            <label class="control-label col-md-3">
                                                <a class="btn btn-info" id="copy-password" style="width: 100px;">COPY</a>
                                            </label>
                                            <div class="clearfix"></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
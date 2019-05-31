@extends('layouts.app')
@section('content')

@section('page_title')
    Settings
@endsection

@section('active_title')
    Settings
@endsection

<!-- Main content -->
<section class="content">

    @include('partials.messages')

    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit settings</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body" style="">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="alert alert-success settings_success hidden"></div>
                    <div class="alert alert-danger settings_error hidden"></div>
                    <div class="table-responsive governments_rows">
                        <table class="table table-hover table-bordered">
                            <tbody>
                                @if (!empty($settings))
                                    {!! Form::open(['route' => ['settings.update', $settings->id], 'method' => 'PUT', 'class' => 'update_settings_form']) !!}

                                    <tr>
                                        <th><i class="fa fa-envelope"> Email</i>
                                            <div class="form-group">
                                                {!! Form::text('email', $settings->email, ['class' => 'form-control']) !!}
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-phone"> Phone</i>
                                            <div class="form-group">
                                                {!! Form::text('phone', $settings->phone, ['class' => 'form-control']) !!}
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-facebook"> Facebook</i>
                                            <div class="form-group">
                                                {!! Form::text('facebook', $settings->facebook, ['class' => 'form-control']) !!}
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-twitter"> Twitter</i>
                                            <div class="form-group">
                                                {!! Form::text('twitter', $settings->twitter, ['class' => 'form-control']) !!}
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-youtube-play"> Youtube</i>
                                            <div class="form-group">
                                                {!! Form::text('youtube', $settings->youtube, ['class' => 'form-control']) !!}
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-whatsapp"> Whatsapp</i>
                                            <div class="form-group">
                                                {!! Form::text('whatsapp', $settings->whatsapp, ['class' => 'form-control']) !!}
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-instagram"> Instagram</i>
                                            <div class="form-group">
                                                {!! Form::text('instagram', $settings->instagram, ['class' => 'form-control']) !!}
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-google-plus"> Google+</i>
                                            <div class="form-group">
                                                {!! Form::text('google_plus', $settings->google_plus, ['class' => 'form-control']) !!}
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><i class="fa fa-pencil"> About_us</i>
                                            <div class="form-group">
                                                {!! Form::text('about_us', $settings->about_us, ['class' => 'form-control']) !!}
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><i class="fa  fa-bullhorn"> Terms and condition</i>
                                            <div class="form-group">
                                                {!! Form::text('terms_conditions', $settings->terms_conditions, ['class' => 'form-control']) !!}
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <div class="form-group">
                                                <button class="btn btn-primary update_settings"><i class="fa fa-cogs"></i> Save Settings</button>
                                            </div>
                                        </th>
                                    </tr>
                                    {!! Form::close() !!}

                                @else
                                    <tr>
                                        <th>
                                            <h4 class="text-red text-center">No settings added yet</h4>
                                            <div class="form-group text-center">
                                                <a class="btn btn-primary" data-toggle="modal" data-target="#settings_modal"><i class="fa fa-cogs"></i> Add Settings</a>
                                            </div>
                                        </th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>

</section>
<!-- /.content -->

@endsection

<div class="modal fade settings_modal" id="settings_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Add settings</h4>
            </div>
                <div class="alert alert-success hidden settings_success"></div>
                <div class="alert alert-danger hidden settings_error"></div>
            <div class="modal-body">
                
                {!! Form::open(['route' => 'settings.store', 'method' => 'post', 'class' => 'add_settings_form']) !!}
                <div class="form-group"><i class="fa fa-envelope"></i> Email
                    {!! Form::text('email', '', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group"><i class="fa fa-phone"></i> Phone
                    {!! Form::text('phone', '', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group"><i class="fa fa-facebook"></i> Facebook
                    {!! Form::text('facebook', '', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group"><i class="fa fa-twitter"></i> Twitter
                    {!! Form::text('twitter', '', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group"><i class="fa fa-youtube-play"></i> Youtube
                    {!! Form::text('youtube', '', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group"><i class="fa fa-whatsapp"></i> Whatsapp
                    {!! Form::text('whatsapp', '', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group"><i class="fa fa-instagram"></i> Instagram
                    {!! Form::text('instagram', '', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group"><i class="fa fa-google-plus"></i> Google plus
                    {!! Form::text('google_plus', '', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group"><i class="fa fa-book"></i> About us
                    {!! Form::textarea('about_us', '', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group"><i class="fa fa-cogs"></i> Terms and conditions
                    {!! Form::textarea('terms_conditions', '', ['class' => 'form-control']) !!}
                </div>

                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary add_settings">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

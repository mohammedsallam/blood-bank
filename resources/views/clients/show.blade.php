@extends('layouts.app')
@inject('model', "App\Models\Client")
@section('content')

@section('page_title')
    Show client
@endsection

@section('active_title')
    Show client
@endsection


<!-- Main content -->
<section class="content">
    @include('partials.messages')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Show client</h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th>Name</th>
                    <td>{{$record->name}}</td>
                </tr>
                <tr>
                    <th>E-mail</th>
                    <td>{{$record->email}}</td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>{{$record->phone}}</td>
                </tr>
                <tr>
                    <th>Birth date</th>
                    <td>{{$record->birth_date}}</td>
                </tr>
                <tr>
                    <th>City</th>
                    <td>{{$record->city->name}}</td>
                </tr>
                <tr>
                    <th>Government</th>
                    <td>{{$record->city->government->name}}</td>
                </tr>
                <tr>
                    <th>Blood type</th>
                    <td>{{$record->bloodType->name}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</section>
<!-- /.content -->

@endsection

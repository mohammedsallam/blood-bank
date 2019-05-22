@if(auth()->check())

@include('layouts.head')
@include('layouts.body-start')
@include('layouts.wrapper-start')
@include('layouts.header')
@include('layouts.aside')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            @yield('page_title')
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('/home')}}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">@yield('active_title')</li>
        </ol>
    </section>

    @yield('content')

</div>
<!-- /.content-wrapper -->

@include('layouts.footer')
{{--    @include('layouts.aside-control')--}}
@include('layouts.wrapper-end')
@include('layouts.js')
@include('layouts.body-end')

@endif
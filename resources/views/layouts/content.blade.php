@extends('layouts.app')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            {{ $slot }}
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

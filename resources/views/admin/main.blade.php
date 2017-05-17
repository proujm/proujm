@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                {!! Helpers::adminMenu() !!}
            </div>

            <div class="col-md-9">
                <div class="statistic">

                </div>
            </div>
        </div>
    </div>
@stop
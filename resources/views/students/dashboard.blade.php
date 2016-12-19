{{--For the use of Student--}}
@extends('layouts.master')

@section('title')
    Dashboard | Student| ECAM
    {{--For the use of Student--}}
@stop

@section('content')
    {{--For the use of Student--}}
    <div class="row">
        <div class="col-md-6">
            {{--<div class="jumbotron">--}}
                <ul class="list-group">
                    <li class="list-group-item">Name: {{ $student->first_name }} {{ $student->last_name }}
                    @if($student->flag)
                        <div class="label label-danger">You've been flagged by the HoD</div>
                        @endif
                    </li>
                    <li class="list-group-item">Index No: {{ $student->index_no }}</li>
                    <li class="list-group-item">Gender: {{ $student->gender }}</li>
                    <li class="list-group-item">Email: {{ $student->email }}</li>
                    <li class="list-group-item">DoB: {{ $student->dob }}</li>
                    <li class="list-group-item">Batch: {{ $student->batch }}</li>
                </ul>
            {{--</div>--}}
        </div>
    </div>
    <hr><br>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <h3>My Activities</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h4>Sports</h4>
            <table class="table table-bordered table-responsive">

            </table>
        </div>
        <div class="col-md-3">
            <h4>Organizations</h4>
        </div>
        <div class="col-md-3">
            <h4>Competitions</h4>
        </div>
        <div class="col-md-3">
            <h4>Achievements</h4>
        </div>
    </div>
@stop
@extends('layouts.app')
@section('content') 
<!-- Header start --> 
@include('includes.header') 
<!-- Header end --> 
<!-- Inner Page Title start --> 
@include('includes.inner_page_title', ['page_title'=>__('Company Messages')]) 
<!-- Inner Page Title end -->
<div class="listpgWraper">
    <div class="container">
        <div class="row"> @include('includes.company_dashboard_menu')
            <div class="col-md-9 col-sm-8">
                <div class="myads">
                   
                    <ul class="searchList">
                        <!-- job start --> 
                        @if(isset($messages) && count($messages))
                        @foreach($messages as $message)

                        @php
                        $style = (!(bool)$message->is_read)? 'border: 2px solid #FFB233;':'';
                        @endphp

                        <li style="{{$style}}">
                            <a href="{{route('company.message.detail', $message->id)}}" title="{{$message->subject}}">
                                <div class="row">
                                    <div class="col-md-8">              
                                        <h4>{{$message->from_name}} - {{$message->from_email}}</h4>
                                        {{$message->subject}}
                                    </div>
                                    <div class="col-md-4 text-right">
                                        {{$message->created_at->format('M d,Y')}}                
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- job end --> 
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('includes.footer')
    @endsection
@extends('navbar')
@section('title','Houseavavilbility page')

@section('head')
@endsection

@section('content')
	<div class='container'>
		<p><label>Check In Time: </label><span id='rentBegin'> {{$ava->rentBegin}}</span></p>
		<p><label>Check Out Time: </label><span id='renEnd'> {{$ava->rentEnd}}</span></p>
		<p><label>Source: </label><span id='source'> {{$ava->source}} </span> </p>
		<p><label>Descriptiotn: </label><span>{{$ava->description}}</span></p>
	</div>

@endsection


@section('script')
@endsection

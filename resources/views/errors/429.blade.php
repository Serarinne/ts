@extends('errors::layout')

@section('title', __('Too Many Requests'))
@section('code', '429')
@section('message', __('You are sending too many requests to the server.'))

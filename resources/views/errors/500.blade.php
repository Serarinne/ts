@extends('errors::layout')

@section('title', __('Internal Server Error'))
@section('code', '500')
@section('message', __("Sorry, the page is currently unavailable, please try again later. You'll find lots to explore on the home page."))

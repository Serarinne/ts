@extends('errors::layout')

@section('title', __('Unauthorized'))
@section('code', '401')
@section('message', __("Sorry, you do not have access permission for this page. You'll find lots to explore on the home page."))

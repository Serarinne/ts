@extends('errors::layout')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __("Sorry, you do not have access permission for this page. You'll find lots to explore on the home page."))

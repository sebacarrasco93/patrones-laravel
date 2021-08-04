@extends('layout')

@section('contenido')
    <a href="{{ route('patrones.factory') }}">Factory</a>
    <a href="{{ route('patrones.factoryMethod') }}">Factory Method</a>
    <a href="{{ route('patrones.pipeline') }}">Pipeline</a>
    <a href="{{ route('patrones.adapter') }}">Adapter</a>
    <a href="{{ route('patrones.command') }}">Command</a>
@endsection

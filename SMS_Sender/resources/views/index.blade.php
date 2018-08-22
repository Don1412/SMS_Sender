@extends('layouts.base')
@section('title', trans('general.createSend'))
@section('buttons')
    <div class="btn-group p-1">
      <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
          <i class="fa d-inline fa-lg fa-user-circle-o"></i> <b></b>
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Action</a>
        <div class="dropdown-divider"></div>
        <a href="../logout/" class="dropdown-item" href="#">
            <i class="fa d-inline fa-lg fa-sign-out"></i>
            @lang('general.logout')
        </a>
      </div>
    </div>
@endsection
@section('navbar')
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="../create/">
                <i class="fa d-inline fa-lg fa-plus"></i>
                @lang('general.createSend')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../manager/">
                <i class="fa d-inline fa-lg fa-bookmark-o"></i>
                @lang('general.manager')
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="fa d-inline fa-lg fa-envelope-o"></i>
                @lang('general.report')
            </a>
        </li>
        <!--<li class="nav-item">
            <a class="nav-link" href="../templates/"><i class="fa d-inline fa-lg fa-file-text"></i> Шаблоны</a>
        </li>-->
    </ul>
@endsection
@section('content')
    <div class="container">
        <p>@lang('general.hi'), !</p>
    </div>
@endsection
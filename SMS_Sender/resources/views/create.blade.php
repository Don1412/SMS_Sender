@extends('index')
@section('content')
    <script src="{{ asset('js/main.js') }}"></script>
    <div class="py-5 bg-light">
        @if(!empty($messages))
            @foreach($messages as $message)
                <div class="col-md-3 col-md-offset-3 fade show">
                    <div class="alert alert-{{ $message->tags }} alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ $message }}
                    </div>
                </div>
            @endforeach
        @endif
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <h1><i class="fa fa-fw fa-envelope"></i>@lang('create.create')
                <br> </h1>
              <div class="row">
                <div class="col-md-12"></div>
              </div>
              <form method="POST" action="../create_send/">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="selectService">@lang('create.selectService')</label>
                    <select class="form-control" id="selectService" name="selectService" required="required">
                        <option value="r">RouteSMS</option>
                    </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">@lang('create.senderName')</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="dropdown show">
                            <a  id="name_template_btn" class="btn toggle_arrow dropdown-toggle" role="button" id="template_name_btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-2x fa-address-card"></i>
                            </a>
                            <div id="name_template_select" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                @if(!empty($nameTemplateItems))
                                    @foreach($nameTemplateItems as $item)
                                        <a id="name_template_{{ $item }}" class="dropdown-item" onclick="select_name_template('{{ $item }}')">{{ $item }}
                                            <i class="fa-btn fa fa-1x fa-trash" onclick="delete_name_template('{{ $item }}')"></i>
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <input type="text" class="form-control" id="senderName" onchange="search_name_template()" required="required" name="senderName">
                  </div>
                  <small class="text-muted form-text">@lang('create.senderNameHelp')</small>
                </div>
                <div class="form-group"> <label for="Textarea">@lang('create.numbers')</label>
                    <textarea class="form-control" onkeyup="count_numbers()" rows="20" id="numbers" name="numbers"></textarea>
                    <p>@lang('create.numbersToSend'): <span id="numbers_to_send">0</span></p>
                    <small class="text-muted form-text">@lang('create.numbersHelp')</small></div>
                <div class="form-group"><label for="exampleInputEmail1">@lang('create.type')</label>
                    <select class="form-control" required="required" id="type" name="type">
                        <option value="u">Unicode</option>
                        <option value="t">Text</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">@lang('create.message')</label>
                    <textarea class="form-control" id="message_template_input" name="message" onchange="search_message_template()" rows="3"></textarea>
                    <div class="dropdown show">
                        <a class="btn dropdown-toggle" id="message_template_btn" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-1x fa-file-text"></i>
                        </a>
                        <div id="message_template_select" class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            @if(!empty($message_template_items))
                                @foreach($messageTemplateItems as $item)
                                    <a id="message_template_{{ $item }}" class="dropdown-item" onclick="select_message_template('{{ $item }}')">{{ $item }}
                                        <i class="fa-btn fa fa-1x fa-trash" onclick="delete_message_template('{{ $item }}')"></i>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-group">
                  <div class="form-check" id="periodic">
                    <input class="form-check-input" type="checkbox" id="exampleCheck1" name="periodic">
                      <label class="form-check-label" for="exampleCheck1" id="per">@lang('create.periodic')</label>
                  </div>
                    <small class="text-muted form-text">@lang('create.periodicHelp')</small>
                </div>
                <div class="form-group row">
                    <label class="col-auto col-form-label" for="exampleInputEmail1">@lang('create.every')&nbsp;</label>
                  <input type="text" class="form-control col-1" id="periodic_hour" name="periodic_hour">
                    <label class="col-auto col-form-label">@lang('create.hours')</label>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-auto col-form-label" for="periodic_minutes">@lang('create.every')&nbsp;</label>
                        <input type="text" class="form-control col-1" id="periodic_minutes" name="periodic_minutes">&nbsp;
                        <label class="col-auto col-form-label">@lang('create.minutes')</label>
                    </div>
                    <small>@lang('create.period')</small>
                </div>
                <div class="form-group">
                    <div class="row">
                        <label class="col-auto col-form-label" for="periodic_amount">@lang('create.count')&nbsp;</label>
                        <input type="text" class="form-control col-1" id="periodic_amount" name="periodic_amount">
                    </div>
                    <small>@lang('create.countHelp')</small>
                </div>
                <div class="form-group">
                  <div class="form-check" id="plan">
                    <input class="form-check-input" type="checkbox" id="planned" name="planned">
                      <label class="form-check-label" for="planned">@lang('create.planned')</label>
                  </div>
                <small class="text-muted form-text">@lang('create.plannedHelp')</small>
                </div>
                <div class="form-group row">
                    <label class="col-1 col-form-label" for="plan_date">@lang('create.date')&nbsp;</label>
                  <input type="date" class="form-control col-2 d-inline" id="plan_date" name="plan_date">
                </div>
                <div class="form-group row">
                    <label class="col-1 col-form-label" for="plan_hour">@lang('create.hour')&nbsp;</label>
                  <input type="number" class="form-control col-1 d-inline" id="plan_hour" name="plan_hour">
                </div>
                <div class="form-group row">
                    <label class="col-1 col-form-label" for="plan_minute">@lang('create.minute')&nbsp;</label>
                  <input type="number" class="form-control col-1 d-inline" id="plan_minute" name="plan_minute">
                </div>
                <button type="submit" class="btn btn-success">@lang('create.start')</button>
              </form>
            </div>
          </div>
        </div>
  </div>
@endsection
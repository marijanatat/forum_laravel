@extends('layouts.app')

@section('header')
<script src="https://www.google.com/recaptcha/api.js"></script>
  <!-- Smartsupp Live Chat script -->
  <script type="text/javascript">
    var _smartsupp = _smartsupp || {};
    _smartsupp.key = '5588603d1fdf728e9b321bf2581309115dd9cb88';
    window.smartsupp||(function(d) {
      var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
      s=d.getElementsByTagName('script')[0];c=d.createElement('script');
      c.type='text/javascript';c.charset='utf-8';c.async=true;
      c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
    })(document);
    </script>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create a New Thread</div>

                <div class="card-body">
                    <form action="/threads" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="channel_id">Choose a Channel:</label>
                            <select name="channel_id" id="channel_id" class="form-control" required>
                                <option value="">Choose One...</option>
                                @foreach ($channels as $channel)
                                    <option value="{{$channel->id}}" {{old('channel_id') == $channel->id ? 'selected' : ''}}>{{$channel->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" required>
                        </div>
                        <div class="form-group">
                            <label for="body">Body</label>
                            <!--<wysiwyg v-model="form.body" name="body" :value="form.body"></wysiwyg> -->
                            <wysiwyg name="body"></wysiwyg>   
                            {{-- <textarea name="body" id="body" class="form-control" rows="8" required>{{old('body')}}</textarea> --}}
                        </div>

                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="6LfU16MZAAAAALqYTw0LlX6kex_eJyBqri53lClu">

                            </div>

                        </div >
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Publish</button>
                        </div>
                        @if (count($errors))
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
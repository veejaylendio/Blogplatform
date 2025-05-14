@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Header Management') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{ URL::to('/updateHeaderText') }}" method="POST">
                        @csrf
                        
                        @if($headerTextValue != null)
                            <input type="hidden" name="id" value="{{$headerTextValue->id}}">
                            <textarea name="text2" id="headerText" class="form-control">
                                {{$headerTextValue->text}}
                            </textarea>
                        @else
                            <textarea name="text2" id="text" class="form-control">
                                I am Luther, a digital designer & frontend developer based in Somewhere.
                            </textarea>                           
                        @endif
                        
                        <button id="saveHeaderText" class="btn btn-primary mt-2">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

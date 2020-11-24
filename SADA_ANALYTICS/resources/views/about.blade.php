@extends('layouts.master')

@section("title", $data["title"])  

@section('content')
<div class="container" align="center">
    <div class="card">
        <div class="card-header">
            <h2>{{ __('about.title') }}</h2>
        </div>
        <div class="card-body">
            <h5 class="card-text">{{ __('about.intro') }}</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"> {{ __('about.methods.method_1') }}</li>
                <li class="list-group-item"> {{ __('about.methods.method_2') }}</li>
                <li class="list-group-item"> {{ __('about.methods.method_3') }}</li>
            </ul><br/>
            <h5 class="card-text">{{ __('about.also') }}</h5>
            <br/>
            <h5 class="card-text">{{ __('about.libs_used') }}</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><a href="https://numpy.org/">{{ __('about.libs.lib_1') }}</a><br/> {{ __('about.libs_description.lib_1') }}</li>
                <li class="list-group-item"><a href="https://www.sympy.org/es/">{{ __('about.libs.lib_2') }}</a><br/> {{ __('about.libs_description.lib_2') }}</li>
                <li class="list-group-item"><a href="https://getbootstrap.com/">{{ __('about.libs.lib_3') }}</a><br/> {{ __('about.libs_description.lib_3') }}</li>
                <li class="list-group-item"><a href="https://fontawesome.com/">{{ __('about.libs.lib_4') }}</a><br/> {{ __('about.libs_description.lib_4') }}</li>
                <li class="list-group-item"><a href="https://mauriciopoppe.github.io/function-plot/">{{ __('about.libs.lib_5') }}</a><br/> {{ __('about.libs_description.lib_5') }}</li>
                <li class="list-group-item"><a href="https://mathjs.org/">{{ __('about.libs.lib_6') }}</a><br/> {{ __('about.libs_description.lib_6') }}</li>
            </ul>
        </div>
    </div>
    
</div>
@endsection
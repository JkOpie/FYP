@extends('layouts.app')

@section('content')
<div id="particles-js">

    <div class="container-lg centermid" style="margin-top:3%" >
        <div class="row" >
            <div class="col-md-6">
                <div class="d-flex flex-column justify-content-center align-items-center h-100 white-text">
                    <h1 style="font-size: 3.5rem;font-weight: 700;">  Human Detection Robot For <br>
                        <div class="typed d-inline" > </div></h1>


                       
                
                </div>
              
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">{{ __('Login') }}</div>
    
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                           
    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <script src="particle.js"></script>

    <script>
        
            var typed = new Typed('.typed', {
                strings: [
                    '',
                    'Earthquake',
                    'Abandon Building',
                    'Search and Rescue Team',
                   
                ],
                
                typeSpeed: 50,
                backSpeed:50,
                loop:true,
            });
    </script>
@endsection

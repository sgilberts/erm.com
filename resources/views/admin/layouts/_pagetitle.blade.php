<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            @if ( Request::segment(2) == '')
                DASHBOARD        
            @else
                
            <h4 class="mb-sm-0">{{ Request::segment(2) }}</h4>
                
            @endif

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item text-uppercase"><a href="{{ url('admin') }}">{{ config('app.name') }}</a></li>

                    @if (Request::segment(2) == '')
                        
                    @else
                        
                        <li class="breadcrumb-item text-uppercase active">{{ Request::segment(2) }}</li>

                    @endif

                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">

        @if (Auth::user()->verified == 0)
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Your E-mail is not yet verified!. Please 
                <a href="{{ url('verify_email', Auth::user()->id) }}" id='verify_email' class='btn btn-link'>Verify E-mail Now!</a>
            </div>
        @endif
          
        @include('admin.layouts._my_alerts')

    </div>
</div>
<!-- end page title -->
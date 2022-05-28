@extends('layouts.app')

@section('content')
<div class="container-fluid">
@if(Auth::user()->annual_income==null || Auth::user()->gender=='' || Auth::user()->dob=='')

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('You Almost There. Complete Your Profile.') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('update-profile') }}" id="profileForm">
                        @csrf
                        
                        @if(Auth::user()->gender=='')
                        <div class="form-group row">
                            <label for="gender" class="col-md-4 required col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender" value="m" required>
                                    <label class="form-check-label" for="gender">Male</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" id="gender" value="f" required>
                                    <label class="form-check-label" for="gender">Female</label>
                                    </div>
                                   


                                @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif

                        @if(Auth::user()->dob=='')
                            <div class="form-group  row">
                                <label for="dob" class="col-md-4 required col-form-label text-md-right">{{ __('Date Of Birth') }}</label>

                                <div class="col-md-6 ">
                                    <input id="dob" type="text" class="datepicker form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="off" autofocus>

                                    @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif

                     

                        @if(Auth::user()->annual_income=='')
                        <div class="form-group row">
                                    <label for="annual_income" class="required col-md-4 col-form-label text-md-right">{{ __('Annual Income') }}</label>

                                    <div class="col-md-6 ">
                                    <input type="text" class="js-range-slider" name="" id="annual_income"/>
                                    <input type="hidden"  name="annual_income" value="{{ old('annual_income') }}" id="a_id"/>

                                        @error('annual_income')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                        </div>
                        @endif

                        @if(Auth::user()->manglik=='')
                        
                        <div class="form-group row">
                                    <label for="manglik" class=" col-md-4 col-form-label text-md-right">{{ __('Manglik') }}</label>
                                    <div class="col-md-6 "> 
                                        <select  class="select2 form-control @error('manglik') is-invalid @enderror" name="manglik" id="manglik" >
                                                <option value="">----</option>

                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                            <option value="both">Both</option>

                                        </select>
                                </div>
                        </div>



                        @endif

                        @if(Auth::user()->familyType()->count()==0)

                        <div class="form-group row">
                                    <label for="family_type" class=" col-md-4 col-form-label text-md-right">{{ __('Family Type') }}</label>
                                    <div class="col-md-6 "> 
                                        <select multiple class="select2 form-control @error('family_type') is-invalid @enderror" name="family_type[]"  id="family_type" >
                                                <option value="">----</option>

                                            @foreach($family_type as $key=>$item)

                                            <option value="{{$item->id}}">{{$item->name}}</option>

                                            @endforeach

                                        </select>
                                </div>
                        </div>

                        @endif

                        @if(Auth::user()->occupation()->count()==0)

                        <div class="form-group row">
                                    <label for="occupation" class=" col-md-4 col-form-label text-md-right">{{ __('Occupation') }}</label>
                                    <div class="col-md-6 "> 
                                        <select multiple class="form-control @error('occupation') is-invalid @enderror select2" name="occupation[]" >
                                                <option value="">----</option>

                                            @foreach($occupation as $key=>$item)

                                            <option value="{{$item->id}}">{{$item->name}}</option>

                                            @endforeach

                                        </select>
                                </div>
                        </div>

                        @endif

                        



                        <div class="form-group row mb-2">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" id="btn-save" class="btn btn-primary">
                                    {{ __('Update Profile') }}
                                </button>
                                <span class="msg_container"></span>
                            </div>
                        </div>

                   </form>
                </div>
            </div>
           
        </div>
    </div>
    @else

    @php $gender_full=array('f'=>'Female', 'm'=>'Male'); @endphp
    <div class="row">
    <div class="col-md-3">
            <div class="card">
            <div class="card-body">
                <strong> Full Name: </strong> {{Auth::user()->first_name.' '.Auth::user()->last_name}}<br>
                <strong> Gender: </strong> {{$gender_full[Auth::user()->gender]}}<br>

                <strong> DOB: </strong> {{Auth::user()->dob}}<br>
                <strong> Annual Income: </strong> INR {{Auth::user()->annual_income}}<br>


            </div>
        </div>
    </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Here is your perfect matches') }}</div>

                <div class="card-body">
                <h6>Total Records: <strong>{{$getMatches->total()}}</strong></h6>
                    <ul class="list-group">
                        @if(count($getMatches)>0)
                            @foreach($getMatches as $item)
                            <li class="list-group-item">
                             <div class="row">
                                <div class="col-md-2">
                                    <img src="{{$item->avatar}}" class="rounded-circle" width="120px" alt="img" >
                                </div>
                                <div class="col-md-5">
                                   <h4>{{$item->first_name.' '.$item->last_name}}</h4>
                                   <p>Gender: {{@$gender_full[$item->gender]}}</p>
                                   <p>Annual Income: INR {{$item->annual_income}}</p>
                                </div>
                                <div class="col-md-3">
                                   <p>DOB: {{$item->dob}}</p>
                                   <p>Manglik: {{ucfirst($item->manglik)}}</p>
                                </div>
                             </div>

                            </li>
                            @endforeach

                           <hr>
                           {{ $getMatches->links() }}


                        @else
                            <li class="list-group-item">
                              <h4>  <i class="material-icons" style="font-size:35px;color:red;vertical-align: middle;">error_outline</i>  Not Found </h4>

                            </li>  
                        @endif   
                    </ul>
                    
                </div>
            </div>
           
        </div>
    </div>


       

    @endif
</div>
@endsection



@section('js')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/css/ion.rangeSlider.min.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.1/js/ion.rangeSlider.min.js"></script>
<script>

dt = new Date();
dt.setFullYear(new Date().getFullYear() - 18);
console.log(dt);


    $('.datepicker').datepicker({
        viewMode: "years",
        format: 'yyyy/mm/dd',
        endDate: dt
    });

    $("#annual_income").ionRangeSlider({
        type: "double",
        min: 300000,
        max: 5000000,
        from: 300000,
        to: 600000,
        grid: false,
        grid_snap: false,
        from_fixed: false,  // fix position of FROM handle
        to_fixed: false ,    // fix position of TO handle
        onFinish: function (data) {
            // Called then action is done and mouse is released
            console.log(data.from);
            console.log(data.to);
            $('#a_id').val(data.from +'-'+data.to);
        },
    });


    jQuery(document).ready(function($){
 
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            }
        });
        e.preventDefault();
        var formData=$('#profileForm').serialize();
        var ajaxurl=$('#profileForm').attr('action');
        var type=$('#profileForm').attr('method');
        $('.msg_container').html('');
        $.ajax({
            type: type,
            url: ajaxurl,
            data: formData,
            dataType: 'json',
            beforeSend:function(){
                $('#btn-save').prop('disabled', true);
                $('#btn-save').html('saving....');
            }, 
            success: function (data) {
              if (data.success==1) {
                $('.msg_container').html('<p class="text-success">'+data.msg+'</p>');
                toastr.success(data.msg);

                location.reload();
              }
              $('#btn-save').html('saved');
              $('#btn-save').prop('disabled', false);
            },
            error: function (request, status, error) {

                if (status=='error') {
                    var listErrors='<hr><ul class="text-danger">';
                    $.each(request.responseJSON.errors, function(key, value ) {
                       console.log(value[0]);
                       console.log(key);
                       listErrors+='<li>'+key+': '+value[0]+'</li>';

                    });
                    listErrors+='</ul>';
                    $('.msg_container').html(listErrors);
                }


               

                $('#btn-save').html('Update Profile');
                $('#btn-save').prop('disabled', false);

            }
        });
    });
});
</script>

@endsection


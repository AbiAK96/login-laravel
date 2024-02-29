<!-- JAVASCRIPT -->
<script src="{{ URL::asset('build/libs/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ URL::asset('build/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{ URL::asset('build/libs/node-waves/waves.min.js')}}"></script>

<script src="{{ URL::asset('build/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('build/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{ URL::asset('build/libs/toastr/build/toastr.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/toastr.init.js') }}"></script>

<script src="{{ URL::asset('build/libs/select2/js/select2.min.js') }}"></script>


<!-- Sweet Alerts js -->
<script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Sweet alert init js-->
<script src="{{ URL::asset('build/js/pages/sweet-alerts.init.js') }}"></script>

<script src="{{ URL::asset('build/libs/tinymce/tinymce.min.js') }}"></script>

<!-- form repeater js -->
<script src="{{ URL::asset('build/libs/jquery.repeater/jquery.repeater.min.js') }}"></script>

<script src="{{ URL::asset('build/js/pages/task-create.init.js') }}"></script>

<script src="{{ URL::asset('build/libs/jquery.easing/jquery.easing.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ URL::asset('build/libs/jquery-countdown/jquery.countdown.min.js') }}"></script>

    <!-- owl.carousel js -->
    <script src="{{ URL::asset('build/libs/owl.carousel/owl.carousel.min.js') }}"></script>

    <!-- ICO landing init -->
    <script src="{{ URL::asset('build/js/pages/ico-landing.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jquery-stepsbuild/jquery.steps.min.js') }}"></script> 

    <!-- form wizard init -->
    <script src="{{ URL::asset('build/js/pages/form-wizard.init.js') }}"></script>

<script>
    $('#change-password').on('submit',function(event){
        event.preventDefault();
        var Id = $('#data_id').val();
        var current_password = $('#current-password').val();
        var password = $('#password').val();
        var password_confirm = $('#password-confirm').val();
        $('#current_passwordError').text('');
        $('#passwordError').text('');
        $('#password_confirmError').text('');
        $.ajax({
            url: "{{ url('update-password') }}" + "/" + Id,
            type:"POST",
            data:{
                "current_password": current_password,
                "password": password,
                "password_confirmation": password_confirm,
                "_token": "{{ csrf_token() }}",
            },
            success:function(response){
                $('#current_passwordError').text('');
                $('#passwordError').text('');
                $('#password_confirmError').text('');
                if(response.isSuccess == false){ 
                    $('#current_passwordError').text(response.Message);
                }else if(response.isSuccess == true){
                    setTimeout(function () {   
                        window.location.href = "{{ route('root') }}"; 
                    }, 1000);
                }
            },
            error: function(response) {
                $('#current_passwordError').text(response.responseJSON.errors.current_password);
                $('#passwordError').text(response.responseJSON.errors.password);
                $('#password_confirmError').text(response.responseJSON.errors.password_confirmation);
            }
        });
    });
</script>

@yield('script')

<!-- App js -->
<script src="{{ URL::asset('build/js/app.js')}}"></script>

@yield('script-bottom')
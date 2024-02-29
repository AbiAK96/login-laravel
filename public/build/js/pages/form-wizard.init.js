$(function () {
    $("#online-registration").steps({
        headerTag: "h3",
        bodyTag: "section",
        transitionEffect: "slide",
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex > newIndex) {
                return true;
            }
            if (currentIndex == 0) {
                var batch = $('input[name="batch"]:checked').val();
                if (batch === undefined) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    toastr.error("Please select the batch.");
                    return false;
                } else {
                    $(this).removeClass('is-invalid');
                    return true;
                }
            } 

            if (currentIndex == 1) {
                var batch = $('input[name="program"]:checked').val();
                if (batch === undefined) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    toastr.error("Please select the program.");
                    return false;
                } else {
                    $(this).removeClass('is-invalid');
                    return true;
                }
            }

            if (currentIndex == 2) {
                var batch = $('input[name="month"]:checked').val();
                if (batch === undefined) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    toastr.error("Please select the month.");
                    return false;
                } else {
                    $(this).removeClass('is-invalid');
                    return true;
                }
            }

            if (currentIndex == 3) {
                var classId = $('input[name="class"]:checked').val();
                if (classId === undefined) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    toastr.error("Please select the class.");
                    return false;
                } else {
                    $(this).removeClass('is-invalid');
                    return true;
                }
            }
            
            if (currentIndex == 4) {
                var package = $('input[name="package"]:checked').val();
                if (package === undefined) {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    toastr.error("Please select the package.");
                    return false;
                } else {
                    $(this).removeClass('is-invalid');
                    return true;
                }
            }
            if (currentIndex == 5) {
                var first_name = $('#first_name').val();
                var last_name = $('#last_name').val();
                var mobile = $('#mobile').val();
                var email = $('#email').val();
                var address = $('#address').val();
                var dob = $('#dob').val();
                var nic_no = $('#nic_no').val();
                var advanced_level_year = $('#advanced_level_year').val();
                var bank = $('.select2').val();
                var formFile = $('#formFile').val(); 
                var district = $('#district').val();
                
                if (first_name === "" || last_name === "" || mobile === "" || email === "" || address === "" || dob === "" || nic_no === "" || advanced_level_year === "" || district === "") {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    toastr.error("Please fill in all required fields.");
                    return false;
                } else {
                    var mobileRegex = /^[0-9]{10}$/;
                    if (!mobileRegex.test(mobile)) {
                        isValid = false;
                        $(this).addClass('is-invalid');
                        toastr.error("Please enter a valid 10-digit mobile number.");
                        return false;
                    } else {
                        $(this).removeClass('is-invalid');
                        return true;
                    }
                }
            }

        },
        onFinished: function (event, currentIndex) {

                var bank = $('.select2').val();
                var formFile = $('#formFile').val();

                if (bank === "" || formFile === "") {
                    isValid = false;
                    $(this).addClass('is-invalid');
                    toastr.error("Please select required fields.");
                    return false;
                }

            $('.actions a[href="#finish"]').prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

            // Continue with the AJAX request
            var csrf_token = $('#csrf_token').val(); 
            var batch_id = $('input[name="batch"]:checked').val();
            var program_id = $('input[name="program"]:checked').val();
            var class_id = $('input[name="class"]:checked').val();
            var package_id = $('input[name="package"]:checked').val();
            var month = $('input[name="month"]:checked').val();
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var mobile = $('#mobile').val();
            var email = $('#email').val();
            var address = $('#address').val();
            var dob = $('#dob').val();
            var nic_no = $('#nic_no').val();
            var advanced_level_year = $('#advanced_level_year').val();
            var payment_type = $('#payment_type').val();
            var account_id = $('#account_id').val();
            var image = $('#formFile').prop('files')[0];
            var district = $('#district').val();

            var formData = new FormData();
            formData.append('image', image);
            formData.append('csrf_token', csrf_token);
            formData.append('batch_id', batch_id);
            formData.append('program_id', program_id);
            formData.append('class_id', class_id);
            formData.append('package_id', package_id);
            formData.append('month', month);
            formData.append('first_name', first_name);
            formData.append('last_name', last_name);
            formData.append('mobile', mobile);
            formData.append('email', email);
            formData.append('address', address);
            formData.append('dob', dob);
            formData.append('nic_no', nic_no);
            formData.append('advanced_level_year', advanced_level_year);
            formData.append('payment_type', payment_type);
            formData.append('account_id', account_id);
            formData.append('district', district);

            $.ajax({
                type: 'POST',
                url: '/online-register/registration',
                data: formData,
                contentType: false,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': csrf_token
                },
                async: false,
                success: function (response) {
                    if (response.success === true) {
                        Swal.fire({
                            title: 'Submitted!',
                            text: response.message,
                            icon: 'success',
                        }).then(function () {
                            window.location.reload();
                        });
    
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                        }).then(function () {
                            window.location.reload();
                        });
                    }
                },
                error: function () {
                    $('.form-select').removeClass('is-invalid');
                    $('.form-control').removeClass('is-invalid');
                    toastr.error("Something is wrong!!");
                    isValid = false;
                }
            });
        }
    });
});

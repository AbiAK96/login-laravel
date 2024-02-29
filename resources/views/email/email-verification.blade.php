@component('mail::message')
# Confirm Your Registration at Pizza

Dear {{$first_name}} <strong></strong>,<br>

Congratulations! You have successfully registered an account with Pizza. We're thrilled to have you on board and excited for the learning journey ahead.<br>

To complete your registration and verify your email address, please click on the button below:<br>

@component('mail::button', ['url' => env('FRONT_BASE_URL'). '/student/email-verification/?token=' . $token . '&email=' . $email])
Verify Now
@endcomponent

Once you've verified your email, you'll gain full access to our platform and all its features.<br>

Additionally, here are your login credentials:<br>

<strong>Username: {{$email}}<br> </strong>
<strong>Password: {{$pin}}<br> </strong>

Please make sure to keep your login details secure.<br>

Thank you for choosing Pizza. We look forward to helping you achieve your educational goals!<br>

Best regards,<br>
Mihins Team
@endcomponent
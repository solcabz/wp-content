<?php

/* 
 Template Name: Form Template
*/
?>

<section class="inquire-section container-lg py-5">
    <div class="row">
        <!-- Inquire Now -->
        <div class="inquire-wrapper col-lg-6 col-md-12 mb-4">
            <h2>Inquire Now</h2>
            <p>Got any questions or recommendations? Contact us!</p>
            <form action="#" method="post" class="inquire-form">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last_name" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="property-interest">Property of Interest</label>
                    <select id="property-interest" name="property_interest" class="form-control" required>
                        <option value="" disabled selected>Select a Property</option>
                        <option value="property1">Property 1</option>
                        <option value="property2">Property 2</option>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="contact-number">Contact Number</label>
                        <input type="text" id="contact-number" name="contact_number" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="email-address">Email Address</label>
                        <input type="email" id="email-address" name="email_address" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" class="form-control" rows="4" required></textarea>
                </div>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="privacy-terms">
                        <label>
                            <input type="checkbox" name="privacy_policy" required>
                            I have read the <a href="/privacy-policy" target="_blank">Privacy Policy</a>.
                        </label>
                        <label>
                            <input type="checkbox" name="terms_conditions" required>
                            I agree to the <a href="/terms-and-conditions" target="_blank">Terms and Conditions</a>.
                        </label>
                    </div>
                </div>
               
                <!-- Google reCAPTCHA -->
                <div class="g-recaptcha" data-sitekey="6LfSuRcrAAAAAEJzNucLpRKth4SDW_hkqUWhgnvE"></div>
                <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
                        $recaptchaResponse = $_POST['g-recaptcha-response'];
                        $secretKey = '6LfSuRcrAAAAAOUWbsb-OzTyjv8-cV2S0LqCXnPP';

                        // Verify the reCAPTCHA response
                        $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$recaptchaResponse");
                        $responseData = json_decode($verifyResponse);

                        if ($responseData->success) {
                            echo "<p class='text-success'>Form submitted successfully!</p>";
                        } else {
                            echo "<p class='text-danger'>reCAPTCHA verification failed. Please try again.</p>";
                        }
                    } else {
                        echo "<p class='text-danger'>Please complete the reCAPTCHA verification.</p>";
                    }
                }
                ?>

                <button type="submit" class="btn btn-dark">Submit</button>
            </form>
        </div>

        <!-- Set An Appointment -->
        <div class="col-lg-6 col-md-12 mb-4">
            <h2>Set An Appointment</h2>
            <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
            <form action="#" method="post" class="appointment-form">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="select-date">Select a Date</label>
                        <input type="date" id="select-date" name="select_date" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="select-time">Select a Time</label>
                        <input type="time" id="select-time" name="select_time" class="form-control" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="appointment-name">Name</label>
                        <input type="text" id="appointment-name" name="appointment_name" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="appointment-contact">Contact Number</label>
                        <input type="text" id="appointment-contact" name="appointment_contact" class="form-control" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="appointment-email">Email Address</label>
                    <input type="email" id="appointment-email" name="appointment_email" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-dark">Submit</button>
            </form>

            <div class="text-center mt-5">
                <h2>Chat Now</h2>
                <p>Lorem ipsum odor amet, consectetuer adipiscing elit.</p>
                <button class="btn btn-dark">Chat Now</button>
            </div>
        </div>
    </div>
</section>


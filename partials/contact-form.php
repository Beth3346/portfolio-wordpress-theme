<?php
///////////////////////////////////////////////////////////////////////////////////////////
// Contact Form
///////////////////////////////////////////////////////////////////////////////////////////
?>

<?php
    $full_name = NULL;
    $email = NULL;
    $phone = NULL;
    $message = NULL;
    $mail_sent = false;
    
    if ( isset($_POST['send'] ) ) {

        require_once( FRAMEWORK . '/forms/Validation.php' );

        $validation_rules = array(
            'full_name' => 'fullName|notags|required|attacks|short',
            'phone' => 'phone|required',
            'email' => 'email|required',
            'message' => 'nourl|notags|required|attacks|short|betweenLength:25:180',
            'hidden_field' => 'honeypot|attacks'
        );

        $validation = new Validation();

        if ( $validation->validate( $_POST, $validation_rules ) == TRUE ) {

            $to = get_bloginfo( 'admin_email' );
            $subject = "WordPress Information Form";

            // create additional headers
            $headers = get_bloginfo( 'admin_email' );
            $headers = 'Content-Type: text/plain; charset=utf-8\r\n';

            $expected = array( 'full_name', 'email', 'message' );

            require_once( FRAMEWORK . '/forms/_process-mail.php' );

            if ( $mail_sent ) {
                echo "<p class='text-success'>Thank You For Contacting Us</p>";
            } elseif ( $errors['mail_fail'] = true ) {
                echo "<p class='text-error'>There was a problem sending your message. Please try again later.</p>";
            }

            // email data
        } else {
            echo '<ul class="text-error">';
            foreach ( $validation->errors as $error ) {
                echo '<li>' . $error . '</li>';
            }
            echo '</ul>';

            // prepare values to preserve input on error

            $full_name = $_POST['full_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $message = $_POST['message'];
        }
    }
?>

<form action="" method="post" id="contact-form">

    <label for="full_name">*Name:</label>
    <input type="text" name="full_name" id="full-name" maxlength="100" required placeholder="First Last" 
        <?php if( !( $mail_sent ) ) {
            echo 'value="' . htmlentities( $full_name ) . '"';
        } ?> 
    >

    <label for="phone">*Phone:</label>
    <input type="tel" name="phone" id="phone" maxlength="100" required placeholder="First Last" 
        <?php if( !( $mail_sent ) ) {
            echo 'value="' . htmlentities( $phone ) . '"';
        } ?> 
    >

    <label for="email">*Email:</label>
    <input type="email" name="email" id="email" required placeholder="youremail@email.com" 
        <?php if( !( $mail_sent ) ) {
            echo 'value="' . htmlentities( $email ) . '"';
        } ?> 
    >

    <label for="message">*How Can We Help You?</label>
    <textarea name="message" id="message" cols="20" rows="5" maxlength="180" required placeholder="Let us know how we can help you"><?php if( !( $mail_sent ) ) {
        echo htmlentities( $message );
    } ?></textarea>
    <small>180 characters max; No urls or tags allowed</small>

    <input type="input" name="hidden_field" class="hidden-field" />

    <input type="submit" name="send" id="send" value="Send" />
</form>
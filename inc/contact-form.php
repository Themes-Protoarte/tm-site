<?php

if ( !isset( $errors ) ) {
  $errors = '';
}

if ( beans_post( 'action' ) === 'tbr_contact' ) {

  // Check message
  if ( !beans_post( 'tbr_message' ) )
    $errors['tbr_message'] = __( 'Please enter your message.', 'tbr' );

  // Check first
  if ( !beans_post( 'tbr_first' ) )
    $errors['tbr_first'] = __( 'Please enter your first name.', 'tbr' );

  // Check last
  if ( !beans_post( 'tbr_last' ) )
    $errors['tbr_last'] = __( 'Please enter your last name.', 'tbr' );

  // Check e-mail
  if ( !$email = beans_post( 'tbr_email' ) )
    $errors['tbr_email'] = __( 'Please enter an e-mail address.', 'tbr' );
  elseif ( !is_email( $email ) )
    $errors['tbr_email'] = __( 'Please enter a valid e-mail address.', 'tbr' );

  // Preceed if no errors
  if ( !isset( $errors ) ) {

    $first = $_POST['tbr_first'];
    $last = $_POST['tbr_last'];
    $email = $_POST['tbr_email'];
    $website = $_POST['tbr_website'];
    $message = $_POST['tbr_message'];
    $subject = 'New message from ' . $first . ' ' . $last;
    $body = "New message received from the ThemeButler site :)\n\nName: {$first} {$last}\nEmail: {$email}\nWebsite: {$website}";
    $body .= "\nMessage: {$message}";
    $headers = "From: {$first} {$last}<{$email}>\r\nReply-To: {$email}";
    wp_mail( 'hello@themebutler.com', $subject, $body, $headers ); ?>

    <div class="uk-text-center uk-block">
      <h2>Nice one! Your message is on its way to my inbox!</h2>
      <p>Expect a reply within 24 hours.</p>
      <a class="uk-button uk-button-primary uk-button-large uk-margin-top" href="<?php echo home_url(); ?>">Back to the site</a>
    </div>

  <?php }

}

?>
  <h1 class="uk-article-title">Say Hello</h1>
  <p class="uk-article-lead">Got something you'd like to discuss? Fill out the form below and I'll get back to you asap.</p>
  <hr class="uk-article-divider">
  <form method="post" class="uk-form" data-tm-form>
    <div class="uk-grid uk-grid-width-1-1 uk-grid-width-medium-1-2 uk-margin-bottom">
      <div class="uk-margin-bottom">
        <label class="uk-form-label" for="tbr_first">First name</label>
        <input class="uk-width-1-1 tm-field<?php if ( $message = beans_get( 'tbr_first', $errors ) ) echo ' tm-field-error'; ?>" type="text" value="<?php echo beans_post( 'tbr_first' ); ?>" placeholder="First name" name="tbr_first" autofocus tabindex="1">
        <?php if ( $message = beans_get( 'tbr_first', $errors ) ) echo '<p class="tm-error">' . $message . '</p>'; ?>
      </div>
      <div class="uk-margin-bottom">
        <label class="uk-form-label" for="tbr_last">Last name</label>
        <input class="uk-width-1-1 tm-field<?php if ( $message = beans_get( 'tbr_last', $errors ) ) echo ' tm-field-error'; ?>" type="text" value="<?php echo beans_post( 'tbr_last' ); ?>" placeholder="Last name" name="tbr_last" tabindex="2">
        <?php if ( $message = beans_get( 'tbr_last', $errors ) ) echo '<p class="tm-error">' . $message . '</p>'; ?>
      </div>
      <div class="uk-margin-bottom">
        <label class="uk-form-label" for="tbr_email">Email address</label>
        <input class="uk-width-1-1 tm-field<?php if ( $message = beans_get( 'tbr_email', $errors ) ) echo ' tm-field-error'; ?>" type="email" value="<?php echo beans_post( 'tbr_email' ); ?>" placeholder="you@yourdomain.com" name="tbr_email" tabindex="3">
        <?php if ( $message = beans_get( 'tbr_email', $errors ) ) echo '<p class="tm-error">' . $message . '</p>'; ?>
      </div>
      <div class="uk-margin-bottom">
        <label class="uk-form-label" for="tbr_website">Website</label>
        <input class="uk-width-1-1 tm-field" type="text" value="<?php echo beans_post( 'tbr_website' ); ?>" placeholder="http://yourwebsite.com" name="tbr_website" tabindex="4">
      </div>
      <div class="uk-width-1-1 uk-form-row tm-form-actions uk-margin-top">
        <label class="uk-form-label" for="tbr_message">Message</label>
        <textarea class="uk-form-large uk-width-1-1 tm-field<?php if ( $message = beans_get( 'tbr_message', $errors ) ) echo ' tm-field-error';?>" cols="13" rows="10" placeholder="Your message" name="tbr_message" tabindex="5"><?php echo beans_post( 'tbr_message' ); ?></textarea>
        <?php if ( $message = beans_get( 'tbr_message', $errors ) ) echo '<p class="tm-error">' . $message . '</p>'; ?>
      </div>
      <div class="uk-width-1-1 uk-form-row tm-form-actions uk-margin-top">
        <input type="hidden" name="action" value="themebutler_contact"/>
        <input type="hidden" name="tb_contact" value="1"/>
        <button class="uk-button uk-button-primary uk-button-large uk-margin-top" name="tb_contact" tabindex="6"><?php _e( 'Submit', 'themebutler' ); ?></button>
      </div>
    </div>

  </form>
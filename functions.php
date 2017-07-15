<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);

function send_contact_email()
{
  require_once('recaptchalib.php');
  $recaptchaResponse = $_POST['g-recaptcha-response'];
  $secretKey = '6Le4oCgUAAAAAJhSA8rS9lfj_oHs0_zN4MwXgnlz';
  $request = json_decode(
    file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$recaptchaResponse)
  );

  $to_email = 'james.levasseur@maine.edu';

  $from = $_POST['first-name'].' '.$_POST['last-name'];

  $subject = $_POST['subject'];

  $message = $_POST['message'].' <br> Name given: '.$from;

  $headers = array('Content-Type: text/html; charset=UTF-8');

  wp_mail($to_email, $subject, $message, $headers);
}

add_action('send_contact_email', 'send_contact_email');

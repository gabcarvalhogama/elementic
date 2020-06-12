https://github.com/elementor/elementor/blob/master/docs/content/pro/forms.md


https://developers.elementor.com/forms-api/#Form_Processing_Action

// A send custom WebHook
add_action( 'elementor_pro/forms/new_record', function( $record, $handler ) {
    //make sure its our form
    $form_name = $record->get_form_settings( 'form_name' );

    // Replace MY_FORM_NAME with the name you gave your form
    if ( 'MY_FORM_NAME' !== $form_name ) {
        return;
    }

    $raw_fields = $record->get( 'fields' );
    $fields = [];
    foreach ( $raw_fields as $id => $field ) {
        $fields[ $id ] = $field['value'];
    }

    // Replace HTTP://YOUR_WEBHOOK_URL with the actuall URL you want to post the form to
    wp_remote_post( 'HTTP://YOUR_WEBHOOK_URL', [
        'body' => $fields,
    ]);
}, 10, 2 );

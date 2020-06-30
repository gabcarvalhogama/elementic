<?php

    class Elementic_Form_Action extends \ElementorPro\Modules\Forms\Classes\Action_Base {
        public function get_name() {return 'Mautic';}

        public function get_label() {return __( 'Mautic', 'text-domain' );}

        /**
         * register elementor forms
         * @param type $widget 
         * @return type
         */
        public function register_settings_section( $widget ) {

            $widget->start_controls_section(
                'section_mautic',
                [
                    'label' => __( 'Mautic', 'text-domain' ),
                    'condition' => [
                        'submit_actions' => $this->get_name(),
                    ],
                ]
            );

            $widget->add_control(
                'mautic_url',
                [
                    'label' => __( 'Mautic Form URL *', 'text-domain' ),
                    'type' => \Elementor\Controls_Manager::URL,
                    'placeholder' => 'http://yourmauticurl.com/',
                    'label_block' => true,
                    'separator' => 'before',
                    'description' => __( 'Enter the URL where you have Mautic installed', 'text-domain' ),
                ]
            );


            $widget->add_control(
                'mautic_form_id',
                [
                    'label' => __('Mautic Form ID *', 'text-domain'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'placeholder' => '99',
                    'label_block' => true,
                    'separator' => 'before',
                    'description' => __( 'Fill with your form id', 'text-domain' ),
                ]
            );


            $widget->end_controls_section();
        }


        public function run( $record, $ajax_handler ) {
            $settings = $record->get( 'form_settings' );

            //  Make sure that there is a Mautic url
            if ( empty( $settings['mautic_url'] ) ) {
                return;
            }

            //  Make sure that there have a Form ID
            if ( empty( $settings['mautic_form_id'] ) ) {
                return;
            }



            // Get sumitetd Form data
            $raw_fields = $record->get( 'fields' );

            // Normalize the Form Data
            $fields = [
                'formId' => $settings['mautic_form_id']
            ];
            foreach ( $raw_fields as $id => $field ) {
                $fields[ $id ] = $field['value'];
            }


            $response = wp_remote_post(rtrim($settings['mautic_url']['url'],"/")."/form/submit?formId=".$settings['mautic_form_id'], [
                'body' => ["mauticform" => $fields]
            ] );


            // $message = preg_match('/<div class=\"well text-center\">(.*?)<\/div>/s', $response['body'], $match);




            // echo trim(strip_tags($match[1]));

        }





        public function on_export( $element ) {
            return $element;
        }
    }
<?php

/**
 * 
 */
Class OD_Custom_Emails {
	
	public $from;
	public $to;
	public $subject;
	public $template_header;
	public $template;
	public $template_footer;

	public function __construct() {

		$this->template_base   	= get_template_directory() .'/woocommerce/emails/';
	    $this->template_header 	= $this->template_base . 'email-header.php';
	    $this->template_footer 	= $this->template_base . 'email-footer.php';

	    $this->img_dir 		   	= 'https://mandalacomidas.com.br/wp-content/themes/mandala/dist/img/emails';
	}

	public function template( $template ) {

		$this->template = $this->template_base . $template . '.php';
	}

	public function login_email() {

		$args = array(
	        'header'    => array(
	            'email_heading' => 'Bem vind@!'
	        ),
	        'main'      => array(
	            'user_login'    => $this->to->data->user_login,
	            'hora_login'    => wp_date( 'd/m/Y à\s H:i:s' )
	        )
	    );

	    $this->send( $args );
	}

	public function updated_email() {

		$args = array(
	        'header'    => array(
	            'email_heading' => 'Cadastro'
	        ),
	        'main'      => array(
	            'user_login'    	=> $this->to->data->user_login,
	            'hora_update'    	=> wp_date( 'd/m/Y à\s H:i:s' )
	        )
	    );

		$this->send( $args );
	}

	public function send( $args ){

		$email = WP_Mail::init()
	    ->from(             $this->from                 			)
	    ->to(               $this->to->data->user_email    			)
	    ->subject(          $this->subject                    		)
	    ->templateHeader(   $this->template_header, $args['header'] )
	    ->template(         $this->template,     	$args['main']   )
	    ->templateFooter(   $this->template_footer					)
	    ->send();
	}
}
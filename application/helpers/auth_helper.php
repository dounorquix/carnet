<?php

function auth_helper(){

	return array(
        array(
                'field' => 'logi',
                'label' => 'Usuario',
                'rules' => 'required|trim',
				'errors' => array(
					'required' => 'El %s es requerido.',
			
	),
        ),
        array(
                'field' => 'pass',
                'label' => 'Contraseña',
                'rules' => 'required|trim',
                'errors' => array(
				'required' => 'La %s es requerida.',
        ),
	),
	
    
		
);	


}


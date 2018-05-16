<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Carga_masiva extends CI_Controller {

	  public function __construct()
		{
			parent::__construct();
			$this->load->database();
			$this->load->config('ion_auth', TRUE);
			$this->load->helper('cookie');
			$this->load->helper('date');
			$this->lang->load('ion_auth');
			$this->load->helper('format');
			$this->load->model('rrhh_model');
		}	

	  public function graba_tipo_contratos(){
	  	
	  	 $nombre = $this->input->post('nombre');
	  	 $idempresa=$this->session->userdata('empresaid');

	  	 //print_r($nombre);

	  	 //exit;

	  	 	  	 
	  	 $array_datos2 = array(
			'tipo' => $nombre,
			'id_empresa' => $idempresa
					);

		$array_datos2['updated_at'] = date("Ymd H:i:s");
		$array_datos2['created_at'] = date("Ymd H:i:s");
				  //$array_datos['created_by'] = $createdby;
		$this->db->insert('rem_tipo_doc_colaborador', $array_datos2);
		
		redirect('configuraciones/tipos_contrato_colaboradores');	     



	  }


	  public function contratos_archivos(){

	  	$tipocontrato = $this->input->post('tipocontrato');
	  	$tipo = $this->input->post("tipo");

	   	
	  	$config['upload_path'] = "./uploads/cargas/";

		//VALIDA QUE CARPETA EXISTA
		if(!file_exists($config['upload_path'])){
			mkdir($config['upload_path'],0777,true);
		}

        $config['file_name'] = date("Ymd")."_".date("His")."_";
        $config['allowed_types'] = "*";
        $config['max_size'] = "10240";

        //carga libreria para cargar archivos
        $this->load->library('upload', $config);

        //Campo a leer
        $this->upload->do_upload("userfile");
   		$dataupload = $this->upload->data();

   		$pdf = file_get_contents($config['upload_path'].$config['file_name'].$dataupload['file_ext']);

   		$pdf = iconv('','UTF-8',$pdf);

   		//print_r($pdf);

   		//exit;

   		$idempresa=$this->session->userdata('empresaid');

		/*$array_datos2 = array(
			'tipo' => $tipocontrato,
			'id_empresa' => $idempresa
					);

		$array_datos2['updated_at'] = date("Ymd H:i:s");
		$array_datos2['created_at'] = date("Ymd H:i:s");
				  //$array_datos['created_by'] = $createdby;
		$this->db->insert('rem_tipo_doc_colaborador', $array_datos2);
		$id = $this->db->insert_id();*/

		

		//exit;

		$array_datos = array(
			'id_tipo_doc_colaborador' => $tipo,
			'id_empresa' => $idempresa,
			'formato_pdf' => $pdf,
			'nom_documento' => $tipocontrato, 
					);

		$array_datos['updated_at'] = date("Ymd H:i:s");
		$array_datos['created_at'] = date("Ymd H:i:s");
				  //$array_datos['created_by'] = $createdby;
		$this->db->insert('rem_formato_doc_colaborador', $array_datos);


		//$this->session->set_flashdata('personal_result',8);
		redirect('configuraciones/tipos_contrato');

 	

	  }

	  

	  public function insertar(){

		//LUEGO DE SUBIR EL ARCHIVO	
		$config['upload_path'] = "./uploads/cargas/";

		//VALIDA QUE CARPETA EXISTA
		if(!file_exists($config['upload_path'])){
			mkdir($config['upload_path'],0777,true);
		}

        $config['file_name'] = date("Ymd")."_".date("His")."_";
        $config['allowed_types'] = "*";
        $config['max_size'] = "10240";

        //carga libreria para cargar archivos
        $this->load->library('upload', $config);

        //Campo a leer
        $this->upload->do_upload("userfile");
   		$dataupload = $this->upload->data();

   		
		//cargamos el archivo
   		$archivotmp = $dataupload['file_ext'];	  	
		//obtenemos el archivo .csv


    	$gestor = fopen("./uploads/cargas/" . $dataupload['file_name'], "r");
    	$i = 0;


	    while (($datos = fgetcsv($gestor, 10000, ";")) !== FALSE) {


			if($i != 0){ 
	       
			       //$datos = explode(";",$linea); 
			       //print_r($datos);
			       $idempresa = $this->session->userdata('empresaid');
			       $rut = (int)$datos[0];
			       $dv = utf8_encode($datos[1]);
			       $nombres = utf8_encode($datos[2]);			       
			       $apellidop = utf8_encode($datos[3]);
			       $apellidom = utf8_encode($datos[4]);
			       $fechanacimiento = $datos[5];
			       $sexo = utf8_encode($datos[6]);
			       $estadocivil = ($datos[7]);
			       $nacionalidad = utf8_encode($datos[8]);
			       $direccion = utf8_encode($datos[9]);
			       $region = $datos[10];
			       $comuna = $datos[11];
			       $fono = $datos[12];
			       $email = $datos[13];			      
			       $fechaingreso = $datos[14];
			       $idcargo = $datos[15];
			       $fecinicvacaciones = $datos[16];
			       $saldoinicvacaciones = $datos[17];
			       $saldoinicvacprog = $datos[18];
			       $diasprogresivos = $datos[19];
			       $diasvactomad = $datos[20];
			       $diasprogtomados = $datos[21];
			       $tipocontrato = utf8_encode($datos[22]);
			       $parttime = $datos[23];
			       $segcesantia = $datos[24];
			       $fecafc = $datos[25];
			       $diastrabajo = $datos[26];
			       $horasdiarias = $datos[27];
			       $horassemanales = $datos[28];
			       $sueldobase = $datos[29];
			       $tipogratificacion = utf8_encode($datos[30]);
			       $gratificacion = $datos[31];
			       $asigfamiliar = $datos[32];
			       $cargassimples = $datos[33];
			       $cargasinvalidas = $datos[34];
			       $cargasmaternales = $datos[35];
			       $cargasretroactivas = $datos[36];
			       $idasigfamiliar = $datos[37];
			       $movilizacion = $datos[38];
			       $colacion = $datos[39];
			       $pensionado = $datos[40];
			       $idafp = $datos[41];
			       $adicafp = $datos[42];
			       $tipoahorrovol = utf8_encode($datos[43]);
			       $ahorrovol = $datos[44];
			       $instapv = $datos[45];
			       $nrocontratoapv = $datos[46];
			       $tipocotapv = $datos[47];
			       $cotapv = $datos[48];
			       $formapagoapv = $datos[49];
			       $depconvapv = $datos[50];
			       $idisapre = $datos[51];
			       $valorpactado = (float)$datos[52];
			       $active = $datos[53];
			       $created_at = $datos[54];
			       $updated_at = $datos[55];
			       $numficha = $datos[56];
			       $idnacionalidad = $datos[57];
			       $tiporenta = $datos[58];
			       $idestudio = $datos[59];
			       $titulo = $datos[60];
			       $ididioma = $datos[61];
			       $idjefe = $datos[62];
			       $idlicencia = $datos[63];
			       $tipodocumento = $datos[64];
			       $tallapolera = $datos[65];
			       $tallapantalon = $datos[66];
			       $idcentrocosto = $datos[67];
			       $cbeneficio = $datos[68];
			       $idreemplazo = $datos[69];
			       $createdby = $datos[70];
			       $idbanco = $datos[71];
			       $numbanco = $datos[72];
			       $semanacorrida = $datos[73];
				   $idcategoria = $datos[74];
				   $lugarpago = $datos[75];
				   $sindicato = $datos[76];
				   $rolprovado = $datos[77];
				   $jubilado = $datos[78];
				   $fecafp = $datos[79];
				   
				   
		           $this->db->select('p.id_personal, p.id_empresa, p.active, p.dv')
						  ->from('rem_personal p')
						  ->where('p.id_empresa',$this->session->userdata('empresaid'))
						  ->where('p.rut', $rut)
						  ->where('p.dv', strtoupper($dv))
						  ->where('p.active is not null')
						 // ->where_in('idcentrocosto',$centro_costo)
		                  ->order_by('p.nombre');
		            $query = $this->db->get();
		            $datos_periodo = $query->row();
		                              
		            		      

			       $array_datos = array(
						'id_empresa' => $idempresa,
			       		'rut' => $rut,
			       		'dv' => strtoupper($dv),			       		
						'nombre' => $nombres,
						'apaterno' => $apellidop,
						'amaterno' => $apellidom,
						'fecnacimiento' => $fechanacimiento,
						'sexo' => $sexo,
						'idecivil' => $estadocivil,
						'nacionalidad' => $nacionalidad, 
						'direccion' => $direccion,
						'idregion' => $region,
						'idcomuna' => $comuna, 
						'fono' => $fono,
						'email' => $email,
						'fecingreso' => $fechaingreso,
						'idcargo' => $idcargo,
						'fecinicvacaciones' => $fecinicvacaciones,
						'saldoinicvacaciones' => $saldoinicvacaciones,
						'saldoinicvacprog' => $saldoinicvacprog,
						'diasprogresivos' => $diasprogresivos,
						'diasvactomados' => $diasvactomad,
						'diasprogtomados' => $diasprogtomados,
						'tipocontrato' => $tipocontrato,
						'parttime' => $parttime,
						'segcesantia' => $segcesantia,
						'fecafc' => $fecafc,
						'diastrabajo' => $diastrabajo,
						'horasdiarias' => $horasdiarias,
						'horassemanales' => $horassemanales,
						'sueldobase' => $sueldobase,
						'tipogratificacion' => $tipogratificacion,
						'gratificacion' => $gratificacion,
						'asigfamiliar' => $asigfamiliar,
						'cargassimples' => $cargassimples,
						'cargasinvalidas' => $cargasinvalidas,
						'cargasmaternales' => $cargasmaternales,
						'cargasretroactivas' => $cargasretroactivas,
						'idasigfamiliar' => $idasigfamiliar,
						'movilizacion' => $movilizacion,
						'colacion' => $colacion,
						'pensionado' => $pensionado,
						'idafp' => (int)$idafp,
						'adicafp' => $adicafp,
						'tipoahorrovol' => $tipoahorrovol,
						'ahorrovol' => $ahorrovol,
						'instapv' => $instapv,
						'nrocontratoapv' => $nrocontratoapv,
						'tipocotapv' => $tipocotapv,
						'cotapv' => $cotapv,
						'formapagoapv' => $formapagoapv,
						'depconvapv' => $depconvapv,
						'idisapre' => $idisapre,
						'valorpactado' => $valorpactado,
						'active' => $active,
						'numficha' => $numficha,
						'idnacionalidad' => $idnacionalidad,
						'tiporenta' => $tiporenta,
						'idestudio' => $idestudio,
						'titulo' => $titulo,
						'ididioma' => $ididioma,
						'idjefe' => $idjefe,						
						'idlicencia' => $idlicencia,
						'tipodocumento' => $tipodocumento,
						'tallapolera' => $tallapolera,
						'tallapantalon' => $tallapantalon,						
						'idcentrocosto' => $idcentrocosto,
						'cbeneficio' => $cbeneficio,
						'idreemplazo' => $idreemplazo,
						'created_by' => $createdby,
						'idbanco' => $idbanco,
						'nrocuentabanco' => $numbanco,
						'semana_corrida' => $semanacorrida,
						'id_categoria' => $idcategoria,
						'id_lugar_pago' => $lugarpago,
						'sindicato' => $sindicato,
						'rol_privado' => $rolprovado,
						'jubilado' => $jubilado,
						'fecafp' => $fecafp,
			
					);
		       	   //guardamos en base de datos la línea leida
		       	  //qprint_r($array_datos);
		       	  $array_datos['created_at'] = date("Ymd H:i:s");
				  $array_datos['created_by'] = "";
				  //$array_datos['created_by'] = $createdby;

				  if(count($datos_periodo) == 0){ 

				  $this->db->insert('rem_personal', $array_datos);

				  }else{
				  
				  $array_datos['updated_at'] = date("Ymd H:i:s");
				  $idpersonal =  $datos_periodo->id_personal;				  
				  $this->db->where('id_personal', $idpersonal);
				  $this->db->update('rem_personal', $array_datos); 
				  	
				  }
			     
	   		 }
	   		 $i++;
		}

		$this->session->set_flashdata('personal_result',8);
		redirect('rrhh/mantencion_personal');

	}

	public function asistencia(){

		//LUEGO DE SUBIR EL ARCHIVO	
		$config['upload_path'] = "./uploads/cargas/";

		//VALIDA QUE CARPETA EXISTA
		if(!file_exists($config['upload_path'])){
			mkdir($config['upload_path'],0777,true);
		}

        $config['file_name'] = date("Ymd")."_".date("His")."_";
        $config['allowed_types'] = "*";
        $config['max_size'] = "10240";

        //carga libreria para cargar archivos
        $this->load->library('upload', $config);

        //Campo a leer
        $this->upload->do_upload("userfile");
   		$dataupload = $this->upload->data();

   		
		//cargamos el archivo
   		$archivotmp = $dataupload['file_ext'];	  	
		//obtenemos el archivo .csv


    	$gestor = fopen("./uploads/cargas/" . $dataupload['file_name'], "r");
    	$i = 0;

    	$array_trabajadores = array();
	    while (($datos = fgetcsv($gestor, 10000, ";")) !== FALSE) {


			if($i != 0){ 
	       
			       $rut = $datos[0];
			       $dv = utf8_encode($datos[1]);
			       $nombres = $datos[2];
			       $dias = $datos[3];
			       $mes = $datos[4];
			       $anno = $datos[5];

			       $idempresa = $this->session->userdata('empresaid');

					$this->db->select('id_personal')
									  ->from('rem_personal')
					                  ->where('rut', $rut)
					                  ->where('id_empresa', $idempresa);
					$query = $this->db->get();

					if(isset($query->row()->id_personal)){
						$id_personal = $query->row()->id_personal;
						$array_trabajadores[$id_personal] = $dias;						

					}

					

			     
	   		 }
	   		 $i++;
		}

		$this->rrhh_model->save_asistencia($array_trabajadores,$mes,$anno);

		//print_r($array_trabajadores);
		//exit;

		$this->session->set_flashdata('asistencia_result',3);
		redirect('rrhh/asistencia');

	}

	public function anticipos(){

		//LUEGO DE SUBIR EL ARCHIVO	
		$config['upload_path'] = "./uploads/cargas/";

		//VALIDA QUE CARPETA EXISTA
		if(!file_exists($config['upload_path'])){
			mkdir($config['upload_path'],0777,true);
		}

        $config['file_name'] = date("Ymd")."_".date("His")."_";
        $config['allowed_types'] = "*";
        $config['max_size'] = "10240";

        //carga libreria para cargar archivos
        $this->load->library('upload', $config);

        //Campo a leer
        $this->upload->do_upload("userfile");
   		$dataupload = $this->upload->data();

   		
		//cargamos el archivo
   		$archivotmp = $dataupload['file_ext'];	  	
		//obtenemos el archivo .csv


    	$gestor = fopen("./uploads/cargas/" . $dataupload['file_name'], "r");
    	$i = 0;

    	$array_trabajadores = array();
	    while (($datos = fgetcsv($gestor, 10000, ";")) !== FALSE) {


			if($i != 0){ 
	       
			       $rut = $datos[0];
			       $dv = utf8_encode($datos[1]);
			       $nombres = $datos[2];
			       $anticipos = $datos[3];
			       $aguinaldo = $datos[4];
			       $mes = $datos[5];
			       $anno = $datos[6];

			       $idempresa = $this->session->userdata('empresaid');		      

					$this->db->select('id_personal')
									  ->from('rem_personal')
					                  ->where('rut', $rut)
					                  ->where('id_empresa', $idempresa);
					$query = $this->db->get();

					if(isset($query->row()->id_personal)){

						$id_personal = $query->row()->id_personal;

						$array_trabajadores[$i]['idtrabajador'] = $id_personal;
					    $array_trabajadores[$i]['anticipos'] = $anticipos;
						$array_trabajadores[$i]['aguinaldo'] = $aguinaldo;
							

					}

					

			     
	   		 }
	   		 $i++;
		}

		$this->rrhh_model->save_anticipo_masiva($array_trabajadores,$mes,$anno);

		
		$this->session->set_flashdata('anticipos_result',1);
		redirect('rrhh/anticipos');

	}

	public function horasextras(){

		//LUEGO DE SUBIR EL ARCHIVO	
		$config['upload_path'] = "./uploads/cargas/";

		//VALIDA QUE CARPETA EXISTA
		if(!file_exists($config['upload_path'])){
			mkdir($config['upload_path'],0777,true);
		}

        $config['file_name'] = date("Ymd")."_".date("His")."_";
        $config['allowed_types'] = "*";
        $config['max_size'] = "10240";

        //carga libreria para cargar archivos
        $this->load->library('upload', $config);

        //Campo a leer
        $this->upload->do_upload("userfile");
   		$dataupload = $this->upload->data();

   		
		//cargamos el archivo
   		$archivotmp = $dataupload['file_ext'];	  	
		//obtenemos el archivo .csv


    	$gestor = fopen("./uploads/cargas/" . $dataupload['file_name'], "r");
    	$i = 0;

    	$array_trabajadores = array();
	    while (($datos = fgetcsv($gestor, 10000, ";")) !== FALSE) {


			if($i != 0){ 
	       
			       $rut = $datos[0];
			       $dv = utf8_encode($datos[1]);
			       $nombres = $datos[2];
			       $horas1 = $datos[3];
			       $horas2 = $datos[4];
			       $mes = $datos[5];
			       $anno = $datos[6];

			        $idempresa = $this->session->userdata('empresaid');

					$this->db->select('id_personal')
									  ->from('rem_personal')
					                  ->where('rut', $rut)
					                  ->where('id_empresa', $idempresa);
					$query = $this->db->get();

					if(isset($query->row()->id_personal)){
					
					$id_personal = $query->row()->id_personal;



					$this->db->select('valorhorasextras100,valorhorasextras50')
									  ->from('rem_remuneracion')
					                  ->where('idpersonal', $id_personal)
					                  ->where('id_empresa', $idempresa);
					$query = $this->db->get();

					
					$monto100 = $query->row()->valorhorasextras100;
					$monto50 = $query->row()->valorhorasextras50;
					$montohorasextras100 = ($monto100 * $horas2 );
				    $montohorasextras50 = ($monto50 * $horas1 );
				    $array_trabajadores[$i]['idtrabajador'] = $id_personal;
				    $array_trabajadores[$i]['horas50'] = $horas2;
					$array_trabajadores[$i]['monto50'] = $montohorasextras50;
					$array_trabajadores[$i]['horas100'] = $horas1;
					$array_trabajadores[$i]['monto100'] = $montohorasextras100;

				}
									
								     
	   		 }
	   		 $i++;
		}

		//print_r($array_trabajadores);
		//exit;

		$this->rrhh_model->save_horas_extraordinarias_masiva($array_trabajadores,$mes,$anno);

		$this->session->set_flashdata('horas_extraordinarias_result',3);
		redirect('rrhh/horas_extraordinarias');

	}

	public function haberes_descuentos(){

		//LUEGO DE SUBIR EL ARCHIVO	
		$config['upload_path'] = "./uploads/cargas/";

		//VALIDA QUE CARPETA EXISTA
		if(!file_exists($config['upload_path'])){
			mkdir($config['upload_path'],0777,true);
		}

        $config['file_name'] = date("Ymd")."_".date("His")."_";
        $config['allowed_types'] = "*";
        $config['max_size'] = "10240";

        //carga libreria para cargar archivos
        $this->load->library('upload', $config);

        //Campo a leer
        $this->upload->do_upload("userfile");
   		$dataupload = $this->upload->data();

   		
		//cargamos el archivo
   		$archivotmp = $dataupload['file_ext'];	  	
		//obtenemos el archivo .csv


    	$gestor = fopen("./uploads/cargas/" . $dataupload['file_name'], "r");
    	$i = 0;

    	$array_datos_hab_descto = array();
	    while (($datos = fgetcsv($gestor, 10000, ";")) !== FALSE) {


			if($i != 0){ 
	       
			       $rut = $datos[0];
			       $dv = utf8_encode($datos[1]);
			       $nombre = $datos[2];
			       $codigo = strval($datos[3]);
			       $monto = $datos[4];
			       $mes = $datos[5];
			       $anno = $datos[6];

			        $idempresa = $this->session->userdata('empresaid');

					$this->db->select('id_personal')
									  ->from('rem_personal')
					                  ->where('rut', $rut)
					                  ->where('id_empresa', $idempresa);
					$query = $this->db->get();

					if(isset($query->row()->id_personal)){
					
					$id_personal = $query->row()->id_personal;

				    };

					$this->db->select('id, nombre')
									  ->from('rem_conf_haber_descuento')
					                  ->where('codigo', $codigo);
					$query = $this->db->get();

					if(isset($query->row()->id)){
					
					$id_hab_descto = $query->row()->id;
					$nombre_desc = $query->row()->nombre;
				

				     }

				 $array_datos_hab_descto[$i]['idtrabajador'] = $id_personal;
		         $array_datos_hab_descto[$i]['lista_montos'] = $monto;
			     $array_datos_hab_descto[$i]['id_hab_descto'] = $id_hab_descto;
			     $array_datos_hab_descto[$i]['nombre'] = $nombre_desc;
									
								     
	   		 }
	   		 $i++;

	   		
			 
		}

		
		$this->rrhh_model->save_hab_descto_variable2($array_datos_hab_descto,$mes,$anno);

		$this->session->set_flashdata('hab_descto_variable_result',1);
		redirect('rrhh/listado_hab_descto_variable');

	}
   
}
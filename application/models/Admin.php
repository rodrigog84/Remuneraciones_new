<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Ion Auth Model
*
* Version: 2.5.2
*
* Author:  Ben Edmunds
* 		   ben.edmunds@gmail.com
*	  	   @benedmunds
*
* Added Awesomeness: Phil Sturgeon
*
* Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
*
* Created:  10.01.2009
*
* Last Change: 3.22.13
*
* Changelog:
* * 3-22-13 - Additional entropy added - 52aa456eef8b60ad6754b31fbdcc77bb
*
* Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
* Original Author name has been kept but that does not mean that the method has not been modified.
*
* Requirements: PHP5 or above
*
*/

class Admin extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->config('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->lang->load('ion_auth');
		$this->load->helper('format');
	}

	public function get_estudios($idestudios = null){
		$estudio_data = $this->db->select('id_estudios, id_empresa, nombre, codigo, valido, created_at')
						  ->from('rem_estudios a')
						  ->where('a.valido = 1')
						  ->order_by('a.nombre');
		$estudio_data = is_null($idestudios) ? $estudio_data : $estudio_data->where('a.id_estudios',$idestudios);  		                  
		$query = $this->db->get();

		//echo $this->db->last_query();
		//exit;

		$datos = is_null($idestudios) ? $query->result() : $query->row();
		return $datos;
	}


	public function get_comunas_by_region($idregion){

		$this->db->select('c.idcomuna , c.nombre ')
						  ->from('rem_comuna as c')
						  ->join('rem_provincia as p','c.idprovincia = p.idprovincia')
						  ->join('rem_region as r','p.idregion = r.id_region')
						  ->where('r.id_region', $idregion)
		                  ->order_by('c.nombre asc');
		$query = $this->db->get();
		$datos = $query->result_array();


		return $datos;

	}		


	public function get_periodo_by_mes($mes,$anno){

			$this->db->select('id_periodo ')
							  ->from('rem_periodo')
							  ->where('mes',$mes)
							  ->where('anno',$anno);

			$query = $this->db->get();	
			return $query->row();						  
	}


	public function add_estudios($array_datos){


		$this->db->select('a.id_estudios')
						  ->from('rem_estudios as a')
		                  ->where('upper(a.nombre)', strtoupper($array_datos['nombre']))
		                  ->where('a.valido = 1');		

		$query = $this->db->get();
		$datos = $query->row();
		if(count($datos) == 0){ // nueva afp  no existe
			if($array_datos['idestudios'] == 0){
				$data = array(
			      	'nombre' => $array_datos['nombre'],
			      	'id_empresa' => $array_datos['id_empresa'],
			      	'codigo' => $array_datos['codigo'],
			      	'valido' => 1,
			      	'fecha' => date('Ymd H:i:s')			      	
				);

				$this->db->insert('rem_estudios', $data);
				$idafp = $this->db->insert_id();

				return 1;
			}else{
				$data = array(
			      	'nombre' => $array_datos['nombre'],
			      	'id_empresa' => $array_datos['id_empresa'],
			      	'codigo' => $array_datos['codigo'],
			      	'valido' => 1,
				);

				$this->db->where('id_estudios', $array_datos['idestudios']);
				$this->db->update('rem_estudios',$data); 
				return 1;
			}
		}else{ // ya existe proveedor nuevo

			if($array_datos['idestudios'] != 0){
				$data = array(
			      	'nombre' => $array_datos['nombre'],
			      	'id_empresa' => $array_datos['id_empresa'],
			      	'codigo' => $array_datos['codigo'],
			      	'valido' => 1,		      	
				);


				$this->db->where('id_estudios', $array_datos['idestudios']);
				$this->db->update('rem_estudios',$data); 
				return 1;
			}else{
				return -1;	
			}
			
		}

	}

	public function delete_estudios($idestudios){


		$this->db->where('id_estudios', $idestudios);
		$this->db->update('rem_estudios',array('valido' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ 
			return 1;
		}else{ 
			return -1;
		}*/



	}

	public function get_centrodecosto($idcentrodecosto = null){
		$centrodecosto_data = $this->db->select('id_centro_costo, id_empresa, nombre, codigo, valido, fecha')
						  ->from('rem_centro_costo a')
						  ->where('a.valido = 1')
						  ->order_by('a.nombre');
		$centrodecosto_data = is_null($idcentrodecosto) ? $centrodecosto_data : $centrodecosto_data->where('a.id_centro_costo',$idcentrodecosto);  		                  
		$query = $this->db->get();

		$datos = is_null($idcentrodecosto) ? $query->result() : $query->row();
		return $datos;
	}

	public function add_centrodecosto($array_datos){


		$this->db->select('a.id_centro_costo')
						  ->from('rem_centro_costo as a')
		                  ->where('upper(a.nombre)', strtoupper($array_datos['nombre']))
		                  ->where('a.valido = 1');		

		$query = $this->db->get();
		$datos = $query->row();
		if(count($datos) == 0){ // nueva afp  no existe
			if($array_datos['idcentrodecosto'] == 0){
				$data = array(
			      	'nombre' => $array_datos['nombre'],
			      	'id_empresa' => $array_datos['id_empresa'],
			      	'codigo' => $array_datos['codigo'],
			      	'valido' => 1,
			      	'fecha' => date('Ymd H:i:s')			      	
				);

				$this->db->insert('rem_centro_costo', $data);
				$idafp = $this->db->insert_id();

				return 1;
			}else{
				$data = array(
			      	'nombre' => $array_datos['nombre'],
			      	'id_empresa' => $array_datos['id_empresa'],
			      	'codigo' => $array_datos['codigo'],
			      	'valido' => 1,
				);

				$this->db->where('id_centro_costo', $array_datos['idcentrodecosto']);
				$this->db->update('rem_centro_costo',$data); 
				return 1;
			}
		}else{ // ya existe proveedor nuevo

			if($array_datos['idcentrodecosto'] != 0){
				$data = array(
			      	'nombre' => $array_datos['nombre'],
			      	'id_empresa' => $array_datos['id_empresa'],
			      	'codigo' => $array_datos['codigo'],
			      	'valido' => 1,		      	
				);


				$this->db->where('id_centro_costo', $array_datos['idcentrodecosto']);
				$this->db->update('rem_centro_costo',$data); 
				return 1;
			}else{
				return -1;	
			}
			
		}

	}

	public function delete_centrodecosto($idcentrodecosto){


		$this->db->where('id_centro_costo', $idcentrodecosto);
		$this->db->update('rem_centro_costo',array('valido' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ 
			return 1;
		}else{ 
			return -1;
		}*/



	}


	public function get_afp($idafp = null){
		$afp_data = $this->db->select('id_afp, nombre, porc, exregimen, codprevired')
						  ->from('rem_afp a')
						  ->where('a.active = 1')
						  ->order_by('a.exregimen')
		                  ->order_by('a.nombre');
		$afp_data = is_null($idafp) ? $afp_data : $afp_data->where('a.id_afp',$idafp);  		                  
		$query = $this->db->get();

		$datos = is_null($idafp) ? $query->result() : $query->row();
		return $datos;
	}	




	public function add_afp($array_datos){


		$this->db->select('a.id_afp')
						  ->from('rem_afp as a')
		                  ->where('upper(a.nombre)', strtoupper($array_datos['nombre']))
		                  ->where('a.active = 1');		

		$query = $this->db->get();
		$datos = $query->row();
		if(count($datos) == 0){ // nueva afp  no existe
			if($array_datos['idafp'] == 0){
				$data = array(
			      	'nombre' => $array_datos['nombre'],
			      	'porc' => $array_datos['porc'],
			      	'exregimen' => $array_datos['exregimen'],
			      	'codprevired' => 0,
			      	'active' => 1,
			      	'updated_at' => date('Ymd H:i:s'),
			      	'created_at' => date('Ymd H:i:s')
				);

				$this->db->insert('rem_afp', $data);
				$idafp = $this->db->insert_id();

				return 1;
			}else{
				$data = array(
			      	'nombre' => $array_datos['nombre'],
			      	'porc' => $array_datos['porc'],
			      	'exregimen' => $array_datos['exregimen']
				);


				$this->db->where('id_afp', $array_datos['idafp']);
				$this->db->update('rem_afp',$data); 
				return 1;
			}
		}else{ // ya existe proveedor nuevo

			if($array_datos['idafp'] != 0){
				$data = array(
			      	'nombre' => $array_datos['nombre'],
			      	'porc' => $array_datos['porc'],
			      	'exregimen' => $array_datos['exregimen']		      	
				);


				$this->db->where('id_afp', $array_datos['idafp']);
				$this->db->update('rem_afp',$data); 
				return 1;
			}else{
				return -1;	
			}
			
		}

	}	



	public function delete_afp($idafp){


		$this->db->where('id_afp', $idafp);
		$this->db->update('rem_afp',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ 
			return 1;
		}else{ 
			return -1;
		}*/



	}	




	public function get_tabla_impuesto(){

		$this->db->select('id_tabla_impuesto, desde, hasta, factor, rebaja, tasa_maxima')
						  ->from('rem_tabla_impuesto')
		                  ->order_by('desde','asc');

		$query = $this->db->get();
		return $query->result();
	}	


	public function edit_tabla_impuesto($array_impuesto){
		foreach ($array_impuesto as $key => $impuesto) {
			$datos = array(
					'desde' => str_replace(",",".",str_replace(".","",$impuesto['desde'])),
					'hasta' => isset($impuesto['hasta']) ? str_replace(",",".",str_replace(".","",$impuesto['hasta'])) : 999999999,
					'factor' => str_replace(",",".",$impuesto['factor']),
					'rebaja' => str_replace(",",".",str_replace(".","",$impuesto['rebaja'])),
					);

			$this->db->where('id_tabla_impuesto', $key);
			$this->db->update('rem_tabla_impuesto',$datos); 
		}
		
		return 1;
	}	



	public function get_tabla_asig_familiar($idtramo = null){

		$tramo_data = $this->db->select('id_tabla_asig_familiar, tramo, desde, hasta, monto')
						  ->from('rem_tabla_asig_familiar')
		                  ->order_by('desde','asc');
		$tramo_data = is_null($idtramo) ? $tramo_data : $tramo_data->where('id_tabla_asig_familiar',$idtramo);  		                  
		$query = $this->db->get();
		return is_null($idtramo) ? $query->result() : $query->row();
		//return $query->result();
	}		



	public function edit_tabla_asig_familiar($array_asig_familiar){

		foreach ($array_asig_familiar as $key => $asig_familiar) {
			$datos = array(
					'desde' => str_replace(".","",$asig_familiar['desde']),
					'hasta' => isset($asig_familiar['hasta']) ? str_replace(".","",$asig_familiar['hasta']) : 999999999,
					'monto' => str_replace(".","",$asig_familiar['monto'])
					);

			$this->db->where('id_tabla_asig_familiar', $key);
			$this->db->update('rem_tabla_asig_familiar',$datos); 
		}
		
		return 1;
	}



	public function get_feriado($idferiado = null){

		$feriado_data = $this->db->select('id_feriado, CONVERT(varchar, fecha, 103) as fecha, fecha as fecha_sformat',false)
						  ->from('rem_feriado f')
						  ->where('f.active = 1')
		                  ->order_by('f.fecha','desc');
		$feriado_data = is_null($idferiado) ? $feriado_data : $feriado_data->where('f.id_feriado',$idferiado);  		                  
		$query = $this->db->get();
		$datos = is_null($idferiado) ? $query->result() : $query->row();
		return $datos;
	}



	public function get_cantidad_feriado($fec_ini,$fec_fin){

		$feriado_data = $this->db->select('count(id_feriado) as cantidad',false)
						  ->from('rem_feriado f')
						  ->where('f.active = 1')
						  ->where("fecha between '" . str_replace("-","",$fec_ini) . "' and '" . str_replace("-","",$fec_fin) . "'");
                  
		$query = $this->db->get();
		return $query->row();
	}




	public function add_feriado($array_datos){


		$this->db->select('f.id_feriado')
						  ->from('rem_feriado as f')
		                  ->where('f.fecha', strtoupper($array_datos['fecha']))
		                  ->where('f.active = 1');		

		$query = $this->db->get();
		$datos = $query->row();
		if(count($datos) == 0){ // nueva afp  no existe
			if($array_datos['idferiado'] == 0){
				$data = array(
			      	'fecha' => $array_datos['fecha'],
			      	'active' => 1,
			      	'created_at' => date('Ymd H:i:s')
				);

				$this->db->insert('rem_feriado', $data);
				$idferiado = $this->db->insert_id();

				return 1;
			}else{
				$data = array(
			      	'fecha' => $array_datos['fecha']
				);


				$this->db->where('id_feriado', $array_datos['idferiado']);
				$this->db->update('rem_feriado',$data); 
				return 1;
			}
		}else{ // ya existe feriado

			if($array_datos['idferiado'] != 0){
				$data = array(
			      	'fecha' => $array_datos['fecha']
				);


				$this->db->where('id_feriado', $array_datos['idferiado']);
				$this->db->update('rem_feriado',$data); 
				return 1;
			}else{
				return -1;	
			}
			
		}

	}	



	public function delete_feriado($idferiado){


		$this->db->where('id_feriado', $idferiado);
		$this->db->update('rem_feriado',array('active' => '0')); 

		return 1;
		/*if($this->db->affected_rows() > 0){ // se eliminó proveedor correctamente
			return 1;
		}else{ // no hubo eliminación de proveedor
			return -1;
		}*/



	}	



	public function empresas_asignadas($userid,$levelid,$empresaid = null){

		$empresa_data = $this->db->select('c.id_empresa, c.nombre ')
						  ->from('rem_empresa as c')
						  ->join('rem_usuario_empresa as uc','c.id_empresa = uc.id_empresa')
		                  ->where('uc.idusuario', $userid)
		                  ->where('c.active = 1')
		                  ->order_by('c.nombre asc');
		$empresa_data = is_null($empresaid) ? $empresa_data : $empresa_data->where('c.id_empresa',$empresaid);  				                 
		$query = $this->db->get();
		$datos = $query->num_rows() == 1 ? $datos = $query->row() : $query->result();
		return $datos;

	}




	public function get_empresas($id_empresa = null){

		$empresas_data = $this->db->select("c.id_empresa, c.nombre, c.rut, c.dv, c.direccion, c.fono, c.fono2, c.idregion, c.idcomuna, c.email, c.saldo, c.caja, c.fondoreserva, c.fondoreservainicial, c.idcaja, c.idmutual, c.porcmutual, c.cajainicial, c.fecinicio, c.fecvencimiento, fecvencimiento as fecvencimiento_sformat, c.fecinicio as fecinicio_sformat ",false)
						  ->from('rem_empresa c')
						  ->where('c.active = 1')
		                  ->order_by('c.nombre asc');

		$empresas_data = is_null($id_empresa) ? $empresas_data : $empresas_data->where('id_empresa',$id_empresa);  		                  
		$query = $this->db->get();
		$datos = is_null($id_empresa) ? $query->result() : $query->row();		
		return $datos;

	}	


	public function get_perfiles($idperfil = null){

		$perfil_data = $this->db->select('l.id, l.name, l.description')
						  ->from('rem_level as l')
						  ->where('l.valid = 1')
		                  ->order_by('l.description asc');

		$perfil_data = is_null($idperfil) ? $perfil_data : $perfil_data->where('l.id',$idperfil);  		                  
		//$perfil_data = $this->session->userdata('comunidadid') == '' ? $perfil_data : $perfil_data->where('l.id <> 4');
		$query = $this->db->get();
		$datos = is_null($idperfil) ? $query->result() : $query->row();		

		return $query->result();

	}	



	/*public function empresas_asignadas($userid,$levelid){

			$comunidad_data = $this->db->select('c.id, c.nombre ')
							  ->from('rem_empresa as c')
							  ->join('rem_usuario_empresa as uc','c.id = uc.id_empresa')
			                  ->where('uc.idusuario', $userid)
			                  ->where('c.active = 1')
			                  //->where("c.fecvencimiento >= '" . date("Y-m-d") . "'")
			                  ->order_by('c.nombre asc');
			//$comunidad_data = is_null($comunidadid) ? $comunidad_data : $comunidad_data->where('c.id_empresa',$comunidadid);  				                 
			$query = $this->db->get();
			$datos = $query->num_rows() == 1 ? $datos = $query->row() : $query->result();
		return $datos;

	}*/



	public function valida_existe_mail($email,$iduser){

			$user_data = $this->db->select('u.id ')
							  ->from('rem_users u')
							  ->where('u.email',$email)
							  ->where('u.active',1);

			$user_data = $iduser == 0 ? $user_data : $user_data->where('u.id <>',$iduser);  	
			$query = $this->db->get();
			return count($query->result()) > 0 ? true : false;

	}


	public function valida_existe_mail_user($email){

			$this->db->select('u.id, u.level, u.active ')
							  ->from('rem_users u')
							  ->where('u.email',$email);

			$query = $this->db->get();
			$usuario = $query->row();

			return count($usuario) > 0 ? $usuario : false;

	}




	public function get_bancos($id_empresa=null){

		$banco_data = $this->db->select("id_banco,cod_sbif,nombre")
						  ->from('rem_banco')
						  ->where('activo = 1')
		                  ->order_by('nombre asc');

			                  
		$query = $this->db->get();
		$datos = is_null($id_empresa) ? $query->result() : $query->row();
		return $datos;

	}	



	public function get_motivo_egreso($id_empresa=null){

		$banco_data = $this->db->select("id_motivo,nombre")
						  ->from('rem_motivo_egreso')
						  ->where('activo = 1')
		                  ->order_by('nombre asc');

			                  
		$query = $this->db->get();
		$datos = is_null($id_empresa) ? $query->result() : $query->row();
		return $datos;

	}	


	public function get_tipo_cc($id_empresa=null){

		$banco_data = $this->db->select("id_tipocc,nombre")
						  ->from('rem_tipo_cc')
						  ->where('activo = 1')
		                  ->order_by('nombre asc');

			                  
		$query = $this->db->get();
		$datos = is_null($id_empresa) ? $query->result() : $query->row();
		return $datos;

	}			



	public function get_seccion($id_empresa=null){

		$banco_data = $this->db->select("id_seccion,nombre")
						  ->from('rem_seccion')
						  ->where('activo = 1')
		                  ->order_by('nombre asc');

			                  
		$query = $this->db->get();
		$datos = is_null($id_empresa) ? $query->result() : $query->row();
		return $datos;

	}	


public function get_situacion_laboral($id_empresa=null){

		$banco_data = $this->db->select("id_situacion,nombre")
						  ->from('rem_situacion_laboral')
						  ->where('activo = 1')
		                  ->order_by('nombre asc');

			                  
		$query = $this->db->get();
		$datos = is_null($id_empresa) ? $query->result() : $query->row();
		return $datos;

	}	

public function get_clases($id_empresa=null){

		$banco_data = $this->db->select("id_clase,nombre")
						  ->from('rem_clase')
						  ->where('activo = 1')
		                  ->order_by('nombre asc');

			                  
		$query = $this->db->get();
		$datos = is_null($id_empresa) ? $query->result() : $query->row();
		return $datos;

	}	


public function get_ine($id_empresa=null){

		$banco_data = $this->db->select("id_ine,nombre")
						  ->from('rem_ine')
						  ->where('activo = 1')
		                  ->order_by('nombre asc');

			                  
		$query = $this->db->get();
		$datos = is_null($id_empresa) ? $query->result() : $query->row();
		return $datos;

	}				


public function get_zona_brecha($id_empresa=null){

		$banco_data = $this->db->select("id_zona,nombre")
						  ->from('rem_zona_brecha')
						  ->where('activo = 1')
		                  ->order_by('nombre asc');

			                  
		$query = $this->db->get();
		$datos = is_null($id_empresa) ? $query->result() : $query->row();
		return $datos;

	}	

	public function get_forma_pago($id_empresa=null){

		$banco_data = $this->db->select("id_forma_pago, descripcion")
						  ->from('rem_formas_pago')
						  //->where('id_empresa',$this->session->userdata('empresaid'))
		                  ->order_by('descripcion asc');

			                  
		$query = $this->db->get();
		$datos = is_null($id_empresa) ? $query->result() : $query->row();
		return $datos;

	}	


	public function get_jornada_trabajo($id_empresa=null){

		$banco_data = $this->db->select("id_jornada,nombre")
						  ->from('rem_jornada_trabajo')
						  ->where('id_empresa',$this->session->userdata('empresaid'))
		                  ->order_by('nombre asc');

			                  
		$query = $this->db->get();
		$datos = is_null($id_empresa) ? $query->result() : $query->row();
		return $datos;

	}	



	public function get_vestuario_pantalon($id_empresa=null){

		$vestuario_pantalon = $this->db->select('id_vestuario,tipo_vestuario,talla')
									  ->from('rem_vestuario')
									 // ->where('id_empresa',$this->session->userdata('empresaid'))
									  ->where('tipo_vestuario','pantalon');
					                  
		//$vestuario_pantalon = is_null($id_empresa) ? $empresas_data : $empresas_data->where('id_empresa',$id_empresa);  		                  
		$query = $this->db->get();
		$datos = is_null($id_empresa) ? $query->result() : $query->row();		
		return $datos;		

	}


	public function get_vestuario_polera($id_empresa=null){

		$vestuario_pantalon = $this->db->select('id_vestuario,tipo_vestuario,talla')
									  ->from('rem_vestuario')
									 // ->where('id_empresa',$this->session->userdata('empresaid'))
									  ->where('tipo_vestuario','polera');
					                  
		//$vestuario_pantalon = is_null($id_empresa) ? $empresas_data : $empresas_data->where('id_empresa',$id_empresa);  		                  
		$query = $this->db->get();
		$datos = is_null($id_empresa) ? $query->result() : $query->row();		
		return $datos;		

	}



public function get_cargo_colaborador($idtrabajador = null){

		$personal_data = $this->db->select('p.id_personal, p.id_empresa, p.rut, p.dv, p.nombre, p.apaterno, p.amaterno, p.fecnacimiento, p.sexo, p.idecivil, p.nacionalidad, p.direccion, 
		p.idregion, p.idcomuna, p.fono, p.email, p.fecingreso, p.idcargo, p.tipocontrato, p.parttime, p.segcesantia, p.fecafc, p.diastrabajo, p.horasdiarias, 
		p.horassemanales, p.sueldobase, p.tipogratificacion, p.gratificacion, p.asigfamiliar, p.cargassimples, p.cargasinvalidas, p.cargasmaternales, p.cargasretroactivas, 
		p.idasigfamiliar, p.movilizacion, p.colacion, p.pensionado,p.idafp, p.adicafp, p.tipoahorrovol, p.ahorrovol, p.instapv, p.nrocontratoapv, p.tipocotapv, 
		p.cotapv, p.formapagoapv, p.depconvapv, p.idisapre, p.valorpactado, p.fecinicvacaciones, p.saldoinicvacaciones, p.saldoinicvacprog, p.active, c.nombre nombre_cargo')
						  ->from('rem_personal p, rem_cargos c')
						  ->where('p.id_empresa',$this->session->userdata('empresaid'))
						  ->where('c.id_cargos = p.idcargo')
						  ->order_by('p.active','desc')
		                  ->order_by('p.apaterno');
		$personal_data = is_null($idtrabajador) ? $personal_data : $personal_data->where('p.id_personal',$idtrabajador);  		                  
		$query = $this->db->get();
		$datos = is_null($idtrabajador) ? $query->result() : $query->row();
		return $datos;
	}

public function get_personal_total($idtrabajador = null){

		$personal_data = $this->db->select('id_personal, id_empresa, rut, dv, nombre, apaterno, amaterno, fecnacimiento, sexo, idecivil, nacionalidad, direccion, idregion, idcomuna, fono, email, fecingreso, idcargo, tipocontrato, parttime, segcesantia, fecafc, diastrabajo, horasdiarias, horassemanales, sueldobase, tipogratificacion, gratificacion, asigfamiliar, cargassimples, cargasinvalidas, cargasmaternales, cargasretroactivas, idasigfamiliar, movilizacion, colacion, pensionado, idafp, adicafp, tipoahorrovol, ahorrovol, instapv, nrocontratoapv, tipocotapv, cotapv, formapagoapv, depconvapv, idisapre, valorpactado, fecinicvacaciones, saldoinicvacaciones, saldoinicvacprog, active')
						  ->from('rem_personal p')
						  ->where('p.id_empresa',$this->session->userdata('empresaid'))
						  ->order_by('p.active','desc')
		                  ->order_by('p.nombre');
		$personal_data = is_null($idtrabajador) ? $personal_data : $personal_data->where('p.id_personal',$idtrabajador);  		                  
		$query = $this->db->get();
		$datos = is_null($idtrabajador) ? $query->result() : $query->row();
		return $datos;
	}
	
	public function get_personal_total_paso($idtrabajador = null){

		$personal_data = $this->db->select('id_personal, id_empresa, rut, dv, nombre, apaterno, amaterno, fecnacimiento, sexo, idecivil, nacionalidad, direccion, idregion, idcomuna, fono, email, fecingreso, idcargo, tipocontrato, parttime, segcesantia, fecafc, diastrabajo, horasdiarias, horassemanales, sueldobase, tipogratificacion, gratificacion, asigfamiliar, cargassimples, cargasinvalidas, cargasmaternales, cargasretroactivas, idasigfamiliar, movilizacion, colacion, pensionado, idafp, adicafp, tipoahorrovol, ahorrovol, instapv, nrocontratoapv, tipocotapv, cotapv, formapagoapv, depconvapv, idisapre, valorpactado, fecinicvacaciones, saldoinicvacaciones, saldoinicvacprog, active')
						  ->from('rem_personal_paso p')
						  ->where('p.id_empresa',$this->session->userdata('empresaid'))
						  ->order_by('p.active','desc')
		                  ->order_by('p.nombre');
		$personal_data = is_null($idtrabajador) ? $personal_data : $personal_data->where('p.id_personal',$idtrabajador);  		                  
		$query = $this->db->get();
		$datos = is_null($idtrabajador) ? $query->result() : $query->row();
		return $datos;
	}	


	public function get_apv($idapv = null){

		$apv_data = $this->db->select('id_apv, nombre, codprevired')
						  ->from('rem_apv a')
						  ->where('a.active = 1')
		                  ->order_by('a.nombre');
		$apv_data = is_null($idapv) ? $apv_data : $apv_data->where('a.id_apv',$idapv);  		                  
		$query = $this->db->get();
		$datos = is_null($idapv) ? $query->result() : $query->row();
		return $datos;
	}	


public function get_isapre($idisapre = null){

		$isapre_data = $this->db->select('id_isapre, nombre, codprevired')
						  ->from('rem_isapre i')
						  ->where('i.active = 1')
		                  ->order_by('i.id_isapre');
		$isapre_data = is_null($idisapre) ? $isapre_data : $isapre_data->where('i.id_isapre',$idisapre);  		                  
		$query = $this->db->get();
		$datos = is_null($idisapre) ? $query->result() : $query->row();
		return $datos;
	}


public function get_cajas_compensacion($idcaja = null){

		$caja_data = $this->db->select('id_cajas_compensacion, nombre, codprevired')
						  ->from('rem_cajas_compensacion c')
						  ->where('c.active = 1')
		                  ->order_by('c.id_cajas_compensacion');
		$caja_data = is_null($idcaja) ? $caja_data : $caja_data->where('c.id_cajas_compensacion',$idcaja);  		                  
		$query = $this->db->get();
		$datos = is_null($idcaja) ? $query->result() : $query->row();
		return $datos;
	}		


public function get_mutual_seguridad($idmutual = null){

		$mutual_data = $this->db->select('id_mutual_seguridad, nombre, codprevired')
						  ->from('rem_mutual_seguridad m')
						  ->where('m.active = 1')
		                  ->order_by('m.id_mutual_seguridad');
		$mutual_data = is_null($idmutual) ? $mutual_data : $mutual_data->where('m.id_mutual_seguridad',$idmutual);  		                  
		$query = $this->db->get();
		$datos = is_null($idmutual) ? $query->result() : $query->row();
		return $datos;
	}	


public function get_parametros_generales(){

		$comunidades_data = $this->db->select('uf , sueldominimo, tasasis, topeimponible, topeimponibleips, topeimponibleafc, utm')
						  ->from('rem_parametros_generales');
		$query = $this->db->get();						  
		return $query->row();

	}	


	public function edit_parametros_generales($parametros){


		$this->db->update('rem_parametros_generales',$parametros); 
		if($this->db->affected_rows() > 0){ 
			return 1;
		}else{ 
			return -1;
		}

	}	

	public function get_regiones(){

		$this->db->select('id_region , nombre ')
						  ->from('rem_region')
		                  ->order_by('id_region asc');
		$query = $this->db->get();
		$datos = $query->result();

		return $datos;

	}	

	public function get_categoria($idcategoria = null){

		$categoria_data = $this->db->select('id_categoria, nombre')
						  ->from('rem_categoria')
		                  ->order_by('nombre');
		$categoria_data = is_null($idcategoria) ? $categoria_data : $categoria_data->where('id_categoria',$idcategoria);  		                  
		$query = $this->db->get();
		$datos = is_null($idcategoria) ? $query->result() : $query->row();
		return $datos;
	}	


	public function get_lugar_pago($idlugarpago = null){

		$lugar_pago = $this->db->select('id_lugar_pago, nombre')
						  ->from('rem_lugar_pago')
		                  ->order_by('nombre');
		$lugar_pago = is_null($idlugarpago) ? $lugar_pago : $lugar_pago->where('id_lugar_pago',$idlugarpago);  		                  
		$query = $this->db->get();
		$datos = is_null($idlugarpago) ? $query->result() : $query->row();
		return $datos;
	}	


public function get_estado_civil(){

		$this->db->select('id_estado_civil , nombre ')
						  ->from('rem_estado_civil')
						  ->where('activo = 1')
		                  ->order_by('id_estado_civil asc');
		$query = $this->db->get();

		return $query->result();

	}		



public function get_cargos($idcargo = null){
		$cargos_data = $this->db->select('c.id_cargos , c.id_empresa, c.nombre, c.id_padre, c2.nombre as nombrepadre,  (select count(*) from rem_cargos where id_padre = c.id_cargos) as hijos ', false)
						  ->from('rem_cargos c')
						  ->join('rem_cargos c2','c.id_padre = c2.id_cargos','left')
						  ->where('(c.id_empresa = '.$this->session->userdata('empresaid') . ' or c.id_empresa is null)')
						  ->where('c.activo = 1')
		                  ->order_by('c.nombre asc');
		$cargos_data = is_null($idcargo) ? $cargos_data : $cargos_data->where('c.id_cargos',$idcargo);  		                  
		$query = $this->db->get();
		$datos = is_null($idcargo) ? $query->result() : $query->row();
		return $datos;
	}	



	public function datos_empresa($empresaid){

		$this->db->select('c.id_empresa, c.nombre, c.rut, c.dv, c.direccion, co.nombre as comuna, c.maxfolioabono, c.maxfoliopago, c.textoggcc, c.logo ')
						  ->from('rem_empresa as c')
						  ->join('rem_comuna as co','c.idcomuna = co.idcomuna','left')
		                  ->where('c.id_empresa', $empresaid)
		                  ->order_by('c.nombre asc');
		$query = $this->db->get();
		$datos = $query->row();
		return $datos;

	}	


	/*public function get_permite_periodo($mes,$anno){

		$this->db->trans_start();
		$datos_empresa = $this->get_empresas($this->session->userdata('empresaid'));
		$idperiodoinicio = isset($datos_empresa->idperiodoinicio) ? $datos_empresa->idperiodoinicio : 1;
		$datos_periodo = $this->get_datos_periodo_by_id($idperiodoinicio);
		$periodo_seleccionado = $anno."-".str_pad($mes,2,"0",STR_PAD_LEFT)."-01";
		$periodo_inicio = $datos_periodo->anno."-".str_pad($datos_periodo->mes,2,"0",STR_PAD_LEFT)."-01";
		$fecha_seleccionada = strtotime($periodo_seleccionado);
		$fecha_inicio = strtotime($periodo_inicio);
		$this->db->trans_complete();
		if($fecha_seleccionada < $fecha_inicio){
			return false;
		}else{
			return true;
		}
	}	*/


public function get_bonos($idtrabajador = null){

		//$bonos_data = $this->db->select('id, idpersonal, descripcion, monto, date_format(fecha,"%d/%m/%Y") as fecha, proporcional, imponible, fijo')
			$bonos_data = $this->db->select('id_bono, idpersonal, descripcion, monto, fecha')	
						  ->from('rem_bonos_personal b')
						  ->where('b.idpersonal',$idtrabajador)
						  ->where('b.valido',1)
		                  ->order_by('b.id');
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_tipo_contrato($idtipocontrato = null){

		$tipocontrato = $this->db->select('id_tipo_doc_colaborador, tipo')	
						  ->from('rem_tipo_doc_colaborador')
		                  ->order_by('tipo');
		$tipocontrato = is_null($idtipocontrato) ? $tipocontrato : $tipocontrato->where('id_tipo_doc_colaborador',$idtipocontrato);  		                  
		$query = $this->db->get();
		return $query->result();
	}

	public function get_personal_contrato($rut = null){

		$tipo=1;

		$this->db->select('c.id_doc_colaborador,c.id_formato_doc_colaborador, c.id_personal, c.id_empresa, c.id_tipo_doc_colaborador, c.created_by, co.nom_documento as documento')
			->from('rem_doc_colaborador as c')
			->join('rem_formato_doc_colaborador as co','c.id_formato_doc_colaborador = co.id_formato_doc_colaborador','left')
		    ->where('c.id_personal', $rut)
		    ->where('c.id_tipo_doc_colaborador', $tipo)
		    ->where('c.id_empresa', $this->session->userdata('empresaid'))
		    ->order_by('c.created_by asc');

		
		$query = $this->db->get();
		return $query->result();
	}

	public function get_personal_carta($rut = null){

		$tipo=3;

		$this->db->select('c.id_doc_colaborador,c.id_formato_doc_colaborador, c.id_personal, c.id_empresa, c.id_tipo_doc_colaborador, c.created_by, co.nom_documento as documento')
			->from('rem_doc_colaborador as c')
			->join('rem_formato_doc_colaborador as co','c.id_formato_doc_colaborador = co.id_formato_doc_colaborador','left')
		    ->where('c.id_personal', $rut)
		    ->where('c.id_tipo_doc_colaborador', $tipo)
		    ->where('c.id_empresa', $this->session->userdata('empresaid'))
		    ->order_by('c.created_by asc');

		
		$query = $this->db->get();
		return $query->result();
	}

	public function get_personal_finiquitos($rut = null){

		$tipo=2;

		$this->db->select('c.id_doc_colaborador,c.id_formato_doc_colaborador, c.id_personal, c.id_empresa, c.id_tipo_doc_colaborador, c.created_by, co.nom_documento as documento')
			->from('rem_doc_colaborador as c')
			->join('rem_formato_doc_colaborador as co','c.id_formato_doc_colaborador = co.id_formato_doc_colaborador','left')
		    ->where('c.id_personal', $rut)
		    ->where('c.id_tipo_doc_colaborador', $tipo)
		    ->where('c.id_empresa', $this->session->userdata('empresaid'))
		    ->order_by('c.created_by asc');

		
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_tipo_documento($idtipo = null){
		
		$idtipo_data = $this->db->select('id_formato_doc_colaborador,id_tipo_doc_colaborador, nom_documento, created_at')
						  ->from('rem_formato_doc_colaborador')
						  ->where('id_tipo_doc_colaborador',$idtipo)
						    ->where('id_empresa', $this->session->userdata('empresaid'))

		                  ->order_by('nom_documento');
		
   		$query = $this->db->get();   		
		return $query->result();
	}		




	public function get_paises($idpais = null){

		$paises_data = $this->db->select('id_paises, iso, nombre')	
						  ->from('rem_paises')
		                  ->order_by('nombre');
		$paises_data = is_null($idpais) ? $paises_data : $paises_data->where('id_paises',$idpais);  		                  
		$query = $this->db->get();
		return $query->result();
	}

	public function get_contratos($idcontrato = null){

		$contratos_data = $this->db->select('id_tipo_doc_colaborador, tipo')	
						  ->from('rem_tipo_doc_colaborador')
		                  ->order_by('tipo');
		$contratos_data = is_null($idcontrato ) ? $contratos_data : $contratos_data->where('id_tipo_doc_colaborador',$ididioma);  		                  
		$query = $this->db->get();
		return $query->result();
	}



	public function get_idiomas($ididioma = null){

			$idiomas_data = $this->db->select('id_idioma, nombre')	
						  ->from('rem_idioma')
						  ->where('valido',1)
		                  ->order_by('nombre');
		$idiomas_data = is_null($ididioma) ? $idiomas_data : $idiomas_data->where('id_idioma',$ididioma);  		                  
		$query = $this->db->get();
		return $query->result();
	}

	public function get_licencia_conducir($idlicencia = null){

			$licencia_data = $this->db->select('id_licencia_conducir, nombre')	
						  ->from('rem_licencia_conducir')
						  ->where('valido',1)
		                  ->order_by('nombre');
		$licencia_data = is_null($idlicencia) ? $licencia_data : $licencia_data->where('id_licencia_conducir',$idlicencia);  		                  
		$query = $this->db->get();
		return $query->result();
	}



	public function get_centro_costo($idcentrocosto = null){

			$centrocosto_data = $this->db->select('id_centro_costo, nombre, codigo')	
						  ->from('rem_centro_costo')
						  ->where('valido',1)
						  ->where('id_empresa',$this->session->userdata('empresaid'))
		                  ->order_by('nombre');
		$centrocosto_data = is_null($idcentrocosto) ? $centrocosto_data : $centrocosto_data->where('id_centro_costo',$idcentrocosto);  		                  
		$query = $this->db->get();

		return $query->result();
	}	



	public function get_periodo_by_id($idperiodo){

		$this->db->select('p.id_periodo, p.mes, p.anno, pr.anticipo, pr.cierre, pr.aprueba')
						  ->from('rem_periodo as p')
						  ->join('rem_periodo_remuneracion as pr','p.id_periodo = pr.id_periodo')
						  ->where('pr.id_empresa', $this->session->userdata('empresaid'))
		                  ->where('p.id_periodo', $idperiodo);
		$query = $this->db->get();
		$datos = $query->num_rows() == 1 ? $datos = $query->row() : $query->result();

		return $datos;

	}	



	public function get_users($iduser = null){

		$usuario_data = $this->db->select("distinct u.id, u.first_name, u.last_name, u.first_name+' '+u.last_name as nombre, u.email, u.level, l.description as levelname",false)
						  ->from('rem_users as u')
						  ->join('rem_level as l','u.level = l.id')
						  ->join('rem_usuario_empresa as ue','u.id = ue.idusuario','left')
						  ->where('u.active = 1')
						  ->where('l.valid = 1')
		                  ->order_by('u.first_name asc, u.last_name asc');

		$usuario_data = is_null($iduser) ? $usuario_data : $usuario_data->where('u.id',$iduser);  	
		//$usuario_data = $this->session->userdata('comunidadid') == '' ? $usuario_data : $usuario_data->where_in('u.level',array(1,2,3))->where('if(u.level = 3,p.idcomunidad=' . $this->session->userdata('comunidadid') . ',uc.idcomunidad= ' . $this->session->userdata('comunidadid') . ')',NULL,FALSE);  	

		$query = $this->db->get();
		//echo $this->db->last_query();
		$datos = is_null($iduser) ? $query->result() : $query->row();		

		return $datos;

	}	




}




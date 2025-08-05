<?php

namespace Model;
use Model\ActiveRecord;

class EvaEvaluacion extends ActiveRecord {
    
    public static $tabla = 'eva_evaluacion';
    public static $idTabla = 'eva_id';
    public static $columnasDB = 
    [
        'eva_periodo',
        'eva_renglon',
        'eva_linea',
        'eva_dest_actual',
        'eva_cat1',
        'eva_cat2',
        'eva_cat3',
        'eva_arma1',
        'eva_arma2',
        'eva_arma3',
        'eva_grado1',
        'eva_grado2',
        'eva_grado3',
        'eva_empleo1',
        'eva_empleo2',
        'eva_empleo3',
        'eva_tiempo1',
        'eva_tiempo2',
        'eva_tiempo3',
        'eva_emp_ant',
        'eva_situacion',
        'eva_obs_inm',
        'eva_obs_fnal',
        'eva_dep',
        'eva_obs',
        'eva_usuario',
        'eva_fecha_aprov'
    ];
    
    public $eva_id;
    public $eva_periodo;
    public $eva_renglon;
    public $eva_linea;
    public $eva_dest_actual;
    public $eva_cat1;
    public $eva_cat2;
    public $eva_cat3;
    public $eva_arma1;
    public $eva_arma2;
    public $eva_arma3;
    public $eva_grado1;
    public $eva_grado2;
    public $eva_grado3;
    public $eva_empleo1;
    public $eva_empleo2;
    public $eva_empleo3;
    public $eva_tiempo1;
    public $eva_tiempo2;
    public $eva_tiempo3;
    public $eva_emp_ant;
    public $eva_situacion;
    public $eva_obs_inm;
    public $eva_obs_fnal;
    public $eva_dep;
    public $eva_obs;
    public $eva_usuario;
    public $eva_fecha_aprov;
    
    public function __construct($evaluacion = [])
    {
        $this->eva_id = $evaluacion['eva_id'] ?? null;
        $this->eva_periodo = $evaluacion['eva_periodo'] ?? '';
        $this->eva_renglon = $evaluacion['eva_renglon'] ?? null;
        $this->eva_linea = $evaluacion['eva_linea'] ?? null;
        $this->eva_dest_actual = $evaluacion['eva_dest_actual'] ?? '';
        $this->eva_cat1 = $evaluacion['eva_cat1'] ?? null;
        $this->eva_cat2 = $evaluacion['eva_cat2'] ?? null;
        $this->eva_cat3 = $evaluacion['eva_cat3'] ?? null;
        $this->eva_arma1 = $evaluacion['eva_arma1'] ?? null;
        $this->eva_arma2 = $evaluacion['eva_arma2'] ?? null;
        $this->eva_arma3 = $evaluacion['eva_arma3'] ?? null;
        $this->eva_grado1 = $evaluacion['eva_grado1'] ?? null;
        $this->eva_grado2 = $evaluacion['eva_grado2'] ?? null;
        $this->eva_grado3 = $evaluacion['eva_grado3'] ?? null;
        $this->eva_empleo1 = $evaluacion['eva_empleo1'] ?? '';
        $this->eva_empleo2 = $evaluacion['eva_empleo2'] ?? '';
        $this->eva_empleo3 = $evaluacion['eva_empleo3'] ?? '';
        $this->eva_tiempo1 = $evaluacion['eva_tiempo1'] ?? '';
        $this->eva_tiempo2 = $evaluacion['eva_tiempo2'] ?? '';
        $this->eva_tiempo3 = $evaluacion['eva_tiempo3'] ?? '';
        $this->eva_emp_ant = $evaluacion['eva_emp_ant'] ?? '';
        $this->eva_situacion = $evaluacion['eva_situacion'] ?? 1;
        $this->eva_obs_inm = $evaluacion['eva_obs_inm'] ?? '';
        $this->eva_obs_fnal = $evaluacion['eva_obs_fnal'] ?? '';
        $this->eva_dep = $evaluacion['eva_dep'] ?? null;
        $this->eva_obs = $evaluacion['eva_obs'] ?? '';
        $this->eva_usuario = $evaluacion['eva_usuario'] ?? null;
        $this->eva_fecha_aprov = $evaluacion['eva_fecha_aprov'] ?? null;
    }
    
    public static function EliminarEvaluacion($id){
        $sql = "UPDATE eva_evaluacion SET eva_situacion = 0 WHERE eva_id = $id";
        return self::SQL($sql);
    }
}
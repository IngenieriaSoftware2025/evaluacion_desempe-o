<?php

namespace Model;
use Model\ActiveRecord;

class EvaluacionEspecialistas extends ActiveRecord {
    
    public static $tabla = 'eva_datos';
    public static $idTabla = 'dat_cat_evaluado';
    public static $columnasDB = 
    [
        'dat_cat_evaluado',
        'dat_anio',
        'dat_grado',
        'dat_depen',
        'dat_puesto',
        'dat_tiempo',
        'dat_grado_eva',
        'dat_arma_eva',
        'dat_puesto_eva',
        'dat_tiempo_eva',
        'dat_situacion'
    ];
    
    public $dat_cat_evaluado;
    public $dat_anio;
    public $dat_grado;
    public $dat_depen;
    public $dat_puesto;
    public $dat_tiempo;
    public $dat_grado_eva;
    public $dat_arma_eva;
    public $dat_puesto_eva;
    public $dat_tiempo_eva;
    public $dat_situacion;
    
    public function __construct($evaluacion = [])
    {
        $this->dat_cat_evaluado = $evaluacion['dat_cat_evaluado'] ?? null;
        $this->dat_anio = $evaluacion['dat_anio'] ?? null;
        $this->dat_grado = $evaluacion['dat_grado'] ?? null;
        $this->dat_depen = $evaluacion['dat_depen'] ?? null;
        $this->dat_puesto = $evaluacion['dat_puesto'] ?? '';
        $this->dat_tiempo = $evaluacion['dat_tiempo'] ?? null;
        $this->dat_grado_eva = $evaluacion['dat_grado_eva'] ?? null;
        $this->dat_arma_eva = $evaluacion['dat_arma_eva'] ?? null;
        $this->dat_puesto_eva = $evaluacion['dat_puesto_eva'] ?? '';
        $this->dat_tiempo_eva = $evaluacion['dat_tiempo_eva'] ?? null;
        $this->dat_situacion = $evaluacion['dat_situacion'] ?? 1;
    }
    
    public static function EliminarEvaluacion($catalogo){
        $sql = "UPDATE eva_datos SET dat_situacion = 0 WHERE dat_cat_evaluado = $catalogo";
        return self::SQL($sql);
    }
}
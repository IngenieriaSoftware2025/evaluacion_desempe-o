<?php

namespace Model;

use Model\ActiveRecord;

class EvaluacionFormulario extends ActiveRecord
{

    public static $tabla = 'eva_boleta';
    public static $idTabla = 'bol_cat_evaluado';
    public static $columnasDB =
    [
        'bol_cat_evaluado',
        'bol_anio',
        'bol_cat_evaluador',
        'bol_ceom',
        'bol_perfil',
        'bol_pafe',
        'bol_eva1',
        'bol_eva2',
        'bol_eva3',
        'bol_eva4',
        'bol_demeritos',
        'bol_arrestos',
        'bol_total_salud',
        'bol_total_concep',
        'bol_total',
        'bol_accion_mot',
        'bol_accion_correc',
        'bol_cat_g1',
        'bol_cat_comte',
        'bol_obs'
    ];

    public $bol_cat_evaluado;
    public $bol_anio;
    public $bol_cat_evaluador;
    public $bol_ceom;
    public $bol_perfil;
    public $bol_pafe;
    public $bol_eva1;
    public $bol_eva2;
    public $bol_eva3;
    public $bol_eva4;
    public $bol_demeritos;
    public $bol_arrestos;
    public $bol_total_salud;
    public $bol_total_concep;
    public $bol_total;
    public $bol_accion_mot;
    public $bol_accion_correc;
    public $bol_cat_g1;
    public $bol_cat_comte;
    public $bol_obs;

    public function __construct($evaluacion = [])
    {
        $this->bol_cat_evaluado = $evaluacion['bol_cat_evaluado'] ?? null;
        $this->bol_anio = $evaluacion['bol_anio'] ?? 2025;
        $this->bol_cat_evaluador = $evaluacion['bol_cat_evaluador'] ?? null;
        $this->bol_ceom = $evaluacion['bol_ceom'] ?? '';
        $this->bol_perfil = $evaluacion['bol_perfil'] ?? null;
        $this->bol_pafe = $evaluacion['bol_pafe'] ?? null;
        $this->bol_eva1 = $evaluacion['bol_eva1'] ?? null;
        $this->bol_eva2 = $evaluacion['bol_eva2'] ?? null;
        $this->bol_eva3 = $evaluacion['bol_eva3'] ?? null;
        $this->bol_eva4 = $evaluacion['bol_eva4'] ?? null;
        $this->bol_demeritos = $evaluacion['bol_demeritos'] ?? null;
        $this->bol_arrestos = $evaluacion['bol_arrestos'] ?? null;
        $this->bol_total_salud = $evaluacion['bol_total_salud'] ?? null;
        $this->bol_total_concep = $evaluacion['bol_total_concep'] ?? null;
        $this->bol_total = $evaluacion['bol_total'] ?? null;
        $this->bol_accion_mot = $evaluacion['bol_accion_mot'] ?? null;
        $this->bol_accion_correc = $evaluacion['bol_accion_correc'] ?? null;
        $this->bol_cat_g1 = $evaluacion['bol_cat_g1'] ?? null;
        $this->bol_cat_comte = $evaluacion['bol_cat_comte'] ?? null;
        $this->bol_obs = $evaluacion['bol_obs'] ?? '';
    }
}

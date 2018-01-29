<?php

class Application_Model_DadosPlanilha extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tb_dados_planilha';
    protected  $_primary = 'id_dados_planilha';
    
    // Tipos de roubo
    const ESTUPRO = 'estupro';
    const ROUBO = 'roubo';
    const LESAO = 'lesao';
    const CVNLI = 'cvnli';
    // Dias da Semana 
    const DOMINGO = 'dom';
    const SEGUNDA = 'seg';
    const TERCA = 'ter';
    const QUARTA = 'quart';
    const QUINTA = 'quint';
    const SEXTA = 'sext';
    const SABADO = 'sab';
    // Horario 
    const HORA_0_6 = 'hora_0_as_6';
    const HORA_6_12 = 'hora_6_as_12';
    const HORA_12_18 = 'hora_12_as_18';
    const HORA_18_24 = 'hora_18_as_24';
    // Sexo
    const MASCULINO = 'm';
    const FEMININO = 'f';
    // Meses
    const JAN = 'janeiro';
    const FEV = 'fevereiro';
    const MAR = 'marco';
    const ABR = 'abril';
    const MAI = 'maio';
    const JUN = 'junho';
    const JUL = 'julho';
    const AGO = 'agosto';
    const SET = 'setembro';
    const OUT = 'outubro';
    const NOV = 'novembro';
    const DEZ = 'dezembro';
    // IDADE
    const ID_12_18 = 'idade_12_18';
    const ID_19_29 = 'idade_19_29';
    const ID_30_40 = 'idade_30_40';
    const ID_41_50 = 'idade_41_50';
    const ID_51_80 = 'idade_51_80';
    
    public function consulta($filtros) 
    {
        $sql = $this->getAdapter()->select();
        return $this->getAdapter()->fetchAll($sql);
    }
    
    public function getTotalCrimesPorBairro($filtros = null)
    {
        $sql = $this->getAdapter()->select();
        $sql->from(
                array('p' => $this->_name),
                array('p.cvnli')
            )
            ->join(array('b'=>'tb_bairro'), 'p.id_bairro = b.id_bairro', array('b.nome'))
            ->order('p.cvnli DESC')
            ->limit(10);
        
        return $this->getAdapter()->fetchAll($sql);
    }
    
}


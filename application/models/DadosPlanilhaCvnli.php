<?php

class Application_Model_DadosPlanilhaCvnli extends Zend_Db_Table_Abstract
{
    protected $_name    = 'tb_dados_planilha_cvnli';
    protected  $_primary = 'id_dados_planilha_cvnli';
    
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
    
    /**
     * Consulta Total de Crimes por Bairro
     * @param string $filtros
     */
    public function getTotalCrimesPorBairro($filtros = null)
    {
        $sql = $this->getAdapter()->select();
        $campos = array();
        //Por padrão busca CVNLI
        if (!empty($filtros['crime'])) {
            $sql->order("p.{$filtros['crime']} DESC");
            $campos = array("p.{$filtros['crime']}");
        }
        
        //Por padrão busca Ano atual
        if (empty($filtros['ano'])) {
            $filtros['ano'] = date('Y');
        } 
        $sql->where('p.ano = ?', $filtros['ano']);
        
        if (!empty($filtros['bairro'])) {
            $sql->where('p.id_bairro IN (?)', $filtros['bairro']);
        }
        
        $sql->from(
                array('p' => $this->_name),
                $campos
            )
            ->join(array('b'=>'tb_bairro'), 'p.id_bairro = b.id_bairro', array('b.nome'))
            ->limit(10);
        
        // retirando parque Timbira
        $sql->where('b.id_bairro NOT IN (?)',[136]);
        
        return $this->getAdapter()->fetchAll($sql);
    }
    
    /**
     * 
     * @param unknown $filtros
     */
    public function getTotalDiaSemana($filtros = null) 
    {
        $sql = $this->getAdapter()->select();
            
        //Por padrão busca Ano atual
        if (empty($filtros['ano'])) {
            $filtros['ano'] = date('Y') - 1;
        }
        
        $arrColunas = array(
            'p.' . static::DOMINGO, 
            'p.' . static::SEGUNDA,
            'p.' . static::TERCA,
            'p.' . static::QUARTA,
            'p.' . static::QUINTA,
            'p.' . static::SEXTA,
            'p.' . static::SABADO,
        );
        if (!empty($filtros['diaSemana'])) {
            $arrColunas = $filtros['diaSemana'];
        }
            
        $sql->from(
                array('p' => $this->_name),
                $arrColunas
            )
            ->where('p.ano = ?', $filtros['ano'])
            ->join(array('b'=>'tb_bairro'), 'p.id_bairro = b.id_bairro', array('b.nome'));
        
        // Se não selecionou os bairros, pesquisa somente 10 bairros
        if (empty($filtros['bairro'])) {
            $sql->limit(5);
            // Ordena pelo maior CVNLI
            $sql->order('p.cvnli DESC');
        } else {
            //Bairros específicos
            $sql->where('p.id_bairro IN (?)', $filtros['bairro']);
        }
        
        // retirando parque Timbira
        $sql->where('b.id_bairro NOT IN (?)',[136]);
        
        return $this->getAdapter()->fetchAll($sql);
    }
    
    /**
     * Busca a quantidade total por horário
     * @param unknown $filtros
     */
    public function getTotalPorHorario($filtros = null)
    {
        $sql = $this->getAdapter()->select();
        
        $arrColunas = array(
            'p.' . static::HORA_0_6,
            'p.' . static::HORA_6_12,
            'p.' . static::HORA_12_18,
            'p.' . static::HORA_18_24
        );
        if (!empty($filtros['horario'])) {
            $arrColunas = $filtros['horario'];
        }
        
        $sql->from(
                array('p' => $this->_name),
                $arrColunas
            )
            ->where('p.ano = ?', $filtros['ano'])
            ->join(array('b'=>'tb_bairro'), 'p.id_bairro = b.id_bairro', array('b.nome'));
        
        // Se não selecionou os bairros, pesquisa somente 5 bairros
        if (empty($filtros['bairro'])) {
            $sql->limit(5);
            // Ordena pelo maior CVNLI
            $sql->order('p.cvnli DESC');
        } else {
            //Bairros específicos
            $sql->where('p.id_bairro IN (?)', $filtros['bairro']);
        }
        
        // retirando parque Timbira
        $sql->where('b.id_bairro NOT IN (?)',[136]);
        
        return $this->getAdapter()->fetchAll($sql);
    }
    
    public function getTotalPorMes($filtros = null) 
    {
        $sql = $this->getAdapter()->select();
        
        $arrColunas = array(
            'p.' . static::JAN,
            'p.' . static::FEV,
            'p.' . static::ABR,
            'p.' . static::MAR,
            'p.' . static::MAI,
            'p.' . static::JUN,
            'p.' . static::JUL,
            'p.' . static::AGO,
            'p.' . static::SET,
            'p.' . static::OUT,
            'p.' . static::NOV,
            'p.' . static::DEZ
            
        );
        if (!empty($filtros['mes'])) {
            $arrColunas = $filtros['mes'];
        }
        
        $sql->from(
            array('p' => $this->_name),
            $arrColunas
            )
            ->where('p.ano = ?', $filtros['ano'])
            ->join(array('b'=>'tb_bairro'), 'p.id_bairro = b.id_bairro', array('b.nome'));
    
        // Se não selecionou os bairros, pesquisa somente 5 bairros
        if (empty($filtros['bairro'])) {
            $sql->limit(5);
            // Ordena pelo maior CVNLI
            $sql->order('p.cvnli DESC');
        } else {
            //Bairros específicos
            $sql->where('p.id_bairro IN (?)', $filtros['bairro']);
        }
        
        // retirando parque Timbira
        $sql->where('b.id_bairro NOT IN (?)',[136]);
        
        return $this->getAdapter()->fetchAll($sql);
    }
    
    /**
     * Busca os dados por Idade
     * @param unknown $filtros
     */
    public function getTotalPorIdade($filtros = null) 
    {
        $sql = $this->getAdapter()->select();
        
        $arrColunas = array(
            'p.' . static::ID_12_18,
            'p.' . static::ID_19_29,
            'p.' . static::ID_30_40,
            'p.' . static::ID_41_50,
            'p.' . static::ID_51_80
        );
        if (!empty($filtros['idade'])) {
            $arrColunas = $filtros['idade'];
        }
        
        $sql->from(
            array('p' => $this->_name),
            $arrColunas
            )
            ->where('p.ano = ?', $filtros['ano'])
            ->join(array('b'=>'tb_bairro'), 'p.id_bairro = b.id_bairro', array('b.nome'));
        
            // Se não selecionou os bairros, pesquisa somente 5 bairros
            if (empty($filtros['bairro'])) {
                $sql->limit(5);
                // Ordena pelo maior CVNLI
                $sql->order('p.cvnli DESC');
            } else {
                //Bairros específicos
                $sql->where('p.id_bairro IN (?)', $filtros['bairro']);
            }
            
            // retirando parque Timbira
            $sql->where('b.id_bairro NOT IN (?)',[136]);
        
            return $this->getAdapter()->fetchAll($sql);
    }
    
}


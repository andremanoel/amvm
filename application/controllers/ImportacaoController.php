<?php

class ImportacaoController extends Core_Controller_Seguro
{

    public function init()
    {
        parent::init();
        $this->_helper->layout()->setLayout("admin");
    }
    
    public function indexAction()
    {
        ini_set('memory_limit', '4096M');
        $totalBairros = 262;
        
        if($this->_request->isPost()) {
            $file = Core_Util_File::upload('planilha');
            if($file['sucesso']) {
                // Salva os dados do arquivo no banco
                $modelArquivo = new Application_Model_Arquivo();
                $objArquivo = $modelArquivo->createRow();
                $objArquivo->nome_arquivo = $_FILES['planilha']['name'];
                $objArquivo->tamanho = $_FILES['planilha']['size'];
                $objArquivo->caminho = $file['arquivo'];
                $objArquivo->save();
                
                try {
                    //rodar a rotina do phpExcel  
                    $objPHPExcel = PHPExcel_IOFactory::load($file['arquivo']);
                    
                    //Recupera a primeira planilha
                    foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
                        
                        foreach ($worksheet->getRowIterator() as $row) {
                            $indexRow = $row->getRowIndex();
                            
                            // Verifica se passou do total de bairros atualmente
                            if($indexRow > $totalBairros) {
                                break;
                            }
                            
                            // Se for a primeira linha, realiza a validação das colunas
                            if($indexRow == 1) {
                               $this->validaRow($row);
                               continue;
                            } else {
                                echo 'Passa aqui! ---  ';
                                $this->insereLinhaBanco($row, $indexRow, $objArquivo->id_arquivo);
                            }                            
                        }
                        // Somente a primeira planilha, ignora outras se houver
                        break;
                    }
                } catch (Exception $e) {
                    $this->addMensagem($e->getMessage(), 'danger');
                }
                
            } else {
                $this->addMensagem('Não foi possível realizar o upload da planilha', 'danger');
            }
        }
        
        $anoAtual = date('Y');
        $anoInicial = 2015;
        $arrAnos = array();
        for ($i=$anoInicial; $i <= $anoAtual; $i++) {
            $arrAnos[$i] = $i;
        }
        $this->view->arrAnos = $arrAnos;
    }
    
    public function validaRow($row) 
    {
        /**
         * Padrão da linha
         * @var array $arrRowTemplate
         */
        $arrRowTemplate = [
            'A1' => 'bairros',
            'B1' => 'populacao',
            'C1' => 'ESTUPRO',
            'D1' => 'ROUBO',
            'E1' => 'LESÃO',
            'F1' => 'CVNLI',
            'G1' => 'DOM',
            'H1' => 'SEG',
            'I1' => 'TER',
            'J1' => 'QUART',
            'K1' => 'QUINT',
            'L1' => 'SEXT',
            'M1' => 'SAB',
            'N1' => '0_AS_6',
            'O1' => '6_AS_12',
            'P1' => '12_AS_18',
            'Q1' => '18_AS_24',
            'R1' => 'M',
            'S1' => 'F',
            'T1' => 'IDAD_12_18',
            'U1' => 'IDAD_19_29',
            'V1' => 'IDAD_30_40',
            'W1' => 'IDAD_41_50',
            'X1' => 'IDAD_51_80',
            'Y1' => 'JANEIRO',
            'Z1' => 'FEVEREIRO',
            'AA1' => 'MARÇO',
            'AB1' => 'ABRIL',
            'AC1' => 'MAIO',
            'AD1' => 'JUNHO',
            'AE1' => 'JULHO',
            'AF1' => 'AGOSTO',
            'AG1' => 'SETEMBRO',
            'AH1' => 'OUTUBRO',
            'AI1' => 'NOVEMBRO',
            'AJ1' => 'DEZEMBRO'
        ];
        
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(false);
        foreach ($cellIterator as $cell) {
            if (!is_null($cell)) {
                // verifica se chegou na última coluna para parar
                $coordinate = $cell->getCoordinate();
                if ($coordinate === 'AK1') {
                    break;
                }
                
                if(empty($cell->getCalculatedValue())) {
                    throw new Exception("Coluna $coordinate esperada está vazia. Um valor é esperado.");
                }
                
                //Verifica a coluna atual se está no padrão esperado
                $valorEsperado = strtolower( trim($arrRowTemplate[$coordinate]) );
                $valorCelula = strtolower( trim($cell->getCalculatedValue()) );
                if($valorEsperado != $valorCelula) {
                    throw new Exception("O valor esperado para a coluna $coordinate é $valorEsperado. Foi encontrado $valorCelula. Corrija a planilha");
                }
            }
        }
        return true;
    }
    
    public function insereLinhaBanco($row, $rowIndex, $idArquivo) 
    {
        // Quantidade de colunas que devem ser lidas
        $qtdColunas = 36;
        $modelDados = new Application_Model_DadosPlanilha();
        
        $cellIterator = $row->getCellIterator('A', 'AJ');
        $cellIterator->setIterateOnlyExistingCells(false);
        
        $objDadosPlanilha = $modelDados->createRow();
        $ano = $this->getParam('ano');
        $objDadosPlanilha->ano = $ano;
        
        $cont = 0;
        foreach ($cellIterator as $cell) {
            
            // Verifica se já passou por todas as colunas necessárias
            if($cont == $qtdColunas) {
                break;
            }
            
            if (!is_null($cell)) {
                $valorCelula = null;
                
                $coordinate = $cell->getCoordinate();
                echo '<br />';
                var_dump($coordinate);
                $valorCelula = $cell->getValue();
                
                // verifica o valor da celula, coloca 0 como default
                if($valorCelula == 0 || empty($valorCelula) ||  $valorCelula == '0') {
                    echo "VAZIO -- ";
                    $valorCelula = 0;
                    var_dump($valorCelula);
                } else {
                    echo "TEM DADOS -- ";
                    echo "Reconheceu como um numero? = "; var_dump(is_numeric($valorCelula));
                    if(is_numeric($valorCelula)) {
                        $valorCelula = round($valorCelula, 1);
                    }
                    var_dump($valorCelula);
                }
        
                // Populacao
                if($coordinate == ('B'.$rowIndex)) {
                    $objDadosPlanilha->populacao = $valorCelula;
                }
                
                // ESTUPRO
                if($coordinate == ('C' . $rowIndex)) {
                    $objDadosPlanilha->estupro = $valorCelula;
                }
                
                // ROUBO
                if($coordinate == ('D'.$rowIndex) ) {
                    $objDadosPlanilha->roubo = $valorCelula;
                }
                
                // LESÃO
                if($coordinate == ('E'.$rowIndex) ) {
                    $objDadosPlanilha->lesao = $valorCelula;
                }
                
                // CVNLI
                if($coordinate == ('F'.$rowIndex) ) {
                    $objDadosPlanilha->cvnli = $valorCelula;
                }
                
                // DOM
                if($coordinate == ('G'.$rowIndex)) {
                    $objDadosPlanilha->dom = $valorCelula;
                }
                
                // SEG
                if($coordinate == ('H'.$rowIndex)) {
                    $objDadosPlanilha->seg = $valorCelula;
                }
                
                // TER
                if($coordinate == ('I'.$rowIndex)) {
                    $objDadosPlanilha->ter = $valorCelula;
                }
                
                // QUART
                if($coordinate == ('J'.$rowIndex)) {
                    $objDadosPlanilha->quart = $valorCelula;
                }
                
                // QUINT
                if($coordinate == ('K'.$rowIndex)) {
                    $objDadosPlanilha->quint = $valorCelula;
                }
                
                // SEXT
                if($coordinate == ('L'.$rowIndex)) {
                    $objDadosPlanilha->sext = $valorCelula;
                }
                
                // SAB
                if($coordinate == ('M'.$rowIndex)) {
                    $objDadosPlanilha->sab = $valorCelula;
                }
                
                // 0_AS_6
                if($coordinate == ('N'.$rowIndex)) {
                    $objDadosPlanilha->hora_0_as_6 = $valorCelula;
                }
                
                // 6_AS_12
                if($coordinate == ('O'.$rowIndex)) {
                    $objDadosPlanilha->hora_6_as_12 = $valorCelula;
                }
                
                // 12_AS_18
                if($coordinate == ('P'.$rowIndex)) {
                    $objDadosPlanilha->hora_12_as_18 = $valorCelula;
                }
                
                // 18_AS_24
                if($coordinate == ('Q'.$rowIndex)) {
                    $objDadosPlanilha->hora_18_as_24 = $valorCelula;
                }
                
                // Masculino
                if($coordinate == ('R'.$rowIndex)) {
                    $objDadosPlanilha->m = $valorCelula;
                }
                
                // Feminino
                if($coordinate == ('S'.$rowIndex)) { 
                    $objDadosPlanilha->f = $valorCelula;
                }
                
                // Idade 12_18
                if($coordinate == ('T'.$rowIndex)) {
                    $objDadosPlanilha->idade_12_18 = $valorCelula;
                }
                
                // Idade 19_29
                if($coordinate == ('U'.$rowIndex)) {
                    $objDadosPlanilha->idade_19_29 = $valorCelula;
                }
                
                // Idade 30_40
                if($coordinate == ('V'.$rowIndex)) {
                    $objDadosPlanilha->idade_30_40 = $valorCelula;
                }
                
                // Idade 41_50
                if($coordinate == ('W'.$rowIndex)) {
                    $objDadosPlanilha->idade_41_50 = $valorCelula;
                }
                
                // Idade 51_80
                if($coordinate == ('X'.$rowIndex)) {
                    $objDadosPlanilha->idade_51_80 = $valorCelula;
                }
                
                // Janeiro
                if($coordinate == ('Y'.$rowIndex)) {
                    $objDadosPlanilha->janeiro = $valorCelula;
                }
                
                // Fevereiro
                if($coordinate == ('Z'.$rowIndex)) {
                    $objDadosPlanilha->fevereiro = $valorCelula;
                }
                
                // Março
                if($coordinate == ('AA'.$rowIndex)) {
                    $objDadosPlanilha->marco = $valorCelula;
                }
                
                // Abril
                if($coordinate == ('AB'.$rowIndex)) {
                    $objDadosPlanilha->abril = $valorCelula;
                }
                
                // Maio
                if($coordinate == ('AC'.$rowIndex)) {
                    $objDadosPlanilha->maio = $valorCelula;
                }
                
                // Junho
                if($coordinate == ('AD'.$rowIndex)) {
                    $objDadosPlanilha->junho = $valorCelula;
                }
                
                // Julho
                if($coordinate == ('AE'.$rowIndex)) {
                    $objDadosPlanilha->julho = $valorCelula;
                }
                
                // Agosto
                if($coordinate == ('AF'.$rowIndex)) {
                    $objDadosPlanilha->agosto = $valorCelula;
                }
                
                // Setembro
                if($coordinate == ('AG'.$rowIndex)) {
                    $objDadosPlanilha->setembro = $valorCelula;
                }
                
                // Setembro
                if($coordinate == ('AH'.$rowIndex)) {
                    $objDadosPlanilha->outubro = $valorCelula;
                }
                
                // Novembro
                if($coordinate == ('AI'.$rowIndex)) {
                    $objDadosPlanilha->novembro = $valorCelula;
                }
                
                // Dezembro
                if($coordinate == ('AJ'.$rowIndex)) {
                    $objDadosPlanilha->dezembro = $valorCelula;
                }
                $cont++;
            }
        }
        $objDadosPlanilha->id_arquivo = $idArquivo;
        $objDadosPlanilha->id_bairro  = $rowIndex - 1;
        $objDadosPlanilha->save();
        return true;
    }
}
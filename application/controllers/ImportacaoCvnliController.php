<?php

class ImportacaoCvnliController extends Core_Controller_Seguro
{
    
    public $anoSelecionado;
    
    /**
     * Padrão da linha
     * @var array
     */
    private $arrRowTemplate = [
        'A' => 'bairros',
        'B' => 'populacao',
        'C' => 'ESTUPRO',
        'D' => 'ROUBO',
        'E' => 'LESÃO',
        'F' => 'CVNLI',
        'G' => 'DOM',
        'H' => 'SEG',
        'I' => 'TER',
        'J' => 'QUART',
        'K' => 'QUINT',
        'L' => 'SEXT',
        'M' => 'SAB',
        'N' => '0_AS_6',
        'O' => '6_AS_12',
        'P' => '12_AS_18',
        'Q' => '18_AS_24',
        'R' => 'M',
        'S' => 'F',
        'T' => 'IDAD_12_18',
        'U' => 'IDAD_19_29',
        'V' => 'IDAD_30_40',
        'W' => 'IDAD_41_50',
        'X' => 'IDAD_51_80',
        'Y' => 'JANEIRO',
        'Z' => 'FEVEREIRO',
        'AA' => 'MARÇO',
        'AB' => 'ABRIL',
        'AC' => 'MAIO',
        'AD' => 'JUNHO',
        'AE' => 'JULHO',
        'AF' => 'AGOSTO',
        'AG' => 'SETEMBRO',
        'AH' => 'OUTUBRO',
        'AI' => 'NOVEMBRO',
        'AJ' => 'DEZEMBRO'
    ];

    public function init()
    {
        parent::init();
        $this->_helper->layout()->setLayout("admin");
        $this->ano = $this->getParam('ano', date('Y'));
    }

    public function indexAction()
    {
        ini_set('memory_limit', '4096M');
        $totalBairros = 262;
        
        if ($this->_request->isPost()) {
            $file = Core_Util_File::upload('planilha');
            if ($file['sucesso']) {
                // Salva os dados do arquivo no banco
                $modelArquivo = new Application_Model_Arquivo();
                $modelArquivo->getAdapter()->beginTransaction();
                $objArquivo = $modelArquivo->createRow();
                $objArquivo->nome_arquivo = $_FILES['planilha']['name'];
                $objArquivo->tamanho = $_FILES['planilha']['size'];
                $objArquivo->caminho = $file['arquivo'];
                $objArquivo->save();
                
                // Valores padrão para comparação
                $titulo = 'INCIDENCIA';
                
                try {
                    // rodar a rotina do phpExcel
                    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($objArquivo->caminho);
                    $activeSheet = $spreadsheet->getActiveSheet();
                    
                    if ($activeSheet->getTitle() != $titulo) {
                        throw new Core_Exception_ImportacaoException('Erro - O Título da planilha está incorreto. O Título da planilha deve ser: INCIDENCIA');
                    }
                    echo '<div class="container"><div class="row">
                            <div class="col-md-12">
                              <div class="panel panel-default panel-border-color panel-border-color-primary"><div class="panel-body">';
                    echo "<h3>Iniciando importação.</h3> <br />";
                    
                    // Le a planilha como array
                    $dataArray = $spreadsheet->getActiveSheet()->rangeToArray('A1:AJ263', // The worksheet range that we want to retrieve
                            '', // Value that should be returned for empty cells
                            true, // Should formulas be calculated (the equivalent of getCalculatedValue() for each cell)
                            true, // Should values be formatted (the equivalent of getFormattedValue() for each cell)
                            true);
                    
                    
                    // Recupera a primeira planilha
                    $tamanhoArray = count($dataArray);
                    echo "- Importação do ANO = " . $this->ano . "<br />";
                    echo "- Leitura de $tamanhoArray linhas para importação.<br />";
                    $registrosExcluidos = false;
                    $linhasIncluidas = 0;
                    for ($i = 1; $i <= $tamanhoArray; $i++) {
                        
                        // valida o template da primeira linha
                        if($i == 1) {
                            $this->validaRow($dataArray[$i]);
                            echo "- Verificação das colunas padrão realizada. <br />";
                            continue;
                        }
                        
                        // Exclui os registros anteriores
                        if (!$registrosExcluidos) {
                            $this->apagarRegistrosAnteriores($this->getParam('ano'));
                            $registrosExcluidos = true;
                        }
                        $result = $this->insereLinhaBanco($dataArray[$i], $i, $objArquivo->id_arquivo, $i - 1);
                    }
                    
                    echo "<br /><br />- Importação finalizada.
                        </div></div></div></div></div>";
                    $modelArquivo->getAdapter()->commit();
                    $this->addMensagem('Planilha importada com sucesso. Resultado = ' , 'success');
                } catch (Exception $e) {
                    $msg = "Erro na linha $i. <br />";
                    $msg .= $e->getMessage();
                    
                    $modelArquivo->getAdapter()->rollBack();                    
                    $this->addMensagem($msg, 'danger');
                }
            } else {
                $this->addMensagem('Não foi possível realizar o upload da planilha', 'danger');
            }
        }
        
        $anoAtual = date('Y');
        $anoInicial = 2015;
        $arrAnos = array();
        for ($i = $anoInicial; $i <= $anoAtual; $i ++) {
            $arrAnos[$i] = $i;
        }
        $this->view->arrAnos = $arrAnos;
    }
    
    /**
     * Exclui todos os registros anteriores
     * @param int $ano
     */
    public function apagarRegistrosAnteriores($ano) 
    {
        $modelPlanilha = new Application_Model_DadosPlanilhaCvnli();
        $where = $modelPlanilha->getAdapter()->quoteInto("ano = ?", $ano);
        $modelPlanilha->delete($where);
    }

    /**
     * Valida o template da primeira linha
     * @param array $row
     * @throws Core_Exception_ImportacaoException
     * @throws Exception
     * @return boolean
     */
    public function validaRow($row)
    {
        foreach ($row as $index => $celula) {
            if (empty($celula)) {
                throw new Core_Exception_ImportacaoException("A coluna $index de referência está vazia.");  
            }
            // Verifica a coluna atual se está no padrão esperado
            $valorEsperado = strtoupper(
                normaliza($this->arrRowTemplate[$index])
            );
            $linha[$index] = strtoupper(
                normaliza($celula)
            );
            if ($valorEsperado != $linha[$index]) {
                throw new Core_Exception_ImportacaoException(
                    "O valor esperado para a coluna $index é $valorEsperado. 
                    Foi encontrado $linha[$index]. Corrija o posicionamento da primeira linha da planilha."
                );
            }
        }
        return true;
    }
    
    /**
     * Salva no banco uma linha
     * @param int $linha
     * @param array $rowIndex
     * @param int $idArquivo
     * @param int $idBairro
     * @return boolean
     */
    public function insereLinhaBanco($linha, $rowIndex, $idArquivo, $idBairro)
    {
        // Quantidade de colunas que devem ser lidas
        $qtdColunas = count($this->arrRowTemplate);
        $modelDados = new Application_Model_DadosPlanilhaCvnli();
        
        $objDadosPlanilha = $modelDados->createRow();
        $ano              = $this->getParam('ano');
        $objDadosPlanilha->ano = $ano;
        $nomeBairro = '';
        
        foreach ($this->arrRowTemplate as $key => $cell) {
            
            // Nome do Bairro
            if ($key == 'A') {
                // Se não tiver o nome do bairro pula a inserção da linha
                if (empty($linha[$key])) {
                    return false;
                }
                $nomeBairro = $linha[$key];
            }
            
            // Populacao
            if ($key == 'B') {
                $objDadosPlanilha->populacao = (int) $linha[$key];
            }
            
            // ESTUPRO
            if ($key == 'C') {
                $objDadosPlanilha->estupro = $this->ajustarFloat($linha[$key]);
            }
            
            // ROUBO
            if ($key == 'D') {
                $objDadosPlanilha->roubo = $this->ajustarFloat($linha[$key]);
            }
            
            // LESÃO
            if ($key == 'E') {
                $objDadosPlanilha->lesao = $this->ajustarFloat($linha[$key]);
            }
            
            // CVNLI
            if ($key == 'F') {
                $objDadosPlanilha->cvnli = $this->ajustarFloat($linha[$key]);
            }
            
            // DOM
            if ($key == 'G') {
                $objDadosPlanilha->dom = $this->ajustarFloat($linha[$key]);
            }
            
            // SEG
            if ($key == 'H') {
                $objDadosPlanilha->seg = $this->ajustarFloat($linha[$key]);
            }
            
            // TER
            if ($key == 'I') {
                $objDadosPlanilha->ter = $this->ajustarFloat($linha[$key]);
            }
            
            // QUART
            if ($key == 'J') {
                $objDadosPlanilha->quart = $this->ajustarFloat($linha[$key]);
            }
            
            // QUINT
            if ($key == 'K') {
                $objDadosPlanilha->quint = $this->ajustarFloat($linha[$key]);
            }
            
            // SEXT
            if ($key == 'L') {
                $objDadosPlanilha->sext = $this->ajustarFloat($linha[$key]);
            }
            
            // SAB
            if ($key == 'M') {
                $objDadosPlanilha->sab = $this->ajustarFloat($linha[$key]);
            }
            
            // 0_AS_6
            if ($key == 'N') {
                $objDadosPlanilha->hora_0_as_6 = $this->ajustarFloat($linha[$key]);
            }
            
            // 6_AS_12
            if ($key == 'O') {
                $objDadosPlanilha->hora_6_as_12 = $this->ajustarFloat($linha[$key]);
            }
            
            // 12_AS_18
            if ($key == 'P') {
                $objDadosPlanilha->hora_12_as_18 = $this->ajustarFloat($linha[$key]);
            }
            
            // 18_AS_24
            if ($key == 'Q') {
                $objDadosPlanilha->hora_18_as_24 = $this->ajustarFloat($linha[$key]);
            }
            
            // Masculino
            if ($key == 'R') {
                $objDadosPlanilha->m = $this->ajustarFloat($linha[$key]);
            }
            
            // Feminino
            if ($key == 'S') {
                $objDadosPlanilha->f = $this->ajustarFloat($linha[$key]);
            }
            
            // Idade 12_18
            if ($key == 'T') {
                $objDadosPlanilha->idade_12_18 = $this->ajustarFloat($linha[$key]);
            }
            
            // Idade 19_29
            if ($key == 'U') {
                $objDadosPlanilha->idade_19_29 = $this->ajustarFloat($linha[$key]);
            }
            
            // Idade 30_40
            if ($key == 'V') {
                $objDadosPlanilha->idade_30_40 = $this->ajustarFloat($linha[$key]);
            }
            
            // Idade 41_50
            if ($key == 'W') {
                $objDadosPlanilha->idade_41_50 = $this->ajustarFloat($linha[$key]);
            }
            
            // Idade 51_80
            if ($key == 'X') {
                $objDadosPlanilha->idade_51_80 = $this->ajustarFloat($linha[$key]);
            }
            
            // Janeiro
            if ($key == 'Y') {
                $objDadosPlanilha->janeiro = $this->ajustarFloat($linha[$key]);
            }
            
            // Fevereiro
            if ($key == 'Z') {
                $objDadosPlanilha->fevereiro = $this->ajustarFloat($linha[$key]);
            }
            
            // Março
            if ($key == 'AA') {
                $objDadosPlanilha->marco = $this->ajustarFloat($linha[$key]);
            }
            
            // Abril
            if ($key == 'AB') {
                $objDadosPlanilha->abril = $this->ajustarFloat($linha[$key]);
            }
            
            // Maio
            if ($key == 'AC') {
                $objDadosPlanilha->maio = $this->ajustarFloat($linha[$key]);
            }
            
            // Junho
            if ($key == 'AD') {
                $objDadosPlanilha->junho = $this->ajustarFloat($linha[$key]);
            }
            
            // Julho
            if ($key == 'AE') {
                $objDadosPlanilha->julho = $this->ajustarFloat($linha[$key]);
            }
            
            // Agosto
            if ($key == 'AF') {
                $objDadosPlanilha->agosto = $this->ajustarFloat($linha[$key]);
            }
            
            // Setembro
            if ($key == 'AG') {
                $objDadosPlanilha->setembro = $this->ajustarFloat($linha[$key]);
            }
            
            // Setembro
            if ($key == 'AH') {
                $objDadosPlanilha->outubro = $this->ajustarFloat($linha[$key]);
            }
            
            // Novembro
            if ($key == 'AI') {
                $objDadosPlanilha->novembro = $this->ajustarFloat($linha[$key]);
            }
            
            // Dezembro
            if ($key == 'AJ') {
                $objDadosPlanilha->dezembro = $this->ajustarFloat($linha[$key]);
            }
        }
        $objDadosPlanilha->id_arquivo = $idArquivo;
        $objDadosPlanilha->id_bairro = $idBairro;
        $objDadosPlanilha->save();
        echo "Linha do Bairro $nomeBairro inserida com sucesso. <br />";
        return true;
    }
    
    public function ajustarFloat($value) 
    {  
       return round(trim($value), 2); 
    }
    
    public function postDispatch() 
    {
        $this->view->ano = $this->ano;
    }
}
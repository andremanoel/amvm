    <?php

class ImportacaoController extends Core_Controller_Seguro
{
    
    public $anoSelecionado;
    
    /**
     * Padrão da linha
     * @var array
     */
    private $arrRowTemplate = [
        'A' => 'bairros,C,50',
        'B' => 'Populacao',
        'C' => 'ARMA DE FOGO',
        'D' => 'ARMA BRANCA',
        'E' => 'OUTROS MEIOS',
        'F' => 'Homicídio Doloso',
        'G' => 'Latrocínio',
        'H' => 'Lesão corporal seguida de morte',
        'I' => 'CVLI',
        'J' => 'DOM',
        'K' => 'SEG',
        'L' => 'TER',
        'M' => 'QUART',
        'N' => 'QUINT',
        'O' => 'SEXT',
        'P' => 'SAB',
        'Q' => '0_AS_6',
        'R' => '6_AS_12',
        'S' => '12_AS_18',
        'T' => '18_AS_24',
        'U' => 'IDAD_12_18',
        'V' => 'IDAD_19_29',
        'W' => 'IDAD_30_40',
        'X' => 'IDAD_41_50',
        'Y' => 'IDAD_51_80',
        'Z' => 'JANEIRO',
        'AA' => 'FEVEREIRO',
        'AB' => 'MARÇO',
        'AC' => 'ABRIL',
        'AD' => 'MAIO',
        'AE' => 'JUNHO',
        'AF' => 'JULHO',
        'AG' => 'AGOSTO',
        'AH' => 'SETEMBRO',
        'AI' => 'OUTUBRO',
        'AJ' => 'NOVEMBRO',
        'AK' => 'DEZEMBRO'
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
                    
                    if ( strtolower($activeSheet->getTitle()) != strtolower($titulo)) {
                        throw new Core_Exception_ImportacaoException('Erro - O Título da planilha está incorreto. O Título da planilha deve ser: INCIDENCIA');
                    }
                    echo '<div class="container"><div class="row">
                            <div class="col-md-12">
                              <div class="panel panel-default panel-border-color panel-border-color-primary"><div class="panel-body">';
                    echo "<h3>Iniciando importação.</h3> <br />";
                    
                    // Le a planilha como array
                    $dataArray = $spreadsheet->getActiveSheet()->rangeToArray('A1:AK263', // The worksheet range that we want to retrieve
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
                    echo $e->getMessage() . "<br />"; 
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
        $anoInicial = 2014;
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
        $modelPlanilha = new Application_Model_DadosPlanilhaCvli();
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
        $modelDados = new Application_Model_DadosPlanilhaCvli();
        
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
            
            // ARMA DE FOGO
            if ($key == 'C') {
                $objDadosPlanilha->arma_de_fogo = $this->ajustarFloat($linha[$key]);
            }
            
            // ARMA BRANCA
            if ($key == 'D') {
                $objDadosPlanilha->arma_branca = $this->ajustarFloat($linha[$key]);
            }
            
            // outros_meios
            if ($key == 'E') {
                $objDadosPlanilha->outros_meios = $this->ajustarFloat($linha[$key]);
            }
            
            // homicidio_doloso
            if ($key == 'F') {
                $objDadosPlanilha->homicidio_doloso = $this->ajustarFloat($linha[$key]);
            }
            
            // latrocinio
            if ($key == 'G') {
                $objDadosPlanilha->latrocinio = $this->ajustarFloat($linha[$key]);
            }
            
            // lesao_corporal_seguido_morte
            if ($key == 'H') {
                $objDadosPlanilha->lesao_corporal_seguido_morte = $this->ajustarFloat($linha[$key]);
            }
            
            // cvli
            if ($key == 'I') {
                $objDadosPlanilha->cvli = $this->ajustarFloat($linha[$key]);
            }
            
            // dom
            if ($key == 'J') {
                $objDadosPlanilha->dom = $this->ajustarFloat($linha[$key]);
            }
            
            // seg
            if ($key == 'K') {
                $objDadosPlanilha->seg = $this->ajustarFloat($linha[$key]);
            }
            
            // ter
            if ($key == 'L') {
                $objDadosPlanilha->ter = $this->ajustarFloat($linha[$key]);
            }
            
            // quart
            if ($key == 'M') {
                $objDadosPlanilha->quart = $this->ajustarFloat($linha[$key]);
            }
            
            // quint
            if ($key == 'N') {
                $objDadosPlanilha->quint = $this->ajustarFloat($linha[$key]);
            }
            
            // sext
            if ($key == 'O') {
                $objDadosPlanilha->sext = $this->ajustarFloat($linha[$key]);
            }
            
            // sab
            if ($key == 'P') {
                $objDadosPlanilha->sab = $this->ajustarFloat($linha[$key]);
            }
            
            // horario_0_as_6
            if ($key == 'Q') {
                $objDadosPlanilha->horario_0_as_6 = $this->ajustarFloat($linha[$key]);
            }
            
            // horario_6_as_12
            if ($key == 'R') {
                $objDadosPlanilha->horario_6_as_12 = $this->ajustarFloat($linha[$key]);
            }
            
            // horario_12_as_18
            if ($key == 'S') {
                $objDadosPlanilha->horario_12_as_18 = $this->ajustarFloat($linha[$key]);
            }
            
            // horario_18_as_24
            if ($key == 'T') {
                $objDadosPlanilha->horario_18_as_24 = $this->ajustarFloat($linha[$key]);
            }
            
            // idade_12_18
            if ($key == 'U') {
                $objDadosPlanilha->idade_12_18 = $this->ajustarFloat($linha[$key]);
            }
            
            // idade_19_29
            if ($key == 'V') {
                $objDadosPlanilha->idade_19_29 = $this->ajustarFloat($linha[$key]);
            }
            
            // idade_30_40
            if ($key == 'W') {
                $objDadosPlanilha->idade_30_40 = $this->ajustarFloat($linha[$key]);
            }
            
            // idade_41_50
            if ($key == 'X') {
                $objDadosPlanilha->idade_41_50 = $this->ajustarFloat($linha[$key]);
            }
            
            // idade_51_80
            if ($key == 'Y') {
                $objDadosPlanilha->idade_51_80 = $this->ajustarFloat($linha[$key]);
            }
            
            // janeiro
            if ($key == 'Z') {
                $objDadosPlanilha->janeiro = $this->ajustarFloat($linha[$key]);
            }
            
            // fevereiro
            if ($key == 'AA') {
                $objDadosPlanilha->fevereiro = $this->ajustarFloat($linha[$key]);
            }
            
            // marco
            if ($key == 'AB') {
                $objDadosPlanilha->marco = $this->ajustarFloat($linha[$key]);
            }
            
            // abril
            if ($key == 'AC') {
                $objDadosPlanilha->abril = $this->ajustarFloat($linha[$key]);
            }
            
            // maio
            if ($key == 'AD') {
                $objDadosPlanilha->maio = $this->ajustarFloat($linha[$key]);
            }
            
            // junho
            if ($key == 'AE') {
                $objDadosPlanilha->junho = $this->ajustarFloat($linha[$key]);
            }
            
            // julho
            if ($key == 'AF') {
                $objDadosPlanilha->julho = $this->ajustarFloat($linha[$key]);
            }
            
            // agosto
            if ($key == 'AG') {
                $objDadosPlanilha->agosto = $this->ajustarFloat($linha[$key]);
            }
            
            // setembro
            if ($key == 'AH') {
                $objDadosPlanilha->setembro = $this->ajustarFloat($linha[$key]);
            }
            
            // outubro
            if ($key == 'AI') {
                $objDadosPlanilha->outubro = $this->ajustarFloat($linha[$key]);
            }
            
            // novembro
            if ($key == 'AJ') {
                $objDadosPlanilha->novembro = $this->ajustarFloat($linha[$key]);
            }
            
            // dezembro
            if ($key == 'AK') {
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
       $value = (float) $value;
       return round(trim($value), 2);
    }
    
    public function postDispatch() 
    {
        $this->view->ano = $this->ano;
    }
}
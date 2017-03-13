<?php

namespace Gestor\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ImportacaoController extends AbstractActionController
{
    public function indexAction()
    {
        return new ViewModel();
    }
    
    public function importar($caminho)
    {
        $caminhoArquivo = URL_FILES . '/planilha/DADOS_CVLI BAIRROS.xls';
        $objReader = new \PHPExcel_Reader_Excel2007();
        $objPHPExcel = $objReader->load($caminhoArquivo);
        
        //navega as planilhas
        foreach ($objPHPExcel->getWorksheetIterator() as $worksheet) {
            //navega nas linhas
            foreach ($worksheet->getRowIterator() as $row) {
                $cellIterator = $row->getCellIterator();
            }
        }
    }
}
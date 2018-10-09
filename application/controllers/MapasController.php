  <?php

class MapasController extends Zend_Controller_Action
{

    public function init()
    {
        parent::init();
    }
    
    public function indexAction() 
    {
        
        try {
            $modelTipo = new Application_Model_Mapas_MapaTipo();
            $modelAno  = new Application_Model_Mapas_MapaAno();
            $modelClassificacao  = new Application_Model_Mapas_MapaTipoClassificacao();
            $modelMapa  = new Application_Model_Mapas_Mapa();
            
            // parametros de busca
            $idAno = $this->getParam('ano', 2014);
            $idTipo = $this->getParam('tipo', 1);
            $idClassificacao = $this->getParam('classificacao', 1);
            
            $tipos = $modelTipo->getTipos();
            $this->view->tipos = $tipos;
            $this->view->anos = $modelAno->getAnos();
            $this->view->classificacao = $modelClassificacao->getTiposClassificacao($idTipo);
            $this->view->mapaSelecionado = $modelMapa->getMapa($idClassificacao, $idAno);
            //a($this->view->mapaSelecionado);
            
            // dados selecionados
            $this->view->anoSelecionado = $idAno;
            $this->view->tipoSelecionado = $idTipo;
            $this->view->classificacaoSelecionado = $idClassificacao;
            
        } catch (Exception $e) {
            a($e->getMessage());
        }
    }
    
    public function carregarClassificacaoAction() 
    {
        $this->_helper->layout()->disableLayout();
        $idTipo = $this->getParam('tipo');
        $modelClassificacao  = new Application_Model_Mapas_MapaTipoClassificacao();
        $this->view->classificacao = $modelClassificacao->getTiposClassificacao($idTipo);   
        $this->view->classificacaoSelecionado = '';
    }
    
    public function densidadeOcorrenciasAnoAction()
    {
        $chave2014 = '2014';
        $chave2015 = '2015';
        $chave2016 = '2016';
        $chave2017 = '2017';
        
        $arrFiltros = array(
            $chave2014 => $chave2014,
            $chave2015 => $chave2015,
            $chave2016 => $chave2016,
            $chave2017 => $chave2017
        );
        $anoSelecionado = $this->getParam('ano', $chave2017);
        
        //Mapas Enviados por Hora
        $mapa2014 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Densidade de Ocorrência de Crimes Letais no Ano de 2014 - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=1aec466a47a444caa41b510cb148968f&extent=-44.5612,-2.8083,-43.718,-2.3391&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $mapa2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Densidade de Ocorrência de Crimes Letais no Ano de 2015 - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=d905e2d74afb4f4da8d3e0316a3a0b79&extent=-44.6876,-2.848,-43.8444,-2.3789&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $mapa2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Densidade de Ocorrência de Crimes Letais no Ano de 2016 - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=c9471af6009e4da999534821b60cb175&extent=-44.6016,-2.8424,-43.7584,-2.3732&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $mapa2017 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Densidade de Ocorrência de Crimes Letais no Ano de 2017 - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=2e53812c4dad4fc282237fdccc16bc91&extent=-44.6863,-2.8447,-43.8431,-2.3755&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $arrMapas = array(
            $chave2014 => $mapa2014,
            $chave2015 => $mapa2015,
            $chave2016 => $mapa2016,
            $chave2017 => $mapa2017
        );
        
        $this->view->mapaSelecionado = $arrMapas[$anoSelecionado];
        $this->view->arrFiltros = $arrFiltros;
        $this->view->selecionado = $anoSelecionado;
    }
    
    /**
     *  Total de Incidência de Ocorrência de CVLI Tipo
     */
    public function cvliIdadeAction()
    {
        $chave12 = '12';
        $chave19 = '19';
        $chave30 = '30';
        $chave41 = '41';
        $chave51 = '51';
    
        $arrFiltros = array(
            $chave12 => '12 aos 18 anos',
            $chave19 => '19 aos 29 anos',
            $chave30 => '30 aos 40 anos',
            $chave41 => '41 aos 50 anos',
            $chave51 => '51 aos 80 anos'
        );
        $tipoSelecionado = $this->getParam('idade', $chave12);
        $anoSelecionado  = $this->getParam('ano', 2017);
    
        //Mapas Enviados por Tipo
        $mapa12_2017 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2017 por Idade (12 aos 18 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=21675fd7ad3745f0a4729cc2ae872e3f&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa19_2017 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2017 por Idade (19 aos 29 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=e7f5909c56ee4f56a5a82f49a8b416a2&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa30_2017 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2017 por Idade (30 aos 40 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=6d29d6205a4a40aa91c745b3d50eab90&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa41_2017 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2017 por Idade (41 aos 50 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=f5cf08a0700541b98d1b23c10e17705d&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa51_2017 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2017 por Idade (51 aos 80 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=f216dd6d7e64479f9b85f01f312ee663&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
    
        $arrMapas2017 = array(
            $chave12 => $mapa12_2017,
            $chave19 => $mapa19_2017,
            $chave30 => $mapa30_2017,
            $chave41 => $mapa41_2017,
            $chave51 => $mapa51_2017
        );
        
        // 2016
        $mapa12_2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2016 por Idade (12 aos 18 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=d164f099849647c5a910f343c619ba22&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa19_2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2016 por Idade (19 aos 29 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=14b5ceb863c4467e88b72576b03536b6&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa30_2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2016por Idade (30 aos 40 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=e849813db05643da99c317d97499e2ae&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa41_2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2016 por Idade (41 aos 50 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=25730bc73507483ba37ba5a9e7c7bd48&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa51_2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2016 por Idade (51 aos 80 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=2049fb3d20334be297c0b6d672ada593&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $arrMapas2016 = array(
            $chave12 => $mapa12_2016,
            $chave19 => $mapa19_2016,
            $chave30 => $mapa30_2016,
            $chave41 => $mapa41_2016,
            $chave51 => $mapa51_2016
        );
        
        // 2015
        $mapa12_2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2015 por Idade (12 aos 18 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=f1e2345e91ca48c3b63962fe43ddcc69&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa19_2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2015 por Idade (19 aos 29 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=d90e4c65ad1b4f81b28519ead699217b&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa30_2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2015 por Idade (30 aos 40 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=356714a60f144618a24bc20e48fe9e3d&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa41_2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2015 por Idade (41 aos 50 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=0885e0c4b92049cd83333237cb522b6f&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa51_2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2015 por Idade (51 aos 80 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=5cae9a09be994f0f9c4f05dc0c530938&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $arrMapas2015 = array(
            $chave12 => $mapa12_2015,
            $chave19 => $mapa19_2015,
            $chave30 => $mapa30_2015,
            $chave41 => $mapa41_2015,
            $chave51 => $mapa51_2015
        );
        
        // 2014
        $mapa12_2014 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2014 por Idade (12 aos 18 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=37a6fdf7779d4aa0a7002a48e18b01a7&extent=-44.6376,-2.8037,-43.9193,-2.4326&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa19_2014 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2014 por Idade (19 aos 29 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=614abf81743b47a9ace78061f34a63eb&extent=-44.6376,-2.8037,-43.9193,-2.4326&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa30_2014 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2014 por Idade (30 aos 40 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=307dc309f11d4a2281cfaaea66683539&extent=-44.6376,-2.8037,-43.9193,-2.4326&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa41_2014 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2014 por Idade (41 aos 50 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=ee74951b921a49e694ff88a1d8b2a798&extent=-44.6376,-2.8037,-43.9193,-2.4326&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa51_2014 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2014 por Idade (51 aos 80 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=3995ac3fcce64c34922c3593b0cd123c&extent=-44.6376,-2.8037,-43.9193,-2.4326&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $arrMapas2014 = array(
            $chave12 => $mapa12_2014,
            $chave19 => $mapa19_2014,
            $chave30 => $mapa30_2014,
            $chave41 => $mapa41_2014,
            $chave51 => $mapa51_2014
        );

        // Verifica o ano selecionado
        if ($anoSelecionado == 2017) {
            $this->view->mapaSelecionado = $arrMapas2017[$tipoSelecionado];
        }
        
        if ($anoSelecionado == 2016) {
            $this->view->mapaSelecionado = $arrMapas2016[$tipoSelecionado];
        }
        
        if ($anoSelecionado == 2015) {
            $this->view->mapaSelecionado = $arrMapas2015[$tipoSelecionado];
        }
        
        if ($anoSelecionado == 2014) {
            $this->view->mapaSelecionado = $arrMapas2014[$tipoSelecionado];
        }
        
        $this->view->arrFiltros = $arrFiltros;
        $this->view->selecionado = $tipoSelecionado;
        $this->view->anoSelecionado = $anoSelecionado;
        $this->view->arrAnos = [
            2014 => 2014,
            2015 => 2015,
            2016 => 2016,
            2017 => 2017
        ];
    }
    
    /**
     *  Total de Incidência de Ocorrência de CVLI Tipo
     */
    public function mapeamentoPorMesAction()
    {
        $chaveJaneiro = '01';
        $chaveFevereiro = '02';
        $chaveMarco = '03';
        $chaveAbril = '04';
        $chaveMaio = '05';
        $chaveJunho = '06';
        $chaveJulho = '07';
        $chaveAgosto = '08';
        $chaveSetembro = '09';
        $chaveOutubro = '10';
        $chaveNovembro = '11';
        $chaveDezembro = '12';
    
        $arrFiltros = array(
            $chaveJaneiro => 'Janeiro',
            $chaveFevereiro => 'Fevereiro',
            $chaveMarco => 'Março',
            $chaveAbril => 'Abril',
            $chaveMaio => 'Maio',
            $chaveJunho => 'Junho',
            $chaveJulho => 'Julho',
            $chaveAgosto => 'Agosto',
            $chaveSetembro => 'Setembro',
            $chaveOutubro => 'Outubro',
            $chaveNovembro => 'Novembro',
            $chaveDezembro => 'Dezembro'
        );
        $tipoSelecionado = $this->getParam('mes', $chaveJaneiro);
        $anoSelecionado = $this->getParam('ano', 2017);
    
        //Mapas Enviados por Tipo - 2017
        $mapaJaneiro = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Janeiro) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=6272d648a623416a8a6f0493c5bfe97e&extent=-44.5603,-2.829,-43.7171,-2.3653&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaFevereiro = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Fevereiro de 2017) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=8d1525162342474fb5219ec6e1dd6c73&extent=-44.5603,-2.829,-43.7171,-2.3653&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaMarco = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Março de 2017) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=588eea0aea284dd08244bbef3fffad9e&extent=-44.5603,-2.829,-43.7171,-2.3653&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaAbril = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Abril de 2017) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=7b8a7d2c38f3473e9f13375e17099d61&extent=-44.5603,-2.829,-43.7171,-2.3653&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaMaio = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Maio de 2017) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=8e5c064bb4a244028e7754fb80040d64&extent=-44.5527,-2.8112,-43.8345,-2.438&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legend=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaJunho = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Junho de 2017) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=dbb25cb90a7c4bb8916ba9d6c920da97&extent=-44.5527,-2.8112,-43.8345,-2.438&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaJulho = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Julho de 2017) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=cc1529078665483796e49f13404e7277&extent=-44.5527,-2.8112,-43.8345,-2.438&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaAgosto = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Agosto de 2017) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=6bd2a5ba03494b9a9fd291b692d8a3e0&extent=-44.5527,-2.8112,-43.8345,-2.438&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSetembro = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Setembro de 2017) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=8277d018b71e4b4cb80dc0893ec2bc71&extent=-44.5527,-2.8112,-43.8345,-2.438&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&disable_scroll=true&theme=light"></iframe>';
        $mapaOutubro = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Outubro de 2017) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=370662fd4dee4feebf550c64165d51fc&extent=-44.5527,-2.8112,-43.8345,-2.438&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaNovembro = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Novembro de 2017) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=842ecba8206f424dad200aefb3cae646&extent=-44.5527,-2.8112,-43.8345,-2.438&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaDezembro = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Dezembro de 2017) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=15698b296afa4b45892c22056e507ed5&extent=-44.5503,-2.7978,-43.8321,-2.4247&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        // Mapas Enviados por Tipo - 2016
        $mapaJaneiro2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Janeiro de 2016) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=48c64ac2a8254d3f8b587ad09dcb95f8&extent=-44.6369,-2.8054,-43.9186,-2.4322&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaFevereiro2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Fevereiro de 2016) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=2926fd1eb5fd4f219eb7b8bac25c825d&extent=-44.6369,-2.8054,-43.9186,-2.4322&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaMarco2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Março de 2016) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=1bb72347bccd4e4cbc0db78cd5274246&extent=-44.6369,-2.8054,-43.9186,-2.4322&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaAbril2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Abril de 2016) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=8ef37cb2d9ad4c40a394cec47dad680e&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaMaio2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Maio de 2016) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=f36a1500c54d4833874b965098d93b13&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaJunho2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Junho de 2016) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=b8e505cec6b44b50b0e19d44bd9303c8&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaJulho2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Julho de 2016) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=a08e9e015470465c97cf3fb8aaaa63c0&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaAgosto2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Agosto de 2016) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=d14ce5e4b1e54f6a80ecabd0e2e763a6&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legend=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSetembro2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Setembro de 2016) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=9eef97e1db49445296f2763174636d65&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaOutubro2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Outubro de 2016) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=102fd84320c2478bbac0d5edd3c9e385&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaNovembro2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Novembro de 2016) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=4a87b965838d43f3bbb2931c9cfb4abc&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaDezembro2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Dezembro de 2016) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=94a10400b5e4410e81b2f7528eaa73ba&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        // Mapas Enviados por Tipo - 2015
        $mapaJaneiro2015   = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Janeiro de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=6bb3759291344ac09d5ac3a7b87ff259&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaFevereiro2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Fevereiro de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=6404af734a1244a7a9f0a200cd4b7971&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaMarco2015     = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Março de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=e542b657e53a4d6c85a84a0a197f7912&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaAbril2015     = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Abril de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=d71999e59dff46459b8453fb37e2be45&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaMaio2015      = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Maio de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=8efd93fd053440d084d4d1f2cbfd6338&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaJunho2015     = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Junho de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=b71ba79d434f492591dce848d11e359f&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaJulho2015     = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Julho de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=5dbcb6497b0e4f8e97031c9ebf0fcd5f&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaAgosto2015    = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Agosto de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=d3b0165fcdd44fe796502f6035f4d700&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSetembro2015  = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Setembro de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=ffa7decc08bf4cfb8686a40b8d0c6791&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaOutubro2015   = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Outubro de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=377076337e0a48bca29fe588aab3ae42&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaNovembro2015  = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Novembro de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=3f49886a4e8845908a6e1551ea492eee&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaDezembro2015  = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Dezembro de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=a0162f164e8149e5bbe0c6fda8060b64&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        // Mapas Enviados por Tipo - 2014
        $mapaJaneiro2014   = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Janeiro de 2014) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=d081baf548984207a92c596287bc763a&extent=-44.5785,-2.8071,-43.8603,-2.4361&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaFevereiro2014 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Fevereiro de 2014) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=0c43a1d7c687499c9f74a6ad6abaa346&extent=-44.5785,-2.8071,-43.8603,-2.4361&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaMarco2014     = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Março de 2014) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=b67c29480b9347acadbc60432eda3e1b&extent=-44.5785,-2.8071,-43.8603,-2.4361&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaAbril2014     = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Abril de 2014) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=4bbf1b8136db42b1b016e933e97db4cd&extent=-44.5785,-2.8071,-43.8603,-2.4361&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaMaio2014      = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Maio de 2014) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=900f0645f679402dbe8ff67e64208baf&extent=-44.5785,-2.8071,-43.8603,-2.4361&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaJunho2014     = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Junho de 2014) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=37b4d79e236541fb8755cc43923c4857&extent=-44.5785,-2.8071,-43.8603,-2.4361&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaJulho2014     = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Julho de 2014) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=e9cca691e2554be5889d051bf3f3b3c8&extent=-44.5785,-2.8071,-43.8603,-2.4361&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaAgosto2014    = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Agosto de 2014) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=7cf9434349fc4634b2c3a385e2f8c12f&extent=-44.5785,-2.8071,-43.8603,-2.4361&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSetembro2014  = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Setembro de 2014) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=75f5ffd3382843c4861a7503242665fd&extent=-44.5785,-2.8071,-43.8603,-2.4361&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaOutubro2014   = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Outubro de 2014) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=08f0001b7a2d464d959f54a9e84e1964&extent=-44.5785,-2.8071,-43.8603,-2.4361&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaNovembro2014  = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Novembro de 2014) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=ec591b1b00d4487382ab513b10095f5f&extent=-44.5785,-2.8071,-43.8603,-2.4361&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaDezembro2014  = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Dezembro de 2014) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=0d5017b803034472a165ae08020a2ca7&extent=-44.5785,-2.8071,-43.8603,-2.4361&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $arrMapas2017 = array(
            $chaveJaneiro => $mapaJaneiro,
            $chaveFevereiro => $mapaFevereiro,
            $chaveMarco => $mapaMarco,
            $chaveAbril => $mapaAbril,
            $chaveMaio => $mapaMaio,
            $chaveJunho => $mapaJunho,
            $chaveJulho => $mapaJulho,
            $chaveAgosto => $mapaAgosto,
            $chaveSetembro => $mapaSetembro,
            $chaveOutubro => $mapaOutubro,
            $chaveNovembro => $mapaNovembro,
            $chaveDezembro => $mapaDezembro
        );
        
        $arrMapas2016 = array(
            $chaveJaneiro => $mapaJaneiro2016,
            $chaveFevereiro => $mapaFevereiro2016,
            $chaveMarco => $mapaMarco2016,
            $chaveAbril => $mapaAbril2016,
            $chaveMaio => $mapaMaio2016,
            $chaveJunho => $mapaJunho2016,
            $chaveJulho => $mapaJulho2016,
            $chaveAgosto => $mapaAgosto2016,
            $chaveSetembro => $mapaSetembro2016,
            $chaveOutubro => $mapaOutubro2016,
            $chaveNovembro => $mapaNovembro2016,
            $chaveDezembro => $mapaDezembro2016
        );
        
        $arrMapas2015 = array(
            $chaveJaneiro => $mapaJaneiro2015,
            $chaveFevereiro => $mapaFevereiro2015,
            $chaveMarco => $mapaMarco2015,
            $chaveAbril => $mapaAbril2015,
            $chaveMaio => $mapaMaio2015,
            $chaveJunho => $mapaJunho2015,
            $chaveJulho => $mapaJulho2015,
            $chaveAgosto => $mapaAgosto2015,
            $chaveSetembro => $mapaSetembro2015,
            $chaveOutubro => $mapaOutubro2015,
            $chaveNovembro => $mapaNovembro2015,
            $chaveDezembro => $mapaDezembro2015
        );
        
        $arrMapas2014 = array(
            $chaveJaneiro => $mapaJaneiro2014,
            $chaveFevereiro => $mapaFevereiro2014,
            $chaveMarco => $mapaMarco2014,
            $chaveAbril => $mapaAbril2014,
            $chaveMaio => $mapaMaio2014,
            $chaveJunho => $mapaJunho2014,
            $chaveJulho => $mapaJulho2014,
            $chaveAgosto => $mapaAgosto2014,
            $chaveSetembro => $mapaSetembro2014,
            $chaveOutubro => $mapaOutubro2014,
            $chaveNovembro => $mapaNovembro2014,
            $chaveDezembro => $mapaDezembro2014
        );
    
        // Verifica o ano selecionado
        if ($anoSelecionado == 2017) {
            $this->view->mapaSelecionado = $arrMapas2017[$tipoSelecionado];
        }
        
        if ($anoSelecionado == 2016) {
            $this->view->mapaSelecionado = $arrMapas2016[$tipoSelecionado];
        }
        
        if ($anoSelecionado == 2015) {
            $this->view->mapaSelecionado = $arrMapas2015[$tipoSelecionado];
        }
        
        if ($anoSelecionado == 2014) {
            $this->view->mapaSelecionado = $arrMapas2014[$tipoSelecionado];
        }
        
        $this->view->arrFiltros = $arrFiltros;
        $this->view->selecionado = $tipoSelecionado;
        $this->view->anoSelecionado = $anoSelecionado;
        $this->view->arrAnos = [
            2014 => 2014,
            2015 => 2015,
            2016 => 2016,
            2017 => 2017
        ];
    }
    
    /**
     *  mapeamento-por-dia-semana
     */
    public function mapeamentoPorDiaSemanaAction()
    {
        $chaveDomingo = 'dom';
        $chaveSegunda = 'seg';
        $chaveTerca = 'ter';
        $chaveQuarta = 'qua';
        $chaveQuinta = 'qui';
        $chaveSexta = 'sex';
        $chaveSabado = 'sab';
    
        $arrFiltros = array(
            $chaveDomingo => 'Domingo',
            $chaveSegunda => 'Segunda-feira',
            $chaveTerca => 'Terça-feira',
            $chaveQuarta => 'Quarta-feira',
            $chaveQuinta => 'Quinta-feira',
            $chaveSexta => 'Sexta-feira',
            $chaveSabado => 'Sábado'
        );
        $tipoSelecionado = $this->getParam('dia', $chaveDomingo);
        $anoSelecionado = $this->getParam('ano', 2017);
    
        //Mapas Enviados por Tipo
        $mapaDomingo = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Ocorrência de CVLI por Dia da Semana (Domingo) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=5a80bb9a90fe4abdaafb6503e52f1b6b&extent=-44.6197,-2.8379,-43.7765,-2.3742&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSegunda = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana (Segunda - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=22ef318b11114820b9d07a09918a5330&extent=-44.6997,-2.8506,-43.8565,-2.3869&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaTerca = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana (Terça - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=5d9927f2366c402296daa5b1051b626d&extent=-44.6447,-2.8376,-43.8015,-2.3739&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaQuarta = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana (Quarta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=7c90d05831e543c398ba25fe62c184b2&extent=-44.642,-2.8265,-43.7988,-2.3628&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaQuinta = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana (Quinta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=7aff8127dba3417fa69c5ffab8c4630b&extent=-44.642,-2.8265,-43.7988,-2.3628&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSexta = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana (Sexta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=e60f1099ce374c73b8be99a8214502ef&extent=-44.5733,-2.8067,-43.7301,-2.343&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSabado = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana (Sábado) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=472f49161a5b44498e1d5d327f01e45e&extent=-44.5689,-2.8363,-43.7257,-2.3726&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
    
        $arrMapas2017 = array(
            $chaveDomingo => $mapaDomingo,
            $chaveSegunda => $mapaSegunda,
            $chaveTerca => $mapaTerca,
            $chaveQuarta => $mapaQuarta,
            $chaveQuinta => $mapaQuinta,
            $chaveSexta => $mapaSexta,
            $chaveSabado => $mapaSabado
        );
        
        // Mapas de 2016  
        $mapaDomingo2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Ocorrência de CVLI por Dia da Semana 2016 (Domíngo) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=1ab38432a4994ccd8644e8a0cad7fb07&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legend=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSegunda2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2016 (Segunda - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=211030538bef4346a502df4b282adf59&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaTerca2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2016 (Terça - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=b0603b76fa614b898f48ae8b74b684de&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaQuarta2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2016 (Quarta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=707d11d0d8c341e5875f5236be246975&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaQuinta2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2016 (Quinta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=301fc7573c24448da478388ebf125229&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSexta2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2016 (Sexta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=de772ac073f4472da9c4c6e97c702922&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSabado2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2016 (Sabado) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=c8ddf2a6b3704fa584ca5264585754c2&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $arrMapas2016 = array(
            $chaveDomingo => $mapaDomingo2016,
            $chaveSegunda => $mapaSegunda2016,
            $chaveTerca => $mapaTerca2016,
            $chaveQuarta => $mapaQuarta2016,
            $chaveQuinta => $mapaQuinta2016,
            $chaveSexta => $mapaSexta2016,
            $chaveSabado => $mapaSabado2016
        );
        
        // Mapas de 2015
        $mapaDomingo2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Ocorrência de CVLI por Dia da Semana 2015 (Domíngo) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=86f1be91543240e2a389f7af48f086a4&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSegunda2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2015 (Segunda - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=9436a5eb7a86433c843b457e920604f0&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaTerca2015   = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2015 (Terça - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=c20973919fc94101ae9558ba1b8de928&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaQuarta2015  = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2015 (Quarta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=9ac9c9d8f3ce498199525fe1dbb7a62b&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaQuinta2015  = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2015 (Quinta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=c2865f9ac4e14f919c3c7ae5b8ee5d09&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSexta2015   = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2015 (Sexta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=985b45310bf44d5d8bed1add0e871359&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSabado2015  = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2015 (Sabado) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=2232ab059b874423947ccfa702c98e4c&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $arrMapas2015 = array(
            $chaveDomingo => $mapaDomingo2015,
            $chaveSegunda => $mapaSegunda2015,
            $chaveTerca => $mapaTerca2015,
            $chaveQuarta => $mapaQuarta2015,
            $chaveQuinta => $mapaQuinta2015,
            $chaveSexta => $mapaSexta2015,
            $chaveSabado => $mapaSabado2015
        );
        
        // Mapas de 2014
        $mapaDomingo2014 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Ocorrência de CVLI por Dia da Semana 2014 (Domíngo) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=6fe079f998d44371996d5cb736a984d6&extent=-44.5771,-2.8058,-43.8589,-2.4347&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSegunda2014 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2014 (Segunda - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=d332e7e145b849c59c89fef5192e803d&extent=-44.5771,-2.8058,-43.8589,-2.4347&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaTerca2014   = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2014 (Terça - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=d8776df691964423a8eb5ac2d464af56&extent=-44.5771,-2.8058,-43.8589,-2.4347&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaQuarta2014  = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2014 (Quarta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=677452691d9b458b8b233e7ccd43f4cb&extent=-44.5771,-2.8058,-43.8589,-2.4347&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaQuinta2014  = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2014 (Quinta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=bd44950672024701968ec01ed593eb57&extent=-44.5771,-2.8058,-43.8589,-2.4347&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSexta2014   = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2014 (Sexta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=1a5ea7b4227c4813b2245e1e519c0956&extent=-44.5771,-2.8058,-43.8589,-2.4347&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSabado2014  = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2014 (Sabado) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=9a100e2aef8747bb8e3c34e6fb0526b8&extent=-44.5771,-2.8058,-43.8589,-2.4347&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $arrMapas2014 = array(
            $chaveDomingo => $mapaDomingo2014,
            $chaveSegunda => $mapaSegunda2014,
            $chaveTerca => $mapaTerca2014,
            $chaveQuarta => $mapaQuarta2014,
            $chaveQuinta => $mapaQuinta2014,
            $chaveSexta => $mapaSexta2014,
            $chaveSabado => $mapaSabado2014
        );
        
        // Verifica o ano selecionado
        if ($anoSelecionado == 2017) {
            $this->view->mapaSelecionado = $arrMapas2017[$tipoSelecionado];
        }
        
        if ($anoSelecionado == 2016) {
            $this->view->mapaSelecionado = $arrMapas2016[$tipoSelecionado];
        }
        
        if ($anoSelecionado == 2015) {
            $this->view->mapaSelecionado = $arrMapas2015[$tipoSelecionado];
        }
        
        if ($anoSelecionado == 2014) {
            $this->view->mapaSelecionado = $arrMapas2014[$tipoSelecionado];
        }
        
        $this->view->arrFiltros = $arrFiltros;
        $this->view->selecionado = $tipoSelecionado;
        $this->view->anoSelecionado = $anoSelecionado;
        $this->view->arrAnos = [
            2014 => 2014,
            2015 => 2015,
            2016 => 2016,
            2017 => 2017
        ];
    }
    
    public function downloadAction() 
    {
        
    }
    
}
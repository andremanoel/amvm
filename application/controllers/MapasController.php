  <?php

class MapasController extends Zend_Controller_Action
{

    public function init()
    {
        parent::init();
    }
    
    public function cvliHorarioAction()
    {
        $chave00 = '00';
        $chave06 = '06';
        $chave12 = '12';
        $chave18 = '18';
        
        $arrFiltros = array(
            $chave00 => '00:00 às 06:00',
            $chave06 => '06:00 as 12:00',
            $chave12 => '12:00 as 18:00',
            $chave18 => '18:00 as 24:00'
        );
        $horarioSelecionado = $this->getParam('horario', $chave00);
        
        //Mapas Enviados por Hora
        $mapa00 = '<small><a
				href="//www.arcgis.com/apps/Embed/index.html?webmap=3f478b2122c843879ef6e5eb3e6e2101&extent=-44.6997,-2.853,-43.8565,-2.3839&zoom=true&scale=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"
				style="color: #0000FF; text-align: left" target="_blank">Visualizar
					mapa grande</a></small><br>
			<iframe width="500" height="400" frameborder="0" scrolling="no"
				marginheight="0" marginwidth="0"
				title="Total de Ocorrência de CVLI por Hora ( 00: 00 as 06:00) - Feminino"
				src="//www.arcgis.com/apps/Embed/index.html?webmap=3f478b2122c843879ef6e5eb3e6e2101&extent=-44.6997,-2.853,-43.8565,-2.3839&zoom=true&previewImage=false&scale=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $mapa06 = '<small><a
				href="//www.arcgis.com/apps/Embed/index.html?webmap=4d1957876585474f90c2f0973e05bccd&extent=-44.6386,-2.8342,-43.7954,-2.365&home=true&zoom=true&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"
				style="color: #0000FF; text-align: left" target="_blank">Visualizar
					mapa grande</a></small><br>
			<iframe width="500" height="400" frameborder="0" scrolling="no"
				marginheight="0" marginwidth="0"
				title="Total de Ocorrência de CVLI por Hora ( 06: 00 as 12:00) - Feminino"
				src="//www.arcgis.com/apps/Embed/index.html?webmap=4d1957876585474f90c2f0973e05bccd&extent=-44.6386,-2.8342,-43.7954,-2.365&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $mapa12 = '<small><a href="//www.arcgis.com/apps/Embed/index.html?webmap=5c7ad1fda3f44b4b8d5937ec4e8a6adf&extent=-44.5631,-2.8342,-43.7199,-2.3651&home=true&zoom=true&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light" style="color:#0000FF;text-align:left" target="_blank">Visualizar mapa grande</a></small><br><iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Ocorrência de CVLI por Hora ( 12: 00 as 18:00) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=5c7ad1fda3f44b4b8d5937ec4e8a6adf&extent=-44.5631,-2.8342,-43.7199,-2.3651&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
      
        $mapa18 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Ocorrência de CVLI por Hora ( 18: 00 as 24:00) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=5c7ad1fda3f44b4b8d5937ec4e8a6adf&extent=-44.5631,-2.8342,-43.7199,-2.3651&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe></div>';
        
        $arrMapas = array(
            $chave00 => $mapa00,
            $chave06 => $mapa06,
            $chave12 => $mapa12,
            $chave18 => $mapa18
        );
        
        $this->view->mapaSelecionado = $arrMapas[$horarioSelecionado];
        $this->view->arrFiltros = $arrFiltros;
        $this->view->selecionado = $horarioSelecionado;
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
    public function cvliTipoAction()
    {
        $chaveArmaFogo = 'arma-fogo';
        $chaveArmaBranca = 'arma-branca';
        $chaveOutros = 'outros';
        $chaveCvli = 'cvli';
    
        $arrFiltros = array(
            $chaveArmaFogo => 'Arma de Fogo',
            $chaveArmaBranca => 'Arma Branca',
            $chaveOutros => 'Outros Meios',
            $chaveCvli => 'CVLI'
        );
        $tipoSelecionado = $this->getParam('tipo', $chaveArmaFogo);
        $anoSelecionado  = $this->getParam('ano', 2017);
    
        //Mapas Enviados por Tipo
        $mapaArmaFogo2017 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Arma de Fogo - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=10114eb47a174ea38712a84a488877b4&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaArmaBranca2017 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Arma Branca - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=cde4639c71884280a6b43d1124f432b0&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaOutros2017 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Outros Meios - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=84eed9d0246b498abf3b30e8c825c4de&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaCvli2017 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2017 - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=0b20c7638b854e46ab4a98e1bb0a890c&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $arrMapas2017 = array(
            $chaveArmaFogo => $mapaArmaFogo2017,
            $chaveArmaBranca => $mapaArmaBranca2017,
            $chaveOutros => $mapaOutros2017,
            $chaveCvli => $mapaCvli2017
        );
        
        $mapaArmaFogo2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Arma de Fogo 216- Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=e7ab8ee4ba5f420185884feebe99505b&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaArmaBranca2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Arma Branca 2016 - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=ade7c2ea26424a70894797cf50061bee&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaOutros2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Outros Meios 2016 - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=76ed018ef8394948a7df554804f080a7&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legend=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaCvli2016 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2016 - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=9d8205215b30420190bb373eb5e2968c&extent=-44.5826,-2.8027,-43.8644,-2.4295&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $arrMapas2016 = array(
            $chaveArmaFogo => $mapaArmaFogo2016,
            $chaveArmaBranca => $mapaArmaBranca2016,
            $chaveOutros => $mapaOutros2016,
            $chaveCvli => $mapaCvli2016
        );
        
        $mapaArmaFogo2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Arma de Fogo 2015- Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=7de3399e6717400e8b6ad4eb4e23eb39&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaArmaBranca2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Arma Branca 2015 - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=09f565001be443d79569a1d2596d3463&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaOutros2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Outros Meios 2015 - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=b07ac61ef0bf4aa0911ad88e484f5dd6&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaCvli2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2015 - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=22c4e3ae2ea54ca1b72a4466fa1929da&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
        $arrMapas2015 = array(
            $chaveArmaFogo => $mapaArmaFogo2015,
            $chaveArmaBranca => $mapaArmaBranca2015,
            $chaveOutros => $mapaOutros2015,
            $chaveCvli => $mapaCvli2015
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
    
        $this->view->arrFiltros = $arrFiltros;
        $this->view->selecionado = $tipoSelecionado;
        $this->view->anoSelecionado = $anoSelecionado;
        $this->view->arrAnos = [
            2015 => 2015,
            2016 => 2016,
            2017 => 2017
        ];
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
        
        $this->view->arrFiltros = $arrFiltros;
        $this->view->selecionado = $tipoSelecionado;
        $this->view->anoSelecionado = $anoSelecionado;
        $this->view->arrAnos = [
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
        
        // Mapas Enviados por Tipo - 2016
        $mapaJaneiro2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Janeiro de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=6bb3759291344ac09d5ac3a7b87ff259&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaFevereiro2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Fevereiro de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=6404af734a1244a7a9f0a200cd4b7971&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaMarco2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Março de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=e542b657e53a4d6c85a84a0a197f7912&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaAbril2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Abril de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=d71999e59dff46459b8453fb37e2be45&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaMaio2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Maio de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=8efd93fd053440d084d4d1f2cbfd6338&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaJunho2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Junho de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=b71ba79d434f492591dce848d11e359f&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaJulho2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Julho de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=5dbcb6497b0e4f8e97031c9ebf0fcd5f&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaAgosto2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Agosto de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=d3b0165fcdd44fe796502f6035f4d700&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSetembro2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Setembro de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=ffa7decc08bf4cfb8686a40b8d0c6791&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaOutubro2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Outubro de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=377076337e0a48bca29fe588aab3ae42&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaNovembro2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Novembro de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=3f49886a4e8845908a6e1551ea492eee&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaDezembro2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Mês (Dezembro de 2015) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=a0162f164e8149e5bbe0c6fda8060b64&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        
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
        
        $this->view->arrFiltros = $arrFiltros;
        $this->view->selecionado = $tipoSelecionado;
        $this->view->anoSelecionado = $anoSelecionado;
        $this->view->arrAnos = [
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
        $mapaTerca2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2015 (Terça - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=c20973919fc94101ae9558ba1b8de928&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaQuarta2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2015 (Quarta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=9ac9c9d8f3ce498199525fe1dbb7a62b&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaQuinta2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2015 (Quinta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=c2865f9ac4e14f919c3c7ae5b8ee5d09&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSexta2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2015 (Sexta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=985b45310bf44d5d8bed1add0e871359&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSabado2015 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana 2015 (Sabado) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=2232ab059b874423947ccfa702c98e4c&extent=-44.6369,-2.8054,-43.9186,-2.4323&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $arrMapas2015 = array(
            $chaveDomingo => $mapaDomingo2015,
            $chaveSegunda => $mapaSegunda2015,
            $chaveTerca => $mapaTerca2015,
            $chaveQuarta => $mapaQuarta2015,
            $chaveQuinta => $mapaQuinta2015,
            $chaveSexta => $mapaSexta2015,
            $chaveSabado => $mapaSabado2015
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
        
        $this->view->arrFiltros = $arrFiltros;
        $this->view->selecionado = $tipoSelecionado;
        $this->view->anoSelecionado = $anoSelecionado;
        $this->view->arrAnos = [
            2015 => 2015,
            2016 => 2016,
            2017 => 2017
        ];
    }
    
    public function downloadAction() 
    {
        
    }
    
}
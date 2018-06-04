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
    
        //Mapas Enviados por Tipo
        $mapaArmaFogo = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Arma de Fogo - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=10114eb47a174ea38712a84a488877b4&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaArmaBranca = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Arma Branca - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=cde4639c71884280a6b43d1124f432b0&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaOutros = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Outros Meios - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=84eed9d0246b498abf3b30e8c825c4de&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaCvli = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2017 - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=0b20c7638b854e46ab4a98e1bb0a890c&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
    
        $arrMapas = array(
            $chaveArmaFogo => $mapaArmaFogo,
            $chaveArmaBranca => $mapaArmaBranca,
            $chaveOutros => $mapaOutros,
            $chaveCvli => $mapaCvli
        );
    
        $this->view->mapaSelecionado = $arrMapas[$tipoSelecionado];
        $this->view->arrFiltros = $arrFiltros;
        $this->view->selecionado = $tipoSelecionado;
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
    
        //Mapas Enviados por Tipo
        $mapa12 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2017 por Idade (12 aos 18 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=21675fd7ad3745f0a4729cc2ae872e3f&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa19 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2017 por Idade (19 aos 29 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=e7f5909c56ee4f56a5a82f49a8b416a2&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa30 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2017 por Idade (30 aos 40 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=6d29d6205a4a40aa91c745b3d50eab90&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa41 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2017 por Idade (41 aos 50 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=f5cf08a0700541b98d1b23c10e17705d&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapa51 = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI 2017 por Idade (51 aos 80 anos) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=f216dd6d7e64479f9b85f01f312ee663&extent=-44.5723,-2.804,-43.8541,-2.4309&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=details&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
    
        $arrMapas = array(
            $chave12 => $mapa12,
            $chave19 => $mapa19,
            $chave30 => $mapa30,
            $chave41 => $mapa41,
            $chave51 => $mapa51
        );
    
        $this->view->mapaSelecionado = $arrMapas[$tipoSelecionado];
        $this->view->arrFiltros = $arrFiltros;
        $this->view->selecionado = $tipoSelecionado;
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
    
        //Mapas Enviados por Tipo
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
        
        $arrMapas = array(
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
    
        $this->view->mapaSelecionado = $arrMapas[$tipoSelecionado];
        $this->view->arrFiltros = $arrFiltros;
        $this->view->selecionado = $tipoSelecionado;
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
    
        //Mapas Enviados por Tipo
        $mapaDomingo = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Ocorrência de CVLI por Dia da Semana (Domingo) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=5a80bb9a90fe4abdaafb6503e52f1b6b&extent=-44.6197,-2.8379,-43.7765,-2.3742&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSegunda = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana (Segunda - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=22ef318b11114820b9d07a09918a5330&extent=-44.6997,-2.8506,-43.8565,-2.3869&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaTerca = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana (Terça - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=5d9927f2366c402296daa5b1051b626d&extent=-44.6447,-2.8376,-43.8015,-2.3739&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaQuarta = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana (Quarta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=7c90d05831e543c398ba25fe62c184b2&extent=-44.642,-2.8265,-43.7988,-2.3628&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaQuinta = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana (Quinta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=7aff8127dba3417fa69c5ffab8c4630b&extent=-44.642,-2.8265,-43.7988,-2.3628&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSexta = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana (Sexta - Feira) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=e60f1099ce374c73b8be99a8214502ef&extent=-44.5733,-2.8067,-43.7301,-2.343&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
        $mapaSabado = '<iframe width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="Total de Incidência de Ocorrência de CVLI por Dia da Semana (Sábado) - Feminino" src="//www.arcgis.com/apps/Embed/index.html?webmap=472f49161a5b44498e1d5d327f01e45e&extent=-44.5689,-2.8363,-43.7257,-2.3726&home=true&zoom=true&previewImage=false&scale=true&search=true&searchextent=true&details=true&legendlayers=true&active_panel=legend&basemap_gallery=true&disable_scroll=true&theme=light"></iframe>';
    
        $arrMapas = array(
            $chaveDomingo => $mapaDomingo,
            $chaveSegunda => $mapaSegunda,
            $chaveTerca => $mapaTerca,
            $chaveQuarta => $mapaQuarta,
            $chaveQuinta => $mapaQuinta,
            $chaveSexta => $mapaSexta,
            $chaveSabado => $mapaSabado
        );
    
        $this->view->mapaSelecionado = $arrMapas[$tipoSelecionado];
        $this->view->arrFiltros = $arrFiltros;
        $this->view->selecionado = $tipoSelecionado;
    }
    
    public function downloadAction() 
    {
        
    }
    
}
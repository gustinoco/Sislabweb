<?php
/**
* precisa aumentar tamanho do post_max_size para 30M ou mais no php.ini do servidor
* para upload de varios arquivos
*/

include_once $_SERVER['DOCUMENT_ROOT'].'/resource/libs/wideimage/WideImage.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/dao/PragaDAO.class.php';

//salva fotos de pragas
function salvarFotos($files, $praga_id){

	for($i=0;$i<10;$i++){
		if(isset($files['fotos']['name'][$i]) && $files["fotos"]["error"][$i] == 0)
		{
			/**
			* echo "Você enviou o arquivo: <strong>" . $files['arquivo']['name'] . "</strong><br />";
			* echo "Este arquivo é do tipo: <strong>" . $files['arquivo']['type'] . "</strong><br />";
			* echo "Temporáriamente foi salvo em: <strong>" . $files['arquivo']['tmp_name'] . "</strong><br />";
			* echo "Seu tamanho é: <strong>" . $files['arquivo']['size'] . "</strong> Bytes<br /><br />";
			*/
			$arquivo_tmp = $files['fotos']['tmp_name'][$i];
			$nome = $files['fotos']['name'][$i];
		// Pega a extensao
			$extensao = strrchr($nome, '.');

		// Converte a extensao para mimusculo
			$extensao = strtolower($extensao);

		// Somente imagens, .jpg;.jpeg;.gif;.png
		// Aqui eu enfilero as extesões permitidas e separo por ';'
		// Isso server apenas para eu poder pesquisar dentro desta String
			if(strstr('.jpg;', $extensao))
			{
				// Cria um nome único para esta imagem
				// Evita que duplique as imagens no servidor.
				$novoNome = $praga_id.'-'.md5(microtime()).$extensao;

				// Concatena a pasta com o nome
				$destino = '../../../resource/img/fotos/'.$novoNome; 

				// tenta mover o arquivo para o destino
				//@move_uploaded_file( $arquivo_tmp, $destino  );
				//upa foto e redimensiona para
				try{
					$img = WideImage::load( $arquivo_tmp);
	      			$img = $img->resize(800,800,'inside');
	      			$img->saveToFile($destino,90);
	      			//salva thumbnail da foto
	      			$img = WideImage::load($destino);
	      			$img = $img->resize(126,126,'inside');
	      			$destino='../../../resource/img/thumbnail/'.$novoNome;
	      			$img->saveToFile($destino,90);

	      			//salva nome da foto no BD como referencia
	      			$foto['nome']=$novoNome;
	      			$foto['praga_id']=$praga_id;
	      			$daoPraga = new PragaDAO();
	      			$daoPraga ->salvarFoto($foto);
      			}catch(WideImage_InvalidImageSourceException $e){
      				continue;
      			}
			}
		}
	}
}
//salva apenas unica foto, método utilizado por enquanto apenas ao salvar foto do autor
function salvarFoto($files, $id, $src){
	if(isset($files['foto']['name']) && $files["foto"]["error"]== 0)
	{
		$arquivo_tmp = $files['foto']['tmp_name'];
		$nome = $files['foto']['name'];
	
		// Pega a extensao
		$extensao = strrchr($nome, '.');

		// Converte a extensao para mimusculo
		$extensao = strtolower($extensao);
		// Somente imagens, .jpg;.jpeg;.png
		// Aqui eu enfilero as extesões permitidas e separo por ';'
		// Isso server apenas para eu poder pesquisar dentro desta String
		if(strstr('.jpg;', $extensao))
		{
			// Cria um nome único para esta imagem
			// Evita que duplique as imagens no servidor.
			$novoNome = $id.'.jpeg';
			// Concatena a pasta com o nome
			$destino = $src.$novoNome; 

			// tenta mover o arquivo para o destino
			@move_uploaded_file( $arquivo_tmp, $destino  );
			//upa foto e redimensiona para
			$img = WideImage::load($destino);
  			$img = $img->resize(250,250,'inside');
  			$img->saveToFile($destino,90);
		}
	}
}
?>
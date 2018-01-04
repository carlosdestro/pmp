<?php

//header('Content-Type: text/html; charset=utf-8');


//include("seguranca.php"); // Inclui o arquivo com o sistema de segurança
include("pdo.php");
//protegePagina(); // Chama a função que protege a página

if(isset($_REQUEST['registro']))
{
    //include('pdo.php');

        $item = "curriculo";
        $item_nome = "curriculo_nome";
        $disp = "attachment";

        if($_REQUEST['type'] == 'foto')
        {
            $item = "foto";
            $item_nome = "foto_nome";
            $disp = "inline";
        }

    $user = pdo_consulta(
                "SELECT $item_nome, $item FROM curriculos where registro = :registro", 
                array(':registro' => $_REQUEST['registro']))[0];



    $path_parts = pathinfo($user[$item_nome]);

    $ext = strtolower($path_parts["extension"]);

    switch ($ext) 
    {
      case "pdf": $ctype="application/pdf"; break;
      case "exe": $ctype="application/octet-stream"; break;
      case "zip": $ctype="application/zip"; break;
      case "doc": $ctype="application/msword"; break;
      case "xls": $ctype="application/vnd.ms-excel"; break;
      case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
      case "gif": $ctype="image/gif"; break;
      case "png": $ctype="image/png"; break;
      case "jpeg":
      case "jpg": $ctype="image/jpg"; break;
      default: $ctype="application/force-download";
    }

    if($_REQUEST['size'] == 1)
    {

        function createThumbnail($filepath,  $thumbnail_width, $thumbnail_height, $background=false) {
          $thumbpath = uniqid(rand(), true) . '.png';
            list($original_width, $original_height, $original_type) = getimagesize($filepath);
            if ($original_width > $original_height) {
                $new_width = $thumbnail_width;
                $new_height = intval($original_height * $new_width / $original_width);
            } else {
                $new_height = $thumbnail_height;
                $new_width = intval($original_width * $new_height / $original_height);
            }
            $dest_x = intval(($thumbnail_width - $new_width) / 2);
            $dest_y = intval(($thumbnail_height - $new_height) / 2);

            if ($original_type === 1) {
                $imgt = "ImageGIF";
                $imgcreatefrom = "ImageCreateFromGIF";
            } else if ($original_type === 2) {
                $imgt = "ImageJPEG";
                $imgcreatefrom = "ImageCreateFromJPEG";
            } else if ($original_type === 3) {
                $imgt = "ImagePNG";
                $imgcreatefrom = "ImageCreateFromPNG";
            } else {
                return false;
            }

            $old_image = $imgcreatefrom($filepath);
            $new_image = imagecreatetruecolor($thumbnail_width, $thumbnail_height); // creates new image, but with a black background

            // figuring out the color for the background
            if(is_array($background) && count($background) === 3) {
              list($red, $green, $blue) = $background;
              $color = imagecolorallocate($new_image, $red, $green, $blue);
              imagefill($new_image, 0, 0, $color);
            // apply transparent background only if is a png image
            } else if($background === 'transparent' && $original_type === 3) {
              imagesavealpha($new_image, TRUE);
              $color = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
              imagefill($new_image, 0, 0, $color);
            }

            imagecopyresampled($new_image, $old_image, $dest_x, $dest_y, 0, 0, $new_width, $new_height, $original_width, $original_height);
            $imgt($new_image, $thumbpath);
            return file_get_contents($thumbpath);
        }
        
        $source = uniqid(rand(), true) . $user[$item_nome];
          file_put_contents($source, $user[$item]);

        $user[$item] = createThumbnail($source, 100,100, true);

    }
//die();
    header("Content-Type: $ctype");
    header("Content-Disposition: $disp; filename=\"".$user[$item_nome]."\";" );
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: ".strlen($user[$item]));
    ob_clean();
    
    $data = $user[$item];

    if(strlen($data) == 0)
       $data = file_get_contents("images/blank.png");

    echo $data;

    flush();

    exit;
}

?>

<html>
<head>
    <title>RM - Recrutamento do Moraes</title>
    <meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <style type="text/css">
       
       .registro img {
        width: 75px;
        max-height: 65px;        

       } 

        .registro
        {            
            margin: 5px;
        }
        .btn {
            margin-top: 25px;
        }
        
    </style>    
</head>

<body>
<div style="background-color:#FFFF00 "; align="center" ><img src="img/logofull.png" style=" width: 10%;" /></div>

<?php echo "Olá, " . $_SESSION['usuarioNome']; ?>

 <div class="container">
        <form action="" method="post" id='form-contato' enctype="multipart/form-data">

        <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="cidade" class="form-control" id="cidade" name="cidade" placeholder="Informe a sua Cidade">
                    <span class='msg-erro msg-cidade'></span>
                </div>

                </div>
                <div class="col-md-2">
                    <label for="idade">Idade Inicial</label>
                    <input type="idade" class="form-control" id="idadei" name="idadei" placeholder="Informe sua Idade" maxlength="2" onkeypress="mascara(this,soNumeros)">
                    <span class='msg-erro msg-idade'></span>
                </div>
                <div class="col-md-2">
                    <label for="idadef">Idade Final</label>
                    <input type="idadef" class="form-control" id="idadef" name="idadef" placeholder="Informe sua Idade" maxlength="2" onkeypress="mascara(this,soNumeros)">
                    <span class='msg-erro msg-idade'></span>
                </div>

                <div class="col-md-2">
                    <label for="sexo">Sexo</label>
                    <select class="form-control" name="sexo" id="sexo">
                    <option value="">Selecione o Sexo</option>
                    <option value="Feminino">Feminino</option>
                    <option value="Masculino">Masculino</option>
                    </select>
                    <span class='msg-erro msg-sexo'></span>
                </div>

                <div class="col-md-2">
                  <label for="vaga">Vaga</label>
                  <select class="form-control" name="vaga" id="vaga">
                    <option value="">Selecione uma Vaga</option>
                    <option value="Gerente de Loja">Gerente de Loja</option>
                    <option value="Balconista\Atendente">Balconista\Atendente</option>
                    <option value="Caixa Operador">Caixa Operador</option>
                    <option value="Farmacêutico">Farmacêutico</option>
                  </select>
                  <span class='msg-erro msg-vaga'></span>
                </div>
                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary" id='botao'> 
                       Filtrar
                     </button>
                </div>
                    
              
        </div>
        
        </form>
</div>

        
<?php

$resultado = pdo_consulta(
    "SELECT registro, nome, curriculo_nome, idade, sexo, cidade, vaga, rg, cpf FROM curriculos WHERE 1 = :um order by nome", 
    array(':um' => 1));


    // verificamos se a nossa consulta foi executada com sucesso

    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-1"><h4><b> Foto </b></h1></div>
            <div class="col-md-2"><h4><b> Nome Candidato </b></h1></div>
            <div class="col-md-1"><h4><b> Idade </b></h1></div>
            <div class="col-md-1"><h4><b> RG </b></h1></div>
            <div class="col-md-1"><h4><b> Sexo  </b></h1></div>
            <div class="col-md-2"><h4><b> Cidade </b></h1></div>
            <div class="col-md-2"><h4><b> Vaga </b></h1></div>
        </div>
    <?php
    if($resultado !== false)
    {
        foreach($resultado as $row) {
            $registro =  $row['registro'];

            echo "<div class='row'>
                      <div class='col-md-1 registro'> <a href='consulta.php?registro=$registro&type=cv'><img src='consulta.php?type=foto&registro=$registro'> </a> </div>
                      <div class='col-md-2'>" . $row['nome'].  "</div>
                      <div class='col-md-1'>" . $row['idade']. "</div>
                      <div class='col-md-1'>" . $row['rg'].    "</div>
                      <div class='col-md-1'>" . $row['sexo'].  "</div>
                      <div class='col-md-2'>" . $row['cidade']. "</div>
                      <div class='col-md-2'>" . $row['vaga']. '</div></div>';
        }         
    }

    ?>
        
    </div><?php

$conn = null;



?>
</body>
</html>
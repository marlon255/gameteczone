<?php
  include('../pags/connect.php');
  include('../pags/funcoes.php');

  //Retirando intrusos da pagina
  if($fetch_usuario['nivel'] == 1){
    echo "<script>location.href='../painel/404.php';</script>";
  };
  $d_inicial = $_SESSION['d_inicial'];
  $d_final = $_SESSION['d_final'];

  // Selecionando mais três frases, a partir da última
  $query = "SELECT * FROM despesas WHERE `date` BETWEEN '".$d_inicial."' AND '".$d_final."' AND `status` = '1' AND `pago` = '1' ORDER BY id asc";
  $busca = $PDO->prepare($query);
  $busca->execute();
  $fetch_busca = $busca->fetch(PDO::FETCH_ASSOC);

  //SQL PARA SOMAR VALORES SELECIONADOS
  $sqlsoma = "SELECT SUM(valor) AS total_global FROM despesas WHERE `date` BETWEEN '".$d_inicial."' AND '".$d_final."' AND `status` = '1' AND `pago` = '1'";
  $soma_total = $PDO->prepare($sqlsoma);
  $soma_total->execute();
  $total = $soma_total->fetch(PDO::FETCH_ASSOC);
  $echo_total = $total['total_global'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>GameTecZone</title>
  <link rel="shortcut icon" href="../assets/img/logo.ico">
  <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
  <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="../assets/js/jquery.maskInput.js"></script>
  <script type="text/javascript" src="../assets/js/jquery.maskMoney.js"></script>
  <script type="text/javascript" src="../assets/js/funcoes.js"></script>
  <style>@import url('https://fonts.googleapis.com/css?family=Ubuntu');</style>
</head>
<body>
  <table class="relatorio_container">
    <thead>
      <tr>
        <th rowspan="2" colspan="3" class="logo_relatorio"><img src="../assets/img/logo.png"></th>
        <th colspan="4"><h3>GameTecZone - Sua melhor loja de game</h3></th>
      </tr>
      <tr>
        <th colspan="4"><h5>Relatório de contas á pagar</h5></th>
      </tr>
      <tr>
        <th colspan="7"  class="texto_trelatorio">Relatório do período <?=date('d/m/Y', strtotime($d_inicial));?> a <?=date('d/m/Y', strtotime($d_final));?> de contas a pagar retirado no dia <?=date('d/m/Y');?>.</th>
      </tr>
      <tr class="cabecalho_relatorio">
        <th class="dados_date">Data</th>
        <th class="dados_description">Descrição</th>
        <th class="dados_pagamento">Data de Vencimento</th>
        <th class="dados_pagamento">Forma de Pagamento</th>
        <th>Observação</th>
        <th class="dados_valor">Valor</th>
        <th class="dados_pagamento">Data Lançamento</th>
      </tr>
    </thead>
    <tbody>
      <?php
        if($fetch_busca > 0){
          do{
      ?>
      <tr>
        <td class="dados_date"><?=date('d/m/Y', strtotime($fetch_busca['date']));?></td>
        <td class="dados_description"><?=$fetch_busca['descricao'];?></td>
        <td class="dados_pagamento"><?=date('d/m/Y', strtotime($fetch_busca['d_vencimento']));?></td>
        <td class="dados_pagamento"><?=$fetch_busca['f_pagamento'];?></td>
        <td><?=$fetch_busca['obs'];?></td>
        <td class="dados_valor"><?="R$ ".number_format($fetch_busca['valor'],2,',','.');?></td>
        <td class="dados_pagamento"><?=date('d/m/Y', strtotime($fetch_busca['data_creater']));?></td>
      </tr>
      <?php
        }while($fetch_busca = $busca->fetch(PDO::FETCH_ASSOC));
      }else{
        echo "<td colspan='7' style='text-align:center;'>Nenhum dado encontrado com os dados fornecidos anteriormente!</td>";
      };
      ?>
      <tr>
        <td colspan="5" class="total">TOTAL:</td>
        <td colspan="2" class="valor"><?=number_format($echo_total,2,',','.');?></td>
      </tr>
      <tr>
        <th colspan="7" class="rodape_relatorio">Todos direitos reservados. LightUp!</th>
      </tr>
    </tbody>
  </table>
</body>
</html>
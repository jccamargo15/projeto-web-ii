<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
  include_once('class/class.ContasDAO.php');

  function monta_moeda($valor) {
    $valor = number_format($valor, 2, ',', '.');
    return $valor;
  }

  $contasDAO = new ContasDAO();
?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">EXTRATO DA CONTA</h4>

      <form class="needs-validation" action="src/acao_extrato.carteira.php" method="POST" novalidate>
        <input type="hidden" name="acao" value="extrato_carteira">
        
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Conta</label>
             <select class="form-control" name="id_conta" id="id_conta">
              <?php
              $conta = $contasDAO->lista();
              foreach ($conta as $i =>$val) { ?>
                <option value = "<?php echo $conta[$i]->getId() ?>"><?php echo $conta[$i]->getNome() ?></option>
              <?php } ?>
            </select>
          </div> 
        </div>        
          
          <?php  
            if (isset($_POST['mesFiltro']) && !empty($_POST['mesFiltro'])) {
              $mes = $_POST['mesFiltro'];
            } else {
              $mes = date("m");
            }
            if (isset($_POST['anoFiltro']) && !empty($_POST['anoFiltro'])) {
              $ano = $_POST['anoFiltro'];
            } else {
              $ano = date("Y");
            }
          ?>

        <div class="row">
          <div class="col-md-3 mb-3">
            <label for="dataFiltro">Mês</label>
              <select class="form-control" name="mesFiltro" id="">
                <option value="1" <?php if ($mes=='1') {echo 'selected';} ?>>Janeiro</option>
                <option value="2" <?php if ($mes=='2') {echo 'selected';} ?>>Fevereiro</option>
                <option value="3" <?php if ($mes=='3') {echo 'selected';} ?>>Março</option>
                <option value="4" <?php if ($mes=='4') {echo 'selected';} ?>>Abril</option>
                <option value="5" <?php if ($mes=='5') {echo 'selected';} ?>>Maio</option>
                <option value="6" <?php if ($mes=='6') {echo 'selected';} ?>>Junho</option>
                <option value="7" <?php if ($mes=='7') {echo 'selected';} ?>>Julho</option>
                <option value="8" <?php if ($mes=='8') {echo 'selected';} ?>>Agosto</option>
                <option value="9" <?php if ($mes=='9') {echo 'selected';} ?>>Setembro</option>
                <option value="10" <?php if ($mes=='10') {echo 'selected';} ?>>Outubro</option>
                <option value="11" <?php if ($mes=='11') {echo 'selected';} ?>>Novembro</option>
                <option value="12" <?php if ($mes=='12') {echo 'selected';} ?>>Dezembro</option>
              </select>
          </div>
          <div class="col-md-3 mb-3">
            <label for="anoFiltro">Ano</label>
            <select class="form-control" name="anoFiltro" id="">
              <option value="2017" <?php if ($ano=='2017') {echo 'selected';} ?>>2017</option>
              <option value="2018" <?php if ($ano=='2018') {echo 'selected';} ?>>2018</option>
              <option value="2019" <?php if ($ano=='2019') {echo 'selected';} ?>>2019</option>
            </select>
          </div>
          <div class="col-md-4 mb-3" style="padding-top: 28px;">
            <button class="btn btn-primary" type="submit">Exibir</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>

<div class="table-responsive">
  <table class="table table-striped table-sm">
    <thead>
      <tr>
        <th>DATA</th>
        <th>TIPO</th>
        <th>VALOR</th>
      </tr>
    </thead>
    <tbody>
    <?php

   $lista = $extratoDAO->extrato_carteira($extrato);
      if($lista != 0){
        foreach ($lista as $i =>$val) {
          echo '<tr>';
            echo '<td>'. $lista[$i]->getData() .'</td>';
            echo '<td>'. $lista[$i]->getDescricao() .'</td>';
            echo '<td>'. $lista[$i]->getIdConta() .'</td>';
            echo '<td>'. $lista[$i]->getIdCentroCustos() .'</td>';
            echo '<td> R$ '. $lista[$i]->getValor() .'</td>';
            echo '<td> 
              <a href= "index.php?page=movimentacao_credito&editar=1&id='. $lista[$i]->getId() .'&acao=editar"><img width="24px" heigth="24px" src="img/edit.png"></a>
              <a href= "src/acao_movimentacao.php?id='. $lista[$i]->getId() .'&acao=excluir&tipo=credito"><img width="24px" heigth="244px" src="img/delete.png"></a>
            </td>';

          echo '</tr>';
        }
      }else{
        echo 'Nenhum registro encontrado!';
      }
    ?>
  </tbody>
  </table>

  <hr class="mb-4">
  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; Projeto Web 2</p>
  </footer>
</div>
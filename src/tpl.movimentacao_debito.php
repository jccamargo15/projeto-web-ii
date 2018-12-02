<!-- Projeto GitHub: https://github.com/jccamargo15/projeto-web2 -->
<?php
  include_once('class/class.Movimentacao.php');
  include_once('class/class.MovimentacaoDAO.php');
  include_once('class/class.ContasDAO.php');
  include_once('class/class.CentroCustosDAO.php');

  function monta_moeda($valor) {
    $valor = number_format($valor, 2, ',', '.');
    return $valor;
  }

  if( isset($_GET['confirm']) and !empty($_GET['confirm']) ){
    if($_GET['confirm'] == 1){
      // echo "Débito cadastrado com sucesso!!";
      echo '<div class="alert alert-success" role="alert">Débito cadastrado com sucesso</div>';
    }
    if($_GET['confirm'] == 2){
      // echo "Débito atualizado com sucesso!!";
      echo '<div class="alert alert-primary" role="alert">Débito atualizado com sucesso</div>';
    }
    if($_GET['confirm'] == 3){
      // echo "Débito excluído com sucesso!!";
      echo '<div class="alert alert-danger" role="alert">Débito excluído com sucesso</div>';
    }
  }

  $movimentacaoDAO = new MovimentacaoDAO();
  $contasDAO = new ContasDAO();
  $centroCustosDAO = new CentroCustosDAO();

  if( isset($_GET['editar']) and !empty($_GET['editar']) ){
    $id = $_GET['id'];

    $vetor = $movimentacaoDAO->listaUm($id);
  ?>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Débitos</h4>

      <form class="needs-validation" action="src/acao_movimentacao.php" method="POST" novalidate>
        <input type="hidden" name="acao" value="editar">
        <input type="hidden" name="id" value="<?php echo $vetor[0]->getId();?>">
        <input type="hidden" name="tipo_mov" value="<?php echo $vetor[0]->getTipoMov();?>">
        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="firstName">Conta</label>
            <select class="form-control" name="id_conta" id="id_conta">
              <?php 
              $conta = $contasDAO->lista();
              foreach ($conta as $i =>$val) { 
                if($conta[$i]->getId() == $vetor[0]->getIdConta()){
                  ?>
                  <option value = "<?php echo $conta[$i]->getId() ?>" selected><?php echo $conta[$i]->getNome() ?></option>
                  <?php
                }else{
                  ?>
                  <option value = "<?php echo $conta[$i]->getId() ?>"><?php echo $conta[$i]->getNome() ?></option>
              <?php 
                } 
              }?>
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label for="firstName">Categoria</label>
            <select class="form-control" name="id_centro_custos" id="id_centro_custos">
              <?php 
              $categoria = $centroCustosDAO->lista();
              foreach ($categoria as $i =>$val) { 
                if($categoria[$i]->getId() == $vetor[0]->getIdCentroCustos()){
                  ?>
                  <option value = "<?php echo $categoria[$i]->getId() ?>" selected><?php echo $categoria[$i]->getNome() ?></option>
                  <?php
                }else{
                  ?>
                  <option value = "<?php echo $categoria[$i]->getId() ?>"><?php echo $categoria[$i]->getNome() ?></option>
              <?php 
                } 
              }?>
            </select>
          </div>

          <div class="col-md-6 mb-3">
            <label for="firstName">Data</label>
            <input type="date" class="form-control" name="data" id="data" placeholder="" value="<?php echo $vetor[0]->getData() ?>" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="firstName">Valor</label>
            <input type="text" class="form-control" name="valor" id="valor" placeholder="" value="<?php echo monta_moeda($vetor[0]->getValor()); ?>" onKeyPress="return(moeda(this,'.',',',event))" required>
          </div>

          <div class="col-md-12 mb-3">
            <label for="firstName">Descrição</label>
            <input type="text" class="form-control" name="descricao" id="descriçao" placeholder="" value="<?php echo $vetor[0]->getDescricao() ?>" required>
          </div>


        </div>

        <button class="btn btn-primary" type="submit">Salvar</button>
        <a class="btn btn-primary" href="?page=movimentacao_debito" role="button">Voltar</a>
      </form>
    </div>
  </div>
</div>

<?php
  }else{
?>
  
  <div class="container-fluid">
  <div class="row">
    <div class="col-md-8 order-md-1">
      <h4 class="mb-3">Débitos</h4>

      <form class="needs-validation" action="src/acao_movimentacao.php" method="POST" novalidate>
        <input type="hidden" name="acao" value="inserir">
        <input type="hidden" name="tipo_mov" value="debito">

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

          <div class="col-md-6 mb-3">
            <label for="firstName">Categoria</label>
             <select class="form-control" name="id_centro_custos" id="id_centro_custos">
              <?php
              $categoria = $centroCustosDAO->lista();
              foreach ($categoria as $i =>$val) { ?>
                <option value = "<?php echo $categoria[$i]->getId() ?>"><?php echo $categoria[$i]->getNome() ?></option>
              <?php } ?>
            </select>
          </div>
          
          <div class="col-md-6 mb-3">
            <label for="firstName">Data</label>
            <input type="date" class="form-control" name="data" id="data" placeholder="" value="" required>
          </div>

          <div class="col-md-6 mb-3">
            <label for="firstName">Valor</label>
            <input type="text" class="form-control" name="valor" id="valor" placeholder="" value="" onKeyPress="return(moeda(this,'.',',',event))" required>
          </div>

          <div class="col-md-12 mb-3">
            <label for="firstName">Descrição</label>
            <input type="text" class="form-control" name="descricao" id="descriçao" placeholder="" value="" required>
          </div>
        </div>

        <button class="btn btn-primary" type="submit">Salvar</button>
      </form>
    </div>
  </div>
</div>

<?php
  }
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

<hr class="mb-4">

<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <form action="?page=movimentacao_debito" method="post">
        <div class="form-row">
          <div class="col-md-4 mb-3">
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
          <div class="col-md-4 mb-3">
            <label for="anoFiltro">Ano</label>
            <select class="form-control" name="anoFiltro" id="">
              <option value="2017" <?php if ($ano=='2017') {echo 'selected';} ?>>2017</option>
              <option value="2018" <?php if ($ano=='2018') {echo 'selected';} ?>>2018</option>
              <option value="2019" <?php if ($ano=='2019') {echo 'selected';} ?>>2019</option>
            </select>
          </div>
          <div class="col-md-4 mb-3" style="padding-top: 28px;">
            <button class="btn btn-primary" type="submit">Filtrar</button>
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
        <th>DESCRIÇÃO</th>
        <th>CONTA</th>
        <th>CATEGORIA</th>
        <th>VALOR</th>
        <th>AÇÃO</th>
      </tr>
    </thead>
    <tbody>
    <?php

    $tipo = 'debito';
    $lista = $movimentacaoDAO->lista($tipo, $mes, $ano);
      if($lista != 0){
        foreach ($lista as $i =>$val) {
          echo '<tr>';
            echo '<td>'. $lista[$i]->getData() .'</td>';
            echo '<td>'. $lista[$i]->getDescricao() .'</td>';
            echo '<td>'. $lista[$i]->getIdConta() .'</td>';
            echo '<td>'. $lista[$i]->getIdCentroCustos() .'</td>';
            echo '<td> R$ '. $lista[$i]->getValor() .'</td>';
            echo '<td> 
              <a href= "index.php?page=movimentacao_debito&editar=1&id='. $lista[$i]->getId() .'&acao=editar"><img width="24px" heigth="24px" src="img/edit.png"></a>
              <a href= "src/acao_movimentacao.php?id='. $lista[$i]->getId() .'&acao=excluir&tipo=debito"><img width="24px" heigth="244px" src="img/delete.png"></a>
            </td>';

          echo '</tr>';
        }
      }else{
        echo 'Nenhum registro encontrado!';
      }
    ?>
  </tbody>
  </table>

<?php include 'tpl.footer.php'; ?>
</div>
<!-- criado por Jocemar Flores em 21/10/18
  
-->
<?php
  include_once('class/class.Movimentacao.php');
  include_once('class/class.MovimentacaoDAO.php');
  include_once('class/class.ContasDAO.php');
  include_once('class/class.CentroCustosDAO.php');


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
            <input type="text" class="form-control" name="valor" id="valor" placeholder="" value="<?php echo $vetor[0]->getValor() ?>" required>
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
            <input type="text" class="form-control" name="valor" id="valor" placeholder="" value="" required>
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
?>

<hr class="mb-4">

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
    $lista = $movimentacaoDAO->lista($tipo);
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

  <hr class="mb-4">
  <footer class="my-5 pt-5 text-muted text-center text-small">
    <p class="mb-1">&copy; Projeto Web 2</p>
  </footer>
</div>
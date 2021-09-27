<?php 
while($dados = mysqli_fetch_array($resultado)){
  $email = $dados['email'];
  $senha = $dados['senha']; ?>
 <tr>
      <th scope="row"></th>
      <td><?php $email ?></td>
      <td><?php $senha ?></td>

    </tr> 
    <?php } ?>
 </tbody>
</table>
  </div>
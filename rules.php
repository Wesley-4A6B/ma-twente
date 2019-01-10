<?php
//privilege 1 = gebruiker
//privilege 2 = ICT-beheerder

//Geslacht 1 = vrouw
//Geslacht 2 = man
?>

<select class="form-control" name="geslacht">
<?php if($geslacht == 1) { ?>
  <option value="1" selected="selected">Vrouw</option>
  <option value="2">Man</option>
<?php } else { ?>  
  <option value="2" selected="selected">Man</option>
  <option value="1">Vrouw</option>
<?php } ?>  
</select>

<select class="form-control" name="privilege">
<?php if($privilege == 1) { ?>
  <option value="1" selected="selected">Gebruiker</option>
  <option value="2">Beheerder</option>
<?php } else { ?>
  <option value="2" selected="selected">Beheerder</option>
  <option value="1">Gebruiker</option>
<?php } ?>  
</select>
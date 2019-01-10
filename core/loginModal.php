<?php include("dologin.php"); ?>
<div class="modal fade loginModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="row">
      <div class="col-xs-3"></div>
      <div class="col-xs-6">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Sluit</span></button>
            <h4 class="modal-title" id="myModalLabel">Login</h4>
          </div>
          <div class="well">

            <fxorm id="loginForm" method="POST">
              <div class="form-group">
                <label for="gebruiker" class="control-label">Gebruiker</label>
                <input type="text" class="form-control" id="gebruiker" name="gebruiker" title="Vul uw gebruikersnaam in">
              </div>
              <div class="form-group">
                <label for="wachtwoord" class="control-label">Wachtwoord</label>
                <input type="password" class="form-control" id="wachtwoord" name="wachtwoord" title="Vul uw wachtwoord in">
              </div>
              <div id="loginErrorMsg" class="text-danger"></div>
              <button onclick = "login()" class="btn btn-primary btn-block">Login</button>
            </form>

          </div>
        </div>
        <div class="col-xs-3"></div>
      </div>
    </div>
  </div>
</div>
<style type="text/css">
  #accessDenied{
    background: url(custom/images/acessDenied.jpg) no-repeat center center fixed; 
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
    position: relative;
    height: 100%;
  }
  #backCont{
    background: rgba(0, 0, 0, 0.59);
    width: 100%;
    height: 100%;
    position: absolute;
    padding: 0 50px;
    color: #ffffff;
  }
  #backCont > h1{
    margin-top: 150px;
  }
  .row{
    margin-top: 100px;
  }
  #error_al{
    display: block;
    text-align: center;
  }
  img{
    width: 100%;
  }
</style>
<article id="accessDenied">
  <div id="backCont">
    <h1><span class="glyphicon glyphicon-ban-circle" aria-hidden="true"></span> Acesso Negado</h1>
    <div class='row'>
      <div class='col-md-offset-3 col-md-6 col-xs-12'>
        <div class='alert alert-danger' id="error_al">
          <h4>Utilizador sem permissões ou não autentificado.</h4>
        </div>
      </div>
    </div>
  </dib>
</article>

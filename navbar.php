<!-- As a heading -->
<nav class="navbar navbar-light">
  <div class="container-fluid">
    <span class="navbar-brand mb-0 h1"><h4><i  onclick="ToggloFunction()" class="bi bi-justify"></i> Dress'up Haïti</h4></span>
    <p class="droit"><?php if(isset($_GET['msg'])){ echo $_GET['msg']; } ?></p>
  </div>
  <div >
    <nav class="soumenu">
      <ul>
        <li><a href="">Update Count</a></li>
        <li><a href="">Logout</a></li>
      </ul>
    </nav>
  </div>
</nav>

<style>
   nav{
    height: 66px;
    background-color: #343a40;
   } 

   i{
    margin-right: 5px;
    cursor: pointer;
   }


   h4{
    font-size: 27px;
    color: #ffffff;
    margin-top: 16px;
    margin-bottom: 14px;
    margin-left: 15px;   
}

.soumenu{
  position: absolute;
  right: 0;
  top: -1px;
  display: none;
}

.droit{
    color: yellow;
    font-size: 18px;
    margin-top: 10px;
    margin-right: 50px;
    
   }

</style>
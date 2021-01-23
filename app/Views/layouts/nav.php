<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="/">TokoLine CI4</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home</a>
      </li>
      <?php if(session()->get('role') == 0) : ?>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Barang</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item" href="/barang">Daftar Barang</a>
          <a class="dropdown-item" href="/barang/create">Tambah Barang</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <?php endif; ?>
      <li class="nav-item">
        <a class="nav-link" href="/etalase">Etalase</a>
      </li>
    </ul>
    <div class="form-inline my-2 my-lg-0">
      <ul class="navbar-nav mr-auto">
        <?php if(!session()->has('isLoggedIn')) : ?>
        <li class="nav-item">
          <a class="nav-link text-white" href="/auth/register">Daftar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-white" href="/auth">Login</a>
        </li>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link text-white" href="/auth/logout">Logout</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
      
  </div>
</nav>
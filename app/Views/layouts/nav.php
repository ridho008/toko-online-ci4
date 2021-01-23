<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="/">TokoLine CI4</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
<?= uri_string(); ?>
  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <?php if(session()->get('isLoggedIn')) : ?>
    <ul class="navbar-nav mr-auto">
      <li class="nav-item<?= (uri_string() == '/') ? ' active' : '' ?>">
        <a class="nav-link" href="/">Home</a>
      </li>
      <?php if(session()->get('role') == 0) : ?>
      <li class="nav-item<?= (uri_string() == 'transaksi') ? ' active' : '' ?>">
        <a class="nav-link" href="/transaksi">Transaksi</a>
      </li>
      <li class="nav-item dropdown<?= (uri_string() == 'barang/create' || uri_string() == 'barang') ? ' active' : '' ?>">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Barang</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <a class="dropdown-item<?= (uri_string() == 'barang') ? ' active' : '' ?>" href="/barang">Daftar Barang</a>
          <a class="dropdown-item<?= (uri_string() == 'barang/create') ? ' active' : '' ?>" href="/barang/create">Tambah Barang</a>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <?php endif; ?>
      <li class="nav-item<?= (uri_string() == 'etalase') ? ' active' : '' ?>">
        <a class="nav-link" href="/etalase">Etalase</a>
      </li>
    </ul>
    <?php endif; ?>
    <div class="form-inline my-2 my-lg-0">
      <ul class="navbar-nav mr-auto">
        <?php if(!session()->has('isLoggedIn')) : ?>
        <li class="nav-item<?= (uri_string() == 'register') ? ' active' : '' ?>">
          <a class="nav-link text-white" href="/auth/register">Daftar</a>
        </li>
        <li class="nav-item<?= (uri_string() == 'login') ? ' active' : '' ?>">
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
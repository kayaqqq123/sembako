<div class="logo"><a href="http://www.creative-tim.com" class="simple-text logo-normal">
    Creative Tim
  </a></div>
<div class="sidebar-wrapper">
  <ul class="nav">
    <li class="nav-item active  ">
      <a class="nav-link" href="{{route('sembako.index','semua')}}">
        <i class="material-icons">dashboard</i>
        <p>Semua Barang</p>
      </a>
    </li>
    <li class="nav-item active  ">
        <a class="nav-link" href="{{route('sembako.index','3_hari_lagi')}}">
          <i class="material-icons">library_books</i>
          <p>Barang Kedaluwarsa</p>
        </a>
      </li>
      <li class="nav-item active  ">
        <a class="nav-link" href="{{ route('sembako.create') }}">
          <i class="material-icons">library_books</i>
          <p>Input Barang</p>
        </a>
      </li>
  </ul>
</div>
</div>

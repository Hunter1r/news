<div class="row flex-nowrap justify-content-between align-items-center">
    <div class="col-4 pt-1">
      <a class="btn btn-sm btn-outline-secondary" href="#">Subscribe</a>
      <a class="btn btn-sm btn-outline-secondary" href="{{ route('feedback.create') }}">to provide Feedback</a>
    </div>
        
    <div class="col-4 text-center">
      <a class="blog-header-logo text-dark" href="/">Top News</a>
    </div>
    <div class="col-4 d-flex justify-content-end align-items-center">
      <a class="link-secondary" href="#" aria-label="Search">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="mx-3" role="img" viewBox="0 0 24 24"><title>Search</title><circle cx="10.5" cy="10.5" r="7.5"/><path d="M21 21l-5.2-5.2"/></svg>
      </a>
      
      <a style="margin-right: 5px" class="btn btn-sm btn-outline-secondary" href="{{ route('admin.admin') }}">Admin Panel</a>
      @auth
        <a style="margin-right: 5px" class="btn btn-sm btn-outline-secondary" href="{{ route('import.create') }}">import News</a>    
      @endauth
      @guest
        <a style="margin-right: 5px" class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Sign in</a>
        <a style="margin-right: 5px" class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">Sign up</a>    
      @endguest
      @auth
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('logout') }}">Sign out</a>    
      @endauth
      <a style="margin-right: 5px" class="btn btn-sm btn-outline-secondary" href="{{ route('vkLogin') }}">Login with VK</a>
      
      
    </div>
  </div>
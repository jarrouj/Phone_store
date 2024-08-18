<!DOCTYPE html>
<html lang="en">
    <head>
   @include('Admin.components.css')
    </head>
    <body class="sb-nav-fixed">
       @include('Admin.components.navbar')
        <div id="layoutSidenav">
            @include('Admin.components.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    @include('Admin.dashboard.show_dashboard')
                </main>
               @include('Admin.components.footer')
            </div>
        </div>
      @include('Admin.components.js')
    </body>
</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('cms/js/scripts.js')}}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> --}}
<script src="{{ asset('cms/assets/demo/chart-area-demo.js')}}"></script>
<script src="{{ asset('cms/assets/demo/chart-bar-demo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('cms/js/datatables-simple-demo.js')}}"></script>


<script>
    function confirmDelete(categoryId) {
        if (confirm('Do you want to delete all products related to this category?')) {
            window.location.href = `/admin/delete_category/${categoryId}?deleteProducts=yes`;
        } else {
            if (confirm('Do you want to delete the category without deleting the products?')) {
                window.location.href = `/admin/delete_category/${categoryId}?deleteProducts=no`;
            }
        }
    }
</script>



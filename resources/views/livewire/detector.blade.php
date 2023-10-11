<div>
    <script>
        import InApp from 'detect-inapp';
        const inapp = new InApp(navigator.userAgent || navigator.vendor || window.opera);

        if(inapp.isInApp){
            // alert('web view detect');
            if(window.location.href!=='http://127.0.0.1:8000/view'){
                window.location.replace('http://127.0.0.1:8000/view');
            }
        }else{
            // alert(inapp.browser);
            console.log(inapp.browser);
        }

        alert('test');
        $(document).ready(function() {
        });
    </script>    
</div>

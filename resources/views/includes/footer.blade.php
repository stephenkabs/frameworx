<footer class="footer" style="background: linear-gradient(to right, #ffffff, #ffffff);">
    <div class="container-fluid">
        <div class="row">
            @foreach ($displaySettings as $setting)
            <div style="font-size: 10px;text-transform: uppercase;" class="col-12">
                ©
                <script>document.write(new Date().getFullYear()) </script> {{ $setting->copyright }}</span>
            </div>
            @endforeach
        </div>
    </div>
</footer>

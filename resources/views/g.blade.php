{{-- resources/views/faq.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>DevNest FAQ</title>
  <style>
    body { font-family: Arial, sans-serif; margin:0; padding:0; background:#f9f9f9; color:#333; }
    .container { max-width:960px; margin:2rem auto; padding:0 1rem; }
    header { background:#fff; box-shadow:0 2px 4px rgba(0,0,0,0.1); padding:1rem 0; }
    #logo img { height:40px; display:inline-block; vertical-align:middle; }
    nav { display:inline-block; margin-left:2rem; vertical-align:middle; }
    nav ul { list-style:none; margin:0; padding:0; display:flex; gap:1rem; }
    nav a { text-decoration:none; color:#333; font-weight:500; }
    nav a:hover { color:#007bff; }
    .login-btn { float:right; background:#ff8c00; color:#000; padding:.5rem 1rem; border-radius:4px; text-decoration:none; }
    h1 { margin:2rem 0 1rem; font-size:2rem; text-align:center; }
    .accordion { margin-bottom:1rem; border-radius:4px; overflow:hidden; box-shadow:0 1px 3px rgba(0,0,0,0.1); background:#fff; }
    .accordion-header { padding:1rem; cursor:pointer; position:relative; }
    .accordion-header:hover { background:#f1f1f1; }
    .accordion-header::after {
      content: '+'; position:absolute; right:1rem; font-size:1.2rem;
      transition: transform .2s;
    }
    .accordion-header.active::after { transform: rotate(45deg); }
    .accordion-body { max-height:0; overflow:hidden; transition: max-height .3s ease; padding:0 1rem; }
    .accordion-body p { margin:1rem 0; }
    .pro-tip { background:#eef9ff; border-left:4px solid #007bff; padding:1rem; margin-top:2rem; border-radius:4px; }
  </style>
</head>
<body>

  <!-- header -->
  <header>
    <div class="container">
      <div style="display:flex; align-items:center; justify-content:space-between;">
        <a href="{{ url('/') }}" id="logo">
          @foreach($generalSettings as $item)
            <img src="/settings/logo_dark/{{ $item->image }}" alt="logo">
          @endforeach
        </a>
        <nav>
          <ul>
            <li><a href="{{ url('/') }}">Home</a></li>
            @php $subs = $menu->where('type','sub_menu'); @endphp
            @if($subs->count())
              <li>
                <a href="#">Solutions ▾</a>
                <ul style="position:absolute; background:#fff; box-shadow:0 2px 6px rgba(0,0,0,0.1); padding:.5rem 0; display:none;">
                  @foreach($subs as $i)
                    <li><a href="{{ $i->link }}">{{ $i->sub_name }}</a></li>
                  @endforeach
                </ul>
              </li>
            @endif
            @foreach($menu->where('type','main_menu') as $i)
              <li><a href="{{ $i->link }}">{{ $i->menu_name }}</a></li>
            @endforeach
          </ul>
        </nav>
        <a href="{{ route('login') }}" class="login-btn">Login</a>
      </div>
    </div>
  </header>

  <div class="container">
    <h1>DevNest Troubleshooting FAQ</h1>

    @php
    $faqs = [
      ['title'=>'❌ SSH login failed',
       'body'=>'DevNest couldn’t connect to your server as <code>azureuser</code>.<br>
        • Verify the server IP/hostname.<br>
        • Check your PEM key in <code>~/.ssh/authorized_keys</code> and permissions (<code>chmod 600</code>).<br>
        • Test manually: <code>ssh -i key.pem azureuser@your-server-ip</code>.'],
      ['title'=>'“Please close the channel (1) before trying to open it again.”',
       'body'=>'Net‑SSH allows only one channel at a time.<br>
        • Use a fresh <code>new SSH2(...)</code> or call <code>$ssh->disconnect()</code> before switching to SFTP.'],
      ['title'=>'autoload.php missing',
       'body'=>'Looks like <code>vendor/autoload.php</code> isn’t there.<br>
        • Run <code>composer install --no-interaction --prefer-dist</code> in your project.<br>
        • Ensure PHP & Git are installed: <code>sudo apt install php-cli git unzip curl</code>.'],
      ['title'=>'.env file not found or invalid',
       'body'=>'• Check permissions: <code>storage/</code> & <code>bootstrap/cache/</code> must be writable by <code>www-data</code>.<br>
        • Make sure your stub has no stray spaces—wrap multi‑word values in quotes.'],
      ['title'=>'Access denied for user “laravel_user”',
       'body'=>'• Confirm MySQL user & privileges in your provision log.<br>
        • Test: <code>mysql -u laravel_user -p</code> then <code>SHOW DATABASES;</code>.'],
      ['title'=>'SSL / Certbot errors',
       'body'=>'• Install Certbot: <code>sudo apt install certbot python3-certbot-apache</code>.<br>
        • Ensure your DNS A/AAAA records point to this server before running Certbot.'],
      ['title'=>'404 after deployment',
       'body'=>'• Ensure vhost is enabled:<br>
         <code>sudo a2ensite your-app.conf && sudo systemctl reload apache2</code>.<br>
        • Check <code>ServerName</code> matches your domain.'],
      ['title'=>'Quick Deploy webhook not firing',
       'body'=>'• Verify GitHub webhook URL is reachable: <code>/webhook/github/{slug}</code>.<br>
        • Check <code>GITHUB_WEBHOOK_SECRET</code> in DevNest’s <code>.env</code>.']
    ];
    @endphp

    @foreach($faqs as $i => $faq)
      <div class="accordion">
        <div class="accordion-header" onclick="toggleAccordion({{ $i }})">
          {{ $faq['title'] }}
        </div>
        <div class="accordion-body" id="body-{{ $i }}">
          <p>{!! $faq['body'] !!}</p>
        </div>
      </div>
    @endforeach

    <div class="pro-tip">
      🔍 <strong>Pro Tip:</strong>
      When you see a 500 error, tail the logs on your VM:<br>
      <code>sudo tail -n 50 /var/www/html/your-app/storage/logs/laravel.log</code><br>
      <code>sudo tail -n 50 /var/log/apache2/error.log</code>
    </div>
  </div>

  <script>
    function toggleAccordion(i) {
      const hdr = document.querySelectorAll('.accordion-header')[i];
      const body = document.getElementById(`body-${i}`);
      hdr.classList.toggle('active');
      if(hdr.classList.contains('active')) {
        body.style.maxHeight = body.scrollHeight + 'px';
      } else {
        body.style.maxHeight = null;
      }
    }
    // initialize collapse
    document.addEventListener('DOMContentLoaded',()=>{
      document.querySelectorAll('.accordion-body').forEach(b=>b.style.maxHeight=null);
    });
  </script>

</body>
</html>

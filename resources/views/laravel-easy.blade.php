<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>DevNest Troubleshooting FAQ</title>
  <style>
    body { font-family: Arial, sans-serif; line-height: 1.6; margin: 2rem; }
    header { padding: 1rem 0; }
    #logo img { max-height: 50px; display: inline-block; }
    #mainmenu { list-style: none; padding: 0; margin: 0; display: flex; gap: 1rem; }
    #mainmenu li { position: relative; }
    #mainmenu li ul { position: absolute; top: 100%; left: 0; background: #fff; list-style: none; padding: 0.5rem; display: none; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    #mainmenu li:hover ul { display: block; }
    .menu-item { text-decoration: none; color: #333; font-size: 14px; }
    .menu-item:hover { color: #0a9be3; }
    .btn-main { background-color: #ff8c00; color: #000; padding: 0.5rem 1rem; text-decoration: none; border-radius: 4px; }
    .pro-tip { background: #eef9ff; border-left: 4px solid #2a7ae2; padding: 1rem; margin-top: 2rem; }
  </style>
</head>
<body>

  <!-- header begin -->
  <header class="transparent scroll-light has-topbar">
    <div class="container">
      <div class="de-flex">
        <div id="logo">
          <a href="{{ url('/') }}">
            @foreach($generalSettings as $item)
              <img class="logo-main"   src="/settings/logo_white/{{ $item->file }}"  alt="logo" />
              <img class="logo-scroll" src="/settings/logo_dark/{{ $item->image }}" alt="logo" />
              <img class="logo-mobile" src="/settings/logo_dark/{{ $item->image }}" alt="logo" />
            @endforeach
          </a>
        </div>
        <nav class="de-flex-col header-col-mid">
          <ul id="mainmenu">
            <li><a class="menu-item" href="{{ url('/') }}">Home</a></li>

            @php
              $subItems = $menu->where('type','sub_menu');
            @endphp
            @if($subItems->isNotEmpty())
              <li>
                <a class="menu-item" href="#">Products</a>
                <ul>
                  @foreach($subItems as $item)
                    <li><a class="menu-item" href="{{ $item->link }}">{{ $item->sub_name }}</a></li>
                  @endforeach
                </ul>
              </li>
            @endif

            @foreach($menu as $item)
              @if($item->type==='main_menu')
                <li><a class="menu-item" href="{{ $item->link }}">{{ $item->menu_name }}</a></li>
              @endif
            @endforeach
          </ul>
        </nav>
        <div class="de-flex-col">
          <a href="{{ route('login') }}" class="btn-main">Login</a>
          <span id="menu-btn"></span>
        </div>
      </div>
    </div>
  </header>
  <!-- header close -->

  <h1>DevNest Troubleshooting FAQ</h1>

  <h2>1. ❌ SSH login failed</h2>
  <p><strong>Q:</strong> I see “❌ SSH login failed.” in the UI. What went wrong?<br>
  <strong>A:</strong> DevNest couldn’t connect to your server as <code>azureuser</code>.<br>
  &bull; Verify the server’s IP/hostname is correct.<br>
  &bull; Ensure your PEM key matches <code>~/.ssh/authorized_keys</code> and is <code>chmod 600</code> on the VM.<br>
  &bull; Test manually:<br>
  <code>ssh -i /path/to/key.pem azureuser@your-server-ip</code>
  </p>

  <h2>2. “Please close the channel (1) before trying to open it again.”</h2>
  <p><strong>Q:</strong> I get “Error: Please close the channel (1)…“ during database provisioning.<br>
  <strong>A:</strong> Net‑SSH only allows one SFTP or exec channel per connection at a time.<br>
  &bull; Make sure each phase (DB creation, env upload, migrations) uses a fresh <code>new SSH2(...)</code> instance or call <code>$ssh->disconnect()</code> before switching to SFTP.
  </p>

  <h2>3. “Failed to open stream: No such file or directory” (autoload.php)</h2>
  <p><strong>Q:</strong> I’m seeing errors about <code>vendor/autoload.php</code> missing.<br>
  <strong>A:</strong> Composer never ran or failed.<br>
  &bull; Ensure your provision script includes:<br>
  <code>cd /path/to/app && composer install --no-interaction --prefer-dist</code><br>
  &bull; Install prerequisites on the server:<br>
  <code>sudo apt update && sudo apt install php-cli git unzip curl -y</code>
  </p>

  <h2>4. ⚠️ “.env file not found” or parsing errors</h2>
  <p><strong>Q:</strong> DevNest reports “.env file not found” or my app errors say “The environment file is invalid.”<br>
  <strong>A:</strong>
  &bull; Check file permissions: <code>storage/</code> and <code>bootstrap/cache/</code> must be writable by Apache (<code>www-data</code>).<br>
  &bull; Ensure your stub <code>env-template.stub</code> has no unescaped spaces (wrap values in quotes if needed).
  </p>

  <h2>5. “Access denied for user ‘laravel_user’” in migrations</h2>
  <p><strong>Q:</strong> Migrations fail with “Access denied for user ‘laravel_user’.”<br>
  <strong>A:</strong>
  &bull; Verify the MySQL user and privileges in the provisioning log.<br>
  &bull; Test on the VM:<br>
  <code>mysql -u laravel_user -p<br>
  SHOW DATABASES;</code>
  </p>

  <h2>6. SSL / Certbot errors</h2>
  <p><strong>Q:</strong> SSL installation reports “command not found” or a DNS NXDOMAIN error.<br>
  <strong>A:</strong>
  &bull; Install Certbot:<br>
  <code>sudo apt install certbot python3-certbot-apache -y</code><br>
  &bull; Ensure your domain’s DNS A/AAAA record points to the server’s IP before running Certbot.
  </p>

  <h2>7. “404 Not Found” after deployment</h2>
  <p><strong>Q:</strong> My domain serves a 404 even though DevNest says “deployed”.<br>
  <strong>A:</strong>
  &bull; Check that the vhost file is present and enabled:<br>
  <code>ls /etc/apache2/sites-available<br>
  sudo a2ensite your-app.conf<br>
  sudo systemctl reload apache2</code><br>
  &bull; Confirm the <code>ServerName</code> in the vhost matches your domain exactly.
  </p>

  <h2>8. Quick Deploy webhook not firing</h2>
  <p><strong>Q:</strong> “Quick Deploy” pushes aren’t updating my server.<br>
  <strong>A:</strong>
  &bull; Verify GitHub webhook URL: <code>/webhook/github/{slug}</code> is publicly reachable.<br>
  &bull; Make sure the webhook secret matches <code>GITHUB_WEBHOOK_SECRET</code> in DevNest’s <code>.env</code>.<br>
  &bull; Check DevNest’s API logs for incoming payloads.
  </p>

  <div class="pro-tip">
    🔍 <strong>Pro Tip:</strong>
    When you see a 500 error, always start by tailing the logs on your VM:<br>
    <code>sudo tail -n 50 /var/www/html/your-app/storage/logs/laravel.log</code><br>
    <code>sudo tail -n 50 /var/log/apache2/error.log</code>
  </div>

</body>
</html>

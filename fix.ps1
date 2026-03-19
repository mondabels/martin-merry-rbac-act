$files = Get-ChildItem -Path app\Views -Recurse -Filter *.php
foreach ($f in $files) {
    $content = Get-Content $f.FullName -Raw
    $content = [regex]::Replace($content, 'href="/([^"]*)"', 'href="<?= base_url(''$1'') ?>"')
    $content = [regex]::Replace($content, 'action="/([^"]*)"', 'action="<?= base_url(''$1'') ?>"')
    Set-Content $f.FullName -Value $content -NoNewline
}

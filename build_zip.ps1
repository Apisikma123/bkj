$source = "d:\BKJ"
$tempDir = "d:\BKJ_TEMP_ZIP"
$destination = "d:\BKJ\bkj_ready_to_deploy.zip"

Write-Host "Preparing files for ZIP... This may take a minute or two."

If (Test-Path $tempDir) { Remove-Item -Recurse -Force $tempDir }
If (Test-Path $destination) { Remove-Item -Force $destination }

New-Item -ItemType Directory -Path $tempDir | Out-Null

Get-ChildItem -Path $source -Exclude "node_modules", ".git", ".gemini", "bkj_ready_to_deploy.zip", "build_zip.php", "build_zip.ps1" | Copy-Item -Destination $tempDir -Recurse

Write-Host "Cleaning up cache, logs, and unnecessary files..."
Remove-Item -Recurse -Force "$tempDir\tests" -ErrorAction SilentlyContinue
Remove-Item -Recurse -Force "$tempDir\storage\logs\*" -ErrorAction SilentlyContinue
Remove-Item -Recurse -Force "$tempDir\storage\framework\cache\data\*" -ErrorAction SilentlyContinue
Remove-Item -Recurse -Force "$tempDir\storage\framework\views\*" -ErrorAction SilentlyContinue
Remove-Item -Force "$tempDir\*.patch" -ErrorAction SilentlyContinue

Write-Host "Compressing to ZIP..."
Compress-Archive -Path "$tempDir\*" -DestinationPath $destination

Write-Host "Cleaning up temporary files..."
Remove-Item -Recurse -Force $tempDir

Write-Host "SUCCESS! Your production ZIP is ready at: $destination"

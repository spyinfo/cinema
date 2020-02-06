<# Скрипт PowerShell копирует файлы в указанную директорию.
   Январь 2020.
#>

cls
try {
    write-host "Copy files..."
    Copy-Item -Path "C:\OSPanel\domains\cinema\layouts\dist\css\*" -Destination "C:\OSPanel\domains\cinema\web\static\css\"
    Copy-Item -Path "C:\OSPanel\domains\cinema\layouts\dist\img\*" -Destination "C:\OSPanel\domains\cinema\web\static\img\"
    Copy-Item -Path "C:\OSPanel\domains\cinema\layouts\dist\js\*"  -Destination "C:\OSPanel\domains\cinema\web\static\js\"
    write-host "Success."
} catch {
    $exception = $_
    write-host "Какая-то ошибка. Это все, что я знаю в данный момент!"
    write-host $exception
}

Set WinScriptHost = CreateObject("WScript.Shell")
WinScriptHost.Run Chr(34) & "D:\web\www\host2.localhost\vendor\cron.bat" & Chr(34), 0
Set WinScriptHost = Nothing
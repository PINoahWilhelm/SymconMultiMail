# SymconMultiMail
Dieses Modul gibt die Möglichkeit mit einfachen Mitteln an verschiedene E-Mail Adressen die gleichen Mails zu verschicken. Dabei muss eine Instanz des SymconMultiMail Moduls erstellt werden. Dieser Instanz müssen nun als Kindelemente SMTP-Instanzen zugewiesen werden. 
## Funktionen
### MultiMail_SendMail($MultiMailInstanzID, $Betreff, $Email);
Verschicken einer normalen Mail an alle untergeordneten SMTP-Instanzen
### MultiMail_SendMailAttachment($MultiMailInstanzID, $Betreff, $Email, $Anhang);
Verschicken einer Mail mit Anhang an alle untergeordneten SMTP-Instanzen

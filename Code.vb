Imports System.Security.Cryptography
Imports System.Text

Public Class Form1

    'ENTERED INFORMATION
    Dim enteredemail As String
    Dim entereduser As String
    Dim enteredpw As String
    Dim token As String = "1234"

    'HWID Getter
    Function GetHWID()
        Dim HWID As String = System.Security.Principal.WindowsIdentity.GetCurrent.User.Value
        Return HWID
    End Function


   'CryptoSystem by QuiteCode (DO NOT CHANGE)
    Dim DES As New TripleDESCryptoServiceProvider
    Dim MD5 As New MD5CryptoServiceProvider

    'hash function
    Function MD5Hash(value As String) As Byte()
        Return MD5.ComputeHash(ASCIIEncoding.ASCII.GetBytes(value))
    End Function

    'Encryption
    Function Encrypt(input As String, Key As String) As String

        DES.Key = MD5Hash(Key)
        DES.Mode = CipherMode.ECB

        Dim buffer As Byte() = ASCIIEncoding.ASCII.GetBytes(input)

        Return Convert.ToBase64String(DES.CreateEncryptor().TransformFinalBlock(buffer, 0, buffer.Length))


    End Function

    Function Decrypt(encryptedstring As String, Key As String) As String

        DES.Key = MD5Hash(Key)
        DES.Mode = CipherMode.ECB

        Dim buffer As Byte() = Convert.FromBase64String(encryptedstring)
        Return ASCIIEncoding.ASCII.GetString(DES.CreateDecryptor().TransformFinalBlock(buffer, 0, buffer.Length))

    End Function


    'REGISTER FUNCTION
    Private Sub btn_reg_Click(sender As Object, e As EventArgs) Handles btn_register.Click
        enteredemail = reg_email.Text
        entereduser = reg_user.Text
        enteredpw = reg_pw.Text
        Dim webbrowser1 As New WebBrowser
        webbrowser1.Navigate("http://yourdomain.net/register.php?email=" & enteredemail & "&user=" & entereduser & "&pw5=" & Encrypt(enteredpw, "This is Keys") & "&hwid=" & Encrypt(GetHWID(), "This is Keys"))

        Do While webbrowser1.ReadyState <> WebBrowserReadyState.Complete
            Application.DoEvents()
        Loop
        If webbrowser1.DocumentText.Contains("1") Then
            MessageBox.Show("Diese E-Mail und/oder der Benutzername existiert bereits in unserer Datenbank!", "E-Mail/Benutzername existiert bereits", MessageBoxButtons.OK, MessageBoxIcon.Error)
        ElseIf webbrowser1.DocumentText.Contains("FINISHED") Then
            MessageBox.Show("Benutzer erfolgreich registriert, Sie können sich nun Anmelden", "Registrierung erfolgreich", MessageBoxButtons.OK, MessageBoxIcon.Information)
        End If
    End Sub

    'LOGIN FUNCTION
    Private Sub btn_login_Click(sender As Object, e As EventArgs) Handles btn_login.Click
        entereduser = login_user.Text
        enteredpw = login_pw.Text
        Dim webbrowser1 As New WebBrowser
        webbrowser1.Navigate("http://yourdomain.net/login.php?username=" & entereduser & "&password=" & Encrypt(enteredpw, "This is Keys") & "&hwid=" & Encrypt(GetHWID, "This is Keys"))
        Do While webbrowser1.ReadyState <> WebBrowserReadyState.Complete
            Application.DoEvents()
        Loop
        If webbrowser1.DocumentText.Contains("wronghwid") Then
            MsgBox("This PC is not authorized, Account banned.", MsgBoxStyle.Critical, "AntiPiracy")
        End If

        If webbrowser1.DocumentText.Contains("success") Then
            MessageBox.Show("Successfully logged in.")
            Form2.Show()
        Else
            MessageBox.Show("The entered login details are invalid, please try again!")
        End If
    End Sub
End Class

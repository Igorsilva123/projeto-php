import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';
import { Router } from '@angular/router'; // 🔥 IMPORTAR ROUTER

@Component({
  selector: 'app-login',
  templateUrl: './form-login.html',
  imports: [FormsModule, CommonModule],
  styleUrls: ['./form-login.css']
})
export class LoginComponent {

  login = {
    email: '',
    password: ''
  };

  constructor(private http: HttpClient, private router: Router) {} 

 onLogin() {
  this.http.post(
    "http://localhost/projeto-registro-evento/projeto-php/user-login.php",
    this.login,
    { withCredentials: true }
  ).subscribe({
    next: (res: any) => {
   
      if (res.error) {
        alert(res.error);
        return;
      }
      this.router.navigate(['/seats']); 
    },
    error: (err) => {
      alert(err.error?.error || "Erro ao logar!");
    }
  });
}

}

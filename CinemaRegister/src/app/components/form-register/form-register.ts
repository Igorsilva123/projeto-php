import { Component } from '@angular/core';
import { FormsModule } from '@angular/forms';
import { UserDataRegistration } from '../../models/user.model';
import { UserService } from '../../services/user/user';
import { CommonModule } from '@angular/common';


@Component({
  selector: 'app-form-register',
  imports: [FormsModule, CommonModule],
  templateUrl: './form-register.html',
  styleUrl: './form-register.css',
})
export class UserForm {
   user: UserDataRegistration = {name: '', email: '', password: ''}
  constructor(private userService: UserService){} 

onSubmit(){
      this.userService.createUser(this.user).subscribe();
      console.log("Registrado com Sucesso");
    }
  }

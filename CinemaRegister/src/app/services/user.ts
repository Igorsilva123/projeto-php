import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { UserDataRegistration } from '../models/user.model';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class UserService {
  private apiUrl = 'http://localhost/projeto-php/user-register.php';
  constructor(private http: HttpClient){}

  createUser(user: UserDataRegistration): Observable<any>{
    return this.http.post(this.apiUrl, user);
  }
}
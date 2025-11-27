import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
import { HttpClient } from '@angular/common/http';
import { Observable, of } from 'rxjs';
import { catchError, map } from 'rxjs/operators';

@Injectable({ providedIn: 'root' })
export class AuthGuard implements CanActivate {

  constructor(private http: HttpClient, private router: Router) {}

  canActivate(): Observable<boolean> {
    return this.http.get('http://localhost/projeto-registro-evento/projeto-php/check-auth.php', { withCredentials: true })
      .pipe(
        map((res: any) => {
          if (res.status === 'ok') {
            return true;
          } else {
            this.router.navigate(['/login']); 
            return false;
          }
        }),
        catchError(err => {
          this.router.navigate(['/login']); 
          return of(false);
        })
      );
  }
}

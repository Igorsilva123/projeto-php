import { Routes } from '@angular/router';
import { UserForm } from './components/form-register/form-register';
import { CinemaSeatsComponent } from './components/cinema/cinema-seats/cinema-seats';
import { LoginComponent } from './components/form-login/form-login'
import { AuthGuard } from './guards/auth.guard';
export const routes: Routes = [
  { path: 'register', component: UserForm },
  { path: 'login', component: LoginComponent },
  { path: 'seats', component: CinemaSeatsComponent, canActivate: [AuthGuard] },
  { path: '', redirectTo: 'register', pathMatch: 'full' }
];
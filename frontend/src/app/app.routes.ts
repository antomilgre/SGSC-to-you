import { Routes } from '@angular/router';
import { authGuard } from './core/guards/auth.guard';
import { AdminLayoutComponent } from './layout/admin-layout/admin-layout.component';
import { DashboardComponent } from './pages/dashboard/dashboard.component';
import { LoginComponent } from './pages/login/login.component';

export const routes: Routes = [
  { path: 'login', component: LoginComponent },
  {
    path: '', component: AdminLayoutComponent, canActivate: [authGuard],
    children: [{ path: 'dashboard', component: DashboardComponent }, { path: '', pathMatch: 'full', redirectTo: 'dashboard' }],
  },
  { path: '**', redirectTo: '' },
];

import { HttpClient } from '@angular/common/http';
import { Injectable, inject } from '@angular/core';
import { Observable, tap } from 'rxjs';
import { environment } from '../../../environments/environment';
import { LoginResponse, User } from '../models/auth.model';

@Injectable({ providedIn: 'root' })
export class AuthService {
  private readonly http = inject(HttpClient);
  private readonly tokenKey = 'sgsc_access_token';
  private readonly userKey = 'sgsc_user';
  login(email: string, password: string): Observable<LoginResponse> {
    return this.http.post<LoginResponse>(`${environment.apiBaseUrl}/login`, { email, password }).pipe(tap(response => this.saveSession(response)));
  }
  getToken(): string | null { return localStorage.getItem(this.tokenKey); }
  getUser(): User | null { const user = localStorage.getItem(this.userKey); return user ? JSON.parse(user) as User : null; }
  isLoggedIn(): boolean { return Boolean(this.getToken()); }
  logout(): void { localStorage.removeItem(this.tokenKey); localStorage.removeItem(this.userKey); }
  private saveSession(response: LoginResponse): void { localStorage.setItem(this.tokenKey, response.token); localStorage.setItem(this.userKey, JSON.stringify(response.user)); }
}

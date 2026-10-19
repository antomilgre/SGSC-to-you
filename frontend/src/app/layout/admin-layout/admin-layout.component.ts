import { Component, inject } from '@angular/core';
import { Router, RouterLink, RouterLinkActive, RouterOutlet } from '@angular/router';
import { AuthService } from '../../core/services/auth.service';

@Component({ selector: 'app-admin-layout', imports: [RouterLink, RouterLinkActive, RouterOutlet], templateUrl: './admin-layout.component.html', styleUrl: './admin-layout.component.scss' })
export class AdminLayoutComponent {
  private readonly auth = inject(AuthService); private readonly router = inject(Router); readonly user = this.auth.getUser();
  logout(): void { this.auth.logout(); this.router.navigateByUrl('/login'); }
}

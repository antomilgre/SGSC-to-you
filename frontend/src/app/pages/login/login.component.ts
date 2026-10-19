import { Component, inject, signal } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { Router } from '@angular/router';
import { AuthService } from '../../core/services/auth.service';

@Component({ selector: 'app-login', imports: [ReactiveFormsModule], templateUrl: './login.component.html', styleUrl: './login.component.scss' })
export class LoginComponent {
  private readonly auth = inject(AuthService);
  private readonly router = inject(Router);
  readonly isSubmitting = signal(false);
  readonly errorMessage = signal('');
  readonly loginForm = new FormGroup({
    email: new FormControl('', { nonNullable: true, validators: [Validators.required, Validators.email] }),
    password: new FormControl('', { nonNullable: true, validators: [Validators.required] }),
  });
  submit(): void {
    if (this.loginForm.invalid) { this.loginForm.markAllAsTouched(); return; }
    this.isSubmitting.set(true); this.errorMessage.set('');
    const { email, password } = this.loginForm.getRawValue();
    this.auth.login(email, password).subscribe({
      next: () => this.router.navigateByUrl('/dashboard'),
      error: error => { this.isSubmitting.set(false); this.errorMessage.set(error?.error?.message ?? 'Unable to sign in. Please check your details.'); },
    });
  }
}

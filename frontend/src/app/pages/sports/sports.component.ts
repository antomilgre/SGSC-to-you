import { Component, computed, inject, signal } from '@angular/core';
import { DatePipe } from '@angular/common';
import { PaginatedSports, SportService } from '../../core/services/sport.service';

@Component({
  selector: 'app-sports',
  imports: [DatePipe],
  templateUrl: './sports.component.html',
  styleUrl: './sports.component.scss',
})
export class SportsComponent {
  private readonly sportsService = inject(SportService);

  readonly result = signal<PaginatedSports | null>(null);
  readonly isLoading = signal(true);
  readonly errorMessage = signal('');
  readonly pageNumbers = computed(() => {
    const data = this.result();
    return data ? Array.from({ length: data.last_page }, (_, index) => index + 1) : [];
  });

  constructor() {
    this.loadSports();
  }

  loadSports(page = 1): void {
    this.isLoading.set(true);
    this.errorMessage.set('');

    this.sportsService.list(page).subscribe({
      next: (response) => {
        this.result.set(response.data);
        this.isLoading.set(false);
      },
      error: () => {
        this.errorMessage.set('Could not load sports. Confirm that Laravel is running, then try again.');
        this.isLoading.set(false);
      },
    });
  }

  changePage(page: number): void {
    const data = this.result();
    if (!data || page < 1 || page > data.last_page || page === data.current_page) return;
    this.loadSports(page);
  }
}

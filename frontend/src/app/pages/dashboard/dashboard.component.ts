import { Component, computed, inject, signal } from '@angular/core';
import { DatePipe, UpperCasePipe } from '@angular/common';
import { DashboardOverview, DashboardService } from '../../core/services/dashboard.service';

@Component({ selector: 'app-dashboard', imports: [DatePipe, UpperCasePipe], templateUrl: './dashboard.component.html', styleUrl: './dashboard.component.scss' })
export class DashboardComponent {
  private readonly dashboardService = inject(DashboardService);
  readonly overview = signal<DashboardOverview | null>(null);
  readonly isLoading = signal(true);
  readonly errorMessage = signal('');
  readonly metrics = computed(() => {
    const data = this.overview();
    return [
      { label: 'Active sports', value: data?.activeSports ?? 0, note: 'Managed in Sports' },
      { label: 'Teams', value: data?.teams ?? 0, note: 'Across all sports' },
      { label: 'Pending applications', value: data?.pendingApplications ?? 0, note: 'Needs review' },
      { label: 'Upcoming events', value: data?.upcomingEvents ?? 0, note: 'Scheduled ahead' },
    ];
  });

  constructor() { this.loadDashboard(); }

  loadDashboard(): void {
    this.isLoading.set(true);
    this.errorMessage.set('');
    this.dashboardService.getOverview().subscribe({
      next: overview => { this.overview.set(overview); this.isLoading.set(false); },
      error: () => { this.errorMessage.set('Could not load dashboard data. Check that Laravel is running.'); this.isLoading.set(false); },
    });
  }
}

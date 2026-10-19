import { HttpClient, HttpParams } from '@angular/common/http';
import { Injectable, inject } from '@angular/core';
import { forkJoin, map } from 'rxjs';
import { environment } from '../../../environments/environment';

interface ApiResponse<T> { status: boolean; data: T; }
interface Paginated<T> { data: T[]; total: number; }

export interface DashboardEvent {
  id: number;
  title: string;
  event_date: string;
  event_time?: string;
  location?: string;
  status: string;
  sport?: { name: string };
}

export interface DashboardOverview {
  activeSports: number;
  teams: number;
  pendingApplications: number;
  upcomingEvents: number;
  events: DashboardEvent[];
}

@Injectable({ providedIn: 'root' })
export class DashboardService {
  private readonly http = inject(HttpClient);

  getOverview() {
    const oneRecord = new HttpParams().set('per_page', '1');
    const upcoming = new HttpParams().set('per_page', '3').set('sort_by', 'event_date').set('sort_order', 'asc').set('filters', JSON.stringify({ status: 'upcoming' }));

    return forkJoin({
      sports: this.http.get<ApiResponse<Paginated<unknown>>>(`${environment.apiBaseUrl}/sports`, { params: oneRecord.set('status', '1') }),
      teams: this.http.get<ApiResponse<Paginated<unknown>>>(`${environment.apiBaseUrl}/teams`, { params: oneRecord }),
      applications: this.http.get<ApiResponse<Paginated<unknown>>>(`${environment.apiBaseUrl}/membership-applications`, { params: oneRecord.set('status', 'pending') }),
      events: this.http.get<ApiResponse<Paginated<DashboardEvent>>>(`${environment.apiBaseUrl}/events`, { params: upcoming }),
    }).pipe(map(({ sports, teams, applications, events }) => ({
      activeSports: sports.data.total,
      teams: teams.data.total,
      pendingApplications: applications.data.total,
      upcomingEvents: events.data.total,
      events: events.data.data,
    })));
  }
}
